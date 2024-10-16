<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreContactRequest;
use App\Http\Requests\Admin\UpdateContactRequest;
use App\Models\Contact;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource
     * @param  Request                  $request
     * @return Application|Factory|View
     */
    public function index(Request $request): View|Factory|Application
    {
        $collections = Contact::query()->latest()->paginate($request->perPage ?? 10);
        return view('content.admin.contact.index', compact('collections'));
    }

    /**
     * Show the form for creating a new resource
     * @return void
     */
    public function create(): void
    {
        // TODO: Implement create() method
    }

    /**
     * Store a newly created resource in storage
     * @param  StoreContactRequest $request
     * @return void
     */
    public function store(StoreContactRequest $request): void
    {
        // TODO: Implement store() method
    }

    /**
     * Display the specified resource
     * @param  Contact $contact
     * @return void
     */
    public function show(Contact $contact): void
    {
        // TODO: Implement show() method
    }

    /**
     * Show the form for editing the specified resource
     * @param  Contact $contact
     * @return void
     */
    public function edit(Contact $contact): void
    {
        // TODO: Implement edit() method
    }

    /**
     * Update the specified resource in storage
     * @param  UpdateContactRequest $request
     * @param  Contact              $contact
     * @return void
     */
    public function update(UpdateContactRequest $request, Contact $contact): void
    {
        // TODO: Implement update() method
    }

    /**
     * Remove the specified resource from storage
     * @param  Contact $contact
     * @return void
     */
    public function destroy(Contact $contact): void
    {
        // TODO: Implement destroy() method
    }
}
