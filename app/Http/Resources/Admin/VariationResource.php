<?php

namespace App\Http\Resources\Admin;

use App\Variation;
use Illuminate\Http\Resources\Json\JsonResource;

class VariationResource extends JsonResource
{
    public $resource = Variation::class;
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        if ($request->has('variation_selector')) {
            return [
                'text' => $this->name,
                'value' => $this->id,

                'types' => VariationValueResource::collection($this->whenLoaded('variationValues')),
            ];
        }
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,

            'created_at' => $this->created_at->toDateTimeString(),
            'updated_at' => $this->updated_at->toDateTimeString(),

            'types' => VariationValueResource::collection($this->whenLoaded('variationValues')),
        ];
    }
}
