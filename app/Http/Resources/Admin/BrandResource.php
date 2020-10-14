<?php

namespace App\Http\Resources\Admin;

use App\Brand;
use Illuminate\Http\Resources\Json\JsonResource;

class BrandResource extends JsonResource
{
    public $resource = Brand::class;
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
