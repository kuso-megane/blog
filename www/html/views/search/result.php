

<?php 
    $styleSheetUrl = "/asset/stylesheet/";
    $componentsPath = "/var/www/html/views/components/";
    $imgUrl = "/asset/img/";

    $searched_word = $vm['searched_word'];
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>ブログサービス(仮)</title>
        <link rel="stylesheet" type="text/css" href=<?php echo $styleSheetUrl. "search/search.css"; ?>>
    </head>
    <body>

    <?php require $componentsPath. 'header.php';?>

        <div id="main">
            <div id="main--left">
                
                <?php require $componentsPath. 'breadcrumb.php'; ?>

                <div id="main--title">
                    <?php if ($searched_word == NULL): ?>
                        <p id="main-title">&lt;このカテゴリの最近の投稿&gt;</p>
                    <?php else: ?>
                        <p id="main-title">&lt;"<?php echo $searched_word; ?>"に該当する投稿&gt;</p>
                    <?php endif; ?>
                </div>
                
                <?php require $componentsPath. 'page-switch.php'; ?>

                <?php require $componentsPath. 'main--article-box.php'; ?>

                <?php require $componentsPath. 'page-switch.php'; ?>

            </div>  

            <?php require $componentsPath. 'main--sidebar.php';?>
            
        </div>
        <div id="footer">
        
        </div>
　  </body>
</html>

