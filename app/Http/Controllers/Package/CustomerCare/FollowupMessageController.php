<?php

namespace App\Http\Controllers\Package\CustomerCare;

use App\Http\Controllers\Controller;
use App\Http\Handlers\Resolvers\Package\CustomerCare\FollowupMessageHandler;
use App\Models\FollowupMessage;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\Package\CustomerCare\StoreFollowupMessageRequest;
use App\Http\Requests\Package\CustomerCare\UpdateFollowupMessageRequest;

class FollowupMessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $collections = FollowupMessage::query()->get();
        return view('content.package.customer-care.followup-message.index', compact('collections'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('content.package.customer-care.followup-message.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFollowupMessageRequest $request, FollowupMessageHandler $handler)
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
     */
    public function edit(FollowupMessage $followupMessage)
    {
        return view('content.package.customer-care.followup-message.edit', compact('followupMessage'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFollowupMessageRequest $request, FollowupMessageHandler $handler, FollowupMessage $followupMessage)
    {
        if ($request->validated()) {
            $isUpdate = $handler->adapt($request, $followupMessage);
            $response = $isUpdate ? 'Congrats! Data is updated successfully' : 'Oops! Unable to update available resource';
            return Redirect::back()->with('status', $response);
        }
        return Redirect::back()->with('status', 'Oops! Something went wrong to updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FollowupMessageHandler $handler, FollowupMessage $followupMessage)
    {
        $isDelete = $handler->erase($followupMessage);
        $response = $isDelete ? 'Congrats! Data is deleted successfully' : 'Oops! Unable to delete model resource';
        return Redirect::back()->with('status', $response);
    }
}
