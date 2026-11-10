<?php
session_start();

require __DIR__ . '/../app/helpers.php';

spl_autoload_register(function (string $class) {
    foreach (['Core', 'Controllers', 'Repositories'] as $dir) {
        $file = __DIR__ . "/../app/{$dir}/{$class}.php";
        if (is_file($file)) { require $file; return; }
    }
});

// --- Router sederhana: /{controller}/{aksi}/{id} ---
$uriPath = rawurldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
$path    = trim(substr($uriPath, strlen(base_path())), '/');
$parts   = $path === '' ? ['mahasiswa'] : explode('/', $path);
$method  = $_SERVER['REQUEST_METHOD'];
$name    = $parts[0];
$action  = $parts[1] ?? 'index';
$id      = isset($parts[2]) ? (int)$parts[2] : 0;

// Halaman mahasiswa hanya untuk yang sudah login
if ($name === 'mahasiswa' && empty($_SESSION['user'])) {
    header('Location: ' . url('auth/login'));
    exit;
}

$pdo = Database::getInstance();

// Dependency Injection: controller dibuat hanya saat dibutuhkan
$controllers = [
    'mahasiswa' => fn() => new MahasiswaController(new MahasiswaRepository($pdo), new ProdiRepository($pdo)),
    'auth'      => fn() => new AuthController(),
];

// Daftar aksi yang diizinkan (aksi pengubah data wajib POST)
$routes = [
    'mahasiswa' => [
        'GET'  => ['index' => 'index', 'create' => 'create', 'edit' => 'edit'],
        'POST' => ['store' => 'store', 'update' => 'update', 'destroy' => 'destroy'],
    ],
    'auth' => [
        'GET'  => ['login' => 'showLogin'],
        'POST' => ['login' => 'login', 'logout' => 'logout'],
    ],
];

if (!isset($controllers[$name], $routes[$name][$method][$action])) {
    http_response_code(404);
    exit('404 Not Found');
}

$controller = $controllers[$name]();
$fn         = $routes[$name][$method][$action];
$id ? $controller->$fn($id) : $controller->$fn();