<?php
require_once(__DIR__ . '/Application/autoload.php');

// Definir rotas
$routes = [
    '' => 'Application/views/login.php',
    'login' => 'Application/controllers/login_controller.php',
    'logout' => 'Application/controllers/logout_controller.php',
    'dashboard' => 'Application/views/dashboard.php',
    'fornecedor/cadastro' => 'Application/views/fornecedor/criar_fornecedor.php',
    'fornecedor/editar' => 'Application/views/fornecedor/editar_fornecedor.php',
    'fornecedor/visualizar' => 'Application/views/fornecedor/ver_fornecedor.php',
    'fornecedor/atualizar' => 'Application/controllers/fornecedor_controller.php',
    'fornecedor/cidades' => 'Application/controllers/cidades_controller.php',
];

// Obter o caminho da URL
$path = isset($_GET['url']) ? $_GET['url'] : '';

// Verificar se a rota existe
if (array_key_exists($path, $routes)) {
    require_once(__DIR__ . '/' . $routes[$path]);
} else {
    // Rota não encontrada, redirecionar para página de erro ou página inicial
    header('Location: /');
    exit;
}
