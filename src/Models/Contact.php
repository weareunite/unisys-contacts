<?php

namespace Unite\Contacts\Models;

use Illuminate\Database\Eloquent\Relations\MorphTo;
use Spatie\Activitylog\Traits\LogsActivity;
use Unite\UnisysApi\Helpers\CustomProperty\HasCustomProperty;
use Unite\UnisysApi\Helpers\CustomProperty\HasCustomPropertyTrait;
use Unite\UnisysApi\Models\Model;

class Contact extends Model implements HasCustomProperty
{
    use LogsActivity;
    use HasCustomPropertyTrait;

    protected $table = 'contacts';

    const TYPE_DEFAULT = 'default';

    protected $fillable = [
        'type', 'name', 'surname', 'company', 'street', 'zip', 'city', 'country_id', 'reg_no', 'tax_no', 'vat_no',
        'web', 'email', 'telephone', 'description', 'custom_properties',
    ];

    protected $casts = [
        'custom_properties' => 'array',
    ];

    protected $resourceEagerLoads = [
        'country',
    ];

    public function subject(): MorphTo
    {
        return $this->morphTo();
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    public static function getTypes()
    {
        return [
            self::TYPE_DEFAULT,
        ];
    }

    public static function getDefaultType(): string
    {
        return self::TYPE_DEFAULT;
    }
}
