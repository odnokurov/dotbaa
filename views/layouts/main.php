<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Деканат</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f4f6f9; }
        .page-card {
            background: #fff;
            border-radius: 12px;
            padding: 28px;
            box-shadow: 0 2px 12px rgba(0, 0, 0, .08);
            margin-top: 24px;
        }
        .page-card h2 { margin-bottom: 20px; }
        .data-table { width: 100%; }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
    <div class="container">
        <a class="navbar-brand" href="<?= app()->route->getUrl('/dashboard') ?>">Деканат</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navMenu">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="<?= app()->route->getUrl('/dashboard') ?>">Главная</a>
                </li>
                <?php if (!app()->auth::check()): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= app()->route->getUrl('/login') ?>">Вход</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= app()->route->getUrl('/profile/user') ?>">Профиль</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= app()->route->getUrl('/logout') ?>">Выход (<?= htmlspecialchars(app()->auth::user()->name ?? '') ?>)</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>

<main class="container">
    <?= $content ?? '' ?>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>