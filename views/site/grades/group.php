<h2>Указание успеваемости группы</h2>

<form method="GET" class="filter-form">
    <label>Группа:
        <select name="group_id" required>
            <option value="">Выберите группу</option>
            <?php foreach ($groups as $group): ?>
                <option value="<?= $group->group_id ?>" <?= ($groupId == $group->group_id) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($group->group_name) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </label>
    <label>Дисциплина:
        <select name="subject_id" required>
            <option value="">Выберите дисциплину</option>
            <?php foreach ($subjects as $subject): ?>
                <option value="<?= $subject->subject_id ?>" <?= ($subjectId == $subject->subject_id) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($subject->subject_name) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </label>
    <button type="submit" class="btn">Показать</button>
</form>

<?php if ($groupId && $subjectId): ?>
    <?php if ($students->isNotEmpty()): ?>
        <?php if ($scheduleId): ?>
            <form method="POST" class="grades-form">
                <input type="hidden" name="group_id" value="<?= $groupId ?>">
                <input type="hidden" name="subject_id" value="<?= $subjectId ?>">
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
                            <td><?= htmlspecialchars($student->surname . ' ' . $student->name . ' ' . ($student->patronymic ?? '')) ?></td>
                            <td>
                                <select name="grades[<?= $student->student_id ?>]">
                                    <option value="">--</option>
                                    <?php foreach ([2, 3, 4, 5] as $value): ?>
                                        <option value="<?= $value ?>" <?= (isset($existingGrades[$student->student_id]) && $existingGrades[$student->student_id] == $value) ? 'selected' : '' ?>>
                                            <?= $value ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
                <button type="submit" name="save" class="btn">Сохранить оценки</button>
            </form>
        <?php else: ?>
            <div class="warning">Для выбранной группы и дисциплины еще нет расписания</div>
        <?php endif; ?>
    <?php else: ?>
        <div class="warning">В выбранной группе нет студентов</div>
    <?php endif; ?>
<?php endif; ?>