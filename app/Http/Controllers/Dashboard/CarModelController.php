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
        $brandId = request('filter.brand_id');
        $yearFrom = request('filter.year_from');
        $yearTo = request('filter.year_to');
        $query = CarModel::query()->with('brand')->orderBy('name_ar');
        if ($brandId) $query->where('brand_id', $brandId);
        if ($yearFrom) $query->yearFrom($yearFrom);
        if ($yearTo)  $query->yearTo($yearTo);
        $carModels = $query->get();
        return inertia('admin/CarModels/Index',  [
            'car_models' => CarModelResource::collection($carModels),
            'brands' => Brand::select(['id', 'name_ar'])->orderBy('name_ar')->get(), // For dropdown
            'filters' => [
                'brand_id' => $brandId,
                'year_from' => $yearFrom,
                'year_to' => $yearTo,
            ],
        ]);
    }


    public function create() {
        $this->authorize('car_models.create');



        return inertia('admin/CarModels/Create', [
            'brands' => Brand::select(['id', 'name_ar'])->orderBy('name_ar')->get(), // For dropdown
        ]);
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

        return inertia('admin/CarModels/Edit', [
            'car_model' => new CarModelResource($carModel),
            'brands' => Brand::select(['id', 'name_ar'])->orderBy('name_ar')->get(), // For dropdown
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
