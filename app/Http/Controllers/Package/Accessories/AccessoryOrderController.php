<?php

namespace App\Http\Controllers\Package\Accessories;

use Carbon\Carbon;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AccessoryOrderController extends Controller
{
    public $orders;
    public $pays;
    public $order_details;
    public $status;
    public function index(Request $request)
    {
        if ($request->all()) {

            $this->orders = Order::latest()->where(function ($q) use ($request) {
                if ($request->transaction_id) {
                    $q->where('transaction_id', $request->transaction_id);
                }

                if ($request->payment_status) {
                    if ($request->payment_status == 'due') {
                        $q->whereIn('payment_status', ['unpaid', 'partical']);
                    } else {
                        $q->where('payment_status', $request->payment_status);
                    }
                }

                if ($request->order_status) {
                    $q->where('order_status', $request->order_status);
                }

                if ($request->start_date && $request->end_date) {
                    $q->WhereBetween('created_at', [
                        Carbon::createFromFormat('Y-m-d', $request->start_date),
                        Carbon::createFromFormat('Y-m-d', $request->end_date)
                    ]);
                }
                if ($request->start_date && $request->end_date == null) {
                    $q->whereDate('created_at', '>=', Carbon::createFromFormat('Y-m-d', $request->start_date));
                }
            })
                ->get();
        } else {
            $this->orders = Order::latest()
                ->with('client')
                ->with('card_order')
                ->get();
        }

        return view('content.package.accessory.order.index', [
            'orders' => $this->orders,
        ]);
    }

    public function show($id)
    {
        $this->order_details = Order::with('client')->with('card_order')
            ->where('id', $id)
            ->first();
        // return response()->json($this->order_details);
        return view('content.package.accessory.order.show', [
            'order_details' => $this->order_details
        ]);
    }

    public function pay($id)
    {
        $this->pays = Order::where('id', $id)
            ->select('id', 'transaction_id', 'due', 'client_id')
            ->first();


        return view('content.package.accessory.order.pay', [
            'pays' => $this->pays,
        ]);
    }

    public function dopay(Request $request, $id)
    {
        $order_query = Order::find($id);
        $give_payment = Payment::where('order_id', $id)->first();
        $payment = $request->payment;

        if ($payment < $order_query->due && $payment > 0) {
            $this->status = 'partical';
        } elseif ($payment == 0) {
            $this->status = 'unpaid';
        } elseif ($payment == $order_query->due) {
            $this->status = 'paid';
        }

        $give_payment->create([
            'order_id' => $order_query->id,
            'pay' => $payment
        ]);

        if ($this->status == 'partical' || $this->status == 'unpaid' || $this->status == 'paid') {
            $order_payment = $order_query->update([
                'payment' => $request->payment,
                'payment_status' => $this->status,
            ]);

            if ($order_payment) {
                $order_query->decrement('due', $payment);
            }
        } else {
            return back()->with('status', 'Amount is grater than payable amount');
        }

        return redirect(route('admin.accessory.order.index'))->with('status', 'Payment done successfully');
    }

    public function updateOrder($id)
    {
        $updateOrderStatus = Order::find($id);
        return view('content.package.accessory.order.update-order', compact('updateOrderStatus'));
    }

    public function updateOrderStatus(Request $request, $id)
    {
        $updateOrderStatus = Order::find($id);
        $updateOrderStatus->update([
            'order_status' => $request->order_status
        ]);

        return redirect(route('admin.accessory.order.index'))->with('status', 'Order status updated');
    }

    public function paymentHistory($id)
    {
        $payment_history = Order::with('payments')
            ->where('id', $id)->first();

        // return $payment_history;
        return view('content.package.accessory.order.payment-history', compact('payment_history'));
    }
}
