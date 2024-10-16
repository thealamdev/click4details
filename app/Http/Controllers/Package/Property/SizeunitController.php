<?php

namespace App\Http\Controllers\Package\Property;
use App\Models\Sizeunit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\Package\Property\StoreSizeUnitRequest;
use App\Http\Requests\Package\Property\UpdateSizeUnitRequest;
use App\Http\Handlers\Resolvers\Package\Property\SizeUnitHandler;


class SizeunitController extends Controller
{
     

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $collections = Sizeunit::query()->with('translate')->paginate($request->perPage ?? 20);
        return view('content.package.property.sizeunit.index',compact('collections'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('content.package.property.sizeunit.create');
    }

    

    /**
     * Store a newly created resource in storage.
     */
    
    public function store(StoreSizeUnitRequest $request, SizeUnitHandler $handler):RedirectResponse
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
    public function show(Sizeunit $size): void
    {
        // TODO: Implement show() method
    }

    /**
     * Show the form for editing the specified resource
     * @param  Condition                $condition
     * @return Application|Factory|View
     */
    public function edit(Sizeunit $size)
    {
        return view('content.package.property.sizeunit.update', compact('size'));
    }

    /**
     * Update the specified resource in storage
     * @param  UpdateConditionRequest $request
     * @param  Condition              $condition
     * @param  ConditionHandler       $handler
     * @return RedirectResponse
     * @noinspection PhpConditionAlreadyCheckedInspection
     */
    public function update(UpdateSizeUnitRequest $request, Sizeunit $size, SizeUnitHandler $handler): RedirectResponse
    {
        if ($request->validated()) {
            $isUpdate = $handler->adapt($request, $size);
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
    public function destroy(Sizeunit $size, SizeUnitHandler $handler): RedirectResponse
    {
        $isDelete = $handler->erase($size);
        $response = $isDelete ? 'Congrats! Data is deleted successfully' : 'Oops! Unable to delete model resource';
        return Redirect::back()->with('status', $response);
    }
}
