<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WalletResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'      => $this->id,
            'evenue'  => $this->evenue,
            'expense' => $this->expense,
            'created' => $this->created_at,
            'updated' => $this->updated_at,
        ];
    }
}
