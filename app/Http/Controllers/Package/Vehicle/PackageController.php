<?php

namespace App\Http\Controllers\Package\Vehicle;

use App\Models\Featur;
use App\Models\Edition;
use App\Models\Package;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DetailFeature;

class PackageController extends Controller
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
    public function create($id)
    {
        $edition = Edition::with('translate')->find($id);
        $featurs = Featur::with('detail')->get();
        $active_details = DetailFeature::where('edition_id', $id)->get();

        return view('content.package.vehicle.package.create', compact('edition', 'featurs', 'active_details'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $package = Package::updateOrCreate(
            ['edition_id' => $request->edition_id],
            ['edition_id' => $request->edition_id]
        );

        if ($request->detail_id !== null) {
            // First, delete existing records for the given edition and features
            DetailFeature::where('edition_id', $request->edition_id)->delete();

            $recordsToInsert = [];

            foreach ($request->detail_id as $feature_id => $detail_ids) {
                foreach ($detail_ids as $detail_id) {
                    $recordsToInsert[] = [
                        'package_id' => $package->id,
                        'edition_id' => $request->edition_id,
                        'featur_id' => $feature_id,
                        'detail_id' => $detail_id
                    ];
                }
            }

            if (!empty($recordsToInsert)) {
                DetailFeature::insert($recordsToInsert);
            }
        }

        return back()->with('status', ' Package Create Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Package $package)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Package $package)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Package $package)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Package $package)
    {
        //
    }
}
