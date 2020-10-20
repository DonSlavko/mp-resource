<?php

namespace App\Http\Controllers\Backend;

use App\Exports\UserOrderExport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function export(Request $request)
    {
        $interval = $request->get('interval', null);
        $startDate = $request->get('start_date', null);
        $endDate = $request->get('end_date', null);

        switch ($interval) {
            case 1:
                $startDate = Carbon::now()->setTime(9, 0, 0)->subDay()->toDateTimeString();
                $endDate = Carbon::now()->setTime(9, 0, 0)->toDateTimeString();
                break;
            case 2:
                $startDate = Carbon::now()->setTime(9, 0, 0)->subWeek()->toDateTimeString();
                $endDate = Carbon::now()->setTime(9, 0, 0)->toDateTimeString();
                break;
            case 3:
                $startDate = Carbon::now()->setTime(9, 0, 0)->subMonth()->toDateTimeString();
                $endDate = Carbon::now()->setTime(9, 0, 0)->toDateTimeString();
                break;
            case 4:
                $startDate = Carbon::now($startDate)->setTime(9, 0, 0)->toDateTimeString();
                $endDate = Carbon::now($endDate)->setTime(9, 0, 0)->toDateTimeString();
                break;
            default:
                break;
        }

        return Excel::download(new UserOrderExport($startDate, $endDate),
            'orders.csv',
            \Maatwebsite\Excel\Excel::CSV,
            [
                'Content-Type' => 'text/csv',
            ]);
    }
}
