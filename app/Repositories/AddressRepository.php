<?php

namespace App\Repositories;

use App\Models\Address;

class AddressRepository
{
    public function findById(int $id)
    {
        return Address::where('id', $id)->first();
    }

    public function create(array $array)
    {
        return Address::create([
            'customer_id' => $array['customer_id'],
            'address' => $array['address'],
            'district' => $array['district'],
            'city' => $array['city'],
            'province' => $array['province'],
            'postal_code' => $array['postal_code'],
        ]);
    }

    public function update(int $id, array $array)
    {
        return Address::where('id', $id)->update([
            'address' => $array['address'],
            'district' => $array['district'],
            'city' => $array['city'],
            'province' => $array['province'],
            'postal_code' => $array['postal_code'],
        ]);
    }

    public function delete(int $id)
    {
        return Address::where('id', $id)->delete();
    }
}
