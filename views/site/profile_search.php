<div class="page-card">
    <h2>Поиск пользователей</h2>

    <form method="GET" class="row g-3 mb-4">
        <div class="col-md-6">
            <input type="text" name="query" class="form-control" placeholder="Поиск по фамилии, имени или логину..."
                   value="<?= htmlspecialchars($query ?? '') ?>">
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-primary w-100">Найти</button>
        </div>
    </form>

    <?php if ($users->isNotEmpty()): ?>
        <div class="table-responsive">
            <table class="table table-striped table-hover data-table">
                <thead>
                <tr>
                    <th>ФИО</th>
                    <th>Логин</th>
                    <th>Роль</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td>
                            <?php if ($user->avatar): ?>
                                <img src="<?= app()->route->getUrl($user->avatar) ?>" alt=""
                                     class="rounded-circle me-2" style="width: 32px; height: 32px; object-fit: cover;">
                            <?php endif; ?>
                            <?= htmlspecialchars($user->surname . ' ' . $user->name) ?>
                        </td>
                        <td><?= htmlspecialchars($user->login) ?></td>
                        <td>
                            <?php if ($user->role === 'admin'): ?>
                                <span class="badge bg-dark">Администратор</span>
                            <?php else: ?>
                                <span class="badge bg-primary">Деканат</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php elseif ($query): ?>
        <div class="alert alert-warning">Ничего не найдено по запросу «<?= htmlspecialchars($query) ?>»</div>
    <?php else: ?>
        <div class="alert alert-secondary">Введите запрос для поиска</div>
    <?php endif; ?>
</div>