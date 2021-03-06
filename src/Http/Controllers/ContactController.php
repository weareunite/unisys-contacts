<?php

namespace Unite\Contacts\Http\Controllers;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Unite\Contacts\Http\Resources\ContactResource;
use Unite\Contacts\Models\Contact;
use Unite\UnisysApi\Http\Controllers\Controller;
use Unite\Contacts\Http\Requests\UpdateRequest;
use Unite\Contacts\ContactRepository;
use Unite\UnisysApi\QueryBuilder\QueryBuilder;
use Unite\UnisysApi\QueryBuilder\QueryBuilderRequest;

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

        $this->setResourceClass(ContactResource::class);

        $this->setResponse();

        $this->middleware('cache')->only(['list']);
    }

    /**
     * List
     *
     * @param QueryBuilderRequest $request
     *
     * @return AnonymousResourceCollection|ContactResource[]
     */
    public function list(QueryBuilderRequest $request)
    {
        $object = QueryBuilder::for($this->resource, $request)
            ->paginate();

        return $this->response->collection($object);
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

        \Cache::tags('response')->flush();

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
        try {
            $model->delete();
        } catch(\Exception $e) {
            abort(409, 'Cannot delete record');
        }

        \Cache::tags('response')->flush();

        return $this->successJsonResponse();
    }
}
