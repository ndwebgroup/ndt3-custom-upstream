<?php
/**
* Plugin Name: ND Emergency
* Plugin URI: https://marcomm.nd.edu/web/
* Description: Display ND Emergency banner
* Version: 1.0
* Author: Erik Runyon
* Author URI: https://marcomm.nd.edu/web/
* Text Domain: nd-emergency
* License: GPL2
 */

add_action('wp_head', 'add_nd_emergency');
function add_nd_emergency(){
  ?>
<script>var ndn = document.createElement("script");
ndn.async = true; ndn.id = "ndalertbarscript";
ndn.src = "https://emergency.nd.edu/api/alert/";
var s = document.getElementsByTagName("script")[0]; s.parentNode.insertBefore(ndn, s);</script>
  <?php
}

/*
<script>
var ndn = document.createElement("script");
ndn.async = true; ndn.id = "ndalertbarscript";
ndn.src = "https://emergency.nd.edu/api/alert/";
var s = document.getElementsByTagName("script")[0]; s.parentNode.insertBefore(ndn, s);</script>
*/

?>
