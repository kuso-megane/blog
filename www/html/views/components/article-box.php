<?php foreach ($vm->getRecentArtclInfos() as $artcls): ?>

<div class="article-box">
    <div class="article-thumbnail-container">
        <img src=<?php echo ($imgUrl."test2.jpg"); ?> alt="テスト画像" class="article-thumbnail">
    </div>
    <div class="article-main">
        <p class="article-update-date"><?php echo $artcls['updateDate']; ?></p>
        <p class="article-title"><a href="xxx"><?php echo $artcls['title']; ?></a></p>
    </div>
</div>

<?php endforeach;?>