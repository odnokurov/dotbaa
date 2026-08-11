<h2>Добавление дисциплины</h2>
<?php if (isset($message)): ?>
    <h3><?= $message ?></h3>
<?php endif; ?>
<form method="post">
    <label>Название дисциплины <input type="text" name="subject_name" required></label>
    <button type="submit">Добавить</button>
</form>