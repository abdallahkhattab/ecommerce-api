<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use App\Http\Resources\BrandResource;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *     schema="Product",
 *     type="object",
 *     title="Product",
 *     description="Product model representation",
 *     properties={
 *         @OA\Property(property="id", type="integer", example=1),
 *         @OA\Property(property="name", type="string", example="Laptop"),
 *         @OA\Property(property="price", type="number", format="float", example=799.99),
 *         @OA\Property(property="is_available", type="boolean", example=true),
 *         @OA\Property(property="brand", type="object", ref="#/components/schemas/Brand"),
 *         @OA\Property(property="category", type="object", ref="#/components/schemas/Category"),
 *         @OA\Property(property="created_at", type="string", format="date-time"),
 *         @OA\Property(property="updated_at", type="string", format="date-time")
 *     }
 * )
 */
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
            'user_id' =>$this->user_id,
            'name' => $this->name,
            'slug' => $this->slug,
            'description' => $this->description,
            'price' => $this->price,
            'discount' => $this->discount,
            'final_price' => $this->price - $this->discount, // Calculated field for final price
            'quantity' => $this->quantity,
            'is_available' => $this->is_available,
            'image' => $this->image ? asset('storage/' . $this->image) : null, // Serve images via public URL
            'brand' => new BrandResource($this->whenLoaded('brand')), // Include brand details if loaded
            'category' => new CategoryResource($this->whenLoaded('category')), // Include category details if loaded
            'created_at' => $this->created_at?->format('Y-m-d H:i:s'), // Handle null timestamps
            'updated_at' => $this->updated_at?->format('Y-m-d H:i:s'), // Handle null timestamps
            'deleted_at' => $this->deleted_at?->format('Y-m-d H:i:s'), // Optional: Include deleted_at if applicable
        ];

    }
}
