<?php

namespace App\Http\Controllers;

use App\Services\OrderService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    // GET /orders
    public function index()
    {
        $orders = $this->orderService->getAllOrders();
        return response()->json($orders);
    }

    // POST /orders
    public function store(Request $request)
    {
        $result = $this->orderService->createOrder($request->all());

        if (isset($result['errors'])) {
            return response()->json($result['errors'], $result['status']);
        }

        return response()->json($result, $result['status']);
    }

    // GET /orders/{id}
    public function show($id)
    {
        $result = $this->orderService->getOrderById($id);

        if (isset($result['message'])) {
            return response()->json(['message' => $result['message']], $result['status']);
        }

        return response()->json($result['order']);
    }
}
