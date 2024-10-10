<?php

namespace App\Http\Controllers;

use App\Http\Requests\BrandStoreRequest;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::paginate(25);
        return view("brands.index", ["brands" => $brands]);
    }

    public function create()
    {
        return view("brands.create");
    }

    public function store(BrandStoreRequest $request)
    {
        $validatedData = $request->validated();
        $brand = Brand::create($validatedData);
        return redirect()->route('brands.index')->with('success', 'Brand created successfully!');
    }

    public function show(Brand $brand)
    {
        return view('brands.show', compact('brand'));
    }

    public function edit(Brand $brand)
    {
        return view('brands.edit', compact('brand'));
    }

    public function update(BrandStoreRequest $request, Brand $brand)
    {
        $validatedData = $request->validated();

        $brand->update($validatedData);

        return redirect()->route('brands.index')->with('success', 'Brand updated successfully!');
    }

    public function destroy(Brand $brand)
    {
        $brand->delete();
        return redirect()->route('brands.index')->with('success', 'Brand deleted successfully!');
    }
}
