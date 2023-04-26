<?php

//暗号・復号
class ango {
	function ango($dat,$cont) {
		$sky[0]="Kdlkjdsal;_adTsYMada3ccslGp@#Ec7=Qxy3AaP3Vy+3se_Ee9";
		//$sky[1]="p@#Ec7=Kdlda3*cslGQxy3se_Ee9AkjYMaaP3Vyl;_ad+3dsaTs";

		if ($cont=="enc") {
			//暗号
			return openssl_encrypt($dat, 'AES-128-ECB', $sky[0]);

		} elseif ($cont=="dec") {
			//復号
			return openssl_decrypt($dat, 'AES-128-ECB', $sky[0]);
		}
	}
}

//セキュア
class secure extends ango {

	var $dmn;

	//通常
	function out($dat) {
		return htmlspecialchars($dat,ENT_QUOTES,"UTF-8");
	}


	//強制httpsジャンプ
	function mustssl() {
		if(!$_SERVER["HTTPS"]) {
			header("location: https://".FDOMAIN.$_SERVER["REQUEST_URI"]);
			exit();
		}
	}

	//強制httpジャンプ
	function outssl() {
		if($_SERVER["HTTPS"]) {
			header("location: http://".DOMAIN.$_SERVER["REQUEST_URI"]);
			exit();
		}
	}















	function autourl($url) {

		$pattern = '/((?:https?|ftp):\/\/[-_.!~*\'()a-zA-Z0-9;\/?:@&=+$,%#]+)/';
		$replace = '<strong><a href="$1" target="_blank">$1</a></strong>';
		$newurl    = preg_replace( $pattern, $replace, $url);
		return $newurl;
	}



	//SQL
	function outsql($dat,$con) {
		return mysqli_real_escape_string($con,$dat);
	}

	//URL
	function outurl($dat) {
		return htmlspecialchars(preg_replace( '/javascript/i','',preg_replace('/[\x00-\x20\x22\x27]/u','',$dat)),ENT_QUOTES,"UTF-8");
	}


	//ログイン入力不足チェック
	function loginng($id,$pw) {
		if (strlen($this->spacecut($id,''))<3 or strlen($this->spacecut($pw,''))<4) {
			return "ng=on";
		}
	}

	//名前チェック「CMS]
	function lnmchk($nm) {
		if (preg_match("/[<>=!$%,\[\]\/^{}_?\;]/",$this->ango($nm,"dec")) or $this->ango($nm,"dec")=="") {
			if (intval($_GET["f"])>0) {
				$p="?red=".intval($_GET["f"]);
				if (intval($_GET["i"])>0) $p.="&i=".intval($_GET["i"]);
			}
			header("location:/".DEFDIR."/logout.php".$p);
			exit();
		}
	}

	//名前チェック「FLONT]
	function lnmchkf($nm) {
		if (preg_match("/[<>=!$%,\[\]\/^{}_?\;]/",$this->ango($nm,"dec")) or $this->ango($nm,"dec")=="") {
			if (intval($_GET["f"])>0) {
				$p="?red=".intval($_GET["f"]);
				if (intval($_GET["i"])>0) $p.="&i=".intval($_GET["i"]);
			}
			header("location:/".DEFDIR."/logout.html".$p);
			exit();
		}
	}




	//cookieチェック(a-b cookie)
	function iscookie($dat,$a,$b,$c) {
		$myself = basename($_SERVER['SCRIPT_NAME']);
		if (! isset($_GET['do'])) {
			setcookie('DUMMY', TRUE, time()+60,"/",$this->dmn);
			if ($a!="" and $b!="" and $c!="") {
				setcookie($a, $c, time()+60*60*24,"/",$this->dmn);
				setcookie($b, $c, time()+60*60*24,"/",$this->dmn);
			}
			header("Location: $myself?do=check&".$dat);		// Cookie送信

		} else {
			$cookie = $_COOKIE['DUMMY'];				// Cookie取得
			$ret = $cookie ? TRUE : FALSE;
			setcookie('DUMMY', '', time() - 3600,"/",$this->dmn);		// Cookie消去
		}
		return $ret;
	}


	//CMS 利用IP制限
	var	$okip = array(
			//0=>"111.103.91.26",		//土屋
			4=>"202.220.206.240",		//mobile static

			
	);
	function limitchk($dat) {
		foreach($this->okip as $value) {
			if ($dat==$value) {
				$nolimit=1;
				break;
			}
		}
		if ($nolimit==1) {
			return true;
		} else {
			return false;
		}
	}

	//ログイン禁止時間帯
	function kintime($kaku) {
		$time[1] = "2:00-4:30";
		//$time[2] = "23:00-24:00";

		if ($kaku>=99) return true;		//ログイン禁止無効格

		foreach($time as $value) {
			$kin=explode("-",$value);
			$kinst=explode(":",$kin[0]);
			$kined=explode(":",$kin[1]);

			$start = mktime ($kinst[0],$kinst[1],0,date("n"),date("j"),date("Y"));
			$end = mktime ($kined[0],$kined[1],0,date("n"),date("j"),date("Y"));

			if ($start<=date("U") and date("U")<=$end) {
				$ng=1;
				break;
			}
		}
		if ($ng==1) {
			return false;
		} else {
			return true;
		}

	}


	//スペースカット
	function spacecut($dat,$cont) {
		//$dat = mb_ereg_replace("/　/", "", $dat);
		$dat = mb_convert_kana($dat, 's', 'UTF-8');
		$dat = preg_replace ("/ |\n/u", "", $dat);
		if ($cont=="f") $dat = preg_replace('/[\<\>\?\#\!\$\'\"\(\)\=\%\&\/\+\*\,\|\{\}\[\]]/u', '', $dat);
		return $dat;
	}

	//まとめcut
	function matomecut($dat) {
		$dat = mb_convert_kana($dat, 's', 'UTF-8');
		$dat = preg_replace('/[\,\|]/u', '', $dat);
		return $dat;
	}


	//パスワード
	function passwd($dat,$cont) {
		if ($cont=="make") {
			//作成
			return hash_hmac('sha256', $dat, SaLt);

		} else {
			//照合
		}
	}


	//ログインセッション(index)
	function login($id,$pw,$con){
		$sql="select g_code,g_name,u_code,u_id,u_name_l,u_name_f,u_ipl,u_token,r2_a_code,r_g_code"
			." from ((roles2 inner join grps on roles2.r2_g_code=grps.g_code)"
			." inner join roles on grps.g_code=roles.r_g_code) inner join users"
			." on roles.r_u_code=users.u_code"
			." where u_id='".$this->outsql($id,$con)."'"
			." and u_pass='".$this->passwd($pw,"make")."'"
			." and u_status=3 and g_status=3";
		return $sql;
	}






	//ログインセッション（受託フロント）
/*
	function loginf($cd,$id,$con,$pw){
		if ($pw=="") {
			$sql="select * from jutaku"
				." where j_code='".$this->outsql($cd,$con)."'"
				." and j_id='".$this->outsql($id,$con)."'"
				." and j_status=3";
		} else {
			$sql="select * from jutaku"
				." where j_id='".$this->outsql($id,$con)."'"
				." and j_pw='".$this->outsql($pw,$con)."'"
				." and j_status=3";
		}
		return $sql;
	}
*/


	function token() {
	    $bytes = openssl_random_pseudo_bytes(32);
		return bin2hex($bytes);
	}

	//ログインセッション登録
	function tokenent($cd,$tk){
		$sql="update users set u_token='".$tk."' where u_code='".$cd."'";
		return $sql;
	}



	//ログインセッションチェック(main)
	function loginsessa($cd,$tk,$con){
		$sql="select g_code,g_name,u_code,u_id,u_name_l,u_name_f,u_ipl,u_token,r2_a_code"
			." from ((roles2 inner join grps on roles2.r2_g_code=grps.g_code)"
			." inner join roles on grps.g_code=roles.r_g_code) inner join users"
			." on roles.r_u_code=users.u_code"
			." where u_status=3 and g_status=3 and u_code='".$this->outsql($cd,$con)."' and u_token='".$this->outsql($tk,$con)."'";

		return $sql;
	}




	//連打対策
	function dos() {
		$cnt=intval($_COOKIE["dos"]);
		$time=date("U");
		setcookie("flt", $time, 0,"/",$this->dmn);

		if ($_COOKIE["flt"]==$time) {
			$cnt++;
			setcookie("dos", $cnt, 0,"/",$this->dmn);
		} else {
			setcookie("dos","",time() - 3600,"/",$this->dmn);
		}

		if ($cnt>=3) {
			header("location:".DEFURL."/logout.html");
			exit();
		}
	}


	//権限
	var $authdat = array(
		1 => 'メンバー',

		//個別権限


		60 => 'メモリオン閲覧',
		61 => 'メモリオン編集',

		70 => 'CHARGE閲覧',
		71 => 'CHARGE編集',

		80 => 'User閲覧',
		81 => 'User編集',

		90 => 'Group閲覧',
		91 => 'Group編集',

		//全権限
		98 => '管理者',	//全権限（固定）
		99 => 'SU'		//通常非表示（選択不可）
	);

	function authmakebx($grprl,$nowauth,$cont) {
		$option=$errcode="";
		($cont=='w')? $hcr=' onclick="return false;"':$hcr='';
		foreach ($this->authdat as $key => $value) {
			$select = "";
			foreach($grprl as $value2) {
				if ($value2==$key) {
					$select =" checked";
					$errcode=0;
					break;
				}
			}
			($select=="" && $cont=='w')? $hc=" disabled":$hc="";
			if ($key==99 and $nowauth==99 or $key<=98) $option .= "<div class=\"oks\"><label><input type=\"checkbox\" name=\"auth[]\" value=\"".$key."\"".$select.$hc.$hcr." class=\"hl hlr\">".$value."</label></div>";

		}
		return array ($option,$errcode);

	}



	//閲覧・編集権限
	function vecheck2($auth,$vauth,$eauth) {
		$maxauth=0;
		foreach($auth as $key =>$value) {
			//管理者
			if ($value['kengen']>=98) {
				$vok=$eok=2;
				$maxauth=$value['kengen'];
				break;
			}

			//管理者以外
			foreach($value as $key2 =>$value2) {
				if ($key2=="kengen") {
					if (in_array($value2, $vauth)) $vok=1;
					if (in_array($value2, $eauth)) $eok=1;
					if ($maxauth<$value2) $maxauth=$value2;
				}
			}
		}

		return array ($vok, $eok,$maxauth);
	}



	//閲覧・編集権限
	function vecheck($auth,$vauth,$eauth) {

		//メンバー
		if (in_array('1',$vauth)) {
			$vok=1;
		}
		if (in_array('1',$eauth)) {
			$eok=1;
		}

		//管理者
		if (count(array_intersect($auth['kengen'],[98,99]))>0) {
			$vok=$eok=2;
		} else {
			//それ以外
			if (count(array_intersect($auth['kengen'],$vauth))>0) $vok=1;
			if (count(array_intersect($auth['kengen'],$eauth))>0) $eok=1;
		}

		return array ($vok, $eok);
	}





	//文字列共通化
	//全角カナ統一
	function seikei($str = '', $opt = '') {
		$opt="rnaWpX";

		// 変換する文字・オプションが文字列でない場合はそのまま返す
		if (!is_string($str) or ! is_string($opt)) {
			return $str;
		}
	
		/** ------------------------------------------------------------------------
		 * ここから文字の揺らぎを修正する初期化関数です。
		 * ---------------------------------------------------------------------- */
		$init = function() use(&$str) {
			// 「水平タブ(HT)」をスペース4文字に展開します。
			// 「ゕゖ」を「ヵヶ」に変換します。
			// 「U+3099（゙）」「U+309A（゚）」を単独の濁点
			// 「U+309B（゛）」「U+309C（゜）」に変換します。
			$src = array("\t", '゙', '゚', 'ゕ', 'ゖ');
			$rep = array('    ', '゛', '゜', 'ヵ', 'ヶ');
			$str = str_replace($src, $rep, $str);
	
			// 半角カタカナを全角カタカナに変換します。
			$str = mb_convert_kana($str, 'KV',"utf-8");
	
			// 「改行(LF)」以外の制御文字を空文字に変換します。
			$str = preg_replace('/[\x00-\x09\x0b-\x1f\x7f-\x9f]/u', '', $str);
			// unicodoの制御文字を空文字に変換します。
			$decoded = json_decode(
							'["' .
							'\u2000\u2001\u2002\u2003\u2004\u2005\u2006\u2007' .
							'\u2008\u2009\u200A\u200B\u200C\u200D\u200E\u200F' .
							'\u2028\u2029\u202A\u202B\u202C\u202D\u202E' .
							'\u2060' .
							'\u206A\u206B\u206C\u206D\u206E\u206F' .
							'\uFFF9\uFFFA\uFFFB' .
							'"]', true);
			$str = str_replace($decoded, '', $str);
	
			// 濁点・半濁点付きの文字を一文字に変換します。
			//
			// 「ゔ」は「う゛」に展開されます。
			// 「わ゛」は「う゛ぁ」に変換されます。
			// 「ゐ゛」は「う゛ぃ」に変換されます。
			// 「ゑ゛」は「う゛ぇ」に変換されます。
			// 「を゛」は「う゛ぉ」に変換されます。
			// 「ヷ」「ワ゛」は「ヴァ」に展開されます。
			// 「ヸ」「ヰ゛」は「ヴィ」に展開されます。
			// 「ヹ」「ヱ゛」は「ヴェ」に展開されます。
			// 「ヺ」「ヲ゛」は「ヴォ」に展開されます。
			$multi = array(
				'か゛', 'き゛', 'く゛', 'け゛', 'こ゛',
				'さ゛', 'し゛', 'す゛', 'せ゛', 'そ゛',
				'た゛', 'ち゛', 'つ゛', 'て゛', 'と゛',
				'は゛', 'ひ゛', 'ふ゛', 'へ゛', 'ほ゛',
				'は゜', 'ひ゜', 'ふ゜', 'へ゜', 'ほ゜',
				'ゔ', 'ゝ゛',
				'わ゛', 'ゐ゛', 'ゑ゛', 'を゛',
				'カ゛', 'キ゛', 'ク゛', 'ケ゛', 'コ゛',
				'サ゛', 'シ゛', 'ス゛', 'セ゛', 'ソ゛',
				'タ゛', 'チ゛', 'ツ゛', 'テ゛', 'ト゛',
				'ハ゛', 'ヒ゛', 'フ゛', 'ヘ゛', 'ホ゛',
				'ハ゜', 'ヒ゜', 'フ゜', 'ヘ゜', 'ホ゜',
				'ウ゛', 'ヽ゛',
				'ワ゛', 'ヰ゛', 'ヱ゛', 'ヲ゛',
				'ヷ', 'ヸ', 'ヹ', 'ヺ'
			);
			$single = array(
				'が', 'ぎ', 'ぐ', 'げ', 'ご',
				'ざ', 'じ', 'ず', 'ぜ', 'ぞ',
				'だ', 'ぢ', 'づ', 'で', 'ど',
				'ば', 'び', 'ぶ', 'べ', 'ぼ',
				'ぱ', 'ぴ', 'ぷ', 'ぺ', 'ぽ',
				'う゛', 'ゞ',
				'う゛ぁ', 'う゛ぃ', 'う゛ぇ', 'う゛ぉ',
				'ガ', 'ギ', 'グ', 'ゲ', 'ゴ',
				'ザ', 'ジ', 'ズ', 'ゼ', 'ゾ',
				'ダ', 'ヂ', 'ヅ', 'デ', 'ド',
				'バ', 'ビ', 'ブ', 'ベ', 'ボ',
				'パ', 'ピ', 'プ', 'ペ', 'ポ',
				'ヴ', 'ヾ',
				'ヴァ', 'ヴィ', 'ヴェ', 'ヴォ',
				'ヴァ', 'ヴィ', 'ヴェ', 'ヴォ'
			);
	
			$str = str_replace($multi, $single, $str);
		};
	
		/** ------------------------------------------------------------------------
		 * ここからオプションの文字により変換を行う関数です。
		 * ---------------------------------------------------------------------- */
		$convert = function($s) use(&$str) {
			switch ($s) {
				// r: 「全角」英字を「半角」に変換します。
				case 'r':
					$str = mb_convert_kana($str, 'r',"utf-8");
					break;
	
				// R: 「半角」英字を「全角」に変換します。
				case 'R':
					$str = mb_convert_kana($str, 'R',"utf-8");
					break;
	
				// n: 「全角」数字を「半角」に変換します。
				case 'n':
					$str = mb_convert_kana($str, 'n',"utf-8");
					break;
	
				// N: 「半角」数字を「全角」に変換します。
				case 'N':
					$str = mb_convert_kana($str, 'N',"utf-8");
					break;
	
				// a: 「全角」英数字記号を「半角」に変換します。
				//
				// "a", "A" オプションに含まれる文字は、
				// U+0022, U+0027, U+005C, U+007Eを除く（" ' \ ~ ）
				// U+0021 - U+007E の範囲です。
				case 'a':
					$str = mb_convert_kana($str, 'a',"utf-8");
					break;
	
				// A: 「半角」英数字記号を「全角」に変換します 。
				//
				// "a", "A" オプションに含まれる文字は、
				// U+0022, U+0027, U+005C, U+007Eを除く（" ' \ ~ ）
				// U+0021 - U+007E の範囲です。
				case 'A':
					$str = mb_convert_kana($str, 'A',"utf-8");
					break;
	
				// s: 「全角」スペースを「半角」に変換します（U+3000 -> U+0020）。
				case 's':
					$str = mb_convert_kana($str, 's',"utf-8");
					break;
	
				// S: 「半角」スペースを「全角」に変換します（U+0020 -> U+3000）。
				case 'S':
					$str = mb_convert_kana($str, 'S',"utf-8");
					break;
	
				// c: 「全角カタカナ」を「全角ひらがな」に変換します。
				//
				// 「ヽヾ」は「ゝゞ」に変換されます。
				// 「ヴ」は「う゛」に展開されます。
				// 「ヶ」は変換されません。（変換先が「か」「が」「こ」の複数あるため）
				// 「ヵ」は「か」に変換されます。
				// http://www.wikiwand.com/ja/%E6%8D%A8%E3%81%A6%E4%BB%AE%E5%90%8D
				case 'c':
					$str = mb_convert_kana($str, 'c',"utf-8");
					$kana = array('ヴ', 'ヵ', 'ヽ', 'ヾ');
					$hira = array('う゛', 'か', 'ゝ', 'ゞ');
					$str = str_replace($kana, $hira, $str);
					break;
	
				// C: 「全角ひらがな」を「全角カタカナ」に変換します。
				//
				// 「ゝゞ」は「ヽヾ」に変換されます。
				// 「う゛」は「ヴ」に結合されます。
				case 'C':
					$str = mb_convert_kana($str, 'C',"utf-8");
					$hira = array('ウ゛', 'ゝ', 'ゞ');
					$kana = array('ヴ', 'ヽ', 'ヾ');
					$str = str_replace($hira, $kana, $str);
					break;
	
				// v: 「う濁」を「は濁」に変換します。
				//
				// 「う゛ぁ」「う゛ぃ」「う゛」「う゛ぇ」「う゛ぉ」を
				// 「ば」「び」「ぶ」「べ」「ぼ」に変換します。
				case 'v':
					$udaku = array(
						'う゛ぁ', 'う゛ぃ', 'う゛ぇ', 'う゛ぉ', 'う゛',
						'ゔぁ', 'ゔぃ', 'ゔぇ', 'ゔぉ', 'ゔ'
					);
					$hadaku = array(
						'ば', 'び', 'べ', 'ぼ', 'ぶ',
						'ば', 'び', 'べ', 'ぼ', 'ぶ'
					);
					$str = str_replace($udaku, $hadaku, $str);
					break;
	
				// V: 「ウ濁」を「ハ濁」に変換します。
				//
				// 「ヴァ」「ヴィ」「ヴ」「ヴェ」「ヴォ」を
				// 「バ」「ビ」「ブ」「ベ」「ボ」に変換します。
				case 'V':
					$udaku = array(
						'ウ゛ァ', 'ウ゛ィ', 'ウ゛ェ', 'ウ゛ォ', 'ウ゛',
						'ヴァ', 'ヴィ', 'ヴェ', 'ヴォ', 'ヴ'
					);
					$hadaku = array(
						'バ', 'ビ', 'ベ', 'ボ', 'ブ',
						'バ', 'ビ', 'ベ', 'ボ', 'ブ'
					);
					$str = str_replace($udaku, $hadaku, $str);
					break;
	
				// Q: 半角クォーテーション、半角アポストロフィを全角に変換します。
				case 'Q':
					$han = array('"', "'");
					$zen = array('＂', '＇');
					$str = str_replace($han, $zen, $str);
					break;
	
				// q: 全角クォーテーション、全角アポストロフィを半角に変換します。
				case 'q':
					$han = array('"', "'");
					$zen = array('＂', '＇');
					$str = str_replace($zen, $han, $str);
					break;
	
				// B: 半角バックスラッシュを全角に変換します。
				case 'B':
					$han = "\\";
					$zen = '＼';
					$str = str_replace($han, $zen, $str);
					break;
	
				// b: 全角バックスラッシュを半角に変換します。
				case 'b':
					$han = "\\";
					$zen = '＼';
					$str = str_replace($zen, $han, $str);
					break;
	
				// T: 半角チルダを全角にチルダ変換します。
				case 'T':
					$han = '~';
					$zen = '～';
					$str = str_replace($han, $zen, $str);
					break;
	
				// t: 全角チルダを半角チルダに変換します。
				case 't':
					$han = '~';
					$zen = '～';
					$str = str_replace($zen, $han, $str);
					break;
	
				// W: 全角波ダッシュを全角チルダに変換します。
				case 'W':
					$nami = '〜';
					$tilde = '～';
					$str = str_replace($nami, $tilde, $str);
					break;
	
				// w: 全角チルダを全角波ダッシュに変換します。
				case 'w':
					$nami = '〜';
					$tilde = '～';
					$str = str_replace($tilde, $nami, $str);
					break;
	
				// P: ハイフン、ダッシュ、マイナスを全角ハイフンマイナスに変換します。（U+FF0D）
				//    英数記号の後ろにある全角・半角長音符も含む
				//
				// http://hydrocul.github.io/wiki/blog/2014/1101-hyphen-minus-wave-tilde.html
				//    「U+002D」半角ハイフンマイナス
				//    「U+FE63」小さいハイフンマイナス。NFKD/NFKC正規化で U+002D
				//    「U+FF0D」全角ハイフンマイナス
				//    「U+2212」「U+207B」「U+208B」マイナス
				//    「U+2010」「U+2011」ハイフン
				//    「U+2012」～「U+2015」「U+FE58」ダッシュ
				case 'P':
					$phyhen = array(
						'-', '﹣', '－', '−', '⁻', '₋',
						'‐', '‑', '‒', '–', '—', '―', '﹘'
					);
					$change = '－';
					$str = str_replace($phyhen, $change, $str);
					$str = preg_replace('/([!-~！-～])(ー|ｰ)/u', '$1' . $change, $str);
					break;
	
				// p: ハイフン、ダッシュ、マイナスを半角ハイフンマイナスに変換します。（U+002D）
				//    英数記号の後ろにある全角・半角長音符も含む
				//
				// http://hydrocul.github.io/wiki/blog/2014/1101-hyphen-minus-wave-tilde.html
				//    「U+002D」半角ハイフンマイナス
				//    「U+FE63」小さいハイフンマイナス。NFKD/NFKC正規化で U+002D
				//    「U+FF0D」全角ハイフンマイナス
				//    「U+2212」「U+207B」「U+208B」マイナス
				//    「U+2010」「U+2011」ハイフン
				//    「U+2012」～「U+2015」「U+FE58」ダッシュ
				case 'p':
					$phyhen = array(
						'-', '﹣', '－', '−', '⁻', '₋',
						'‐', '‑', '‒', '–', '—', '―', '﹘'
					);
					$change = '-';
					$str = str_replace($phyhen, $change, $str);
					$str = preg_replace('/([!-~！-～])(ー|ｰ)/u', '$1' . $change, $str);
					break;
	
				// U: 「U+0021」～「U+007E」以外の「半角」記号を「全角」記号に変換します。
				//
				// http://www.asahi-net.or.jp/~ax2s-kmtn/ref/unicode/uff00.html
				case 'U':
					$han = array(
						'⦅', '⦆', '¢', '£', '¬', '¯', '¦', '¥',
						'₩', '￨', '￩', '￪', '￫', '￬', '￭', '￮'
					);
					$zen = array(
						'｟', '｠', '￠', '￡', '￢', '￣', '￤', '￥',
						'￦', '│', '←', '↑', '→', '↓', '■', '○'
					);
					$str = str_replace($han, $zen, $str);
					break;
	
				// u: 「U+0021」～「U+007E」以外の「全角」記号を「半角」記号に変換します。
				//
				// http://www.asahi-net.or.jp/~ax2s-kmtn/ref/unicode/uff00.html
				case 'u':
					$han = array(
						'⦅', '⦆', '¢', '£', '¬', '¯', '¦', '¥',
						'₩', '￨', '￩', '￪', '￫', '￬', '￭', '￮'
					);
					$zen = array(
						'｟', '｠', '￠', '￡', '￢', '￣', '￤', '￥',
						'￦', '│', '←', '↑', '→', '↓', '■', '○'
					);
					$str = str_replace($zen, $han, $str);
					break;
	
				// X: カッコ付き文字を半角括弧と中の文字に展開します。
				//
				// http://www.asahi-net.or.jp/~ax2s-kmtn/ref/unicode/u2460.html
				// http://www.asahi-net.or.jp/~ax2s-kmtn/ref/unicode/u3200.html
				case 'X':
					$single = array(
						'⑴', '⑵', '⑶', '⑷', '⑸',
						'⑹', '⑺', '⑻', '⑼', '⑽',
						'⑾', '⑿', '⒀', '⒁', '⒂',
						'⒃', '⒄', '⒅', '⒆', '⒇',
						'⒜', '⒝', '⒞', '⒟', '⒠', '⒡', '⒢', '⒣',
						'⒤', '⒥', '⒦', '⒧', '⒨', '⒩', '⒪', '⒫',
						'⒬', '⒭', '⒮', '⒯', '⒰', '⒱', '⒲', '⒳',
						'⒴', '⒵',
						'㈠', '㈡', '㈢', '㈣', '㈤',
						'㈥', '㈦', '㈧', '㈨', '㈩',
						'㈪', '㈫', '㈬', '㈭', '㈮', '㈯', '㈰',
						'㈱', '㈲', '㈳', '㈴', '㈵', '㈶', '㈷',
						'㈸', '㈹', '㈺', '㈻', '㈼', '㈽', '㈾',
						'㈿', '㉀', '㉁', '㉂', '㉃'
					);
					$multi = array(
						'(1)', '(2)', '(3)', '(4)', '(5)',
						'(6)', '(7)', '(8)', '(9)', '(10)',
						'(11)', '(12)', '(13)', '(14)', '(15)',
						'(16)', '(17)', '(18)', '(19)', '(20)',
						'(a)', '(b)', '(c)', '(d)', '(e)', '(f)', '(g)', '(h)',
						'(i)', '(j)', '(k)', '(l)', '(m)', '(n)', '(o)', '(p)',
						'(q)', '(r)', '(s)', '(t)', '(u)', '(v)', '(w)', '(x)',
						'(y)', '(z)',
						'(一)', '(二)', '(三)', '(四)', '(五)',
						'(六)', '(七)', '(八)', '(九)', '(十)',
						'(月)', '(火)', '(水)', '(木)', '(金)', '(土)', '(日)',
						'(株)', '(有)', '(社)', '(名)', '(特)', '(財)', '(祝)',
						'(労)', '(代)', '(呼)', '(学)', '(監)', '(企)', '(資)',
						'(協)', '(祭)', '(休)', '(自)', '(至)'
					);
					$str = str_replace($single, $multi, $str);
					break;
	
				// Y: 集合文字を展開します。（単位文字以外）
				//
				// http://www.asahi-net.or.jp/~ax2s-kmtn/ref/unicode/u2460.html
				// http://www.asahi-net.or.jp/~ax2s-kmtn/ref/unicode/u3200.html
				// http://www.asahi-net.or.jp/~ax2s-kmtn/ref/unicode/u3300.html
				case 'Y':
					$single = array(
						'㌀', '㌁', '㌂', '㌃', '㌄', '㌅',
						'㌆', '㌇', '㌈', '㌉', '㌊', '㌋',
						'㌌', '㌍', '㌎', '㌏', '㌐', '㌑', '㌒',
						'㌓', '㌔', '㌕', '㌖', '㌗', '㌘',
						'㌙', '㌚', '㌛', '㌜', '㌝', '㌞',
						'㌟', '㌠', '㌡', '㌢', '㌣', '㌤',
						'㌥', '㌦', '㌧', '㌨', '㌩', '㌪', '㌫',
						'㌬', '㌭', '㌮', '㌯', '㌰', '㌱', '㌲',
						'㌳', '㌴', '㌵', '㌶', '㌷', '㌸',
						'㌹', '㌺', '㌻', '㌼', '㌽', '㌾', '㌿',
						'㍀', '㍁', '㍂', '㍃', '㍄', '㍅', '㍆',
						'㍇', '㍈', '㍉', '㍊', '㍋', '㍌',
						'㍍', '㍎', '㍏', '㍐', '㍑', '㍒', '㍓',
						'㍔', '㍕', '㍖', '㍗',
						'㍿', '㍻', '㍼', '㍽', '㍾',
						'㋀', '㋁', '㋂', '㋃', '㋄', '㋅',
						'㋆', '㋇', '㋈', '㋉', '㋊', '㋋',
						'㏠', '㏡', '㏢', '㏣', '㏤',
						'㏥', '㏦', '㏧', '㏨', '㏩',
						'㏪', '㏫', '㏬', '㏭', '㏮',
						'㏯', '㏰', '㏱', '㏲', '㏳',
						'㏴', '㏵', '㏶', '㏷', '㏸',
						'㏹', '㏺', '㏻', '㏼', '㏽', '㏾',
						'㍘', '㍙', '㍚', '㍛', '㍜', '㍝',
						'㍞', '㍟', '㍠', '㍡', '㍢',
						'㍣', '㍤', '㍥', '㍦', '㍧',
						'㍨', '㍩', '㍪', '㍫', '㍬',
						'㍭', '㍮', '㍯', '㍰',
						'⒈', '⒉', '⒊', '⒋', '⒌', '⒍', '⒎', '⒏', '⒐', '⒑',
						'⒒', '⒓', '⒔', '⒕', '⒖', '⒗', '⒘', '⒙', '⒚', '⒛',
						'№', '℡', '㏍', '㏇', '㏂', '㏘'
					);
					$multi = array(
						'アパート', 'アルファ', 'アンペア', 'アール', 'イニング', 'インチ',
						'ウォン', 'エスクード', 'エーカー', 'オンス', 'オーム', 'カイリ',
						'カラット', 'カロリー', 'ガロン', 'ガンマ', 'ギガ', 'ギニー', 'キュリー',
						'ギルダー', 'キロ', 'キログラム', 'キロメートル', 'キロワット', 'グラム',
						'グラムトン', 'クルゼイロ', 'クローネ', 'ケース', 'コルナ', 'コーポ',
						'サイクル', 'サンチーム', 'シリング', 'センチ', 'セント', 'ダース',
						'デシ', 'ドル', 'トン', 'ナノ', 'ノット', 'ハイツ', 'パーセント',
						'パーツ', 'バーレル', 'ピアストル', 'ピクル', 'ピコ', 'ビル', 'ファラッド',
						'フィート', 'ブッシェル', 'フラン', 'ヘクタール', 'ペソ', 'ペニヒ',
						'ヘルツ', 'ペンス', 'ページ', 'ベータ', 'ポイント', 'ボルト', 'ホン',
						'ポンド', 'ホール', 'ホーン', 'マイクロ', 'マイル', 'マッハ', 'マルク',
						'マンション', 'ミクロン', 'ミリ', 'ミリバール', 'メガ', 'メガトン',
						'メートル', 'ヤード', 'ヤール', 'ユアン', 'リットル', 'リラ', 'ルピー',
						'ルーブル', 'レム', 'レントゲン', 'ワット',
						'株式会社', '平成', '昭和', '大正', '明治',
						'1月', '2月', '3月', '4月', '5月', '6月',
						'7月', '8月', '9月', '10月', '11月', '12月',
						'1日', '2日', '3日', '4日', '5日',
						'6日', '7日', '8日', '9日', '10日',
						'11日', '12日', '13日', '14日', '15日',
						'16日', '17日', '18日', '19日', '20日',
						'21日', '22日', '23日', '24日', '25日',
						'26日', '27日', '28日', '29日', '30日', '31日',
						'0点', '1点', '2点', '3点', '4点', '5点',
						'6点', '7点', '8点', '9点', '10点',
						'11点', '12点', '13点', '14点', '15点',
						'16点', '17点', '18点', '19点', '20点',
						'21点', '22点', '23点', '24点',
						'1.', '2.', '3.', '4.', '5.', '6.', '7.', '8.', '9.', '10.',
						'11.', '12.', '13.', '14.', '15.', '16.', '17.', '18.', '19.',
						'20.',
						'No.', 'TEL', 'K.K.', 'Co.', 'a.m.', 'p.m.'
					);
					$str = str_replace($single, $multi, $str);
					break;
	
				// Z: 小字形文字を大文字に変換します。（U+FE50～U+FE6B）
				// 「﹐﹑﹒﹔﹕﹖﹗﹘﹙﹚﹛﹜﹝﹞﹟﹠﹡﹢﹣﹤﹥﹦﹨﹩﹪﹫」
				//
				// 「U+FF58」は「U+2014」へマッピングされていますが、揺らぎの訂正のため
				// 「U+002D（半角ハイフンマイナス）」に変換します。
				//
				// http://www.asahi-net.or.jp/~ax2s-kmtn/ref/unicode/ufe50.html
				case 'Z':
					$small = array(
						'﹐', '﹑', '﹒', '﹔', '﹕', '﹖', '﹗', '﹘', '﹙', '﹚',
						'﹛', '﹜', '﹝', '﹞', '﹟', '﹠', '﹡', '﹢', '﹣',
						'﹤', '﹥', '﹦', '﹨', '﹩', '﹪', '﹫'
					);
					$big = array(
						',', '、', '.', ';', ':', '?', '!', '-', '(', ')',
						'{', '}', '〔', '〕', '#', '&', '*', '+', '-',
						'<', '>', '=', "\\", '$', '%', '@'
					);
					$str = str_replace($small, $big, $str);
					break;
				default :
					break;
			}
		};
	
		// 文字列の初期化（揺らぎの訂正）を行ないます
		$init();
		// オプション文字列を分解して一文字ごとに$convertを実行します
		array_map($convert, str_split($opt));
	
		return $str;
	}



	//キー・リメイク
	function kyremake($dat) {
		$dat = mb_ereg_replace("　", " ", $dat);
		$dats= explode(" ",$dat);
		foreach($dats as $value) {
			if (preg_replace ("/ /u", "",$value)!="" and !preg_match("/[<>=!$%,\[\]\/^{}_\;]/",$value)) {
				if ($ret!="") $ret.=" ";
				$ret.=$this->seikei($value,"rnTW");
			}
		}
		return $ret;
	}



	//ランダム文字列生成
	function randmake($length) {
		$str = array_merge(range('a', 'z'), range('0', '9'), range('A', 'Z'));
		$r_str = null;
		for ($i = 0; $i < $length; $i++) {
			$r_str .= $str[rand(0, count($str))];
		}
		return $r_str;
	}


















	//SJIS出力
	function sx($word) {
		if ($word!="") {
			$word = str_replace(array("\r\n","\r","\n"), '', $word);
			$word = $this->chang($word);
			$word = mb_convert_encoding($word, "SJIS", "UTF-8");
		}
		return $word;
	}











}





?>