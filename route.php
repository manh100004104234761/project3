<?php
/**
 * Get query request params
 */
$scope = isset($_REQUEST['scope']) ? $scope = $_REQUEST['scope'] : null;
$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : null;
$id = isset($_REQUEST['id']) ? $_REQUEST['id'] : null;

/**
 * Define route
 */
$router = [
    'frontend' => [
        'home',
        'productDetail',
        'login'
    ],
    'admin' => [
        'showAddForm',
        'validateForm'
    ]
];

/**
 * Direct 404 to home page
 */
if (!array_key_exists($scope, $router) || !in_array($action, $router[$scope])) {
    $scope = 'frontend';
    $action = 'home';
}


/**
 * Create controller and process method
 */
$class = 'BaoQuan\\Controllers\\' . ucwords($scope) . 'Controller';

$controller = new $class();
$controller->$action();
