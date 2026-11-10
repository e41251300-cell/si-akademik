<?php
// Parent class: method yang dipakai bersama oleh SEMUA controller
abstract class BaseController
{
    protected function view(string $view, array $data = []): void
    {
        extract($data);
        ob_start();
        require __DIR__ . '/../Views/' . $view . '.php';
        $content = ob_get_clean();
        require __DIR__ . '/../Views/layout.php';
    }

    protected function redirect(string $path): never
    {
        header('Location: ' . url($path));
        exit;
    }
}
