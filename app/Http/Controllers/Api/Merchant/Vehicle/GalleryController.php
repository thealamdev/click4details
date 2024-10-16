<?php

namespace App\Http\Controllers\Api\Merchant\Vehicle;

use App\Facades\Upload;
use App\Models\Vehicle;
use App\Traits\HttpResponses;
use App\Http\Requests\Package\Vehicle\StoreGalleryRequest;

class GalleryController
{
    use HttpResponses;
    /**
     * method for upload images in database & folder 
     * @param Vehicle $vehicle
     * @param StoreGalleryRequest $request
     */
    public function store(Vehicle $vehicle, StoreGalleryRequest $request)
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

            $isManage = $vehicle->gallery()->createMany($images);
            $response = $isManage ? 'Congrats! Data is uploaded successfully' : 'Oops! Unable to upload thumbnail';
            return $this->success($response, '', 200);
        }
    }
}
