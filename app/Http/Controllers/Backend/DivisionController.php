<?php

namespace App\Http\Controllers\Backend;

use App\Exceptions\GeneralException;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Division;
use App\Repositories\Backend\DivisionRepository;
use App\Http\Requests\Backend\Division\ManageDivisionRequest;
use App\Http\Requests\Backend\Division\StoreDivisionRequest;
use App\Http\Requests\Backend\Division\UpdateDivisionRequest;

use App\Events\Backend\Division\DivisionCreated;
use App\Events\Backend\Division\DivisionUpdated;
use App\Events\Backend\Division\DivisionDeleted;

use DataTables;

class DivisionController extends Controller
{
    /**
     * @var DivisionRepository
     */
    protected $divisionRepository;

    /**
     * DivisionController constructor.
     *
     * @param DivisionRepository $divisionRepository
     */
    public function __construct(DivisionRepository $divisionRepository)
    {
        $this->divisionRepository = $divisionRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param ManageDivisionRequest $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(ManageDivisionRequest $request)
    {
        if ($request->ajax()) {
            if ($request->has('draw')) {

                $query = Division::selectRaw('divisions.*');

                return DataTables::of($query)
                    ->editColumn('name', function ($row) {
                        return '<span class="sortable"><a href="' . route('admin.divisions.show', $row) . '">' . $row->name . "</a></span>";
                    })
                    ->addColumn('action', function ($row) {
                        return (auth()->user()->can('Manage Division') ? $row->getShowButtonAttribute() : '')
                            . (auth()->user()->can('Update Division') ? $row->getEditButtonAttribute() : '')
                            . (auth()->user()->can('Delete Division') ? $row->getDeleteButtonAttribute() : '');
                    })
                    ->rawColumns(['name','action'])
                    ->make(true);
            }
        }

        return view('backend.division.index')
            ->withdivisions($this->divisionRepository->getActivePaginated(25, 'id', 'asc'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param ManageDivisionRequest    $request
     *
     * @return mixed
     */
    public function create(ManageDivisionRequest $request)
    {
        return view('backend.division.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreDivisionRequest $request
     *
     * @return mixed
     * @throws \Throwable
     */
    public function store(StoreDivisionRequest $request)
    {
        $this->divisionRepository->create($request->all());

        // Fire create event (DivisionCreated)
        event(new DivisionCreated($request));

        return redirect()->route('admin.divisions.index')
            ->withFlashSuccess(__('backend_divisions.alerts.created'));
    }

    /**
     * Display the specified resource.
     *
     * @param ManageDivisionRequest  $request
     * @param Division               $division
     *
     * @return mixed
     */
    public function show(ManageDivisionRequest $request, Division $division)
    {
        return view('backend.division.show')->withDivision($division);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param ManageDivisionRequest $request
     * @param Division              $division
     *
     * @return mixed
     */
    public function edit(ManageDivisionRequest $request, Division $division)
    {
        return view('backend.division.edit')->withDivision($division);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateDivisionRequest  $request
     * @param Division               $division
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     * @throws \Throwable
     */
    public function update(UpdateDivisionRequest $request, Division $division)
    {
        $this->divisionRepository->update($division, $request->all());

        // Fire update event (DivisionUpdated)
        event(new DivisionUpdated($request));

        return redirect()->route('admin.divisions.index')
            ->withFlashSuccess(__('backend_divisions.alerts.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ManageDivisionRequest $request
     * @param Division              $division
     *
     * @return mixed
     * @throws \Exception
     */
    public function destroy(ManageDivisionRequest $request, Division $division)
    {
        $this->divisionRepository->deleteById($division->id);

        // Fire delete event (DivisionDeleted)
        event(new DivisionDeleted($request));

        return redirect()->route('admin.divisions.deleted')
            ->withFlashSuccess(__('backend_divisions.alerts.deleted'));
    }

    /**
     * Permanently remove the specified resource from storage.
     *
     * @param ManageDivisionRequest $request
     * @param Division              $deletedDivision
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     * @throws \Throwable
     */
    public function delete(ManageDivisionRequest $request, $deletedDivision)
    {
        // $this->divisionRepository->forceDelete($deletedDivision);
        $deletedDivision->forceDelete();

        return redirect()->route('admin.divisions.index')
            ->withFlashSuccess(__('backend_divisions.alerts.deleted_permanently'));
    }

    /**
     * @param ManageDivisionRequest $request
     * @param Division              $deletedDivision
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function restore(ManageDivisionRequest $request, Division $deletedDivision)
    {
        $this->divisionRepository->restore($deletedDivision);

        return redirect()->route('admin.divisions.index')
            ->withFlashSuccess(__('backend_divisions.alerts.restored'));
    }

    /**
     * Display a listing of deleted items of the resource.
     *
     * @param ManageDivisionRequest $request
     *
     * @return mixed
     */
    public function deleted(ManageDivisionRequest $request)
    {
        return view('backend.division.deleted')
            ->withdivisions($this->divisionRepository->getDeletedPaginated(25, 'id', 'asc'));
    }
}