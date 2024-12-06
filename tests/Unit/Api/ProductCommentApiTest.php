<?php

namespace Tests\Unit\Api;

use PHPUnit\Framework\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Comment;
use App\Models\Product;
use App\Models\User;

class ProductCommentApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_get_comments_for_product()
    {
        $product = Product::factory()->create();
        $comment = Comment::factory()->create(['product_id' => $product->id]);

        $response = $this->getJson(route('products.comments', ['product' => $product->id]));

        $response->assertStatus(200);
        $response->assertJsonFragment([
            'content' => $comment->content,
        ]);
    }

    public function test_authenticated_user_can_create_comment()
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        $product = Product::factory()->create();

        $response = $this->postJson(route('products.comments', ['product' => $product->id]), [
            'content' => 'Este é um comentário teste',
        ]);

        $response->assertStatus(201);
        $response->assertJsonFragment([
            'content' => 'Este é um comentário teste',
        ]);
    }

    public function test_unauthenticated_user_cannot_create_comment()
    {
        $product = Product::factory()->create();

        $response = $this->postJson(route('products.comments', ['product' => $product->id]), [
            'content' => 'Este é um comentário teste',
        ]);

        $response->assertStatus(401);
    }

    public function test_authenticated_user_can_update_comment()
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        $product = Product::factory()->create();
        $comment = Comment::factory()->create(['product_id' => $product->id, 'user_id' => $user->id]);

        $response = $this->putJson(route('products.comment.update', ['product' => $product->id, 'comment' => $comment->id]), [
            'content' => 'Comentário atualizado',
        ]);

        $response->assertStatus(200);
        $response->assertJsonFragment([
            'content' => 'Comentário atualizado',
        ]);
    }

    public function test_user_cannot_update_other_users_comment()
    {
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();
        $this->actingAs($user1, 'sanctum');

        $product = Product::factory()->create();
        $comment = Comment::factory()->create(['product_id' => $product->id, 'user_id' => $user2->id]);

        $response = $this->putJson(route('products.comment.update', ['product' => $product->id, 'comment' => $comment->id]), [
            'content' => 'Tentativa de atualização',
        ]);

        $response->assertStatus(403);
    }

    public function test_authenticated_user_can_delete_comment()
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        $product = Product::factory()->create();
        $comment = Comment::factory()->create(['product_id' => $product->id, 'user_id' => $user->id]);

        $response = $this->deleteJson(route('products.comment.delete', ['product' => $product->id, 'comment' => $comment->id]));

        $response->assertStatus(200);
        $this->assertDeleted($comment);
    }

    public function test_user_cannot_delete_other_users_comment()
    {
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();
        $this->actingAs($user1, 'sanctum');

        $product = Product::factory()->create();
        $comment = Comment::factory()->create(['product_id' => $product->id, 'user_id' => $user2->id]);

        $response = $this->deleteJson(route('products.comment.delete', ['product' => $product->id, 'comment' => $comment->id]));

        $response->assertStatus(403);
    }
}
