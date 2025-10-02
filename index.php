<?php
require_once 'controllers/ProductoController.php';

$controller = new ProductoController();
$action = $_GET['action'] ?? 'index';

switch($action) {
    case 'crear':
        $controller->crear();
        break;
    case 'editar':
        $id = $_GET['id'] ?? 0;
        $controller->editar($id);
        break;
    default:
        $controller->index();
        break;
}
?>