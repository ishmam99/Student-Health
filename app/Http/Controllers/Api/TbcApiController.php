<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Color;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\OrderShip;
use App\Models\Product;
use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TbcApiController extends Controller
{
    public function order_store(Request $request)
    {
        $user_id = $request->user_id;
        $orderNo = 'OS-' . substr(md5(time()), 0, 6);
        $isValid = Order::query()->where('order_no', $orderNo)->first();
        if (!$isValid) {
            $orderNo . '1';
        }

        try {
            DB::beginTransaction();
            $order = Order::query()->create([
                'order_no'       => $orderNo,
                'user_id'        => $user_id,
                'total'          => $request->total,
                'item'           => $request->item,
                'discount'       => $request->discount,
                'tbc_amount'     => $request->tbc_amount,
                'cash_amount'    => $request->cash_amount,
                'status'         => 0,
                'txr_id'         => $request->txr_id,
                'payment_method' => $request->payment_method
            ]);

            /* order Product Summary */

            $address['user_id'] = $user_id;
            $address['order_id'] = $order->id;
            $address['mobile'] = $request->mobile;
            $address['district'] = $request->district;
            $address['division'] = $request->division;
            $address['thana'] = $request->thana;
            $address['address'] = $request->address;

            OrderShip::query()->create($address); /* SHipping information saved */
            foreach ($request->data as $product) {
                $pro = Product::query()->findOrFail($product['id']);
                $pro->stock_out += $product['qty'];
                $pro->save();
                OrderProduct::query()->create([
                    'order_id'   => $order->id,
                    'product_id' => $product['id'],
                    'qty'        => $product['qty'],
                    'price'      => $pro->price,
                    'tbc'        => $pro->tbc_amount,
                    'cash'       => $pro->cash_amount,
                    'status'     => 0,
                ]);
            }
            DB::commit();
            $data = [
                "status" => 202,
                "msg"    => "Order Successfully Placed!"
            ];

        } catch (Exception $e) {
            DB::rollback();

            $data = [
                "status" => 404,
                "msg"    => "Order Failed"
            ];

        }
        return json_encode($data);
    }


    public function cancel_order($id)
    {
        $product = OrderProduct::query()->findOrFail($id);
        $order = Order::query()->findOrFail($product->order_id);

        return view('front.pages.cancel', compact('product', 'order'));
    }

    public function shipping_add($id)
    {
        $address = OrderShip::query()->where('user_id', $id)->get();

        if (count($address) > 0) {
            return response()->json([
                $data['addresses'] = $address,
            ], 200);
        } else {
            return response()->json([
                $data['addresses'] = 'No Address',
            ], 404);
        }
    }
}
