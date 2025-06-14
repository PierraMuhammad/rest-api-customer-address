<?php

namespace App\Http\Controllers;

use App\Services\CustomerService;
use Exception;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function __construct(
        protected CustomerService $customerService
    ) {}

    public function get()
    {
        try {
            $data = $this->customerService->findAll();

            return response()->json([
                'code' => 200,
                'message' => 'Ok',
                'data' => $data
            ]);
        } catch (Exception $e) {
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

            return response()->json([
                'code' => 200,
                'message' => 'Ok',
                'data' => $data
            ]);
        } catch (Exception $e) {
            return response()->json([
                'code' => $e->getCode(),
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

            return response()->json([
                'code' => 200,
                'message' => 'Ok',
                'data' => $result
            ]);
        } catch (Exception $e) {
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

            return response()->json([
                'code' => 200,
                'message' => 'Ok',
                'data' => $data
            ]);
        } catch (Exception $e) {
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

            return response()->json([
                'code' => 200,
                'message' => $message,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'code' => 500,
                'message' => $e->getMessage()
            ]);
        }
    }
}
