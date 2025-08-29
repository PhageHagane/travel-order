<?php

use App\Http\Controllers\Backend\ClientTypeController;

use App\Models\ClientType;

Route::bind('client_type', function ($value) {
	$client_type = new ClientType;

	return ClientType::withTrashed()->where($client_type->getRouteKeyName(), $value)->first();
});

Route::group(['prefix' => 'client_types'], function () {
	Route::get(	'', 		[ClientTypeController::class, 'index']		)->name('client_types.index');
    Route::get(	'create', 	[ClientTypeController::class, 'create']	)->name('client_types.create');
	Route::post('store', 	[ClientTypeController::class, 'store']		)->name('client_types.store');
    Route::get(	'deleted', 	[ClientTypeController::class, 'deleted']	)->name('client_types.deleted');
});

Route::group(['prefix' => 'client_types/{client_type}'], function () {
	// ClientType
	Route::get('/', [ClientTypeController::class, 'show'])->name('client_types.show');
	Route::get('edit', [ClientTypeController::class, 'edit'])->name('client_types.edit');
	Route::patch('update', [ClientTypeController::class, 'update'])->name('client_types.update');
	Route::delete('destroy', [ClientTypeController::class, 'destroy'])->name('client_types.destroy');
	// Deleted
	Route::get('restore', [ClientTypeController::class, 'restore'])->name('client_types.restore');
	Route::get('delete', [ClientTypeController::class, 'delete'])->name('client_types.delete-permanently');
});