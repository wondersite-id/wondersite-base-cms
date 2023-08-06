<?php

namespace App\Models;

use App\Models\Traits\HasUuid;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;


class Menu extends Model
{
    use HasUuid, HasFactory;
    use LogsActivity;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'parent_id',
        'name',
        'sequence_number',
        'type',
        'url',
        'is_open_in_new_tab',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'is_open_in_new_tab' => 'boolean',
    ];

    /**
     * Get the options for logging the activity.
     */
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly([
                'parent_id',
                'name',
                'sequence_number',
                'type',
                'url',
                'is_open_in_new_tab',
            ])
            ->useLogName('menu')
            ->logOnlyDirty();
    }

    /**
     * Get the parent that owns the menu.
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(Menu::class);
    }

    /**
     * Get the childs for the menu.
     */
    public function childs(): HasMany
    {
        return $this->hasMany(Menu::class, 'parent_id');
    }

    /**
     * Function to check whether the menu can be open in new tab or not
     */
    public function isNewTab()
    {
        return $this->is_open_in_new_tab;
    }

    /**
     * Scope a query to only include root menus.
     */
    public function scopeRoot(Builder $query): void
    {
        $query->whereNull('parent_id');
    }

    /**
     * Scope a query to only include children menus.
     */
    public function scopeChild(Builder $query): void
    {
        $query->whereNotNull('parent_id');
    }
}