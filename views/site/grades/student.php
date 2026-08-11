<div class="page-card">
    <h2>Успеваемость студента</h2>

    <form method="GET" class="row g-3 mb-4">
        <div class="col-md-4">
            <label class="form-label">Студент</label>
            <select name="student_id" class="form-select" required onchange="this.form.submit()">
                <option value="">Выберите студента</option>
                <?php foreach ($students as $student): ?>
                    <option value="<?= $student->student_id ?>" <?= ($studentId == $student->student_id) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($student->surname . ' ' . $student->name . ' ' . ($student->patronymic ?? '')) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
    </form>

    <?php if ($studentId): ?>
        <?php if ($grades->isNotEmpty()): ?>
            <h3>Оценки студента</h3>
            <div class="table-responsive">
                <table class="table table-striped table-hover data-table">
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
            </div>
        <?php else: ?>
            <div class="alert alert-warning">Оценок у студента пока нет</div>
        <?php endif; ?>
    <?php endif; ?>
</div>