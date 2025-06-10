namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'name', 'description', 'address', 'city', 'state', 
        'postal_code', 'country', 'phone', 'email', 'website', 'cuisine_type',
        'opening_time', 'closing_time', 'latitude', 'longitude', 'is_approved'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function certifications()
    {
        return $this->hasMany(Certification::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }
}