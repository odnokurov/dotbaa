<h2>Успеваемость</h2>

<div class="list-group">
    <a href="<?= app()->route->getUrl('/grades/student') ?>" class="list-group-item list-group-item-action">
        Успеваемость студента
    </a>
    <a href="<?= app()->route->getUrl('/grades/group') ?>" class="list-group-item list-group-item-action">
        Успеваемость группы
    </a>
    <a href="<?= app()->route->getUrl('/grades/set-control') ?>" class="list-group-item list-group-item-action">
        Указание вида контроля
    </a>
</div>