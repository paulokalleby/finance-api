<?php

namespace App\Traits;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

trait HasBelongsToUser
{
    protected static function bootHasBelongsToUser()
    {
        if (Auth::check() && Auth::user()->id) {

            static::creating(function (Model $model) {

                $model->user_id = Auth::user()->id;
            });

            static::addGlobalScope('user_id', function (Builder $query) {

                $query->where('user_id', Auth::user()->id);
            });
        } else {

            static::creating(function (Model $model) {

                if (Auth::check() && Auth::user()->id) {

                    $model->user_id = Auth::user()->id;
                }
            });

            static::addGlobalScope('user_id', function (Builder $query) {

                if (Auth::check() && Auth::user()->id) {

                    $query->where('user_id', Auth::user()->id);
                }
            });
        }
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
