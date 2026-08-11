<div class="page-card mx-auto" style="max-width: 560px;">
    <h2>Прикрепление дисциплины к группе</h2>

    <?php if (!empty($message)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($message) ?></div>
    <?php endif; ?>

    <form method="POST">
        <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
        <div class="mb-3">
            <label class="form-label">Группа</label>
            <select name="group_id" class="form-select" required>
                <option value="">Выберите группу</option>
                <?php foreach ($groups as $group): ?>
                    <option value="<?= $group->group_id ?>"><?= htmlspecialchars($group->group_name) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Дисциплина</label>
            <select name="subject_id" class="form-select" required>
                <option value="">Выберите дисциплину</option>
                <?php foreach ($subjects as $subject): ?>
                    <option value="<?= $subject->subject_id ?>"><?= htmlspecialchars($subject->subject_name) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="row">
            <div class="col-md-4 mb-3">
                <label class="form-label">Курс</label>
                <input type="number" name="course" class="form-control" min="1" max="5" required>
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label">Семестр</label>
                <input type="number" name="semestr" class="form-control" min="1" max="10" required>
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label">Кол-во часов</label>
                <input type="number" name="number_of_hours" class="form-control" min="1" required>
            </div>
        </div>
        <div class="mb-3">
            <label class="form-label">Вид контроля</label>
            <select name="controll_id" class="form-select" required>
                <option value="">Выберите вид контроля</option>
                <?php foreach ($controls as $control): ?>
                    <option value="<?= $control->controll_id ?>"><?= htmlspecialchars($control->controll_name) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Прикрепить</button>
    </form>
</div>