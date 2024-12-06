<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommentEdit extends Model
{
    use HasFactory;

    protected $fillable = ['comment_id', 'previous_content'];

    public function comment()
    {
        return $this->belongsTo(Comment::class);
    }
}
