<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::query()
            ->where('status', 0)
            ->paginate(10);
        $status = 0;
        $type = "New Order";
        return view('backend.order.order', compact('orders', 'status', 'type'));
    }

    public function view_shipping()
    {
        $orders = Order::query()
            ->where('status', 1)
            ->paginate(10);
        $status = 1;
        $type = "Shipping Order";
        return view('backend.order.order', compact('orders', 'status', 'type'));
    }

    public function view_delivered()
    {
        $orders = Order::query()
            ->where('status', 2)
            ->paginate(10);
        $status = 2;
        $type = "Delivered Order";
        return view('backend.order.order', compact('orders', 'status', 'type'));
    }

    public function view_canceled()
    {
        $orders = Order::query()
            ->where('status', 3)
            ->paginate(10);
        $status = 3;
        $type = "Canceled Order";
        return view('backend.order.order', compact('orders', 'status', 'type'));
    }

    public function shipping($id)
    {
        $order = Order::query()->findOrFail($id);
        $data['status'] = 1;
        $order->update($data);
        session()->flash('success', 'Order ready Status Updated');
        return redirect()->back();
    }

    public function delivered($id)
    {
        $order = Order::query()->findOrFail($id);
        $data['status'] = 2;
        $data['delivered_date'] = date('Y-m-d h:i:s');
        $order->update($data);

        $orderProduct = OrderProduct::query()->where('order_id', $id)->get();
        foreach ($orderProduct as $pro) {
            $data['status'] = 1;
            $pro->update($data);
        }
        session()->flash('success', 'The order is shipped successfully');
        return back();
//        return redirect()->route('order.invoice', $id);
    }

    public function cancel(Request $request)
    {
        $order = Order::query()->findOrFail($request->id);
        $data['status'] = 3;
        $data['cancel_date'] = date('Y-m-d h:i:s');

        $order->update($data);

        $orderProduct = OrderProduct::query()->where('order_id', $request->id)->get();
        foreach ($orderProduct as $pro) {
            $pro = Product::query()->findOrFail($pro->product_id);
            $pro->stock_out -= $pro->qty;
            $pro->save();
            $data['status'] = 2;
            $pro->update($data);
        }
        session()->flash('success', 'The order is cancel successfully');
        return redirect()->back();
    }

    public function invoice($id)
    {
        $order = Order::query()->findOrFail($id);
        return view('backend.order.invoice', compact('order'));
    }


}
