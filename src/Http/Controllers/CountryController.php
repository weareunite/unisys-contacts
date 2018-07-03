<?php

namespace Unite\Contacts\Http\Controllers;

use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Unite\Contacts\CountryRepository;
use Unite\Contacts\Http\Resources\CountryResource;
use Unite\UnisysApi\Http\Controllers\Controller;
use Unite\UnisysApi\Http\Requests\QueryRequest;

/**
 * @resource Country
 *
 * Country handler
 */
class CountryController extends Controller
{
    protected $repository;

    public function __construct(CountryRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * List
     *
     * @param QueryRequest $request
     * @return AnonymousResourceCollection|CountryResource[]
     */
    public function list(QueryRequest $request)
    {
        $object = $this->repository->filterByRequest($request);

        return CountryResource::collection($object);
    }

    /**
     * Returns one country
     *
     * @param integer $id
     *
     * @return CountryResource
     */
    public function show(int $id)
    {
        $object = $this->repository->getOne($id);

        return new CountryResource($object);
    }

    /**
     * Returns a list of countries
     *
     * @return AnonymousResourceCollection|CountryResource[]
     */
    public function getList()
    {
        $object = $this->repository->getList();

        return CountryResource::collection($object);
    }

    /**
     * Returns a list of countries
     *
     * suitable to use with a select element in Laravelcollective\html
     * Will show the value and sort by the column specified in the display attribute
     *
     * @return array
     */
    public function getListForSelect()
    {
        $object = $this->repository->getListForSelect();

        return $object;
    }

}
