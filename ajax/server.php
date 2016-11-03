<?php
//header("content-type:text/plain; charset=utf8");
header("content-type:application/json;charset=utf8");

$staff = array(
				array("name"=>"小明","num"=>"101","sex"=>"man","status"=>"程序员"),
				array("name"=>"小亮","num"=>"102","sex"=>"man","status"=>"产品经理"),
				array("name"=>"小董","num"=>"103","sex"=>"women","status"=>"老板")
				);

//根据请求方法执行不同函数  $_SERVER 超全局变量 整个作用域中都可以使用
if($_SERVER["REQUEST_METHOD"] == 'GET'){
	//echo "here";
	search();
}else if($_SERVER["REQUEST_METHOD"] == 'POST'){
	create();
}

//根据num(编号) 来搜索员工
function search(){
	//echo "here";
	//检查是否有num
	if(!(isset($_GET['num'])) || empty($_GET['num'])){
		echo '{"success":false,"msg":"参数错误"}';
		return;
	}

	global $staff;
	//获取num值
	$num = $_GET['num'];
	$result = '{"success":false,"msg":"没找到员工"}';
	//循环$staff
	foreach ($staff as $value) {
			if($value['num'] == $num){
				$result = '{"success":true, "msg":"找到员工,员工编号:'.$value["num"].',姓名：'.$value["name"].',性别：'.$value["sex"].',职务：'.$value["status"].'"}';
				break;
			}
		}	
		echo $result;
}

//创建员工
function create(){
	if((!isset($_POST['name'])) || empty($_POST['name']) || (!isset($_POST['num'])) || empty($_POST['num']) || (!isset($_POST['sex'])) || empty($_POST['sex']) || (!isset($_POST['status'])) || empty($_POST['status'])){
		echo '{"success":false,"msg":"参数填写错误，员工信息填写不全"}';
		return;
	}

	echo '{"success":true,"msg":"员工：'.$_POST["name"].'信息保存成功。"}';
}

?>
