<div class="page-card">
    <h2>Дисциплины группы по курсу и семестру</h2>

    <form method="GET" class="row g-3 mb-4">
        <div class="col-md-3">
            <label class="form-label">Курс</label>
            <select name="course" class="form-select" required>
                <option value="">Курс</option>
                <?php for ($i = 1; $i <= 5; $i++): ?>
                    <option value="<?= $i ?>" <?= ($course == $i) ? 'selected' : '' ?>><?= $i ?></option>
                <?php endfor; ?>
            </select>
        </div>
        <div class="col-md-3">
            <label class="form-label">Семестр</label>
            <select name="semestr" class="form-select" required>
                <option value="">Семестр</option>
                <?php for ($i = 1; $i <= 10; $i++): ?>
                    <option value="<?= $i ?>" <?= ($semestr == $i) ? 'selected' : '' ?>><?= $i ?></option>
                <?php endfor; ?>
            </select>
        </div>
        <div class="col-md-2 align-self-end">
            <button type="submit" class="btn btn-primary">Показать</button>
        </div>
    </form>

    <?php if ($course && $semestr): ?>
        <?php if ($disciplines->isNotEmpty()): ?>
            <h3>Дисциплины: курс <?= $course ?>, семестр <?= $semestr ?></h3>
            <div class="table-responsive">
                <table class="table table-striped table-hover data-table">
                    <thead>
                    <tr>
                        <th>Группа</th>
                        <th>Дисциплина</th>
                        <th>Вид контроля</th>
                        <th>Часов</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($disciplines as $syllabus): ?>
                        <tr>
                            <td><?= htmlspecialchars($syllabus->group->group_name ?? '') ?></td>
                            <td><?= htmlspecialchars($syllabus->subject->subject_name ?? '') ?></td>
                            <td><?= htmlspecialchars($syllabus->typeOfControll->controll_name ?? '') ?></td>
                            <td><?= $syllabus->number_of_hours ?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="alert alert-warning">Дисциплин не найдено</div>
        <?php endif; ?>
    <?php endif; ?>
</div>