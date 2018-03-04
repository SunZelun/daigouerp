<?php

namespace App\Http\Controllers\Admin;

use App\Models\Misc;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
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
                ->where(['orders.order_status' => $orderStatus, 'orders.status' => Order::STATUS_ACTIVE, 'user_id' => Auth::id()])
                ->get();
            $orders = $orders->sortBy('customer.name')->toArray();
            return view('admin.export.components.order_table', ['orders' => $orders]);
        } elseif ($type == 'shipment') {

        } else {
            $miscs = Misc::with(['type'])
                ->where(['status' => Misc::STATUS_ACTIVE, 'user_id' => Auth::id()])
                ->orderBy('updated_at',SORT_DESC)
                ->get()
                ->toArray();

            return view('admin.export.components.misc_table', ['miscs' => $miscs]);
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
                ->where(['orders.order_status' => $orderStatus, 'orders.status' => Order::STATUS_ACTIVE, 'user_id' => Auth::id()])
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
        } elseif($type == 'shipment') {

        } else {
            $miscs = Misc::with(['type'])
                ->where(['status' => Misc::STATUS_ACTIVE, 'user_id' => Auth::id()])
                ->orderBy('updated_at',SORT_DESC)
                ->get()
                ->toArray();

            if ($exportType == 'csv'){
                return Excel::create('miscs', function($excel) use ($miscs) {

                    $excel->sheet('miscs', function($sheet) use ($miscs) {

                        // add header
                        $sheet->row(1, array(
                            'S/N', 'Type', 'Date', '支出(RMB)', '支出(SGD)', '收入(SGD)', '收入(SGD)'
                        ));

                        if (!empty($miscs)){
                            $key = 1;
                            foreach ($miscs as $misc){
                                $index = 1 + $key;
                                $typeName = isset($misc['type']['name']) ? $misc['type']['name'] : '-';
                                $sheet->row($index, array(
                                    $key, $typeName, $misc['date'], $misc['cost_in_rmb'], $misc['cost_in_sgd'], $misc['income_in_rmb'], $misc['income_in_sgd']
                                ));
                                $key++;
                            }
                        }
                    });
                })->export('csv');
            } else {
                $pdf = PDF::loadView('admin.export.components.miscs', ['miscs' => $miscs]);
                return $pdf->stream('misc.pdf');
            }
        }

        return false;
    }
}
