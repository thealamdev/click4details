<?php

namespace App\Http\Controllers\Merchant\Vehicle;

use App\Http\Controllers\Controller;
use App\Http\Handlers\Resolvers\Package\Vehicle\SkeletonHandler;
use App\Http\Requests\Package\Vehicle\StoreSkeletonRequest;
use App\Http\Requests\Package\Vehicle\UpdateSkeletonRequest;
use App\Models\Skeleton;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class SkeletonController extends Controller
{
    /**
     * Display a listing of the resource
     * @param  Request                  $request
     * @return Application|Factory|View
     */
    public function index(Request $request): View|Factory|Application
    {
        $collections = Skeleton::query()->with('translate')->get();
        return view('content.merchant.vehicle.skeleton.index', compact('collections'));
    }

    /**
     * Show the form for creating a new resource
     * @return Application|Factory|View
     */
    public function create(): View|Factory|Application
    {
        return view('content.merchant.vehicle.skeleton.create');
    }

    /**
     * Store a newly created resource in storage
     * @param  StoreSkeletonRequest $request
     * @param  SkeletonHandler      $handler
     * @return RedirectResponse
     */
    public function store(StoreSkeletonRequest $request, SkeletonHandler $handler): RedirectResponse
    {
        if ($request->validated()) {
            $isCreate = $handler->store($request);
            $response = $isCreate ? 'Congrats! Data is created successfully' : 'Oops! Unable to create a skeleton resource';
            return Redirect::back()->with('status', $response);
        }
        return Redirect::back()->with('status', 'Oops! Something went wrong to create');
    }

    /**
     * Display the specified resource
     * @param  Skeleton $skeleton
     * @return void
     */
    public function show(Skeleton $skeleton): void
    {
        // TODO: Implement show() method
    }

    /**
     * Show the form for editing the specified resource
     * @param  Skeleton                 $skeleton
     * @return Application|Factory|View
     */
    public function edit(Skeleton $skeleton): View|Factory|Application
    {
        return view('content.merchant.vehicle.skeleton.update', compact('skeleton'));
    }

    /**
     * Update the specified resource in storage
     * @param  UpdateSkeletonRequest $request
     * @param  Skeleton              $skeleton
     * @param  SkeletonHandler       $handler
     * @return RedirectResponse
     * @noinspection PhpConditionAlreadyCheckedInspection
     */
    public function update(UpdateSkeletonRequest $request, Skeleton $skeleton, SkeletonHandler $handler): RedirectResponse
    {
        if ($request->validated()) {
            $isUpdate = $handler->adapt($request, $skeleton);
            $response = $isUpdate ? 'Congrats! Data is updated successfully' : 'Oops! Unable to update skeleton resource';
            return Redirect::back()->with('status', $response);
        }
        return Redirect::back()->with('status', 'Oops! Something went wrong to updated');
    }

    /**
     * Remove the specified resource from storage
     * @param  Skeleton         $skeleton
     * @param  SkeletonHandler  $handler
     * @return RedirectResponse
     */
    public function destroy(Skeleton $skeleton, SkeletonHandler $handler): RedirectResponse
    {
        $isDelete = $handler->erase($skeleton);
        $response = $isDelete ? 'Congrats! Data is deleted successfully' : 'Oops! Unable to delete skeleton resource';
        return Redirect::back()->with('status', $response);
    }
}
