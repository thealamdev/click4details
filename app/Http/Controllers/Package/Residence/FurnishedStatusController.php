<?php

namespace App\Http\Controllers\Package\Residence;

use App\Models\FurnishedStatus;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\Factory;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Contracts\Foundation\Application;
use App\Http\Requests\Package\Residence\StoreFurnishedStatusRequest;
use App\Http\Handlers\Resolvers\Package\Residence\FurnishedStatusHandler;
use App\Http\Requests\Package\Residence\UpdateFurnishedStatusRequest;

class FurnishedStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return  View|Factory|Application
     */
    public function index(): View|Factory|Application
    {
        $collections = FurnishedStatus::query()->get();
        return view('content.package.residence.furnished-status.index', compact('collections'));
    }

    /**
     * Show the form for creating a new resource.
     * @return View|Factory|Application
     */
    public function create(): View|Factory|Application
    {
        return view('content.package.residence.furnished-status.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param StoreFurnishedStatusRequest $request
     * @param FurnishedStatusHandler $handler
     * @return RedirectResponse
     */
    public function store(StoreFurnishedStatusRequest $request, FurnishedStatusHandler $handler): RedirectResponse
    {
        if ($request->validated()) {
            $isCreate = $handler->store($request);
            $response = $isCreate ? 'Congrats! Data is created successfully' : 'Oops! Unable to create a new edition';
            return Redirect::back()->with('status', $response);
        }
        return Redirect::back()->with('status', 'Oops! Something went wrong to create');
    }

    /**
     * Show the form for editing the specified resource.
     * @return View|Factory|Application
     */
    public function edit(FurnishedStatus $furnishedStatus):View|Factory|Application
    {
        return view('content.package.residence.furnished-status.edit', compact('furnishedStatus'));
    }

    /**
     * Update the specified resource in storage.
     * @param UpdateFurnishedStatusRequest $request
     * @param FurnishedStatus $furnishedStatus
     * @param FurnishedStatusHandler $handler
     * @return RedirectResponse
     */
    public function update(UpdateFurnishedStatusRequest $request, FurnishedStatus $furnishedStatus, FurnishedStatusHandler $handler): RedirectResponse
    {
        if ($request->validated()) {
            $isUpdate = $handler->adapt($request, $furnishedStatus);
            $response = $isUpdate ? 'Congrats! Data is updated successfully' : 'Oops! Unable to update available resource';
            return Redirect::back()->with('status', $response);
        }
        return Redirect::back()->with('status', 'Oops! Something went wrong to updated');
    }

    /**
     * Remove the specified resource from storage.
     * @param FurnishedStatus $furnishedStatus,
     * @param FurnishedStatusHandler $handler
     * @return RedirectResponse
     */
    public function destroy(FurnishedStatus $furnishedStatus, FurnishedStatusHandler $handler): RedirectResponse
    {
        $isDelete = $handler->erase($furnishedStatus);
        $response = $isDelete ? 'Congrats! Data is deleted successfully' : 'Oops! Unable to delete model resource';
        return Redirect::back()->with('status', $response);
    }
}
