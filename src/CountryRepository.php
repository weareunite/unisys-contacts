<?php

namespace Unite\Contacts;

use Unite\Contacts\Models\Country;
use Unite\UnisysApi\Repositories\Repository;

/**
 * @method Country getQueryBuilder()
 */
class CountryRepository extends Repository
{
    protected $modelClass = Country::class;

    /**
     * Returns one country
     */
    public function getOne(int $id)
    {
        return $this->getQueryBuilder()->getOne($id);
    }

    /**
     * Returns a list of countries
     */
    public function getList(string $sort = null)
    {
        return $this->getQueryBuilder()->getList($sort);
    }

    /**
     * Returns a list of countries suitable to use with a select element in Laravelcollective\html
     * Will show the value and sort by the column specified in the display attribute
     */
    public function getListForSelect(string $display = 'name')
    {
        return $this->getQueryBuilder()->getListForSelect($display);
    }
}