<?php

namespace Tests\Feature;

use App\Models\Photo;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LikeApiTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();

        Photo::factory()->create();
        $this->photo = Photo::first();
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_フォトにいいねができる()
    {
        $response = $this->actingAs($this->user)
            ->json('PUT', route('photo.like', [
                'id' => $this->photo->id,
            ]));

        $response->assertStatus(200)
            ->assertJsonFragment([
                'photo_id' => $this->photo->id,
            ]);

        $this->assertEquals(1, $this->photo->likes()->count());
    }
}
