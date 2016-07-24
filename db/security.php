<?php

	function escape($string) {
		return htmlentities(trim($string), ENT_QUOTES, 'UTF-8');
	}

	function val_name($string) {
		if (strlen($string)>2) {
			return array('user'=>escape($string), 'valid'=>true);
		}else{
			return array('user'=>NULL, 'valid'=>false);
		}
	}

	function val_pw_ret_sha1($string) {
		if (strlen($string)>5) {
			return array('pw'=>sha1(escape($string)),'valid'=>true);
		}else{
			return array('pw'=>NULL, 'valid'=>false);
		}
	}

?>