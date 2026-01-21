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
        'phone', 'email', 'website', 'latitude', 'longitude', 'available_spots', 'type',
        'source', 'verification_status', 'verified_by', 'verified_at', 'verification_notes'
    ];

    protected $casts = [
        'verified_at' => 'datetime',
        'is_verified' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function verifiedBy()
    {
        return $this->belongsTo(User::class, 'verified_by');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    /**
     * Sprawdź czy placówka jest zweryfikowana
     */
    public function isVerified(): bool
    {
        return in_array($this->verification_status, ['verified', 'certified']);
    }

    /**
     * Sprawdź czy placówka ma certyfikat
     */
    public function isCertified(): bool
    {
        return $this->verification_status === 'certified';
    }

    /**
     * Pobierz badge statusu weryfikacji
     */
    public function getVerificationBadge(): string
    {
        return match($this->verification_status) {
            'certified' => '<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">✓ Certyfikowana</span>',
            'verified' => '<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">✓ Zweryfikowana</span>',
            'flagged' => '<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">⚠ Zgłoszono problem</span>',
            default => '<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">Niezweryfikowana</span>',
        };
    }

    /**
     * Pobierz nazwę statusu
     */
    public function getVerificationStatusName(): string
    {
        return match($this->verification_status) {
            'certified' => 'Certyfikowana',
            'verified' => 'Zweryfikowana',
            'flagged' => 'Zgłoszono problem',
            default => 'Niezweryfikowana',
        };
    }
}
