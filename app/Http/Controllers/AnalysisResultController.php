<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Analysis;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\Imports;
use App\Models\Category;

class AnalysisResultController extends Controller
{
    public function show(Analysis $analysi)
    {
        $categories = Category::all();

        foreach($categories as $category)
        {
            $analysiMeta = $analysi->analysisMetas->where("category_id", $category->id)->first();
            if ($analysiMeta){
                $datas[$category->name] = $this->import($analysiMeta->upload->path, json_decode($category->options, true));
            }
        }

        return view("analysis-result.show", ["analysi" => $analysi, "datas" => $datas, "categories" => $categories]);
    }

    private function import($path, $options)
    {
        $importArray = Excel::toArray(new Imports, $path);

        $data = $this->analysis($importArray[0], $options);

        return $data;
    }

    private function analysis($data, $options)
    {
        $result = [];
        $total = [
            "adet" => 0,
            "erisim" => 0,
            "rees_try" => 0,
            "stxcm" => 0,
            "sure" => 0,
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
                        'sure' => 0,
                    ];
                }

                if (isset($options['adet'])) {
                    if ($options['adet'] == '++') {
                        $result[$brand]['adet']++;
                        $total['adet']++;
                    } else {
                        $result[$brand]['adet'] += $this->calculateCustomAdet($item);
                        $total['adet'] += $this->calculateCustomAdet($item);
                    }
                }

                foreach ($options as $key => $operation) {
                    if ($key !== 'adet') {
                        if ($operation == '++') {
                            $result[$brand][$key]++;
                            $total[$key]++;
                        } elseif ($operation == '+=') {
                            if (isset($item[$key])) {
                                $result[$brand][$key] += $item[$key];
                                $total[$key] += $item[$key];
                            }
                        }
                    }
                }
            }
        }

        return [
            'brands' => $result,
            'totals' => $total
        ];
    }

    private function calculateCustomAdet($item)
    {
        return 1;
    }

}
