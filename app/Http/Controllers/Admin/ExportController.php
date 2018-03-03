<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use PDF;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{

    /**
     * Export landing page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){
        return view('admin.export.index');
    }

    /**
     * Export items
     * @param Request $request
     * @return bool|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function export(Request $request){
        $type = $request->post('type','order');

        if ($type == 'order'){
            $orderStatus = $request->post('order_status',Order::PENDING_DELIVERY);
            $orders = Order::with(['products.detail', 'customer', 'address'])
                ->join('customers', 'orders.customer_id', '=', 'customers.id')
                ->where(['orders.order_status' => $orderStatus, 'orders.status' => Order::STATUS_ACTIVE])
                ->orderBy('customers.name',SORT_ASC)
                ->get()
                ->toArray();
            return view('admin.export.components.order_table', ['orders' => $orders]);
        }

        return false;
    }

    /**
     * Export items to csv
     * @param Request $request
     * @return bool|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function exportToCsv(Request $request){
        $type = $request->get('type','order');
        $exportType = $request->get('export_type','csv');

        if ($type == 'order'){
            $orderStatus = $request->get('order_status',Order::PENDING_DELIVERY);
            $orders = Order::with(['products.detail', 'customer', 'address'])
                ->where(['orders.order_status' => $orderStatus, 'orders.status' => Order::STATUS_ACTIVE])
                ->get();

            $orders = $orders->sortBy('customer.name');

            if ($exportType == 'csv'){
                return Excel::create('orders', function($excel) use ($orders) {

                    $excel->sheet('orders', function($sheet) use ($orders) {

                        // add header
                        $sheet->row(1, array(
                            'S/N', '客户姓名', '微信号', '订单详情', '邮寄地址'
                        ));

                        if (!empty($orders)){
                            $key = 1;
                            foreach ($orders as $order){
                                $index = 1 + $key;
                                $customerName = $order->customer ? $order->customer->name : '-';
                                $wechatName = $order->customer ? $order->customer->wechat_name : '-';
                                $productString = '';
                                if ($order->products && !empty($order->products)){
                                    foreach ($order->products as $product){
                                        $productName = $product->detail ? $product->detail->name : '-';
                                        $remark = !empty($product->remarks) ? '('.$product->remarks.')' : '';
                                        $productString .= $product->quantity.' x '.$productName.$remark."\r\n";
                                    }
                                }
                                $address = $order->address ? $order->address->address.' '.$order->address->contact_person.' '.$order->address->contact_number : '-';
                                $contactRemarks = $order->address && !empty($order->address->remarks) ? '('.$order->address->remarks.')' : '';
                                $sheet->row($index, array(
                                    $key, $customerName, $wechatName, $productString, $address.$contactRemarks
                                ));
                                $key++;
                            }
                        }
                    });
                })->export('csv');
            } else {
                $pdf = PDF::loadView('admin.export.components.orders', ['orders' => $orders]);
                return $pdf->stream('orders.pdf');
            }
        }

        return false;
    }
}
