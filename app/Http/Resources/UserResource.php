<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $token = $this->tokens()->latest()->first();

        return [
            'id'      => $this->id,
            'name'    => $this->name,
            'email'   => $this->email,
            'type'    => $this->type,
            'active'  => $this->active,
            'updated' => $this->updated_at->diffForHumans(),
            'wallet'  => new WalletResource($this->wallet),
            'roles'   => RoleResource::collection(
                $this->whenLoaded('roles')
            ),
        ];
    }
}
