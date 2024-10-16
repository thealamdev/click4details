<?php

namespace App\Http\Controllers\Package\CustomerCare;

use App\Http\Controllers\Controller;
use App\Models\CustomerFollowupMessage;
use App\Models\CustomerFollowupMessageFeedback;
use App\Models\FeedbackMessage;
use Illuminate\Http\Request;

class CustomerFollowupMessageFeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(CustomerFollowupMessage $followup)
    {
        $custoer_fedbadcks = CustomerFollowupMessageFeedback::query()->latest()->where('user_id', auth()->user()->id)->where('customer_followup_message_id', $followup->id)->get();
        $feedback_messages = FeedbackMessage::query()->latest()->where('status', 1)->get();
        return view('content.package.customer-care.set-feedback.create', compact('followup', 'feedback_messages', 'custoer_fedbadcks'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, CustomerFollowupMessage $followup)
    {
        CustomerFollowupMessageFeedback::create([
            'user_id' => auth()->user()->id,
            'customer_followup_message_id' => $followup->id,
            'message' => $request->message ?? $request->customMessage,
            'set_time' => $request->set_time,
            'budget' => $request->budget,
        ]);

        $response = [
            'status' => 400,
            'message' => 'Feedback has been added',
        ];

        return response()->json($response);
    }

    /**
     * update whatsapp message status.
     */

    public function updateMessageStatus(CustomerFollowupMessage $followup)
    {
        $followup->update([
            'send_status' => 1,
        ]);
        $response = ['status' => 400, 'message' => 'Message has been send to customer'];
        return response()->json($response);
    }

    /**
     * update call status.
     */

    public function updateCallStatus(CustomerFollowupMessage $followup)
    {
        $followup->update([
            'call_status' => 1,
        ]);

        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(CustomerFollowupMessageFeedback $customerFollowupMessageFeedback)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CustomerFollowupMessageFeedback $customerFollowupMessageFeedback)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CustomerFollowupMessageFeedback $customerFollowupMessageFeedback)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CustomerFollowupMessageFeedback $customerFollowupMessageFeedback)
    {
        //
    }
}
