<?php

namespace App\Http\Controllers\Package\Property;
use App\Models\Priceunit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\Package\Property\StorePriceUnitRequest;
use App\Http\Requests\Package\Property\UpdatePriceUnitRequest;
use App\Http\Handlers\Resolvers\Package\Property\PriceUnitHandler;


class PriceunitController extends Controller
{
     

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $collections = Priceunit::query()->with('translate')->paginate($request->perPage ?? 20);
        return view('content.package.property.priceunit.index',compact('collections'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('content.package.property.priceunit.create');
    }

    

    /**
     * Store a newly created resource in storage.
     */
    
    public function store(StorePriceUnitRequest $request, PriceUnitHandler $handler):RedirectResponse
    {
        if ($request->validated()) {
            $isCreate = $handler->store($request);
            $response = $isCreate ? 'Congrats! Data is created successfully' : 'Oops! Unable to create a new edition';
            return Redirect::back()->with('status', $response);
        }
        return Redirect::back()->with('status', 'Oops! Something went wrong to create');
    }

    
    /**
     * Display the specified resource
     * @param  Condition $condition
     * @return void
     */
    public function show(Priceunit $price): void
    {
        // TODO: Implement show() method
    }

    /**
     * Show the form for editing the specified resource
     * @param  Condition                $condition
     * @return Application|Factory|View
     */
    public function edit(Priceunit $price)
    {
        return view('content.package.property.priceunit.update', compact('price'));
    }

    /**
     * Update the specified resource in storage
     * @param  UpdateConditionRequest $request
     * @param  Condition              $condition
     * @param  ConditionHandler       $handler
     * @return RedirectResponse
     * @noinspection PhpConditionAlreadyCheckedInspection
     */
    public function update(UpdatePriceUnitRequest $request, Priceunit $price, PriceUnitHandler $handler): RedirectResponse
    {
        if ($request->validated()) {
            $isUpdate = $handler->adapt($request, $price);
            $response = $isUpdate ? 'Congrats! Data is updated successfully' : 'Oops! Unable to update available resource';
            return Redirect::back()->with('status', $response);
        }
        return Redirect::back()->with('status', 'Oops! Something went wrong to updated');
    }

    /**
     * Remove the specified resource from storage
     * @param  Condition        $condition
     * @param  ConditionHandler $handler
     * @return RedirectResponse
     */
    public function destroy(Priceunit $price, PriceUnitHandler $handler): RedirectResponse
    {
        $isDelete = $handler->erase($price);
        $response = $isDelete ? 'Congrats! Data is deleted successfully' : 'Oops! Unable to delete model resource';
        return Redirect::back()->with('status', $response);
    }
}
