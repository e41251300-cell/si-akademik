<?php
class AuthController extends BaseController
{
    private const USERNAME = 'admin';
    private const PASSWORD = 'admin123';

    public function showLogin(): void
    {
        if (!empty($_SESSION['user'])) {
            $this->redirect('mahasiswa');
        }
        $error = $_SESSION['error'] ?? null;
        unset($_SESSION['error']);

        $this->view('auth/login', ['title' => 'Login', 'error' => $error]);
    }

    public function login(): void
    {
        $username = trim($_POST['username'] ?? '');
        $password = $_POST['password'] ?? '';

        if ($username === self::USERNAME && $password === self::PASSWORD) {
            session_regenerate_id(true);
            $_SESSION['user'] = $username;
            $this->redirect('mahasiswa');
        }

        $_SESSION['error'] = 'Username atau password salah.';
        $this->redirect('auth/login');
    }

    public function logout(): void
    {
        $_SESSION = [];
        session_destroy();
        $this->redirect('auth/login');
    }
}