<?php /*
Plugin Name: slidtwitfollow
Plugin URI: http://prasanna.freeoda.com/blog/blindx-show
Description:Twitter with slide effects
Author:Prasanna 
Version: 1
Author URI:http://prasanna.freeoda.com/blog/*/

function slidtwitfollow_show(){  
	$twitter_username = get_option('twitter_username');
	$img_siteurl = get_option('siteurl');
	$img_siteurl = $img_siteurl . "/wp-content/plugins/slidetwitfollow/";
?>	
<style>
div.twitter-friends{ }

/*---- Header ----*/
div.tf-header{
	border:silver 1px solid;
	width:200px;
	overflow:hidden;
	margin:0 0 1px 0;
}
div.tf-header img{
	border:silver 1px solid;
	margin:1px;
	float:left;
	width:32px;
	height:32px;
}
div.tf-header h2{
	line-height:32px;
	font-weight:bolder;
	display:block;
	margin:3px;
	padding:0;
	float:left;
	font-size:12px;
}
/*---- Users ----*/
div.tf-users{
	/* fixed height so container will not flicker within transitions 
	height:162px;*/
	width:200px;
	border:silver 1px solid;
	overflow:hidden;
	background-color:#eaeaea;
}
/* user img link*/
div.tf-users a{ 
	display:block;
	float:left;
}
/* user img */
div.tf-users img{ }

/* ---- Info Link ----- */
div.tf-info{
	text-align:right;
	display:none;
}
div.tf-info a{
	text-decoration:none;
	font-size:9px;
	font-weight:bolder;
	color:gray;
	font-family:tahoma;
}
</style>  	
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
<script type="text/javascript" src="http://twitter-friends-widget.googlecode.com/files/jquery.twitter-friends-1.0.min.js"></script>

<div class="twitter-friends" options="{
   username:'<?php echo $twitter_username;?>'
   ,header:'<a href=\'_tp_\'><img src=\'_ti_\'/></a><h2>_fo_ Awesome Follwers!</h2>'
   ,user_animate:'width'
   ,users:50
   ,user_image:32
}"></div>

<?php 
}



function slidtwitfollow_admin_option() 
{
	//include_once("extra.php");
	echo "<div class='wrap'>";
	echo "<h2>"; 
	echo wp_specialchars( "Twitter Slide" ) ; 
	echo "</h2>";
    
	$twitter_username = get_option('twitter_username');
	/*$imght = get_option('imght');
	$imghwt = get_option('imghwt');
	$imgcl = get_option('imgcl');*/
	
	
	if ($_POST['cd_submit']) 
	{
		$twitter_username = stripslashes($_POST['twitter_username']);
		/*$imght = stripslashes($_POST['imght']);
		$imghwt = stripslashes($_POST['imghwt']);
		$imgcl = stripslashes($_POST['imgcl']);*/
		
		update_option('twitter_username', $twitter_username );
		/*update_option('imght', $imght );
		update_option('imghwt', $imghwt );
		update_option('imgcl', $imgcl );*/
	
	}
	?>
   

   
	<form name="cd_form" method="post" action="">
     <input name="hiddenid" type="hidden" id="hiddenid" value="<?php echo $edit_id; ?>">
        <input name="process" type="hidden" id="process" value="<?php echo $process; ?>">
   
	<table width="382" border="0" cellpadding="5" cellspacing="0">
  <tr>
    <td width="169">Twitter Username  </td>
    <td width="203"><input type="text" name="twitter_username" id="twitter_username" value="<?php echo $twitter_username; ?>" /></td>
  </tr>
  <!--<tr>
    <td>Height</td>
    <td><input type="text" name="imght" id="imght"  value="<?php// echo $imght; ?>"/></td>
  </tr>
  <tr>
    <td>Width</td>
    <td><input type="text" name="imghwt" id="imghwt"  value="<?php// echo $imghwt; ?>"/></td>
  </tr>
  <tr>
    <td>Class</td>
    <td><input type="text" name="imgcl" id="imgcl"  value="<?php //echo $imgcl; ?>"/></td>
  </tr>-->
  <tr>
    <td colspan="2" align="center"><input name="cd_submit" id="cd_submit" class="button-primary" value="Submit" type="submit" /></td>
  </tr>
</table>

</form>
<?php
	echo "</div>";
}



function slidtwitfollow_install () 
 {
     add_option('twitter_username', "Mike_More");
	/* add_option('imght', "170px");
	 add_option('imghwt', "160px");
	 add_option('imgcl', ""); */
  
  
  }

function slidtwitfollow_deactivation() 
{
	delete_option('twitter_username');
	/*delete_option('imght');
	delete_option('imghwt');
	delete_option('imgcl');*/

}
function slidtwitfollow_widget($args) 
{
	extract($args);
	echo $before_widget . $before_title;
	echo "Slidetwitter Follow";
	echo $after_title;	
	slidtwitfollow_show();
	echo $after_widget;
}


function slidtwitfollow_control()
{
	echo '<p>Twitter.<br> Goto Twitter Slide.';
	echo ' <a href="options-general.php?page=slidetwitfollow/slidetwitfollow.php">';
	echo 'click here</a></p>';
}


function slidtwitfollow_widget_init() 
{
  	register_sidebar_widget(('Slidetwitter Follow'), 'slidtwitfollow_widget');   
	
	if(function_exists('register_sidebar_widget')) 	
	{
		register_sidebar_widget('Slidetwitter Follow', 'slidtwitfollow_widget');
	}
	
	if(function_exists('register_widget_control')) 	
	{
		register_widget_control(array('Slidetwitter Follow', 'widgets'), 'slidtwitfollow_control');
	} 
}

function slidtwitfollow_add_to_menu() 
{
 add_options_page('Slidetwitter Follow', 'Slidetwitter Follow', 3, __FILE__, 'slidtwitfollow_admin_option' );
}

add_action('admin_menu', 'slidtwitfollow_add_to_menu');
add_action("plugins_loaded", "slidtwitfollow_widget_init");
register_activation_hook(__FILE__, 'slidtwitfollow_install');
register_deactivation_hook(__FILE__, 'slidtwitfollow_deactivation');
add_action('init', 'slidtwitfollow_widget_init');







?>


