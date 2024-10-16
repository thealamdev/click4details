<?php

namespace App\Http\Controllers\Package\RentalServices\Services;

use App\Facades\Upload;
use App\Models\RentCar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\Package\Vehicle\StoreGalleryRequest;
use App\Models\Gallery;

class RentCarGallaryController extends Controller
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
    public function create(RentCar $rentCar)
    {
        return view('content.package.rental-services.services.rental-car.gallery', compact('rentCar'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RentCar $rentCar, StoreGalleryRequest $request)
    {
        if ($request->validated()) {
            $images = [];

            if ($request->hasFile('image')) {
                foreach ($request->file('image') as $file) {
                    $isUpload = Upload::local()->storeImage($file);

                    if ($isUpload) {
                        $images[] = [
                            'url' => $isUpload['url'],
                            'filename' => $isUpload['filename'],
                            'name' => $isUpload['name'],
                            'path' => $isUpload['path'],
                            'mime' => $isUpload['mime'],
                            'size' => $isUpload['size'],
                        ];
                    }
                }
            }

            $isManage = $rentCar->gallery()->createMany($images);
            $response = $isManage ? 'Congrats! Data is uploaded successfully' : 'Oops! Unable to upload thumbnail';
            return Redirect::back()->with('status', $response);
        }
        return Redirect::back()->with('status', 'Oops! Something went wrong during upload');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RentCar $rentCar, Gallery $gallery)
    {
        if (isset($rentCar->gallery) && !empty($rentCar->gallery)) {
            $gallery->recycle();
        }
        $isDelete = $gallery->delete();
        $response = $isDelete ? 'Congrats! Data is deleted successfully' : 'Oops! Unable to delete gallery resource';
        return Redirect::back()->with('status', $response);
    }
}
