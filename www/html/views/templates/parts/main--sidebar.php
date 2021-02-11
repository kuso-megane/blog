<?php
/*
use myapp\viewModel\templateParts\MainSidebarVM;

$vm = (new MainSidebarVM())->getDataFromModel();

$artclNumOnCategory = $vm->getArtclNumOnCategory();
$artclNumOnSubCategory = $vm->getArtclNumOnSubCategory();
*/
?>

<div id="search-container">
    <div id="search-box"></div>
    <p><a href="">詳細検索はコチラ</a></p>
</div>
<div id="self-intro-box">
    <p>自己紹介</p>
    <a href=""><p>→紹介記事</p></a>
</div>
<div id="category-list-container">
    <p>カテゴリ一覧</p>
    <ul>
        <?php foreach($vm->getCategoryArtclCount() as $category => $count): ?>

        <li><a href=""><?php echo "{$category}({$count})"; ?></a></li>
        
        <?php endforeach; ?>
    </ul>
</div>

<!--
    <li><a href="">考え事()</a></li>
    <li><a href="">プログラミング()</a></li>
    <li><a href="">読書()</a></li>
    <li><a href="">ゲーム()</a></li>
    <li><a href="">カリンバ()</a></li>
    <li><a href="">その他()</a></li>
-->
