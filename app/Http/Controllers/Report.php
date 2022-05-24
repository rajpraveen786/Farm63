<?php

namespace App\Http\Controllers;

use App\Exports\LowStockExport;
use App\Mail\LowStockDaily;
use App\Model\Orders;
use App\Model\OrdersSub;
use App\Model\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;

class Report extends Controller
{
    public function lowstock(Request $request)
    {
        $data = Products::select('name', 'stock', 'minstock', 'fpricewtas', 'id', 'status')->whereColumn('stock', '<=', 'minstock');
        if ($request->has('status') && $request->status >= 0) {
            $data = $data->where('status', $request->status);
        }
        $data = $data->get();

        if ($request->has('export') && $request->export) {


            header('Content-Type: text/csv');
            header('Content-Disposition: attachment; filename="Low Stock.csv"');
            $fp = fopen('php://output', 'wb');
            $x = ['Product', 'Minimum Stock', 'Stock', 'Status', 'Sale Rate'];
            fputcsv($fp, $x);
            for ($i = 0; $i < $data->count(); $i++) {
                $x = [];
                $status = '';
                $type = '';
                if ($data[$i]->status == 0) {
                    $status = 'Draft';
                } else if ($data[$i]->status == 1) {
                    $status = 'Active';
                } else if ($data[$i]->status == 3) {
                    $status = 'Draft';
                } else {
                    $status = 'Reported';
                }
                array_push(
                    $x,
                    $data[$i]->name,
                    $data[$i]->minstock,
                    $data[$i]->stock,
                    $status,
                    $data[$i]->fpricewtas,
                );
                fputcsv($fp, $x);
            }
            fclose($fp);
            return '';
        }
        return view('Admin.Reports/lowstock', ['data' => $data]);
    }
    public function stock(Request $request)
    {
        $data = Products::select('name', 'stock', 'minstock', 'fpricewtas', 'id', 'status');
        if ($request->has('status') && $request->status >= 0) {
            $data = $data->where('status', $request->status);
        }
        $data = $data->get();

        if ($request->has('export') && $request->export) {
            header('Content-Type: text/csv');
            header('Content-Disposition: attachment; filename="Stock.csv"');
            $fp = fopen('php://output', 'wb');
            $x = ['Product', 'Minimum Stock', 'Stock', 'Status', 'Sale Rate'];
            fputcsv($fp, $x);
            for ($i = 0; $i < $data->count(); $i++) {
                $x = [];
                $status = '';
                $type = '';
                if ($data[$i]->status == 0) {
                    $status = 'Draft';
                } else if ($data[$i]->status == 1) {
                    $status = 'Active';
                } else if ($data[$i]->status == 3) {
                    $status = 'Disabled';
                } else {
                    $status = 'Reported';
                }
                array_push(
                    $x,
                    $data[$i]->name,
                    $data[$i]->minstock,
                    $data[$i]->stock,
                    $status,
                    $data[$i]->fpricewtas,
                );
                fputcsv($fp, $x);
            }
            fclose($fp);
            return '';
        }
        return view('Admin.Reports/stock', ['data' => $data]);
    }
    public function sales(Request $request)
    {
        $data = Orders::where('status', 3)->with('store')->with('customer');
        if ($request->has('orderby') && $request->orderby >= 0) {
            $data = $data->orderBy('created_at', $request->orderby ?? 'desc');
        } else {
            $data = $data->orderBy('created_at', 'desc');
        }
        if ($request->has('startdate')) {
            $data = $data->whereDate('created_at', '>=', $request->startdate);
        } else {
            $data = $data->whereDate('created_at', '>=', date('Y-m-d', strtotime('-7 days')));
        }

        if ($request->has('enddate')) {
            $data = $data->whereDate('created_at', '<=', $request->enddate);
        }
        $data = $data->get();

        if ($request->has('export') && $request->export) {
            header('Content-Type: text/csv');
            header('Content-Disposition: attachment; filename="Sales.csv"');
            $fp = fopen('php://output', 'wb');
            $x = [
                'Invoice Number',
                'Customer',
                'Store',
                'Pincode',
                'Pay Status',
                'Sub Cost',
                'Discount',
                'Shipping',
                'Sub Total',
                'Tax',
                'Promocode Value',
                'Total',
                'Created At',
                'Completed At',
            ];
            fputcsv($fp, $x);
            for ($i = 0; $i < $data->count(); $i++) {
                $x = [];
                $paystatus = '';
                $type = '';
                if ($data[$i]->paytype == 0) {
                    $paystatus = 'COD';
                } else if ($data[$i]->paytype == 1) {
                    $paystatus = 'Online';
                }
                array_push(
                    $x,
                    $data[$i]->invno,
                    $data[$i]->customer->name,
                    $data[$i]->store->name,
                    $data[$i]->pincodeid,
                    $paystatus,
                    $data[$i]->subcost,
                    $data[$i]->discount,
                    $data[$i]->shipping,
                    $data[$i]->subtotal,
                    $data[$i]->taxtotal,
                    $data[$i]->promocodeval,
                    $data[$i]->total,
                    $data[$i]->created_at,
                    $data[$i]->completed_at,
                );
                fputcsv($fp, $x);
            }
            fclose($fp);
            return '';
        }
        return view('Admin.Reports.sales', ['data' => $data]);
    }

    public function lowstockexport()
    {
        Mail::to('rajpraveen786@gmail.com')->send(new LowStockDaily());
        // return Excel::download(new LowStockExport, 'Low Stock'.date('d-m-Y').'.xlsx');
    }


    public function returns(Request $request)
    {
        $data = Orders::select(
            'id',
            'uid',
            'pincodeid',
            'subcost',
            'discount',
            'id',
            'shipping',
            'subtotal',
            'created_at',
            'promocodeval',
            'total',
            'status',
            'paytype'
        )->where('status', 3)->with('customer');
        // return $request;
        if ($request->has('orderby') && $request->orderby >= 0) {
            $data = $data->orderBy('created_at', $request->orderby);
        } else {
            $data = $data->orderBy('created_at', 'desc');
        }
        if ($request->has('startdate')) {
            $data = $data->whereDate('created_at', '>=', $request->startdate);
        } else {
            $data = $data->whereDate('created_at', '>=', date('Y-m-d', strtotime('-7 days')));
        }

        if ($request->has('enddate')) {
            $data = $data->whereDate('created_at', '<', $request->enddate);
        }
        $data = $data->get();

        if ($request->has('export') && $request->export) {
            header('Content-Type: text/csv');
            header('Content-Disposition: attachment; filename="Returns.csv"');
            $fp = fopen('php://output', 'wb');
            $x = [
                'Order ID',
                'Customer',
                'Pay Status',
                'Sub Cost',
                'Discount',
                'Shipping',
                'Sub Total',
                'Tax',
                'Promocode Value',
                'Total',
            ];
            fputcsv($fp, $x);
            for ($i = 0; $i < $data->count(); $i++) {
                $x = [];
                $paystatus = '';
                $type = '';
                if ($data[$i]->paytype == 0) {
                    $paystatus = 'COD';
                } else if ($data[$i]->paytype == 1) {
                    $paystatus = 'Online';
                }
                array_push(
                    $x,
                    $data[$i]->id,
                    $data[$i]->customer->name,
                    $paystatus,
                    $data[$i]->subcost,
                    $data[$i]->discount,
                    $data[$i]->shipping,
                    $data[$i]->subtotal,
                    $data[$i]->promocodeval,
                    $data[$i]->total,
                );
                fputcsv($fp, $x);
            }
            fclose($fp);
            return '';
        }
        return view('Admin.Reports/returns', ['data' => $data]);
    }



    public function productsold(Request $request)
    {
        $data = OrdersSub::whereHas('reportorder', function ($q) {
            $q->where('status', 3);
        })->groupBy('pid')
            ->selectRaw("SUM(qty) as qty")
            ->addSelect('id', 'pid', 'name')->with('products');
        if ($request->has('orderby') && $request->orderby >= 0) {
            $data = $data->orderBy('qty', $request->orderby ?? 'desc');
        } else {
            $data = $data->orderBy('qty', 'desc');
        }
        if ($request->has('startdate')) {
            $data = $data->whereDate('created_at', '>=', $request->startdate);
        } else {
            $data = $data->whereDate('created_at', '>=', date('Y-m-d', strtotime('-7 days')));
        }

        if ($request->has('enddate')) {
            $data = $data->whereDate('created_at', '<=', $request->enddate);
        }
        $data = $data->get();
        if ($request->has('export') && $request->export) {
            header('Content-Type: text/csv');
            header('Content-Disposition: attachment; filename="Sales.csv"');
            $fp = fopen('php://output', 'wb');
            $x = [
                'Invoice Number',
                'Customer',
                'Store',
                'Pincode',
                'Pay Status',
                'Sub Cost',
                'Discount',
                'Shipping',
                'Sub Total',
                'Tax',
                'Promocode Value',
                'Total',
                'Created At',
                'Completed At',
            ];
            fputcsv($fp, $x);
            for ($i = 0; $i < $data->count(); $i++) {
                $x = [];
                $paystatus = '';
                $type = '';
                if ($data[$i]->paytype == 0) {
                    $paystatus = 'COD';
                } else if ($data[$i]->paytype == 1) {
                    $paystatus = 'Online';
                }
                array_push(
                    $x,
                    $data[$i]->invno,
                    $data[$i]->customer->name,
                    $data[$i]->store->name,
                    $data[$i]->pincodeid,
                    $paystatus,
                    $data[$i]->subcost,
                    $data[$i]->discount,
                    $data[$i]->shipping,
                    $data[$i]->subtotal,
                    $data[$i]->taxtotal,
                    $data[$i]->promocodeval,
                    $data[$i]->total,
                    $data[$i]->created_at,
                    $data[$i]->completed_at,
                );
                fputcsv($fp, $x);
            }
            fclose($fp);
            return '';
        }
        return view('Admin.Reports.productssold', ['data' => $data]);
    }
}
