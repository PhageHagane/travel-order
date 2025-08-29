@extends('backend.layouts.app')

@section('title', __('labels.backend.access.roles.management') . ' | ' . __('labels.backend.access.roles.edit'))

@section('content')
    {{ html()->modelForm($role, 'PATCH', route('admin.auth.role.update', $role))->class('form-horizontal')->open() }}
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        @lang('labels.backend.access.roles.management')
                        <small class="text-muted">@lang('labels.backend.access.roles.edit')</small>
                    </h4>
                </div><!--col-->
            </div><!--row-->
            <!--row-->

            <hr />

            <div class="row mt-4">
                <div class="col">
                    <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.access.roles.name'))
        ->class('col-md-2 form-control-label')
        ->for('name') }}

                        <div class="col-md-10">
                            {{ html()->text('name')
        ->class('form-control')
        ->placeholder(__('validation.attributes.backend.access.roles.name'))
        ->attribute('maxlength', 191)
        ->required() }}
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.access.roles.associated_permissions'))
        ->class('col-md-2 form-control-label')
        ->for('permissions') }}

                        <div class="col-md-10">
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
                                                                            // Check if permission is selected (for edit mode or validation errors)
                                                                            $isChecked = false;

                                                                            if (old('permissions')) {
                                                                                // Form validation failed, use old input
                                                                                $isChecked = in_array($permission->name, old('permissions'));
                                                                            } elseif (isset($role) && $role->permissions) {
                                                                                // Edit mode, check if role has this permission
                                                                                $isChecked = $role->permissions->contains('name', $permission->name);
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
                        </div><!--col-->
                    </div><!--form-group-->
                </div><!--col-->
            </div><!--row-->
        </div><!--card-body-->

        <div class="card-footer">
            <div class="row">
                <div class="col">
                    {{ form_cancel(route('admin.auth.role.index'), __('buttons.general.cancel')) }}
                </div><!--col-->

                <div class="col text-right">
                    {{ form_submit(__('buttons.general.crud.update')) }}
                </div><!--col-->
            </div><!--row-->
        </div><!--card-footer-->
    </div><!--card-->
    {{ html()->closeModelForm() }}
@endsection