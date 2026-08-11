<h2>Дисциплины группы по курсу и семестру</h2>

<form method="GET" class="filter-form">
    <label>Курс:
        <select name="course" required>
            <option value="">Курс</option>
            <?php for ($i = 1; $i <= 5; $i++): ?>
                <option value="<?= $i ?>" <?= ($course == $i) ? 'selected' : '' ?>><?= $i ?></option>
            <?php endfor; ?>
        </select>
    </label>
    <label>Семестр:
        <select name="semestr" required>
            <option value="">Семестр</option>
            <?php for ($i = 1; $i <= 10; $i++): ?>
                <option value="<?= $i ?>" <?= ($semestr == $i) ? 'selected' : '' ?>><?= $i ?></option>
            <?php endfor; ?>
        </select>
    </label>
    <button type="submit" class="btn">Показать</button>
</form>

<?php if ($course && $semestr): ?>
    <?php if ($disciplines->isNotEmpty()): ?>
        <h3>Дисциплины: курс <?= $course ?>, семестр <?= $semestr ?></h3>
        <table class="data-table">
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
    <?php else: ?>
        <div class="warning">Дисциплин не найдено</div>
    <?php endif; ?>
<?php endif; ?>