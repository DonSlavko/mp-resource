<?php

namespace App\Http\Resources\Admin;

use App\Attribute;
use Illuminate\Http\Resources\Json\JsonResource;

class AttributeResource extends JsonResource
{
    public $resource = Attribute::class;
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        if ($request->has('attribut_selector')) {
            return [
                'text' => $this->name,
                'value' => $this->id,

                'types' => AttributeValueResource::collection($this->whenLoaded('attributeValues')),
            ];
        }
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,

            'created_at' => $this->created_at->toDateTimeString(),
            'updated_at' => $this->updated_at->toDateTimeString(),

            'types' => AttributeValueResource::collection($this->whenLoaded('attributeValues')),
        ];
    }
}
