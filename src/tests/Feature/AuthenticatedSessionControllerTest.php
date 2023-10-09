<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthenticatedSessionControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function testDestroy()
    {
        // テスト用のPostを作成
        $post = \App\Models\Attendance::factory()->create();

        // ログインする
        $user = \App\Models\User::factory()->create();
        $this->actingAs($user);

        // destroyメソッドを実行
        $response = $this->delete('/post/' . $post->id);

        // レスポンスがリダイレクトされているかを確認
        $response->assertRedirect();

        // Postが削除されているかを確認
        $this->assertDeleted($post);
    }
}
