<?php

namespace Tests\Feature;

use App\Models\Photo;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class PhotoSubmitApiTest extends TestCase
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
     * @test
     */
    public function test_ファイルをアップロードできる()
    {
        // S3ではなくテスト用のストレージを使用する
        // → storage/framework/testing
        Illuminate\Support\Facades\Storage::fake('s3');

        $response = $this->actingAs($this->user)
            ->json('POST', route('photo.create'), [
                // ダミーファイルを作成して送信している
                'photo' => UploadedFile::fake()->image('photo.jpg'),
            ]);
        // レスポンスが201(CREATED)であること
        $response->assertStatus(201);
        $photo = Photo::first();
        Illuminate\Support\Facades\Storage::disk('s3')->assertExists('/', $photo->filename);
    }

    /**
     * @test
     */
    public function test_ファイル保存エラーの場合はDBへの挿入はしない()
    {
        // ストレージをモックして保存時にエラーを起こさせる
        Storage::shouldReceive('cloud')
            ->once()
            ->andReturnNull();

        $response = $this->actingAs($this->user)
            ->json('POST', route('photo.create'), [
                'photo' => UploadedFile::fake()->image('photo.jpg'),
            ]);

        // レスポンスが500(INTERNAL SERVER ERROR)であること
        $response->assertStatus(500);

        // データベースに何も挿入されていないこと
        $this->assertEmpty(Photo::all());
    }
}
