<?php

namespace App\Http\Controllers;

use App\Services\AddressService;
use Exception;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function __construct(
        protected AddressService $addressService,
    ) {}

    public function create(Request $request)
    {
        try {
            $validate = $request->validate([
                'customer_id' => 'required|integer',
                'address' => 'required',
                'district' => 'required',
                'city' => 'required',
                'province' => 'required',
                'postal_code' => 'required',
            ]);
            $data = $this->addressService->create($validate);

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

    public function update(Request $request, $id)
    {
        try {
            $validate = $request->validate([
                'address' => 'required',
                'district' => 'required',
                'city' => 'required',
                'province' => 'required',
                'postal_code' => 'required',
            ]);
            $data = $this->addressService->update($validate, $id);

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

    public function delete($id)
    {
        try {
            $message = $this->addressService->delete($id);

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
