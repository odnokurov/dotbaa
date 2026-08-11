<div class="page-card mx-auto" style="max-width: 480px;">
    <h2>Прикрепление студента к группе</h2>

    <?php if (!empty($message)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($message) ?></div>
    <?php endif; ?>

    <form method="POST">
        <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
        <div class="mb-3">
            <label class="form-label">Студент</label>
            <select name="student_id" class="form-select" required>
                <option value="">Выберите студента</option>
                <?php foreach ($students as $student): ?>
                    <option value="<?= $student->student_id ?>">
                        <?= htmlspecialchars($student->surname . ' ' . $student->name . ($student->patronymic ? ' ' . $student->patronymic : '')) ?>
                    </option>
                <?php endforeach; ?>
            </select>
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
        <button type="submit" class="btn btn-primary">Прикрепить</button>
    </form>
</div>