<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Mail;
use App\Mail\YourMailable;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class EmailTest extends TestCase
{
    use RefreshDatabase;
    use WithoutMiddleware;

    public function test_registration_sends_verification_email()
    {
        Mail::fake();

        // 新規ユーザー登録のアクションを実行
        // （例えば、新規ユーザー登録のルートに対してPOSTリクエストを送信する）
        $response = $this->post('/register', [
            'name' => 'Test User',
            'email' => 'test99@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            // ユーザー登録のためのテストデータ...
        ]);

        $response->assertStatus(302);
        $response->assertRedirect('/');

        Mail::assertSent(YourMailable::class);
    }
}
