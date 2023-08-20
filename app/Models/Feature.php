<?php

namespace App\Models;

use App\Models\Traits\HasSpatieMedia;
use App\Models\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PawelMysior\Publishable\Publishable;
use RalphJSmit\Laravel\SEO\Support\HasSEO;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;


class Feature extends Model implements HasMedia
{
    use HasSlug, HasFactory, HasUuid, HasSEO, HasSpatieMedia;
    use LogsActivity, Publishable, InteractsWithMedia;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'slug',
        'description',
        'sequence_number',
        'image',
        'published_at'
    ];

    /**
     * The attributes for image fields.
     *
     * @var array
     */
    protected $imageFields = [
        'image',
    ];

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    /**
     * Get the options for logging the activity.
     */
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['name', 'description', 'sequence_number', 'image'])
            ->useLogName(get_class($this))
            ->logOnlyDirty();
    }

    /**
     * Register media conversion for cropping media to specific dimension.
     *
     * @param Media $media|null
     */
    public function registerMediaConversions(?Media $media = null): void
    {
        if ($media !== null) {
            $this->addMediaConversion('thumbnail')
                ->height(150);

            $this->addMediaConversion('big')
                ->fit(Manipulations::FIT_CROP, 1394, 974);
        }
    }
}