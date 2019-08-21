<?php

/**
 * The settings of the plugin.
 *
 * @link       http://www.luckyape.com
 * @since      1.0.0
 *
 * @package    La_Footer
 * @subpackage La_Footer/admin
 */

/**
 * Class WordPress_Plugin_Template_Settings
 *
 */
class La_Footer_Admin_Settings {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * This function introduces the theme options into the 'Appearance' menu and into a top-level
	 * 'LA Footer' menu.
	 */
	public function setup_plugin_options_menu() {

		//Add the menu to the Plugins set of menu items
		add_menu_page(
			'LA Footer Options', 					// The title to be displayed in the browser window for this page.
			'Footer',					// The text to be displayed for this menu item
			'manage_options',					// Which type of users can see this menu item
			'la_footer_options',			// The unique ID - that is, the slug - for this menu item
			array( $this, 'render_settings_page_content'),			// The name of the function to call when rendering this menu's page
			'dashicons-editor-insertmore',
			30
		);

	}

	/**
	 * Provides default values for the Display Options.
	 *
	 * @return array
	 */
	public function default_accreditations() {

		$defaults = array(
			'code'		=>	''
		);

		return $defaults;

	}

	/**
	 * Provide default values for the Social Options.
	 *
	 * @return array
	 */
	public function default_social_options() {

		$defaults = array(
			'twitter'		=>	'https://twitter.com/SylviaHotel',
			'facebook'		=>	'https://www.facebook.com/sylviahotelvancouver/',
			'instagram'	=>	'https://www.instagram.com/sylvia_hotel/',
		);

		return  $defaults;

	}

	/**
	 * Provides default values for the Input Options.
	 *
	 * @return array
	 */
	public function default_input_options() {

		$defaults = array(
			'heading'		=>	'A Vancouver Landmark',
			'paragraph'	=>	'Located on English Bay and beside Stanley Park, the hotel offers a unique lodging experience. The Sylvia Hotel prides itself on outstanding service, friendly staff and great value, which is why people continue to visit us year after year.',
			'address'	=>	'1154 Gilford St. on English Bay,\\nVancouver BC V6G 2P6',
            'phone_local'   =>  '604.681.9321',
            'phone_tollfree'   =>  '1-877-681-9321',
		);

		return $defaults;

	}

	/**
	 * Renders a simple page to display for the theme menu defined above.
	 */
	public function render_settings_page_content( $active_tab = '' ) {
		?>
		<!-- Create a header in the default WordPress 'wrap' container -->
		<div class="wrap">

			<h2><?php _e( 'LA Footer Options', 'la-footer' ); ?></h2>
			<?php settings_errors(); ?>

			<?php if( isset( $_GET[ 'tab' ] ) ) {
				$active_tab = $_GET[ 'tab' ];
			} else 
                if( $active_tab == 'accreditations' ) {
                    $active_tab = 'accreditations';
            } else 
                if( $active_tab == 'social_options' ) {
                    $active_tab = 'social_options';
            } else {
				$active_tab = 'fields';
			}// end if/else 
			?>

			<h2 class="nav-tab-wrapper">				
				<a href="?page=la_footer_options&tab=fields" class="nav-tab <?php echo $active_tab == 'fields' ? 'nav-tab-active' : ''; ?>"><?php _e( 'Fields', 'la-footer' ); ?></a>
                <a href="?page=la_footer_options&tab=accreditations" class="nav-tab <?php echo $active_tab == 'accreditations' ? 'nav-tab-active' : ''; ?>"><?php _e( 'Accreditations', 'la-footer' ); ?></a>
				<a href="?page=la_footer_options&tab=social_options" class="nav-tab <?php echo $active_tab == 'social_options' ? 'nav-tab-active' : ''; ?>"><?php _e( 'Social Options', 'la-footer' ); ?></a>

			</h2>

			<form method="post" action="options.php">
				<?php
    
                if( $active_tab == 'accreditations' ) {

                    settings_fields( 'la_footer_accreditations' );
                    do_settings_sections( 'la_footer_accreditations' );

                } else 
	
				if( $active_tab == 'social_options' ) {

					settings_fields( 'la_footer_social_options' );
					do_settings_sections( 'la_footer_social_options' );

				} else {

					settings_fields( 'la_footer_fields' );
					do_settings_sections( 'la_footer_fields' );

				} // end if/else

				submit_button();

				?>
			</form>

		</div><!-- /.wrap -->
	<?php
	}



	/**
	 * This function provides a simple description for the Social Options page.
	 *
	 * It's called from the 'la-footer_theme_initialize_social_options' function by being passed as a parameter
	 * in the add_settings_section function.
	 */
	public function social_options_callback() {
		$options = get_option('la_footer_social_options');
		echo '<p>' . __( 'Provide the URL to the social networks you\'d like to display.', 'la-footer' ) . '</p>';
	} // end general_options_callback

	/**
	 * This function provides a simple description for the Input Examples page.
	 *
	 * It's called from the 'la-footer_theme_initialize_fields_options' function by being passed as a parameter
	 * in the add_settings_section function.
	 */
	public function fields_callback() {
		$options = get_option('la_footer_fields');
		
		echo '<p>' . __( 'Provides examples of the five basic element types.', 'la-footer' ) . '</p>';
	} // end general_options_callback

    /**
     * This function provides a simple description for the Input Examples page.
     *
     * It's called from the 'la-footer_theme_initialize_fields_options' function by being passed as a parameter
     * in the add_settings_section function.
     */
    public function accreditations_callback() {
        $options = get_option('la_footer_accreditations');
        
        echo '<p>' . __( 'HTML fields that accepts code for trackers and accredidations. Only the following tags are currently permitted &lt;script&gt; &lt;img&gt; &lt;a&gt; &lt;div&gt; &lt;ul&gt; &lt;li&gt;', 'la-footer' ) . '</p>';
    } // end general_options_callback


    
	

	/**
	 * Initializes the theme's social options by registering the Sections,
	 * Fields, and Settings.
	 *
	 * This function is registered with the 'admin_init' hook.
	 */
	public function initialize_social_options() {
		delete_option('la_footer_social_options');
		if( false == get_option( 'la_footer_social_options' ) ) {
			$default_array = $this->default_social_options();
			update_option( 'la_footer_social_options', $default_array );
		} // end if

		add_settings_section(
			'social_settings_section',			// ID used to identify this section and with which to register options
			__( 'Social Options', 'la-footer' ),		// Title to be displayed on the administration page
			array( $this, 'social_options_callback'),	// Callback used to render the description of the section
			'la_footer_social_options'		// Page on which to add this section of options
		);

		add_settings_field(
			'twitter',
			'Twitter',
			array( $this, 'twitter_callback'),
			'la_footer_social_options',
			'social_settings_section'
		);

		add_settings_field(
			'facebook',
			'Facebook',
			array( $this, 'facebook_callback'),
			'la_footer_social_options',
			'social_settings_section'
		);

		add_settings_field(
			'instagram',
			'Instagram',
			array( $this, 'instagram_callback'),
			'la_footer_social_options',
			'social_settings_section'
		);

		register_setting(
			'la_footer_social_options',
			'la_footer_social_options',
			array( $this, 'sanitize_social_options')
		);

	}


	/**
	 * Initializes the theme's input example by registering the Sections,
	 * Fields, and Settings. This particular group of options is used to demonstration
	 * validation and sanitization.
	 *
	 * This function is registered with the 'admin_init' hook.
	 */
	public function initialize_fields() {
		//delete_option('la_footer_fields');
		if( false == get_option( 'la_footer_fields' ) ) {
			$default_array = $this->default_input_options();
			update_option( 'la_footer_fields', $default_array );
		} // end if

		add_settings_section(
			'fields_section',
			__( 'Footer Fields', 'la-footer' ),
			array( $this, 'fields_callback'),
			'la_footer_fields'
		);

		add_settings_field(
			'Heading',
			__( 'Heading', 'la-footer' ),
			array( $this, 'heading_callback'),
			'la_footer_fields',
			'fields_section'
		);

		add_settings_field(
			'Paragraph',
			__( 'Paragraph', 'la-footer' ),
			array( $this, 'paragraph_callback'),
			'la_footer_fields',
			'fields_section'
		);
        add_settings_field(
            'Address',
            __( 'Address', 'la-footer' ),
            array( $this, 'address_callback'),
            'la_footer_fields',
            'fields_section'
        );
        add_settings_field(
            'Local Phone',
            __( 'Local Number', 'la-footer' ),
            array( $this, 'phone_local_callback'),
            'la_footer_fields',
            'fields_section'
        );
        add_settings_field(
            'Toll Free Number',
            __( 'Toll Free Number', 'la-footer' ),
            array( $this, 'phone_tollfree_callback'),
            'la_footer_fields',
            'fields_section'
        );
		register_setting(
			'la_footer_fields',
			'la_footer_fields',
			array( $this, 'validate_fields')
		);

	}


    /**
     * Initializes the theme's input example by registering the Sections,
     * Fields, and Settings. This particular group of options is used to demonstration
     * validation and sanitization.
     *
     * This function is registered with the 'admin_init' hook.
     */
    public function initialize_accreditations() {
        //delete_option('la_footer_fields');
        if( false == get_option( 'la_footer_accreditations' ) ) {
            $default_array = $this->default_accreditations();
            update_option( 'la_footer_accreditations', $default_array );
        } // end if

        add_settings_section(
            'accreditations_section',
            __( 'Accreditations', 'la-footer' ),
            array( $this, 'accreditations_callback'),
            'la_footer_accreditations'
        );

        add_settings_field(
            'Code',
            __( 'Code', 'la-footer' ),
            array( $this, 'code_callback'),
            'la_footer_accreditations',
            'accreditations_section'
        );
        register_setting(
            'la_footer_accreditations',
            'la_footer_accreditations',
            array( $this, 'validate_accreditations')
        );

    }

	/**
	 * This function renders the interface elements for toggling the visibility of the header element.
	 *
	 * It accepts an array or arguments and expects the first element in the array to be the description
	 * to be displayed next to the checkbox.
	 */
	public function code_callback($args) {

		// First, we read the options collection
		$options = get_option('la_footer_accreditations');

        $html = "<textarea cols='40' rows='15' name='la_footer_accreditations[code]' id='code'>" . (isset( $options['code'] ) ?  $options['code'] : '') . "</textarea>";
		echo $html;

	} // end toggle_header_callback


	public function twitter_callback() {

		// First, we read the social options collection
		$options = get_option( 'la_footer_social_options' );

		// Next, we need to make sure the element is defined in the options. If not, we'll set an empty string.
		$url = '';
		if( isset( $options['twitter'] ) ) {
			$url = esc_url( $options['twitter'] );
		} // end if

		// Render the output
		echo '<input type="text" id="twitter" name="la_footer_social_options[twitter]" value="' . $url . '" />';

	} // end twitter_callback

	public function facebook_callback() {

		$options = get_option( 'la_footer_social_options' );

		$url = '';
		if( isset( $options['facebook'] ) ) {
			$url = esc_url( $options['facebook'] );
		} // end if

		// Render the output
		echo '<input type="text" id="facebook" name="la_footer_social_options[facebook]" value="' . $url . '" />';

	} // end facebook_callback

	public function instagram_callback() {

		$options = get_option( 'la_footer_social_options' );

		$url = '';
		if( isset( $options['instagram'] ) ) {
			$url = esc_url( $options['instagram'] );
		} // end if

		// Render the output
		echo '<input type="text" id="instagram" name="la_footer_social_options[instagram]" value="' . $url . '" />';

	} // end googleplus_callback

	public function heading_callback() {

		$options = get_option( 'la_footer_fields' );

		// Render the output
		echo '<input type="text" id="heading" name="la_footer_fields[heading]" value="' . $options['heading'] . '" />';

	} // end input_element_callback

	public function paragraph_callback() {

		$options = get_option( 'la_footer_fields' );

		// Render the output
		echo '<textarea id="paragraph" name="la_footer_fields[paragraph]" rows="5" cols="50">' . $options['paragraph'] . '</textarea>';

	} // end textarea_element_callback

    public function address_callback() {

        $options = get_option( 'la_footer_fields' );
        // Render the output
        echo '<textarea id="address" name="la_footer_fields[address]" rows="3" cols="30">' . $options['address'] . '</textarea>';

    } // end textarea_element_callback


    public function phone_local_callback() {

        $options = get_option( 'la_footer_fields' );
        // Render the output
        $html  = '<input type="tel" id="phone_local" name="la_footer_fields[phone_local]" value="'. $options['phone_local'] .'"/>';

        echo $html;
    } // end textarea_element_callback

    public function phone_tollfree_callback() {

        $options = get_option( 'la_footer_fields' );
        // Render the output        
        $html = '<input type="tel" id="phone_tollfree" name="la_footer_fields[phone_tollfree]" value="'. $options['phone_tollfree'] .'"/>';

        echo $html;
    } // end textarea_element_callback


	public function checkbox_element_callback() {

		$options = get_option( 'la_footer_fields' );

		$html = '<input type="checkbox" id="checkbox_example" name="la_footer_fields[checkbox_example]" value="1"' . checked( 1, $options['checkbox_example'], false ) . '/>';
		$html .= '&nbsp;';
		$html .= '<label for="checkbox_example">This is an example of a checkbox</label>';

		echo $html;

	} // end checkbox_element_callback

	public function radio_element_callback() {

		$options = get_option( 'la_footer_fields' );

		$html = '<input type="radio" id="radio_example_one" name="la_footer_fields[radio_example]" value="1"' . checked( 1, $options['radio_example'], false ) . '/>';
		$html .= '&nbsp;';
		$html .= '<label for="radio_example_one">Option One</label>';
		$html .= '&nbsp;';
		$html .= '<input type="radio" id="radio_example_two" name="la_footer_fields[radio_example]" value="2"' . checked( 2, $options['radio_example'], false ) . '/>';
		$html .= '&nbsp;';
		$html .= '<label for="radio_example_two">Option Two</label>';

		echo $html;

	} // end radio_element_callback

	public function select_element_callback() {

		$options = get_option( 'la_footer_fields' );

		$html = '<select id="time_options" name="la_footer_fields[time_options]">';
		$html .= '<option value="default">' . __( 'Select a time option...', 'la-footer' ) . '</option>';
		$html .= '<option value="never"' . selected( $options['time_options'], 'never', false) . '>' . __( 'Never', 'la-footer' ) . '</option>';
		$html .= '<option value="sometimes"' . selected( $options['time_options'], 'sometimes', false) . '>' . __( 'Sometimes', 'la-footer' ) . '</option>';
		$html .= '<option value="always"' . selected( $options['time_options'], 'always', false) . '>' . __( 'Always', 'la-footer' ) . '</option>';	$html .= '</select>';

		echo $html;

	} // end select_element_callback


	/**
	 * Sanitization callback for the social options. Since each of the social options are text inputs,
	 * this function loops through the incoming option and strips all tags and slashes from the value
	 * before serializing it.
	 *
	 * @params	$input	The unsanitized collection of options.
	 *
	 * @returns			The collection of sanitized values.
	 */
	public function sanitize_social_options( $input ) {

		// Define the array for the updated options
		$output = array();

		// Loop through each of the options sanitizing the data
		foreach( $input as $key => $val ) {

			if( isset ( $input[$key] ) ) {
				$output[$key] = esc_url_raw( strip_tags( stripslashes( $input[$key] ) ) );
			} // end if

		} // end foreach

		// Return the new collection
		return apply_filters( 'sanitize_social_options', $output, $input );

	} // end sanitize_social_options

	public function validate_fields( $input ) {

		// Create our array for storing the validated options
		$output = array();

		// Loop through each of the incoming options
		foreach( $input as $key => $value ) {

			// Check to see if the current option has a value. If so, process it.
			if( isset( $input[$key] ) ) {
				$str = $input[ $key ];
			//	$str  = preg_replace("/\r\n|\r/", "<br />", $str );

				// Strip all HTML and PHP tags and properly handle quoted strings
				$output[$key] = strip_tags( stripslashes( $str ), '<br>' );

			} // end if

		} // end foreach

		// Return the array processing any additional functions filtered by this action
		return apply_filters( 'validate_fields', $output, $input );

	} // end validate_fields

    public function validate_accreditations( $input ) {

        // Create our array for storing the validated options
        $output = array();

        // Loop through each of the incoming options
        foreach( $input as $key => $value ) {
            

            // Check to see if the current option has a value. If so, process it.
            if( isset( $input[$key] ) ) {
                $ouput = strip_tags( stripslashes( $input[$key] ), '<script><ul><li><a><div><img>');
                // Strip all HTML and PHP tags and properly handle quoted strings
                $output[$key] = $ouput;

            } // end if

        } // end foreach

        // Return the array processing any additional functions filtered by this action
        return apply_filters( 'validate_fields', $output, $input );

    } // end validate_fields



}