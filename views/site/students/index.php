<div class="page-card">
    <h2>Студенты</h2>

    <?php if ($students->isNotEmpty()): ?>
        <div class="table-responsive">
            <table class="table table-striped table-hover data-table">
                <thead>
                <tr>
                    <th>ФИО</th>
                    <th>Группа</th>
                    <th>Пол</th>
                    <th>Дата рождения</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($students as $student): ?>
                    <tr>
                        <td><?= htmlspecialchars($student->surname . ' ' . $student->name . ' ' . ($student->patronymic ?? '')) ?></td>
                        <td><?= htmlspecialchars($student->group->group_name ?? '') ?></td>
                        <td><?= htmlspecialchars($student->gender) ?></td>
                        <td><?= $student->birthday ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <div class="alert alert-warning">Студентов пока нет</div>
    <?php endif; ?>
</div>