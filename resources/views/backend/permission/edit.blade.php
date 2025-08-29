@extends('backend.layouts.app')

@section('title', __('backend_permissions.labels.management') . ' | ' . __('backend_permissions.labels.edit'))

@section('breadcrumb-links')
    @include('backend.permission.includes.breadcrumb-links')
@endsection

@section('content')
    {{ html()->modelForm($permission, 'PATCH', route('admin.permissions.update', $permission->id))->class('form-horizontal')->open() }}
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        @lang('backend_permissions.labels.management')
                        <small class="text-muted">@lang('backend_permissions.labels.edit')</small>
                    </h4>
                </div><!--col-->
            </div><!--row-->

            <hr>

            <div class="row mt-4 mb-4">
                <div class="col">
                    <!-- input name -->
                    <div class="form-group row">
                        {{ html()->label(__('Name'))->class('col-md-2 form-control-label')->for('name') }}

                        <div class="col-md-10">
                            {{ html()->text('name')->class('form-control')->placeholder(__('Enter guard name'))->attribute('maxlength', 191)->required() }}
                        </div><!--col-->
                    </div><!--form-group-->

                    <!-- input guard_name -->
                    <div class="form-group row">
                        {{ html()->label(__('Guard Name'))->class('col-md-2 form-control-label')->for('guard_name') }}

                        <div class="col-md-10">
                            {{ html()->text('guard_name')->class('form-control')->placeholder(__('Enter guard name'))->attribute('maxlength', 191)->required() }}
                        </div><!--col-->
                    </div><!--form-group-->
                </div><!--col-->
            </div><!--row-->
        </div><!--card-body-->

        <div class="card-footer">
            <div class="row">
                <div class="col">
                    {{ form_cancel(route('admin.permissions.index'), __('buttons.general.cancel')) }}
                </div><!--col-->

                <div class="col text-right">
                    {{ form_submit(__('buttons.general.crud.update')) }}
                </div><!--row-->
            </div><!--row-->
        </div><!--card-footer-->
    </div><!--card-->
    {{ html()->closeModelForm() }}
@endsection
