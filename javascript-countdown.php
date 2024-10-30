<?php
 /*
 Plugin Name: Javascript Countdown
 Version:     1.0.0
 Plugin URI:  http://itx-technologies.com/blog/javascript-countdown-wordpress-plugin
 Description: Display a fully customizable Javascript countdown
 Author:      iTx Technologies
 Author URI:  http://itx-technologies.com/
 */
 
 if (!defined('ABSPATH')) die("Aren't you supposed to come here via WP-Admin?");
 
 //Pre-2.6 compatibility
 if ( ! defined( 'WP_CONTENT_URL' ) )
   define( 'WP_CONTENT_URL', get_option( 'siteurl' ) . '/wp-content' );
 if ( ! defined( 'WP_CONTENT_DIR' ) )
   define( 'WP_CONTENT_DIR', ABSPATH . 'wp-content' );
 if ( ! defined( 'WP_PLUGIN_URL' ) )
   define( 'WP_PLUGIN_URL', WP_CONTENT_URL. '/plugins' );
 if ( ! defined( 'WP_PLUGIN_DIR' ) )
   define( 'WP_PLUGIN_DIR', WP_CONTENT_DIR . '/plugins' );
 

function show_countdown () {
   /* Set default value */
   if(!get_option('cdwn_day')) { $def_day = 01;} else { $def_day = get_option('cdwn_day'); }
   if(!get_option('cdwn_month')) { $def_month = 01;} else { $def_month = get_option('cdwn_month'); }
   if(!get_option('cdwn_year')) { $def_year = 2100;} else { $def_year = get_option('cdwn_year'); }
   if(!get_option('cdwn_hour')) { $def_hour = 01;} else { $def_hour = get_option('cdwn_hour'); }
   if(!get_option('cdwn_min')) { $def_min = 01;} else { $def_min = get_option('cdwn_min'); }
   if(!get_option('cdwn_apm')) { $def_apm = 01;} else { $def_apm = get_option('cdwn_apm'); }
   if(!get_option('cdwn_show')) { $def_show = "%%D%% days, %%H%% hours, %%M%% minutes and %%S%% seconds";} 
     else { $def_show = get_option('cdwn_show'); }
   if(!get_option('cdwn_final')) { $def_final = "";} 
     else { $def_final = get_option('cdwn_final'); }
   
   
   $time_n_date = $def_month."/".$def_day."/".$def_year." ".$def_hour.":".$def_min." ".$def_apm;
   echo '<script language="JavaScript">
   DateFinale = "'.$time_n_date.'";
   CouleurBG = "#fff";
   CouleurTexte = "#A30B06";
   CompteurActif = true;
   Interval = -1;
   ZeroDevant = true;
   FormatAffichage = "'.$def_show.'";
   ActionFinale = "'.$def_final.'"</script><br />';

   echo '<script language="JavaScript" src="'.WP_PLUGIN_URL.'/javascript-countdown/js/countdown.js"></script>';
 }

/* Function called to output the menu link */
function cdwn_menu_link() {
  if (function_exists('add_options_page')) {
    $cdwn_page = add_options_page('Javascript Countdown', 'Javascript Countdown', 'administrator', basename(__FILE__), 'cdwn_settings');
  }
}

/* Function that outputs the plugin settings */
function cdwn_settings() {
     ?>
           
     <h2>Javascript Countdown Settings</h2>
     <h4>by <a style="color: #A30B06;" href="http://itx-technologies.com" target="_blank">iTx Technologies</a></h4>
     <div style="float:right;"><?paypal_give();?></div>
     <div style="margin: 20px 0 0 0;">
     
     <!-- Set the date options -->
     <h3 style="color: #A30B06; margin-bottom: 0;">The Final Date</h3>
     <p style="margin:0 0 1em 0;">
     This is where you decide which date the countdown should end.<br /><em><strong>For example:</strong> on October 1st, 2012 at 5:00PM.</em>
     </p>
     <form method="post" action="options.php">
     <? wp_nonce_field('update-options'); ?>
 
     <table width="90%">
     <tr valign="top">
     <th width="150" scope="row">Entrez la date finale:</th>
     
     <!-- Day selection -->
     <th width="50" scope="row">Day:</th>
     <td width="50">
     <select name="cdwn_day" type="text" id="cdwn_day" value="<?php echo get_option('cdwn_day'); ?>" />
     <? for ($i=0; $i<32; $i++) {
	  echo "<option value='".$i."' ";
	  if (get_option('cdwn_day')==$i) {
	       echo ' selected';
	  } // end if
	  
	  echo ">";
	  if($i<10) {echo "0".$i;} else {echo $i;}
	  echo "</option>";
	 } // end for
     ?>
     </select>
     </td>
     
     
     <!-- Month selection -->
     <th width="50" scope="row">Month:</th>
     <td width="50">
     <select name="cdwn_month" id="cdwn_month" />
     <option value='01' <?if (get_option('cdwn_month')=='01') {echo 'selected';}?>>January</option>
     <option value='02' <?if (get_option('cdwn_month')=='02') {echo 'selected';}?>>February</option>
     <option value='03' <?if (get_option('cdwn_month')=='03') {echo 'selected';}?>>March</option>
     <option value='04' <?if (get_option('cdwn_month')=='04') {echo 'selected';}?>>April</option>
     <option value='05' <?if (get_option('cdwn_month')=='05') {echo 'selected';}?>>May</option>
     <option value='06' <?if (get_option('cdwn_month')=='06') {echo 'selected';}?>>June</option>
     <option value='07' <?if (get_option('cdwn_month')=='07') {echo 'selected';}?>>July</option>
     <option value='08' <?if (get_option('cdwn_month')=='08') {echo 'selected';}?>>August</option>
     <option value='09' <?if (get_option('cdwn_month')=='09') {echo 'selected';}?>>September</option>
     <option value='10' <?if (get_option('cdwn_month')=='10') {echo 'selected';}?>>October</option>
     <option value='11' <?if (get_option('cdwn_month')=='11') {echo 'selected';}?>>November</option>
     <option value='12' <?if (get_option('cdwn_month')=='12') {echo 'selected';}?>>December</option>
     </select>
     </td>
     
     <!-- Year input -->
     <th width="50" scope="row">Year:</th>
     <td width="200">
     <input name="cdwn_year" type="text" id="cdwn_year" value="<?php echo get_option('cdwn_year'); ?>" />(eg. 2100)
     </td>
     </tr>
     
     <!-- SELECT TIME -->
     <tr valign="top">
     <th width="150" scope="row">Enter the time:</th>

     <!-- Hour selection -->
     <th width="50" scope="row">Hour:</th>
     <td width="50">
     <select name="cdwn_hour" id="cdwn_hour" />
     <? for ($i=0; $i<13; $i++) {
	  echo "<option value='".$i."' ";
	  if (get_option('cdwn_hour')==$i) {
	       echo ' selected';
	  } // end if
	  
	  echo ">";
	  if($i<10) {echo "0".$i;} else {echo $i;}
	  echo "</option>";
	 } // end for
     ?>
     </select>
     </td>
     
     <!-- Minutes selection -->
     <th width="50" scope="row">Minutes:</th>
     <td width="50">
     <select name="cdwn_min" type="text" id="cdwn_min" value="<?php echo get_option('cdwn_min'); ?>" />
     <? for ($i=0; $i<60; $i++) {
	  echo "<option value='".$i."' ";
	  if (get_option('cdwn_min')==$i) {
	       echo ' selected';
	  } // end if
	  
	  echo ">";
	  if($i<10) {echo "0".$i;} else {echo $i;}
	  echo "</option>";
	 } // end for
     ?>
     </select>
     </td>
     
     <th width="100" scope="row">AM or PM?</th>
     <td width="50">
     <select name="cdwn_apm" type="text" id="cdwn_apm" value="<?php echo get_option('cdwn_apm'); ?>" />
     <option value='AM' <?if (get_option('cdwn_apm')=='AM') {echo 'selected';}?>>AM</option>
     <option value='PM' <?if (get_option('cdwn_apm')=='PM') {echo 'selected';}?>>PM</option>
     </select>
     </td>
     
     </tr>
     
     </table>

     <!-- Update the values -->
     <input type="hidden" name="action" value="update" />
     <input type="hidden" name="page_options" value="cdwn_day,cdwn_month,cdwn_year,cdwn_hour, cdwn_min,cdwn_apm, cdwn_year, cdwn_show, cdwn_final" />

     <p>
     <input type="submit" value="<?php _e('Save Changes'); ?>" />
     </p>


     <!-- Format options -->
     <h3 style="color: #A30B06; margin-bottom: 0;">How to format</h3>
     <p style="margin:0 0 1em 0;">
     Your countdown can be personnalized your own way.  You can output any variable you like in whichever order, and you can even include HTML tags!
     Use the following variables : %%D%% for the days, %%H%% for the hours, %%M%% for the minutes and %%SS%% for the seconds.<br />
     <em><strong>For example:</strong> There are %%D%% days, %%H%% hours, %%M%% minutes and %%S%% seconds before our next event!</em>
     </p>

     <table width="90%">
     <tr valign="top">
     <th width="200" scope="row">Show countdown as:</th>
     <td>
	  <textarea name="cdwn_show" id="cdwn_show" cols="60" row="4" /><?php echo get_option('cdwn_show'); ?></textarea>
     </td>
     </tr>
     </table>
     <p><strong>Note:</strong> You cannot use double quotes " " in your HTML.  Use single quotes ' ' instead.</p>
     <p>
     <input type="submit" value="<?php _e('Save Changes'); ?>" />
     </p>
     
     <!-- Final text option -->
     <h3 style="color: #A30B06; margin-bottom: 0;">Final Text</h3>
     <p style="margin:0 0 1em 0;">
     This text will appear as static text once the countdown has elapsed.  You can put any HTML tags here.  If you don't want any text here, just leave it blank.<br />
     <em><strong>For example:</strong> It's time to party !!!</em>
     </p>

     <table width="90%">
     <tr valign="top">
     <th width="200" scope="row">Final text</th>
     <td>
	  <textarea name="cdwn_final" id="cdwn_final" cols="60" row="4" /><?php echo get_option('cdwn_final'); ?></textarea>
     </td>
     </tr>
     </table>
     
     <p><strong>Note:</strong> You cannot use double quotes " " in your HTML.  Use single quotes ' ' instead.</p>
     <p>
     <input type="submit" value="<?php _e('Save Changes'); ?>" />
     </p>
     
     </form>
     </div>
     
<? 
}

function paypal_give() {
echo '<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="5MTLLW5LKCGEN">
<input type="image" src="https://www.paypal.com/fr_CA/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - la solution de paiement en ligne la plus simple et la plus sécurisée !">
<img alt="" border="0" src="https://www.paypal.com/fr_CA/i/scr/pixel.gif" width="1" height="1">
</form>';

}

/* Create menu item */
if ( is_admin() ){
     add_action('admin_menu', 'cdwn_menu_link');
}
