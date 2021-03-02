

<?php 
    $styleSheetUrl = "/asset/stylesheet/";
    $componentsPath = "/var/www/html/views/components/";
    $imgUrl = "/asset/img/";

    $given_category = $vm['given_category'];
    $given_c_id = $given_category['id'];
    $given_c_name = $given_category['name'];

    $given_subCategory = $vm['given_subCategory'];
    $given_subc_id = $given_subCategory['id'];
    $given_subc_name = $given_subCategory['name'];

    $given_word = $vm['given_word'];
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
                <div id="breadcrumb">
                    <p>
                        <a href="/index" class="breadcrumb-items">top</a>

                        <?php if ($given_category != NULL):?>
                        &gt; 
                        <a href=<?php echo"/search/{$given_c_id}"; ?> class="breadcrumb-items">
                            <?php echo $given_c_name; ?>
                        </a>
                        <?php endif; ?>

                        <?php if ($given_subCategory != NULL):?>
                        &gt; 
                        <a href=<?php echo "/search/{$given_c_id}/{$given_subc_id}"; ?> class="breadcrumb-items">
                            <?php echo $given_subc_name; ?>
                        </a>
                        <?php endif; ?>

                    </p>
                </div>

                <div id="main--title">
                    <?php if ($given_word == NULL): ?>
                        <p id="main-title">&lt;このカテゴリの最近の投稿&gt;</p>
                    <?php else: ?>
                        <p id="main-title">&lt;"<?php echo $given_word; ?>"に該当する投稿&gt;</p>
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

