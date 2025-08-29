@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('backend_divisions.labels.management'))

@section('breadcrumb-links')
    @include('backend.division.includes.breadcrumb-links')
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    {{ __('backend_divisions.labels.management') }} <small class="text-muted">{{ __('backend_divisions.labels.active') }}</small>
                </h4>
            </div><!--col-->

            @if (auth()->user()->can('Store Division'))
            <div class="col-sm-7">
                @include('backend.division.includes.header-buttons')
            </div><!--col-->
            @endif

        </div><!--row-->
        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table id="divisions_table" class="table">
                        <thead>
                            <tr>
                                <th>@lang('backend_divisions.table.name')</th>
                                <th>Abbr</th>
                                <th style="width:0%">@lang('backend_divisions.table.actions')</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-body-->
</div><!--card-->
@endsection
@push('after-scripts')
<script>
    if (typeof jQuery == 'undefined') {

        console.log('jQuery not loaded.');

    }
    $(function() {
        $('#divisions_table').DataTable({
            dom: "<'row'<'col-sm-3'l><'text-center col-sm-6'B><'col-sm-3 toolbar'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            buttons: [{
                    extend: 'copy',
                    className: 'btn btn-light',
                    text: '<i class="fa fa-copy"></i> Copy'
                },
                {
                    extend: 'print',
                    className: 'btn btn-light',
                    text: '<i class="fa fa-print"></i> Print'
                },
                {
                    extend: 'excel',
                    className: 'btn btn-light',
                    text: '<i class="fa fa-file-excel-o"></i> Excel'
                },
                {
                    extend: 'pdf',
                    className: 'btn btn-light',
                    text: '<i class="fa fa-file-pdf-o"></i> PDF'
                },
                {
                    extend: 'colvis',
                    className: 'btn btn-light',
                    text: '<i class="fa fa-eye"></i> Column Visibility'
                },
            ],
            processing: true,
            responsive: true,
            bStateSave: true,
            serverSide: true,
            autoWidth: false,
            pageLength: 10,
            ajax: "{{ route('admin.divisions.index') }}",
            columns: [{
                    data: 'name',
                    name: 'name'
                },{
                    data: 'abbr',
                    name: 'abbr'
                },
                {
                    data: 'action',
                    name: 'action',
                    className: "text-right",
                    orderable: false,
                    searchable: false
                }
            ],
            order: [
                [1, 'desc']
            ],
            initComplete: function() {}
        });
    });
</script>
@endpush