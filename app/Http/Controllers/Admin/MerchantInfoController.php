<?php

namespace App\Http\Controllers\Admin;

use App\Enums\Bucket;
use App\Facades\Upload;
use App\Models\Merchant;
use App\Models\MerchantInfo;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Handlers\Resolvers\Merchant\MerchantInfoHandler;
use Illuminate\Contracts\Validation\ValidationRule;

class MerchantInfoController extends Controller
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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, MerchantInfoHandler $handler)
    {
        $merchant = Auth::guard('merchant')->user();
        $request->validate([
            'name' => 'required',
            'email' => ['required', Rule::unique('merchants', 'email')->ignore($merchant->id, 'id')],
            'image' => 'nullable|mimes:png,jpg,jpeg|max:3072',
            'company_name.en' => 'required',
            'company_name.bn' => 'required',
            'facebook' => 'nullable',
            'youtube' => 'nullable'
        ]);
        $isCreate = $handler->store($request);
        return back()->with('status', 'Profile Update Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(MerchantInfo $merchantInfo)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MerchantInfo $merchantInfo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MerchantInfo $merchantInfo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MerchantInfo $merchantInfo)
    {
        //
    }
}
