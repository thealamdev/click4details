<?php

namespace App\Http\Controllers\Package\Residence;

use App\Facades\Upload;
use App\Models\Gallery;
use App\Models\Residence;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\Factory;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Contracts\Foundation\Application;
use App\Http\Requests\Package\Vehicle\StoreGalleryRequest;

class ResidenceGalleryController extends Controller
{
    /**
     * Display a listing of the resource
     * @param  Residence $residence
     * @return Application|Factory|View
     */
    public function index(Residence $residence): View|Factory|Application
    {
        return view('content.package.residence.product.gallery', compact('residence'));
    }

    /**
     * Define public method store()
     * @param Residence $residence
     * @param StoreGalleryRequest $request
     * @return RedirectResponse
     */
    public function store(Residence $residence, StoreGalleryRequest $request): RedirectResponse
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

            $isManage = $residence->gallery()->createMany($images);
            $response = $isManage ? 'Congrats! Data is uploaded successfully' : 'Oops! Unable to upload thumbnail';
            return Redirect::back()->with('status', $response);
        }

        return Redirect::back()->with('status', 'Oops! Something went wrong during upload');
    }

    /**
     * Remove the specified resource from storage
     * @param  Residence $residence
     * @param  Gallery $gallery
     * @return RedirectResponse
     */
    public function destroy(Residence $residence, Gallery $gallery): RedirectResponse
    {
        if (isset($residence->gallery) && !empty($residence->gallery)) {
            $gallery->recycle();
        }
        $isDelete = $gallery->delete();
        $response = $isDelete ? 'Congrats! Data is deleted successfully' : 'Oops! Unable to delete gallery resource';
        return Redirect::back()->with('status', $response);
    }
}
