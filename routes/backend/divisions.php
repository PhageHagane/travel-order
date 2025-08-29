<?php

use App\Http\Controllers\Backend\DivisionController;

use App\Models\Division;

Route::bind('division', function ($value) {
	$division = new Division;

	return Division::withTrashed()->where($division->getRouteKeyName(), $value)->first();
});

Route::group(['prefix' => 'divisions'], function () {
	Route::get(	'', 		[DivisionController::class, 'index']		)->name('divisions.index');
    Route::get(	'create', 	[DivisionController::class, 'create']	)->name('divisions.create');
	Route::post('store', 	[DivisionController::class, 'store']		)->name('divisions.store');
    Route::get(	'deleted', 	[DivisionController::class, 'deleted']	)->name('divisions.deleted');
});

Route::group(['prefix' => 'divisions/{division}'], function () {
	// Division
	Route::get('/', [DivisionController::class, 'show'])->name('divisions.show');
	Route::get('edit', [DivisionController::class, 'edit'])->name('divisions.edit');
	Route::patch('update', [DivisionController::class, 'update'])->name('divisions.update');
	Route::delete('destroy', [DivisionController::class, 'destroy'])->name('divisions.destroy');
	// Deleted
	Route::get('restore', [DivisionController::class, 'restore'])->name('divisions.restore');
	Route::get('delete', [DivisionController::class, 'delete'])->name('divisions.delete-permanently');
});