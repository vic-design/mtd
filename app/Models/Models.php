<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Models extends Model
{
    //

    /**
     * Summary of mark
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function mark(): BelongsTo
    {
        return $this->belongsTo(Mark::class);
    }

    /**
     * Summary of modifications
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function engines(): BelongsToMany
    {
        return $this->belongsToMany(Engine::class, 'engine_to_models');
    }

    /**
     * Summary of raceCards
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function raceCards(): HasMany
    {
        return $this->hasMany(RaceCard::class);
    }
}
