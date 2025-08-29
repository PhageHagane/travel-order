<?php

namespace App\Http\Controllers\Backend;

use App\Exceptions\GeneralException;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Office;
use App\Repositories\Backend\OfficeRepository;
use App\Http\Requests\Backend\Office\ManageOfficeRequest;
use App\Http\Requests\Backend\Office\StoreOfficeRequest;
use App\Http\Requests\Backend\Office\UpdateOfficeRequest;

use App\Events\Backend\Office\OfficeCreated;
use App\Events\Backend\Office\OfficeUpdated;
use App\Events\Backend\Office\OfficeDeleted;

use DataTables;

class OfficeController extends Controller
{
    /**
     * @var OfficeRepository
     */
    protected $officeRepository;

    /**
     * OfficeController constructor.
     *
     * @param OfficeRepository $officeRepository
     */
    public function __construct(OfficeRepository $officeRepository)
    {
        $this->officeRepository = $officeRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param ManageOfficeRequest $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(ManageOfficeRequest $request)
    {
        if ($request->ajax()) {
            if ($request->has('draw')) {

                $query = Office::selectRaw('offices.*');

                return DataTables::of($query)
                    ->editColumn('name', function ($row) {
                        return '<span class="sortable"><a href="' . route('admin.offices.show', $row) . '">' . $row->name . "</a></span>";
                    })
                    ->addColumn('action', function ($row) {
                        return (auth()->user()->can('Manage Office') ? $row->getShowButtonAttribute() : '')
                            . (auth()->user()->can('Update Office') ? $row->getEditButtonAttribute() : '')
                            . (auth()->user()->can('Delete Office') ? $row->getDeleteButtonAttribute() : '');
                    })
                    ->rawColumns(['name','action'])
                    ->make(true);
            }
        }

        return view('backend.office.index')
            ->withoffices($this->officeRepository->getActivePaginated(25, 'id', 'asc'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param ManageOfficeRequest    $request
     *
     * @return mixed
     */
    public function create(ManageOfficeRequest $request)
    {
        return view('backend.office.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreOfficeRequest $request
     *
     * @return mixed
     * @throws \Throwable
     */
    public function store(StoreOfficeRequest $request)
    {
        $this->officeRepository->create($request->all());

        // Fire create event (OfficeCreated)
        event(new OfficeCreated($request));

        return redirect()->route('admin.offices.index')
            ->withFlashSuccess(__('backend_offices.alerts.created'));
    }

    /**
     * Display the specified resource.
     *
     * @param ManageOfficeRequest  $request
     * @param Office               $office
     *
     * @return mixed
     */
    public function show(ManageOfficeRequest $request, Office $office)
    {
        return view('backend.office.show')->withOffice($office);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param ManageOfficeRequest $request
     * @param Office              $office
     *
     * @return mixed
     */
    public function edit(ManageOfficeRequest $request, Office $office)
    {
        return view('backend.office.edit')->withOffice($office);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateOfficeRequest  $request
     * @param Office               $office
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     * @throws \Throwable
     */
    public function update(UpdateOfficeRequest $request, Office $office)
    {
        $this->officeRepository->update($office, $request->all());

        // Fire update event (OfficeUpdated)
        event(new OfficeUpdated($request));

        return redirect()->route('admin.offices.index')
            ->withFlashSuccess(__('backend_offices.alerts.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ManageOfficeRequest $request
     * @param Office              $office
     *
     * @return mixed
     * @throws \Exception
     */
    public function destroy(ManageOfficeRequest $request, Office $office)
    {
        $this->officeRepository->deleteById($office->id);

        // Fire delete event (OfficeDeleted)
        event(new OfficeDeleted($request));

        return redirect()->route('admin.offices.deleted')
            ->withFlashSuccess(__('backend_offices.alerts.deleted'));
    }

    /**
     * Permanently remove the specified resource from storage.
     *
     * @param ManageOfficeRequest $request
     * @param Office              $deletedOffice
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     * @throws \Throwable
     */
    public function delete(ManageOfficeRequest $request, $deletedOffice)
    {
        // $this->officeRepository->forceDelete($deletedOffice);
        $deletedOffice->forceDelete();

        return redirect()->route('admin.offices.index')
            ->withFlashSuccess(__('backend_offices.alerts.deleted_permanently'));
    }

    /**
     * @param ManageOfficeRequest $request
     * @param Office              $deletedOffice
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function restore(ManageOfficeRequest $request, Office $deletedOffice)
    {
        $this->officeRepository->restore($deletedOffice);

        return redirect()->route('admin.offices.index')
            ->withFlashSuccess(__('backend_offices.alerts.restored'));
    }

    /**
     * Display a listing of deleted items of the resource.
     *
     * @param ManageOfficeRequest $request
     *
     * @return mixed
     */
    public function deleted(ManageOfficeRequest $request)
    {
        return view('backend.office.deleted')
            ->withoffices($this->officeRepository->getDeletedPaginated(25, 'id', 'asc'));
    }
}