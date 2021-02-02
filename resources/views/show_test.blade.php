<html>
	<head>
		<meta charset="utf-8">
		<meta name="csrf-token" content="{{ csrf_token() }}" />
		<style>
			body{
				background-color: #CAFFFF;
			}
			table, td {
				border: 1px solid black;
			}
			td{
				width:15%;
			}
			th{
				font-size:20px;
			}
			th {
				background-color: #4DFFFF;
			}
		</style>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		<script type="text/javascript">
			$(function(){
				$('tr').css('text-align','center');
			});
		
			function new_row(){
				
				$('#ar').remove();
				
				var td_1 = $('<td style="height:50px">').append('<div>autoID</div>');
				var td_2 = $('<td>').append(jQuery('<input type="text" id="text_name" placeholder="請輸入姓名">'));
				var td_3 = $('<td>').append(jQuery('<input type="text" id="text_email" placeholder="請輸入email">'));
				var td_4 = $('<td>').append(jQuery('<input type="text" id="text_now" disabled="disabled">'));
				var td_5 = $('<td colspan="2" align="center">').append(
													'<input type="button" value="確認" onclick="confirm()">',
													'&emsp;',
													'<input type="button" value="取消" onclick="cancel()">');
				var tr = $('<tr id="new_data">').append(td_1, td_2, td_3, td_4, td_5);
				$('#t').append(tr);
				
				$('tr').css('text-align','center');
				
				var timer_1 = setInterval(function(){
					var d = new Date();
					$('#text_now').val(`${d.getFullYear()}/${d.getMonth()+1}/${d.getDate()} ${d.getHours()}:${d.getMinutes()}:${d.getSeconds()}`);
				},1000);
				
			}
			
			function confirm(){
				
				var x = {
					_token: $('meta[name="csrf-token"]').attr('content'),
					name: $('#text_name').val(),
					email: $('#text_email').val(),
					ct: $('#text_now').val()
				};
				
				$.ajax({
					url: '/insert',
					type: 'post',
					data: x,
					dataType: 'JSON',
					success: function(response){
						alert(response.msg);
						location.reload();
					}
				});
				
			}
			
			function cancel(){
				
				$('#new_data').remove();
				
				var td = $('<td colspan="6" align="center">').append('<input type="button" onclick="new_row()" value="新增">');
				var tr = $('<tr id="ar">').append(td);
				$('#t').append(tr);
			}
			
			function mod(index){
				
				
				var temp = document.getElementById('t');
				
				var arr=[];
				for(var i=0; i < temp.rows[index].cells.length; i++){
					arr.push(temp.rows[index].cells[i].innerHTML);
				}
				
				$('#row_id_' + index + ' td:not(:eq(0))').remove();
				
				var x = $('#row_id_' + index);
				
				var mod_name = $('<td style="height:50px">').append(jQuery(`<input type="text" id="mod_name_${arr[0]}" value="${arr[1]}">`));
				var mod_email = $('<td>').append(jQuery(`<input type="text" id="mod_email_${arr[0]}" value="${arr[2]}">`));
				var mod_ct = $('<td>').append(jQuery(`<input type="text" value="${arr[3]}" id="mod_ct_${arr[0]}" disabled="disabled")>`));
				var mod_ut = $('<td>').append(jQuery(`<input type="text" id="mod_now_${arr[0]}" disabled="disabled">`));
				var mod_func = $('<td>').append(`<input type="button" value="完成" onclick="mod_done(${arr[0]})">&emsp;`,
										`<input type="button" value="取消" onclick="mod_cancel(${arr[0]})">`);
				
				x.append(mod_name, mod_email, mod_ct, mod_ut, mod_func);
				
				var timer_2 = setInterval(function(){
					var d = new Date();
					$('[id^="mod_now_"').val(`${d.getFullYear()}/${d.getMonth()+1}/${d.getDate()} ${d.getHours()}:${d.getMinutes()}:${d.getSeconds()}`);
				},1000);
				
			}
			
			function mod_done(idd){
				
				var x = {
					_token: $('meta[name="csrf-token"]').attr('content'),
					id: idd,
					name: $(`#mod_name_${idd}`).val(),
					email: $(`#mod_email_${idd}`).val(),
					ct: $(`#mod_ct_${idd}`).val(),
					ut: $(`#mod_now_${idd}`).val(),
				};
				
				$.ajax({
					url: '/update',
					type: 'post',
					data: x,
					dataType: 'JSON',
					success: function(response){
						alert(response.msg);
					}
					//這裡沒有處理資料庫修改時發生錯誤的處理,要新增的話,在ajax裡面新增 error:function(response){...}
				});
				
				
				$('#row_id_' + idd + ' td:not(:eq(0))').remove();
				
				$('#row_id_' + idd).append($(`<td>${x['name']}</td>`));
				$('#row_id_' + idd).append($(`<td>${x['email']}</td>`));
				$('#row_id_' + idd).append($(`<td>${x['ct']}</td>`));
				$('#row_id_' + idd).append($(`<td>${x['ut']}</td>`));
				$('#row_id_' + idd).append($(`<td>
												<input type="button" value="修改" onclick="mod(${idd})">&emsp;
												<input type="button" value="刪除" onclick="del(${idd})">
											</td>`));
				
				
			}
			
			function mod_cancel(idd){
				
				//個人不想以變數方式(cookie之類的)儲存資料,所以乾脆整個取消
				location.reload();
				
			}
			
			function del(idd){
				
				var x = {
					_token: $('meta[name="csrf-token"]').attr('content'),
					id: idd,
				};
				
				$.ajax({
					url: '/delete',
					type: 'post',
					data: x,
					dataType: 'JSON',
					success: function(response){
						alert(response.msg);
						location.reload();
					}
				});
			}
			
			
		</script>
	</head>
    <body>
		<?php
			if(is_null($dd)){
				echo 'empty';
			}
			else
			{
				echo '<table id="t">';
				echo '<tr> <th>ID</th> <th>名稱</th> <th>電子信箱</th> <th>建立時間</th> <th>修改時間</th> <th>動作</th> </tr>';
				$idd = 0;
				foreach($dd as $d)
				{
					$cnt = 0;
					$idd = 0;
					
					foreach($d as $i)
					{
						if(is_null($i))
						{
							echo '<td>';
							echo 'NULL';
						}
						else
						{
							if($cnt==0)
							{
								$idd = $i;
								echo sprintf('<tr id="row_id_%s">',$idd);
							}
							echo '<td>';
							echo $i;
						}
						echo '</td>';
						$cnt++;
					}
					echo '<td>';
					echo sprintf('<input type="button" value="修改" onclick="mod(%s)">&emsp;',$idd);
					echo sprintf('<input type="button" value="刪除" onclick="del(%s)">',$idd);
					echo '</td>';
					echo '</tr>';
				}
				echo '<tr id="ar"><td colspan="6" align="center">';
				echo '<input type="button" onclick="new_row()" value="新增">';
				echo '</td></tr>';
				echo '</table>';
			}
		?>
    </body>
</html>
