<?php

namespace App\Http\Controllers\Api\Merchant\Vehicle;

use App\Enums\Status;
use App\Models\Vehicle;
use App\Models\Available;
use App\Models\Statement;
use App\Enums\Publication;
use Illuminate\Support\Str;
use App\Models\Availability;
use Illuminate\Http\Request;
use App\Models\VehicleFeatur;
use App\Traits\HttpResponses;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\EntityProduct;
use App\Http\Resources\VehicleResource;
use App\Http\Resources\EntityProductResource;
use App\Http\Resources\VehicleProductResource;
use App\Http\Requests\Package\Vehicle\StoreVehicleRequest;
use App\Http\Requests\Package\Vehicle\UpdateVehicleRequest;
use App\Http\Handlers\Resolvers\Package\Vehicle\VehicleHandler;

class VehicleController extends Controller
{
    use HttpResponses;

    /**
     * Define public property $limitPerPage 
     * @var int
     */
    public ?int $limitPerPage = 10;

    /**
     * method for get merchants vehicles.
     * @param Request $request
     * @return array|object
     */
    public function index(Request $request): array|object
    {
        $merchantId = $request->user()->id;
        $vehicles = Vehicle::query()
            ->where('user_id', $merchantId)
            ->select('id', 'title', 'slug', 'priority', 'color_id', 'user_id', 'sketch_id', 'slug', 'brand_id', 'grade_id', 'edition_id', 'condition_id',  'code', 'video', 'transmission_id', 'fuel_id', 'skeleton_id', 'availability_id')
            ->with('statement', fn($query) => $query->select(['id', 'product_id', 'capacity', 'mileage', 'registration', 'manufacture', 'engine', 'chassis']))
            ->with('price', fn($query) => $query->select(['id', 'product_id', 'asking', 'purchase', 'fixed', 'additional', 'total', 'currency']))
            ->with('brand', fn($query) => $query->select(['id', 'title']))
            ->with('sketch', fn($query) => $query->select(['id', 'title']))
            ->with('fuel', fn($query) => $query->select(['id', 'title']))
            ->with('grade', fn($query) => $query->select(['id', 'title']))
            ->with('color', fn($query) => $query->select(['id', 'title']))
            ->with('edition', fn($query) => $query->select(['id', 'title']))
            ->with('skeleton', fn($query) => $query->select(['id', 'title']))
            ->with('condition', fn($query) => $query->select(['id', 'title']))
            ->with('availability', fn($query) => $query->select(['id', 'title']))
            ->with('transmission', fn($query) => $query->select(['id', 'title']))
            ->where('publication', '=', Publication::APPROVED)
            ->orderBy('priority', 'desc')
            ->paginate(10);
        $vehicle_resource = VehicleProductResource::collection(($vehicles))->response()->getData(true);
        return $this->success($vehicle_resource, '', 200);
    }

    public function features(Request $request, Vehicle $vehicle): array|object
    {
        // $features = VehicleFeatur::query()
        //     ->where('vehicle_id', $vehicle->id)
        //     ->with(['feature' => function ($query) {
        //         $query->select('id', 'title');
        //     }])->with(['detail' => function ($query) {
        //         $query->select('id', 'title');
        //     }])
        //     ->get();

        $entity_product = Vehicle::query()
            ->with('entities', fn($query) => $query->with('feature'))
            ->where('id', $vehicle->id)
            ->get();

        $entity_product_resource = EntityProductResource::collection($entity_product);
        return $this->success($entity_product_resource, '', 200);
        // return $this->success($entity_product, '', 200);
    }

    /**
     * method for searching vehicles.
     * @param Request $request
     * @return array|object
     */
    public function search(Request $request): array|object
    {
        $vehicles = Vehicle::query()->select('id', 'merchant_id', 'color_id', 'slug', 'brand_id', 'edition_id', 'condition_id', 'transmission_id', 'engine_id', 'fuel_id', 'skeleton_id', 'available_id', 'mileage_id', 'grade_id', 'purchase_price', 'fixed_price', 'price', 'mileages', 'engines', 'code', 'registration', 'carmodel_id', 'manufacture', 'engine_number', 'chassis_number')->where('merchant_id', $request->user()->id)->where('slug', 'LIKE', '%' . Str::slug($request->search) . '%')
            ->orWhere('code', 'LIKE', '%' . Str::slug($request->search) . '%')
            ->with(['vehicle_feature' => function ($query) {
                $query->select('vehicle_id', 'featur_id', 'detail_id', 'edition_id')
                    ->with(['feature' => function ($query) {
                        $query->select('id', 'title');
                    }])->with(['detail' => function ($query) {
                        $query->select('id', 'title');
                    }]);
            }])
            ->with('image', fn($query) => $query->select(['id', 'image_id', 'name', 'path']))
            ->with('merchant', fn($query) => $query->select(['id', 'name']))
            ->with('translate', fn($query) => $query->select(['translate_id', 'title']))
            ->with('brand', fn($query) => $query->with('translate', fn($query) => $query->select('translate_id', 'title'))->select(['id', 'slug']))
            ->with('color', fn($query) => $query->with('translate', fn($query) => $query->select('translate_id', 'title'))->select(['id', 'slug']))
            ->with('grade', fn($query) => $query->with('translate', fn($query) => $query->select('translate_id', 'title'))->select(['id', 'slug']))
            ->with('carmodel', fn($query) => $query->with('translate', fn($query) => $query->select('translate_id', 'title'))->select(['id', 'slug']))
            ->with('edition', fn($query) => $query->with('translate', fn($query) => $query->select('translate_id', 'title'))->select(['id', 'slug']))
            ->with('condition', fn($query) => $query->with('translate', fn($query) => $query->select('translate_id', 'title'))->select(['id', 'slug']))
            ->with('transmission', fn($query) => $query->with('translate', fn($query) => $query->select('translate_id', 'title'))->select(['id', 'slug']))
            ->with('engine', fn($query) => $query->with('translate', fn($query) => $query->select('translate_id', 'title'))->select(['id', 'slug']))
            ->with('fuel', fn($query) => $query->with('translate', fn($query) => $query->select('translate_id', 'title'))->select(['id', 'slug']))
            ->with('skeleton', fn($query) => $query->with('translate', fn($query) => $query->select('translate_id', 'title'))->select(['id', 'slug']))
            ->with('available', fn($query) => $query->with('translate', fn($query) => $query->select('translate_id', 'title'))->select(['id', 'slug']))
            ->with('mileage', fn($query) => $query->with('translate', fn($query) => $query->select('translate_id', 'title'))->select(['id', 'slug']))
            ->paginate(20);
        return $this->success($vehicles, '', 200);
    }

    /**
     * method for store the vehicles.
     * @param StoreVehicleRequest $request
     * @param VehicleHandler $handler
     * @return array|object|null|bool
     */
    public function store(StoreVehicleRequest $request, VehicleHandler $handler): array|object|null|bool
    {
        if ($request->validated()) {
            $isCreate = $handler->store($request);
            $response = ['id' => $isCreate->getKey()];
            return $this->success($response, '', 200);
        }
        return false;
    }

    /**
     * method for get all the availables
     * @return array|object
     */
    public function availables(): array|object
    {
        $availables = Availability::query()->with('translate')->get();
        return $this->success($availables, '', 200);
    }

    /**
     * method for get all the brands
     * @return array|object
     */
    public function brands(): array|object
    {
        $availables = Availability::query()->with('translate')->get();
        return $this->success($availables, '', 200);
    }

    /**
     * method for update all fields.
     * @param Request $request 
     * @param Vehicle $product
     * @return array|object|string|bool
     */
    public function update(UpdateVehicleRequest $request, Vehicle $product, VehicleHandler $handler): array|object|string|bool
    {
        $isUpdate = $handler->adapt($request, $product);
        $response = ['id' => $isUpdate->getKey()];
        return $this->success($response, '', 200);
    }

    /**
     * method for partial edit vehicle information.
     * @param Request $request
     * @param Vehicle $product
     * @return array|object;
     */
    public function priceUpdate(Request $request, Vehicle $product): array|object
    {
        $product->update([
            'purchase_price' => $request->purchase_price,
            'fixed_price' => $request->fixed_price,
            'price' => $request->price,
        ]);

        return $this->success('', 'Purchase price update successfully', 200);
    }

    /**
     * method for update vehicle available just to booked.
     * @param Vehicle $product
     * @return array|object|string|bool.
     */
    public function bookedUpdate(Vehicle $product): array|object|string|bool
    {
        $product->update([
            'available_id' => 20
        ]);

        return $this->success('', 'Available update to booked', 200);
    }

    /**
     * method for update vehicle available just to sold.
     * @param Vehicle $product
     * @return array|object|string|bool.
     */
    public function soldUpdate(Vehicle $product): array|object|string|bool
    {
        $product->update([
            'available_id' => 22
        ]);

        return $this->success('', 'Available update to sold', 200);
    }

    /**
     * method for update availables
     * @param Request $request
     * @param Vehicle $product
     * @return array|object|string|bool
     */
    public function availableUpdate(Request $request, Vehicle $product): array|object|string|bool
    {
        $available = $product->update(['available_id' => $request->available_id]);
        return $this->success('', 'Available update successfully', 200);
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
            ->with('gallery', fn($query) => $query->select(['id', 'gallery_id', 'name', 'path']))
            ->first();
        // $route = route('home.detail', $product->slug);
        $route = route('merchant.view', ['product' => $product->slug]);
        return $this->success($vehicles, $route, 200);
    }

    /**
     * method for create stocklist.
     * @param Request $request
     * @return array|object
     */
    public function stocklist(Request $request): array|object
    {
        $vehicles = Vehicle::query()->select('id', 'slug', 'mileage_id', 'engine_id', 'available_id', 'carmodel_id', 'engine_number', 'price', 'purchase_price', 'fixed_price', 'chassis_number', 'brand_id', 'grade_id', 'edition_id', 'condition_id', 'transmission_id', 'fuel_id', 'skeleton_id', 'mileages', 'engines', 'manufacture', 'registration')
            ->where('merchant_id', $request->user()->id)
            ->with('translate', fn($query) => $query->select('translate_id', 'title'))
            ->with('brand', fn($query) => $query->with('translate', fn($query) => $query->select('translate_id', 'title'))->select(['id',]))
            ->with('available', fn($query) => $query->with('translate', fn($query) => $query->select('translate_id', 'title'))->select(['id',]))
            ->with('grade', fn($query) => $query->with('translate', fn($query) => $query->select('translate_id', 'title'))->select(['id',]))
            ->with('carmodel', fn($query) => $query->with('translate', fn($query) => $query->select('translate_id', 'title'))->select(['id',]))
            ->with('edition', fn($query) => $query->with('translate', fn($query) => $query->select('translate_id', 'title'))->select(['id']))
            ->with('condition', fn($query) => $query->with('translate', fn($query) => $query->select('translate_id', 'title'))->select(['id']))
            ->with('transmission', fn($query) => $query->with('translate', fn($query) => $query->select('translate_id', 'title'))->select(['id']))
            ->with('fuel', fn($query) => $query->with('translate', fn($query) => $query->select('translate_id', 'title'))->select(['id']))
            ->with('skeleton', fn($query) => $query->with('translate', fn($query) => $query->select('translate_id', 'title'))->select(['id']))
            ->with('mileage', fn($query) => $query->with('translate', fn($query) => $query->select('translate_id', 'title'))->select(['id']))
            ->with('engine', fn($query) => $query->with('translate', fn($query) => $query->select('translate_id', 'title'))->select(['id']))
            ->where('is_approved', '=', Status::ACTIVE->toString())
            ->get();

        foreach ($vehicles as $vehicle) {
            $vehicle['link'] = route('merchant.view', ['product' => $vehicle->slug]);
        }

        return $this->success($vehicles, '', 200);
    }

    /**
     * method for delete vehicle.
     * @param Vehicle $product
     * @return array|object
     */
    public function destroy(Vehicle $product): array|object
    {
        $product->delete();
        return $this->success('', 'Vehicle delete successfully', 200);
    }
}
