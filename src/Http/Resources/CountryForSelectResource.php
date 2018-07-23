<?php

namespace Unite\Contacts\Http\Resources;

use Unite\Contacts\Models\Country;
use Unite\UnisysApi\Http\Resources\Resource;

class CountryForSelectResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        /** @var Country $this->resource */
        return [
            'id'                => $this->id,
            'name'              => $this->name,
        ];
    }
}