<?php

namespace App\Http\Controllers\Package\Property;

use App\Enums\Bucket;
use App\Facades\Upload;
use App\Models\Gallery;
use App\Models\Vehicle;
use Illuminate\Http\Request;

use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

use Illuminate\Contracts\View\Factory;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Contracts\Foundation\Application;
use App\Http\Requests\Package\Vehicle\StoreGalleryRequest;
use App\Http\Requests\Package\Vehicle\UpdateGalleryRequest;
use App\Models\Property;

class PropertyGallaryController extends Controller
{
    /**
     * Display a listing of the resource
     * @param  Vehicle                  $vehicle
     * @return Application|Factory|View
     */
    public function index(Property $property): View|Factory|Application
    {
        return view('content.package.property.product.gallery',compact('property'));
    }

    
    /**
     * Show the form for creating a new resource
     * @param  Vehicle $vehicle
     * @return void
     */
    public function create(Vehicle $vehicle): void
    {
        // TODO: Implement create() method
    }

    /**
     * Store a newly created resource in storage
     * @param  Vehicle             $vehicle
     * @param  StoreGalleryRequest $request
     * @return RedirectResponse
     */
    // public function store(Vehicle $vehicle, StoreGalleryRequest $request): RedirectResponse
    // {
    //     if ($request->validated()) {
    //         $isUpload = Upload::local()->store($request, Bucket::GALLERY);
    //         $isManage = $vehicle->gallery()->create($isUpload);
    //         $response = $isManage ? 'Congrats! Data is uploaded successfully' : 'Oops! Unable to upload thumbnail';
    //         Redirect::back()->with('status', $response);
    //     }
    //     return Redirect::back()->with('status', 'Oops! Something went wrong to upload');
    // }


    

    public function store(Property $property, StoreGalleryRequest $request): RedirectResponse
    {
        if ($request->validated()) {
            $images = [];

            // Check if images were uploaded
            if ($request->hasFile('image')) {
                foreach ($request->file('image') as $file) {
                    $isUpload = Upload::local()->storeImage($file); // Use the storeImage() method

                    // If the image upload is successful, save the file information to the $images array
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

            // Create the gallery records
            $isManage = $property->gallery()->createMany($images);

            $response = $isManage ? 'Congrats! Data is uploaded successfully' : 'Oops! Unable to upload thumbnail';
            return Redirect::back()->with('status', $response);
        }

        return Redirect::back()->with('status', 'Oops! Something went wrong during upload');
    }


    


    /**
     * Display the specified resource
     * @param  Vehicle $vehicle
     * @param  Gallery $gallery
     * @return void
     */
    public function show(Property $property, Gallery $gallery): void
    {
        // TODO: Implement show() method
    }

    /**
     * Show the form for editing the specified resource
     * @param  Property $property
     * @param  Gallery $gallery
     * @return void
     */
    public function edit(Property $property, Gallery $gallery): void
    {
        // TODO: Implement edit() method
    }

    /**
     * Update the specified resource in storage
     * @param  Vehicle              $vehicle
     * @param  UpdateGalleryRequest $request
     * @param  Gallery              $gallery
     * @return void
     */
    public function update(Property $property, UpdateGalleryRequest $request, Gallery $gallery): void
    {
        // TODO: Implement update() method
    }

    /**
     * Remove the specified resource from storage
     * @param  Vehicle          $vehicle
     * @param  Gallery          $gallery
     * @return RedirectResponse
     */
    public function destroy(Property $property, Gallery $gallery): RedirectResponse
    {
        if (isset($property->gallery) && !empty($property->gallery)) {
            $gallery->recycle();
        }
        $isDelete = $gallery->delete();
        $response = $isDelete ? 'Congrats! Data is deleted successfully' : 'Oops! Unable to delete gallery resource';
        return Redirect::back()->with('status', $response);
    }
}
