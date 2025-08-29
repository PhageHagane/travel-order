@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('backend_offices.labels.management'))

@section('breadcrumb-links')
    @include('backend.office.includes.breadcrumb-links')
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    {{ __('backend_offices.labels.management') }} <small class="text-muted">{{ __('backend_offices.labels.deleted') }}</small>
                </h4>
            </div><!--col-->

            <div class="col-sm-7">
                @include('backend.office.includes.header-buttons')
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>@lang('backend_offices.table.name')</th>
                            <th>@lang('backend_offices.table.created')</th>
                            <th>@lang('backend_offices.table.deleted')</th>
                            <th>@lang('labels.general.actions')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($offices as $office)
                            <tr>
                                <td class="align-middle"><a href="/admin/offices/{{ $office->id }}">{{ $office->name }}</a></td>
                                <td class="align-middle">{!! $office->created_at !!}</td>
                                <td class="align-middle">{{ $office->deleted_at->diffForHumans() }}</td>
                                <td class="align-middle">{!! $office->trashed_buttons !!}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div><!--col-->
        </div><!--row-->
        <div class="row">
            <div class="col-7">
                <div class="float-left">
                    {!! $offices->count() !!} {{ trans_choice('backend_offices.table.total', $offices->count()) }}
                </div>
            </div><!--col-->

            <div class="col-5">
                <div class="float-right">
                    {!! $offices->links() !!}
                </div>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-body-->
</div><!--card-->
@endsection
