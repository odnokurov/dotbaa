<div class="page-card">
    <h2>Указание успеваемости группы</h2>

    <form method="GET" class="row g-3 mb-4">
        <div class="col-md-4">
            <label class="form-label">Группа</label>
            <select name="group_id" class="form-select" required>
                <option value="">Выберите группу</option>
                <?php foreach ($groups as $group): ?>
                    <option value="<?= $group->group_id ?>" <?= ($groupId == $group->group_id) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($group->group_name) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-md-4">
            <label class="form-label">Дисциплина</label>
            <select name="subject_id" class="form-select" required>
                <option value="">Выберите дисциплину</option>
                <?php foreach ($subjects as $subject): ?>
                    <option value="<?= $subject->subject_id ?>" <?= ($subjectId == $subject->subject_id) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($subject->subject_name) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-md-2 align-self-end">
            <button type="submit" class="btn btn-primary">Показать</button>
        </div>
    </form>

    <?php if ($groupId && $subjectId): ?>
        <?php if ($students->isNotEmpty()): ?>
            <?php if ($scheduleId): ?>
                <form method="POST">
                    <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
                    <input type="hidden" name="group_id" value="<?= $groupId ?>">
                    <input type="hidden" name="subject_id" value="<?= $subjectId ?>">
                    <input type="hidden" name="schedule_id" value="<?= $scheduleId ?>">

                    <div class="table-responsive">
                        <table class="table table-striped table-hover data-table">
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
                                        <select name="grades[<?= $student->student_id ?>]" class="form-select w-auto">
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
                    </div>
                    <button type="submit" name="save" class="btn btn-primary">Сохранить оценки</button>
                </form>
            <?php else: ?>
                <div class="alert alert-warning">Для выбранной группы и дисциплины еще нет расписания</div>
            <?php endif; ?>
        <?php else: ?>
            <div class="alert alert-warning">В выбранной группе нет студентов</div>
        <?php endif; ?>
    <?php endif; ?>
</div>