<?php

namespace Unite\Contacts\Http\Controllers;

use Unite\UnisysApi\Http\Controllers\Controller;
use Unite\Contacts\Http\Requests\UpdateRequest;
use Unite\Contacts\ContactRepository;

/**
 * @resource Note
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
