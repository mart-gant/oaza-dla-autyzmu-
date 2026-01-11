<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Conversation extends Model
{
    protected $fillable = [
        'user_1_id',
        'user_2_id',
        'last_message_at',
    ];

    protected $casts = [
        'last_message_at' => 'datetime',
    ];

    public function user1(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_1_id');
    }

    public function user2(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_2_id');
    }

    public function messages(): HasMany
    {
        return $this->hasMany(Message::class);
    }

    /**
     * Get the other user in the conversation
     */
    public function getOtherUser(int $userId): ?User
    {
        if ($this->user_1_id === $userId) {
            return $this->user2;
        }
        
        if ($this->user_2_id === $userId) {
            return $this->user1;
        }

        return null;
    }

    /**
     * Check if user is participant in the conversation
     */
    public function hasUser(int $userId): bool
    {
        return $this->user_1_id === $userId || $this->user_2_id === $userId;
    }

    /**
     * Get or create a conversation between two users
     */
    public static function between(int $user1Id, int $user2Id): self
    {
        // Always store smaller ID first for consistency
        $sortedIds = [$user1Id, $user2Id];
        sort($sortedIds);
        
        return self::firstOrCreate([
            'user_1_id' => $sortedIds[0],
            'user_2_id' => $sortedIds[1],
        ]);
    }
}
