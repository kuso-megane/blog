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
        <form action="/backyard/article/post" action="post">
            <p id="input-title">
                title: <input type="text" name="title">
                *titleは自動的に反映される
            </p>
            <p id="input-rawContent">
                content:<br>
                <textarea name="rawContent" id="" cols="40" rows="20"></textarea>
            </p>
        </form>
        
        
    </body>
</html>
