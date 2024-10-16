<?php

namespace App\Http\Controllers\Package\CustomerCare;

use DateTime;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\FollowupPackage;
use App\Http\Controllers\Controller;

class FollowupPackageController extends Controller
{
    /** 
     * method for rendering the resources.
     */
    public function index()
    {
        // TODO: method to implement.
    }

    /**
     * method for create the resources.
     */
    public function create()
    {
        $currentDate = new DateTime();
        $daysOfWeek = array();
        for ($i = 0; $i < 7; $i++) {
            $daysOfWeek[] = $currentDate->format('l');
            $currentDate->modify('+1 day');
        }

        $packages = FollowupPackage::query()->get();

        return view('content.package.customer-care.followup-package.create', compact('daysOfWeek', 'packages'));
    }

    /**
     * method for store resources
     * @param Request $request
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'unique:followup_packages,name,NULL,id,stage,' . $request->stage . ',starting_day,' . $request->starting_day . ',visit_day,' . $request->visit_day,
        ]);

        $packages = FollowupPackage::create([
            'name' => $request->name,
            'stage' => $request->stage,
            'starting_day' => $request->starting_day,
            'visit_day' => $request->visit_day,
        ]);

        return back()->with('status', 'Packages create successfull');
    }

    /**
     * method for delete resources
     * @param FollowupPackage  $FollowupPackage
     */
    public function destroy(FollowupPackage $followupMessage)
    {
        $followupMessage->delete();
        return back()->with('status', 'Package delete successfull');
    }
}
