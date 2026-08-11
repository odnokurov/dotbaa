<h2>Прикрепление дисциплины к группе</h2>
<?php if (isset($message)): ?>
    <h3><?= $message ?></h3>
<?php endif; ?>
<form method="POST">
    <label>Группа:
        <select name="group_id" required>
            <option value="">Выберите группу</option>
            <?php foreach ($groups as $group): ?>
                <option value="<?= $group->group_id ?>"><?= htmlspecialchars($group->group_name) ?></option>
            <?php endforeach; ?>
        </select>
    </label>
    <label>Дисциплина:
        <select name="subject_id" required>
            <option value="">Выберите дисциплину</option>
            <?php foreach ($subjects as $subject): ?>
                <option value="<?= $subject->subject_id ?>"><?= htmlspecialchars($subject->subject_name) ?></option>
            <?php endforeach; ?>
        </select>
    </label>
    <label>Курс <input type="number" name="course" min="1" max="5" required></label>
    <label>Семестр <input type="number" name="semestr" min="1" max="10" required></label>
    <label>Кол-во часов <input type="number" name="number_of_hours" min="1" required></label>
    <label>Вид контроля:
        <select name="controll_id" required>
            <option value="">Выберите вид контроля</option>
            <?php foreach ($controls as $control): ?>
                <option value="<?= $control->controll_id ?>"><?= htmlspecialchars($control->controll_name) ?></option>
            <?php endforeach; ?>
        </select>
    </label>
    <button type="submit">Прикрепить</button>
</form>