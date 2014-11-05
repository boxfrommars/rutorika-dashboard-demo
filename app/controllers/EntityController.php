<?php
/**
 * @author Dmitry Groza <boxfrommars@gmail.com>
 */

class EntityController extends Rutorika\Dashboard\Controllers\CrudController {

    protected $_entity = '\Entity';
    protected $_name = 'entity';
    protected $_rules = [
        'title' => 'required',
        'description' => 'required',
    ];
    protected $_afterSaveRoute = 'self'; // 'self' (default) | 'index' | 'parent'
    protected $_afterDeleteRoute = 'parent'; // 'parent' (default) | 'index'

}