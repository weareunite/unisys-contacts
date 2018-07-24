<?php

namespace Unite\Contacts\Http\Controllers;

use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Unite\Contacts\Http\Resources\ContactResource;
use Unite\Contacts\Models\Contact;
use Unite\UnisysApi\Http\Controllers\Controller;
use Unite\Contacts\Http\Requests\UpdateRequest;
use Unite\Contacts\ContactRepository;
use Unite\UnisysApi\Http\Requests\QueryRequest;

/**
 * @resource Contact
 *
 * Contacts handler
 */
class ContactController extends Controller
{
    protected $repository;

    public function __construct(ContactRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * List
     *
     * @param QueryRequest $request
     *
     * @return AnonymousResourceCollection|ContactResource[]
     */
    public function list(QueryRequest $request)
    {
        $object = $this->repository->with($this->repository->getResourceRelations())->filterByRequest( $request->all() );

        return ContactResource::collection($object);
    }

    /**
     * Update
     *
     * @param Contact $model
     * @param \Unite\Contacts\Http\Requests\UpdateRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Contact $model, UpdateRequest $request)
    {
        $model->update( $request->all() );

        return $this->successJsonResponse();
    }

    /**
     * Delete
     *
     * @param Contact $model
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Contact $model)
    {
        $model->delete();

        return $this->successJsonResponse();
    }
}
