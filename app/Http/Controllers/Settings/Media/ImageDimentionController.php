<?php

namespace App\Http\Controllers\Settings\Media;

use App\Models\ImageDimention;
use Illuminate\Http\Request;

class ImageDimentionController
{

    /**
     * method for rendering image dimention page
     */
    public function index()
    {
        $dimention = ImageDimention::query()->latest()->first();
        return view('content.settings.media.image-dimention.index', compact('dimention'));
    }

    /**
     * method for update or create image dimention settings
     * @param Request $request
     */
    public function updateOrCreate(Request $request)
    {
        $valided = $request->validate(
            [
                'width' => 'required',
                'height' => 'required',
                'unit' => 'required'
            ]
        );

        $image_dimention = ImageDimention::updateOrCreate(
            ['id' => $request->id],
            [
                'width' => $request->width,
                'height' => $request->height,
                'unit' => $request->unit
            ]
        );

        return back()->with('status', 'Image Dimention update successfully');
    }
}
