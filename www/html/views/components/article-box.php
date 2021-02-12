<?php foreach ($vm->getRecentArtclInfos() as $artcls): ?>

<div class="article-box">
    <a class="article-thumbnail-container linkbox" href="/xxx">
        <img src=<?php echo ($imgUrl."test2.jpg"); ?> alt="テスト画像" class="article-thumbnail">
    </a>
    <a class="article-main linkbox" href="/xxx">
        <p class="article-update-date"><?php echo $artcls['updateDate']; ?></p>
        <p class="article-title"><?php echo $artcls['title']; ?></p>
    </a>
</div>

<?php endforeach;?>