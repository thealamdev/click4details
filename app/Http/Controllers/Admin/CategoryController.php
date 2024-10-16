<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Handlers\Resolvers\Admin\CategoryHandler;
use App\Http\Requests\Admin\StoreCategoryRequest;
use App\Http\Requests\Admin\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource
     * @param  Request                  $request
     * @return Application|Factory|View
     */
    public function index(Request $request): View|Factory|Application
    {
        $collections = Category::query()->withCount('merchant')->with('translate')->paginate($request->perPage ?? 10);
        return view('content.admin.category.index', compact('collections'));
    }

    /**
     * Show the form for creating a new resource
     * @return Application|Factory|View
     */
    public function create(): View|Factory|Application
    {
        $links = routeLinkResource('home');
        return view('content.admin.category.create', compact('links'));
    }

    /**
     * Store a newly created resource in storage
     * @param  StoreCategoryRequest $request
     * @param  CategoryHandler      $handler
     * @return RedirectResponse
     */
    public function store(StoreCategoryRequest $request, CategoryHandler $handler): RedirectResponse
    {
        if ($request->validated()) {
            $isCreate = $handler->store($request);
            $response = $isCreate ? 'Congrats! Category resource is created successfully' : 'Oops! Unable to create a new category';
            return Redirect::back()->with('status', $response);
        }
        return Redirect::back()->with('status', 'Oops! Something went wrong to update');
    }

    /**
     * Display the specified resource
     * @param  Category $category
     * @return void
     */
    public function show(Category $category): void
    {
        // TODO: Implement show() method
    }

    /**
     * Show the form for editing the specified resource
     * @param  Category                 $category
     * @return Application|Factory|View
     */
    public function edit(Category $category): View|Factory|Application
    {
        $links = routeLinkResource('home');
        return view('content.admin.category.update', compact('category', 'links'));
    }

    /**
     * Update the specified resource in storage
     * @param  UpdateCategoryRequest $request
     * @param  Category              $category
     * @param  CategoryHandler       $handler
     * @return RedirectResponse
     * @noinspection PhpConditionAlreadyCheckedInspection
     */
    public function update(UpdateCategoryRequest $request, Category $category, CategoryHandler $handler): RedirectResponse
    {
        if ($request->validated()) {
            $isUpdate = $handler->adapt($request, $category);
            $response = $isUpdate ? 'Congrats! Category resource is updated successfully' : 'Oops! Unable to update category resource';
            return Redirect::back()->with('status', $response);
        }
        return Redirect::back()->with('status', 'Oops! Something went wrong to update');
    }

    /**
     * Remove the specified resource from storage
     * @param  Category         $category
     * @param  CategoryHandler  $handler
     * @return RedirectResponse
     */
    public function destroy(Category $category, CategoryHandler $handler): RedirectResponse
    {
        $isDelete = $handler->erase($category);
        $response = $isDelete ? 'Congrats! Category resource is deleted successfully' : 'Oops! Unable to delete category resource';
        return Redirect::back()->with('status', $response);
    }
}
