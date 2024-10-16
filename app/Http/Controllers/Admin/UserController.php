<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreUserRequest;
use App\Http\Requests\Admin\UpdateUserRequest;
use App\Models\Customer;
use App\Models\CustomerFollowupMessage;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource
     * @param  Request                  $request
     * @return Application|Factory|View
     */
    public function index(Request $request): View|Factory|Application
    {
        $collections = User::query()->get();
        return view('content.admin.user.index', compact('collections'));
    }

    /**
     * Show the form for creating a new resource
     * @return Application|Factory|View
     */
    public function create(): View|Factory|Application
    {
        return view('content.admin.user.create');
    }

    /**
     * Store a newly created resource in storage
     * @param  StoreUserRequest $request
     * @return void
     */
    public function store(StoreUserRequest $request): void
    {
        // TODO: Implement store() method
    }

    /**
     * Display the specified resource
     * @param  User                     $user
     * @return array|object|null|string|bool
     */
    public function show(User $user): array|object|null|string|bool
    {
        $today = date('Y-m-d');
        $schedule = CustomerFollowupMessage::query()
            ->with('customer', 'customerFollowupMessageFeedback')
            ->where('user_id', auth()->user()?->id)
            ->where(function ($query) use ($today) {
                $query->where(function ($query) use ($today) {
                    $query->whereNotNull('send_date')->whereDate('send_date', $today);
                });
            })
            ->get();

        // return $schedule;

        $incompletedJobs = CustomerFollowupMessage::query()
            ->with('customer', 'customerFollowupMessageFeedback')
            ->where('user_id', auth()->user()?->id)
            ->where('call_status', 0)->where('send_status', 0)->orderBy('send_date', 'desc')->paginate(30);

        $completedJobs = CustomerFollowupMessage::query()
            ->with('customer', 'customerFollowupMessageFeedback')
            ->where('user_id', auth()->user()?->id)
            ->where('call_status', 1)->where('send_status', 1)->orderBy('send_date', 'desc')->paginate(30);

        return view('content.admin.user.profile', compact('schedule', 'user', 'incompletedJobs', 'completedJobs'));
    }

    /**
     * Show the form for editing the specified resource
     * @param  User                     $user
     * @return Application|Factory|View
     */
    public function edit(User $user): View|Factory|Application
    {
        return view('content.admin.user.update', compact('user'));
    }

    /**
     * Update the specified resource in storage
     * @param  UpdateUserRequest $request
     * @param  User              $user
     * @return void
     */
    public function update(UpdateUserRequest $request, User $user): void
    {
        // TODO: Implement update() method
    }

    /**
     * Remove the specified resource from storage
     * @param  User $user
     * @return void
     */
    public function destroy(User $user): void
    {
        // TODO: Implement destroy() method
    }


    /**
     * method for get customer details
     * @param $customerId
     */
    public function detail($customerId)
    {
        $requirement = Customer::query()
            ->where('id', $customerId)
            ->with([
                'brandCustomer',
                'conditionCustomer',
                'customerEdition',
                'customerMileage',
                'customerEngine',
                'customerFuel',
                'customerSkeleton',
                'customerTransmission',
                'carmodelCustomer',
                'customerManufacture',
                'colorCustomer',
                'customerGrade',
                'availableCustomer',
                'customerRegistration',
                'customerFeature'
            ])->first();

        $customerDetails = CustomerFollowupMessage::query()
            ->with('customer', 'customerFollowupMessageFeedback')
            ->where('customer_id', $customerId)->get();

        return view('content.admin.user.detail', compact('customerDetails', 'requirement'));
    }
}
