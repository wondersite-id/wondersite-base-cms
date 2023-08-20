<?php

namespace App\Models;

use App\Models\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class ArticleType extends Model
{
    use HasUuid, HasFactory;
    use LogsActivity;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'sequence_number',
    ];

    /**
     * Get the options for logging the activity.
     */
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['name', 'sequence_number'])
            ->useLogName(get_class($this))
            ->logOnlyDirty();
    }

    /**
     * Get the articles for the article type.
     */
    public function articles(): HasMany
    {
        return $this->hasMany(Article::class);
    }
}
