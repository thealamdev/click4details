<?php

namespace App\Http\Controllers\Package\RentalServices\Category;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\RentalCategory;
use App\Http\Controllers\Controller;
use Illuminate\Console\View\Components\Factory;
use Illuminate\Contracts\Console\Application;
use Illuminate\Contracts\View\View;

class RentalCategoryController extends Controller
{
    /**
     * Define public function index
     * @return array|object
     */
    public function index()
    {
        $collections = RentalCategory::query()->get();
        return view('content.package.rental-services.category.index', compact('collections'));
    }

    /**
     * Define public method create
     * @return RedirectResponse
     */
    public function create(): View|Factory|Application
    {
        $links = routeLinkResource('home.rental.category');
        return view('content.package.rental-services.category.create', compact('links'));
    }

    /**
     * Define public store method to collect data
     * @param Request $request
     */
    public function store(Request $request)
    {
        $response = RentalCategory::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'link' => $request->link,
            'icon' => $request->icon,
            'status' => $request->status,
        ]);

        return back()->with('status', 'Rental Category has been added');
    }
}
