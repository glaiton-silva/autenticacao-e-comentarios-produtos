<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Obtém os comentários de um produto, incluindo o usuário e as edições associadas.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\JsonResponse
     */
    public function getComments(Product $product)
    {
        $comments = $product->comments()->with('user', 'edits')->get();
        return response()->json($comments);
    }
}
