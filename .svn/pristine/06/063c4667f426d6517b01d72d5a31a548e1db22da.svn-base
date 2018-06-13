<html>

<head>
  <title></title>
</head>

<body>

<?php
/*
Plugin Name: My Widget
Plugin URI: http://guff.szub.net/my-widget-example-wordpress-widget
Description: Example sidebar widget. Source sports lots of commenting. Hello World!
Author: Kaf Oseo
Version: Demo
Author URI: http://szub.net

    My Widget is released under the GNU General Public License (GPL)
    http://www.gnu.org/licenses/gpl.txt

    This is a WordPress plugin (http://wordpress.org) and widget
    (http://automattic.com/code/widgets/).
*/

// We're putting the plugin's functions in one big function we then
// call at 'plugins_loaded' (add_action() at bottom) to ensure the
// required Sidebar Widget functions are available.
function widget_mywidget_init() {

    // Check to see required Widget API functions are defined...
    if ( !function_exists('register_sidebar_widget') || !function_exists('register_widget_control') )
        return; // ...and if not, exit gracefully from the script.

    // This function prints the sidebar widget--the cool stuff!
    function widget_mywidget($args) {

        // $args is an array of strings which help your widget
        // conform to the active theme: before_widget, before_title,
        // after_widget, and after_title are the array keys.
        extract($args);

        // Collect our widget's options, or define their defaults.
        $options = get_option('widget_mywidget');
        $title = empty($options['title']) ? 'My Widget' : $options['title'];
        $text = empty($options['text']) ? 'Hello World!' : $options['text'];

         // It's important to use the $before_widget, $before_title,
         // $after_title and $after_widget variables in your output.
        echo $before_widget;
        echo $before_title . $title . $after_title;
        echo $text;
        echo $after_widget;
    }

    // This is the function that outputs the form to let users edit
    // the widget's title and so on. It's an optional feature, but
    // we'll use it because we can!
    function widget_mywidget_control() {

        // Collect our widget's options.
        $options = get_option('widget_mywidget');

        // This is for handing the control form submission.
        if ( $_POST['mywidget-submit'] ) {
            // Clean up control form submission options
            $newoptions['title'] = strip_tags(stripslashes($_POST['mywidget-title']));
            $newoptions['text'] = strip_tags(stripslashes($_POST['mywidget-text']));
        }

        // If original widget options do not match control form
        // submission options, update them.
        if ( $options != $newoptions ) {
            $options = $newoptions;
            update_option('widget_mywidget', $options);
        }

        // Format options as valid HTML. Hey, why not.
        $title = htmlspecialchars($options['title'], ENT_QUOTES);
        $text = htmlspecialchars($options['text'], ENT_QUOTES);

// The HTML below is the control form for editing options.
?>
        <div>
        <label for="mywidget-title" style="line-height:35px;display:block;">Widget title: <input type="text" id="mywidget-title" name="mywidget-title" value="<?php echo $title; ?>" /></label>
        <label for="mywidget-text" style="line-height:35px;display:block;">Widget text: <input type="text" id="mywidget-text" name="mywidget-text" value="<?php echo $text; ?>" /></label>
        <input type="hidden" name="mywidget-submit" id="mywidget-submit" value="1" />
        </div>
    <?php
    // end of widget_mywidget_control()
    }

    // This registers the widget. About time.
    register_sidebar_widget('My Widget', 'widget_mywidget');

    // This registers the (optional!) widget control form.
    register_widget_control('My Widget', 'widget_mywidget_control');
}

// Delays plugin execution until Dynamic Sidebar has loaded first.
add_action('plugins_loaded', 'widget_mywidget_init');
?>
<?php

?>

</body>

</html>