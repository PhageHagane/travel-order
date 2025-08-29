<?php

namespace App\Repositories\Backend;

use App\Exceptions\GeneralException;
use App\Models\Division;
use App\Repositories\BaseRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

/**
 * Class DivisionRepository.
 */
class DivisionRepository extends BaseRepository
{
    /**
     * DivisionRepository constructor.
     *
     * @param  Division  $model
     */
    public function __construct(Division $model)
    {
        $this->model = $model;
    }

    /**
     * @return string
     */
    public function model()
    {
        return Division::class;
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
     * @return Division
     * @throws \Exception
     * @throws \Throwable
     */
    public function create(array $data) : Division
    {
        return DB::transaction(function () use ($data) {
            $division = $this->model::create($data);

            if ($division) {
                return $division;
            }

            throw new GeneralException(__('backend_divisions.exceptions.create_error'));
        });
    }

    /**
     * @param Division  $division
     * @param array     $data
     *
     * @return Division
     * @throws GeneralException
     * @throws \Exception
     * @throws \Throwable
     */
    public function update(Division $division, array $data) : Division
    {
        return DB::transaction(function () use ($division, $data) {
            if ($division->update($data)) {

                return $division;
            }

            throw new GeneralException(__('backend_divisions.exceptions.update_error'));
        });
    }

    /**
     * @param Division $division
     *
     * @return Division
     * @throws GeneralException
     * @throws \Exception
     * @throws \Throwable
     */
    public function forceDelete(Division $division) : Division
    {
        if (is_null($division->deleted_at)) {
            throw new GeneralException(__('backend_divisions.exceptions.delete_first'));
        }

        return DB::transaction(function () use ($division) {
            if ($division->forceDelete()) {
                return $division;
            }

            throw new GeneralException(__('backend_divisions.exceptions.delete_error'));
        });
    }

    /**
     * Restore the specified soft deleted resource.
     *
     * @param Division $division
     *
     * @return Division
     * @throws GeneralException
     */
    public function restore(Division $division) : Division
    {
        if (is_null($division->deleted_at)) {
            throw new GeneralException(__('backend_divisions.exceptions.cant_restore'));
        }

        if ($division->restore()) {
            return $division;
        }

        throw new GeneralException(__('backend_divisions.exceptions.restore_error'));
    }
}