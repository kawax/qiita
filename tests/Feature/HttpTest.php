<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class HttpTest extends TestCase
{
    use RefreshDatabase;

    public function testUserHome()
    {
        Http::fake(
            [
                '*' => Http::response(json_decode(file_get_contents(__DIR__.'/../fixtures/items.json'))),
            ]
        );

        $user = factory(User::class)->create();

        $response = $this->actingAs($user)
                         ->get(route('home'));

        $response->assertStatus(200);
    }

    public function testDelete()
    {
        Http::fake();

        $user = factory(User::class)->create();

        $response = $this->actingAs($user)
                         ->delete(route('delete', 1));

        $response->assertRedirect(route('home'));
    }
}
