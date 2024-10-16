<?php

namespace App\Http\Controllers\Package\Vehicle;

use App\Models\Featur;
use Illuminate\Http\Request;
use App\Models\DetailFeature;
use App\Http\Controllers\Controller;
use App\Models\Detail;

class FeaturController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $collections = Featur::latest()->get();
        return view('content.package.vehicle.featur.index', compact('collections'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('content.package.vehicle.featur.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $featur = Featur::create([
            'title' => $request->title,
            'status' => $request->status
        ]);

        return redirect(route('admin.vehicle.detail.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Featur $featur)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Featur $featur)
    {
        $details = Detail::where('featur_id', $featur->id)->get();
        return view('content.package.vehicle.featur.update', compact('details', 'featur'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Featur $featur)
    {
        $featur->update([
            'title' => $request->title,
        ]);
        return back()->with('status', 'Feature Update Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Featur $featur)
    {
        $featur->delete();
        return back()->with('status', 'Feature Delete Successfully');
    }
}
