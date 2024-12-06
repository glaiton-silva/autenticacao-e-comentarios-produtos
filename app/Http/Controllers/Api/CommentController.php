<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\CommentEdit;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Armazena um novo comentário associado a um produto.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request, Product $product)
    {
        $request->validate([
            'content' => 'required|string|max:255',
        ]);

        $comment = new Comment();
        $comment->content = $request->content;
        $comment->user_id = Auth::id();
        $product->comments()->save($comment);

        return response()->json($comment, 201);
    }

    /**
     * Atualiza o conteúdo de um comentário existente, registrando a versão anterior.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Product $product
     * @param \App\Models\Comment $comment
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Product $product, Comment $comment)
    {
        if ($request->user()->id !== $comment->user_id) {
            return response()->json(['error' => 'Você não tem permissão para editar este comentário.'], 403);
        }

        $validated = $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        CommentEdit::create([
            'comment_id' => $comment->id,
            'previous_content' => $comment->content,
        ]);

        $comment->content = $validated['content'];
        $comment->save();

        return response()->json(['message' => 'Comentário atualizado com sucesso!', 'comment' => $comment]);
    }

    /**
     * Remove um comentário associado a um produto.
     *
     * @param \App\Models\Product $product
     * @param \App\Models\Comment $comment
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Product $product, Comment $comment)
    {
        if ($comment->user_id !== Auth::id()) {
            return response()->json(['message' => 'Você não tem permissão para excluir este comentário.'], 403);
        }

        $comment->delete();

        return response()->json(['message' => 'Comentário excluído com sucesso.', 'success' => true]);
    }

}