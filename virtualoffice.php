<?php
/**
 * plugin name: virutal office
 * description: virtual test plugin
 * author: miron meah
 * version: 0.1
 * license: GPL2 * 
 */
// MRN - Tutorial Source: https://www.youtube.com/watch?v=_Sxuh_M1Hbc
 //don't call the file directly
 if(!defined('ABSPATH')) exit;

 function virtualoffice( $atts, $content ){
    wp_enqueue_style( 'mrn-form',     "bootstrap.min.css", array(), 'virtualoffice', 'all' );
     $atts = shortcode_atts( array(
         'email' => get_option('admin_email'),
         'submit' => __('Send Email', 'enfold')
     ), $atts);

     $submit = false;
     if( isset( $_POST['virtual_submit'])){
        $submit = true;
        $subject = $_POST['virtual_subject'];
        $name = $_POST['virtual_name'];
        $email = $_POST['virtual_email'];
        $message = $_POST['virtual_message'];

        wp_mail( $atts['email'], $subject, $message);
       
     }

     ob_start();
     ?>

     <?php if( $submit ) { ?>
        <h1><?php _e( 'Email sent successfully', 'enfold'); ?></h1>
    <?php   } ?>
     <form action="" id="virtual_contact" method="post">
        <div class="form-group">
            <label for="name">Name</label>
            <input class="form-control" type="text" name="virtual_name" value="" />
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input class="form-control" type="text" name="virtual_email" value="" />
        </div>
        <div class="form-group">
            <label for="subject">Subject</label>
            <input class="form-control" type="text" name="virtual_subject" value="" />
        </div>
        <div class="form-group">
            <label for="message">Message</label>
            <textarea class="form-control" cols="30" rows="5" name="virtual_message"></textarea>
        </div>
        <div class="form-group">            
            <input class="form-control btn btn-primary" type="submit" name="virtual_submit" value="<?php echo esc_attr( $atts['submit'] );?>">
        </div>
     </form>
     <?php
     return ob_get_clean();
 }

 add_shortcode('virtualshortcode','virtualoffice');

