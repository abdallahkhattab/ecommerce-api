<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use App\Http\Resources\BrandResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'is_trendy' => $this->is_trendy,
            'is_available' => $this->is_available,
            'description' => $this->description,
            'price' => $this->price,
            'discount' => $this->discount,
            'final_price' => $this->price - $this->discount, // Calculated field for final price
            'image' => $this->image ? asset('storage/' . $this->image) : null, // Serve images via public URL
            'quantity' => $this->quantity,
            'brand' => new BrandResource($this->whenLoaded('brand')), // Include brand details
            'category' => new CategoryResource($this->whenLoaded('category')), // Include category details
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),
        ];
    }
}
