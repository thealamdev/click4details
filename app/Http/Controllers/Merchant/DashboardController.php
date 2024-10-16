<?php

namespace App\Http\Controllers\Merchant;

use App\Enums\Guard;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function index(Request $request)
    {
        $user = $request->user(Guard::MERCHANT->toString());
        // return view('content.merchant.dashboard', compact('user'));
         return redirect(route('merchant.vehicle.product.show'));
    }
}
