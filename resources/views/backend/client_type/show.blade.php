@extends('backend.layouts.app')

@section('title', __('backend_client_types.labels.management') . ' | ' . __('backend_client_types.labels.view'))

@section('breadcrumb-links')
    @include('backend.client_type.includes.breadcrumb-links')
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    @lang('backend_client_types.labels.management')
                    <small class="text-muted">@lang('backend_client_types.labels.view')</small>
                </h4>
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4 mb-4">
            <div class="col">
                <div class="form-group row">
                    <label class="col-md-2 form-control-label" for="name">@lang('backend_client_types.tabs.content.overview.name')</label>

                    <div class="col-md-10">
                        {{ html()->text('name')->class('form-control bg-white')->disabled()->value(old('name', $clientType->name)) }}
                    </div><!--col-->
                </div><!--form-group-->
            </div><!--col-->
        </div><!--row-->
    </div><!--card-body-->

    <div class="card-footer">
        <div class="row">
            <div class="col">
                <small class="float-right text-muted">
                    <strong>@lang('backend_client_types.tabs.content.overview.created_at'):</strong> {{ timezone()->convertToLocal($clientType->created_at) }} ({{ $clientType->created_at->diffForHumans() }}),
                    <strong>@lang('backend_client_types.tabs.content.overview.last_updated'):</strong> {{ timezone()->convertToLocal($clientType->updated_at) }} ({{ $clientType->updated_at->diffForHumans() }})
                    @if($clientType->trashed())
                        <strong>@lang('backend_client_types.tabs.content.overview.deleted_at'):</strong> {{ timezone()->convertToLocal($clientType->deleted_at) }} ({{ $clientType->deleted_at->diffForHumans() }})
                    @endif
                </small>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-footer-->
</div><!--card-->
@endsection
