#!/bin/sh

# appコンテナ内の www/ で実行

reporter=dot
./vendor/bin/kahlan --reporter=$reporter --spec=./Models/infra/database/spec