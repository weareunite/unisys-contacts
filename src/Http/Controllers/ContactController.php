<?php

namespace Unite\Contacts\Http\Controllers;

use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Unite\Contacts\Http\Resources\ContactResource;
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
     * @return AnonymousResourceCollection|ContactResource[]
     */
    public function list(QueryRequest $request)
    {
        $object = $this->repository->filterByRequest($request);

        return ContactResource::collection($object);
    }

    /**
     * Update
     *
     * @param $id
     * @param \Unite\Contacts\Http\Requests\UpdateRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($id, UpdateRequest $request)
    {
        if(!$object = $this->repository->find($id)) {
            abort(404);
        }

        $data = $request->all();

        $object->update($data);

        return $this->successJsonResponse();
    }

    /**
     * Delete
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($id)
    {
        $this->repository->delete($id);

        return $this->successJsonResponse();
    }
}
