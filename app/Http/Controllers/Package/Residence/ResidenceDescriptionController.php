<?php

namespace App\Http\Controllers\Package\Residence;

use App\Models\Residence;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\Factory;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Contracts\Console\Application;
use App\Http\Requests\Package\Vehicle\StoreDescriptionRequest;

class ResidenceDescriptionController extends Controller
{
    /**
     * Display a listing of the resource
     * @param  Vehicle                  $vehicle
     * @return Application|Factory|View
     */
    public function index(Residence $residence): View|Factory|Application
    {
        return view('content.package.residence.product.detail', compact('residence'));
    }

    /**
     * Store a newly created resource in storage
     * @param  Residence $residence
     * @param  StoreDescriptionRequest $request
     * @return RedirectResponse
     */
    public function store(Residence $residence, StoreDescriptionRequest $request): RedirectResponse
    {
        if ($request->validated()) {
            $isManage = collect($request->input('description'))->each(fn ($each, $lang) => $residence->description()->updateOrCreate(['local' => $lang], ['content' => $each, 'local' => $lang]));
            $response = $isManage ? 'Congrats! Data is processed successfully' : 'Oops! Unable to process record';
            return Redirect::route('admin.residence.product.gallery.index', ['residence' => $residence->getKey()])->with('status', $response);
        }
        return Redirect::back()->with('status', 'Oops! Something went wrong to create');
    }
}
