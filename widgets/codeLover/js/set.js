// ----------------------------------------------------------------------------// markItUp!// ----------------------------------------------------------------------------// Copyright (C) 2008 Jay Salvat// http://markitup.jaysalvat.com/// ----------------------------------------------------------------------------myCodeLoverSettings = {    nameSpace:       "codeLover", // Useful to prevent multi-instances CSS conflict    onShiftEnter:    {keepDefault:false, replaceWith:'<br />\n'},    onCtrlEnter:     {keepDefault:false, openWith:'\n<p>', closeWith:'</p>\n'},    onTab:           {keepDefault:false, openWith:'     '},    previewTemplatePath: wp_urls.template_dir+'/widgets/codeLover/templates/preview.php',    previewAutoRefresh: true,    markupSet:  [        {   name:'100% Column',                        openBlockWith:'',                        openWith:'<div class="row">\n <div class="span12">\n  ',                        closeWith:'\n </div>\n</div>',                        closeBlockWith:'',                        placeHolder:'',                        multiline:true },        {   name:'50%/50% Column',            openBlockWith:'',                        openWith:'<div class="row">\n <div class="span6">\n  ',                        closeWith:'\n </div>\n <div class="span6">\n  \n </div>\n</div>',                        closeBlockWith:'',                        placeHolder:'',                        multiline:true },        {   name:'25%/75% Column',            openBlockWith:'',                        openWith:'<div class="row">\n <div class="span3">\n  ',                        closeWith:'\n </div>\n <div class="span9">\n  \n </div>\n</div>',                        closeBlockWith:'',                        placeHolder:'',                        multiline:true },        {   name:'75%/25% Column',            openBlockWith:'',                        openWith:'<div class="row">\n <div class="span9">\n  ',                        closeWith:'\n </div>\n <div class="span3">\n  \n </div>\n</div>',                        closeBlockWith:'',                        placeHolder:'',                        multiline:true },        {   name:'33%/66% Column',            openBlockWith:'',                        openWith:'<div class="row">\n <div class="span4">\n  ',                        closeWith:'\n </div>\n <div class="span8">\n  \n </div>\n</div>',                        closeBlockWith:'',                        placeHolder:'',                        multiline:true },        {   name:'66%/33% Column',            openBlockWith:'',                        openWith:'<div class="row">\n <div class="span8">\n  ',                        closeWith:'\n </div>\n <div class="span4">\n  \n </div>\n</div>',                        closeBlockWith:'',                        placeHolder:'',                        multiline:true },                {   name:'33%/33%/33% Column',            openBlockWith:'',                        openWith:'<div class="row">\n <div class="span4">\n  ',                        closeWith:'\n </div>\n <div class="span4">\n  \n </div>\n <div class="span4">\n  \n </div>\n</div>',                        closeBlockWith:'',                        placeHolder:'',                        multiline:true },                    {   name:'25%/50%/25% Column',            openBlockWith:'',                        openWith:'<div class="row">\n <div class="span3">\n  ',                        closeWith:'\n </div>\n <div class="span6">\n  \n </div>\n <div class="span3">\n  \n </div>\n</div>',                        closeBlockWith:'',                        placeHolder:'',                        multiline:true },                    {   name:'25%/25%/50% Column',            openBlockWith:'',                        openWith:'<div class="row">\n <div class="span3">\n  ',                        closeWith:'\n </div>\n <div class="span3">\n  \n </div>\n <div class="span6">\n  \n </div>\n</div>',                        closeBlockWith:'',                        placeHolder:'',                        multiline:true },                    {   name:'50%/25%/25% Column',            openBlockWith:'',                        openWith:'<div class="row">\n <div class="span6">\n  ',                        closeWith:'\n </div>\n <div class="span3">\n  \n</div>\n <div class="span3">\n  \n </div>\n</div>',                        closeBlockWith:'',                        placeHolder:'',                        multiline:true },                    {   name:'25% x 4 Column',            openBlockWith:'',                        openWith:'<div class="row">\n <div class="span3">\n  ',                        closeWith:'\n </div>\n <div class="span3">\n  \n</div>\n <div class="span3">\n  \n </div>\n <div class="span3">\n  \n </div>\n</div>',                        closeBlockWith:'',                        placeHolder:'',                        multiline:true },                {   name:'Heading 1',            key:'1',            openWith:'<h1(!( class="[![Class]!]")!)>',            closeWith:'</h1>',            placeHolder:'Your title here...' },        {   name:'Heading 2',            key:'2',            openWith:'<h2(!( class="[![Class]!]")!)>',            closeWith:'</h2>',            placeHolder:'Your title here...' },        {   name:'Heading 3',            key:'3',            openWith:'<h3(!( class="[![Class]!]")!)>',            closeWith:'</h3>',            placeHolder:'Your title here...' },        {   name:'Heading 4',            key:'4',            openWith:'<h4(!( class="[![Class]!]")!)>',            closeWith:'</h4>',            placeHolder:'Your title here...' },        {   name:'Heading 5',            key:'5',            openWith:'<h5(!( class="[![Class]!]")!)>',            closeWith:'</h5>',            placeHolder:'Your title here...' },        {   name:'Heading 6',            key:'6',            openWith:'<h6(!( class="[![Class]!]")!)>',            closeWith:'</h6>',            placeHolder:'Your title here...' },                {   name:'Div',            openWith:'<div(!( class="[![Class]!]")!)>',            closeWith:'</div>'  },                    {   name:'Paragraph',            openWith:'<p(!( class="[![Class]!]")!)>',            closeWith:'</p>'  },                    {   name:'Ul',                    openBlockWith:'',            openWith:'<ul(!( class="[![Class]!]")!)>\n <li>\n  ',            closeWith:'\n </li>\n <li>\n  \n </li>\n <li>\n  \n </li>\n</ul>',                        closeBlockWith:'',                        placeHolder:'',                        multiline:true },        {   name:'Ol',            openBlockWith:'',            openWith:'<ol(!( class="[![Class]!]")!)>\n <li>\n  ',            closeWith:'\n </li>\n <li>\n  \n </li>\n <li>\n  \n </li>\n</ol>',                        closeBlockWith:'',                        placeHolder:'',                        multiline:true },                    {   name:'Picture',            key:'P',            replaceWith:'<img src="[![Source:!:http://]!]" alt="[![Alternative text]!]" />' },        {   name:'Link',            key:'L',            openWith:'<a href="[![Link:!:http://]!]"(!( title="[![Title]!]")!)>',            closeWith:'</a>',            placeHolder:'Your text to link...' },                {   name:'PHP',            openWith:'<?php \n ',            closeWith:'\n?>',                        placeHolder:'//php code here',            multiline:true },                {   name:'Script',            openBlockWith:'',            openWith:'<script>\n (function($){\n  ',            closeWith:' })(jQuery);\n</script>',            closeBlockWith:'',            placeHolder:'//script code here\n',            multiline:true },                    //{   separator:'---------------' },                {   name:'Preview',            call:'preview',            className:'preview' }        //{   name:'Clean',            //replaceWith:function(h) { return h.selection.replace(/<(.*?)>/g, "") } },    ]}