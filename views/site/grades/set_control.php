<div class="page-card">
    <h2>Указание вида контроля</h2>

    <form method="GET" class="row g-3 mb-4">
        <div class="col-md-4">
            <label class="form-label">Группа</label>
            <select name="group_id" class="form-select" required onchange="this.form.submit()">
                <option value="">Выберите группу</option>
                <?php foreach ($groups as $group): ?>
                    <option value="<?= $group->group_id ?>" <?= ($groupId == $group->group_id) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($group->group_name) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
    </form>

    <?php if ($groupId && $syllabuses->isNotEmpty()): ?>
        <h3>Дисциплины группы</h3>
        <form method="POST">
            <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
            <div class="table-responsive">
                <table class="table table-striped table-hover data-table">
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
                                <select name="controll_id[<?= $syllabus->syllabus_id ?>]" class="form-select">
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
            </div>
            <button type="submit" class="btn btn-primary">Сохранить</button>
        </form>
    <?php elseif ($groupId): ?>
        <div class="alert alert-warning">Дисциплин не найдено</div>
    <?php endif; ?>
</div>