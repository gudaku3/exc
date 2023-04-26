<?php
//セッション
class session {

	//DB-start
	function dbstart() {
		//$link = mysqli_connect("localhost", "root", "G_Lm}[3!4+Y@{%*y@58J!>&F+e?*4~L*","mctoillio");	//ローカル用
		$link = mysqli_connect("localhost", "oilmaster", "Je@fSZ+L4K#DFJ3esFa","mctoillio");	//サーバー用
		if(mysqli_connect_errno() > 0){
			die("no connect" . mysqli_connect_error());
		}
		mysqli_set_charset($link, "utf8");
		return $link;
	}

	//DB-go
	function dbgo($sql,$con,$sqle) {
		$rst = mysqli_query($con, $sql);
		return $rst;
	}

	//DB-close
	function dbfree($rst) {
		mysqli_free_result($rst);
	}

	//DB-close
	function dbclose($con) {
		mysqli_close($con);
	}











}

























?>