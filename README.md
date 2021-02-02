啟動laragon

確認.env檔案中的連接資料庫的設定(我沒有上傳,請依照自己的環境)

確認有叫做 test的table, 或自行更改 .php 裡面的 table 名稱

route: routes/web.php
controller: app/Http/Controllers/test_controller.php
model生成: database/migrations/2021_01_25_082409_create_test_table.php\
view: resources/views/show_test.blade.php

有使用post的view
在html中<meta>部分,還有$.ajax部分
需要確定有csrf_token

我的post 是使用 ajax傳送 取代 html form action
request.response 格式統一為 json

輸入test.test/meow 進行測試
