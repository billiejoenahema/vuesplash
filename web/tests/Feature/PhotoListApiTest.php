<?php

namespace Tests\Feature;

use App\Models\Photo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PhotoListApiTest extends TestCase
{
    use RefreshDatabase;

    /**
     * フォト一覧取得テスト
     *
     * @return void
     */
    public function test_フォト一覧を取得する()
    {

        // 5つの写真データを生成する
        $photo = Photo::factory()->create();

        $response = $this->json('GET', route('photo.index'));

        // 生成した写真データを作成日降順で取得
        $photos = $photo->with(['user'])->orderBy('created_at', 'desc')->get();
        // data項目の期待値
        $expected_data = $photos->map(function ($photo) {
            return [
                'id' => $photo->id,
                'url' => $photo->url,
                'user' => [
                    'name' => $photo->user->name,
                ],
            ];
        })
            ->all();
        $response->assertStatus(200)
            // レスポンスJSONのdata項目に含まれる要素が5つであること
            ->assertJsonCount(5, 'data')
            // レスポンスJSONのdata項目が期待値と合致すること
            ->assertJsonFragment([
                'data' => $expected_data,
            ]);
    }
}
