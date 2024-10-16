<?php

namespace App\Http\Controllers\Merchant\Vehicle;

use App\Http\Controllers\Controller;
use App\Http\Handlers\Resolvers\Package\Vehicle\EngineHandler;
use App\Http\Requests\Package\Vehicle\StoreEngineRequest;
use App\Http\Requests\Package\Vehicle\UpdateEngineRequest;
use App\Models\Engine;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class EngineController extends Controller
{
    /**
     * Display a listing of the resource
     * @param  Request                  $request
     * @return Application|Factory|View
     */
    public function index(Request $request): View|Factory|Application
    {
        $collections = Engine::query()->with('translate')->get();
        return view('content.merchant.vehicle.engine.index', compact('collections'));
    }

    /**
     * Show the form for creating a new resource
     * @return Application|Factory|View
     */
    public function create(): View|Factory|Application
    {
        return view('content.merchant.vehicle.engine.create');
    }

    /**
     * Store a newly created resource in storage
     * @param  StoreEngineRequest $request
     * @param  EngineHandler      $handler
     * @return RedirectResponse
     */
    public function store(StoreEngineRequest $request, EngineHandler $handler): RedirectResponse
    {
        if ($request->validated()) {
            $isCreate = $handler->store($request);
            $response = $isCreate ? 'Congrats! Data is created successfully' : 'Oops! Unable to create a new engine';
            return Redirect::back()->with('status', $response);
        }
        return Redirect::back()->with('status', 'Oops! Something went wrong to create');
    }

    /**
     * Display the specified resource.
     */
    public function show(Engine $engine)
    {
        // TODO: Implement show() method
    }

    /**
     * Show the form for editing the specified resource
     * @param  Engine                   $engine
     * @return Application|Factory|View
     */
    public function edit(Engine $engine): View|Factory|Application
    {
        return view('content.merchant.vehicle.engine.update', compact('engine'));
    }

    /**
     * Update the specified resource in storage
     * @param  UpdateEngineRequest $request
     * @param  Engine              $engine
     * @param  EngineHandler       $handler
     * @return RedirectResponse
     * @noinspection PhpConditionAlreadyCheckedInspection
     */
    public function update(UpdateEngineRequest $request, Engine $engine, EngineHandler $handler): RedirectResponse
    {
        if ($request->validated()) {
            $isUpdate = $handler->adapt($request, $engine);
            $response = $isUpdate ? 'Congrats! Data is updated successfully' : 'Oops! Unable to update engine resource';
            return Redirect::back()->with('status', $response);
        }
        return Redirect::back()->with('status', 'Oops! Something went wrong to updated');
    }

    /**
     * Remove the specified resource from storage
     * @param  Engine           $engine
     * @param  EngineHandler    $handler
     * @return RedirectResponse
     */
    public function destroy(Engine $engine, EngineHandler $handler): RedirectResponse
    {
        $isDelete = $handler->erase($engine);
        $response = $isDelete ? 'Congrats! Data is deleted successfully' : 'Oops! Unable to delete engine resource';
        return Redirect::back()->with('status', $response);
    }
}
