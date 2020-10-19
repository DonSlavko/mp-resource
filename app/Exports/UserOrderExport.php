<?php

namespace App\Exports;

use App\UserOrder;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UserOrderExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return UserOrder::all();
    }

    public function headings(): array
    {
        return [
            "LIEFERNR",
            "AG_BGA",
            "AG_NAME 1",
            "AG_NAME 2",
            "AG_STRASSE",
            "AG_PLZ",
            "AG_ORT",
            "AG_LAND",
            "WE_BGA",
            "WE_NAME 1",
            "WE_NAME 2",
            "WE_STRASSE",
            "WE_PLZ",
            "WE_ORT",
            "WE_LAND",
            "BESTNR_AG",
            "LIEFDAT",
            "POSNR",
            "MATNR",
            "MATXT",
            "MENGE",
            "CHARGE",
            "VERFDAT",
            "LIEFSERV",
            "VKORG",
            "VSTAT"
        ];
    }
}
