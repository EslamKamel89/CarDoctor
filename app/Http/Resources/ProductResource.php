<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource {
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'name_ar' => $this->name_ar,
            'name_en' => $this->name_en,
            'buy_price' => $this->buy_price,
            'sell_price' => $this->sell_price,
            'current_cost_price' => $this->current_cost_price,
            'quantity_on_hand' => $this->quantity_on_hand,
            'is_in_stock' => $this->is_in_stock,
            'category' => CategoryResource::make($this->whenLoaded('category')),
            'created_at' => $this->created_at->format('Y-m-d'),
            'deleted_at' => $this->deleted_at?->format('Y-m-d'),
        ];
    }
}
