<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 */
class ForumPost extends Model
{
    use HasFactory;

    protected $fillable = [
        'body',
        'user_id',
        'forum_topic_id',
    ];

    protected $casts = [
        'body' => 'encrypted',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function topic()
    {
        return $this->belongsTo(ForumTopic::class, 'forum_topic_id');
    }
}
