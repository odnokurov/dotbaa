<h2>Добавление студента</h2>
<?php if (isset($message)): ?>
    <h3><?= $message ?></h3>
<?php endif; ?>
<form method="post">
    <label>Фамилия <input type="text" name="surname" required></label>
    <label>Имя <input type="text" name="name" required></label>
    <label>Отчество <input type="text" name="patronymic"></label>
    <label>Пол
        <select name="gender">
            <option value="м">Мужской</option>
            <option value="ж">Женский</option>
        </select>
    </label>
    <label>Дата рождения <input type="date" name="birthday" required></label>
    <label>Адрес <input type="text" name="address"></label>
    <label>Группа
        <select name="group_id" required>
            <?php foreach ($groups as $group): ?>
                <option value="<?= $group->group_id ?>"><?= $group->group_name ?></option>
            <?php endforeach; ?>
        </select>
    </label>
    <button type="submit">Добавить</button>
</form>