<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RoleResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'          => $this->id,
            'name'        => $this->name,
            'active'      => $this->active,
            'updated'     => $this->updated_at->diffForHumans(),
            'permissions' => PermissionResource::collection(
                $this->whenLoaded('permissions')
            ),
        ];
    }
}
