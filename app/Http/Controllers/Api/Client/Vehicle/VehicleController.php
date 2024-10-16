<?php

namespace App\Http\Controllers\Api\Client\Vehicle;

use App\Enums\Status;
use App\Models\Vehicle;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\VehicleFeatur;
use App\Traits\HttpResponses;
use App\Http\Controllers\Controller;

class VehicleController extends Controller
{
    use HttpResponses;
    /**
     * method for rendering all vehicles to clients(all users)
     */

    public function index()
    {
        $vehicles = Vehicle::query()->select('id', 'color_id', 'carmodel_id', 'slug', 'engine_number', 'brand_id', 'grade_id', 'edition_id', 'condition_id', 'chassis_number', 'video', 'transmission_id', 'engine_id', 'fuel_id', 'skeleton_id', 'available_id', 'mileage_id', 'purchase_price', 'fixed_price', 'price', 'mileages', 'engines', 'code', 'registration', 'manufacture')
            // ->with(['vehicle_feature' => function ($query) {
            //     $query->select('vehicle_id', 'featur_id', 'detail_id', 'edition_id')
            //         ->with(['feature' => function ($query) {
            //             $query->select('id', 'title');
            //         }])->with(['detail' => function ($query) {
            //             $query->select('id', 'title');
            //         }]);
            // }])
            ->with(['vehicle_feature' => function ($query) {
                $query->with(['feature', 'detail']);
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
     * Define public method features
     * @param Request $request
     * @param Vehicle $vehicle
     * @return array|object
     */
    public function features(Request $request, Vehicle $vehicle): array|object
    {
        $features = VehicleFeatur::query()
            ->where('vehicle_id', $vehicle->id)
            ->with(['feature' => function ($query) {
                $query->select('id', 'title');
            }])->with(['detail' => function ($query) {
                $query->select('id', 'title');
            }])

            ->get();
        return $this->success($features, '', 200);
    }

    /**
     * method for get specific vehicle details.
     * @param Vehicle $product
     * @return array|object|string|bool.
     */
    public function detail(Vehicle $product): array|object|string|bool
    {
        $vehicles = Vehicle::query()->select('id', 'slug', 'edition_id')
            ->with(['vehicle_feature' => function ($query) {
                $query->select('vehicle_id', 'featur_id', 'detail_id', 'edition_id')
                    ->with(['feature' => function ($query) {
                        $query->select('id', 'title');
                    }])->with(['detail' => function ($query) {
                        $query->select('id', 'title');
                    }]);
            }])
            ->where('id', $product->id)
            ->with('gallery', fn ($query) => $query->select(['id', 'gallery_id', 'name', 'path']))
            ->first();
        $route = route('home.detail', $product->slug);
        return $this->success($vehicles, $route, 200);
    }

    /**
     * method for searching vehicles.
     * @param Request $request
     * @return array|object
     */
    public function search(Request $request)
    {
        $vehicles = Vehicle::query()->select('id', 'slug', 'brand_id', 'carmodel_id', 'grade_id', 'edition_id', 'condition_id', 'transmission_id', 'engine_id', 'fuel_id', 'skeleton_id', 'available_id', 'mileage_id', 'purchase_price', 'fixed_price', 'price', 'mileages', 'engines', 'code', 'registration', 'manufacture')->where('slug', 'LIKE', '%' . Str::slug($request->search) . '%')
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
            ->with('carmodel', fn ($query) => $query->with('translate', fn ($query) => $query->select('translate_id', 'title'))->select(['id', 'slug']))
            ->with('grade', fn ($query) => $query->with('translate', fn ($query) => $query->select('translate_id', 'title'))->select(['id', 'slug']))
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
