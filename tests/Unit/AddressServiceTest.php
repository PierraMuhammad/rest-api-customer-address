<?php

namespace Tests\Unit;

use App\Models\Address;
use App\Models\Customer;
use App\Repositories\AddressRepository;
use App\Repositories\CustomerRepository;
use App\Services\AddressService;
use PHPUnit\Framework\TestCase;
use Mockery;
use Mockery\MockInterface;

class AddressServiceTest extends TestCase
{
    public function test_create_address(): void
    {
        $data = [
            "customer_id" => 2,
            "address" => "jln. ke hati mu",
            "district" => "Bintaro",
            "city" => "Jakarta Barat",
            "province" => "DKJ",
            "postal_code" => 1512
        ];
        $address = new Address($data);

        $customer = new Customer([
            'id' => 1,
            'title' => 'Mr',
            'name' => 'putra',
            'gender' => 'M',
            'phone_number' => '08123456789',
            'image' => 'default.jpg',
            'email' => 'putra123@gmail.com',
        ]);

        $addressRepository = Mockery::mock(AddressRepository::class, function (MockInterface $mock) use ($data, $address) {
            $mock->shouldReceive("create")->with($data)->once()->andReturn($address);
        });
        $customerRepository = Mockery::mock(CustomerRepository::class, function (MockInterface $mock) use ($data, $customer) {
            $mock->shouldReceive("findById")->with($data['customer_id'])->andReturn($customer);
        });

        $service = new AddressService($addressRepository, $customerRepository);
        $result = $service->create($data);

        $this->assertEquals($address, $result);
        $this->assertInstanceOf(Address::class, $result);
    }

    public function test_update_address(): void
    {
        $id = 1;
        $oldData = [
            "customer_id" => 2,
            "address" => "jln. ke hati mu",
            "district" => "Bintaro",
            "city" => "Jakarta Barat",
            "province" => "DKJ",
            "postal_code" => 1512
        ];
        $newData = [
            "customer_id" => 2,
            "address" => "jln. ninja ku",
            "district" => "Tunjungan",
            "city" => "Surabaya",
            "province" => "Jawa Timur",
            "postal_code" => 2706
        ];

        $oldAddress = new Address($oldData);
        $newAddress = new Address($newData);

        $addressRepository = Mockery::mock(AddressRepository::class, function (MockInterface $mock) use ($id, $newData, $oldAddress, $newAddress) {
            $mock->shouldReceive("findById")->with($id)->twice()->andReturn($oldAddress, $newAddress);
            $mock->shouldReceive("update")->with($id, $newData)->once()->andReturn(1);
        });
        $customerRepository = Mockery::mock(CustomerRepository::class);

        $service = new AddressService($addressRepository, $customerRepository);
        $result = $service->update($newData, $id);

        $this->assertEquals($newAddress, $result);
        $this->assertInstanceOf(Address::class, $result);
    }

    public function test_delete_address(): void
    {
        $id = 1;
        $data = [
            'title' => 'Mr',
            'name' => 'putra',
            'gender' => 'M',
            'phone_number' => '08123456789',
            'image' => 'default.jpg',
            'email' => 'putra123@gmail.com',
        ];
        $address = new Address($data);

        $addressRepository = Mockery::mock(AddressRepository::class, function (MockInterface $mock) use ($id, $address) {
            $mock->shouldReceive("findById")->with($id)->andReturn($address);
            $mock->shouldReceive("delete")->with($id)->andReturn(true);
        });
        $customerRepository = Mockery::mock(CustomerRepository::class);

        $service = new AddressService($addressRepository, $customerRepository);
        $result = $service->delete($id);

        $this->assertEquals("Ok", $result);
    }
}
