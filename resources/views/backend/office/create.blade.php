@extends('backend.layouts.app')

@section('title', __('backend_offices.labels.management') . ' | ' . __('backend_offices.labels.create'))

@section('breadcrumb-links')
    @include('backend.office.includes.breadcrumb-links')
@endsection

@section('content')
{{ html()->form('POST', route('admin.offices.store'))->class('form-horizontal')->open() }}
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        @lang('backend_offices.labels.management')
                        <small class="text-muted">@lang('backend_offices.labels.create')</small>
                    </h4>
                </div><!--col-->
            </div><!--row-->

            <hr>

            <div class="row mt-4 mb-4">
                <div class="col">
                    <div class="form-group row">
                    {{ html()->label(__('backend_offices.validation.attributes.name'))->class('col-md-2 form-control-label')->for('name') }}

                        <div class="col-md-10">
                            {{ html()->text('name')
                                ->class('form-control')
                                ->placeholder(__('backend_offices.validation.attributes.name'))
                                ->attribute('maxlength', 191)
                                ->required() }}
                        </div><!--col-->
                    </div><!--form-group-->
                    <div class="form-group row">
                    {{ html()->label('Abbreviation')->class('col-md-2 form-control-label')->for('abbr') }}

                        <div class="col-md-10">
                            {{ html()->text('abbr')
                                ->class('form-control')
                                ->placeholder('Abbreviation')
                                ->attribute('maxlength', 191)
                                ->required() }}
                        </div><!--col-->
                    </div><!--form-group-->
                </div><!--col-->
            </div><!--row-->
        </div><!--card-body-->

        <div class="card-footer">
            <div class="row">
                <div class="col">
                    {{ form_cancel(route('admin.offices.index'), __('buttons.general.cancel')) }}
                </div><!--col-->

                <div class="col text-right">
                    {{ form_submit(__('buttons.general.crud.create')) }}
                </div><!--row-->
            </div><!--row-->
        </div><!--card-footer-->
    </div><!--card-->
{{ html()->closeModelForm() }}
@endsection
