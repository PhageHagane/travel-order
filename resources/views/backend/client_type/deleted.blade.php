@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('backend_client_types.labels.management'))

@section('breadcrumb-links')
    @include('backend.client_type.includes.breadcrumb-links')
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    {{ __('backend_client_types.labels.management') }} <small class="text-muted">{{ __('backend_client_types.labels.deleted') }}</small>
                </h4>
            </div><!--col-->

            <div class="col-sm-7">
                @include('backend.client_type.includes.header-buttons')
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>@lang('backend_client_types.table.name')</th>
                            <th>@lang('backend_client_types.table.created')</th>
                            <th>@lang('backend_client_types.table.deleted')</th>
                            <th>@lang('labels.general.actions')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($clientTypes as $clientType)
                            <tr>
                                <td class="align-middle"><a href="/admin/client_types/{{ $clientType->id }}">{{ $clientType->name }}</a></td>
                                <td class="align-middle">{!! $clientType->created_at !!}</td>
                                <td class="align-middle">{{ $clientType->deleted_at->diffForHumans() }}</td>
                                <td class="align-middle">{!! $clientType->trashed_buttons !!}</td>
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
                    {!! $clientTypes->count() !!} {{ trans_choice('backend_client_types.table.total', $clientTypes->count()) }}
                </div>
            </div><!--col-->

            <div class="col-5">
                <div class="float-right">
                    {!! $clientTypes->links() !!}
                </div>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-body-->
</div><!--card-->
@endsection
