<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     */
    public function test_shipments_route_is_available(): void
    {
        $response = $this->get('/shipments');

        $response->assertStatus(200);
    }
}
