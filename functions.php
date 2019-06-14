<?php
//Child Theme Functions File

add_action( 'wp_enqueue_scripts', 'enqueue_wp_child_theme' );

function enqueue_wp_child_theme() 
{
    if((esc_attr(get_option('childthemewpdotcom_setting_4')) != "No")) 
    {
	   wp_enqueue_style('parent-css', get_template_directory_uri().'/style.css' );
    }

	wp_enqueue_style('child-css', get_stylesheet_uri());

	wp_enqueue_script('child-js', get_stylesheet_directory_uri() . '/js/script.js', array( 'jquery' ), '1.0', true );
}
 

// ChildThemWP.com Settings 

function childthemewpdotcom_register_settings() 
{ 
	register_setting( 'childthemewpdotcom_theme_options_group', 'childthemewpdotcom_setting_1', 'ctwp_callback' );
	register_setting( 'childthemewpdotcom_theme_options_group', 'childthemewpdotcom_setting_2', 'ctwp_callback' );
	register_setting( 'childthemewpdotcom_theme_options_group', 'childthemewpdotcom_setting_3', 'ctwp_callback' );
	register_setting( 'childthemewpdotcom_theme_options_group', 'childthemewpdotcom_setting_4', 'ctwp_callback' );
  register_setting( 'childthemewpdotcom_theme_options_group', 'childthemewpdotcom_setting_5', 'ctwp_callback' );
}
add_action( 'admin_init', 'childthemewpdotcom_register_settings' );

function childthemewpdotcom_register_options_page() 
{
	add_options_page('Child Theme Settings', 'My Child Theme', 'manage_options', 'childthemewpdotcom', 'childthemewpdotcom_theme_options_page');
}
add_action('admin_menu', 'childthemewpdotcom_register_options_page');

function childthemewpdotcom_theme_options_page()
{ 
?>
<div>
	<style>
		table.childthemewpdotcom {table-layout: fixed ;  width: 100%; vertical-align:top; }
		table.childthemewpdotcom td { width:50%; vertical-align:top; padding:0px 20px; }
		#childthemewpdotcom_settings { padding:0px 20px; }
	</style> 
	<div id="childthemewpdotcom_settings">
		<h1>Child Theme Options</h1>
	</div>
	<table class="childthemewpdotcom">
		<tr>
			<td>
                <form method="post" action="options.php">
					<?php settings_fields( 'childthemewpdotcom_theme_options_group' ); ?>
                <h2>Parent Stylesheet</h2>
                <?php settings_fields( 'childthemewpdotcom_theme_options_group' ); ?>
					<p><label><input size="76" type="checkbox" name="childthemewpdotcom_setting_14" id="childthemewpdotcom_setting_4" <?php if((esc_attr(get_option('childthemewpdotcom_setting_4')) == "Yes")) { echo ' checked="checked" '; } ?> value='Yes' > 
						Check To Disable The Parent Stylesheet style.css In Child Theme.<br><br>
                        Tick This Box If When You Inspect Your Source Code It Contains Your Parent Stylesheet style.css Two Times. Ticking This Box Will Only Include It Once.</label></p>
                <hr>
				<h2>Enable/Disable Footer Link</h2>
				<h4>Disable Footer Link</h4>
				
					<p><label><input size="76" type="checkbox" name="childthemewpdotcom_setting_1" id="childthemewpdotcom_setting_1" <?php if((esc_attr(get_option('childthemewpdotcom_setting_1')) == "Yes")) { echo ' checked="checked" '; } ?> value='Yes' > 
						Check To Disable The ChildThemeWP.com Link In The Footer</label></p>
					<hr>
					<h2>Style Footer Link</h2>
					<h4>Footer Link Hex Color (Default: #000000)</h4>
					<p><label><input type="text" name="childthemewpdotcom_setting_2" id="childthemewpdotcom_setting_2" value="<?php if((esc_attr(get_option('childthemewpdotcom_setting_2')) != "")) { echo esc_attr(get_option('childthemewpdotcom_setting_2'));  } else { echo "#000000"; } ?>" placeholder="#000000" ></label></p>
					<h4>Footer Link Alignment (Default: Center)</h4>
					<p><label><select type="text" name="childthemewpdotcom_setting_3" id="childthemewpdotcom_setting_3">
						<option selected="selected"><?php if((get_option('childthemewpdotcom_setting_3') != "")) { echo esc_attr(get_option('childthemewpdotcom_setting_3')); } else { echo "Center"; } ?></option>
						<option>Left</option>
						<option>Center</option>
						<option>Right</option>
						</select></label>
					</p>
					<h4>Footer Link Size</h4>
					<p><label><select type="text" name="childthemewpdotcom_setting_4" id="childthemewpdotcom_setting_4">
						<option selected="selected"><?php if((get_option('childthemewpdotcom_setting_4') != "")) { echo esc_attr(get_option('childthemewpdotcom_setting_4'));  } else { echo "12px"; } ?></option>
						<option>9px</option>
						<option>10px</option>
						<option>11px</option>
						<option>12px</option>
						<option>13px</option>
						<option>14px</option>
						<option>15px</option>
						<option>20px</option>
						</select></label>
					</p>
					<?php submit_button(); ?>
				</form>	
			</td>
			<td>
				<h2>Confirm your child theme works</h2>
				<h4>Does your child theme work?</h4>
				<p>
				<a href="./options-general.php?page=childthemewpdotcom&childthemewpconfirm=Yes">Yes my child theme works</a><br>
				<a href="./options-general.php?page=childthemewpdotcom&childthemewpconfirm=No">No my child theme does not work</a><br>
				<?php
 				$problem = "";
				global $wpdb;
				$table_name = esc_attr($wpdb->prefix.'childthemewp');
				$childthemeconfirmed = $wpdb->get_results("SELECT datavalue FROM $table_name ORDER BY id DESC LIMIT 1");
                ?>
                <br>You previously answered: <strong>
                <?php
                $dbanswer = esc_attr($childthemeconfirmed[0]->datavalue);
 
				if($dbanswer != "")
				{
					if($dbanswer == "Yes")
					{
                        ?>
                        <strong style="color:green">YES IT WORKS!</strong>
                        <?php
					}
					else
					{
						$problem ="flag";
						?>
                        <strong style="color:red">NO THERE'S A PROBLEM</strong>
                        <?php
					}
				}
				else
				{
					?>
                    <strong style="color:red">? NOT ANSWERED PLEASE ANSWER ?</strong>
                    <?php
				} 
				?></strong></p>
				<p>Your answer is important because it helps us to keep our child theme library up to date and bug free for the WordPress community to use.</p>
				<hr>
				<?php
				if($problem == "flag")
				{
                    ?>
					<h2>Report a bug</h2>
					<h4 style='color:red'>Please report your problem in more details using this link</h4>
					<p><a href="https://childthemewp.com/ask-a-question/" target="_blank">Report your bug using this form</a></p>	
                    <p>We can only fix bugs if you share more information with us. Please complete the form above so that we can assist you and other WordPress users.</p>
                    <?php
				}
				else
				{
                    ?>
					<h2>Suggest improvements</h2>
					<h4>Suggest a child theme improvement using the form below</h4>
					<p><a href="https://childthemewp.com/ask-a-question/" target="_blank">Suggest an improvement</a></p>
                    <p>Your feedback is valuable because it helps us to improve our platform for other WordPress users.</p>
                    <?php
				}
				?>
                <hr> 
               
				<h2>Say thanks!</h2>
                <p><strong>Buy Ben a coffee to say thank you for making your child theme!</strong><br><br>
                <a href="https://www.buymeacoffee.com/bennyboyworld" target="_blank">Buy Ben a Coffee</a><br>
			</td>
		</tr>
	</table>
</div>
<?php
} 

function childthemewpdotcom_footerlink() 
{
    $footerhtml = "";
    
	if((is_home()) || (is_front_page()))
	{
		if(esc_attr(get_option('childthemewpdotcom_setting_1')) != "Yes")
		{
			$color = esc_attr(get_option('childthemewpdotcom_setting_2'));
			$align = esc_attr(get_option('childthemewpdotcom_setting_3'));
			$size = esc_attr(get_option('childthemewpdotcom_setting_4'));

			if($color == ""){ $color="#000000"; }
			if($align == ""){ $align="center"; }
			if($size == ""){ $size="12px"; }
            ?>
			<style>
				#footerlinktochildthemewp_div, 
				#footerlinktochildthemewp_div p, 
				#footerlinktochildthemewp_div p a { font-size:<?php echo esc_attr($size); ?>!important; color:<?php echo esc_attr($color); ?>!important; text-align:<?php echo esc_attr($align); ?>!important; }
			</style>
			<div id="footerlinktochildthemewp_div"><p id="footerlinktochildthemewp_p"><a href="https://childthemewp.com" title="1 of 7,000+ Child themes for WordPress websites" target="_blank" id="footerlinktochildthemewp_a">ChildThemeWP.com</a></p></div>
            <?php
		}
	}
	?>
	<!-- WordPress Child Theme From https://childthemewp.com --> 
	<?php
	
}
add_action( 'wp_footer', 'childthemewpdotcom_footerlink' );


if(is_admin())
{
	/* Table To Log Working/Not Working Answers */
	global $wpdb;
	$table_name = esc_attr($wpdb->prefix.'childthemewp');
	if($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) 
	{
		$charset_collate = esc_attr($wpdb->get_charset_collate());

		$sql = "CREATE TABLE $table_name (
		id mediumint(9) NOT NULL AUTO_INCREMENT,
		datavalue text NOT NULL,
		UNIQUE KEY id (id)
		) $charset_collate;";
		
		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' ); 
		
		dbDelta($sql);
	}
	
	/* Check If Theme Is Working */
	function display_admin_notice() 
	{
        /* Ask The Question: "Does Your Child Theme Work?" To Improve Our Child Theme Library */
		global $wpdb;
		$table_name = esc_attr($wpdb->prefix.'childthemewp');
		$childthemeconfirmed = $wpdb->get_results("SELECT datavalue FROM $table_name ORDER BY id DESC LIMIT 1");
		if(empty($childthemeconfirmed)) 
		{ 
			?>
			<div class="notice notice-success"><p><strong>Message from ChildThemeWP.com:</strong> Confirm your child theme work?
				<a href="./options-general.php?page=childthemewpdotcom&childthemewpconfirm=Yes">Yes my child theme works</a> &nbsp; or &nbsp;
				<a href="./options-general.php?page=childthemewpdotcom&childthemewpconfirm=No">No my child theme does not work</a></p>
			</div>
            <?php
		}
        
        
        /* Save Answer To: "Does Your Child Theme Work?" To Improve Our Child Theme Library */
        if(isset($_GET["childthemewpconfirm"]))
        {
            $safe_childthemewpconfirm = esc_attr($_GET["childthemewpconfirm"]);
            unset($_GET["childthemewpconfirm"]);

            $wpdb->insert('wp_childthemewp', array(
                'id' => '',
                'datavalue' => $safe_childthemewpconfirm
            ));

            if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') 
            {
                $link = "https"; 
            }
            else
            {
                $link = "http"; 
            }
            $link .= "://"; 
            $link .= $_SERVER['HTTP_HOST']; 

            $theme = get_template();

            $query = http_build_query([
             'site' => $link,
             'theme' => $theme
            ]);

            if($safe_childthemewpconfirm == "Yes")
            {
                $type= "success.php?" . $query;
            }
            else
            {
                $type= "fail.php?" . $query;
            }

            /* We Log Answers To "Does Your Child Theme Work?" To Improve Our Child Theme Library */
            $ch = curl_init('https://childthemewp.com/report/' . $type);
            curl_setopt($ch, CURLOPT_TIMEOUT, 5);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 0);
            $data = curl_exec($ch);
            curl_close($ch);
        }
	}
	add_action( 'admin_notices', 'display_admin_notice' );
}

