<div class="page-card mx-auto" style="max-width: 560px;">
    <div class="text-center mb-4">
        <?php if ($user->avatar): ?>
            <img src="<?= app()->route->getUrl($user->avatar) ?>" alt="Аватар"
                 class="rounded-circle img-thumbnail" style="width: 140px; height: 140px; object-fit: cover;">
        <?php else: ?>
            <div class="rounded-circle bg-secondary text-white d-inline-flex align-items-center justify-content-center"
                 style="width: 140px; height: 140px; font-size: 48px;">
                <?= mb_strtoupper(mb_substr($user->surname ?? '?', 0, 1)) ?>
            </div>
        <?php endif; ?>
    </div>

    <h2 class="text-center"><?= htmlspecialchars($user->surname . ' ' . $user->name) ?></h2>

    <table class="table">
        <tbody>
        <tr>
            <th>Логин</th>
            <td><?= htmlspecialchars($user->login) ?></td>
        </tr>
        <tr>
            <th>Роль</th>
            <td>
                <?php if ($user->role === 'admin'): ?>
                    <span class="badge bg-dark">Администратор</span>
                <?php else: ?>
                    <span class="badge bg-primary">Сотрудник деканата</span>
                <?php endif; ?>
            </td>
        </tr>
        </tbody>
    </table>

    <div class="d-flex gap-2">
        <a href="<?= app()->route->getUrl('/profile/edit') ?>" class="btn btn-primary">Редактировать профиль</a>
        <a href="<?= app()->route->getUrl('/profile/search') ?>" class="btn btn-outline-primary">Поиск пользователей</a>
    </div>
</div>