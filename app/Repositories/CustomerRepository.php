<?php

namespace App\Repositories;

use App\Models\Customer;
use Illuminate\Support\Facades\Log;

class CustomerRepository
{
    public function findAll()
    {
        return Customer::with('address')->get();
    }

    public function findById(int $id)
    {
        $data = Customer::with('address')->where('id', $id)->first();

        if (!$data) {
            Log::warning("Customer Repository : Customer " . $id . " not found");
        }

        return $data;
    }

    public function create(array $array)
    {
        $data = Customer::create([
            'title' => $array['title'],
            'name' => $array['name'],
            'gender' => $array['gender'],
            'phone_number' => $array['phone_number'],
            'image' => $array['image'],
            'email' => $array['email']
        ]);

        if (!$data) {
            Log::error("Customer Repository : Failed to create Customer");
        }

        return $data;
    }

    public function update(array $array, int $id)
    {
        $data = Customer::where('id', $id)->update([
            'title' => $array['title'],
            'name' => $array['name'],
            'gender' => $array['gender'],
            'phone_number' => $array['phone_number'],
            'image' => $array['image'],
            'email' => $array['email']
        ]);

        if (!$data) {
            Log::error("Customer Repository : Failed to update Customer");
        }

        return $data;
    }

    public function delete(int $id)
    {
        $data = $this->findById($id);
        $data->address()->delete();
        if ($data) {
            Log::info("Customer Repository : relation customer " . $id . "is deleted");
        }

        $result = Customer::where('id', $id)->delete();
        if (!$result) {
            Log::error("Customer Repository : Failed to delete Customer");
        }
        return $result;
    }
}
