<?php
    use myapp\config\ViewsConfig;
?>

<div id="article-container">
    <?php if($recentArtclInfos != NULL): ?>

        <?php foreach($recentArtclInfos as $artcls): ?>

        <div class="article-box">
            <a href=<?php echo '/article/' . $artcls['id']; ?> class="linkbox">
                <div class="article-thumbnail-container">
                    <img src=<?php echo (ViewsConfig::IMG_URL."test2.jpg"); ?> alt="テスト画像" class="article-thumbnail">
                </div>
                <div class="article-main">
                    <p class="article-update-date"><?php echo '最終更新日:' . $artcls['updateDate']; ?></p>
                    <p class="article-title break-word"><?php echo $artcls['title']; ?></p>
                </div>
            </a>      
        </div>

        <?php endforeach;?>

    <?php else: ?>
        <p id="no-article-message">該当記事は見つかりませんでした。検索条件を変えてください。</p>
    <?php endif; ?>
</div>
    