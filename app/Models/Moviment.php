<?php

namespace App\Models;

use App\Enums\MovimentTypeEnum;
use App\Traits\HasBelongsToUser;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Moviment extends Model
{
    use HasFactory, HasUuids, HasBelongsToUser;

    protected $fillable = [
        'user_id',
        'wallet_id',
        'category_id',
        'description',
        'type',
        'value',
    ];

    protected function casts(): array
    {
        return [
            'type' => MovimentTypeEnum::class,
        ];
    }

    protected function value(): Attribute
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

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function wallet(): BelongsTo
    {
        return $this->belongsTo(Wallet::class);
    }
}
