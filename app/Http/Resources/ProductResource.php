<?php

namespace App\Http\Resources;

use App\Product;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public $resource = Product::class;

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'sku' => $this->sku,
            'stock_quantity' => $this->stock_quantity,
            'category_id' => $this->category_id,
            'variation_id' => $this->variation_id,
            'created_at' => $this->created_at->toDateTimeString(),
            'updated_at' => $this->updated_at->toDateTimeString(),

            'category' => new CategoryResource($this->whenLoaded('category')),
            'variation' => new VariationResource($this->whenLoaded('variation')),
            'attributes' => AttributeResource::collection($this->whenLoaded('attributes')),
            'attributeValues' => AttributeValueResource::collection($this->whenLoaded('attributeValues')),
        ];
    }
}
