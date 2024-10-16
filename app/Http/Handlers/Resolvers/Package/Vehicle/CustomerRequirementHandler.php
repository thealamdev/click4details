<?php

namespace App\Http\Handlers\Resolvers\Package\Vehicle;

use App\Models\User;
use App\Models\Vehicle;
use App\Models\Customer;
use App\Models\Condition;
use App\Models\CustomerFuel;
use Illuminate\Http\Request;
use App\Models\BrandCustomer;
use App\Models\ColorCustomer;
use App\Models\CustomerGrade;
use App\Models\CustomerEngine;
use App\Models\CustomerEdition;
use App\Models\CustomerMileage;
use App\Models\CarmodelCustomer;
use App\Models\CustomerSkeleton;
use App\Models\AvailableCustomer;
use App\Models\ConditionCustomer;
use App\Models\CustomerManufacture;
use App\Models\CustomerRegistration;
use App\Models\CustomerTransmission;
use App\Http\Handlers\Utils\SearchTerm;
use Illuminate\Database\Eloquent\Model;
use App\Notifications\CustomerRequirement;
use App\Http\Handlers\Adapters\HandlerAdapter;



class CustomerRequirementHandler extends HandlerAdapter
{
    use SearchTerm;

    /**
     * Handle the incoming create request
     * @param  Request                      $request
     * @return array|object|int|string|bool
     */
    public function store(Request $request): array | object | int | string | bool
    {
        $customer = Customer::create(array_merge_recursive($request->only('name', 'user_id', 'merchant_id', 'mobile', 'email', 'budget_to', 'budget_from', 'ready_budget_to', 'ready_budget_from', 'loan', 'bank_loan', 'self_pay', 'income', 'level', 'serious', 'profession', 'frequency', 'purchase_date', 'location', 'instraction', 'company_transaction')));

        $requestKeys = [
            'brand' => BrandCustomer::class,
            'condition' => ConditionCustomer::class,
            'fuel' => CustomerFuel::class,
            'skeleton' => CustomerSkeleton::class,
            'edition' => CustomerEdition::class,
            'transmission' => CustomerTransmission::class,
            'model' => CarmodelCustomer::class,
            'manufacture' => CustomerManufacture::class,
            'color' => ColorCustomer::class,
            'grade' => CustomerGrade::class,
            'registration' => CustomerRegistration::class,
            'available' => AvailableCustomer::class,
        ];

        $customerData[] = [];
        foreach ($requestKeys as $key => $value) {
            if (!empty($request->$key)) {
                foreach ($request->$key as $val) {
                    $customerData[$key][] = [
                        'customer_id' => $customer->id,
                        $key => $val,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s'),
                    ];
                }
                if (!empty($customerData[$key])) {
                    $value::insert($customerData[$key]);
                }
            }
        }

        if (!empty($request->mileage_start && $request->mileage_end)) {
            $customer_mileage[] = [
                'customer_id' => $customer->id,
                'mileage_start' => $request->mileage_start,
                'mileage_end' => $request->mileage_end,
            ];
        }

        if (!empty($request->engine_start && $request->engine_end)) {
            $customer_engine[] = [
                'customer_id' => $customer->id,
                'engine_start' => $request->engine_start,
                'engine_end' => $request->engine_end,
            ];
        }

        if (!empty($customer_mileage)) {
            CustomerMileage::insert($customer_mileage);
        }
        if (!empty($customer_engine)) {
            CustomerEngine::insert($customer_engine);
        }

        // notification for vehicile match:
        $brands = $request->brand;
        $mileage_start = $request->mileage_start;
        $mileage_end = $request->mileage_end;
        $engine_start = $request->engine_start;
        $engine_end = $request->engine_end;
        $manufacture = $request->manufacture;

        $attributes = [
            'brand', 'condition', 'carmodel', 'edition',
            'color', 'grade', 'available', 'registration',
            'transmission', 'skeleton', 'fuel',
        ];

        $query = Vehicle::with(array_map(static function ($attribute) {
            return $attribute . '.translate';
        }, $attributes))->whereHas('brand.translate', function ($query) use ($brands) {
            $query->whereIn('title', $brands);
        });

        foreach ($attributes as $attribute) {
            $input = $request->input($attribute);
            if ($input) {
                $query->orwhereHas($attribute . '.translate', function ($query) use ($input) {
                    $query->whereIn('title', $input);
                });
            }
        }

        if (!empty($manufacture)) {
            $query->whereIn('manufacture', $manufacture);
        }

        if (!empty($mileage_start) && !empty($mileage_end)) {
            $query->whereBetween('mileages', [$mileage_start, $mileage_end]);
        }

        if (!empty($engine_start) && !empty($engine_end)) {
            $query->whereBetween('engines', [$engine_start, $engine_end]);
        }

        $vehicles = $query->get()->toArray();
        $admin = User::where('id', auth()->user()->id)->first();
        $admin->notify(new CustomerRequirement($vehicles));

        return $customer;
    }

    /**
     * Handle the incoming delete request
     * @param  Model|Request                $instance
     * @param  bool|null                    $isForceDelete
     * @return array|object|int|string|bool
     * @noinspection PhpUndefinedFieldInspection
     */
    public function erase(Model | Request $instance, ?bool $isForceDelete = false): array | object | int | string | bool
    {
        $process = $instance instanceof Model ? $instance : Condition::query()->findOrFail($instance->condition);
        collect($process->translate)->map(fn ($i) => $i->delete());
        return $process->delete();
    }

    /**
     * Handle the incoming restore request
     * @param  Request                      $request
     * @return array|object|int|string|bool
     */
    public function repay(Request $request): array | object | int | string | bool
    {
        return false;
    }

    /**
     * Handle the incoming update request
     * @param  Request                      $request
     * @param  Model|int|string             $instance
     * @return array|object|int|string|bool
     */
    public function adapt(Request $request, Model | int | string $instance): array | object | int | string | bool
    {
        return false;
    }

    /**
     * update customer requirement handler.
     */

    public function update(Request $request, $requirement): array | object | string | bool
    {
        $customer = $requirement->update(array_merge_recursive($request->only('name', 'user_id', 'merchant_id', 'mobile', 'email', 'budget', 'ready_budget', 'loan', 'bank_loan', 'self_pay', 'income', 'level', 'serious', 'profession', 'frequency', 'purchase_date', 'location', 'instraction')));

        // ($requirement->brandCustomer->update(['brand' => 'Toyota Brand']));

        return $customer;

        $requestKeys = [
            'brand' => BrandCustomer::class,
            'condition' => ConditionCustomer::class,
            'fuel' => CustomerFuel::class,
            'skeleton' => CustomerSkeleton::class,
            'edition' => CustomerEdition::class,
            'transmission' => CustomerTransmission::class,
            'model' => CarmodelCustomer::class,
            'manufacture' => CustomerManufacture::class,
            'color' => ColorCustomer::class,
            'grade' => CustomerGrade::class,
            'registration' => CustomerRegistration::class,
            'available' => AvailableCustomer::class,
        ];

        $customerData[] = [];
        foreach ($requestKeys as $key => $value) {
            if (!empty($request->$key)) {
                foreach ($request->$key as $val) {
                    $customerData[$key][] = [
                        'customer_id' => $customer->id,
                        $key => $val,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s'),
                    ];
                }
                if (!empty($customerData[$key])) {
                    $value::insert($customerData[$key]);
                }
            }
        }

        if (!empty($request->mileage_start && $request->mileage_end)) {
            $customer_mileage[] = [
                'customer_id' => $customer->id,
                'mileage_start' => $request->mileage_start,
                'mileage_end' => $request->mileage_end,
            ];
        }

        if (!empty($request->engine_start && $request->engine_end)) {
            $customer_engine[] = [
                'customer_id' => $customer->id,
                'engine_start' => $request->engine_start,
                'engine_end' => $request->engine_end,
            ];
        }

        if (!empty($customer_mileage)) {
            CustomerMileage::insert($customer_mileage);
        }
        if (!empty($customer_engine)) {
            CustomerEngine::insert($customer_engine);
        }

        return false;
    }

    /**
     * Define public method search() for filter the customer
     * @param Request $request
     * @param string $search
     * @return array|object
     */
    public function search(Request $request, $search)
    {
        if (!empty($this->findMobile($search))) {
            $requirements = Customer::query()
                ->latest()
                ->where('user_id', $request->user()->id)
                ->where('mobile', 'LIKE', "%{$this->findMobile($search)}%")
                ->paginate(20)->withQueryString();
        } elseif ($this->findId($search)) {
            $requirements = Customer::query()
                ->latest()
                ->where('user_id', $request->user()->id)
                ->where('id', '=', $search)
                ->get();
        } elseif ($this->findPercent($search)) {
            $requirements = Customer::query()
                ->latest()
                ->where('user_id', $request->user()->id)
                ->where('serious', 'LIKE', "%{$search}%")
                ->paginate(20)->withQueryString();
        } else {
            $requirements = Customer::query()
                ->latest()
                ->where('user_id', $request->user()->id)
                ->where(function ($query) use ($search) {
                    $query->where('name', 'LIKE', "%{$search}%")
                        ->orWhere('level', 'LIKE', "%{$search}%")
                        ->orWhere('profession', 'LIKE', "%{$search}%")
                        ->orWhere('loan', 'LIKE', "%{$search}%")
                        ->orWhere('income', 'LIKE', "%{$search}%")
                        ->orWhere('location', 'LIKE', "%{$search}%")
                        ->orWhere('budget_to', 'LIKE', "%{$search}%")
                        ->orWhere('budget_from', 'LIKE', "%{$search}%")
                        ->orWhere('frequency', 'LIKE', "%{$search}%")
                        ->orWhereHas('brandCustomer', function ($query) use ($search) {
                            $query->where('brand', 'LIKE', "%{$search}%");
                        })
                        ->orWhereHas('conditionCustomer', function ($query) use ($search) {
                            $query->where('condition', 'LIKE', "%{$search}%");
                        })
                        ->orWhereHas('customerEdition', function ($query) use ($search) {
                            $query->where('edition', 'LIKE', "%{$search}%");
                        })
                        ->orWhereHas('customerMileage', function ($query) use ($search) {
                            $query->whereRaw('? BETWEEN mileage_start AND mileage_end', [$search]);
                        })
                        ->orWhereHas('customerEngine', function ($query) use ($search) {
                            $query->whereRaw('? BETWEEN engine_start AND engine_end', [$search]);
                        })
                        ->orWhereHas('customerFuel', function ($query) use ($search) {
                            $query->where('fuel', 'LIKE', "%{$search}%");
                        })
                        ->orWhereHas('customerSkeleton', function ($query) use ($search) {
                            $query->where('skeleton', 'LIKE', "%{$search}%");
                        })
                        ->orWhereHas('customerTransmission', function ($query) use ($search) {
                            $query->where('transmission', 'LIKE', "%{$search}%");
                        })
                        ->orWhereHas('carmodelCustomer', function ($query) use ($search) {
                            $query->where('model', 'LIKE', "%{$search}%");
                        })
                        ->orWhereHas('customerManufacture', function ($query) use ($search) {
                            $query->where('manufacture', 'LIKE', "%{$search}%");
                        })
                        ->orWhereHas('colorCustomer', function ($query) use ($search) {
                            $query->where('color', 'LIKE', "%{$search}%");
                        })
                        ->orWhereHas('customerGrade', function ($query) use ($search) {
                            $query->where('grade', 'LIKE', "%{$search}%");
                        })
                        ->orWhereHas('availableCustomer', function ($query) use ($search) {
                            $query->where('available', 'LIKE', "%{$search}%");
                        })
                        ->orWhereHas('customerRegistration', function ($query) use ($search) {
                            $query->where('registration', 'LIKE', "%{$search}%");
                        })
                        ->orWhereHas('customerFeature', function ($query) use ($search) {
                            $query->where('feature', 'LIKE', "%{$search}%");
                        });
                })->paginate(20)->withQueryString();
        }

        return $requirements;
    }
}
