<?php

namespace App\Http\Controllers\Package\Vehicle;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Laravel\Telescope\Watchers\ViewWatcher;
use App\Http\Requests\Package\Vehicle\StoreColorRequest;
use App\Http\Handlers\Resolvers\Package\Vehicle\ColorHandler;
use App\Http\Requests\Package\Vehicle\UpdateColorRequest;
use App\Models\Color;

class ColorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $collections = Color::query()->with('translate')->orderBy('slug')->get();
        return view('content.package.vehicle.color.index',compact('collections'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         
        return view('content.package.vehicle.color.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreColorRequest $request, ColorHandler $handler):RedirectResponse
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
    public function show(Color $condition): void
    {
        // TODO: Implement show() method
    }

    /**
     * Show the form for editing the specified resource
     * @param  Condition                $condition
     * @return Application|Factory|View
     */
    public function edit(Color $color)
    {
        return view('content.package.vehicle.color.update', compact('color'));
    }

    /**
     * Update the specified resource in storage
     * @param  UpdateConditionRequest $request
     * @param  Condition              $condition
     * @param  ConditionHandler       $handler
     * @return RedirectResponse
     * @noinspection PhpConditionAlreadyCheckedInspection
     */
    public function update(UpdateColorRequest $request, Color $color, ColorHandler $handler): RedirectResponse
    {
        if ($request->validated()) {
            $isUpdate = $handler->adapt($request, $color);
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
    public function destroy(Color $color, ColorHandler $handler): RedirectResponse
    {
        $isDelete = $handler->erase($color);
        $response = $isDelete ? 'Congrats! Data is deleted successfully' : 'Oops! Unable to delete model resource';
        return Redirect::back()->with('status', $response);
    }
}
