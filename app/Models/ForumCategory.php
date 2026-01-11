<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 */
class ForumCategory extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $fillable = ['name'];
    
    /**
     * Relacja: kategoria może mieć wiele tematów
     */
    public function topics()
    {
        return $this->hasMany(ForumTopic::class);
    }
    
    /**
     * Domyślne sortowanie kategorii (np. alfabetycznie)
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('name');
    }
}

