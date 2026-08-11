<h1 class="mb-4">Панель управления</h1>

<div class="row g-4">
    <div class="col-md-6 col-xl-3">
        <div class="card h-100 shadow-sm">
            <div class="card-body">
                <h5 class="card-title">Группы</h5>
                <p class="card-text text-muted">Управление учебными группами</p>
                <?php if ($user->role === 'dean' || $user->role === 'admin'): ?>
                    <a href="<?= app()->route->getUrl('/groups') ?>" class="btn btn-primary mb-2">Просмотр групп</a>
                    <a href="<?= app()->route->getUrl('/groups/add') ?>" class="btn btn-outline-primary mb-2">Добавить группу</a>
                    <a href="<?= app()->route->getUrl('/groups/add-discipline') ?>" class="btn btn-outline-primary">Прикрепить дисциплину</a>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-xl-3">
        <div class="card h-100 shadow-sm">
            <div class="card-body">
                <h5 class="card-title">Студенты</h5>
                <p class="card-text text-muted">Управление студентами</p>
                <?php if ($user->role === 'dean' || $user->role === 'admin'): ?>
                    <a href="<?= app()->route->getUrl('/students') ?>" class="btn btn-primary mb-2">Просмотр студентов</a>
                    <a href="<?= app()->route->getUrl('/students/add') ?>" class="btn btn-outline-primary mb-2">Добавить студента</a>
                <?php endif; ?>
                <?php if ($user->role === 'admin'): ?>
                    <a href="<?= app()->route->getUrl('/students/attach') ?>" class="btn btn-outline-primary">Прикрепить студента</a>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-xl-3">
        <div class="card h-100 shadow-sm">
            <div class="card-body">
                <h5 class="card-title">Дисциплины</h5>
                <p class="card-text text-muted">Просмотр дисциплин</p>
                <?php if ($user->role === 'dean' || $user->role === 'admin'): ?>
                    <a href="<?= app()->route->getUrl('/subjects/add') ?>" class="btn btn-primary mb-2">Добавить дисциплину</a>
                    <a href="<?= app()->route->getUrl('/disciplines/semestr') ?>" class="btn btn-outline-primary">Указание семестра</a>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-xl-3">
        <div class="card h-100 shadow-sm">
            <div class="card-body">
                <h5 class="card-title">Успеваемость</h5>
                <p class="card-text text-muted">Учет успеваемости студентов</p>
                <a href="<?= app()->route->getUrl('/grades') ?>" class="btn btn-primary mb-2">Просмотр успеваемости</a>
                <a href="<?= app()->route->getUrl('/grades/student') ?>" class="btn btn-outline-primary mb-2">Выбор студента</a>
                <?php if ($user->role === 'dean' || $user->role === 'admin'): ?>
                    <a href="<?= app()->route->getUrl('/grades/group') ?>" class="btn btn-outline-primary mb-2">Успеваемость группы</a>
                    <a href="<?= app()->route->getUrl('/grades/set-control') ?>" class="btn btn-outline-primary">Вид контроля</a>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <?php if ($user->role === 'admin'): ?>
        <div class="col-md-6 col-xl-3">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Администратор</h5>
                    <p class="card-text text-muted">Управление сотрудниками</p>
                    <a href="<?= app()->route->getUrl('/signup') ?>" class="btn btn-dark">Добавить сотрудника</a>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>