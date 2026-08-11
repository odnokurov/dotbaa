<h2>Указание вида контроля</h2>

<form method="GET" class="filter-form">
    <label>Группа:
        <select name="group_id" required onchange="this.form.submit()">
            <option value="">Выберите группу</option>
            <?php foreach ($groups as $group): ?>
                <option value="<?= $group->group_id ?>" <?= ($groupId == $group->group_id) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($group->group_name) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </label>
</form>

<?php if ($groupId && $syllabuses->isNotEmpty()): ?>
    <h3>Дисциплины группы</h3>
    <form method="POST" class="controls-form">
        <table class="data-table">
            <thead>
            <tr>
                <th>Дисциплина</th>
                <th>Вид контроля</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($syllabuses as $syllabus): ?>
                <tr>
                    <td><?= htmlspecialchars($syllabus->subject->subject_name ?? '') ?></td>
                    <td>
                        <select name="controll_id[<?= $syllabus->syllabus_id ?>]">
                            <option value="">--</option>
                            <?php foreach ($controls as $control): ?>
                                <option value="<?= $control->controll_id ?>" <?= ($syllabus->controll_id == $control->controll_id) ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($control->controll_name) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <button type="submit" class="btn">Сохранить</button>
    </form>
<?php elseif ($groupId): ?>
    <div class="warning">Дисциплин не найдено</div>
<?php endif; ?>