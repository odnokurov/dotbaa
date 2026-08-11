<h2>Прикрепление студента к группе</h2>
<?php if (isset($message)): ?>
    <h3><?= $message ?></h3>
<?php endif; ?>
<form method="POST">
    <label>Студент:
        <select name="student_id" required>
            <option value="">Выберите студента</option>
            <?php foreach ($students as $student): ?>
                <option value="<?= $student->student_id ?>">
                    <?= htmlspecialchars($student->surname . ' ' . $student->name . ($student->patronymic ? ' ' . $student->patronymic : '')) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </label>
    <label>Группа:
        <select name="group_id" required>
            <option value="">Выберите группу</option>
            <?php foreach ($groups as $group): ?>
                <option value="<?= $group->group_id ?>"><?= htmlspecialchars($group->group_name) ?></option>
            <?php endforeach; ?>
        </select>
    </label>
    <button type="submit">Прикрепить</button>
</form>