

<?php 
    $styleSheetUrl = "/asset/stylesheet/";
    $componentsPath = "/var/www/html/views/components/";
    $imgUrl = "/asset/img/";

    $searched_category = $vm['searched_category'];
    $searched_c_id = $searched_category['id'];
    $search_c_name = $searched_category['name'];

    $searched_subCategory = $vm['searched_subCategory'];
    $searched_subc_id = $searched_subCategory['id'];
    $searched_subc_name = $searched_subCategory['name'];

    var_dump($searched_subCategory);
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

                        &gt; 
                        <a href=<?php echo"/search/{$searched_c_id}"; ?> class="breadcrumb-items">
                            <?php echo $search_c_name; ?>
                        </a>

                        <?php if ($searched_subCategory != NULL):?>
                        &gt; 
                        <a href=<?php echo "/search/{$searched_c_id}/{$searched_subc_id}"; ?> class="breadcrumb-items">
                            <?php echo $searched_subc_name; ?>
                        </a>
                        <?php endif; ?>

                    </p>
                </div>

                <div id="main--title">
                    <p id="main-title">&lt;このカテゴリの最近の投稿&gt;</p>
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

