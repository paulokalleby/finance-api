<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'          => $this->id,
            'name'        => $this->name,
            'email'       => $this->email,
            'type'        => $this->type,
            'active'      => $this->active,
            'wallet'      => new WalletResource($this->wallet),
            'permissions' => $this->permissions(),
        ];
    }
}
