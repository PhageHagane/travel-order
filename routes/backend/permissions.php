<?php

use App\Http\Controllers\Backend\PermissionController;

use App\Models\Permission;

Route::bind('permission', function ($value) {
	$permission = new Permission;

	return Permission::withTrashed()->where($permission->getRouteKeyName(), $value)->first();
});

Route::group(['prefix' => 'permissions'], function () {
	Route::get(	'', 		[PermissionController::class, 'index']		)->name('permissions.index');
    Route::get(	'create', 	[PermissionController::class, 'create']	)->name('permissions.create');
	Route::post('store', 	[PermissionController::class, 'store']		)->name('permissions.store');
    Route::get(	'deleted', 	[PermissionController::class, 'deleted']	)->name('permissions.deleted');
});

Route::group(['prefix' => 'permissions/{permission}'], function () {
	// Permission
	Route::get('/', [PermissionController::class, 'show'])->name('permissions.show');
	Route::get('edit', [PermissionController::class, 'edit'])->name('permissions.edit');
	Route::patch('update', [PermissionController::class, 'update'])->name('permissions.update');
	Route::delete('destroy', [PermissionController::class, 'destroy'])->name('permissions.destroy');
	// Deleted
	Route::get('restore', [PermissionController::class, 'restore'])->name('permissions.restore');
	Route::get('delete', [PermissionController::class, 'delete'])->name('permissions.delete-permanently');
});