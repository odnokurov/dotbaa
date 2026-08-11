<div class="page-card mx-auto" style="max-width: 480px;">
    <h2>Добавление студента</h2>

    <?php if (!empty($message)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($message) ?></div>
    <?php endif; ?>

    <form method="post">
        <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
        <div class="mb-3">
            <label class="form-label">Фамилия</label>
            <input type="text" name="surname" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Имя</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Отчество</label>
            <input type="text" name="patronymic" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Пол</label>
            <select name="gender" class="form-select">
                <option value="м">Мужской</option>
                <option value="ж">Женский</option>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Дата рождения</label>
            <input type="date" name="birthday" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Адрес</label>
            <input type="text" name="address" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Группа</label>
            <select name="group_id" class="form-select" required>
                <option value="">Выберите группу</option>
                <?php foreach ($groups as $group): ?>
                    <option value="<?= $group->group_id ?>"><?= htmlspecialchars($group->group_name) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Добавить</button>
    </form>
</div>