<?php

namespace App\Http\Controllers\Package\Residence;

use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Console\View\Components\Factory;
use Illuminate\Contracts\Foundation\Application;
use App\Http\Requests\Package\Residence\StoreCompletionStatusRequest;
use App\Http\Handlers\Resolvers\Package\Residence\CompletionStatusHandler;
use App\Http\Requests\Package\Residence\UpdateCompletionStatusRequest;
use App\Models\CompletionStatus;

class CompletionStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return View|Factory|Application
     */
    public function index(): View|Factory|Application
    {
        $collections = CompletionStatus::query()->get();
        return view('content.package.residence.completion-status.index', compact('collections'));
    }

    /**
     * Show the form for creating a new resource.
     * @return View|Factory|Application
     */
    public function create(): View|Factory|Application
    {
        return view('content.package.residence.completion-status.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param StoreCompletionStatusRequest $request
     * @param CompletionStatusHandler $handler
     * @return RedirectResponse
     */
    public function store(StoreCompletionStatusRequest $request, CompletionStatusHandler $handler): RedirectResponse
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
     * @param CompletionStatus $completionStatus
     * @return View|Factory|Application
     */
    public function edit(CompletionStatus $completionStatus): View|Factory|Application
    {
        return view('content.package.residence.completion-status.edit', compact('completionStatus'));
    }

    /**
     * Update the specified resource in storage.
     * @param UpdateCompletionStatusRequest $request
     * @param CompletionStatus $completionStatus
     * @param CompletionStatusHandler $handler
     * @return RedirectResponse
     */
    public function update(UpdateCompletionStatusRequest $request, CompletionStatus $completionStatus, CompletionStatusHandler $handler): RedirectResponse
    {
        if ($request->validated()) {
            $isUpdate = $handler->adapt($request, $completionStatus);
            $response = $isUpdate ? 'Congrats! Data is updated successfully' : 'Oops! Unable to update available resource';
            return Redirect::back()->with('status', $response);
        }
        return Redirect::back()->with('status', 'Oops! Something went wrong to updated');
    }

    /**
     * Remove the specified resource from storage.
     * @param CompletionStatus $completionStatus,
     * @param CompletionStatusHandler $handler
     * @return RedirectResponse
     */
    public function destroy(CompletionStatus $completionStatus, CompletionStatusHandler $handler): RedirectResponse
    {
        $isDelete = $handler->erase($completionStatus);
        $response = $isDelete ? 'Congrats! Data is deleted successfully' : 'Oops! Unable to delete model resource';
        return Redirect::back()->with('status', $response);
    }
}
