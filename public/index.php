<?php
require __DIR__ . '/../vendor/autoload.php';

use App\Controller\MainController;

$controller = new MainController();
$action = $_GET['action'] ?? 'home';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller->handlePost();
    exit;
}

$controller->handleGet($action);
