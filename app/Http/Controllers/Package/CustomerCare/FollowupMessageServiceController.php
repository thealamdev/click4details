<?php

namespace App\Http\Controllers\Package\CustomerCare;

use DateTime;
use App\Models\User;
use SimpleXMLElement;
use Illuminate\Http\Request;
use App\Models\FollowupMessage;
use App\Models\FollowupPackage;
use App\Http\Controllers\Controller;
use App\Models\FollowupMessageService;

class FollowupMessageServiceController extends Controller
{
    /**
     * method for render the resources.
     */
    public function index()
    {
        // TODO: method to do
    }

    /**
     * method for create resources
     */
    public function create(Request $request, User $user)
    {
        if ($request->ajax()) {
            $package_id = $request->package_id;
            $package = FollowupPackage::query()->where('id', $package_id)->first();
            $messages = FollowupMessage::query()->where('stage', $package->stage)->get();

            $followup_message = FollowupMessageService::query()->where('followup_package_id', $package_id)->with('message')->get();
            return response()->json(['messages' => $messages, 'followup_message' => $followup_message]);
        }

        $packages = FollowupPackage::query()->get();
        $currentDate = new DateTime();
        $daysOfWeek = array();
        for ($i = 0; $i < 7; $i++) {
            $daysOfWeek[] = $currentDate->format('l');
            $currentDate->modify('+1 day');
        }

        return view('content.package.customer-care.followup-message-service.create', compact('daysOfWeek', 'packages'));
    }

    /**
     * method for store resources
     * @param Request $request
     */
    public function store(Request $request)
    {
        $package = FollowupPackage::query()
            ->where('id', $request->package_id)
            ->first();
        $name  = ($package->name . '➤' . $package->stage . '➤' . '(' . $package->starting_day . '➤' . $package->visit_day . ')');

        $package_service = FollowupMessageService::create([
            'name' => $name,
            'followup_package_id' => $request->package_id,
            'followup_message_id' => $request->message,
            'send_day' => $request->send_day,
            'message_send_time' => $request->message_send_time,
            'call_time' => $request->call_time,
        ]);
        return back()->with('status', 'Followup message service created');
    }
}
