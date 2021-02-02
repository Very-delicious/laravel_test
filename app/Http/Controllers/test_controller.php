<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use DB;

class test_controller extends Controller
{
	
    public function meow()
    {
		$dd = DB::select('select * from `test`');
		return view('show_test',['dd'=>$dd]);
    }

    public function insert(Request $req){
		
		
		$id = DB::table('test')->insertGetId(
			[
				'name' => $req->name,
				'email' => $req->email,
				'created_at' => $req->ct,
			]
		);
		
		$response = array(
			'status' => 'insert success',
			'msg' => '新增內容如下:'.sprintf("\n id:%d \n 姓名:%s \n email:%s \n 新增時間:%s", 
							$id, $req->name, $req->email, $req->ct),
		);
		
		
		return response()->json($response); 
   }
   
   public function update(Request $req){
	   
	   DB::table('test')
			->where('id', $req->id)
			->update(
				[
					'name' => $req->name,
					'email' => $req->email,
					'updated_at' => $req->ut,
				]
			);
		
		$response = array(
			'status' => 'update success',
			'msg' => '更改內容如下:' . sprintf("\n id:%s \n 姓名:%s \n email:%s \n 修改時間:%s", 
							$req->id, $req->name, $req->email, $req->ut),
		);
		return response()->json($response);
   }

   public function del(Request $req){
	   
	   DB::table('test')
        ->where('id', $req->id)
        ->delete();
	   
	   
	   $response = array(
			'status' => 'delete success',
			'msg' => sprintf("已成功刪除 id = %d 的資料",$req->id),
		);
		return response()->json($response);
   }
   
}
?>
