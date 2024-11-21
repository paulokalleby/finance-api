<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MovimentResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'          => $this->id,
            'description' => $this->description,
            'type'        => $this->type,
            'value'       => $this->value,
            'created'     => $this->created_at,
            'updated'     => $this->updated_at,
            'category'    => new CategoryResource($this->category),
        ];
    }
}
