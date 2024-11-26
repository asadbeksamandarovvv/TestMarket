<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderProduct;

use Barryvdh\DomPDF\Facade\Pdf;

class PDFController extends Controller
{
    public function index($id)
    {
        $data = Order::find($id);
        $pp = OrderProduct::where('order_id', $id)->get();
        $pdf = PDF::loadView('admin.orders.receipt', ['order' => $data, 'pp' => $pp]);
        $pdf->setOptions([
                             'defaultPaperWidth' => '7cm',
                             'encoding' => 'utf-8'
                         ]);

        return $pdf->stream('check.pdf');
    }
}
