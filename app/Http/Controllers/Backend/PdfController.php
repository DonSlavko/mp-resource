<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\PaymentStatus;
use App\UserOrder;
use \PDF;
use Illuminate\Http\Request;

class PdfController extends Controller
{
    public function downloadOrderPdf(UserOrder $order) {
        $pdf = PDF::loadView('pdf.order', ['order' => $order]);
        return $pdf->download($order->id . '-order.pdf');
    }

    public function downloadPreorderPdf(UserOrder $preorder) {
        $pdf = PDF::loadView('pdf.preorder', ['preorder' => $preorder]);
        return $pdf->download($preorder->id . '-preorder.pdf');
    }

    public function downloadInvoicePdf(PaymentStatus $invoice) {
        $pdf = PDF::loadView('pdf.invoice', ['invoice' => $invoice]);
        return $pdf->download($invoice->id . '-invoice.pdf');
    }
}
