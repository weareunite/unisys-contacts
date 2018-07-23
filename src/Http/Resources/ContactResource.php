<?php

namespace Unite\Contacts\Http\Resources;

use Unite\UnisysApi\Http\Resources\Resource;

class ContactResource extends Resource
{
    protected static $relations = [
        'country',
    ];

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        /** @var \Unite\Contacts\Models\Contact $this->resource */
        return [
            'id'                => $this->id,
            'type'              => $this->type,
            'name'              => $this->name,
            'surname'           => $this->surname,
            'company'           => $this->company,
            'street'            => $this->street,
            'zip'               => $this->zip,
            'city'              => $this->city,
            'country'           => new CountryResource($this->country),
            'reg_no'            => $this->reg_no,
            'tax_no'            => $this->tax_no,
            'vat_no'            => $this->vat_no,
            'web'               => $this->web,
            'email'             => $this->email,
            'telephone'         => $this->telephone,
            'description'       => $this->description,
            'custom_properties' => $this->custom_properties,
        ];
    }
}