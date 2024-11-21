<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'      => $this->id,
            'name'    => $this->name,
            'icon'    => $this->icon,
            'created' => Carbon::make($this->created_at)->format('d/m/Y - H:i'),
            'updated' => $this->updated_at->diffForHumans(),
        ];
    }
}
