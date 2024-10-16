<?php

namespace App\Http\Controllers\Package\Vehicle;

use App\Http\Controllers\Controller;
use App\Models\Detail;
use App\Models\DetailFeature;
use App\Models\Featur;
use Illuminate\Http\Request;

class DetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $collections = Featur::with('detail')->latest()->get();
        return view('content.package.vehicle.detail.index', compact('collections'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        return view('content.package.vehicle.detail.create', compact('id'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required'
        ]);

        foreach ($request->title as $each) {
            Detail::create([
                'featur_id' => $request->featur_id,
                'title' => $each,
            ]);
        }

        return back()->with('status', 'New Details Added Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Detail $detail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Detail $detail)
    {
        $detail->update([
            'title' => $request->title,
        ]);
        return back()->with('status', $request->title . 'Update Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Detail $detail)
    {
        $detail->delete();
        return back()->with('status', 'Detail Delete Successfully');

    }
}
