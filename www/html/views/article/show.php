<?php
    use myapp\config\ViewsConfig;
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1.0">
        <title><?php echo ViewsConfig::TITLE; ?></title>
        <link rel="stylesheet" type="text/css" href=<?php echo ViewsConfig::STYLE_SHEET_URL. "article/show.css"; ?>>
    </head>
    <body>
        
        <?php require ViewsConfig::COMPONENTS_PATH. 'header.php';?>

        <div id="main">
            
            <div id="main--left">

                <?php require ViewsConfig::COMPONENTS_PATH. 'breadcrumb.php'; ?>

                <div id="article">
                    <h1 id="article--title"><?php echo $articleContent['title']; ?></h3>  
                    <p id="article--updateDate"><?php echo '最終更新日:'. $articleContent['updateDate']; ?></p>

                    <div id="article--content">  
                    </div>
                </div>
                
            </div>
  

            <?php require ViewsConfig::COMPONENTS_PATH. 'main--sidebar.php';?>
            
        </div>

        <script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/dompurify/2.0.7/purify.js"></script>
        <script>
            marked.setOptions({
                breaks : true
            });
            //記事コンテンツの改行を反映するためバッククォート
            const md = `<?php echo $content = str_replace('`', '\`', $articleContent['content']); ?>`;
            const dirty = marked(md);
            const clean = DOMPurify.sanitize(dirty);
            document.getElementById("article--content").innerHTML = clean;
        </script>

    </body>
</html>
