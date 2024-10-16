<?php

namespace App\Http\Controllers\Package\CustomerCare;

use App\Http\Controllers\Controller;
use App\Http\Handlers\Resolvers\Package\CustomerCare\FeedbackMessageHandler;
use App\Http\Requests\Package\CustomerCare\StoreFeedbackMessageRequest;
use App\Http\Requests\Package\CustomerCare\UpdateFeedbackMessageRequest;
use App\Models\FeedbackMessage;
use Illuminate\Support\Facades\Redirect;

class FeedbackMessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $collections = FeedbackMessage::query()->get();
        return view('content.package.customer-care.feedback-message.index', compact('collections'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('content.package.customer-care.feedback-message.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFeedbackMessageRequest $request, FeedbackMessageHandler $handler)
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
    public function edit(FeedbackMessage $feedbackMessage)
    {
        return view('content.package.customer-care.feedback-message.edit', compact('feedbackMessage'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFeedbackMessageRequest $request, FeedbackMessageHandler $handler, FeedbackMessage $feedbackMessage)
    {
        if ($request->validated()) {
            $isUpdate = $handler->adapt($request, $feedbackMessage);
            $response = $isUpdate ? 'Congrats! Data is updated successfully' : 'Oops! Unable to update available resource';
            return Redirect::back()->with('status', $response);
        }
        return Redirect::back()->with('status', 'Oops! Something went wrong to updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FeedbackMessageHandler $handler, FeedbackMessage $feedbackMessage)
    {
        $isDelete = $handler->erase($feedbackMessage);
        $response = $isDelete ? 'Congrats! Data is deleted successfully' : 'Oops! Unable to delete model resource';
        return Redirect::back()->with('status', $response);
    }
}
