# 環境
- dockerコンテナを構築し、apache2 + php + mysqlで作成。鋭意進行中！
- 学習のため、webフレームワークを使わずに作成
- routing, DI, テストは外部ライブラリを採用

# localでの構築
- ```docker-compose up -d```
- ```/www```にて、```composer install```を実行。

# myFramework
## superGlobalVars
- ```$_GET```などのphpのスーパーグローバル変数を、readableなpropertyとして保持するクラス。
- getterのみをもち、書き込みを禁止

## DB
- PDOを拡張したクラス```MyDbh```を通して、DBにアクセスする。
- ```MyDbh```がselect, count, update, insertなどの基本的なDBアクセスをラッピングしたメソッドをもっている
- ```(new Connenction($is_test, $username))->connect()```が、```MyDbh```を返す 。

## Bases\BaseController
- controllerの基底クラス
- 継承可能なメソッド```render()```をもっていて、controllerで渡されたデータ```$vm['xxx']```を```$xxx```としてviewsで使えるように加工
- viewsをrequireする形でrendering

# 参考
- 安全なsqlの呼び出し方　https://www.ipa.go.jp/files/000017320.pdf
- ドメイン層の実装 https://terasolunaorg.github.io/guideline/public_review/ImplementationAtEachLayer/DomainLayer.html#id5


