<?php

namespace App\Http\Controllers\Admin;

use App\Enums\Guard;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource
     * @param  Request                  $request
     * @return View|Factory|Application
     */
    public function index(Request $request): View|Factory|Application
    {
        $user = $request->user(Guard::ADMIN->toString());
        return view('content.admin.dashboard', compact('user'));
    }
}
