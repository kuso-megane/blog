<?php 
    $imgPath = "/asset/img/";
    $styleSheetPath = "/asset/stylesheet/";
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>ブログサービス(仮)</title>
    <link rel="stylesheet" type="text/css" href=<?php echo $styleSheetPath. "category/category.css"; ?>>
  </head>
  <body>
    <?php require '/parts/header.php';?>

    <div id="main">
      <div id="main--left">
        <div id="breadcrumb">
        <!--暫定-->
          top &gt; xxx &gt; yyy
        </div>
        <div id="main--title">
          <p></p>
        </div>
        <div id="page-switch">
          <p id="page-switch--previous"><a href="">前の10件</a> </p>
          <p id="page-switch--next"><a href="">次の10件</a></p>
        </div>

        <div class="article-box">
          <div class="article-thumbnail-container">
            <img src=<?php echo ($imgPath."test2.jpg"); ?> alt="テスト画像" class="article-thumbnail">
          </div>
          <div class="article-main">
            <p class="article-update-date">2020-8-13</p>
            <p class="article-title"><a href="xxx">テスト2</a></p>
          </div>
        </div>

        <div class="article-box">
          <div class="article-thumbnail-container">
            <img src=<?php echo ($imgPath."test2.jpg"); ?> alt="テスト画像" class="article-thumbnail">
          </div>
          <div class="article-main">
            <p class="article-update-date">2020-8-13</p>
            <p class="article-title"><a href="xxx">テスト1</a></p>
          </div>
        </div>
          
      </div>
      <!--mainの右側に置く諸々-->
      <?php require 'parts/main-right.php';?>
    </div>
    <div id="footer">
      
    </div>
　</body>
</html>

