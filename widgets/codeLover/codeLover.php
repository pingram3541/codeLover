<?php
ob_start();
@session_start();
/********************
* Code Lover Widget *
*********************/
class codeLover extends WP_Widget {

    //Widget construction
    function __construct() {
        $widget_ops = array('classname' => 'widget_text code-lover-widget', 'description' => __('Text, HTML, CSS, PHP, Flash, JavaScript, Shortcodes...whatever!', 'codeLover'));
        parent::__construct('codeLover', __('Code Lover', 'codeLover'), $widget_ops, $control_ops);
        load_plugin_textdomain('codeLover', false, basename( dirname( __FILE__ ) ) . '/languages' );
        // Only do stuff in admin area
        global $pagenow;
        if (( $pagenow == 'admin.php' ) && ($_GET['page'] == 'wonder-layout') && ($_GET['task'] == 'edit') || ( $pagenow == 'widgets.php' ) ) {
            $this->add_hooks();
        }
    }

    //This function is called on the admin widget page and adds the necessary hooks
    function add_hooks() {
        add_action('admin_print_scripts', array(&$this, "load_scripts"));
        add_action('admin_print_styles', array(&$this, 'load_styles'));
    }

    //Loads the necessary javascript files
    function load_scripts() {
        //wp_enqueue_script('media-upload');
        wp_register_script( 'code-lover-markitup-local', get_stylesheet_directory_uri().'/widgets/codeLover/js/codeLover.js', array( 'jquery', 'jquery-ui-core' ) );
        wp_enqueue_script( 'code-lover-markitup-local' );
        wp_localize_script('code-lover-markitup-local', 'wp_urls', array( 'template_dir' => get_stylesheet_directory_uri()));
        wp_register_script( 'code-lover-markitup-js', get_stylesheet_directory_uri().'/widgets/codeLover/js/jquery.markitup.js', array( 'jquery', 'jquery-ui-core' ) );
        wp_enqueue_script( 'code-lover-markitup-js' );
        wp_register_script( 'code-lover-markitup-set', get_stylesheet_directory_uri().'/widgets/codeLover/js/set.js');
        wp_enqueue_script( 'code-lover-markitup-set' );
        wp_localize_script('code-lover-markitup-set', 'wp_urls', array( 'template_dir' => get_stylesheet_directory_uri()));
    }

    //Loads the necessary stylesheet files
    function load_styles() {
        //wp_enqueue_style('thickbox');
        wp_enqueue_style('code-lover-markitup-css', get_stylesheet_directory_uri().'/widgets/codeLover/css/style.css');
        wp_enqueue_style('code-lover-markitup-set-css', get_stylesheet_directory_uri().'/widgets/codeLover/css/set.css');
    }

    //Setup the widget output
    function widget( $args, $instance ) {
        $cache = wp_cache_get('codeLover', 'widget');

        if (!is_array($cache)) {
          $cache = array();
        }

        if (!isset($args['widget_id'])) {
          $args['widget_id'] = null;
        }

        if (isset($cache[$args['widget_id']])) {
          echo $cache[$args['widget_id']];
          return;
        }

        ob_start();
        extract($args);

        $title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance);
        $text = apply_filters('widget_text', $instance['text'], $instance);
        $previewUrl = apply_filters('widget_previewUrl', empty($instance['previewUrl']) ? '' : $instance['previewUrl'], $instance);
        $notes = apply_filters('widget_text', $instance['notes'], $instance);

        //the widget main content
        ob_start();
        eval('?>' . $text);
        $text = ob_get_contents();
        ob_end_clean();
        if(text){
            echo $text;
        }

        $cache[$args['widget_id']] = ob_get_flush();
        wp_cache_set('codeLover', $cache, 'widget');
    }

    //Run on widget update
    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;

        $instance['title'] = strip_tags($new_instance['title']);

        if ( current_user_can('unfiltered_html') )
            $instance['text'] =  $new_instance['text'];
        else
        $instance['text'] = wp_filter_post_kses($new_instance['text']);

        if ( current_user_can('unfiltered_html') )
            $instance['previewUrl'] =  $new_instance['previewUrl'];
        else
        $instance['previewUrl'] = wp_filter_post_kses($new_instance['previewUrl']);
        //url to get scripts and styles for preview
        global $preview_url;
        $preview_url = $new_instance['previewUrl'];
        $_SESSION['previewUrl']=$preview_url;

        if ( current_user_can('unfiltered_html') )
            $instance['notes'] =  $new_instance['notes'];
        else
        $instance['notes'] = wp_filter_post_kses($new_instance['notes']);

        $this->flush_widget_cache();

        $alloptions = wp_cache_get('alloptions', 'options');

        if (isset($alloptions['codeLover'])) {
          delete_option('codeLover');
        }
        return $instance;
    }

    //Flush widget cache
    function flush_widget_cache() {
        wp_cache_delete('codeLover', 'widget');
    }

    //Setup the widget admin form
    function form( $instance ) {
        $instance = wp_parse_args( (array) $instance, array(
            'title' => '',
            'text' => '',
            'previewUrl' => '',
            'notes' => ''
        ));
        $title = $instance['title'];
        $text = format_to_edit($instance['text']);
        $previewUrl = format_to_edit($instance['previewUrl']);
        $notes = format_to_edit($instance['notes']);
?>
        <style>
            .monospace { font-family: Consolas, Lucida Console, monospace; }
        </style>

        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Label', 'codeLover'); ?>:</label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('text'); ?>"><?php _e('Text, HTML, CSS, PHP, Flash, JavaScript, Shortcodes...whatever!', 'codeLover'); ?>:</label>
            <textarea class="widefat monospace codeLovertextarea" rows="16" cols="20" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>"><?php echo $text; ?></textarea>
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('previewUrl'); ?>"><?php _e('Scripts and Styles Preview Url (i.e. http://www.somesite.com/ - url so preview renders properly - defaults to base wp url)', 'codeLover'); ?>:</label>
            <input class="widefat codeLoverurl" id="<?php echo $this->get_field_id('previewUrl'); ?>" name="<?php echo $this->get_field_name('previewUrl'); ?>" type="text" value="<?php echo $previewUrl;?>" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('notes'); ?>"><?php _e('Notes', 'codeLover'); ?>:</label>
            <textarea class="widefat monospace codeLovernotes" rows="16" cols="20" id="<?php echo $this->get_field_id('notes'); ?>" name="<?php echo $this->get_field_name('notes'); ?>"><?php echo $notes; ?></textarea>
        </p>
<?php
    }
}

//Register the widget
function code_lover_widget_init() {
    register_widget('codeLover');
}

add_action('widgets_init', 'code_lover_widget_init');

//end Custom HTML Content Widget