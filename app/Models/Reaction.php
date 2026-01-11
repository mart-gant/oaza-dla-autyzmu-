<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $user_id
 * @property string $type
 * @property int $reactable_id
 * @property string $reactable_type
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 */
class Reaction extends Model
{
    use HasFactory;
    
    protected $fillable = ['user_id', 'type', 'reactable_id', 'reactable_type'];
    
    /**
     * Relacja polimorficzna - obiekt, który otrzymał reakcję
     */
    public function reactable()
    {
        return $this->morphTo();
    }
    
    /**
     * Relacja: użytkownik, który dodał reakcję
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
