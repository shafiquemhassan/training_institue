<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'title','slug','excerpt','description','thumbnail','featured_image',
        'meta_title','meta_description','published_at','status','video_url','created_by',
    ];

    protected $casts = [
        'status' => 'boolean',
        'published_at' => 'datetime',
    ];

    // Creator
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // Many-to-many with ccategory
    public function ccategories()
    {
        return $this->belongsToMany(Ccategory::class, 'ccategory_course', 'course_id', 'ccategory_id')
                    ->withTimestamps();
    }

    protected static function booted(): void
    {
        static::creating(function (self $model) {
            // If slug empty or duplicated, generate a unique slug
            $model->slug = static::ensureUniqueSlug(
                filled($model->slug) ? Str::slug($model->slug) : Str::slug((string) $model->title)
            );

            if (blank($model->created_by) && auth()->check()) {
                $model->created_by = auth()->id();
            }
        });

        static::updating(function (self $model) {
            // Only re-generate if slug left blank or collides
            if (blank($model->slug)) {
                $model->slug = Str::slug((string) $model->title);
            }
            $model->slug = static::ensureUniqueSlug($model->slug, $model->getKey());
        });
    }

    /**
     * Ensure `slug` is unique in courses table (appends -2, -3, ...).
     */
    public static function ensureUniqueSlug(string $baseSlug, ?int $ignoreId = null): string
    {
        // Respect DB length (e.g., 180). Keep headroom for suffixes.
        $max = 180;
        $baseSlug = Str::limit($baseSlug, $max, '');  // no ellipsis

        $slug = $baseSlug;
        $i = 2;

        $exists = static::query()
            ->when($ignoreId, fn ($q) => $q->whereKeyNot($ignoreId))
            ->where('slug', $slug)
            ->exists();

        while ($exists) {
            $suffix = "-{$i}";
            $slug = Str::limit($baseSlug, $max - strlen($suffix), '') . $suffix;

            $exists = static::query()
                ->when($ignoreId, fn ($q) => $q->whereKeyNot($ignoreId))
                ->where('slug', $slug)
                ->exists();

            $i++;
        }

        return $slug;
    }

    protected static function uniqueSlug(string $base, ?int $ignoreId = null): string
    {
        $slug = $base; $i = 1;
        while (static::query()
            ->when($ignoreId, fn($q) => $q->whereKeyNot($ignoreId))
            ->where('slug',$slug)->exists()
        ) { $slug = $base.'-'.$i++; }
        return $slug;
    }
  
}