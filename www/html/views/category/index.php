<?php
    $imgUrl = "/asset/img/";
?>

<div id="main--left">
    <div id="breadcrumb">
        <p><a href="/index">top</a></p>
    </div>
    <div id="main--title">
        <p>最近の投稿</p>
    </div>
    <div id="page-switch">
        <p id="page-switch--previous"><a href="">前の10件</a> </p>
        <p id="page-switch--next"><a href="">次の10件</a></p>
    </div>

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

</div>
