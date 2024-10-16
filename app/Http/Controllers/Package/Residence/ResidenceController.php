<?php

namespace App\Http\Controllers\Package\Residence;

use App\Enums\Status;
use App\Models\Merchant;
use App\Models\Residence;
use Illuminate\Http\Request;
use App\Models\FurnishedStatus;
use App\Models\ApartmentComplex;
use App\Models\CompletionStatus;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\Factory;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Contracts\Console\Application;
use App\Http\Requests\Package\Residence\StoreResidenceRequest;
use App\Http\Requests\Package\Residence\UpdateResidenceRequest;
use App\Http\Handlers\Resolvers\Package\Residence\ResidenceHandler;

class ResidenceController extends Controller
{
    /**
     * Display a listing of the resource
     * @param  Request $request
     * @return void
     */
    public function index(Request $request)
    {
        $collections = Residence::query()->get();
        return view('content.package.residence.product.index', compact('collections'));
    }

    /**
     * Define a public method create()
     * @return View|Factory|Application
     */
    public function create(): View|Factory|Application
    {
        $merchants = Merchant::query()->get();
        $completion_status = CompletionStatus::query()->where('status', Status::ACTIVE->toString())->get();
        $furnished_status = FurnishedStatus::query()->where('status', Status::ACTIVE->toString())->get();
        $apartment_complex = ApartmentComplex::query()->where('status', Status::ACTIVE->toString())->get();
        return view('content.package.residence.product.create', compact('merchants', 'completion_status', 'furnished_status', 'apartment_complex'));
    }

    /**
     * Define a public function store() to store the data
     * @param StoreResidenceRequest $request
     */
    public function store(StoreResidenceRequest $request, ResidenceHandler $handler)
    {
        if ($request->validated()) {
            $isCreate = $handler->store($request);
            $response = $isCreate ? 'Congrats! Data is created successfully' : 'Oops! Unable to create a new edition';
            return Redirect::route('admin.residence.product.description.index', ['residence' => $isCreate->getKey()])->with('status', $response);
        }
        return Redirect::back()->with('status', 'Oops! Something went wrong to create');
    }

    /**
     * Define public method edit()
     * @param Residence $residence
     * @return View|Factory|Application
     */
    public function edit(Residence $residence): View|Factory|Application
    {
        $merchants = Merchant::query()->get();
        $completion_status = CompletionStatus::query()->where('status', Status::ACTIVE->toString())->get();
        $furnished_status = FurnishedStatus::query()->where('status', Status::ACTIVE->toString())->get();
        $apartment_complex = ApartmentComplex::query()->where('status', Status::ACTIVE->toString())->get();
        return view('content.package.residence.product.edit', compact('residence', 'merchants', 'completion_status', 'furnished_status', 'apartment_complex'));
    }

    /**
     * Define public method update()
     */
    public function update(Residence $residence, UpdateResidenceRequest $request, ResidenceHandler $handler)
    {
        if ($request->validated()) {
            $isUpdate = $handler->adapt($request, $residence);
            $response = $isUpdate ? 'Congrats! Data is created successfully' : 'Oops! Unable to create a record';
            return Redirect::route('admin.residence.product.description.index', ['residence' => $residence->getKey()])->with('status', $response);
        }
        return Redirect::back()->with('status', 'Oops! Something went wrong to create');
    }

    /**
     * Remove the specified resource from storage
     * @param Residence $residence
     * @param ResidenceHandler   $handler
     * @return RedirectResponse
     */
    public function destroy(Residence $residence, ResidenceHandler $handler): RedirectResponse
    {
        $isDelete = $handler->erase($residence);
        $response = $isDelete ? 'Congrats! Data is deleted successfully' : 'Oops! Unable to delete vehicle resource';
        return Redirect::back()->with('status', $response);
    }
}
