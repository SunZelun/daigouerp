<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use anlutro\cURL\cURL;

class DashboardController extends Controller
{
    public function index(){
        $rate = $this->getCurrencyRate();
        $activeOrders = Order::with(['products'])->where(['user_id' => Auth::id(), 'status' => Order::STATUS_ACTIVE])->get();
        $activeCustomers = Customer::where(['status' => Customer::STATUS_ACTIVE, 'user_id' => Auth::id()])->count();
        $activeProducts = Product::where(['status' => Product::STATUS_ACTIVE, 'user_id' => Auth::id()])->get();

        $totalCostInRmb = 0;
        $totalCostInSgd = 0;
        $totalRevInRmb = 0;
        $totalRevInSgd = 0;
        $totalProfitInRmb = 0;
        $totalProfitInSgd = 0;
        $productsSold = 0;

        $salesBreakdown = null;
        $buyerBreakdown = null;

        if (!empty($activeOrders)){
            foreach ($activeOrders as $activeOrder){
                $totalCostInRmb += doubleval($activeOrder->cost_in_rmb);
                $totalCostInSgd += doubleval($activeOrder->cost_in_sgd);
                $totalRevInRmb += doubleval($activeOrder->revenue_in_rmb);
                $totalRevInSgd += doubleval($activeOrder->revenue_in_sgd);
                $totalProfitInRmb += doubleval($activeOrder->profit_in_rmb);
                $totalProfitInSgd += doubleval($activeOrder->profit_in_sgd);

                if ($activeOrder->products){
                    foreach ($activeOrder->products as $product){
                        $productsSold += doubleval($product->quantity);

                        //group sales based on product
                        if (empty($salesBreakdown) || !in_array($product->product_id, array_keys($salesBreakdown))){
                            $salesBreakdown[$product->product_id] = [
                                'name' => $product->detail->name,
                                'quantity' => $product->quantity
                            ];
                        } else {
                            $salesBreakdown[$product->product_id]['quantity'] += $product->quantity;
                        }
                    }
                }

                //group sales based on customer
                if (empty($buyerBreakdown) || !in_array($activeOrder->customer_id, array_keys($buyerBreakdown))){
                    $buyerBreakdown[$activeOrder->customer_id] = [
                        'name' => $activeOrder->customer->name,
                        'revenue_in_rmb' => $activeOrder->revenue_in_rmb,
                        'revenue_in_sgd' => $activeOrder->revenue_in_sgd
                    ];
                } else {
                    $buyerBreakdown[$activeOrder->customer_id]['revenue_in_rmb'] += $activeOrder->revenue_in_rmb;
                    $buyerBreakdown[$activeOrder->customer_id]['revenue_in_sgd'] += $activeOrder->revenue_in_sgd;
                }
            }
        }

        if (!empty($buyerBreakdown)){
            foreach ($buyerBreakdown as &$buyer){
                $buyer['total_revenue_in_rmb'] = round($buyer['revenue_in_sgd'] * $rate + $buyer['revenue_in_rmb'],2);
                $buyer['total_revenue_in_sgd'] = round($buyer['revenue_in_sgd'] + $buyer['revenue_in_rmb']/$rate,2);
            }
        }

        $summary = [
            'cost_in_rmb' => $totalCostInRmb,
            'cost_in_sgd' => $totalCostInSgd,
            'revenue_in_rmb' => $totalRevInRmb,
            'revenue_in_sgd' => $totalRevInSgd,
            'profit_in_rmb' => $totalProfitInRmb,
            'profit_in_sgd' => $totalProfitInSgd,
            'products_sold' => $productsSold,
            'total_revenue_in_rmb' => round($totalRevInRmb + $totalRevInSgd * $rate, 2),
            'total_revenue_in_sgd' => round($totalRevInRmb / $rate + $totalRevInSgd, 2),
            'total_profit_in_rmb' => round($totalProfitInRmb + $totalProfitInSgd * $rate, 2),
            'total_profit_in_sgd' => round($totalProfitInRmb / $rate + $totalProfitInSgd, 2),
            'total_cost_in_rmb' => round($totalCostInRmb + $totalCostInSgd * $rate, 2),
            'total_cost_in_sgd' => round($totalCostInRmb / $rate + $totalCostInSgd, 2),
        ];

        $salesBreakdown = collect($salesBreakdown)->sortBy('quantity')->reverse()->toArray();
        $buyerBreakdown = collect($buyerBreakdown)->sortBy('total_revenue_in_rmb')->reverse()->toArray();
        $activeProducts = collect($activeProducts)->sortBy('quantity')->reverse()->toArray();

        return view('admin.dashboard.home', [
            'summary' => $summary,
            'activeOrders' => $activeOrders,
            'activeCustomers' => $activeCustomers,
            'activeProducts' => $activeProducts,
            'salesBreakdown' => $salesBreakdown,
            'buyerBreakdown' => $buyerBreakdown
        ]);
    }

    public function getCurrencyRate(){
        $rate = session('rate');

        if (empty($rate)){
            $curl = new cURL();

            $response = $curl->get('https://api.fixer.io/latest?base=SGD&symbols=CNY');
            $response = json_decode($response->body,true);
            $rate = isset($response['rates']['CNY']) ? $response['rates']['CNY'] : 4.5;

            session(['rate' => $rate]);
        }

        return session('rate');
    }
}