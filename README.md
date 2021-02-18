# blog

## 環境
- dockerコンテナを構築し、apache2 + php + mysqlで作成。鋭意進行中！
- 学習のため、webフレームワークを使わずに作成

## localでの構築
- ```docker-compose up -d```
- ```/www```にて、```./composer.sh```を実行。(初回はpermission deniedの可能性あり、その際は実行権限付与)
- 

# 参考
- 安全なsqlの呼び出し方　https://www.ipa.go.jp/files/000017320.pdf
- ドメイン層の実装 https://terasolunaorg.github.io/guideline/public_review/ImplementationAtEachLayer/DomainLayer.html#id5

