<?php

namespace App\Services;


use App\Repositories\CustomerRepository;
use Exception;
use Illuminate\Support\Facades\Log;


class CustomerService
{
    public function __construct(
        protected CustomerRepository $customerRepository
    ) {}

    public function findAll()
    {
        try {
            $data = $this->customerRepository->findAll();

            return $data;
        } catch (Exception $e) {
            Log::error("Customer Service : Error get customers => " . $e->getMessage());
            throw new Exception('Error get customers: ' . $e->getMessage());
        }
    }

    public function findById(int $id)
    {
        try {
            $data = $this->customerRepository->findById($id);
            if (!$data) {
                Log::warning('Customer Service : Customer ' . $id . ' not found');
                throw new Exception('Customer ' . $id . ' not found');
            }

            return $data;
        } catch (Exception $e) {
            Log::error('Customer Service : Error find customer => ' . $e->getMessage());
            throw new Exception('Error find customer: ' . $e->getMessage());
        }
    }

    public function create(array $arr)
    {
        try {
            $data = $this->customerRepository->create($arr);

            return $data?->makeHidden(['created_at', 'updated_at', 'id']);
        } catch (Exception $e) {
            Log::error('Customer Service : Error create customer => ' . $e->getMessage());
            throw new Exception('Error create customer: ' . $e->getMessage());
        }
    }

    public function update(array $arr, int $id)
    {
        try {
            $found = $this->customerRepository->findById($id);
            if (!$found) {
                Log::warning('Customer Service : Customer ' . $id . ' not found');
                throw new Exception('Customer ' . $id . ' not found');
            }

            $updated = $this->customerRepository->update($arr, $id);
            if (!$updated) {
                Log::warning('Customer Service : No rows affected');
                throw new Exception('No rows affected');
            }

            $data = $this->customerRepository->findById($id);
            return $data?->makeHidden(['created_at', 'updated_at', 'id']);
        } catch (Exception $e) {
            Log::error('Customer Service : Error update customer => ' . $e->getMessage());
            throw new Exception('Error update customer: ' . $e->getMessage());
        }
    }

    public function delete(int $id)
    {
        try {
            $found = $this->customerRepository->findById($id);
            if (!$found) {
                Log::warning('Customer Service : Customer ' . $id . ' not found');
                throw new Exception('Customer ' . $id . ' not found');
            }

            $data = $this->customerRepository->delete($id);
            if (!$data) {
                Log::warning('Customer Service : No rows affected');
                throw new Exception('No rows affected');
            }

            return "Ok";
        } catch (Exception $e) {
            Log::error('Customer Service : Error delete customer => ' . $e->getMessage());
            throw new Exception('Error delete customer: ' . $e->getMessage());
        }
    }
}
