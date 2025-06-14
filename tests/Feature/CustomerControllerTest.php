<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CustomerControllerTest extends TestCase
{
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_get_all_customer()
    {
        $response = $this->get('/api/customer');

        $response->assertStatus(200);
        $response->assertJsonFragment([
            'code' => 200,
            'message' => 'Ok',
        ]);
    }
}
