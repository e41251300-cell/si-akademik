<?php
require __DIR__ . '/../app/helpers.php';

spl_autoload_register(function (string $class) {
    foreach (['Core', 'Controllers', 'Repositories'] as $dir) {
        $file = __DIR__ . "/../app/{$dir}/{$class}.php";
        if (is_file($file)) { require $file; return; }
    }
});

// --- Router sederhana: /mahasiswa/{aksi}/{id} ---
$uriPath = rawurldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
$path    = trim(substr($uriPath, strlen(base_path())), '/');
$parts   = $path === '' ? ['mahasiswa'] : explode('/', $path);
$method  = $_SERVER['REQUEST_METHOD'];
$action  = $parts[1] ?? 'index';
$id      = isset($parts[2]) ? (int)$parts[2] : 0;

if ($parts[0] !== 'mahasiswa') { http_response_code(404); exit('404 Not Found'); }

// Dependency Injection (Acara 9): rakit objek di satu tempat
$pdo        = Database::getInstance();
$controller = new MahasiswaController(new MahasiswaRepository($pdo), new ProdiRepository($pdo));

// POST wajib untuk operasi yang mengubah data
$routes = [
    'GET'  => ['index' => 'index', 'create' => 'create', 'edit' => 'edit'],
    'POST' => ['store' => 'store', 'update' => 'update', 'destroy' => 'destroy'],
];

if (!isset($routes[$method][$action])) { http_response_code(404); exit('404 Not Found'); }

$fn = $routes[$method][$action];
$id ? $controller->$fn($id) : $controller->$fn();