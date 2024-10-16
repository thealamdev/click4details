<?php

namespace App\Http\Controllers\Package\Vehicle;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Handlers\Resolvers\Package\Vehicle\ConditionHandler;
use App\Http\Requests\Package\Vehicle\StoreConditionRequest;
use App\Http\Requests\Package\Vehicle\UpdateConditionRequest;
use App\Models\Condition;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

class ConditionController extends Controller
{
    /**
     * Display a listing of the resource
     * @return Application|Factory|View
     */
    public function index(Request $request): View|Factory|Application
    {
        $collections = Condition::query()->with('translate')->orderBy('slug')->get();
        return view('content.package.vehicle.condition.index', compact('collections'));
    }

    /**
     * Show the form for creating a new resource
     * @return Application|Factory|View
     */
    public function create(): View|Factory|Application
    {
        return view('content.package.vehicle.condition.create');
    }

    /**
     * Store a newly created resource in storage
     * @param  StoreConditionRequest $request
     * @param  ConditionHandler      $handler
     * @return RedirectResponse
     */
    public function store(StoreConditionRequest $request, ConditionHandler $handler): RedirectResponse
    {
        if ($request->validated()) {
            $isCreate = $handler->store($request);
            $response = $isCreate ? 'Congrats! Data is created successfully' : 'Oops! Unable to create a new condition';
            return Redirect::back()->with('status', $response);
        }
        return Redirect::back()->with('status', 'Oops! Something went wrong to create');
    }

    /**
     * Display the specified resource
     * @param  Condition $condition
     * @return void
     */
    public function show(Condition $condition): void
    {
        // TODO: Implement show() method
    }

    /**
     * Show the form for editing the specified resource
     * @param  Condition                $condition
     * @return Application|Factory|View
     */
    public function edit(Condition $condition): View|Factory|Application
    {
        return view('content.package.vehicle.condition.update', compact('condition'));
    }

    /**
     * Update the specified resource in storage
     * @param  UpdateConditionRequest $request
     * @param  Condition              $condition
     * @param  ConditionHandler       $handler
     * @return RedirectResponse
     * @noinspection PhpConditionAlreadyCheckedInspection
     */
    public function update(UpdateConditionRequest $request, Condition $condition, ConditionHandler $handler): RedirectResponse
    {
        if ($request->validated()) {
            $isUpdate = $handler->adapt($request, $condition);
            $response = $isUpdate ? 'Congrats! Data is updated successfully' : 'Oops! Unable to update condition resource';
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
    public function destroy(Condition $condition, ConditionHandler $handler): RedirectResponse
    {
        $isDelete = $handler->erase($condition);
        $response = $isDelete ? 'Congrats! Data is deleted successfully' : 'Oops! Unable to delete condition resource';
        return Redirect::back()->with('status', $response);
    }
}
