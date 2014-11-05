<?php

Route::pattern('id', '[0-9]+');

Route::get('/', function () {
    return View::make('hello');
});

Route::post('/upload', ['as' => 'uploader', 'uses' => 'Rutorika\Dashboard\Uploader\UploadController@handle']);
Route::group([], function () {

        $crudRoutes = [
            ['name' => 'entity'],
        ];

        generate_crud_routes($crudRoutes);
    }
);
