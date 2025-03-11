<?php

namespace App\Services;

use App\Models\Customer;
use Illuminate\Support\Facades\Validator;

class CustomerService
{
    public function getAllCustomers()
    {
        return Customer::all();
    }

    public function createCustomer($data)
    {
        $validator = Validator::make($data, [
            'name'  => 'required|string',
            'email' => 'required|email|unique:customers',
            'phone' => 'required|string',
        ]);

        if ($validator->fails()) {
            return ['errors' => $validator->errors(), 'status' => 422];
        }

        $customer = Customer::create($data);
        return ['customer' => $customer, 'status' => 201];
    }

    public function getCustomerById($id)
    {
        $customer = Customer::find($id);
        if (!$customer) {
            return ['message' => 'Customer not found', 'status' => 404];
        }
        return ['customer' => $customer, 'status' => 200];
    }
}