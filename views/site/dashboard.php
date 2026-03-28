<div class="dashboard-menu">
    <div class="menu-grid">
        <div class="menu-card">
            <h3>Группы</h3>
            <p>Управление учебными группами</p>
            <a href="/groups" class="btn">Управление группами</a>
            <?php if ($user->role === 'dean' || $user->role === 'admin'): ?>
                <a href="/groups/add-discipline" class="btn">Прикрепить дисциплину</a>
            <?php endif; ?>
        </div>

        <div class="menu-card">
            <h3>Студенты</h3>
            <p>Управление студентами</p>
            <a href="/students" class="btn">Управление студентами</a>
            <?php if ($user->role === 'admin'): ?>
                <a href="/students/attach" class="btn">Прикрепить студента</a>
            <?php endif; ?>
        </div>

        <div class="menu-card">
            <h3>Дисциплины</h3>
            <p>Просмотр дисциплин</p>
            <a href="/disciplines" class="btn">Просмотр дисциплин</a>
            <?php if ($user->role === 'dean' || $user->role === 'admin'): ?>
                <a href="/disciplines/set-semester" class="btn">Указание семестра</a>
            <?php endif; ?>
        </div>

        <div class="menu-card">
            <h3>Успеваемость</h3>
            <p>Учет успеваемости студентов</p>
            <a href="/grades" class="btn">Просмотр успеваемости</a>
            <?php if ($user->role === 'teacher' || $user->role === 'dean' || $user->role === 'admin'): ?>
                <a href="/grades/group" class="btn">Указание успеваемости группы</a>
            <?php endif; ?>
            <a href="/grades/student" class="btn">Выбор успеваемости студента</a>
            <?php if ($user->role === 'dean' || $user->role === 'admin'): ?>
                <a href="/grades/set-control" class="btn">Указание вида контроля</a>
            <?php endif; ?>
        </div>
    </div>
</div>
