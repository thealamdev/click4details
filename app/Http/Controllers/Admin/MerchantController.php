<?php

namespace App\Http\Controllers\Admin;

use App\Models\Code;
use App\Models\Merchant;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Foundation\Application;
use App\Http\Requests\Admin\StoreMerchantRequest;
use App\Http\Requests\Admin\UpdateMerchantRequest;
use Illuminate\Validation\Rules;
use Illuminate\Validation\Rules\Password;

class MerchantController extends Controller
{
    /**
     * Display a listing of the resource
     * @param  Request                  $request
     * @return Application|Factory|View
     */
    public function index(Request $request): View|Factory|Application
    {
        $collections = Merchant::query()->with('code')->get();
        return view('content.admin.merchant.index', compact('collections'));
    }

    /**
     * Show the form for creating a new resource
     * @return Application|Factory|View
     */
    public function create(): View|Factory|Application
    {
        return view('content.admin.merchant.create');
    }

    /**
     * Store a newly created resource in storage
     * @param  StoreMerchantRequest $request
     * @return void
     */
    public function store(StoreMerchantRequest $request)
    {
        $data = $request->validated();
        $data['password'] = Hash::make($request->password);
        $merchant = Merchant::create($data);
        $start = $request->start_code;
        $end = $request->end_code;

        if ($end > $start) {
            for ($start; $start <= $end; $start++) {
                Code::create([
                    'merchant_id' => $merchant->id,
                    'prefix' => $request->prefix,
                    'code' => $request->prefix . "-" . $start
                ]);
            }
        }
        return back()->with('status', 'Merchant Create Successfully');
    }

    /**
     * Display the specified resource
     * @param  Merchant                 $merchant
     * @return Application|Factory|View
     */
    public function show(Merchant $merchant): View|Factory|Application
    {
        return view('content.admin.merchant.profile', compact('merchant'));
    }

    /**
     * Show the form for editing the specified resource
     * @param  Merchant                 $merchant
     * @return Application|Factory|View
     */
    public function edit(Merchant $merchant): View|Factory|Application
    {
        return view('content.admin.merchant.update', compact('merchant'));
    }

    /**
     * Update the specified resource in storage
     * @param  UpdateMerchantRequest $request
     * @param  Merchant              $merchant
     * @return void
     */
    public function update(UpdateMerchantRequest $request, Merchant $merchant)
    {
        $data = $request->validated();
        $data['password'] = Hash::make($request->password);
        $merchant->update($data);

        $start = $request->start_code;
        $end = $request->end_code;

        $check = Code::where('merchant_id', $merchant->id)->get();
        if (count($check) > 0) {
            Code::where('merchant_id', $merchant->id)->delete();
        }

        if ($end > $start) {
            for ($start; $start <= $end; $start++) {
                Code::create([
                    'merchant_id' => $merchant->id,
                    'prefix' => $request->prefix,
                    'code' => $request->prefix . "-" . $start
                ]);
            }
        }

        return back()->with('status', 'Merchant Update Successfully');
    }

    /**
     * Remove the specified resource from storage
     * @param  Merchant $merchant
     * @return void
     */
    public function destroy(Merchant $merchant)
    {
        $merchant->delete();
        return back()->with('status', 'Merchant Delete Successfully');
    }

    public function changePassword(Merchant $merchant, Request $request)
    {
        $request->validate([
            'password'  => ['required', Password::defaults(), 'confirmed'],
        ]);

        if (Hash::check($request->old_password, auth()->user()->password)) {
            $merchant->update([
                'password' => Hash::make($request->password)
            ]);
            return back()->with('status','Password Changed Successfully');
        } 
        else {
            return back()->with('status', 'Password is not matched');
        }
    }
}
