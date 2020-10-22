<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>ブログサービス(仮)</title>
    <link rel="stylesheet" type="text/css" href="/asset/stylesheet/index.css">
  </head>
  <body>
    <div id="header">
      <h1 id="title">
        <a href=index.php>ブログサービス(仮)</a>
      </h1>
      <!--目次-->
      <div id="index-container">
        <ul id="index-ul">
          <!--DBからカテゴリを表示、サブメニューも検討-->
          <li><a href="">考え事</a></li>
          <li><a href="">プログラミング</a></li>
          <li><a href="">読書</a></li>
          <li><a href="">ゲーム</a></li>
          <li><a href="">カリンバ</a></li>
          <li><a href="">その他</a></li>
        </ul>
      </div>
    </div>

    <div id="main">
      <div id="main--left">
        <div id="breadcrumb">
        <!--暫定-->
          top &gt; xxx &gt; yyy
        </div>
        <div id="main--title">
          <p>&lt;最近の投稿&gt;</p>
        </div>
        <div id="page-switch">
          <p id="page-switch--previous"><a href="">前の10件</a> </p>
          <p id="page-switch--next"><a href="">次の10件</a></p>
        </div>

        <div class="article-box">
          <div class="article-thumbnail-container">
            <img src="/asset/img/test_img.jpg" alt="テスト画像" class="article-thumbnail">
          </div>
          <div class="article-main">
            <p class="article-update-date">2020-8-13</p>
            <p class="article-title"><a href="xxx">テスト2</a></p>
          </div>
        </div>

        <div class="article-box">
          <div class="article-thumbnail-container">
            <img src="/asset/img/test_img.jpg" alt="テスト画像" class="article-thumbnail">
          </div>
          <div class="article-main">
            <p class="article-update-date">2020-8-13</p>
            <p class="article-title"><a href="xxx">テスト1</a></p>
          </div>
        </div>
          
      </div>
      <!--mainの右側に置く諸々-->
      <div id="main--right">
        <!--トップページはいらない-->
        <div id="category-list-container">
          <p>タグ検索</p>
          <ul>
            <li><a href="">#html</a></li>
            <li><a href="">#PHP</a></li>
          </ul>
        </div>
        <div id="my-twitter">
          <p>twitter紹介</p>
        </div>
      </div>
    </div>
    <div id="footer">
      
    </div>
　</body>
</html>

