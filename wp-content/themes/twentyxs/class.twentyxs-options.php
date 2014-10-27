<?php class TwentyXS_Options {
	
	private $sections;
	private $checkboxes;
	private $settings;
	
	public function __construct() {
		
		// This will keep track of the checkbox options for the validate_settings function.
		$this->checkboxes = array();
		$this->settings = array();
		$this->get_option();
		
		$this->sections['general']      = 'Style Settings';
		$this->sections['additional']      = 'Additional';
		$this->sections['reset']        = 'Reset All Settings';
//		$this->sections['about']        = 'About';
		
		add_action( 'admin_menu', array( &$this, 'add_pages' ) );
		add_action( 'admin_init', array( &$this, 'register_settings' ) );
		
		if ( ! get_option( 'TwentyXS_options' ) )
			$this->initialize_settings();
		
	}
	
	public function add_pages() {
		
		$admin_page = add_theme_page( 'TwentyXS Settings', 'TwentyXS Settings', 'edit_theme_options', 'TwentyXS-options', array( &$this, 'display_page' ) );
		
		add_action( 'admin_print_scripts-' . $admin_page, array( &$this, 'scripts' ) );
		add_action( 'admin_print_styles-' . $admin_page, array( &$this, 'styles' ) );
		
	}
	
	public function create_setting( $args = array() ) {
		
		$defaults = array(
			'id'      => 'default_field',
			'title'   => 'Default Field',
			'desc'    => 'This is a default description.',
			'std'     => '',
			'type'    => 'text',
			'section' => 'general',
			'choices' => array(),
			'class'   => ''
		);
			
		extract( wp_parse_args( $args, $defaults ) );
		
		$field_args = array(
			'type'      => $type,
			'id'        => $id,
			'desc'      => $desc,
			'std'       => $std,
			'choices'   => $choices,
			'label_for' => $id,
			'class'     => $class
		);
		
		if ( $type == 'checkbox' )
			$this->checkboxes[] = $id;
		
		add_settings_field( $id, $title, array( $this, 'display_setting' ), 'TwentyXS-options', $section, $field_args );
	}

	public function display_page() {
		
		echo '<div class="wrap">
	<div class="icon32" id="icon-options-general"></div>
	<h2>' . 'TwentyXS Settings' . '</h2>';
	
		if ( isset( $_GET['settings-updated'] ) && $_GET['settings-updated'] == true )
			echo '<div class="updated fade"><p>' . 'Settings updated.' . '</p></div>';
		
		echo '<div id="content"><form action="options.php" method="post">';
	
		settings_fields( 'TwentyXS_options' );
		echo '<div class="ui-tabs">
			<ul class="ui-tabs-nav">';
		
		foreach ( $this->sections as $section_slug => $section )
			echo '<li><a href="#' . $section_slug . '">' . $section . '</a></li>';
		
		echo '</ul>';
		do_settings_sections( $_GET['page'] );
		
		echo '</div>
		<p class="submit"><input name="Submit" type="submit" class="button-primary" value="' . 'Save Changes' . '" /></p>
		
	</form>';
	echo '<div id="floatleft">';

	echo '<div id="informations"><div id="titel">Infographic</div><div id="text" style="padding:5px 5px 0;"><a href="http://kevinw.de/twentyxs_features.php" target="_blank"><img style="width:160px;height:160px;" src="http://i42.tinypic.com/2e58e91.jpg"></a></div></div>';
	echo '<div id="informations"><div id="titel">Who am I?</div><div id="text"><img style="padding-left:5px;" src="http://i55.tinypic.com/24ng1dw.jpg" class="profilpic">I am a young student from Germany. I do always give my best, love blogging and enjoy developing this theme.</div></div>';
	echo '<div id="informations"><div id="titel">Like TwentyXS?</div><div id="text"><a href="http://wordpress.org/extend/themes/twentyxs">Give this theme a 5 star rating on WordPress.org.</a><br/></br><a href="http://flattr.com/thing/298774/WordPress-Theme-TwentyXS" target="_blank"><img src="http://api.flattr.com/button/flattr-badge-large.png" alt="Flattr this" title="Flattr this" border="0" /></a><br/><br/><a href="http://kevinw.de/donate/TwentyXS/">Donate</a> via PayPal.</div></div>';
	echo '<div id="informations"><div id="titel">Wishes?</div><div id="text">Any problems, suggestions, questions about TwentyXS or wishes for the next official update of the theme?<br/>Just <a href="http://kevinw.de/kontakt.php" target="_blank">contact me</a>, please.</div></div>';
	echo '<div id="informations"><div id="titel">Future Features</div><div id="text"><ul><li>Social share buttons</li><li>Several font sets</li><li>A cool jQuery slider</li><li>Option for a widened layout</li><li>Responsive Webdesign</li><li>&hellip;</li><li>What You Want!</li></ul></div></div>';
	echo '<div id="informations"><div id="titel">List of Contributors</div><div id="text"><ul><li class="center">steorrah.com made the running!</li></ul>Will you be the next? :-)</div></div>';

	echo '</div></div>';
	
	echo '<script type="text/javascript">
		jQuery(document).ready(function($) {
			var sections = [];';
			
			foreach ( $this->sections as $section_slug => $section )
				echo "sections['$section'] = '$section_slug';";
			
			echo 'var wrapped = $(".wrap h3").wrap("<div class=\"ui-tabs-panel\">");
			wrapped.each(function() {
				$(this).parent().append($(this).parent().nextUntil("div.ui-tabs-panel"));
			});
			$(".ui-tabs-panel").each(function(index) {
				$(this).attr("id", sections[$(this).children("h3").text()]);
				if (index > 0)
					$(this).addClass("ui-tabs-hide");
			});
			$(".ui-tabs").tabs({
				fx: { opacity: "toggle", duration: "fast" }
			});
			
			$("input[type=text], textarea").each(function() {
				if ($(this).val() == $(this).attr("placeholder") || $(this).val() == "")
					$(this).css("color", "#999");
			});
			
			$("input[type=text], textarea").focus(function() {
				if ($(this).val() == $(this).attr("placeholder") || $(this).val() == "") {
					$(this).val("");
					$(this).css("color", "#000");
				}
			}).blur(function() {
				if ($(this).val() == "" || $(this).val() == $(this).attr("placeholder")) {
					$(this).val($(this).attr("placeholder"));
					$(this).css("color", "#999");
				}
			});
			
			$(".wrap h3, .wrap table").show();
			
			// This will make the "warning" checkbox class really stand out when checked.
			// I use it here for the Reset checkbox.
			$(".warning").change(function() {
				if ($(this).is(":checked"))
					$(this).parent().css("background", "#c00").css("color", "#fff").css("fontWeight", "bold");
				else
					$(this).parent().css("background", "none").css("color", "").css("fontWeight", "normal");
			});
			
			// Browser compatibility
			if ($.browser.mozilla) 
			         $("form").attr("autocomplete", "off");
		});
	</script>
</div>';
		
	}
	
	public function display_section() {
		// code
	}

	public function display_about_section() {
		
		// Use this to display an "About" tab. Echo regular HTML here, like so:
		// echo '<p>Copyright 2011 me@example.com</p>';
		
	}
	
	public function display_setting( $args = array() ) {
		
		extract( $args );
		
		$options = get_option( 'TwentyXS_options' );
		
		if ( ! isset( $options[$id] ) && $type != 'checkbox' )
			$options[$id] = $std;
		elseif ( ! isset( $options[$id] ) )
			$options[$id] = 0;
		
		$field_class = '';
		if ( $class != '' )
			$field_class = ' ' . $class;
		
		switch ( $type ) {
			
			case 'heading':
				echo '</td></tr><tr valign="top"><td colspan="2"><h4>' . $desc . '</h4>';
				break;
			
			case 'infotext':
				echo '<span class="description">' . $desc . '</span>';
	break;
			
			case 'checkbox':
				
				echo '<input class="checkbox' . $field_class . '" type="checkbox" id="' . $id . '" name="TwentyXS_options[' . $id . ']" value="1" ' . checked( $options[$id], 1, false ) . ' /> <label for="' . $id . '">' . $desc . '</label>';
			
				break;
			
			case 'select':
				echo '<select class="select' . $field_class . '" name="TwentyXS_options[' . $id . ']">';
				
				foreach ( $choices as $value => $label )
					echo '<option value="' . esc_attr( $value ) . '"' . selected( $options[$id], $value, false ) . '>' . $label . '</option>';
				
				echo '</select>';
				
				if ( $desc != '' )
					echo '<br /><span class="description">' . $desc . '</span>';
				
				break;
			
			case 'radio':
				$i = 0;
				foreach ( $choices as $value => $label ) {
					echo '<input class="radio' . $field_class . '" type="radio" name="TwentyXS_options[' . $id . ']" id="' . $id . $i . '" value="' . esc_attr( $value ) . '" ' . checked( $options[$id], $value, false ) . '> <label for="' . $id . $i . '">' . $label . '</label>';
					if ( $i < count( $options ) - 1 )
						echo '<br />';
					$i++;
				}
				
				if ( $desc != '' )
					echo '<br /><span class="description">' . $desc . '</span>';
				
				break;
		
			case 'textarea':
				echo '<textarea class="' . $field_class . '" id="' . $id . '" name="TwentyXS_options[' . $id . ']" placeholder="' . $std . '" rows="5" cols="30">' . wp_htmledit_pre( $options[$id] ) . '</textarea>';
				
				if ( $desc != '' )
					echo '<br /><span class="description">' . $desc . '</span>';
				
				break;
			
			case 'password':
				echo '<input class="regular-text' . $field_class . '" type="password" id="' . $id . '" name="TwentyXS_options[' . $id . ']" value="' . esc_attr( $options[$id] ) . '" />';
				
				if ( $desc != '' )
					echo '<br /><span class="description">' . $desc . '</span>';
				
				break;
			
			case 'text':
			default:
		 		echo '<input class="regular-text' . $field_class . '" type="text" id="' . $id . '" name="TwentyXS_options[' . $id . ']" placeholder="' . $std . '" value="' . esc_attr( $options[$id] ) . '" />';
		 		
				if ( $desc != '' )
					echo '<br /><span class="description">' . $desc . '</span>';
		 		
		 		break;
		 	
		}
		
	}
	
	public function get_option() {
		
		/* Style (General) Settings
		===========================================*/
		
/********		$this->settings['example_text'] = array(
			'title'   => 'Example Text Input',
			'desc'    => 'This is a description for the text input.',
			'std'     => 'Default value',
			'type'    => 'text',
			'section' => 'general'
		);
********/
/********		$this->settings['example_textarea'] = array(
			'title'   => 'Example Textarea Input',
			'desc'    => 'This is a description for the textarea input.',
			'std'     => 'Default value',
			'type'    => 'textarea',
			'section' => 'general'
		);
********/		
/********	$this->settings['example_heading'] = array(
			'section' => 'general',
			'title'   => '', // Not used for headings.
			'desc'    => 'Example Heading',
			'type'    => 'heading'
		);
********/
/********		$this->settings['info_text'] = array(
			'section' => 'general',
			'title'   => 'Test',
			'desc'    => 'Any problems, suggestions, questions about TwentyXS or wishes for the next official update of the theme?<br/>Just <a href="http://kevinw.de/kontakt.php" target="_blank">contact me</a>, please.',
			'type'    => 'infotext'
		);	
********/
/********		$this->settings['example_radio'] = array(
			'section' => 'general',
			'title'   => 'Example Radio',
			'desc'    => 'This is a description for the radio buttons.',
			'type'    => 'radio',
			'std'     => '',
			'choices' => array(
				'choice1' => 'Choice 1',
				'choice2' => 'Choice 2',
				'choice3' => 'Choice 3'
			)
		);
********/
		
		$this->settings['xs_linkcolour_hover_select'] = array(
			'section' => 'general',
			'title'   => 'Link Colour',
			'desc'    => "Select the colour of the theme&rsquo;s links",
			'type'    => 'select',
			'std'     => '',
			'choices' => array(
				'#024292' => 'Blue (Standard)',
				'#009000' => 'Green',
				'#f66' => 'Red',
				'#ff8000' => 'Orange',
				'#ff1cae' => 'Pink',
				'#cd853f' => 'Brown',
				'#000' => 'Black'
			)
		);

/***			$this->settings['xs_choose_font'] = array(
			'section' => 'general',
			'title'   => 'Choose Font <div id="newred">New!</div><br/><span class="description thin">body, input, textarea, .page-title span, .pingback a.url, h3#comments-title, h3#reply-title, #access .menu, #access div.menu ul, #cancel-comment-reply-link, .form-allowed-tags, #site-info, #site-title, #wp-calendar, .comment-meta, .comment-body tr th, .comment-body thead th, .entry-content label, .entry-content tr th, .entry-content thead th, .entry-meta, .entry-title, .entry-utility, #respond label, .navigation, .page-title, .pingback p, .reply, .widget-title, .wp-caption-text, input[type=submit] { font-family: Verdana, Arial, Helvetica, sans-serif; }</span>',
			'desc'    => '',
			'type'    => 'radio',
			'std'     => 'fontset1',
			'choices' => array(
				'fontset1' => 'Standard',
				'fontset2' => 'font-family: Verdana, Arial, Helvetica, sans-serif;',
				'fontset3' => 'font-family: "Lucida Grande","Lucida Sans Unicode",Helvetica,Arial,Verdana,sans-serif;'
			)
		);
***/
	
		$this->settings['xs_custom_css'] = array(
			'title'   => 'Custom CSS<br/><span class="description thin">Add additional CSS. This should override any other stylesheets.</span>',
			'desc'    => 'For example:<br />#sidewidthl, #sidewidthr {opacity: 1;} // non-transparent sidebars<br />#access .menu > li {margin:0 -3px;} // close Headmost Navigation&rsquo;s gaps',
			'std'     => '',
			'type'    => 'textarea',
			'section' => 'general',
			'class'   => 'code'
		);

	$this->settings['xs_fetching_rss'] = array(
			'section' => 'general',
			'title'   => 'Fetching RSS Badge',
			'desc'    => 'The topmost RSS badge.',
			'type'    => 'checkbox',
			'std'     => 1
		);

	$this->settings['xs_expand_logo'] = array(
			'section' => 'general',
			'title'   => 'Widened Logo',
			'desc'    => 'Expand the width of your logo from 500px to 540px.',
			'type'    => 'checkbox',
			'std'     => 0
		);

/** Option replaced by 'xs_navi_orientation' // will be deleted with one of the next updates 	$this->settings['xs_centre_navi'] = array(
			'section' => 'general',
			'title'   => 'Centred Navigation <div id="newred">Updated</div>',
			'desc'    => 'Centre the headmost navigation below your logo.',
			'type'    => 'checkbox',
			'std'     => 0
		);
**/
			$this->settings['xs_navi_orientation'] = array(
			'section' => 'general',
			'title'   => 'Navigation Alignment <div id="newred">New!</div><br/><span class="description thin">Orientation of the headmost navigation below your logo.</span>',
			'desc'    => '',
			'type'    => 'radio',
			'std'     => 'center',
			'choices' => array(
				'left' => 'Left',
				'center' => 'Center',
				'right' => 'Right'
			)
		);

		$this->settings['xs_show_excerpt'] = array(
			'section' => 'general',
			'title'   => 'Show Excerpt',
			'desc'    => 'Show excerpt (length: 40 words) instead of the hole article on home page.',
			'type'    => 'checkbox',
			'std'     => 0
		);

		$this->settings['xs_post_meta'] = array(
			'section' => 'general',
			'title'   => 'Post Meta',
			'desc'    => 'Show &ldquo;posted on&rdquo; and &ldquo;posted in&rdquo; lines at the top and bottom of each post.',
			'type'    => 'checkbox',
			'std'     => 1 // Set to 1 to be checked by default, 0 to be unchecked by default.
		);

		$this->settings['xs_article_enjoy_rss'] = array(
			'section' => 'general',
			'title'   => 'Enjoy Article Feature',
			'desc'    => 'Display the &ldquo;Enjoy this article?&rdquo; box that recommends to subscribe to rss feed.',
			'type'    => 'checkbox',
			'std'     => 1
		);

		$this->settings['xs_article_comments_bubble'] = array(
			'section' => 'general',
			'title'   => 'Comments Bubble',
			'desc'    => 'Show a speech bubble including the current count of comments per post.',
			'type'    => 'checkbox',
			'std'     => 1
		);

	$this->settings['xs_no_comments'] = array(
			'section' => 'general',
			'title'   => 'Do not display comments',
			'desc'    => 'Check this box if you do not want to show any comments.',
			'type'    => 'checkbox',
			'std'     => 0
		);

	$this->settings['xs_random_posts_box'] = array(
			'section' => 'general',
			'title'   => 'Random Posts Box',
			'desc'    => 'Show a random posts box in footer area.',
			'type'    => 'checkbox',
			'std'     => 1
		);

	$this->settings['xs_search_form'] = array(
			'section' => 'general',
			'title'   => 'Search Field',
			'desc'    => 'Show a search field in footer area.',
			'type'    => 'checkbox',
			'std'     => 1
		);

	$this->settings['xs_jumptotop'] = array(
			'section' => 'general',
			'title'   => '&ldquo;Back to top&rdquo;-Button',
			'desc'    => 'Show a &ldquo;Back to top&rdquo;-link in footer area.',
			'type'    => 'checkbox',
			'std'     => 1
		);

	$this->settings['xs_siteinfo'] = array(
			'section' => 'general',
			'title'   => 'Site Info and Generator',
			'class'   => 'warning',
			'desc'    => "Don&rsquo;t show the theme author&rsquo;s website and WordPress link at the bottom of your blog.<br /><b>I invested countless hours of work</b> in this great theme. It would be very kind of you if you at least link to <a href='http://kevinw.de' target='_blank'>kevinw.de</a> on your about page referring to the theme author.",
			'type'    => 'checkbox',
			'std'     => 0
		);


		/* Additional
		===========================================*/

		$this->settings['xs_header_content'] = array(
			'title'   => 'Header Content<br/><span class="description thin">Everything you paste in this box will be added before the closing &lt;/head&gt;-tag.</span>',
			'desc'    => '',
			'std'     => '',
			'type'    => 'textarea',
			'section' => 'additional',
			'class'   => 'code'
		);

		$this->settings['xs_adsense_code_home'] = array(
			'title'   => 'Ads / Content (home page)  <div id="newred">New!</div><br/><span class="description thin">	
Paste your AdSense code or any other code here. It will be inserted <b>between the third and fourth post</b> within the loop on your home page. Recommended max-width of your output code: 500px.</span>',
			'desc'    => '',
			'std'     => '',
			'type'    => 'textarea',
			'section' => 'additional',
			'class'   => 'code'
		);

		$this->settings['xs_adsense_code_post_top'] = array(
			'title'   => 'Ads (single post)  <div id="newred">New!</div><br/><span class="description thin">	
Paste your AdSense code or any other ad code here. It will be displayed above your articles. Recommended max-width of your advertisement: 500px. In general you can use any ad format you want.</span>',
			'desc'    => '',
			'std'     => '',
			'type'    => 'textarea',
			'section' => 'additional',
			'class'   => 'code'
		);

		$this->settings['xs_ga_code'] = array(
			'title'   => 'Scripts in Footer Area<br/><span class="description thin">E.g. you can paste your <b>Google Analytics</b> or another tracking code in this box and it will be added before the closing &lt;/body&gt;-tag.</span>',
			'desc'    => '',
			'std'     => '',
			'type'    => 'textarea',
			'section' => 'additional',
			'class'   => 'code'
		);

		$this->settings['xs_scroll_script'] = array(
			'section' => 'additional',
			'title'   => 'Scroll Script',
			'desc'    => 'Use this script and whenever you click on &quot;Back to top&quot; or &quot;Reply&quot; (reply on comments) the scrolling will look very cool.',
			'type'    => 'checkbox',
			'std'     => 0
		);

		$this->settings['xs_admin_bar_button'] = array(
			'section' => 'additional',
			'title'   => 'Admin-Bar-Button',
			'desc'    => 'Add a button to link from your admin bar to the TwentyXS Settings page',
			'type'    => 'checkbox',
			'std'     => 1
		);

		$this->settings['xs_snow_script'] = array(
			'section' => 'additional',
			'title'   => 'Snowfall Script <div id="newred" class="grey">X-Mas Special</div>',
			'desc'    => 'Let it snow on your website ;-)',
			'type'    => 'checkbox',
			'std'     => 0
		);

/******** Appearance
		===========================================
		
		$this->settings['header_logo'] = array(
			'section' => 'appearance',
			'title'   => 'Header Logo',
			'desc'    => 'Enter the URL to your logo for the theme header.',
			'type'    => 'text',
			'std'     => ''
		);
		
		$this->settings['favicon'] = array(
			'section' => 'appearance',
			'title'   => __( 'Favicon' ),
			'desc'    => __( 'Enter the URL to your custom favicon. It should be 16x16 pixels in size.' ),
			'type'    => 'text',
			'std'     => ''
		);
************/
				
		/* Reset
		===========================================*/
		
		$this->settings['reset_theme'] = array(
			'section' => 'reset',
			'title'   => 'Reset All Settings',
			'type'    => 'checkbox',
			'std'     => 0,
			'class'   => 'warning', // Custom class for CSS
			'desc'    => 'Check this box and click &ldquo;Save Changes&rdquo; below to reset theme settings to their defaults.'
		);
	
	
	}
	
	public function initialize_settings() {
		
		$default_settings = array();
		foreach ( $this->settings as $id => $setting ) {
			if ( $setting['type'] != 'heading' && $setting['type'] != 'infotext' )
				$default_settings[$id] = $setting['std'];
		}
		
		update_option( 'TwentyXS_options', $default_settings );
		
	}
	
	public function register_settings() {
		
		register_setting( 'TwentyXS_options', 'TwentyXS_options', array ( &$this, 'validate_settings' ) );
		
		foreach ( $this->sections as $slug => $title ) {
			if ( $slug == 'about' )
				add_settings_section( $slug, $title, array( &$this, 'display_about_section' ), 'TwentyXS-options' );
			else
				add_settings_section( $slug, $title, array( &$this, 'display_section' ), 'TwentyXS-options' );
		}
		
		$this->get_option();
		
		foreach ( $this->settings as $id => $setting ) {
			$setting['id'] = $id;
			$this->create_setting( $setting );
		}
		
	}
	
	public function scripts() {
		
		wp_print_scripts( 'jquery-ui-tabs' );
		
	}
	
	public function styles() {
		
		wp_register_style( 'TwentyXS-admin', get_stylesheet_directory_uri() . '/twentyxs-options.css' );
		wp_enqueue_style( 'TwentyXS-admin' );		

	}
	
	public function validate_settings( $input ) {
		
		if ( ! isset( $input['reset_theme'] ) ) {
			$options = get_option( 'TwentyXS_options' );
			
			foreach ( $this->checkboxes as $id ) {
				if ( isset( $options[$id] ) && ! isset( $input[$id] ) )
					unset( $options[$id] );
			}
			
			return $input;
		}
		return false;
		
	}
	
}

$theme_options = new TwentyXS_Options();

function TwentyXS_option( $option ) {
	$options = get_option( 'TwentyXS_options' );
	if ( isset( $options[$option] ) )
		return $options[$option];
	else
		return false;
}

function txs_admin_footer() {
		$donate_url = 'http://kevinw.de/donate/TwentyXS/';
		$colour = '#ff' . dechex(mt_rand(0, 255)) . '00';
		echo 'Hope you enjoy using the theme TwentyXS - <a href="' . $donate_url . '" style="font-weight: bold;color: '.$colour.';" rel="nofollow" title="If you like TwentyXS, why not make a tiny/small/large donation towards its upkeep">all donations welcomed!</a><br/>';
	}
	add_action('in_admin_footer', 'txs_admin_footer');

?>