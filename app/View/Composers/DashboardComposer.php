<?php

namespace App\View\Composers;

use App\Models\User;
use App\Models\Customer;
use Illuminate\View\View;
use App\Models\CustomerFollowupMessage;

class DashboardComposer
{
    /**
     * Composer response handler
     * @var array|object
     */
    private array|object $response = [];

    /**
     * Create a new composer instance
     * @return void
     */
    final public function __construct()
    {
        $today = date('Y-m-d');
        $schedule['schedule'] = CustomerFollowupMessage::query()->latest()
            ->with('customer', 'customerFollowupMessageFeedback')
            ->where('user_id', auth()->user()?->id)
            ->where(function ($query) use ($today) {
                $query->where(function ($query) use ($today) {
                    $query->whereNotNull('send_date')->whereDate('send_date', $today);
                });
            })
            ->get();

        $schedule['users'] = User::query()->get();
        $today = date('Y-m-d');
        $schedule['requirements'] = Customer::query()
            ->latest()
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
            ->paginate(10);

        $this->response = $schedule;
    }

    /**
     * Bind data to the view
     * @param  View $view
     * @return void
     */
    public function compose(View $view): void
    {
        $view->with('schedule', collect($this->response)->map(fn ($i) => (object) $i)->toBase());
    }
}
