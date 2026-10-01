<h2>Добавление вида контроля</h2>

<?php if (!empty($message)): ?>
    <div class="alert alert-danger">
        <pre><?= $message ?></pre>
    </div>
<?php endif; ?>

<form method="post">
    <input type="hidden" name="csrf_token" value="<?= app()->auth::generateCSRF() ?>">

    <div class="mb-3">
        <label class="form-label">Название вида контроля</label>
        <input type="text" name="controll_name" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-primary">Добавить</button>
    <a href="<?= app()->route->getUrl('/dashboard') ?>" class="btn btn-outline-secondary">Назад</a>
</form>