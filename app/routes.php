<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

//App::error(function (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
//    return Response::view('main.404', array(), 404);
//});

/**
 * @param string $name
 * @param string $action
 * @param mixed $routeParams
 * @return string
 */
function grid_link($name, $action, $routeParams)
{
    switch ($action) {
        case 'view': // no break
        case 'edit':
            $icon = 'pencil';
            break;
        case 'destroy':
            $icon = 'remove';
            break;
        default:
            $icon = null;
    }

    $linkHtml = $icon ? '<span class="glyphicon glyphicon-' . $icon . '"></span>' : $action;

    return '<a data-action="' . $action . '" href="' . route(".{$name}.{$action}", $routeParams) . '">' . $linkHtml . '</a>';
}

function add_link($name, $text = 'Добавить')
{
    return '<a href="' . route(".{$name}.create") . '" class="btn btn-primary" role="button">
                <span class="glyphicon glyphicon-plus"></span> ' . $text . '
            </a>';
}

function app_array_find($array, $key, $value)
{
    $results = array_where($array, function ($i, $item) use ($key, $value) {
        return $item[$key] === $value;
    });

    return $results;
}

function app_array_find_where($array, $key, $value)
{
    $results = app_array_find($array, $key, $value);
    return array_shift($results);
}



Route::pattern('id', '[0-9]+');

Route::get('/', function () {
    return View::make('hello');
});

Route::post('/upload', ['as' => 'uploader', 'uses' => 'Rutorika\Dashboard\Uploader\UploadController@handle']);

Route::group([], function () {
        $entityDefaultNameSpace = '\\';

        $crudRoutes = [
            ['name' => 'entity'],
        ];

        foreach ($crudRoutes as $route) {
            $name = $route['name'];
            $entity = camel_case($name);
            $controller = studly_case($name) . 'Controller';
            $prefix = array_key_exists('prefix', $route) ? $route['prefix'] : '';
            $entityClassName = studly_case($name);

            $entityNameSpace = isset($route['entityNameSpace']) ? $route['entityNameSpace'] : $entityDefaultNameSpace;
            Route::model($entity, $entityNameSpace . "{$entityClassName}");

            Route::get( "{$name}/{id}",                         ["as" => ".{$name}.view",      "uses" => "{$controller}@view"]);
            Route::get( "{$prefix}{$name}",                     ["as" => ".{$name}.index",     "uses" => "{$controller}@index"]);
            Route::get( "{$prefix}{$name}/create",              ["as" => ".{$name}.create",    "uses" => "{$controller}@create"]);
            Route::post("{$name}/store",                        ["as" => ".{$name}.store",     "uses" => "{$controller}@store"]);
            Route::post("{$name}/{id}/update",                  ["as" => ".{$name}.update",    "uses" => "{$controller}@store"]);
            Route::get( '{$name}/{' . $entity . '}/destroy',    ["as" => ".{$name}.destroy",   "uses" => "{$controller}@destroy"]);
        }
    }
);
