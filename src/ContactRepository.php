<?php

namespace Unite\Contacts;

use Unite\UnisysApi\Repositories\Repository;
use Unite\Contacts\Models\Contact;

class ContactRepository extends Repository
{
    protected $modelClass = Contact::class;

    protected $resourceRelations = [
        'country',
    ];
}