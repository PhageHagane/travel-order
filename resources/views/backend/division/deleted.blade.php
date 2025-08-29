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
                    {{ __('backend_divisions.labels.management') }} <small class="text-muted">{{ __('backend_divisions.labels.deleted') }}</small>
                </h4>
            </div><!--col-->

            <div class="col-sm-7">
                @include('backend.division.includes.header-buttons')
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>@lang('backend_divisions.table.name')</th>
                            <th>@lang('backend_divisions.table.created')</th>
                            <th>@lang('backend_divisions.table.deleted')</th>
                            <th>@lang('labels.general.actions')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($divisions as $division)
                            <tr>
                                <td class="align-middle"><a href="/admin/divisions/{{ $division->id }}">{{ $division->name }}</a></td>
                                <td class="align-middle">{!! $division->created_at !!}</td>
                                <td class="align-middle">{{ $division->deleted_at->diffForHumans() }}</td>
                                <td class="align-middle">{!! $division->trashed_buttons !!}</td>
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
                    {!! $divisions->count() !!} {{ trans_choice('backend_divisions.table.total', $divisions->count()) }}
                </div>
            </div><!--col-->

            <div class="col-5">
                <div class="float-right">
                    {!! $divisions->links() !!}
                </div>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-body-->
</div><!--card-->
@endsection
