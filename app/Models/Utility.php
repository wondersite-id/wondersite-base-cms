<?php

namespace App\Models;

use App\Models\Traits\HasSpatieMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;


class Utility extends Model implements HasMedia
{
    use HasFactory, HasSpatieMedia;
    use LogsActivity, InteractsWithMedia;

    const SETTING_TYPE = [
        'home',
        'footer',
        'other',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'type',
        'form_type',
        'title',
        'description',
        'value',
    ];

    /**
     * Get the options for logging the activity.
     */
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly([
                'name',
                'type',
                'form_type',
                'title',
                'description',
                'value',
            ])
            ->useLogName(get_class($this))
            ->logOnlyDirty();
    }

    /**
     * Get the value indicating whether the IDs are incrementing.
     *
     * @return bool
     */
    public function getIncrementing()
    {
        return false;
    }

    /**
     * Get the auto-incrementing key type.
     *
     * @return string
     */
    public function getKeyType()
    {
        return 'string';
    }

    /**
     * Boot function of the model
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if ($model->getKey() === null) {
                $model->setAttribute($model->getKeyName(), Str::uuid()->toString());
            }
        });

        static::saved(function ($model) {
            $cacheName = "utility.{$model->name}";
            \Cache::forget($cacheName);
        });

        static::deleted(function ($model) {
            $cacheName = "utility.{$model->name}";
            \Cache::forget($cacheName);
        });
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

            $this->addMediaConversion('potrait')
                ->fit(Manipulations::FIT_CROP, 420, 465);

            $this->addMediaConversion('big')
                ->fit(Manipulations::FIT_CROP, 1394, 974);
        }
    }

    /**
     * Find setting by name
     *
     * @param string $name
     */
    public static function findByName($name)
    {
        return static::whereName($name)->first();
    }

    /**
     * Get function
     *
     * @param string $name
     */
    public static function get($name, $default = '')
    {
        $cacheName = "utility.$name";
        $value = \Cache::get($cacheName) ?: $default;

        if (\Schema::hasTable('utilities')) {
            if ($value === null || $value === '') {
                $instance = static::findByName($name);
                $value = $default;

                if ($instance) {
                    $value = $instance->value;
                }

                \Cache::put($cacheName, $value, 120);
            }
        }

        return $value;
    }
}