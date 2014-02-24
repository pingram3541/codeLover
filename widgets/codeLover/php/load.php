<?php

$root = realpath($_SERVER["DOCUMENT_ROOT"]);
require("$root/wp-load.php");
	$content = $_POST['d'];
	$content = str_replace("\\", "", $content);
	$content = do_shortcode($content);
	echo $content;
?>