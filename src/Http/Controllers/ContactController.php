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
use Unite\UnisysApi\Services\SettingService;

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
     * @param QueryBuilderRequest $request
     *
     * @return AnonymousResourceCollection|ContactResource[]
     */
    public function list(QueryBuilderRequest $request)
    {
        $company = app(SettingService::class)->companyProfile(['id', 'country_id']);

        $virtualFields = [
            'contacts.abroad' => function (Builder &$query, $value) use ($company){
                if($value === 'yes') {
                    $sql = 'contacts.country_id <> ' . $company->country_id;
                } elseif ($value === 'no') {
                    $sql = 'contacts.country_id = ' . $company->country_id;
                } else {
                    $sql = 'contacts.country_id = ' . $company->country_id;
                }

                return $query->orWhereRaw($sql);
            }
        ];

        $object = QueryBuilder::for($this->repository, $request)
            ->setVirtualFields($virtualFields)
            ->paginate();

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
        try {
            $model->delete();
        } catch(\Exception $e) {
            abort(409, 'Cannot delete record');
        }

        return $this->successJsonResponse();
    }
}
