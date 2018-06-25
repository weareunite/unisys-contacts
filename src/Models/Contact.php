<?php

namespace Unite\Contacts\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Spatie\Activitylog\Traits\LogsActivity;
use Webpatser\Countries\Countries;

class Contact extends Model
{
    use LogsActivity;

    protected $table = 'contacts';

    protected $fillable = [
        'type', 'name', 'surname', 'company', 'street', 'zip', 'city', 'country', 'reg_no', 'tax_no', 'vat_no',
        'web', 'email', 'telephone', 'description', 'custom_properties',
    ];

    public function subject(): MorphTo
    {
        return $this->morphTo();
    }

    public function country()
    {
        return $this->belongsTo(Countries::class, 'country_id');
    }
}
