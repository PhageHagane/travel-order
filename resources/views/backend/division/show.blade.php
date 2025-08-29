@extends('backend.layouts.app')

@section('title', __('backend_divisions.labels.management') . ' | ' . __('backend_divisions.labels.view'))

@section('breadcrumb-links')
    @include('backend.division.includes.breadcrumb-links')
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    @lang('backend_divisions.labels.management')
                    <small class="text-muted">@lang('backend_divisions.labels.view')</small>
                </h4>
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4 mb-4">
            <div class="col">
                <div class="form-group row">
                    <label class="col-md-2 form-control-label" for="name">@lang('backend_divisions.tabs.content.overview.name')</label>

                    <div class="col-md-10">
                        {{ html()->text('name')->class('form-control bg-white')->disabled()->value(old('name', $division->name)) }}
                    </div><!--col-->
                </div><!--form-group-->
            </div><!--col-->
        </div><!--row-->
    </div><!--card-body-->

    <div class="card-footer">
        <div class="row">
            <div class="col">
                <small class="float-right text-muted">
                    <strong>@lang('backend_divisions.tabs.content.overview.created_at'):</strong> {{ timezone()->convertToLocal($division->created_at) }} ({{ $division->created_at->diffForHumans() }}),
                    <strong>@lang('backend_divisions.tabs.content.overview.last_updated'):</strong> {{ timezone()->convertToLocal($division->updated_at) }} ({{ $division->updated_at->diffForHumans() }})
                    @if($division->trashed())
                        <strong>@lang('backend_divisions.tabs.content.overview.deleted_at'):</strong> {{ timezone()->convertToLocal($division->deleted_at) }} ({{ $division->deleted_at->diffForHumans() }})
                    @endif
                </small>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-footer-->
</div><!--card-->
@endsection
