<h2>Успеваемость студента</h2>

<form method="GET" class="filter-form">
    <label>Студент:
        <select name="student_id" required onchange="this.form.submit()">
            <option value="">Выберите студента</option>
            <?php foreach ($students as $student): ?>
                <option value="<?= $student->student_id ?>" <?= ($studentId == $student->student_id) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($student->surname . ' ' . $student->name . ' ' . ($student->patronymic ?? '')) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </label>
</form>

<?php if ($studentId): ?>
    <?php if ($grades->isNotEmpty()): ?>
        <h3>Оценки студента</h3>
        <table class="data-table">
            <thead>
            <tr>
                <th>Дисциплина</th>
                <th>Вид контроля</th>
                <th>Оценка</th>
                <th>Дата занятия</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($grades as $grade): ?>
                <tr>
                    <td><?= htmlspecialchars($grade->schedule->syllabus->subject->subject_name ?? '') ?></td>
                    <td><?= htmlspecialchars($grade->schedule->syllabus->typeOfControll->controll_name ?? '') ?></td>
                    <td><?= $grade->grade ?></td>
                    <td><?= $grade->schedule->date_of_lesson ?? '' ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <div class="warning">Оценок у студента пока нет</div>
    <?php endif; ?>
<?php endif; ?>