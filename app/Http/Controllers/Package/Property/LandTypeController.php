<?php

namespace App\Http\Controllers\Package\Property;
use App\Models\Type;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\Package\Property\StoreTypeRequest;
use App\Http\Requests\Package\Property\UpdateTypeRequest;
use App\Http\Handlers\Resolvers\Package\Property\TypeHandler;


class LandTypeController extends Controller
{
     

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $collections = Type::query()->with('translate')->paginate($request->perPage ?? 20);
        return view('content.package.property.type.index',compact('collections'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('content.package.property.type.create');
    }

    

    /**
     * Store a newly created resource in storage.
     */
    
    public function store(StoreTypeRequest $request, TypeHandler $handler):RedirectResponse
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
    public function show(Type $type): void
    {
        // TODO: Implement show() method
    }

    /**
     * Show the form for editing the specified resource
     * @param  Condition                $condition
     * @return Application|Factory|View
     */
    public function edit(Type $type)
    {
        return view('content.package.property.type.update', compact('type'));
    }

    /**
     * Update the specified resource in storage
     * @param  UpdateConditionRequest $request
     * @param  Condition              $condition
     * @param  ConditionHandler       $handler
     * @return RedirectResponse
     * @noinspection PhpConditionAlreadyCheckedInspection
     */
    public function update(UpdateTypeRequest $request, Type $type, TypeHandler $handler): RedirectResponse
    {
        if ($request->validated()) {
            $isUpdate = $handler->adapt($request, $type);
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
    public function destroy(Type $type, TypeHandler $handler): RedirectResponse
    {
        $isDelete = $handler->erase($type);
        $response = $isDelete ? 'Congrats! Data is deleted successfully' : 'Oops! Unable to delete model resource';
        return Redirect::back()->with('status', $response);
    }
}
