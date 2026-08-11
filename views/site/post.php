<div class="page-card">
    <h1>Список статей</h1>
    <ul class="list-group">
        <?php foreach ($posts as $post): ?>
            <li class="list-group-item"><?= htmlspecialchars($post->title) ?></li>
        <?php endforeach; ?>
    </ul>
</div>