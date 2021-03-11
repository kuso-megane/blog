<?php 
    use myapp\config\ViewsConfig;

    if ($isNew == TRUE) {
        $titleValue = '';
        $contentValue = '';
    }
    elseif ($isNew == FALSE) {
        $titleValue = $oldTitle;
        $contentValue = $oldContent;
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1.0">
        <title><?php ViewsConfig::TITLE; ?></title>
        <link rel="stylesheet" type="text/css" href=<?php echo ViewsConfig::STYLE_SHEET_URL. "backyard/article.css"; ?>>
    </head>
    <body>
        <h2>記事BY</h2>
        <p><a href="/backyard/article">記事BYトップページへ</a></p>
        <form action="/backyard/article/post" action="post">
            <p id="input-title">
                title: <input type="text" name="title" placeholder="新しいタイトルを記入" value=<?php echo $titleValue; ?>>
            </p>
            <p id="input-content">
                content:<br>
                <textarea id="editor" name="content" cols="20" rows="8" placeholder="新しい内容を記入">
                    <?php echo $contentValue; ?>
                </textarea>

                <!--import simpleMDE-->
                <link rel="stylesheet" href="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.css">
                <script src="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.js"></script>
                <script>
                    var simplemde = new SimpleMDE({
                        element: document.getElementById("editor"),
                        forceSync: true,
                        spellChecker: false
                        });
                </script>

            </p>
            <input type="submit" value="投稿">
        </form>
    </body>
</html>
