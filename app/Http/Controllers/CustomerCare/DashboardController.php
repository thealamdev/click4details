<?php

namespace App\Http\Controllers\CustomerCare;

use App\Http\Controllers\Controller;
use App\Models\CustomerCare;
use App\Models\Merchant;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * method for rendering customer care dashboard.
     * @param Request $request
     */
    public function index(Request $request)
    {
        $customer_care = CustomerCare::query()->where('id', $request->user()->id)->with('owner')->first();
        return view('content.customer-care.dashboad', compact('customer_care'));
    }
}
