<?php

namespace App\Http\Controllers\Client;

use App\Enums\Guard;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource
     * @param  Request                  $request
     * @return View|Factory|Application
     */
    public function index(Request $request)
    {
        $user = $request->user(Guard::CLIENT->toString());
        Session::flash('user', $user);
        $url = route('home.user.dashboard');
        return redirect()->to($url);
    }
}
