<?php

namespace App\Models;

use App\Models\Traits\HasSpatieMedia;
use App\Models\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;


class Setting extends Model implements HasMedia
{
    use HasUuid, HasFactory, HasSpatieMedia;
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
            ->useLogName('setting')
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

            $this->addMediaConversion('potrait')
                ->fit(Manipulations::FIT_CROP, 420, 465);

            $this->addMediaConversion('big')
                ->fit(Manipulations::FIT_CROP, 1394, 974);
        }
    }
}