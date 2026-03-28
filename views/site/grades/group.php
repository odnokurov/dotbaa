<h2>Указание успеваемости группы</h2>

<?php if (isset($_SESSION['message'])): ?>
    <div class="success"><?= htmlspecialchars($_SESSION['message']) ?></div>
    <?php unset($_SESSION['message']); ?>
<?php endif; ?>

<form method="GET" class="filter-form">
    <div class="form-group">
        <label>Группа:</label>
        <select name="group_id" required>
            <option value="">Выберите группу</option>
            <?php foreach ($groups as $group): ?>
                <option value="<?= $group['group_id'] ?>" <?= ($groupId == $group['group_id']) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($group['group_name']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group">
        <label>Дисциплина:</label>
        <select name="subject_id" required>
            <option value="">Выберите дисциплину</option>
            <?php foreach ($subjects as $subject): ?>
                <option value="<?= $subject['subject_id'] ?>" <?= ($subjectId == $subject['subject_id']) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($subject['subject_name']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <button type="submit" class="btn">Выбрать</button>
</form>

<?php if ($groupId && $subjectId): ?>
    <?php if ($students && $scheduleId): ?>
        <form method="POST" class="grades-form">
            <input type="hidden" name="csrf_token" value="<?= csrf_token() ?>">
            <input type="hidden" name="schedule_id" value="<?= $scheduleId ?>">

            <table class="data-table">
                <thead>
                <tr>
                    <th>Студент</th>
                    <th>Оценка</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($students as $student): ?>
                    <tr>
                        <td><?= htmlspecialchars($student['surname'] . ' ' . $student['name'] . ' ' . ($student['patronymic'] ?? '')) ?></td>
                        <td>
                            <select name="grades[<?= $student['student_id'] ?>]">
                                <option value="">--</option>
                                <option value="2" <?= (isset($existingGrades[$student['student_id']]) && $existingGrades[$student['student_id']] == 2) ? 'selected' : '' ?>>2</option>
                                <option value="3" <?= (isset($existingGrades[$student['student_id']]) && $existingGrades[$student['student_id']] == 3) ? 'selected' : '' ?>>3</option>
                                <option value="4" <?= (isset($existingGrades[$student['student_id']]) && $existingGrades[$student['student_id']] == 4) ? 'selected' : '' ?>>4</option>
                                <option value="5" <?= (isset($existingGrades[$student['student_id']]) && $existingGrades[$student['student_id']] == 5) ? 'selected' : '' ?>>5</option>
                            </select>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
            <button type="submit" name="save" class="btn">Сохранить оценки</button>
        </form>
    <?php elseif ($students && !$scheduleId): ?>
        <div class="warning">
            Для выбранной группы и дисциплины еще нет расписания.<br>
            Пожалуйста, создайте расписание для этой пары.
        </div>
    <?php elseif (!$students): ?>
        <div class="warning">В выбранной группе нет студентов</div>
    <?php endif; ?>
<?php endif; ?>