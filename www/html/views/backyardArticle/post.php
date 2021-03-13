<?php

use myapp\config\AppConfig;

if ($result == AppConfig::POST_SUCCESS) {
    $message = '処理に成功しました。';

}
elseif ($result == AppConfig::POST_FAILURE) {
    $message = '処理に失敗しました';
}

?>

<!DOCTYPE html>
<html>
    <head>

    </head>
    <body>
        <p><?php echo $message; ?></p>
        <p><a href="/backyard/article">トップページへ戻る</a></p>
    </body>
</html>