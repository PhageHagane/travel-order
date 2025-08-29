<?php

namespace App\Repositories\Backend;

use App\Exceptions\GeneralException;
use App\Models\Permission;
use App\Repositories\BaseRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

/**
 * Class PermissionRepository.
 */
class PermissionRepository extends BaseRepository
{
    /**
     * PermissionRepository constructor.
     *
     * @param  Permission  $model
     */
    public function __construct(Permission $model)
    {
        $this->model = $model;
    }

    /**
     * @return string
     */
    public function model()
    {
        return Permission::class;
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
     * @return Permission
     * @throws \Exception
     * @throws \Throwable
     */
    public function create(array $data) : Permission
    {
        return DB::transaction(function () use ($data) {
            $permission = $this->model::create($data);

            if ($permission) {
                return $permission;
            }

            throw new GeneralException(__('backend_permissions.exceptions.create_error'));
        });
    }

    /**
     * @param Permission  $permission
     * @param array     $data
     *
     * @return Permission
     * @throws GeneralException
     * @throws \Exception
     * @throws \Throwable
     */
    public function update(Permission $permission, array $data) : Permission
    {
        return DB::transaction(function () use ($permission, $data) {
            if ($permission->update($data)) {

                return $permission;
            }

            throw new GeneralException(__('backend_permissions.exceptions.update_error'));
        });
    }

    /**
     * @param Permission $permission
     *
     * @return Permission
     * @throws GeneralException
     * @throws \Exception
     * @throws \Throwable
     */
    public function forceDelete(Permission $permission) : Permission
    {
        if (is_null($permission->deleted_at)) {
            throw new GeneralException(__('backend_permissions.exceptions.delete_first'));
        }

        return DB::transaction(function () use ($permission) {
            if ($permission->forceDelete()) {
                return $permission;
            }

            throw new GeneralException(__('backend_permissions.exceptions.delete_error'));
        });
    }

    /**
     * Restore the specified soft deleted resource.
     *
     * @param Permission $permission
     *
     * @return Permission
     * @throws GeneralException
     */
    public function restore(Permission $permission) : Permission
    {
        if (is_null($permission->deleted_at)) {
            throw new GeneralException(__('backend_permissions.exceptions.cant_restore'));
        }

        if ($permission->restore()) {
            return $permission;
        }

        throw new GeneralException(__('backend_permissions.exceptions.restore_error'));
    }
}