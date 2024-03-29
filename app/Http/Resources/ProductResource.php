<?php

namespace App\Http\Resources;

use App\Product;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public $resource = Product::class;

    public function toArray($request) {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'sku' => $this->sku,
            'charge' => $this->charge,
            'expires' => $this->expires->toDateString(),
            'category_id' => $this->category_id,
            'created_at' => $this->created_at->toDateTimeString(),
            'updated_at' => $this->updated_at->toDateTimeString(),

            'image' => $this->product_images()->first()->path,
            'brochure' => $this->brochure,
            'analysis' => $this->analysis,
            'images' => $this->product_images,

            'variations' => $this->variation,
            'variations_price' => $this->variationValues()->pluck('price'),
            'variationValues' => $this->variationValues,
            'variation_stock' => $this->variationValues()->sum('quantity'),
            'category' => new CategoryResource($this->whenLoaded('category')),
            // 'variation' => new VariationResource($this->whenLoaded('variation')),
            // 'attributes' => AttributeResource::collection($this->whenLoaded('attributes')),
            // 'attributeValues' => AttributeValueResource::collection($this->whenLoaded('attributeValues')),
            //'variations' => VariationResource::collection($this->whenLoaded('variation')),
            //'variationValues' => VariationValueResource::collection($this->whenLoaded('variatonValues')),
        ];
    }
}
