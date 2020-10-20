<?php

namespace App\Exports;

use App\UserOrder;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class UserOrderExport implements FromCollection, WithMapping, WithHeadings
{
    public $startDate;
    public $endDate;

    public function __construct($startDate, $endDate)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }


    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return UserOrder::where('preorder', 0)->whereBetween('created_at', [$this->startDate, $this->endDate])->get();
    }

    public function map($userOrder): array
    {
        $multiRow = [];
        $userOrder->carts->each(function($cart) use ($userOrder, &$multiRow) {
            $multiRow[] = [
                $userOrder->id,
                "",
                $userOrder->user->first_name . " " . $userOrder->user->last_name,
                "",
                $userOrder->user->street,
                $userOrder->user->postal,
                $userOrder->user->city,
                "DE",
                "",
                $userOrder->user->first_name . " " . $userOrder->user->last_name,
                "",
                $userOrder->user->street,
                $userOrder->user->postal,
                $userOrder->user->city,
                "DE",
                "BESTNR_AG",
                "LIEFDAT",
                $userOrder->created_at->addDays(1)->format('d.m.y'), // date format 01.30.18 // +1 day
                $cart->product->sku,
                $cart->product_name, // max 50 ch
                $cart->quantity,
                "",
                "",
                "",
                "19",
                ""
            ];
        });
        return $multiRow;
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
