<?php

namespace App\Http\Controllers;

use App\Models\Upload;
use App\Models\Category;
use App\Models\Brand;
use App\Http\Requests\UploadStoreRequest;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
    public function index()
    {
        $uploads = Upload::paginate(50);
        return view("uploads.index", ["uploads" => $uploads]);
    }

    public function create()
    {
        $categories = Category::all();
        $brands = Brand::all();
        return view("uploads.create", ["categories" => $categories, "brands" => $brands]);
    }

    public function store(UploadStoreRequest $request)
    {
        $validatedData = $request->validated();

        $fileData = $this->upload($validatedData['upload_file'], $validatedData["brand_id"], $validatedData["category_id"]);

        $upload = Upload::create([
            'category_id' => $validatedData['category_id'],
            'brand_id' => $validatedData['brand_id'],
            'path' => $fileData["path"],
            'name' => $fileData["name"],
            'extension' => $fileData["extension"],
            'size' => $fileData["size"]
        ]);

        return redirect()->route('uploads.index')->with('success', 'Upload created successfully!');

    }

    public function show(Upload $upload)
    {
        return view('uploads.show', compact('upload'));
    }

    public function edit(Upload $upload)
    {
        $categories = Category::all();
        $brands = Brand::all();
        return view('uploads.edit', ["upload" => $upload, "categories" => $categories, "brands" => $brands]);
    }

    public function update(UploadStoreRequest $request, Upload $upload)
    {
        $validatedData = $request->validated();

        // Dosyayı yükleyin ve bilgilerini alın
        $fileData = $this->upload(
            $validatedData['upload_file'],
            $validatedData['brand_id'],
            $validatedData['category_id']
        );

        // Eğer upload mevcutsa güncelle
        if (!$upload) {
            return redirect()->route('uploads.index')->with('error', 'Upload not found!');
        }

        // Güncelleme işlemi
        $upload->update([
            'category_id' => $validatedData['category_id'],
            'brand_id' => $validatedData['brand_id'],
            'path' => $fileData['path'],
            'name' => $fileData['name'],
            'extension' => $fileData['extension'],
            'size' => $fileData['size'],
        ]);

        return redirect()->route('uploads.index')->with('success', 'Upload updated successfully!');
    }

    public function destroy(Upload $upload)
    {
        $this->deleteStorage($upload);

        $upload->delete();

        return redirect()->route('uploads.index')->with('success', 'Upload deleted successfully!');
    }

    private function deleteStorage($upload)
    {
        $file = Upload::findOrFail($upload);
        $filePath = $file->path;

        if (Storage::exists($filePath)) {
            Storage::delete($filePath);
        }

        return;
    }

    private function upload($file, $brand_id, $category_id): Array
    {
        $brandName = Brand::findOrFail($brand_id);
        $seoBrandName = Str::slug($brandName->name);

        $categoryName = Category::findOrFail($category_id);
        $seoCategoryName = Str::slug($categoryName->name);

        $currentDate = Carbon::now()->format('Y-m-d');

        $extension = $file->getClientOriginalExtension();

        $fileSize = $file->getSize();

        $fileName = $currentDate . '_' . $seoBrandName . '_' . $seoCategoryName . '.' . $extension;

        $uploadPath = "uploads";

        $file->storeAs($uploadPath, $fileName);

        return [
            'path' => $uploadPath . '/' . $fileName,
            'name' => $fileName,
            'extension' => $extension,
            'size' => $fileSize
        ];
    }
}
