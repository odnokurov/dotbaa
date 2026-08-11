<div class="page-card mx-auto" style="max-width: 480px;">
    <h2 class="text-center">Авторизация</h2>

    <?php if (!empty($message)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($message) ?></div>
    <?php endif; ?>

    <?php if (!app()->auth::check()): ?>
        <form method="post">
            <div class="mb-3">
                <label class="form-label">Логин</label>
                <input type="text" name="login" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Пароль</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Войти</button>
        </form>
    <?php else: ?>
        <div class="alert alert-success">Вы уже авторизованы</div>
    <?php endif; ?>
</div>