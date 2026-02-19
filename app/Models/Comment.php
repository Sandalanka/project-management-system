<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    /** @use HasFactory<\Database\Factories\CommentFactory> */
    use HasFactory;

    protected $fillable = [
        'body',
        'task_id',
        'user_id'
    ];
    /**
     *
     * Summary: Get the task that this comment belongs to.
     *
     * @return BelongsTo
     */
    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    /**
     *
     * Summery: Get the user who authored this comment.
     *
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
