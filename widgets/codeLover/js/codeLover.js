jQuery.markitupCodeLover = function() {
	jQuery('.codeLovertextarea').markItUp(myCodeLoverSettings);
}

jQuery(document).ready(function()    {
	jQuery.markitupCodeLover();
});

jQuery(document).ajaxSuccess(function(e, x, o){
	if(o.data && o.data.indexOf('id_base=codelover') > -1){
		window.setTimeout( function(){
		   jQuery(".codeLovertextarea").each(function () {
		      if (!(jQuery(this).hasClass('markItUpEditor'))) {
		          jQuery(this).markItUp(myCodeLoverSettings);
		      }
		    });
		 }, 200 );
    }
});