<?php
    use myapp\config\ViewsConfig;
?>

<DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1.0">
        <title><?php ViewsConfig::TITLE; ?></title>
        <link rel="stylesheet" type="text/css" href=<?php echo ViewsConfig::STYLE_SHEET_URL. "backyard/article.css"; ?>>
    </head>
    <body>
        <h2>記事BY</h2>
        <p><a href="/backyard/article/edit">新規作成</a></p>
        <p>&lt;ワード検索&gt;</p>
        <form action="/backyard/article" method="get">
            <input id="search-box" type="search" name="w" placeholder="記事フリーワード検索"
                value=<?php echo $searchBoxValue; ?>>
        </form>
        <table>
            <thead>
                <tr>
                    <th>編集</th>
                    <th>title</th>
                    <th>ページurl</th>
                </tr>
            </thead>
            <tbody>

                <?php foreach($articleLinks as $articleLink): ?>

                <tr>
                    <td><a href=<?php echo "/backyard/article/edit/". $articleLink['id']; ?>>編集ページ</a></td>
                    <td><?php echo $articleLink['title']; ?></td>
                    <td><a href=<?php echo '/article/'. $articleLink['id']; ?>>リンク</a></td>
                </tr>

                <?php endforeach; ?>
                
            </tbody>
        </table>
        
    </body>
</html>
