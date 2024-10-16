<?php

namespace App\Http\Controllers\Api\CustomerCare\Vehicle;

use App\Enums\Status;
use App\Models\Vehicle;
use Illuminate\Support\Str;
use App\Models\CustomerCare;
use Illuminate\Http\Request;
use App\Traits\HttpResponses;


class VehicleController
{
    use HttpResponses;

    /**
     * method for get customer care parent vehicles.
     * @param Request $request
     */
    public function index(Request $request)
    {
        $merchantId = $request->user()->parent_id;
        $vehicles = Vehicle::query()->select('id', 'color_id', 'merchant_id', 'carmodel_id', 'slug', 'engine_number', 'brand_id', 'grade_id', 'edition_id', 'condition_id', 'chassis_number', 'video', 'transmission_id', 'engine_id', 'fuel_id', 'skeleton_id', 'available_id', 'mileage_id', 'purchase_price', 'fixed_price', 'price', 'mileages', 'engines', 'code', 'registration', 'manufacture')
            ->where('merchant_id', $merchantId)
            ->with(['vehicle_feature' => function ($query) {
                $query->select('vehicle_id', 'featur_id', 'detail_id', 'edition_id')
                    ->with(['feature' => function ($query) {
                        $query->select('id', 'title');
                    }])->with(['detail' => function ($query) {
                        $query->select('id', 'title');
                    }]);
            }])
            ->with('image', fn ($query) => $query->select('id', 'image_id', 'name', 'path'))
            ->with('translate', fn ($query) => $query->select(['translate_id', 'title']))
            ->with('merchant', fn ($query) => $query->select(['id', 'name']))
            ->with('brand', fn ($query) => $query->with('translate', fn ($query) => $query->select('translate_id', 'title'))->select(['id', 'slug']))
            ->with('carmodel', fn ($query) => $query->with('translate', fn ($query) => $query->select('translate_id', 'title'))->select(['id', 'slug']))
            ->with('color', fn ($query) => $query->with('translate', fn ($query) => $query->select('translate_id', 'title'))->select(['id', 'slug']))
            ->with('edition', fn ($query) => $query->with('translate', fn ($query) => $query->select('translate_id', 'title'))->select(['id', 'slug']))
            ->with('condition', fn ($query) => $query->with('translate', fn ($query) => $query->select('translate_id', 'title'))->select(['id', 'slug']))
            ->with('transmission', fn ($query) => $query->with('translate', fn ($query) => $query->select('translate_id', 'title'))->select(['id', 'slug']))
            ->with('engine', fn ($query) => $query->with('translate', fn ($query) => $query->select('translate_id', 'title'))->select(['id', 'slug']))
            ->with('grade', fn ($query) => $query->with('translate', fn ($query) => $query->select('translate_id', 'title'))->select(['id', 'slug']))
            ->with('fuel', fn ($query) => $query->with('translate', fn ($query) => $query->select('translate_id', 'title'))->select(['id', 'slug']))
            ->with('skeleton', fn ($query) => $query->with('translate', fn ($query) => $query->select('translate_id', 'title'))->select(['id', 'slug']))
            ->with('available', fn ($query) => $query->with('translate', fn ($query) => $query->select('translate_id', 'title'))->select(['id', 'slug']))
            ->with('mileage', fn ($query) => $query->with('translate', fn ($query) => $query->select('translate_id', 'title'))->select(['id', 'slug']))
            ->where('is_approved', '=', Status::ACTIVE->toString())
            ->paginate(10);
        return $this->success($vehicles, '', 200);
    }

    /**
     * method for searching vehicles.
     * @param Request $request
     * @return array|object
     */
    public function search(Request $request): array|object
    {
        $merchantId = $request->user()->parent_id;
        $vehicles = Vehicle::query()->select('id', 'merchant_id', 'grade_id','color_id', 'carmodel_id', 'manufacture', 'slug', 'brand_id', 'edition_id', 'condition_id', 'transmission_id', 'engine_id', 'fuel_id', 'skeleton_id', 'available_id', 'mileage_id', 'purchase_price', 'fixed_price', 'price', 'mileages', 'engines', 'code', 'registration','engine_number','chassis_number')
            ->where('merchant_id', $merchantId)
            ->where('slug', 'LIKE', '%' . Str::slug($request->search) . '%')
            ->orWhere('code', 'LIKE', '%' . Str::slug($request->search) . '%')
            ->with(['vehicle_feature' => function ($query) {
                $query->select('vehicle_id', 'featur_id', 'detail_id', 'edition_id')
                    ->with(['feature' => function ($query) {
                        $query->select('id', 'title');
                    }])->with(['detail' => function ($query) {
                        $query->select('id', 'title');
                    }]);
            }])
            ->with('image', fn ($query) => $query->select(['id', 'image_id', 'name', 'path']))
            ->with('merchant', fn ($query) => $query->select(['id', 'name']))
            ->with('translate', fn ($query) => $query->select(['translate_id', 'title']))
            ->with('brand', fn ($query) => $query->with('translate', fn ($query) => $query->select('translate_id', 'title'))->select(['id', 'slug']))
            ->with('color', fn ($query) => $query->with('translate', fn ($query) => $query->select('translate_id', 'title'))->select(['id', 'slug']))
            ->with('grade', fn ($query) => $query->with('translate', fn ($query) => $query->select('translate_id', 'title'))->select(['id', 'slug']))
            ->with('carmodel', fn ($query) => $query->with('translate', fn ($query) => $query->select('translate_id', 'title'))->select(['id', 'slug']))
            ->with('edition', fn ($query) => $query->with('translate', fn ($query) => $query->select('translate_id', 'title'))->select(['id', 'slug']))
            ->with('condition', fn ($query) => $query->with('translate', fn ($query) => $query->select('translate_id', 'title'))->select(['id', 'slug']))
            ->with('transmission', fn ($query) => $query->with('translate', fn ($query) => $query->select('translate_id', 'title'))->select(['id', 'slug']))
            ->with('engine', fn ($query) => $query->with('translate', fn ($query) => $query->select('translate_id', 'title'))->select(['id', 'slug']))
            ->with('fuel', fn ($query) => $query->with('translate', fn ($query) => $query->select('translate_id', 'title'))->select(['id', 'slug']))
            ->with('skeleton', fn ($query) => $query->with('translate', fn ($query) => $query->select('translate_id', 'title'))->select(['id', 'slug']))
            ->with('available', fn ($query) => $query->with('translate', fn ($query) => $query->select('translate_id', 'title'))->select(['id', 'slug']))
            ->with('mileage', fn ($query) => $query->with('translate', fn ($query) => $query->select('translate_id', 'title'))->select(['id', 'slug']))
            ->paginate(20);
        return $this->success($vehicles, '', 200);
    }
}
