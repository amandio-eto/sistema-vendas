<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ClientStoreTest extends TestCase
{

    /* @test */
    public function it_can_store_client_successfully()
    {
        $payload = [
            'client_name' => 'PT Esperanca',
            'client_id'   => 'CL-001',
            'email'       => 'client@test.com',
            'phone'       => '08123456789',
            'address'     => 'Dili',
        ];

        $response = $this->postJson('/api/clients', $payload);

        $response->assertStatus(200)
                 ->assertJson([
                     'code'      => 200,
                     'status'    => 'OK',
                     'condition' => 'Submitted',
                 ]);

        $this->assertDatabaseHas('clients', [
            'client_id' => 'CL-001',
            'email'     => 'client@test.com',
        ]);
    }

}
