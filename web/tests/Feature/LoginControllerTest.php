<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginControllerTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function setUp(): void
    {
        parent::setUp();

        // テストユーザー作成
        $this->user = User::factory()->create();
    }

    /**
     * Login test.
     *
     * @return void
     */
    public function test_登録済みのユーザーを認証して返却する()
    {
        $response = $this->json('POST', route('login'), [
            'email' => $this->user->email,
            'password' => 'password',
        ]);

        $response
            ->assertStatus(200)
            ->assertJson(['name' => $this->user->name]);

        $this->assertAuthenticatedAs($this->user);
    }

    /**
     * Logout test.
     *
     * @return void
     */
    public function test_認証済みのユーザーをログアウトさせる()
    {
        $response = $this->actingAs($this->user)
            ->json('POST', route('logout'));

        $response->assertStatus(200);
        $this->assertGuest();
    }
}
