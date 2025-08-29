@extends('backend.layouts.app')

@section('title', __('backend_permissions.labels.management') . ' | ' . __('backend_permissions.labels.view'))

@section('breadcrumb-links')
    @include('backend.permission.includes.breadcrumb-links')
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        @lang('backend_permissions.labels.management')
                        <small class="text-muted">@lang('backend_permissions.labels.view')</small>
                    </h4>
                </div><!--col-->
            </div><!--row-->

            <div class="row mt-4 mb-4">
                <div class="col">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#overview" role="tab"
                                aria-controls="overview" aria-expanded="true"><i class="fas fa-user"></i>
                                @lang('backend_permissions.tabs.title')</a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane active" id="overview" role="tabpanel" aria-expanded="true">

                            <div class="col">
                                <!-- input name -->
                                <div class="form-group row">
                                    {{ html()->label(__('Name'))->class('col-md-2 form-control-label')->for('name') }}

                                    <div class="col-md-10">
                                        {{ html()->text('name')->class('form-control bg-white')->disabled()->value($permission->name) }}
                                    </div><!--col-->
                                </div><!--form-group-->

                                <!-- input guard_name -->
                                <div class="form-group row">
                                    {{ html()->label(__('Guard Name'))->class('col-md-2 form-control-label')->for('guard_name') }}

                                    <div class="col-md-10">
                                        {{ html()->text('guard_name')->class('form-control bg-white')->disabled()->value($permission->guard_name) }}
                                    </div><!--col-->
                                </div><!--form-group-->
                            </div><!--col-->

                        </div><!--tab-->
                    </div><!--tab-content-->
                </div><!--col-->
            </div><!--row-->
        </div><!--card-body-->

        <div class="card-footer">
            <div class="row">
                <div class="col">
                    <small class="float-right text-muted">
                        <strong>@lang('backend_permissions.tabs.content.overview.created_at'):</strong> {{ timezone()->convertToLocal($permission->created_at) }}
                        ({{ $permission->created_at->diffForHumans() }}),
                        <strong>@lang('backend_permissions.tabs.content.overview.last_updated'):</strong> {{ timezone()->convertToLocal($permission->updated_at) }}
                        ({{ $permission->updated_at->diffForHumans() }})
                        @if ($permission->trashed())
                            <strong>@lang('backend_permissions.tabs.content.overview.deleted_at'):</strong> {{ timezone()->convertToLocal($permission->deleted_at) }}
                            ({{ $permission->deleted_at->diffForHumans() }})
                        @endif
                    </small>
                </div><!--col-->
            </div><!--row-->
        </div><!--card-footer-->
    </div><!--card-->
@endsection
