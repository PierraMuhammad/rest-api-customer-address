<?php

namespace App\Repositories;

use App\Models\Customer;

class CustomerRepository
{
    public function findAll()
    {
        return Customer::with('address')->get();
    }

    public function findById(int $id)
    {
        return Customer::with('address')->where('id', $id)->first();
    }

    public function create(array $array)
    {
        return Customer::create([
            'title' => $array['title'],
            'name' => $array['name'],
            'gender' => $array['gender'],
            'phone_number' => $array['phone_number'],
            'image' => $array['image'],
            'email' => $array['email']
        ]);
    }

    public function update(array $array, int $id)
    {
        return Customer::where('id', $id)->update([
            'title' => $array['title'],
            'name' => $array['name'],
            'gender' => $array['gender'],
            'phone_number' => $array['phone_number'],
            'image' => $array['image'],
            'email' => $array['email']
        ]);
    }

    public function delete(int $id)
    {
        $data = $this->findById($id);
        $data->address()->delete();

        return Customer::where('id', $id)->delete();
    }
}
