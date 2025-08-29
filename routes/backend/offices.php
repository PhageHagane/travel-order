<?php

use App\Http\Controllers\Backend\OfficeController;

use App\Models\Office;

Route::bind('office', function ($value) {
	$office = new Office;

	return Office::withTrashed()->where($office->getRouteKeyName(), $value)->first();
});

Route::group(['prefix' => 'offices'], function () {
	Route::get(	'', 		[OfficeController::class, 'index']		)->name('offices.index');
    Route::get(	'create', 	[OfficeController::class, 'create']	)->name('offices.create');
	Route::post('store', 	[OfficeController::class, 'store']		)->name('offices.store');
    Route::get(	'deleted', 	[OfficeController::class, 'deleted']	)->name('offices.deleted');
});

Route::group(['prefix' => 'offices/{office}'], function () {
	// Office
	Route::get('/', [OfficeController::class, 'show'])->name('offices.show');
	Route::get('edit', [OfficeController::class, 'edit'])->name('offices.edit');
	Route::patch('update', [OfficeController::class, 'update'])->name('offices.update');
	Route::delete('destroy', [OfficeController::class, 'destroy'])->name('offices.destroy');
	// Deleted
	Route::get('restore', [OfficeController::class, 'restore'])->name('offices.restore');
	Route::get('delete', [OfficeController::class, 'delete'])->name('offices.delete-permanently');
});