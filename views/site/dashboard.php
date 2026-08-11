<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="dashboard-menu">
    <div class="menu-grid">
        <div class="menu-card">
            <h3>Группы</h3>
            <p>Управление учебными группами</p>
            <?php if ($user->role === 'dean' || $user->role === 'admin'): ?>
                <a href="<?= app()->route->getUrl('/groups/add') ?>" class="btn">Добавить группу</a>
                <a href="<?= app()->route->getUrl('/groups/add-discipline') ?>" class="btn">Прикрепить дисциплину</a>
            <?php endif; ?>
        </div>

        <div class="menu-card">
            <h3>Студенты</h3>
            <p>Управление студентами</p>
            <?php if ($user->role === 'dean' || $user->role === 'admin'): ?>
                <a href="<?= app()->route->getUrl('/students/add') ?>" class="btn">Добавить студента</a>
            <?php endif; ?>
            <?php if ($user->role === 'admin'): ?>
                <a href="<?= app()->route->getUrl('/students/attach') ?>" class="btn">Прикрепить студента</a>
            <?php endif; ?>
        </div>

        <div class="menu-card">
            <h3>Дисциплины</h3>
            <p>Просмотр дисциплин</p>
            <?php if ($user->role === 'dean' || $user->role === 'admin'): ?>
                <a href="<?= app()->route->getUrl('/subjects/add') ?>" class="btn">Добавить дисциплину</a>
                <a href="<?= app()->route->getUrl('/disciplines/semestr') ?>" class="btn">Указание семестра</a>
            <?php endif; ?>
        </div>

        <div class="menu-card">
            <h3>Успеваемость</h3>
            <p>Учет успеваемости студентов</p>
            <a href="<?= app()->route->getUrl('/grades') ?>" class="btn">Просмотр успеваемости</a>
            <a href="<?= app()->route->getUrl('/grades/student') ?>" class="btn">Выбор успеваемости студента</a>
            <?php if ($user->role === 'dean' || $user->role === 'admin'): ?>
                <a href="<?= app()->route->getUrl('/grades/group') ?>" class="btn">Указание успеваемости группы</a>
            <?php endif; ?>
            <?php if ($user->role === 'dean' || $user->role === 'admin'): ?>
                <a href="<?= app()->route->getUrl('/grades/set-control') ?>" class="btn">Указание вида контроля</a>
            <?php endif; ?>
        </div>

        <?php if ($user->role === 'admin'): ?>
            <div class="menu-card">
                <h3>Администратор</h3>
                <p>Управление сотрудниками</p>
                <a href="<?= app()->route->getUrl('/signup') ?>" class="btn">Добавить сотрудника</a>
            </div>
        <?php endif; ?>
    </div>
</div>
</body>
</html>