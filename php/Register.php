<?php
header('content-type:text/html;charset=utf-8');
function select(){
	$PDO_conne = "mysql:host=localhost;dbname=ysl;charset=UTF8";
	$username = "root";
	$userpassword = "root";
	
	$CreateSQL = new PDO($PDO_conne,$username,$userpassword);
	$AllUser = $CreateSQL->query("select *from ysl_user");

	foreach($AllUser as $everyUserName){
		var_dump($everyUserName);
		if($everyUserName["phone"]==$_REQUEST["phone"]){
			echo "false";
			return;
		}
	}
	insert($CreateSQL);
	$CreateSQL = null ;
}
function insert($CreateSQL){
    $phone = $_REQUEST['phone'];
	$name = $_REQUEST["name"];
	$password = $_REQUEST["password"];
	$sex = $_REQUEST["sex"];
	//$ChineseName = $_REQUEST["ChineseName"];
	
	//$CreateSQL->exec("insert into ysl_user(name,password,sex) values("+$name+","+$password+","+$sex+")");
	$stmt = $CreateSQL->prepare("insert into ysl_user(phone,name,password,sex) values(:phone,:name,:password,:sex)");
	$stmt->execute(array(":phone"=>$phone,":name"=>$name,":password"=>$password,":sex"=>$sex));
	//Successful($ChineseName);
	echo "true";
}

function Successful($ChineseName){
	if($sex=="男"){
		echo "感谢".$ChineseName."先生的注册！";
	}else if($sex=="女"){
		echo "感谢".$ChineseName."女士的注册！";
	}else{
		echo "感谢".$ChineseName."的注册！";
	}
}
select();
?>