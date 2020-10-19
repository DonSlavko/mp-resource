<?php

namespace App\Http\Controllers\Backend;

use App\Exports\UserOrderExport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function export() {
        return Excel::download(new UserOrderExport, 'orders.csv', \Maatwebsite\Excel\Excel::CSV, [
            'Content-Type' => 'text/csv',
        ]);
    }
}
