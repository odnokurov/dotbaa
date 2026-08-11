<div class="page-card mx-auto" style="max-width: 480px;">
    <h2>Редактирование профиля</h2>

    <?php if (!empty($message)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($message) ?></div>
    <?php endif; ?>

    <div class="text-center mb-4">
        <?php if ($user->avatar): ?>
            <img src="<?= app()->route->getUrl($user->avatar) ?>" alt="Аватар"
                 class="rounded-circle img-thumbnail" style="width: 120px; height: 120px; object-fit: cover;">
        <?php else: ?>
            <div class="rounded-circle bg-secondary text-white d-inline-flex align-items-center justify-content-center"
                 style="width: 120px; height: 120px; font-size: 40px;">
                <?= mb_strtoupper(mb_substr($user->surname ?? '?', 0, 1)) ?>
            </div>
        <?php endif; ?>
    </div>

    <form method="POST" enctype="multipart/form-data" action="<?= app()->route->getUrl('/profile/update') ?>">
        <div class="mb-3">
            <label class="form-label">Фамилия</label>
            <input type="text" name="surname" class="form-control" value="<?= htmlspecialchars($user->surname) ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Имя</label>
            <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($user->name) ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Логин</label>
            <input type="text" name="login" class="form-control" value="<?= htmlspecialchars($user->login) ?>" disabled>
        </div>
        <div class="mb-3">
            <label class="form-label">Аватар</label>
            <input type="file" name="avatar" class="form-control" accept=".jpg,.jpeg,.png,.gif,.webp">
            <div class="form-text">Разрешены: jpg, jpeg, png, gif, webp</div>
        </div>
        <button type="submit" class="btn btn-primary">Сохранить</button>
        <a href="<?= app()->route->getUrl('/profile/user') ?>" class="btn btn-outline-secondary">Отмена</a>
    </form>
</div>