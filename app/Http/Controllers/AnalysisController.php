<?php

namespace App\Http\Controllers;

use App\Http\Requests\AnalysisStoreRequest;
use App\Models\Analysis;
use App\Models\AnalysisMeta;
use App\Models\Brand;
use App\Models\Category;

class AnalysisController extends Controller
{
    public function index()
    {
        $analysis = Analysis::paginate(25);
        return view("analysis.index", ["analysis" => $analysis]);
    }

    public function create()
    {
        $brands = Brand::all();
        $categories = Category::all();
        return view("analysis.create", ["brands" => $brands, "categories" => $categories]);
    }

    public function store(AnalysisStoreRequest $request)
    {
        $validatedData = $request->validated();

        $analysis = Analysis::create($validatedData);

        if (isset($validatedData['analysis_metas'])) {
            foreach ($validatedData['analysis_metas'] as $categoryId => $uploadId) {
                AnalysisMeta::create([
                    'analysis_id' => $analysis->id,
                    'category_id' => $categoryId,
                    'upload_id' => $uploadId,
                ]);
            }
        }

        return redirect()->route('analysis.index')->with('success', 'Analysis created successfully!');
    }

    public function show(Analysis $analysi)
    {
        return view('analysis.show', compact('analysi'));
    }

    public function edit(Analysis $analysi)
    {
        $brands = Brand::all();
        $categories = Category::all();
        $analysisMetas = $analysi->analysisMetas()->get();

        return view('analysis.edit', [
            "analysi" => $analysi,
            "brands" => $brands,
            "categories" => $categories,
            "analysisMetas" => $analysisMetas
        ]);
    }

    public function update(AnalysisStoreRequest $request, Analysis $analysi)
    {
        $validatedData = $request->validated();

        $analysi->update([
            'name' => $validatedData['name'],
            'brand_id' => $validatedData['brand_id'],
            'analysisDate' => $validatedData['analysisDate'],
        ]);

        // Eğer analysis_metas verisi boş değilse, güncelleme işlemi yap
        if (isset($validatedData['analysis_metas'])) {
            // İlk olarak mevcut meta kayıtlarını al
            $existingMetas = AnalysisMeta::where('analysis_id', $analysi->id)->pluck('category_id')->toArray();

            // Güncellenen kategori ID'lerini al
            $updatedCategoryIds = array_keys($validatedData['analysis_metas']);

            // Silinmesi gerekenleri belirle
            $idsToDelete = array_diff($existingMetas, $updatedCategoryIds);
            if (!empty($idsToDelete)) {
                AnalysisMeta::where('analysis_id', $analysi->id)
                    ->whereIn('category_id', $idsToDelete)
                    ->delete();
            }

            // Güncelleme veya ekleme işlemini yap
            foreach ($validatedData['analysis_metas'] as $categoryId => $uploadId) {
                // upload_id null veya geçersizse kaydı sil
                if ($uploadId === null) {
                    AnalysisMeta::where('analysis_id', $analysi->id)
                        ->where('category_id', $categoryId)
                        ->delete();
                } else {
                    AnalysisMeta::updateOrCreate(
                        ['analysis_id' => $analysi->id, 'category_id' => $categoryId],
                        ['upload_id' => $uploadId]
                    );
                }
            }
        } else {
            // Eğer analysis_metas verisi boşsa, tüm mevcut kayıtları sil
            AnalysisMeta::where('analysis_id', $analysi->id)->delete();
        }

        return redirect()->route('analysis.index')->with('success', 'Analysi updated successfully!');
    }

    public function destroy(Analysis $analysi)
    {
        $analysi->delete();
        return redirect()->route('analysis.index')->with('success', 'Analysi deleted successfully!');
    }

    private function analysis($data)
    {
        $result = [];
        $total = [
            "adet" => 0,
            "erisim" => 0,
            "rees_try" => 0,
            "stxcm" => 0,
        ];

        foreach ($data as $item) {
            $brands = array_unique(array_map('trim', explode(',', $item['markalar'])));

            foreach ($brands as $brand) {
                if (!array_key_exists($brand, $result)) {
                    $result[$brand] = [
                        'adet' => 0,
                        'erisim' => 0,
                        'rees_try' => 0,
                        'stxcm' => 0,
                    ];
                }

                $result[$brand]['adet']++;
                $result[$brand]['erisim'] += $item['erisim'];
                $result[$brand]['rees_try'] += $item['rees_try'];
                $result[$brand]['stxcm'] += $item['stxcm'];

                $total['adet']++;
                $total['erisim'] += $item['erisim'];
                $total['rees_try'] += $item['rees_try'];
                $total['stxcm'] += $item['stxcm'];
            }
        }

        return [
            'brands' => $result,
            'totals' => $total
        ];
    }
}
