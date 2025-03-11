<?php

namespace App\Http\Controllers;

use App\Services\CustomerService;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    protected $customerService;

    public function __construct(CustomerService $customerService)
    {
        $this->customerService = $customerService;
    }

    // GET /customers
    public function index()
    {
        $customers = $this->customerService->getAllCustomers();
        return response()->json($customers);
    }

    // POST /customers
    public function store(Request $request)
    {
        $result = $this->customerService->createCustomer($request->all());

        if (isset($result['errors'])) {
            return response()->json($result['errors'], $result['status']);
        }

        return response()->json($result['customer'], $result['status']);
    }

    // GET /customers/{id}
    public function show($id)
    {
        $result = $this->customerService->getCustomerById($id);

        if (isset($result['message'])) {
            return response()->json(['message' => $result['message']], $result['status']);
        }

        return response()->json($result['customer']);
    }
}