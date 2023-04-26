<?php

//セキュア
class process {

	function to_sjis($dat) {
		$newdat = mb_convert_encoding($dat,"SJIS-win","UTF-8");
		return $newdat;
	}

	function to_utf($dat) {
		$newdat = mb_convert_encoding($dat,"UTF-8","SJIS-win");
		//$newdat = str_replace('"', '', $newdat);
		return $newdat;
	}


	function jamcut($dat) {
		$dat = mb_convert_kana($dat, 's', 'UTF-8');
		$dat = preg_replace ("/[ ！／：＝＠＿☆★彡［｀｛～、〜”’・]/u", "", $dat);
		$dat =preg_replace ("/−|–|₋|⁻|—|¬|―|＝|ー|・|￣|ｰ|⋯/u", "", $dat);
		$dat = preg_replace('/[\<\>\?\^\~\:\n\-\_\t\#\!\$\'\"\(\)\=\%\&\/\+\*\,\|\{\}\[\]]/u', '', $dat);
		return $dat;
	}

	function omoji($dat) {
		//$dat = mb_convert_kana($dat, 's', 'UTF-8');
		//$dat = preg_replace ("/[齊斎齋]/u", "斉", $dat);
		//$dat = preg_replace ("/[﨑]/u", "崎", $dat);
		//$dat = preg_replace ("/[臺]/u", "台", $dat);
		//$dat = preg_replace ("/[髙]/u", "高", $dat);
		//$dat = preg_replace ("/[隆]/u", "隆", $dat);
		//$dat = preg_replace ("/[惠]/u", "恵", $dat);
    $jitai = 
    [
        [
            'old' => '﨑',
            'new' => '崎',
        ],
        [
            'old' => '髙',
            'new' => '高',
        ],
        [
            'old' => '隆',
            'new' => '隆',
        ],
        [
            'old' => '堯',
            'new' => '尭',
        ],
        [
            'old' => '亞',
            'new' => '亜',
        ],
        [
            'old' => '惡',
            'new' => '悪',
        ],
        [
            'old' => '壓',
            'new' => '圧',
        ],
        [
            'old' => '圍',
            'new' => '囲',
        ],
        [
            'old' => '爲',
            'new' => '為',
        ],
        [
            'old' => '醫',
            'new' => '医',
        ],
        [
            'old' => '壹',
            'new' => '壱',
        ],
        [
            'old' => '逸',
            'new' => '逸',
        ],
        [
            'old' => '稻',
            'new' => '稲',
        ],
        [
            'old' => '飮',
            'new' => '飲',
        ],
        [
            'old' => '隱',
            'new' => '隠',
        ],
        [
            'old' => '營',
            'new' => '営',
        ],
        [
            'old' => '榮',
            'new' => '栄',
        ],
        [
            'old' => '衞',
            'new' => '衛',
        ],
        [
            'old' => '驛',
            'new' => '駅',
        ],
        [
            'old' => '悅',
            'new' => '悦',
        ],
        [
            'old' => '圓',
            'new' => '円',
        ],
        [
            'old' => '艷',
            'new' => '艶',
        ],
        [
            'old' => '鹽',
            'new' => '塩',
        ],
        [
            'old' => '奧',
            'new' => '奥',
        ],
        [
            'old' => '應',
            'new' => '応',
        ],
        [
            'old' => '橫',
            'new' => '横',
        ],
        [
            'old' => '歐',
            'new' => '欧',
        ],
        [
            'old' => '毆',
            'new' => '殴',
        ],
        [
            'old' => '穩',
            'new' => '穏',
        ],
        [
            'old' => '假',
            'new' => '仮',
        ],
        [
            'old' => '價',
            'new' => '価',
        ],
        [
            'old' => '畫',
            'new' => '画',
        ],
        [
            'old' => '會',
            'new' => '会',
        ],
        [
            'old' => '壞',
            'new' => '壊',
        ],
        [
            'old' => '懷',
            'new' => '懐',
        ],
        [
            'old' => '繪',
            'new' => '絵',
        ],
        [
            'old' => '擴',
            'new' => '拡',
        ],
        [
            'old' => '殼',
            'new' => '殻',
        ],
        [
            'old' => '覺',
            'new' => '覚',
        ],
        [
            'old' => '學',
            'new' => '学',
        ],
        [
            'old' => '嶽',
            'new' => '岳',
        ],
        [
            'old' => '樂',
            'new' => '楽',
        ],
        [
            'old' => '勸',
            'new' => '勧',
        ],
        [
            'old' => '卷',
            'new' => '巻',
        ],
        [
            'old' => '寬',
            'new' => '寛',
        ],
        [
            'old' => '歡',
            'new' => '歓',
        ],
        [
            'old' => '罐',
            'new' => '缶',
        ],
        [
            'old' => '觀',
            'new' => '観',
        ],
        [
            'old' => '閒',
            'new' => '間',
        ],
        [
            'old' => '關',
            'new' => '関',
        ],
        [
            'old' => '陷',
            'new' => '陥',
        ],
        [
            'old' => '巖',
            'new' => '巌',
        ],
        [
            'old' => '顏',
            'new' => '顔',
        ],
        [
            'old' => '歸',
            'new' => '帰',
        ],
        [
            'old' => '氣',
            'new' => '気',
        ],
        [
            'old' => '龜',
            'new' => '亀',
        ],
        [
            'old' => '僞',
            'new' => '偽',
        ],
        [
            'old' => '戲',
            'new' => '戯',
        ],
        [
            'old' => '犧',
            'new' => '犠',
        ],
        [
            'old' => '舊',
            'new' => '旧',
        ],
        [
            'old' => '據',
            'new' => '拠',
        ],
        [
            'old' => '擧',
            'new' => '挙',
        ],
        [
            'old' => '峽',
            'new' => '峡',
        ],
        [
            'old' => '挾',
            'new' => '挟',
        ],
        [
            'old' => '敎',
            'new' => '教',
        ],
        [
            'old' => '狹',
            'new' => '狭',
        ],
        [
            'old' => '曉',
            'new' => '暁',
        ],
        [
            'old' => '區',
            'new' => '区',
        ],
        [
            'old' => '驅',
            'new' => '駆',
        ],
        [
            'old' => '勳',
            'new' => '勲',
        ],
        [
            'old' => '薰',
            'new' => '薫',
        ],
        [
            'old' => '徑',
            'new' => '径',
        ],
        [
            'old' => '惠',
            'new' => '恵',
        ],
        [
            'old' => '溪',
            'new' => '渓',
        ],
        [
            'old' => '經',
            'new' => '経',
        ],
        [
            'old' => '繼',
            'new' => '継',
        ],
        [
            'old' => '莖',
            'new' => '茎',
        ],
        [
            'old' => '螢',
            'new' => '蛍',
        ],
        [
            'old' => '輕',
            'new' => '軽',
        ],
        [
            'old' => '鷄',
            'new' => '鶏',
        ],
        [
            'old' => '藝',
            'new' => '芸',
        ],
        [
            'old' => '缺',
            'new' => '欠',
        ],
        [
            'old' => '儉',
            'new' => '倹',
        ],
        [
            'old' => '劍',
            'new' => '剣',
        ],
        [
            'old' => '圈',
            'new' => '圏',
        ],
        [
            'old' => '檢',
            'new' => '検',
        ],
        [
            'old' => '權',
            'new' => '権',
        ],
        [
            'old' => '獻',
            'new' => '献',
        ],
        [
            'old' => '縣',
            'new' => '県',
        ],
        [
            'old' => '險',
            'new' => '険',
        ],
        [
            'old' => '顯',
            'new' => '顕',
        ],
        [
            'old' => '驗',
            'new' => '験',
        ],
        [
            'old' => '嚴',
            'new' => '厳',
        ],
        [
            'old' => '效',
            'new' => '効',
        ],
        [
            'old' => '廣',
            'new' => '広',
        ],
        [
            'old' => '恆',
            'new' => '恒',
        ],
        [
            'old' => '鑛',
            'new' => '鉱',
        ],
        [
            'old' => '號',
            'new' => '号',
        ],
        [
            'old' => '國',
            'new' => '国',
        ],
        [
            'old' => '黑',
            'new' => '黒',
        ],
        [
            'old' => '濟',
            'new' => '済',
        ],
        [
            'old' => '碎',
            'new' => '砕',
        ],
        [
            'old' => '劑',
            'new' => '剤',
        ],
        [
            'old' => '櫻',
            'new' => '桜',
        ],
        [
            'old' => '册',
            'new' => '冊',
        ],
        [
            'old' => '雜',
            'new' => '雑',
        ],
        [
            'old' => '參',
            'new' => '参',
        ],
        [
            'old' => '慘',
            'new' => '惨',
        ],
        [
            'old' => '棧',
            'new' => '桟',
        ],
        [
            'old' => '蠶',
            'new' => '蚕',
        ],
        [
            'old' => '贊',
            'new' => '賛',
        ],
        [
            'old' => '殘',
            'new' => '残',
        ],
        [
            'old' => '絲',
            'new' => '糸',
        ],
        [
            'old' => '齒',
            'new' => '歯',
        ],
        [
            'old' => '兒',
            'new' => '児',
        ],
        [
            'old' => '辭',
            'new' => '辞',
        ],
        [
            'old' => '濕',
            'new' => '湿',
        ],
        [
            'old' => '實',
            'new' => '実',
        ],
        [
            'old' => '舍',
            'new' => '舎',
        ],
        [
            'old' => '寫',
            'new' => '写',
        ],
        [
            'old' => '釋',
            'new' => '釈',
        ],
        [
            'old' => '壽',
            'new' => '寿',
        ],
        [
            'old' => '收',
            'new' => '収',
        ],
        [
            'old' => '從',
            'new' => '従',
        ],
        [
            'old' => '澁',
            'new' => '渋',
        ],
        [
            'old' => '獸',
            'new' => '獣',
        ],
        [
            'old' => '縱',
            'new' => '縦',
        ],
        [
            'old' => '肅',
            'new' => '粛',
        ],
        [
            'old' => '處',
            'new' => '処',
        ],
        [
            'old' => '緖',
            'new' => '緒',
        ],
        [
            'old' => '敍',
            'new' => '叙',
        ],
        [
            'old' => '奬',
            'new' => '奨',
        ],
        [
            'old' => '將',
            'new' => '将',
        ],
        [
            'old' => '燒',
            'new' => '焼',
        ],
        [
            'old' => '稱',
            'new' => '称',
        ],
        [
            'old' => '證',
            'new' => '証',
        ],
        [
            'old' => '乘',
            'new' => '乗',
        ],
        [
            'old' => '剩',
            'new' => '剰',
        ],
        [
            'old' => '壤',
            'new' => '壌',
        ],
        [
            'old' => '孃',
            'new' => '嬢',
        ],
        [
            'old' => '條',
            'new' => '条',
        ],
        [
            'old' => '淨',
            'new' => '浄',
        ],
        [
            'old' => '疊',
            'new' => '畳',
        ],
        [
            'old' => '穰',
            'new' => '穣',
        ],
        [
            'old' => '讓',
            'new' => '譲',
        ],
        [
            'old' => '釀',
            'new' => '醸',
        ],
        [
            'old' => '囑',
            'new' => '嘱',
        ],
        [
            'old' => '觸',
            'new' => '触',
        ],
        [
            'old' => '寢',
            'new' => '寝',
        ],
        [
            'old' => '愼',
            'new' => '慎',
        ],
        [
            'old' => '晉',
            'new' => '晋',
        ],
        [
            'old' => '眞',
            'new' => '真',
        ],
        [
            'old' => '盡',
            'new' => '尽',
        ],
        [
            'old' => '圖',
            'new' => '図',
        ],
        [
            'old' => '粹',
            'new' => '粋',
        ],
        [
            'old' => '醉',
            'new' => '酔',
        ],
        [
            'old' => '隨',
            'new' => '随',
        ],
        [
            'old' => '髓',
            'new' => '髄',
        ],
        [
            'old' => '數',
            'new' => '数',
        ],
        [
            'old' => '樞',
            'new' => '枢',
        ],
        [
            'old' => '瀨',
            'new' => '瀬',
        ],
        [
            'old' => '淸',
            'new' => '清',
        ],
        [
            'old' => '聲',
            'new' => '声',
        ],
        [
            'old' => '靑',
            'new' => '青',
        ],
        [
            'old' => '靜',
            'new' => '静',
        ],
        [
            'old' => '齊',
            'new' => '斉',
        ],
        [
            'old' => '斎',
            'new' => '斉',
        ],
        [
            'old' => '齋',
            'new' => '斉',
        ],
        [
            'old' => '攝',
            'new' => '摂',
        ],
        [
            'old' => '竊',
            'new' => '窃',
        ],
        [
            'old' => '專',
            'new' => '専',
        ],
        [
            'old' => '戰',
            'new' => '戦',
        ],
        [
            'old' => '淺',
            'new' => '浅',
        ],
        [
            'old' => '潛',
            'new' => '潜',
        ],
        [
            'old' => '纖',
            'new' => '繊',
        ],
        [
            'old' => '踐',
            'new' => '践',
        ],
        [
            'old' => '錢',
            'new' => '銭',
        ],
        [
            'old' => '禪',
            'new' => '禅',
        ],
        [
            'old' => '雙',
            'new' => '双',
        ],
        [
            'old' => '壯',
            'new' => '壮',
        ],
        [
            'old' => '搜',
            'new' => '捜',
        ],
        [
            'old' => '插',
            'new' => '挿',
        ],
        [
            'old' => '爭',
            'new' => '争',
        ],
        [
            'old' => '總',
            'new' => '総',
        ],
        [
            'old' => '聰',
            'new' => '聡',
        ],
        [
            'old' => '莊',
            'new' => '荘',
        ],
        [
            'old' => '裝',
            'new' => '装',
        ],
        [
            'old' => '騷',
            'new' => '騒',
        ],
        [
            'old' => '增',
            'new' => '増',
        ],
        [
            'old' => '臟',
            'new' => '臓',
        ],
        [
            'old' => '藏',
            'new' => '蔵',
        ],
        [
            'old' => '屬',
            'new' => '属',
        ],
        [
            'old' => '續',
            'new' => '続',
        ],
        [
            'old' => '墮',
            'new' => '堕',
        ],
        [
            'old' => '體',
            'new' => '体',
        ],
        [
            'old' => '對',
            'new' => '対',
        ],
        [
            'old' => '帶',
            'new' => '帯',
        ],
        [
            'old' => '滯',
            'new' => '滞',
        ],
        [
            'old' => '臺',
            'new' => '台',
        ],
        [
            'old' => '瀧',
            'new' => '滝',
        ],
        [
            'old' => '擇',
            'new' => '択',
        ],
        [
            'old' => '澤',
            'new' => '沢',
        ],
        [
            'old' => '單',
            'new' => '単',
        ],
        [
            'old' => '擔',
            'new' => '担',
        ],
        [
            'old' => '膽',
            'new' => '胆',
        ],
        [
            'old' => '團',
            'new' => '団',
        ],
        [
            'old' => '彈',
            'new' => '弾',
        ],
        [
            'old' => '斷',
            'new' => '断',
        ],
        [
            'old' => '癡',
            'new' => '痴',
        ],
        [
            'old' => '遲',
            'new' => '遅',
        ],
        [
            'old' => '晝',
            'new' => '昼',
        ],
        [
            'old' => '蟲',
            'new' => '虫',
        ],
        [
            'old' => '鑄',
            'new' => '鋳',
        ],
        [
            'old' => '廳',
            'new' => '庁',
        ],
        [
            'old' => '聽',
            'new' => '聴',
        ],
        [
            'old' => '鎭',
            'new' => '鎮',
        ],
        [
            'old' => '遞',
            'new' => '逓',
        ],
        [
            'old' => '鐵',
            'new' => '鉄',
        ],
        [
            'old' => '轉',
            'new' => '転',
        ],
        [
            'old' => '點',
            'new' => '点',
        ],
        [
            'old' => '傳',
            'new' => '伝',
        ],
        [
            'old' => '黨',
            'new' => '党',
        ],
        [
            'old' => '盜',
            'new' => '盗',
        ],
        [
            'old' => '燈',
            'new' => '灯',
        ],
        [
            'old' => '當',
            'new' => '当',
        ],
        [
            'old' => '鬪',
            'new' => '闘',
        ],
        [
            'old' => '德',
            'new' => '徳',
        ],
        [
            'old' => '獨',
            'new' => '独',
        ],
        [
            'old' => '讀',
            'new' => '読',
        ],
        [
            'old' => '屆',
            'new' => '届',
        ],
        [
            'old' => '繩',
            'new' => '縄',
        ],
        [
            'old' => '貳',
            'new' => '弐',
        ],
        [
            'old' => '惱',
            'new' => '悩',
        ],
        [
            'old' => '腦',
            'new' => '脳',
        ],
        [
            'old' => '廢',
            'new' => '廃',
        ],
        [
            'old' => '拜',
            'new' => '拝',
        ],
        [
            'old' => '賣',
            'new' => '売',
        ],
        [
            'old' => '麥',
            'new' => '麦',
        ],
        [
            'old' => '發',
            'new' => '発',
        ],
        [
            'old' => '髮',
            'new' => '髪',
        ],
        [
            'old' => '拔',
            'new' => '抜',
        ],
        [
            'old' => '蠻',
            'new' => '蛮',
        ],
        [
            'old' => '祕',
            'new' => '秘',
        ],
        [
            'old' => '濱',
            'new' => '浜',
        ],
        [
            'old' => '甁',
            'new' => '瓶',
        ],
        [
            'old' => '拂',
            'new' => '払',
        ],
        [
            'old' => '佛',
            'new' => '仏',
        ],
        [
            'old' => '竝',
            'new' => '並',
        ],
        [
            'old' => '變',
            'new' => '変',
        ],
        [
            'old' => '邊',
            'new' => '辺',
        ],
        [
            'old' => '辨',
            'new' => '弁',
        ],
        [
            'old' => '辯',
            'new' => '弁',
        ],
        [
            'old' => '瓣',
            'new' => '弁',
        ],
        [
            'old' => '舖',
            'new' => '舗',
        ],
        [
            'old' => '穗',
            'new' => '穂',
        ],
        [
            'old' => '寶',
            'new' => '宝',
        ],
        [
            'old' => '豐',
            'new' => '豊',
        ],
        [
            'old' => '沒',
            'new' => '没',
        ],
        [
            'old' => '槇',
            'new' => '槙',
        ],
        [
            'old' => '萬',
            'new' => '万',
        ],
        [
            'old' => '滿',
            'new' => '満',
        ],
        [
            'old' => '默',
            'new' => '黙',
        ],
        [
            'old' => '彌',
            'new' => '弥',
        ],
        [
            'old' => '藥',
            'new' => '薬',
        ],
        [
            'old' => '譯',
            'new' => '訳',
        ],
        [
            'old' => '藪',
            'new' => '薮',
        ],
        [
            'old' => '豫',
            'new' => '予',
        ],
        [
            'old' => '餘',
            'new' => '余',
        ],
        [
            'old' => '與',
            'new' => '与',
        ],
        [
            'old' => '譽',
            'new' => '誉',
        ],
        [
            'old' => '搖',
            'new' => '揺',
        ],
        [
            'old' => '樣',
            'new' => '様',
        ],
        [
            'old' => '謠',
            'new' => '謡',
        ],
        [
            'old' => '遙',
            'new' => '遥',
        ],
        [
            'old' => '來',
            'new' => '来',
        ],
        [
            'old' => '賴',
            'new' => '頼',
        ],
        [
            'old' => '亂',
            'new' => '乱',
        ],
        [
            'old' => '覽',
            'new' => '覧',
        ],
        [
            'old' => '龍',
            'new' => '竜',
        ],
        [
            'old' => '兩',
            'new' => '両',
        ],
        [
            'old' => '獵',
            'new' => '猟',
        ],
        [
            'old' => '綠',
            'new' => '緑',
        ],
        [
            'old' => '壘',
            'new' => '塁',
        ],
        [
            'old' => '勵',
            'new' => '励',
        ],
        [
            'old' => '禮',
            'new' => '礼',
        ],
        [
            'old' => '隸',
            'new' => '隷',
        ],
        [
            'old' => '靈',
            'new' => '霊',
        ],
        [
            'old' => '齡',
            'new' => '齢',
        ],
        [
            'old' => '戀',
            'new' => '恋',
        ],
        [
            'old' => '爐',
            'new' => '炉',
        ],
        [
            'old' => '勞',
            'new' => '労',
        ],
        [
            'old' => '樓',
            'new' => '楼',
        ],
        [
            'old' => '郞',
            'new' => '郎',
        ],
        [
            'old' => '祿',
            'new' => '禄',
        ],
        [
            'old' => '灣',
            'new' => '湾',
        ],
        [
            'old' => '瑤',
            'new' => '瑶',
        ],
        [
            'old' => '鄕',
            'new' => '郷',
        ],
        [
            'old' => '敕',
            'new' => '勅',
        ],
        [
            'old' => '霸',
            'new' => '覇',
        ],
        [
            'old' => '襃',
            'new' => '褒',
        ],
        [
            'old' => '飜',
            'new' => '翻',
        ],
        [
            'old' => '亙',
            'new' => '亘',
        ],
    ];

    foreach ($jitai as $key => $val) {
        $dat = str_replace($val['old'], $val['new'], $dat);
    }


		return $dat;
	}

	function lastcut($dat) {
		$last3=mb_substr($dat,-3);
		$last2=mb_substr($dat,-2);
		$last1=mb_substr($dat,-1);
		if (preg_match ("/ごう室|号しつ/u", $last3)) {$dat = mb_substr($dat, 0, -3);}
		if (preg_match ("/丁目|番地|号室/u", $last2)) {$dat = mb_substr($dat, 0, -2);}
		if (preg_match ("/丁|番|号/u", $last1)) {$dat = mb_substr($dat, 0, -1);}
		return $dat;
	}

	function cut_ho2($dat) {
		$dat = preg_replace ("/番|丁|の/u", "",$dat);
		return $dat;
	}





	function kansuchk($dat) {
		$rec=0;
		$in=$newdat="";
		$tan = ['〇', '一', '二', '三', '四', '五', '六', '七', '八', '九', '十', '百', '千', '万'];
		for ($i=0;$i<mb_strlen($dat,'UTF-8');$i++) {
			$c = mb_substr($dat, $i, 1);
			if (in_array($c, $tan)) {
				$rec=1;
			} else {
				$rec=0;
			}
			if ($rec==1) {
				$in.=$c;
			} else {
				if ($in!="") {$newdat .= $this->kansuu2($in);$in="";}
				$newdat.=$c;
			}
		}
		if ($in!="") $newdat .= $this->kansuu2($in);


		$ptn[0] = '/[0-9]+.*?[0-9]+.*?[0-9]+.*?[0-9]+/';
		$ptn[1] = '/[0-9]+.*?[0-9]+.*?[0-9]+/';
		$ptn[2] = '/[0-9]+.*?[0-9]+/';

		for ($i=0;$i<count($ptn);$i++) {
			if (preg_match( $ptn[$i], $newdat, $matches)) {
				$m = $matches[0];
				$cut= preg_replace ("/番地|丁目|/u", "", $m);
				$newdat = str_replace( $m, $cut,$newdat);
			}
		}
		return $newdat;
	}

		function kansuu2($kanji) {
			//全角＝半角対応表
			$kan_num = array(
				'０' => 0, '〇' => 0,
				'１' => 1, '一' => 1, '壱' => 1,
				'２' => 2, '二' => 2, '弐' => 2,
				'３' => 3, '三' => 3, '参' => 3,
				'４' => 4, '四' => 4,
				'５' => 5, '五' => 5,
				'６' => 6, '六' => 6,
				'７' => 7, '七' => 7,
				'８' => 8, '八' => 8,
				'９' => 9, '九' => 9
			);
			//位取り
			$kan_deci_sub = array('十' => 10, '百' => 100, '千' => 1000);
			$kan_deci = array('万' => 10000, '億' => 100000000, '兆' => 1000000000000, '京' => 10000000000000000);

			//右側から解釈していく
			$ll = mb_strlen($kanji,'UTF-8');
			$a = '';
			$deci = 1;
			$deci_sub = 1;
			$m = 0;
			$n = 0;
			for ($pos = $ll - 1; $pos >= 0; $pos--) {
				$c = mb_substr($kanji, $pos, 1);
				if (isset($kan_num[$c])) {
					$a = $kan_num[$c] . $a;
				} else if (isset($kan_deci_sub[$c])) {
					if ($a != '')	$m = $m + $a * $deci_sub;
					else if ($deci_sub != 1)	$m = $m + $deci_sub;
					$a = '';
					$deci_sub = $kan_deci_sub[$c];
				} else if (isset($kan_deci[$c])) {
					if ($a != '')	$m = $m + $a * $deci_sub;
					else if ($deci_sub != 1)	$m = $m + $deci_sub;
					$n = $m * $deci + $n;
					$m = 0;
					$a = '';
					$deci_sub = 1;
					$deci = $kan_deci[$c];
				}
			}

			$ss = '';
			if (preg_match("/^(0+)/", $a, $regs) != FALSE)	$ss = $regs[1];
			if ($a != '')	$m = $m + $a * $deci_sub;
			else if ($deci_sub != 1)	$m = $m + $deci_sub;
			$dest = $m * $deci + $n;


			return $dest;
		}




























	//IP抜き
	function getip($conf) {
		if ($conf=="ip") {
			$gethost=$_SERVER["REMOTE_ADDR"];
		} elseif ($conf=="host") {
			$gethost = gethostbyaddr($_SERVER['REMOTE_ADDR']);
		} else {
			$ip = getenv("REMOTE_ADDR");
			$host = gethostbyaddr($_SERVER['REMOTE_ADDR']);
			if ($host == null || $host == $ip) $host = gethostbyaddr($ip);
			if ($ip!="" and $host!="") {
				$gethost = $host."(".$ip.")";
			} elseif ($host!="") {
				$gethost = $host;
			} elseif ($ip!="") {
				$gethost = $ip;
			} else {
				$gethost = "";
			}
		}
		return $gethost;
	}

	//ログ生成 (FREEDOM)
	function writelog($secmsg) {
		$logfile = LOGDIR."/".date("Ymd").".txt";
		$setlog = date("Y-m-d".$this->youbi(date("w"),1)." H:i:s")."  ".$secmsg."  ".$this->getip('')."\n";
		$syslog = fopen($logfile, "a");
		if (flock($syslog, LOCK_EX)) {
			fwrite($syslog,$setlog);
			flock($syslog, LOCK_UN);
		}
		fclose($syslog);
	}


	//acc
	function goacc($nt) {
		$samp=5;
		setcookie("tt", $nt, time() + 1,"/");
		setcookie("dt", "1", time() + 60*60,"/");
		if ($_COOKIE["tt"]>0) $acl=1;
		if ($_COOKIE["ad"]>0 or $acl=="1") {
			//連打疑い
			$ren=intval($_COOKIE["ad"]);
			$ren++;
			setcookie("ad", $ren, time() + 20,"/");
			$acl=1;
		} else {
			setcookie("ad", "1", time() + $samp,"/");
			$acl=0;
		}

		if ($_COOKIE["dt"]=="1" and $acl!="1" and $this->UserAgent()>0 and $this->crawlimit()!="1") {
		//if (($t+2)/1000<date("U") and $acl!="1" and $this->crawlimit()!="1") {
			return $this->UserAgent();
		} else {
			return false;
		}

	}









	//曜日（conf==1 : テキストのみ）
	var	$youset = array(
			0=>"(日)",
			1=>"(月)",
			2=>"(火)",
			3=>"(水)",
			4=>"(木)",
			5=>"(金)",
			6=>"(土)"
	);
	function youbi($dat,$conf) {
		if (preg_match("/[-]/",$dat)) {
			$d=explode("-",$dat);
			$dat = mktime(0, 0, 0, intval($d[1]), intval($d[2]), intval($d[0]));
			$datcode = date("w",$dat);
		} else {
			$datcode=$dat;
		}
		if ($conf!=1) {
			//RAIJIN-menu用
			if ($datcode==0) $this->youset[$datcode]="<font color='#ff7676'>".$this->youset[$datcode]."</font>";
			if ($datcode==6) $this->youset[$datcode]="<font color='#64a2f0'>".$this->youset[$datcode]."</font>";
		}
		return $this->youset[$datcode];
	}

	//Y-m-d G:i を Uに
	function rtime($dat) {
		$dat=str_replace('/', '-', $dat);
		$d=explode(" ",$dat);
		$ds=explode("-",$d[0]);
		$ts=explode(":",$d[1]);

		return date("U",mktime($ts[0],$ts[1],00,$ds[1],$ds[2],$ds[0]));
	}




	var $craw = array(
		0 => "/googlebot.com/i",

		//10 => "/202.152.120.20/",	//PRH
	);
	function crawlimit() {
		if ($this->getip("ip")==$this->getip("host")) {
			$match = 1;
		} else {
			foreach ($this->craw as $key => $value) {
				if (preg_match($value,$this->getip("ip"))) {
					$match = 1;
				} else {
					if (preg_match($value,$this->getip("host"))) $match = 1;
				}
				if ($match=="1") break;
			}
		}
		return $match;
	}




	//ステータス
	var $devicekind = array(
		1 => 'others',
		2 => 'tablet',
		3 => 'mobile',
	);



	//デバイス分け
	function UserAgent(){
		$this->ua = mb_strtolower($_SERVER['HTTP_USER_AGENT']);
		if(strpos($this->ua,'iphone') !== false){
			$this->device = 3;
		}elseif(strpos($this->ua,'ipod') !== false){
			$this->device = 3;
		}elseif((strpos($this->ua,'android') !== false) && (strpos($this->ua, 'mobile') !== false)){
			$this->device = 3;
		}elseif((strpos($this->ua,'windows') !== false) && (strpos($this->ua, 'phone') !== false)){
			$this->device = 3;
		}elseif((strpos($this->ua,'firefox') !== false) && (strpos($this->ua, 'mobile') !== false)){
			$this->device = 3;
		}elseif(strpos($this->ua,'blackberry') !== false){
			$this->device = 3;
		}elseif(strpos($this->ua,'ipad') !== false){
			$this->device = 2;
		}elseif((strpos($this->ua,'windows') !== false) && (strpos($this->ua, 'touch') !== false && (strpos($this->ua, 'tablet pc') == false))){
			$this->device = 2;
		}elseif((strpos($this->ua,'android') !== false) && (strpos($this->ua, 'mobile') === false)){
			$this->device = 2;
		}elseif((strpos($this->ua,'firefox') !== false) && (strpos($this->ua, 'tablet') !== false)){
			$this->device = 2;
		}elseif((strpos($this->ua,'kindle') !== false) || (strpos($this->ua, 'silk') !== false)){
			$this->device = 2;
		}elseif((strpos($this->ua,'playbook') !== false)){
			$this->device = 2;
		}else{
			$this->device = 1;
		}
		return $this->device;
	}



	//行表示
	var $gyot = array(
		1 => "ア",
		2 => "カ",
		3 => "サ",
		4 => "タ",
		5 => "ナ",
		6 => "ハ",
		7 => "マ",
		8 => "ヤ",
		9 => "ラ",
		10 => "ワ"
	);
	var $gyod = array(
		1 => "[ア-オ]",
		2 => "[カ-コガ-ゴ]",
		3 => "[サ-ソザ-ゾ]",
		4 => "[タ-トダ-ド]",
		5 => "[ナ-ノ]",
		6 => "[ハ-ホバ-ボパ-ポ]",
		7 => "[マ-モ]",
		8 => "[ヤ-ヨ]",
		9 => "[ラ-ロ]",
		10 => "[ワ-ン]"
	);



}


?>