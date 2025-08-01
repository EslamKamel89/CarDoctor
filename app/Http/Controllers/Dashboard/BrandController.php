<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\BrandRequest;
use App\Http\Resources\BrandResource;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller {

    public function index() {
        $this->authorize('brands.view');

        $brands = Brand::orderBy('name_ar')
            ->get();

        return inertia('admin/Brands/Index', [
            'brands' => BrandResource::collection($brands),
        ]);
    }


    public function create() {
        $this->authorize('brands.create');

        return inertia('admin/Brands/Create');
    }


    public function store(BrandRequest $request) {
        Brand::create($request->validated());

        return redirect()->route('brands.index')
            ->with('success', 'تم إنشاء العلامة بنجاح.');
    }


    public function show(Brand $brand) {
        return BrandResource::make($brand);
    }


    public function edit(Brand $brand) {
        $this->authorize('brands.edit');

        return inertia('admin/Brands/Edit', [
            'brand' => new BrandResource($brand),
        ]);
    }


    public function update(BrandRequest $request, Brand $brand) {
        $brand->update($request->validated());

        return redirect()->route('brands.index')
            ->with('success', 'تم تحديث العلامة بنجاح.');
    }


    public function destroy(Brand $brand) {
        $this->authorize('brands.delete');

        $brand->delete();

        return back()->with('success', 'تم حذف العلامة بنجاح.');
    }

    public function restore(Brand $brand) {
        $this->authorize('brands.create'); // Or create restore permission
        $brand->restore();
        return back()->with('success', 'تم استعادة العلامة بنجاح.');
    }
}
