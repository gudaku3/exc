
<?php

function multi($text) {
	$target = array('��','��','��','�q','�s','�`','�l','�b','�p','�@','�A','�B','�C','�D','�E','�F','�G','�H','�I','�J','�K','�L','�M','�N','�O','�P','�Q','�R','�S','�T','�U','�V','�W','�X','�Y','�Z','�[','�]','�i');
	$replace = array('�i���j','�i�L�j','�m��','����','����','�L��','��','��','����','�P','�Q','�R','�S','�T','�U','�V','�W','�X','�P�O','�P�P','�P�Q','�P�R','�P�S','�P�T','�P�U','�P�V','�P�W','�P�X','�Q�O','�h','�h�h','�h�h�h','�h�u','�u','�u�h','�u�h�h','�u�h�h�h','�w','�J�����[');
	$new = str_replace($target, $replace, $text);
	return $new;
}


?>
