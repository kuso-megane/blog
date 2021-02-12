
<div id="main--sidebar">
    <div id="search-container">
        <div id="search-box"><input type="search" placeholder="フリーワード検索"></div>
        <p>→詳細検索は<a href="">コチラ</a></p>
    </div>
    <div id="self-intro-box">
        <p>自己紹介</p>
        <p>→紹介記事は<a href="">コチラ</a></p>
        <p>twitter垢→ <a href="https://twitter.com/kusomeg61908444">@kusomeg61908444</a></p>
    </div>
    <div id="category-list-container">
        <p>カテゴリ一覧</p>
        <ul>
            <?php foreach($vm->getCategoryArtclCount() as $category => $count): ?>

            <li><a href=""><?php echo "{$category}({$count})"; ?></a></li>
            
            <?php endforeach; ?>
        </ul>
    </div>
</div>
