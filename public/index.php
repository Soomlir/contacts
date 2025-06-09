<?php
require_once __DIR__ . '/../init.php';
require_once __DIR__ . '/../src/Controllers/UserController.php';

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

switch ($uri) {
  case '/':
    $controller = new UserController();
    $controller->index();
    break;
  case '/user/create':
    $controller = new UserController();
    $controller->create();
    break;
  case '/user/save':
    $controller = new UserController();
    $controller->save();
    break;
  case '/user/edit':
    $controller = new UserController();
    $controller->edit();
    break;
  case '/user/saveEdit':
    $controller = new UserController();
    $controller->saveEdit();
    break;
  case '/user/delete':
    $controller = new UserController();
    $controller->delete();
    break;
  default:
    http_response_code(404);
    echo "404 Not Found";
    break;
}
