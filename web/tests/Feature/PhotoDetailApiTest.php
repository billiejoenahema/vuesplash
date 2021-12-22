<?php

namespace Tests\Feature;

use App\Models\Comment;
use App\Models\Photo;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PhotoDetailApiTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /**
     * @test
     */
    public function test_正しい構造のJSONを返却する()
    {
        Photo::factory()->create()->each(function ($photo) {
            $photo->comments()->saveMany(Comment::factory, 3);
        });
        $photo = Photo::firstOrFail();

        $response = $this->json('GET', route('photo.show', [
            'id' => $photo->id,
        ]));

        $response->assertStatus(200)
            ->assertJsonFragment([
                'id' => $photo->id,
                'url' => $photo->url,
                'user' => [
                    'name' => $photo->user->name,
                ],
                'comments' => $photo->comments
                    ->sortByDesc('id')
                    ->map(function ($comment) {
                        return [
                            'author' => [
                                'name' => $comment->author->name,
                            ],
                            'content' => $comment->content,
                        ];
                    })
                    ->all(),
            ]);
    }
}
