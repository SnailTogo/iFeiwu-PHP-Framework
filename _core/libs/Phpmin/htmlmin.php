<?php
class HTMLMin
{
	public static function minify($html)
	{
		$html = str_replace("\r\n", '', $html);
		$html = str_replace("\n", '', $html);
		$html = str_replace("\t", '', $html);
		$pattern = array (
				"/> *([^ ]*) *</",
				"/[\s]+/",
				"/<!--[\\w\\W\r\\n]*?-->/",
				"/\" /",
				"/ \"/",
				"'/\*[^*]*\*/'"
		);
		$replace = array (
				">\\1<",
				" ",
				"",
				"\"",
				"\"",
				""
		);
		return preg_replace($pattern, $replace, $html);
	}
}
?>