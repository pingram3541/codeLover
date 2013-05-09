codeLover
=========

wordpress code loving widget - add html, js, php, shortcodes, etc. without wordpress auto formatting

codeLover is a helper widget that I am developing while using the Ultimatum framework for wordpress.  The Ultimatum framework allows for grid based layouts to be assigned to any page/post/blog/taxonomy and/or category pages where every grid section is widgetized.  This allows for full design flexibility, especially when using loop widgets.

The Ultimatum framework is not required to use codeLover.  codeLover is simply a helper widget that allows an advanced text editor textarea that has many built in shortcuts to wrap your code, whether it be html, js, php or even shortcodes.  It also allows a preview function and an area to provide a preview url of which it will extract any scripts or styles linked within the document of the defined url. (uses site root url if left empty)

How to use:

1. Copy the /widgets/ folder to your theme/child-theme directory
2. Add the following to your functions.php:

  $codeLoverwidget = locate_template( 'widgets/codeLover/codeLover.php', TRUE, TRUE );

3. Enjoy!
