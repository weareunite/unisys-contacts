<?php

namespace Unite\Contacts\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Unite\Contacts\Models\Contact;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $allRules = [
            'type'              => 'in:' . implode(',', Contact::getTypes()) . '|nullable',
            'name'              => 'string|max:40',
            'surname'           => 'string|max:40|nullable',
            'company'           => 'string|max:40|nullable',
            'street'            => 'string|max:40|nullable',
            'zip'               => 'string|max:40|nullable',
            'city'              => 'string|max:40|nullable',
            'country_id'        => 'integer|exists:countries,id|nullable',
            'reg_no'            => 'string|max:40|nullable',
            'tax_no'            => 'string|max:40|nullable',
            'vat_no'            => 'string|max:40|nullable',
            'web'               => 'string|max:40|nullable',
            'email'             => 'email|nullable',
            'telephone'         => 'string|max:40|nullable',
            'description'       => 'string|max:250|nullable',
            'custom_properties' => 'json|nullable',
        ];

        $rules = isset($allRules[$this->name]) ? ['value' => $allRules[$this->name] ] : [];

        return $rules;
    }
}
