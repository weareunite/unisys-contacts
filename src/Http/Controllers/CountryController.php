<?php

namespace Unite\Contacts\Http\Controllers;

use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Unite\Contacts\CountryRepository;
use Unite\Contacts\Http\Resources\CountryForSelectResource;
use Unite\Contacts\Http\Resources\CountryResource;
use Unite\Contacts\Models\Country;
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
        $object = $this->repository->with(CountryResource::getRelations())->filterByRequest( $request->all() );

        return CountryResource::collection($object);
    }

    /**
     * Show
     *
     * @param Country $model
     *
     * @return CountryResource
     */
    public function show(Country $model)
    {
        return new CountryResource($model);
    }

    /**
     * List for select
     *
     * @return AnonymousResourceCollection|CountryForSelectResource[]
     */
    public function listForSelect()
    {
        $object = $this->repository->getListForSelect();

        return CountryForSelectResource::collection($object);
    }

}
