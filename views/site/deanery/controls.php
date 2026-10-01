<h2>Виды контроля</h2>

<p>
    <a href="<?= app()->route->getUrl('/controls/add') ?>" class="btn btn-primary">Добавить вид контроля</a>
</p>

<?php if ($controls->count()): ?>
    <ul class="list-group">
        <?php foreach ($controls as $control): ?>
            <li class="list-group-item">
                <?= htmlspecialchars($control->controll_name) ?>
            </li>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p class="text-muted">Видов контроля пока нет</p>
<?php endif; ?>