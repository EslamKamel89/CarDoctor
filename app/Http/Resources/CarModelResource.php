<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CarModelResource extends JsonResource {
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array {
        return [
            'id' => $this->id,
            'name' => $this->name, // From getNameAttribute()
            'name_ar' => $this->name_ar,
            'name_en' => $this->name_en,
            'year_range' => $this->year_range, // JSON → array
            'year_range_formatted' => $this->year_range_formatted,
            'created_at' => $this->created_at->format('Y-m-d'),
        ];
    }
}
