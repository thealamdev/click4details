<?php

namespace App\Http\Controllers\Package\Vehicle;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Handlers\Resolvers\Package\Vehicle\ModelHandler;
use App\Http\Requests\Package\Vehicle\StoreModelRequest;
use App\Http\Requests\Package\Vehicle\UpdateModelRequest;
use App\Models\Carmodel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Laravel\Telescope\Watchers\ViewWatcher;



class CarmodelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $collections = Carmodel::query()->with('translate')->orderBy('slug')->get();
        return view('content.package.vehicle.model.index',compact('collections'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        return view('content.package.vehicle.model.create');
    }

    

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreModelRequest $request, ModelHandler $handler):RedirectResponse
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
    public function show(Carmodel $condition): void
    {
        // TODO: Implement show() method
    }

    /**
     * Show the form for editing the specified resource
     * @param  Condition                $condition
     * @return Application|Factory|View
     */
    public function edit(Carmodel $model)
    {
        return view('content.package.vehicle.model.update', compact('model'));
    }

    /**
     * Update the specified resource in storage
     * @param  UpdateConditionRequest $request
     * @param  Condition              $condition
     * @param  ConditionHandler       $handler
     * @return RedirectResponse
     * @noinspection PhpConditionAlreadyCheckedInspection
     */
    public function update(UpdateModelRequest $request, Carmodel $model, ModelHandler $handler): RedirectResponse
    {
        if ($request->validated()) {
            $isUpdate = $handler->adapt($request, $model);
            $response = $isUpdate ? 'Congrats! Data is updated successfully' : 'Oops! Unable to update model resource';
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
    public function destroy(Carmodel $model, ModelHandler $handler): RedirectResponse
    {
        $isDelete = $handler->erase($model);
        $response = $isDelete ? 'Congrats! Data is deleted successfully' : 'Oops! Unable to delete model resource';
        return Redirect::back()->with('status', $response);
    }
}
