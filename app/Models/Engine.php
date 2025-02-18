<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Engine extends Model
{
    protected $fillable = ['name', 'hp', 'moment'];

    //
    /**
     * Summary of modifications
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function modifications(): BelongsToMany
    {
        return $this->belongsToMany(Models::class, 'engine_to_models');
    }

    /**
     * Summary of raceCards
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function raceCards(): HasMany
    {
        return $this->hasMany(RaceCard::class);
    }

    /**
     * Summary of scopeFilter
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $filter
     * @return void
     */
    public function scopeFilter(Builder $query, string $filter)
    {
        $query->whereLike('name', '%' . $filter . '%');
    }
}
