<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class nhomRS extends JsonResource
{
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
            'group' => $this->group,
            'point' => $this->point,
        ];
    }
}
