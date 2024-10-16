<?php

namespace App\Http\Controllers\Package\Vehicle;

use App\Http\Controllers\Controller;
use App\Http\Handlers\Resolvers\Package\Vehicle\GradeHandler;
use App\Http\Requests\Package\Vehicle\StoreGradeRequest;
use App\Http\Requests\Package\Vehicle\UpdateGradeRequest;
use App\Models\Grade;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class GradeController extends Controller
{
    /**
     * Display a listing of the resource
     * @param  Request                  $request
     * @return Application|Factory|View
     */
    public function index(Request $request): View|Factory|Application
    {
        $collections = Grade::query()->with('translate')->orderBy('slug')->get();
        return view('content.package.vehicle.grade.index', compact('collections'));
    }

    /**
     * Show the form for creating a new resource
     * @return Application|Factory|View
     */
    public function create(): View|Factory|Application
    {
        return view('content.package.vehicle.grade.create');
    }

    /**
     * Store a newly created resource in storage
     * @param  StoreGradeRequest $request
     * @param  GradeHandler      $handler
     * @return RedirectResponse
     */
    public function store(StoreGradeRequest $request, GradeHandler $handler): RedirectResponse
    {
        if ($request->validated()) {
            $isCreate = $handler->store($request);
            $response = $isCreate ? 'Congrats! Grade resource is created successfully' : 'Oops! Unable to create a new grade';
            return Redirect::back()->with('status', $response);
        }
        return Redirect::back()->with('status', 'Oops! Something went wrong to create');
    }

    /**
     * Display the specified resource
     * @param  Grade $grade
     * @return void
     */
    public function show(Grade $grade): void
    {
        // TODO: Implement show() method
    }

    /**
     * Show the form for editing the specified resource
     * @param  Grade                    $grade
     * @return Application|Factory|View
     */
    public function edit(Grade $grade): View|Factory|Application
    {
        return view('content.package.vehicle.grade.update', compact('grade'));
    }

    /**
     * Update the specified resource in storage
     * @param  UpdateGradeRequest $request
     * @param  Grade              $grade
     * @param  GradeHandler       $handler
     * @return RedirectResponse
     */
    public function update(UpdateGradeRequest $request, Grade $grade, GradeHandler $handler): RedirectResponse
    {
        if ($request->validated()) {
            $isUpdate = $handler->adapt($request, $grade);
            $response = $isUpdate ? 'Congrats! Grade resource is updated successfully' : 'Oops! Unable to update grade resource';
            return Redirect::back()->with('status', $response);
        }
        return Redirect::back()->with('status', 'Oops! Something went wrong to updated');
    }

    /**
     * Remove the specified resource from storage
     * @param  Grade            $grade
     * @param  GradeHandler     $handler
     * @return RedirectResponse
     */
    public function destroy(Grade $grade, GradeHandler $handler): RedirectResponse
    {
        $isDelete = $handler->erase($grade);
        $response = $isDelete ? 'Congrats! Grade resource is deleted successfully' : 'Oops! Unable to delete grade resource';
        return Redirect::back()->with('status', $response);
    }
}
