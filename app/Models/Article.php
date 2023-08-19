<?php

namespace App\Models;

use App\Models\Traits\HasSpatieMedia;
use App\Models\Traits\HasUuid;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;
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

class Article extends Model implements HasMedia
{
    use HasSlug, HasFactory, HasUuid, HasSEO, HasSpatieMedia;
    use LogsActivity, Publishable, InteractsWithMedia;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'article_type_id',
        'name',
        'slug',
        'short_description',
        'content',
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
     * Returns an estimated reading time in a string
     * @param  string $content the content to be read
     * @param int $wpm
     * @return string estimated read time eg. 1 minute, 30 seconds
     **/
    private function getEstimateReadingTime($content, $wpm = 200)
    {
        $wordCount = str_word_count(strip_tags($content));

        $minutes = (int) floor($wordCount / $wpm);
        $seconds = (int) floor($wordCount % $wpm / ($wpm / 60));   

        if ($minutes === 0) {
            return $seconds . " " . Str::of('second')->plural($seconds);
        } else {
            return $minutes . " " . Str::of('minute')->plural($minutes);
        }
    }

    protected function timeToRead(): Attribute
    {
        return Attribute::make(
            get: function ($value, $attributes) {
                $value = $this->getEstimateReadingTime($attributes['content']);
                return $value;
            }
        );
    }

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
            ->logOnly([
                'article_type_id',
                'name',
                'slug',
                'short_description',
                'content',
                'sequence_number',
                'image',
                'published_at'
            ])
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

    /**
     * Get the type that owns the article.
     */
    public function type(): BelongsTo
    {
        return $this->belongsTo(ArticleType::class, 'article_type_id', 'id');
    }
}
