<div class="page-card mx-auto" style="max-width: 480px;">
    <h2>Добавление группы</h2>

    <?php if (!empty($message)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($message) ?></div>
    <?php endif; ?>

    <form method="post">
        <div class="mb-3">
            <label class="form-label">Название группы</label>
            <input type="text" name="group_name" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Добавить</button>
    </form>
</div>