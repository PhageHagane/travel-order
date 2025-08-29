@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('backend_permissions.labels.management'))

@section('breadcrumb-links')
    @include('backend.permission.includes.breadcrumb-links')
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    {{ __('backend_permissions.labels.management') }} <small class="text-muted">{{ __('backend_permissions.labels.deleted') }}</small>
                </h4>
            </div><!--col-->

            <div class="col-sm-7">
                @include('backend.permission.includes.header-buttons')
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>@lang('backend_permissions.table.name')</th>
                            <th>@lang('backend_permissions.table.created')</th>
                            <th>@lang('backend_permissions.table.deleted')</th>
                            <th>@lang('labels.general.actions')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($permissions as $permission)
                            <tr>
                                <td class="align-middle"><a href="/admin/permissions/{{ $permission->id }}">{{ $permission->name }}</a></td>
                                <td class="align-middle">{!! $permission->created_at !!}</td>
                                <td class="align-middle">{{ $permission->deleted_at->diffForHumans() }}</td>
                                <td class="align-middle">{!! $permission->trashed_buttons !!}</td>
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
                    {!! $permissions->count() !!} {{ trans_choice('backend_permissions.table.total', $permissions->count()) }}
                </div>
            </div><!--col-->

            <div class="col-5">
                <div class="float-right">
                    {!! $permissions->links() !!}
                </div>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-body-->
</div><!--card-->
@endsection
