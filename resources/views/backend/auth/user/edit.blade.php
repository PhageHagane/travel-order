@extends('backend.layouts.app')

@section('title', __('labels.backend.access.users.management') . ' | ' . __('labels.backend.access.users.edit'))

@section('breadcrumb-links')
    @include('backend.auth.user.includes.breadcrumb-links')
@endsection

@section('content')
    {{ html()->modelForm($user, 'PATCH', route('admin.auth.user.update', $user->id))->class('form-horizontal')->open() }}
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        @lang('labels.backend.access.users.management')
                        <small class="text-muted">@lang('labels.backend.access.users.edit')</small>
                    </h4>
                </div><!--col-->
            </div><!--row-->

            <hr>

            <div class="row mt-4 mb-4">
                <div class="col">
                    <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.access.users.first_name'))->class('col-md-2 form-control-label')->for('first_name') }}

                        <div class="col-md-10">
                            {{ html()->text('first_name')
        ->class('form-control')
        ->placeholder(__('validation.attributes.backend.access.users.first_name'))
        ->attribute('maxlength', 191)
        ->required() }}
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.access.users.last_name'))->class('col-md-2 form-control-label')->for('last_name') }}

                        <div class="col-md-10">
                            {{ html()->text('last_name')
        ->class('form-control')
        ->placeholder(__('validation.attributes.backend.access.users.last_name'))
        ->attribute('maxlength', 191)
        ->required() }}
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.access.users.email'))->class('col-md-2 form-control-label')->for('email') }}

                        <div class="col-md-10">
                            {{ html()->email('email')
        ->class('form-control')
        ->placeholder(__('validation.attributes.backend.access.users.email'))
        ->attribute('maxlength', 191)
        ->required() }}
                        </div><!--col-->
                    </div><!--form-group-->

                    {{-- Office --}}
                    <div class="form-group row">
                        {{ html()->label('Office')->class('col-md-2 form-control-label')->for('office_id') }}
                        <div class="col-md-10">
                            {{ html()->select('office_id', $offices)
        ->class('form-control')
        ->placeholder('Select Office')
        ->required() }}
                        </div><!--col-->
                    </div><!--form-group-->

                    {{-- Division --}}
                    <div class="form-group row">
                        {{ html()->label('Division')->class('col-md-2 form-control-label')->for('division_id') }}
                        <div class="col-md-10">
                            {{ html()->select('division_id', $divisions)
        ->class('form-control')
        ->placeholder('Select Division')
        ->required() }}
                        </div><!--col-->
                    </div><!--form-group-->

                    {{-- Client Type --}}
                    <div class="form-group row">
                        {{ html()->label('Client Type')->class('col-md-2 form-control-label')->for('client_type_id') }}
                        <div class="col-md-10">
                            {{ html()->select('client_type_id', $clientTypes)
        ->class('form-control')
        ->placeholder('Select Client Type')
        ->required() }}
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label('Abilities')->class('col-md-2 form-control-label') }}

                        <div class="table-responsive col-md-10">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>@lang('labels.backend.access.users.table.roles')</th>
                                        <th>@lang('labels.backend.access.users.table.permissions')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            @if($roles->count())
                                                @foreach($roles as $role)
                                                                                    <div class="card">
                                                                                        <div class="card-header">
                                                                                            <div class="checkbox d-flex align-items-center">
                                                                                                {{ html()->label(
                                                        html()->checkbox('roles[]', in_array($role->name, $userRoles), $role->name)
                                                            ->class('switch-input')
                                                            ->id('role-' . $role->id)
                                                        . '<span class="switch-slider" data-checked="on" data-unchecked="off"></span>'
                                                    )
                                                        ->class('switch switch-label switch-pill switch-primary mr-2')
                                                        ->for('role-' . $role->id) }}
                                                                                                {{ html()->label(ucwords($role->name))->for('role-' . $role->id) }}
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="card-body">
                                                                                            @if($role->id != 1)
                                                                                                @if($role->permissions->count())
                                                                                                    @foreach($role->permissions as $permission)
                                                                                                        <i class="fas fa-dot-circle"></i> {{ ucwords($permission->name) }}
                                                                                                    @endforeach
                                                                                                @else
                                                                                                    @lang('labels.general.none')
                                                                                                @endif
                                                                                            @else
                                                                                                @lang('labels.backend.access.users.all_permissions')
                                                                                            @endif
                                                                                        </div>
                                                                                    </div><!--card-->
                                                @endforeach
                                            @endif
                                        </td>
                                        <td>
                                            @if($permissions->count())
                                                @php
                                                    // Group permissions by category (first word)
                                                    $groupedPermissions = [];
                                                    foreach ($permissions as $permission) {
                                                        $parts = explode(' ', $permission->name);
                                                        $action = strtolower($parts[0]); // view, store, update, delete
                                                        $category = isset($parts[1]) ? ucwords(implode(' ', array_slice($parts, 1))) : 'General';

                                                        if (!isset($groupedPermissions[$category])) {
                                                            $groupedPermissions[$category] = [];
                                                        }

                                                        $groupedPermissions[$category][] = $permission;
                                                    }

                                                    // Sort actions in desired order
                                                    $actionOrder = ['view', 'store', 'update', 'delete'];
                                                @endphp

                                                @foreach($groupedPermissions as $category => $categoryPermissions)
                                                    <div class="permission-category mb-4">
                                                        <h6 class="category-title mb-3 text-dark">{{ $category }}</h6>

                                                        @php
                                                            // Sort permissions by action order
                                                            usort($categoryPermissions, function ($a, $b) use ($actionOrder) {
                                                                $aAction = strtolower(explode(' ', $a->name)[0]);
                                                                $bAction = strtolower(explode(' ', $b->name)[0]);

                                                                $aIndex = array_search($aAction, $actionOrder);
                                                                $bIndex = array_search($bAction, $actionOrder);

                                                                $aIndex = $aIndex !== false ? $aIndex : 999;
                                                                $bIndex = $bIndex !== false ? $bIndex : 999;

                                                                return $aIndex - $bIndex;
                                                            });
                                                        @endphp

                                                        <div class="category-permissions ml-3">
                                                            @foreach($categoryPermissions as $permission)
                                                                                                    <div class="checkbox d-flex align-items-center mb-2">
                                                                                                        @php
                                                                                                            // Check if user has this permission
                                                                                                            $isChecked = false;

                                                                                                            if (old('permissions')) {
                                                                                                                // Form validation failed, use old input
                                                                                                                $isChecked = in_array($permission->name, old('permissions'));
                                                                                                            } else {
                                                                                                                // Check if user has this permission (from $userPermissions array)
                                                                                                                $isChecked = in_array($permission->name, $userPermissions);
                                                                                                            }
                                                                                                        @endphp

                                                                                                        {{ html()->label(
                                                                    html()->checkbox('permissions[]', $isChecked, $permission->name)
                                                                        ->class('switch-input')
                                                                        ->id('permission-' . $permission->id)
                                                                    . '<span class="switch-slider" data-checked="on" data-unchecked="off"></span>'
                                                                )
                                                                    ->class('switch switch-label switch-pill switch-primary mr-2')
                                                                    ->for('permission-' . $permission->id) }}

                                                                                                        {{ html()->label(ucwords($permission->name))
                                                                    ->for('permission-' . $permission->id) }}
                                                                                                    </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div><!--col-->
                    </div><!--form-group-->
                </div><!--col-->
            </div><!--row-->
        </div><!--card-body-->

        <div class="card-footer">
            <div class="row">
                <div class="col">
                    {{ form_cancel(route('admin.auth.user.index'), __('buttons.general.cancel')) }}
                </div><!--col-->

                <div class="col text-right">
                    {{ form_submit(__('buttons.general.crud.update')) }}
                </div><!--row-->
            </div><!--row-->
        </div><!--card-footer-->
    </div><!--card-->
    {{ html()->closeModelForm() }}
@endsection