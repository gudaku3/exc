
<?php

function multi($text) {
	$target = array('‡Š','‡‹','‡‚','‡q','‡s','‡`','‡l','‡b','‡p','‡@','‡A','‡B','‡C','‡D','‡E','‡F','‡G','‡H','‡I','‡J','‡K','‡L','‡M','‡N','‡O','‡P','‡Q','‡R','‡S','‡T','‡U','‡V','‡W','‡X','‡Y','‡Z','‡[','‡]','‡i');
	$replace = array('iŠ”j','i—Lj','‚m‚','‚‹‚','‚‹‚‡','ƒLƒ','“','‚','‚ƒ‚','‚P','‚Q','‚R','‚S','‚T','‚U','‚V','‚W','‚X','‚P‚O','‚P‚P','‚P‚Q','‚P‚R','‚P‚S','‚P‚T','‚P‚U','‚P‚V','‚P‚W','‚P‚X','‚Q‚O','‚h','‚h‚h','‚h‚h‚h','‚h‚u','‚u','‚u‚h','‚u‚h‚h','‚u‚h‚h‚h','‚w','ƒJƒƒŠ[');
	$new = str_replace($target, $replace, $text);
	return $new;
}


?>
