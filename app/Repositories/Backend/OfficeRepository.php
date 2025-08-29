<?php

namespace App\Repositories\Backend;

use App\Exceptions\GeneralException;
use App\Models\Office;
use App\Repositories\BaseRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

/**
 * Class OfficeRepository.
 */
class OfficeRepository extends BaseRepository
{
    /**
     * OfficeRepository constructor.
     *
     * @param  Office  $model
     */
    public function __construct(Office $model)
    {
        $this->model = $model;
    }

    /**
     * @return string
     */
    public function model()
    {
        return Office::class;
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
     * @return Office
     * @throws \Exception
     * @throws \Throwable
     */
    public function create(array $data) : Office
    {
        return DB::transaction(function () use ($data) {
            $office = $this->model::create($data);

            if ($office) {
                return $office;
            }

            throw new GeneralException(__('backend_offices.exceptions.create_error'));
        });
    }

    /**
     * @param Office  $office
     * @param array     $data
     *
     * @return Office
     * @throws GeneralException
     * @throws \Exception
     * @throws \Throwable
     */
    public function update(Office $office, array $data) : Office
    {
        return DB::transaction(function () use ($office, $data) {
            if ($office->update($data)) {

                return $office;
            }

            throw new GeneralException(__('backend_offices.exceptions.update_error'));
        });
    }

    /**
     * @param Office $office
     *
     * @return Office
     * @throws GeneralException
     * @throws \Exception
     * @throws \Throwable
     */
    public function forceDelete(Office $office) : Office
    {
        if (is_null($office->deleted_at)) {
            throw new GeneralException(__('backend_offices.exceptions.delete_first'));
        }

        return DB::transaction(function () use ($office) {
            if ($office->forceDelete()) {
                return $office;
            }

            throw new GeneralException(__('backend_offices.exceptions.delete_error'));
        });
    }

    /**
     * Restore the specified soft deleted resource.
     *
     * @param Office $office
     *
     * @return Office
     * @throws GeneralException
     */
    public function restore(Office $office) : Office
    {
        if (is_null($office->deleted_at)) {
            throw new GeneralException(__('backend_offices.exceptions.cant_restore'));
        }

        if ($office->restore()) {
            return $office;
        }

        throw new GeneralException(__('backend_offices.exceptions.restore_error'));
    }
}