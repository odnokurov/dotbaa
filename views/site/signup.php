<h2>Добавление сотрудника деканата</h2>
<?php if (isset($message)): ?>
    <h3><?= $message ?></h3>
<?php endif; ?>
<form method="post">
    <label>Фамилия <input type="text" name="surname" required></label>
    <label>Имя <input type="text" name="name" required></label>
    <label>Логин <input type="text" name="login" required></label>
    <label>Пароль <input type="password" name="password" required></label>
    <label>Роль
        <select name="role">
            <option value="dean">Сотрудник деканата</option>
            <option value="admin">Администратор</option>
        </select>
    </label>
    <button type="submit">Добавить</button>
</form>