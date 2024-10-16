<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreClientRequest;
use App\Http\Requests\Admin\UpdateClientRequest;
use App\Models\Client;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource
     * @param  Request                  $request
     * @return Application|Factory|View
     */
    public function index(Request $request): View|Factory|Application
    {
        $collections = Client::query()->paginate($request->perPage ?? 10);
        return view('content.admin.client.index', compact('collections'));
    }

    /**
     * Show the form for creating a new resource
     * @return Application|Factory|View
     */
    public function create(): View|Factory|Application
    {
        return view('content.admin.client.create');
    }

    /**
     * Store a newly created resource in storage
     * @param  StoreClientRequest $request
     * @return void
     */
    public function store(StoreClientRequest $request): void
    {
        // TODO: Implement store() method
    }

    /**
     * Display the specified resource
     * @param  Client                   $client
     * @return Application|Factory|View
     */
    public function show(Client $client): View|Factory|Application
    {
        return view('content.admin.client.profile', compact('client'));
    }

    /**
     * Show the form for editing the specified resource
     * @param  Client                   $client
     * @return Application|Factory|View
     */
    public function edit(Client $client): View|Factory|Application
    {
        return view('content.admin.client.update', compact('client'));
    }

    /**
     * Update the specified resource in storage
     * @param  UpdateClientRequest $request
     * @param  Client              $client
     * @return void
     */
    public function update(UpdateClientRequest $request, Client $client): void
    {
        // TODO: Implement update() method
    }

    /**
     * Remove the specified resource from storage
     * @param  Client $client
     * @return void
     */
    public function destroy(Client $client): void
    {
        // TODO: Implement destroy() method
    }
}
