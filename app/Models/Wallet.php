<?php

namespace App\Models;

use App\Traits\HasBelongsToUser;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Wallet extends Model
{
    use HasFactory, HasUuids, SoftDeletes, HasBelongsToUser;

    protected $fillable = [
        'user_id',
        'revenue',
        'expense',
    ];

    protected function revenue(): Attribute
    {
        return Attribute::make(
            set: function ($value) {
                if (is_string($value) && str_contains($value, ',')) {
                    return (float) str_replace(",", ".", str_replace(".", "", $value));
                }
                return $value;
            },
        );
    }

    protected function expense(): Attribute
    {
        return Attribute::make(
            set: function ($value) {
                if (is_string($value) && str_contains($value, ',')) {
                    return (float) str_replace(",", ".", str_replace(".", "", $value));
                }
                return $value;
            },
        );
    }

    public function moviments(): HasMany
    {
        return $this->hasMany(Moviment::class);
    }
}
