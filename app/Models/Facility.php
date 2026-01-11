<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int|null $user_id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 */
class Facility extends Model
{
    use HasFactory;

    protected $table = 'facilities'; // Określenie nazwy tabeli

    protected $fillable = [
        'user_id', 'name', 'description', 'address', 'city', 'province', 'postal_code', 
        'phone', 'email', 'website', 'latitude', 'longitude', 'available_spots'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
