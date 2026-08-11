<div class="page-card mx-auto" style="max-width: 480px;">
    <h2>Добавление сотрудника деканата</h2>

    <?php if (!empty($message)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($message) ?></div>
    <?php endif; ?>

    <form method="post">
        <div class="mb-3">
            <label class="form-label">Фамилия</label>
            <input type="text" name="surname" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Имя</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Логин</label>
            <input type="text" name="login" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Пароль</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Роль</label>
            <select name="role" class="form-select">
                <option value="dean">Сотрудник деканата</option>
                <option value="admin">Администратор</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Добавить</button>
    </form>
</div>