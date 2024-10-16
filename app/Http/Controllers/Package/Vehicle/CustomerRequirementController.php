<?php

namespace App\Http\Controllers\Package\Vehicle;

use App\Models\User;
use App\Models\Vehicle;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Models\BrandCustomer;
use App\Models\ColorCustomer;
use App\Models\CustomerGrade;
use App\Models\CustomerEngine;
use App\Models\CustomerEdition;
use App\Models\CustomerMileage;
use App\Models\FollowupMessage;
use App\Models\CarmodelCustomer;
use App\Models\CustomerSkeleton;
use App\Models\AvailableCustomer;
use App\Models\ConditionCustomer;
use App\Models\CustomerManufacture;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use App\Models\CustomerRegistration;
use App\Models\CustomerTransmission;
use Illuminate\Auth\Events\Validated;
use Illuminate\Contracts\View\Factory;
use App\Models\CustomerFollowupMessage;
use Devfaysal\BangladeshGeocode\Models\District;
use Illuminate\Contracts\Foundation\Application;
use App\Http\Requests\Package\Vehicle\StoreCustomerRequirementRequest;
use App\Http\Handlers\Resolvers\Package\Vehicle\CustomerRequirementHandler;

class CustomerRequirementController extends Controller
{
    /**
     * Define public property $count
     */
    public $count = 1;

    /**
     * Define public property $formLenCount
     */
    public $formLenCount = 5;

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $followups = FollowupMessage::query()->get();
        $users = User::query()->get();
        $today = date('Y-m-d');
        $requirements = Customer::query()
            ->latest()
            ->where('user_id', auth()->user()?->id)
            ->with(['customerFollowupMessage' => function ($query) use ($today) {
                $query->where('user_id', auth()->user()->id)
                    ->where(function ($query) use ($today) {
                        $query->whereNotNull('send_date');
                    })->orderBy('send_date', 'asc');
                $query->with('customerFollowupMessageFeedback');
            }])
            ->with('brandCustomer')
            ->with('conditionCustomer')
            ->with('customerEdition')
            ->with('customerMileage')
            ->with('customerEngine')
            ->with('customerFuel')
            ->with('customerSkeleton')
            ->with('customerTransmission')
            ->with('carmodelCustomer')
            ->with('customerManufacture')
            ->with('colorCustomer')
            ->with('customerGrade')
            ->with('availableCustomer')
            ->with('customerRegistration')
            ->with('customerFeature')
            ->paginate(20);

        return view('content.package.vehicle.requirement.index', ['followups' => $followups, 'requirements' => $requirements, 'users' => $users, 'count' => $this->count, 'formLenCount' => $this->formLenCount]);
    }

    /**
     * method for filter the customer details to index page.
     * @param Request $request
     * @param CustomerRequirementHandler $handler
     */

    public function filter(Request $request, CustomerRequirementHandler $handler): View|Factory|Application
    {
        $followups = FollowupMessage::query()->get();
        $search = $request?->search ?? '';
        $users = User::query()->get();
        $requirements = $handler->search($request, $search);

        return view('content.package.vehicle.requirement.index', [
            'followups' => $followups,
            'requirements' => $requirements,
            'users' => $users,
            'count' => $this->count,
            'formLenCount' => $this->formLenCount
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $areas = [
            'Dhaka',
            'Gulshan - 1',
            'Gulshan - 2',
            'Motijheel',
            'Mohammadpur',
            'Mohammadpur',
            'Khilgaon',
            'Uttara',
            'Tongi',
            'Shyamoli',
            'Savar',
            'Mirpur',
            'Mirpur -1 ',
            'Mirpur -2',
            'Badda',
            'Gajipur',
            'Chattagram',
        ];

        return view('content.package.vehicle.requirement.create', compact('areas'));
    }

    /**
     * method for get all the customer requirements in a modal
     * @param Request $request
     */
    public function detail(Request $request)
    {
        $today = date('Y-m-d');
        $requirements = Customer::query()
            ->where('user_id', auth()->user()?->id)
            ->where('id', $request->modal_id)
            ->with(['customerFollowupMessage' => function ($query) use ($today) {
                $query->where('user_id', auth()->user()->id)
                    ->where(function ($query) use ($today) {
                        $query->whereNotNull('send_date');
                    })->orderBy('send_date', 'asc');
                $query->with('customerFollowupMessageFeedback');
            }])
            ->with('brandCustomer')
            ->with('conditionCustomer')
            ->with('customerEdition')
            ->with('customerMileage')
            ->with('customerEngine')
            ->with('customerFuel')
            ->with('customerSkeleton')
            ->with('customerTransmission')
            ->with('carmodelCustomer')
            ->with('customerManufacture')
            ->with('colorCustomer')
            ->with('customerGrade')
            ->with('availableCustomer')
            ->with('customerRegistration')
            ->with('customerFeature')
            ->first();
        // return response()->json($requirement);

        return view('content.package.vehicle.requirement.partials.modal', compact('requirements'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCustomerRequirementRequest $request, CustomerRequirementHandler $handler)
    {
        if ($request->validated()) {
            $isCreate = $handler->store($request);
        }

        return redirect(route('admin.vehicle.customer.followup-message.create', ['customer' => $isCreate->getKey()]));
    }

    /**
     * Display the search record for all executives customer's requirement.
     */
    public function search(Request $request)
    {
        $brands = $request->brand;
        $mileage_start = $request->mileage_start;
        $mileage_end = $request->mileage_end;
        $engine_start = $request->engine_start;
        $engine_end = $request->engine_end;
        $manufacture = $request->manufacture;
        $content = $request->content;

        $attributes = [
            'brand', 'condition', 'carmodel', 'edition',
            'color', 'grade', 'available', 'registration',
            'transmission', 'skeleton', 'fuel',
        ];

        $query = Vehicle::with('translate')
            ->with('merchant', fn ($query) => $query->select(['id', 'name']));
        if (!empty($request->brand)) {
            $query->with(array_map(static function ($attribute) {
                return $attribute . '.translate';
            }, $attributes))->whereHas('brand.translate', function ($query) use ($brands) {
                $query->whereIn('title', $brands);
            });
        }

        foreach ($attributes as $attribute) {
            $input = $request->input($attribute);
            if ($input) {
                $query->$content($attribute . '.translate', function ($query) use ($input) {
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

        $products = $query->get();
        return view('content.package.vehicle.product.index', compact('products'));
    }

    /**
     * method for filter the customer details to client page.
     * @param Request $request
     */
    public function filterClient(Request $request)
    {
        $executives = User::all();
        $search = $request->search;

        $requirements = Customer::query()
            ->where(function ($query) use ($search) {
                if ($search) {
                    $query->where(function ($query) use ($search) {
                        $query->where('id', $search)
                            ->orWhere('name', 'LIKE', "%{$search}%")
                            ->orWhere('mobile', 'LIKE', "%{$search}%")
                            ->orWhere('level', 'LIKE', "%{$search}%")
                            ->orWhere('serious', 'LIKE', "%{$search}%")
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
                    });
                }
            })
            ->paginate(20)
            ->withQueryString();

        return view('content.package.vehicle.requirement.clients', compact('executives', 'requirements'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $requirement)
    {
        $today = date('Y-m-d');
        $customer = Customer::query()
            ->latest()
            ->where('id', $requirement->id)
            ->where('user_id', auth()->user()?->id)
            ->with(['customerFollowupMessage' => function ($query) use ($today) {
                $query->where('user_id', auth()->user()->id)
                    ->where(function ($query) use ($today) {
                        $query->whereNotNull('send_date');
                    });
                $query->with('customerFollowupMessageFeedback');
            }])
            ->with('brandCustomer')
            ->with('conditionCustomer')
            ->with('customerEdition')
            ->with('customerMileage')
            ->with('customerEngine')
            ->with('customerFuel')
            ->with('customerSkeleton')
            ->with('customerTransmission')
            ->with('carmodelCustomer')
            ->with('customerManufacture')
            ->with('colorCustomer')
            ->with('customerGrade')
            ->with('availableCustomer')
            ->with('customerRegistration')
            ->with('customerFeature')
            ->first();

        return view('content.package.vehicle.requirement.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $requirement)
    {
        $customer = $requirement->update(array_merge_recursive($request->only('name', 'user_id', 'merchant_id', 'mobile', 'email', 'budget_to', 'budget_from', 'ready_budget_to', 'ready_budget_from', 'loan', 'bank_loan', 'self_pay', 'income', 'level', 'serious', 'profession', 'frequency', 'purchase_date', 'location', 'instraction', 'company_transaction')));

        // return $request->mileage_start;
        if (!empty($request->mileage_start)) {
            CustomerMileage::where('customer_id', $requirement->id)->update([
                'mileage_start' => $request->mileage_start,
                'mileage_end' => $request->mileage_end
            ]);
        }

        if (!empty($request->engine_start)) {
            CustomerEngine::where('customer_id', $requirement->id)->update([
                'engine_start' => $request->engine_start,
                'engine_end' => $request->engine_end
            ]);
        }

        if (!empty($request->brand)) {
            foreach ($request?->brand as $req) {
                BrandCustomer::updateOrCreate(
                    ['customer_id' => $requirement->id, 'brand' => $req],
                    ['brand' => $req]
                );
            }
        }

        if (!empty($request->brand)) {
            foreach ($request?->brand as $req) {
                BrandCustomer::updateOrCreate(
                    ['customer_id' => $requirement->id, 'brand' => $req],
                    ['brand' => $req]
                );
            }
        }

        if (!empty($request->condition)) {
            foreach ($request?->condition as $req) {
                ConditionCustomer::updateOrCreate(
                    ['customer_id' => $requirement->id, 'condition' => $req],
                    ['condition' => $req]
                );
            }
        }

        if (!empty($request->skeleton)) {
            foreach ($request?->skeleton as $req) {
                CustomerSkeleton::updateOrCreate(
                    ['customer_id' => $requirement->id, 'skeleton' => $req],
                    ['skeleton' => $req]
                );
            }
        }

        if (!empty($request->edition)) {
            foreach ($request?->edition as $req) {
                CustomerEdition::updateOrCreate(
                    ['customer_id' => $requirement->id, 'edition' => $req],
                    ['edition' => $req]
                );
            }
        }

        if (!empty($request->transmission)) {
            foreach ($request?->transmission as $req) {
                CustomerTransmission::updateOrCreate(
                    ['customer_id' => $requirement->id, 'transmission' => $req],
                    ['transmission' => $req]
                );
            }
        }

        if (!empty($request->model)) {
            foreach ($request?->model as $req) {
                CarmodelCustomer::updateOrCreate(
                    ['customer_id' => $requirement->id, 'model' => $req],
                    ['model' => $req]
                );
            }
        }
        if (!empty($request->manufacture)) {
            foreach ($request?->manufacture as $req) {
                CustomerManufacture::updateOrCreate(
                    ['customer_id' => $requirement->id, 'manufacture' => $req],
                    ['manufacture' => $req]
                );
            }
        }
        if (!empty($request->color)) {
            foreach ($request?->color as $req) {
                ColorCustomer::updateOrCreate(
                    ['customer_id' => $requirement->id, 'color' => $req],
                    ['color' => $req]
                );
            }
        }
        if (!empty($request->grade)) {
            foreach ($request?->grade as $req) {
                CustomerGrade::updateOrCreate(
                    ['customer_id' => $requirement->id, 'grade' => $req],
                    ['grade' => $req]
                );
            }
        }
        if (!empty($request->registration)) {
            foreach ($request?->registration as $req) {
                CustomerRegistration::updateOrCreate(
                    ['customer_id' => $requirement->id, 'registration' => $req],
                    ['registration' => $req]
                );
            }
        }
        if (!empty($request->available)) {
            foreach ($request?->available as $req) {
                AvailableCustomer::updateOrCreate(
                    ['customer_id' => $requirement->id, 'available' => $req],
                    ['available' => $req]
                );
            }
        }

        return back()->with('status', 'Customer Requirement updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        // TODO : implement the function ...
    }

    /**
     * Show the all customers/client to admin.
     * @return array|object
     */
    public function clients(): array|object
    {
        $today = date('Y-m-d');
        $executives = User::query()->get();
        $requirements = Customer::query()
            ->latest()
            ->with(['customerFollowupMessage' => function ($query) use ($today) {
                $query->where(function ($query) use ($today) {
                    $query->whereNotNull('send_date');
                });
                $query->with('customerFollowupMessageFeedback');
            }])
            ->with('brandCustomer', fn ($query) => $query->select('customer_id', 'brand'))
            ->with('conditionCustomer', fn ($query) => $query->select('customer_id', 'condition'))
            ->with('customerEdition', fn ($query) => $query->select('customer_id', 'edition'))
            ->with('customerMileage', fn ($query) => $query->select('customer_id', 'mileage_start', 'mileage_end'))
            ->with('customerEngine', fn ($query) => $query->select('customer_id', 'engine_start', 'engine_end'))
            ->with('customerFuel', fn ($query) => $query->select('customer_id', 'fuel'))
            ->with('customerSkeleton', fn ($query) => $query->select('customer_id', 'skeleton'))
            ->with('customerTransmission', fn ($query) => $query->select('customer_id', 'transmission'))
            ->with('carmodelCustomer', fn ($query) => $query->select('customer_id', 'model'))
            ->with('customerManufacture', fn ($query) => $query->select('customer_id', 'manufacture'))
            ->with('colorCustomer', fn ($query) => $query->select('customer_id', 'color'))
            ->with('customerGrade', fn ($query) => $query->select('customer_id', 'grade'))
            ->with('availableCustomer', fn ($query) => $query->select('customer_id', 'available'))
            ->with('customerRegistration', fn ($query) => $query->select('customer_id', 'registration'))
            ->with('customerFeature', fn ($query) => $query->select('customer_id', 'feature'))
            ->paginate(20);

        return view('content.package.vehicle.requirement.clients', compact('executives', 'requirements'));
    }

    /**
     * method for update instruction of customers.
     */
    public function instructionUpdate(Request $request, Customer $requirement)
    {
        $requirement->update([
            'instraction' => $request->instraction,
        ]);

        return back()->with('status', 'Instruction update successfull');
    }

    /**
     * @return array|object|string|bool
     * method for handover customer to others.
     */
    public function handover(Request $request, Customer $requirement): array|object|string|bool
    {
        $validated = $request->validate(['user_id' => 'required'], ['user_id.required' => 'select one user !!!']);
        $user_name = User::find($request->user_id)->name;
        $requirement->update(['user_id' => $request->user_id]);
        CustomerFollowupMessage::where('customer_id', $requirement->id)->update(['user_id' => $request->user_id]);
        return back()->with('status', 'Customer Handovered to ' . $user_name);
    }
}
