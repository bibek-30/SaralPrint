<?php

namespace App\Http\Resources;

use Faker\Guesser\Name;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'name' =>$this->name,
            'desc'=>$this->desc,
            'category_id'=>$this->category_id,
            'image'=>$this->image,
        ];
    }
}
