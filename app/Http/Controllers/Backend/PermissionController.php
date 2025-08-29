<?php

namespace App\Http\Controllers\Backend;

use App\Exceptions\GeneralException;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Permission;
use App\Repositories\Backend\PermissionRepository;
use App\Http\Requests\Backend\Permission\ManagePermissionRequest;
use App\Http\Requests\Backend\Permission\StorePermissionRequest;
use App\Http\Requests\Backend\Permission\UpdatePermissionRequest;

use App\Events\Backend\Permission\PermissionCreated;
use App\Events\Backend\Permission\PermissionUpdated;
use App\Events\Backend\Permission\PermissionDeleted;

use DataTables;

class PermissionController extends Controller
{
    /**
     * @var PermissionRepository
     */
    protected $permissionRepository;

    /**
     * PermissionController constructor.
     *
     * @param PermissionRepository $permissionRepository
     */
    public function __construct(PermissionRepository $permissionRepository)
    {
        $this->permissionRepository = $permissionRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param ManagePermissionRequest $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(ManagePermissionRequest $request)
    {
        if ($request->ajax()) {
            if ($request->has('draw')) {

                $query = Permission::selectRaw('permissions.*');

                return DataTables::of($query)
                    ->editColumn('description', function ($row) {
                        return '<span class="sortable"><a href="' . route('admin.permissions.show', $row) . '">' . $row->description . "</a></span>";
                    })
                    ->addColumn('action', function ($row) {
                        return $row->getActionButtonsAttribute();
                    })
                    ->rawColumns(['description','action'])
                    ->make(true);
            }
        }

        return view('backend.permission.index')
            ->withpermissions($this->permissionRepository->getActivePaginated(25, 'id', 'asc'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param ManagePermissionRequest    $request
     *
     * @return mixed
     */
    public function create(ManagePermissionRequest $request)
    {
        return view('backend.permission.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StorePermissionRequest $request
     *
     * @return mixed
     * @throws \Throwable
     */
    public function store(StorePermissionRequest $request)
    {
        $this->permissionRepository->create($request->all());

        // Fire create event (PermissionCreated)
        event(new PermissionCreated($request));

        return redirect()->route('admin.permissions.index')
            ->withFlashSuccess(__('backend_permissions.alerts.created'));
    }

    /**
     * Display the specified resource.
     *
     * @param ManagePermissionRequest  $request
     * @param Permission               $permission
     *
     * @return mixed
     */
    public function show(ManagePermissionRequest $request, Permission $permission)
    {
        return view('backend.permission.show')->withPermission($permission);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param ManagePermissionRequest $request
     * @param Permission              $permission
     *
     * @return mixed
     */
    public function edit(ManagePermissionRequest $request, Permission $permission)
    {
        return view('backend.permission.edit')->withPermission($permission);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdatePermissionRequest  $request
     * @param Permission               $permission
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     * @throws \Throwable
     */
    public function update(UpdatePermissionRequest $request, Permission $permission)
    {
        $this->permissionRepository->update($permission, $request->all());

        // Fire update event (PermissionUpdated)
        event(new PermissionUpdated($request));

        return redirect()->route('admin.permissions.index')
            ->withFlashSuccess(__('backend_permissions.alerts.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ManagePermissionRequest $request
     * @param Permission              $permission
     *
     * @return mixed
     * @throws \Exception
     */
    public function destroy(ManagePermissionRequest $request, Permission $permission)
    {
        $this->permissionRepository->deleteById($permission->id);

        // Fire delete event (PermissionDeleted)
        event(new PermissionDeleted($request));

        return redirect()->route('admin.permissions.deleted')
            ->withFlashSuccess(__('backend_permissions.alerts.deleted'));
    }

    /**
     * Permanently remove the specified resource from storage.
     *
     * @param ManagePermissionRequest $request
     * @param Permission              $deletedPermission
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     * @throws \Throwable
     */
    public function delete(ManagePermissionRequest $request, $deletedPermission)
    {
        // $this->permissionRepository->forceDelete($deletedPermission);
        $deletedPermission->forceDelete();

        return redirect()->route('admin.permissions.index')
            ->withFlashSuccess(__('backend_permissions.alerts.deleted_permanently'));
    }

    /**
     * @param ManagePermissionRequest $request
     * @param Permission              $deletedPermission
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function restore(ManagePermissionRequest $request, Permission $deletedPermission)
    {
        $this->permissionRepository->restore($deletedPermission);

        return redirect()->route('admin.permissions.index')
            ->withFlashSuccess(__('backend_permissions.alerts.restored'));
    }

    /**
     * Display a listing of deleted items of the resource.
     *
     * @param ManagePermissionRequest $request
     *
     * @return mixed
     */
    public function deleted(ManagePermissionRequest $request)
    {
        return view('backend.permission.deleted')
            ->withpermissions($this->permissionRepository->getDeletedPaginated(25, 'id', 'asc'));
    }
}