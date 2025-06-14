<?php

namespace Tests\Unit;

use App\Models\Customer;
use App\Repositories\CustomerRepository;
use App\Services\CustomerService;
use Mockery;
use Mockery\MockInterface;
use PHPUnit\Framework\TestCase;

class CustomerServiceTest extends TestCase
{
    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    public function test_get_all_customer(): void
    {
        $customerRepository = Mockery::mock(CustomerRepository::class, function (MockInterface $mock) {
            $mock->shouldReceive("findAll")->once()->andReturn([]);
        });

        $service = new CustomerService($customerRepository);
        $result = $service->findAll();

        $this->assertIsArray($result);
    }

    public function test_find_customer_by_id(): void
    {
        $customer = new Customer([
            'id' => 1,
            'title' => 'Mr',
            'name' => 'putra',
            'gender' => 'M',
            'phone_number' => '08123456789',
            'image' => 'default.jpg',
            'email' => 'putra123@gmail.com',
        ]);

        $customerRepository = Mockery::mock(CustomerRepository::class, function (MockInterface $mock) use ($customer) {
            $mock->shouldReceive("findById")->with(1)->once()->andReturn($customer);
        });

        $service = new CustomerService($customerRepository);
        $result = $service->findById(1);

        $this->assertEquals($customer, $result);
        $this->assertEquals("Mr", $result->title);
        $this->assertEquals("putra", $result->name);
        $this->assertEquals("putra123@gmail.com", $result->email);
        $this->assertInstanceOf(Customer::class, $result);
    }

    public function test_create_customer(): void
    {
        $data = [
            'id' => 1,
            'title' => 'Mr',
            'name' => 'putra',
            'gender' => 'M',
            'phone_number' => '08123456789',
            'image' => 'default.jpg',
            'email' => 'putra123@gmail.com',
        ];
        $customer = new Customer($data);

        $customerRepository = Mockery::mock(CustomerRepository::class, function (MockInterface $mock) use ($data, $customer) {
            $mock->shouldReceive("create")->with($data)->once()->andReturn($customer);
        });

        $service = new CustomerService($customerRepository);
        $result = $service->create($data);

        $this->assertEquals($customer, $result);
        $this->assertInstanceOf(Customer::class, $result);
    }

    public function test_update_customer(): void
    {
        $id = 1;
        $oldData = [
            'title' => 'Mr',
            'name' => 'putra',
            'gender' => 'M',
            'phone_number' => '08123456789',
            'image' => 'default.jpg',
            'email' => 'putra123@gmail.com',
        ];
        $newData = [
            'title' => 'Mr',
            'name' => 'wahyu',
            'gender' => 'M',
            'phone_number' => '08123456789',
            'image' => 'default.jpg',
            'email' => 'wahyu123@gmail.com',
        ];

        $oldCustomer = new Customer($oldData);
        $newCustomer = new Customer($newData);

        $customerRepository = Mockery::mock(CustomerRepository::class, function (MockInterface $mock) use ($id, $newData, $oldCustomer, $newCustomer) {
            $mock->shouldReceive("findById")->with($id)->twice()->andReturn($oldCustomer, $newCustomer);
            $mock->shouldReceive("update")->with($newData, $id)->once()->andReturn(1);
        });

        $service = new CustomerService($customerRepository);
        $result = $service->update($newData, $id);

        $this->assertEquals("wahyu", $result->name);
        $this->assertNotEquals("putra123@gmail.com", $result->email);
        $this->assertNull($result->id);
        $this->assertInstanceOf(Customer::class, $result);
    }

    public function test_delete_customer(): void
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
        $customer = new Customer($data);

        $customerRepository = Mockery::mock(CustomerRepository::class, function (MockInterface $mock) use ($id, $customer) {
            $mock->shouldReceive("findById")->with($id)->andReturn($customer);
            $mock->shouldReceive("delete")->with($id)->andReturn(true);
        });

        $service = new CustomerService($customerRepository);
        $result = $service->delete($id);

        $this->assertEquals("Ok", $result);
    }
}
