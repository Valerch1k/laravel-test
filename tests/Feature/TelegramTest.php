<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TelegramTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_boot_response()
    {
        $response = $this->post('api/hook/boot');

        $response->assertStatus(200);
    }

}
