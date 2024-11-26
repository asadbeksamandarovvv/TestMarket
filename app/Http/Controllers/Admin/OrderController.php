<?php

namespace App\Http\Controllers\Admin;

use App\Data\OrderFilterData;
use App\Http\Controllers\Controller;
use App\Services\OrderService;
use Barryvdh\DomPDF\Facade\Pdf;

class OrderController extends Controller
{
    public function __construct(

        protected OrderService $service,
    ) {
    }

    public function index()
    {
        $orders = $this->service->index(new OrderFilterData());
        return view('admin.orders.index',
                    compact('orders'));
    }

    public function show($id)
    {
        $order = $this->service->show($id);

        return view('admin.orders.show',
                    compact('order'));
    }

    public function cancel($id)
    {
        $this->service->cancel($id);

        return redirect()->route('order.index');
    }

    public function accept($order_id)
    {
        $this->service->accept($order_id);

        return redirect()->route('order.index');
    }

    public function generatePdf($id)
    {
        $order = $this->service->show($id);

        $pdf = PDF::loadView('admin.orders.receipt',
                             compact('order', ));
        $pdf->setOptions([
                             'defaultPaperWidth' => '7cm',
                             'encoding'          => 'utf-8',
                         ]);
        return $pdf->stream('order-details.pdf');
    }
}
