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

初始化面
![image](https://user-images.githubusercontent.com/50996341/110016861-7f3d7a80-7d60-11eb-8839-be28d4106746.png)

按下新增按鈕後
![image](https://user-images.githubusercontent.com/50996341/110017010-af851900-7d60-11eb-987e-ddc710541030.png)

按下確認後
![image](https://user-images.githubusercontent.com/50996341/110017205-e9561f80-7d60-11eb-9cc5-bb0c6eb0842a.png)

![image](https://user-images.githubusercontent.com/50996341/110017312-0985de80-7d61-11eb-92f6-05095e962f43.png)

按下修改按鈕
(待補)

按下刪除按鈕
(待補)
