<?php

namespace App\Http\Controllers\Backend;

use App\Exceptions\GeneralException;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\ClientType;
use App\Repositories\Backend\ClientTypeRepository;
use App\Http\Requests\Backend\ClientType\ManageClientTypeRequest;
use App\Http\Requests\Backend\ClientType\StoreClientTypeRequest;
use App\Http\Requests\Backend\ClientType\UpdateClientTypeRequest;

use App\Events\Backend\ClientType\ClientTypeCreated;
use App\Events\Backend\ClientType\ClientTypeUpdated;
use App\Events\Backend\ClientType\ClientTypeDeleted;

use DataTables;

class ClientTypeController extends Controller
{
    /**
     * @var ClientTypeRepository
     */
    protected $client_typeRepository;

    /**
     * ClientTypeController constructor.
     *
     * @param ClientTypeRepository $client_typeRepository
     */
    public function __construct(ClientTypeRepository $client_typeRepository)
    {
        $this->client_typeRepository = $client_typeRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param ManageClientTypeRequest $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(ManageClientTypeRequest $request)
    {
        if ($request->ajax()) {
            if ($request->has('draw')) {

                $query = ClientType::selectRaw('client_types.*');

                return DataTables::of($query)
                    ->editColumn('name', function ($row) {
                        return '<span class="sortable"><a href="' . route('admin.client_types.show', $row) . '">' . $row->name . "</a></span>";
                    })
                    ->addColumn('action', function ($row) {
                        return (auth()->user()->can('Manage ClientType') ? $row->getShowButtonAttribute() : '')
                            . (auth()->user()->can('Update ClientType') ? $row->getEditButtonAttribute() : '')
                            . (auth()->user()->can('Delete ClientType') ? $row->getDeleteButtonAttribute() : '');
                    })
                    ->rawColumns(['name','action'])
                    ->make(true);
            }
        }

        return view('backend.client_type.index')
            ->withclientTypes($this->client_typeRepository->getActivePaginated(25, 'id', 'asc'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param ManageClientTypeRequest    $request
     *
     * @return mixed
     */
    public function create(ManageClientTypeRequest $request)
    {
        return view('backend.client_type.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreClientTypeRequest $request
     *
     * @return mixed
     * @throws \Throwable
     */
    public function store(StoreClientTypeRequest $request)
    {
        $this->client_typeRepository->create($request->all());

        // Fire create event (ClientTypeCreated)
        event(new ClientTypeCreated($request));

        return redirect()->route('admin.client_types.index')
            ->withFlashSuccess(__('backend_client_types.alerts.created'));
    }

    /**
     * Display the specified resource.
     *
     * @param ManageClientTypeRequest  $request
     * @param ClientType               $clientType
     *
     * @return mixed
     */
    public function show(ManageClientTypeRequest $request, ClientType $clientType)
    {
        return view('backend.client_type.show')->withClientType($clientType);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param ManageClientTypeRequest $request
     * @param ClientType              $clientType
     *
     * @return mixed
     */
    public function edit(ManageClientTypeRequest $request, ClientType $clientType)
    {
        return view('backend.client_type.edit')->withClientType($clientType);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateClientTypeRequest  $request
     * @param ClientType               $clientType
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     * @throws \Throwable
     */
    public function update(UpdateClientTypeRequest $request, ClientType $clientType)
    {
        $this->client_typeRepository->update($clientType, $request->all());

        // Fire update event (ClientTypeUpdated)
        event(new ClientTypeUpdated($request));

        return redirect()->route('admin.client_types.index')
            ->withFlashSuccess(__('backend_client_types.alerts.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ManageClientTypeRequest $request
     * @param ClientType              $clientType
     *
     * @return mixed
     * @throws \Exception
     */
    public function destroy(ManageClientTypeRequest $request, ClientType $clientType)
    {
        $this->client_typeRepository->deleteById($clientType->id);

        // Fire delete event (ClientTypeDeleted)
        event(new ClientTypeDeleted($request));

        return redirect()->route('admin.client_types.deleted')
            ->withFlashSuccess(__('backend_client_types.alerts.deleted'));
    }

    /**
     * Permanently remove the specified resource from storage.
     *
     * @param ManageClientTypeRequest $request
     * @param ClientType              $deletedClientType
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     * @throws \Throwable
     */
    public function delete(ManageClientTypeRequest $request, $deletedClientType)
    {
        // $this->client_typeRepository->forceDelete($deletedClientType);
        $deletedClientType->forceDelete();

        return redirect()->route('admin.client_types.index')
            ->withFlashSuccess(__('backend_client_types.alerts.deleted_permanently'));
    }

    /**
     * @param ManageClientTypeRequest $request
     * @param ClientType              $deletedClientType
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function restore(ManageClientTypeRequest $request, ClientType $deletedClientType)
    {
        $this->client_typeRepository->restore($deletedClientType);

        return redirect()->route('admin.client_types.index')
            ->withFlashSuccess(__('backend_client_types.alerts.restored'));
    }

    /**
     * Display a listing of deleted items of the resource.
     *
     * @param ManageClientTypeRequest $request
     *
     * @return mixed
     */
    public function deleted(ManageClientTypeRequest $request)
    {
        return view('backend.client_type.deleted')
            ->withclientTypes($this->client_typeRepository->getDeletedPaginated(25, 'id', 'asc'));
    }
}