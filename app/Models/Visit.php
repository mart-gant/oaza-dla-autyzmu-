<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 */
class Visit extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'specialist_id',
        'facility_id',
        'visit_date',
        'status',
        'notes',
    ];

    protected $casts = [
        'visit_date' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function specialist()
    {
        return $this->belongsTo(User::class, 'specialist_id');
    }

    public function facility()
    {
        return $this->belongsTo(Facility::class);
    }
}
