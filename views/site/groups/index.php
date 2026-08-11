<div class="page-card">
    <h2>Группы</h2>

    <?php if ($groups->isNotEmpty()): ?>
        <div class="table-responsive">
            <table class="table table-striped table-hover data-table">
                <thead>
                <tr>
                    <th>Название</th>
                    <th>Кол-во студентов</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($groups as $group): ?>
                    <tr>
                        <td><?= htmlspecialchars($group->group_name) ?></td>
                        <td><?= $group->students_count ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <div class="alert alert-warning">Групп пока нет</div>
    <?php endif; ?>
</div>