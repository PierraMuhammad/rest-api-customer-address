<?php

namespace App\Repositories;

use App\Models\Address;
use Illuminate\Support\Facades\Log;

class AddressRepository
{
    public function findById(int $id)
    {
        $data = Address::where('id', $id)->first();
        if (!$data) {
            Log::warning("Address Repository : Address " . $id . " not found");
        }

        return $data;
    }

    public function create(array $array)
    {
        $data = Address::create([
            'customer_id' => $array['customer_id'],
            'address' => $array['address'],
            'district' => $array['district'],
            'city' => $array['city'],
            'province' => $array['province'],
            'postal_code' => $array['postal_code'],
        ]);

        if (!$data) {
            Log::error("Address Repository : Failed to create Address");
        }
        return $data;
    }

    public function update(int $id, array $array)
    {
        $data = Address::where('id', $id)->update([
            'address' => $array['address'],
            'district' => $array['district'],
            'city' => $array['city'],
            'province' => $array['province'],
            'postal_code' => $array['postal_code'],
        ]);

        if (!$data) {
            Log::error("Address Repository : Failed to update Address");
        }

        return $data;
    }

    public function delete(int $id)
    {
        $result = Address::where('id', $id)->delete();
        if (!$result) {
            Log::error("Customer Repository : Failed to delete Customer");
        }

        return $result;
    }
}
