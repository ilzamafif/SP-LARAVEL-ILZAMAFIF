<?php

namespace App\Services;

use App\Models\Order;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;

class OrderService
{
    public function getAllOrders()
    {
        return Order::with('customer')->get();
    }

    public function createOrder($data)
    {
        $validator = Validator::make($data, [
            'customer_id' => 'required|exists:customers,id',
            'total_price' => 'required|numeric',
            'status'      => 'nullable|in:pending,completed,canceled'
        ]);

        if ($validator->fails()) {
            return ['errors' => $validator->errors(), 'status' => 422];
        }

        $data['order_date'] = now();
        $data['status'] = $data['status'] ?? 'pending';

        $order = Order::create($data);

        $discountData = $this->calculateDiscount($order);
        $this->notifyCustomer($order, $discountData);

        return ['order' => $order, 'discount' => $discountData, 'status' => 201];
    }

    public function getOrderById($id)
    {
        $order = Order::with('customer')->find($id);
        if (!$order) {
            return ['message' => 'Order not found', 'status' => 404];
        }
        return ['order' => $order, 'status' => 200];
    }

    private function calculateDiscount($order)
    {
        $discountResponse = Http::post(config('nodeUrl.node_url'). "/calculate-discount", [
            'customer_id' => $order->customer_id,
            'total_price' => $order->total_price,
        ]);
        return $discountResponse->json();
    }

    private function notifyCustomer($order, $discountData)
    {
        Http::post(config('nodeUrl.node_url'). "/notify-order", [
            'order_id'    => $order->id,
            'customer_id' => $order->customer_id,
            'total_price' => $order->total_price,
            'status'      => $order->status,
            'discount'    => $discountData,
        ]);
    }
}