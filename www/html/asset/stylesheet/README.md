# stylesheet/の構成

## htmlから呼び出すcssとその作成方法
- 各dirの```css/xxx/xxx.css```のみを呼び出す
- 例: ```css/category/category.css```
- ```src/xxx/xxx.scss```をコンパイルし、```css/xxx/xxx.css```を作成


## scssについて

## componentsについて
- 複数のscssファイルで共通する部分は、```src/components/_yyy.scss```として切り出す。こうすることで、使い回しができるうえ、修正の手間が減る。
- scssの機能を使って、```src/xxx/xxx.scss```が、必要な```src/components/_xxx.scss```を含有する
- そのため、```src/components/```配下のscssファイルをコンパイルする必要はない


