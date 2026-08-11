<h2>Добавление группы</h2>
<?php if (isset($message)): ?>
    <h3><?= $message ?></h3>
<?php endif; ?>
<form method="post">
    <label>Название группы <input type="text" name="group_name" required></label>
    <button type="submit">Добавить</button>
</form>