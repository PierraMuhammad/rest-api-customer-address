<?php

namespace App\Http\Controllers;

use App\Services\CustomerService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CustomerController extends Controller
{
    public function __construct(
        protected CustomerService $customerService
    ) {}

    public function get()
    {
        try {
            $data = $this->customerService->findAll();

            Log::info('Customer Controller : Success get all Customers');
            return response()->json([
                'code' => 200,
                'message' => 'Ok',
                'data' => $data
            ]);
        } catch (Exception $e) {
            Log::error('Customer Controller : got error => ' . $e->getMessage());
            return response()->json([
                'code' => 500,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function find($id)
    {
        try {
            $data = $this->customerService->findById($id);

            Log::info('Customer Controller : Success find Customer by id');
            return response()->json([
                'code' => 200,
                'message' => 'Ok',
                'data' => $data
            ]);
        } catch (Exception $e) {
            Log::error('Customer Controller : got error => ' . $e->getMessage());
            return response()->json([
                'code' => 500,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function create(Request $request)
    {
        try {
            $validate = $request->validate([
                'title' => 'required|string',
                'name' => 'required|string',
                'gender' => 'required|string',
                'phone_number' => 'required|string',
                'image' => 'required',
                'email' => 'required|email',
            ]);
            $result = $this->customerService->create($validate);

            Log::info('Customer Controller : Success create Customer');
            return response()->json([
                'code' => 200,
                'message' => 'Ok',
                'data' => $result
            ]);
        } catch (Exception $e) {
            Log::error('Customer Controller : got error => ' . $e->getMessage());
            return response()->json([
                'code' => 500,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $validate = $request->validate([
                'title' => 'required',
                'name' => 'required',
                'gender' => 'required',
                'phone_number' => 'required',
                'image' => 'required',
                'email' => 'required|email',
            ]);
            $data = $this->customerService->update($validate, $id);

            Log::info('Customer Controller : Success update Customer');
            return response()->json([
                'code' => 200,
                'message' => 'Ok',
                'data' => $data
            ]);
        } catch (Exception $e) {
            Log::error('Customer Controller : got error => ' . $e->getMessage());
            return response()->json([
                'code' => $e->getCode(),
                'message' => $e->getMessage()
            ]);
        }
    }

    public function delete($id)
    {
        try {
            $message = $this->customerService->delete($id);

            Log::info('Customer Controller : Success delete Customer');
            return response()->json([
                'code' => 200,
                'message' => $message,
            ]);
        } catch (Exception $e) {
            Log::error('Customer Controller : got error => ' . $e->getMessage());
            return response()->json([
                'code' => 500,
                'message' => $e->getMessage()
            ]);
        }
    }
}
