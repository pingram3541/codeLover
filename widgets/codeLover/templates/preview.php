<?php
$root = realpath($_SERVER["DOCUMENT_ROOT"]);
require("$root/wp-load.php");
$child_url = get_stylesheet_directory_uri();
$child_dir = end((explode('/', $child_url)));
include("$root/wp-content/themes/".$child_dir."/widgets/codeLover/php/geturl.php");
//check if style/script url is valid
$urlregex = "^(https?|ftp)\:\/\/([a-z0-9+!*(),;?&=\$_.-]+(\:[a-z0-9+!*(),;?&=\$_.-]+)?@)?[a-z0-9+\$_-]+(\.[a-z0-9+\$_-]+)*(\:[0-9]{2,5})?(\/([a-z0-9+\$_-]\.?)+)*\/?(\?[a-z+&\$_.-][a-z0-9;:@/&%=+\$_.-]*)?(#[a-z_.-][a-z0-9+\$_.-]*)?\$";
$previewurl=$_SESSION['previewUrl'];
if (eregi($urlregex, $previewurl)) {
	$previewurl=$_SESSION['previewUrl'];
} else {
	$previewurl="http://".$_SERVER["SERVER_NAME"];
}

$html = file_get_html($previewurl);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>codeLover! preview template</title>
<?php
//get all style links from preview url
foreach($html->find('link') as $style)
       echo $style;
//get all script links from preview url
foreach($html->find('script') as $script)
       echo $script;
//clear all preview url data from memory
$html->clear();
unset($html);
?>
<style>
#hidden-content, #hidden-sc {display:none;}
</style>
</head>
<body>
<div id="hidden-content"><!-- content --></div>
<div id="hidden-sc"></div>
<div id="result"></div>
<script>
jQuery(function($){

	//find all shortcodes and wrap them in div class marked
	function shortcodeWrap($el) {
	   $el.contents().each(function () {
	       if (this.nodeType == 3) { // Text only
	           $(this).replaceWith($(this).text()
	               .replace(/\[(.*?)\]/g, '<div class="marked">[$1]</div>'));
	       } else { // Child element
	           shortcodeWrap($(this));
	       }
	   });
	}

	//now let's give them each a mark id with index starting at 1
	function shortcodePack() {
	    var i = 1;
	    $('#hidden-content .marked').each(function(){
	        $(this).attr('mark','marked-'+i);
	        $(this).clone().appendTo('#hidden-sc');
	        //empty the original .marked containers
	        $(this).html("");
	        i++;
	    });
	}

	shortcodeWrap($("body"));
	shortcodePack($("body"));

	var $data = 'd=' + $('#hidden-sc').html(),
		filepath = "<?= get_stylesheet_directory_uri();?>/widgets/codeLover/php/";
	$.ajax({
	    url: filepath+'load.php',
	    type: 'POST',
	    dataType: "html",
	    data: $data,
	    success: function (obj) {
	    	$('#hidden-sc').html("");
	    	$(obj).appendTo('#hidden-sc');

	    	function shortcodeAppend() {
			    $('#hidden-sc .marked').each(function() {
			        var parent = $(this).attr('mark');
			        $(this).appendTo('#hidden-content div[mark='+parent+']');
			        $(this).contents().unwrap();
			    });
			    $('.marked').contents().unwrap();
			}

			shortcodeAppend($("body"));
			$('#hidden-content').contents().appendTo('#result');
	    }
	});
});
</script>
</body>
</html>