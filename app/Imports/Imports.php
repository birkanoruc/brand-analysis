<?php
namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class Imports implements ToCollection, WithHeadingRow
{
    public function collection(Collection $collection)
    {
        return [
            'markalar'  => $collection['Markalar'],
            'erisim' => $collection['Erişim'],
            'stxcm' => $collection['StxCm'],
            'reestry'    => $collection['Re.Eş. (TRY)'],
        ];
    }
}
