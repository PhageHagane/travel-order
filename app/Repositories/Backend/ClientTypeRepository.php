<?php

namespace App\Repositories\Backend;

use App\Exceptions\GeneralException;
use App\Models\ClientType;
use App\Repositories\BaseRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

/**
 * Class ClientTypeRepository.
 */
class ClientTypeRepository extends BaseRepository
{
    /**
     * ClientTypeRepository constructor.
     *
     * @param  ClientType  $model
     */
    public function __construct(ClientType $model)
    {
        $this->model = $model;
    }

    /**
     * @return string
     */
    public function model()
    {
        return ClientType::class;
    }

    /**
     * @param int    $paged
     * @param string $orderBy
     * @param string $sort
     *
     * @return mixed
     */
    public function getActivePaginated($paged = 25, $orderBy = 'created_at', $sort = 'desc') : LengthAwarePaginator
    {
        return $this->model
            ->orderBy($orderBy, $sort)
            ->paginate($paged);
    }

    /**
     * @param int    $paged
     * @param string $orderBy
     * @param string $sort
     *
     * @return LengthAwarePaginator
     */
    public function getDeletedPaginated($paged = 25, $orderBy = 'created_at', $sort = 'desc') : LengthAwarePaginator
    {
        return $this->model
            ->onlyTrashed()
            ->orderBy($orderBy, $sort)
            ->paginate($paged);
    }

    /**
     * @param array $data
     *
     * @return ClientType
     * @throws \Exception
     * @throws \Throwable
     */
    public function create(array $data) : ClientType
    {
        return DB::transaction(function () use ($data) {
            $client_type = $this->model::create($data);

            if ($client_type) {
                return $client_type;
            }

            throw new GeneralException(__('backend_client_types.exceptions.create_error'));
        });
    }

    /**
     * @param ClientType  $client_type
     * @param array     $data
     *
     * @return ClientType
     * @throws GeneralException
     * @throws \Exception
     * @throws \Throwable
     */
    public function update(ClientType $client_type, array $data) : ClientType
    {
        return DB::transaction(function () use ($client_type, $data) {
            if ($client_type->update($data)) {

                return $client_type;
            }

            throw new GeneralException(__('backend_client_types.exceptions.update_error'));
        });
    }

    /**
     * @param ClientType $client_type
     *
     * @return ClientType
     * @throws GeneralException
     * @throws \Exception
     * @throws \Throwable
     */
    public function forceDelete(ClientType $client_type) : ClientType
    {
        if (is_null($client_type->deleted_at)) {
            throw new GeneralException(__('backend_client_types.exceptions.delete_first'));
        }

        return DB::transaction(function () use ($client_type) {
            if ($client_type->forceDelete()) {
                return $client_type;
            }

            throw new GeneralException(__('backend_client_types.exceptions.delete_error'));
        });
    }

    /**
     * Restore the specified soft deleted resource.
     *
     * @param ClientType $client_type
     *
     * @return ClientType
     * @throws GeneralException
     */
    public function restore(ClientType $client_type) : ClientType
    {
        if (is_null($client_type->deleted_at)) {
            throw new GeneralException(__('backend_client_types.exceptions.cant_restore'));
        }

        if ($client_type->restore()) {
            return $client_type;
        }

        throw new GeneralException(__('backend_client_types.exceptions.restore_error'));
    }
}