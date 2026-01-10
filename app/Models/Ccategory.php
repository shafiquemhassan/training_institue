<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Ccategory extends Model
{
    use HasFactory;

    // Use the exact table name requested
    protected $table = 'ccategory';

    protected $fillable = [
        'title','slug','description','thumbnail',
        'meta_title','meta_description','status','created_by',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    // creator relation
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // Ensure slug exists & stays unique when saving
    protected static function booted(): void
    {
        static::creating(function (self $model) {
            if (blank($model->slug) && filled($model->title)) {
                $model->slug = static::uniqueSlug(Str::slug($model->title));
            }
            if (blank($model->created_by) && auth()->check()) {
                $model->created_by = auth()->id();
            }
        });

        static::updating(function (self $model) {
            if (blank($model->slug) && filled($model->title)) {
                $model->slug = static::uniqueSlug(Str::slug($model->title), $model->id);
            }
        });
    }

    protected static function uniqueSlug(string $base, ?int $ignoreId = null): string
    {
        $slug = $base;
        $i = 1;
        while (static::query()
            ->when($ignoreId, fn($q) => $q->where('id','<>',$ignoreId))
            ->where('slug',$slug)->exists()
        ) {
            $slug = $base.'-'.$i++;
        }
        return $slug;
    }
    public function courses()
    {
        return $this->belongsToMany(Course::class, 'ccategory_course', 'ccategory_id', 'course_id')
                    ->withTimestamps();
    }
}