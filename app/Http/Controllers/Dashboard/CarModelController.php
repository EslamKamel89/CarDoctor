<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\CarModel;
use Illuminate\Http\Request;
use App\Http\Requests\CarModelRequest;
use App\Http\Resources\CarModelResource;
use App\Models\Brand;

class CarModelController extends Controller {

    public function index() {
        $this->authorize('car_models.view');

        $carModels = CarModel::with('brand')
            ->orderBy('name_ar')
            ->get();

        return inertia('admin/CarModels/Index',  [
            'car_models' => CarModelResource::collection($carModels),
            'brands' => Brand::orderBy('name_ar')->pluck('name_ar', 'id'), // For dropdown
        ]);
    }


    public function create() {
        $this->authorize('car_models.create');

        $brands = Brand::orderBy('name_ar')->pluck('name', 'id');

        return inertia('admin/CarModels/Create', compact('brands'));
    }


    public function store(CarModelRequest $request) {
        CarModel::create($request->validated());

        return redirect()->route('car-models.index')
            ->with('success', 'تم إنشاء الموديل بنجاح.');
    }


    public function show(CarModel $carModel) {
        return CarModelResource::make($carModel->load('brand'));
    }

    public function edit(CarModel $carModel) {
        $this->authorize('car_models.edit');

        $carModel->load('brand');
        $brands = Brand::orderBy('name_ar')->pluck('name', 'id');

        return inertia('admin/CarModels/Edit', [
            'car_model' => new CarModelResource($carModel),
            'brands' => $brands,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CarModelRequest $request, CarModel $carModel) {
        $carModel->update($request->validated());

        return redirect()->route('car-models.index')
            ->with('success', 'تم تحديث الموديل بنجاح.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CarModel $carModel) {
        $this->authorize('car_models.delete');

        $carModel->delete();

        return back()->with('success', 'تم حذف الموديل بنجاح.');
    }
    public function restore(CarModel $carModel) {
        $this->authorize('car_models.create'); // Or create restore permission

        $carModel->restore();

        return back()->with('success', 'تم استعادة الموديل بنجاح.');
    }
}
