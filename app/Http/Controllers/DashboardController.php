<?php

namespace App\Http\Controllers;

use Maatwebsite\Excel\Facades\Excel;
use App\Imports\Imports;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard');
    }

    public function import(Request $request)
    {
        $importArray = Excel::toArray(new Imports, $request->file('upload_file'));

        $data = $this->analysis($importArray[0]);

        return view('dashboard', ["data" => $data]);
    }

    private function analysis($data) {
        $result = [];
        $total = [
            "adet" => 0,
            "erisim" => 0,
            "rees_try" => 0,
            // "stxcm" => 0,
        ];

        foreach ($data as $item) {
            $brands = array_unique(array_map('trim', explode(',', $item['markalar'])));

            foreach ($brands as $brand) {
                if (!array_key_exists($brand, $result)) {
                    $result[$brand] = [
                        'adet' => 0,
                        'erisim' => 0,
                        'rees_try' => 0,
                        // 'stxcm' => 0,
                    ];
                }

                $result[$brand]['adet']++;
                $result[$brand]['erisim'] += $item['erisim'];
                $result[$brand]['rees_try'] += $item['rees_try'];
                // $result[$brand]['stxcm'] += $item['stxcm'];

                $total['adet']++;
                $total['erisim'] += $item['erisim'];
                $total['rees_try'] += $item['rees_try'];
                // $total['stxcm'] += $item['stxcm'];
            }
        }

        return [
            'brands' => $result,
            'totals' => $total
        ];
    }
}
