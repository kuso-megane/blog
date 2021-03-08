

<?php 
    use myapp\config\ViewsConfig;
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1.0">
        <title><?php echo ViewsConfig::TITLE; ?></title>
        <link rel="stylesheet" type="text/css" href=<?php echo ViewsConfig::STYLE_SHEET_URL. "search/search.css"; ?>>
    </head>
    <body>

    <?php require ViewsConfig::COMPONENTS_PATH. 'header.php';?>

        <div id="main">
            <div id="main--left">
                
                <?php require ViewsConfig::COMPONENTS_PATH. 'breadcrumb.php'; ?>

                <div id="main--title">
                    <?php if ($searched_word == NULL): ?>
                        <p id="main-title">&lt;このカテゴリの最近の投稿&gt;</p>
                    <?php else: ?>
                        <p id="main-title">&lt;"<?php echo $searched_word; ?>"に該当する投稿&gt;</p>
                    <?php endif; ?>
                </div>
                
                <?php require ViewsConfig::COMPONENTS_PATH. 'page-switch.php'; ?>

                <?php require ViewsConfig::COMPONENTS_PATH. 'main--article-box.php'; ?>

                <?php require ViewsConfig::COMPONENTS_PATH. 'page-switch.php'; ?>

            </div>  

            <?php require ViewsConfig::COMPONENTS_PATH. 'main--sidebar.php';?>
            
        </div>
        <div id="footer">
        
        </div>
　  </body>
</html>

