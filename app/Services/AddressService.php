<?php

namespace App\Services;

use App\Repositories\AddressRepository;
use App\Repositories\CustomerRepository;
use Exception;
use Illuminate\Support\Facades\Log;

class AddressService
{
    public function __construct(
        protected AddressRepository $addressRepository,
        protected CustomerRepository $customerRepository
    ) {}

    public function create(array $array)
    {
        try {
            $found = $this->customerRepository->findById($array['customer_id']);
            if (!$found) {
                Log::warning("Address Service : Customer not found");
                throw new Exception('Customer not found, make sure create address for customer');
            }

            $data = $this->addressRepository->create($array);

            return $data?->makeHidden(['created_at', 'updated_at', 'id', 'customer_id']);;
        } catch (Exception $e) {
            Log::error('Address Service : Error create Address => ' . $e->getMessage());
            throw new Exception('Error create address: ' . $e->getMessage());
        }
    }

    public function update(array $array, $id)
    {
        try {
            $found = $this->addressRepository->findById($id);
            if (!$found) {
                Log::warning('Address Service : Address ' . $id . ' not found');
                throw new Exception('Address ' . $id . ' not found');
            }

            $updated = $this->addressRepository->update($id, $array);
            if (!$updated) {
                Log::warning('Address Service: No rows affected');
                throw new Exception('No rows affected');
            }

            $data = $this->addressRepository->findById($id);
            return $data?->makeHidden(['created_at', 'updated_at', 'id', 'customer_id']);;
        } catch (Exception $e) {
            Log::error('Address Service : Error update Address => ' . $e->getMessage());
            throw new Exception('Error update address: ' . $e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $found = $this->addressRepository->findById($id);
            if (!$found) {
                Log::warning('Address Service : Address ' . $id . ' not found');
                throw new Exception('Address not found');
            }

            $data = $this->addressRepository->delete($id);
            if (!$data) {
                Log::warning('Address Service : No rows affected');
                throw new Exception('No rows affected');
            }

            return "Ok";
        } catch (Exception $e) {
            Log::error('Address Service : Error delete Address => ' . $e->getMessage());
            throw new Exception('Error delete address: ' . $e->getMessage());
        }
    }
}
