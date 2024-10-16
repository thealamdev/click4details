<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Handlers\Resolvers\Admin\SliderHandler;
use App\Http\Requests\Admin\StoreSliderRequest;
use App\Http\Requests\Admin\UpdateSliderRequest;
use App\Models\Slider;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource
     * @param  Request                  $request
     * @return Application|Factory|View
     */
    public function index(Request $request): View|Factory|Application
    {
        $collections = Slider::query()->paginate($request->perPage ?? 10);
        return view('content.admin.slider.index', compact('collections'));
    }

    /**
     * Show the form for creating a new resource
     * @return Application|Factory|View
     */
    public function create(): View|Factory|Application
    {
        return view('content.admin.slider.create');
    }

    /**
     * Store a newly created resource in storage
     * @param  StoreSliderRequest $request
     * @param  SliderHandler      $handler
     * @return RedirectResponse
     */
    public function store(StoreSliderRequest $request, SliderHandler $handler): RedirectResponse
    {
        if ($request->validated()) {
            $isCreate = $handler->store($request);
            $response = $isCreate ? 'Congrats! Slider is created successfully' : 'Oops! Unable to create a new slider';
            return Redirect::back()->with('status', $response);
        }
        return Redirect::back()->with('status', 'Oops! Something went wrong to create');
    }

    /**
     * Display the specified resource
     * @param  Slider $slider
     * @return void
     */
    public function show(Slider $slider): void
    {
        // TODO: Implement show() method
    }

    /**
     * Show the form for editing the specified resource
     * @param  Slider                   $slider
     * @return Application|Factory|View
     */
    public function edit(Slider $slider): View|Factory|Application
    {
        return view('content.admin.slider.update', compact('slider'));
    }

    /**
     * Update the specified resource in storage
     * @param  UpdateSliderRequest $request
     * @param  Slider              $slider
     * @param  SliderHandler       $handler
     * @return RedirectResponse
     * @noinspection PhpConditionAlreadyCheckedInspection
     */
    public function update(UpdateSliderRequest $request, Slider $slider, SliderHandler $handler): RedirectResponse
    {
        if ($request->validated()) {
            $isUpdate = $handler->adapt($request, $slider);
            $response = $isUpdate ? 'Congrats! Slider is updated successfully' : 'Oops! Unable to update slider resource';
            return Redirect::back()->with('status', $response);
        }
        return Redirect::back()->with('status', 'Oops! Something went wrong to update');
    }

    /**
     * Remove the specified resource from storage
     * @param  Slider           $slider
     * @param  SliderHandler    $handler
     * @return RedirectResponse
     */
    public function destroy(Slider $slider, SliderHandler $handler): RedirectResponse
    {
        $isDelete = $handler->erase($slider);
        $response = $isDelete ? 'Congrats! Slider is deleted successfully' : 'Oops! Unable to delete slider resource';
        return Redirect::back()->with('status', $response);
    }
}
