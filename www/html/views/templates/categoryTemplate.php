<?php 
    $imgPath = "/asset/img/";
    $styleSheetPath = "/asset/stylesheet/";
    $componentsPath = "/var/www/html/views/components/";
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>ブログサービス(仮)</title>
    <link rel="stylesheet" type="text/css" href=<?php echo $styleSheetPath. "category/category.css"; ?>>
  </head>
  <body>

    <?php require $componentsPath. 'header.php';?>

    <div id="main">
        <div id="main--left">  

            <?php require $mainView;?>  

        </div>

        <div id="main--sidebar">

            <?php require $componentsPath. 'main--sidebar.php';?>
        
        </div>
    </div>
    <div id="footer">
      
    </div>
　</body>
</html>

