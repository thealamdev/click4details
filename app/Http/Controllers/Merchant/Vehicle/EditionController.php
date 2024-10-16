<?php

namespace App\Http\Controllers\Merchant\Vehicle;

use App\Models\Edition;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\Factory;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Contracts\Foundation\Application;
use App\Http\Requests\Package\Vehicle\StoreEditionRequest;
use App\Http\Requests\Package\Vehicle\UpdateEditionRequest;
use App\Http\Handlers\Resolvers\Package\Vehicle\EditionHandler;

class EditionController extends Controller
{
    /**
     * Display a listing of the resource
     * @param  Request                  $request
     * @return Application|Factory|View
     */
    public function index(Request $request): View|Factory|Application
    {
        $collections = Edition::query()->with('translate')->get();
        return view('content.merchant.vehicle.edition.index', compact('collections'));
    }

    /**
     * Show the form for creating a new resource
     * @return Application|Factory|View
     */
    public function create(): View|Factory|Application
    {
        return view('content.merchant.vehicle.edition.create');
    }

    /**
     * Store a newly created resource in storage
     * @param  StoreEditionRequest $request
     * @param  EditionHandler      $handler
     * @return RedirectResponse
     */
    public function store(StoreEditionRequest $request, EditionHandler $handler): RedirectResponse
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
     * @param  Edition $edition
     * @return void
     */
    public function show(Edition $edition): void
    {
        // TODO: Implement show() method
    }

    /**
     * Show the form for editing the specified resource
     * @param  Edition                  $edition
     * @return Application|Factory|View
     */
    public function edit(Edition $edition): View|Factory|Application
    {
        return view('content.merchant.vehicle.edition.update', compact('edition'));
    }

    /**
     * Update the specified resource in storage
     * @param  UpdateEditionRequest $request
     * @param  Edition              $edition
     * @param  EditionHandler       $handler
     * @return RedirectResponse
     * @noinspection PhpConditionAlreadyCheckedInspection
     */
    public function update(UpdateEditionRequest $request, Edition $edition, EditionHandler $handler): RedirectResponse
    {
        if ($request->validated()) {
            $isUpdate = $handler->adapt($request, $edition);
            $response = $isUpdate ? 'Congrats! Data is updated successfully' : 'Oops! Unable to update edition resource';
            return Redirect::back()->with('status', $response);
        }
        return Redirect::back()->with('status', 'Oops! Something went wrong to updated');
    }

    /**
     * Remove the specified resource from storage
     * @param  Edition          $edition
     * @param  EditionHandler   $handler
     * @return RedirectResponse
     */
    public function destroy(Edition $edition, EditionHandler $handler): RedirectResponse
    {
        $isDelete = $handler->erase($edition);
        $response = $isDelete ? 'Congrats! Data is deleted successfully' : 'Oops! Unable to delete edition resource';
        return Redirect::back()->with('status', $response);
    }
}
