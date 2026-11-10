<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= e($title ?? 'SI Akademik') ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<nav class="navbar navbar-dark bg-primary mb-4">
    <div class="container">
        <a class="navbar-brand" href="<?= url('mahasiswa') ?>">SI Akademik</a>
        <?php if (!empty($_SESSION['user'])): ?>
            <form method="post" action="<?= url('auth/logout') ?>" class="m-0">
                <button class="btn btn-sm btn-light">Logout (<?= e($_SESSION['user']) ?>)</button>
            </form>
        <?php endif; ?>
    </div>
</nav>
<div class="container"><?= $content ?></div>
</body>
</html>