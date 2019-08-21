<?php

/**
 * The settings of the plugin.
 *
 * @link       http://www.luckyape.com
 * @since      1.0.0
 *
 * @package    La_Footer
 * @subpackage La_Footer/public
 */

/**
 * Class WordPress_Plugin_Template_Settings
 *
 */
class La_Footer_Public_Settings {

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
	 * This function is a callback for la_footer_intro action
	 *
	 */
	public function get_footer_intro() {
		$options = get_option('la_footer_fields');
		$html = '<h2>' . __( $options['heading'], 'la-footer' ) . '</h2>';
		$html .= '<p>' . __( $options['paragraph'], 'la-footer' ) . '</p>';
		echo $html;
	}


	/**
	 *
	 * This function is a callback for la_footer_paragraph action
	 *
	 */
	public function get_footer_tels() {
		$options = get_option('la_footer_fields');
		$html = '<dl>';
		$html .= '<dt>Phone</dt>';
		$html .= '<dd>' .esc_html_x($options['phone_local'], 'la-footer') . '</dd>';
		$html .= '<dt>Toll Free</dt>';
		$html .= '<dd>' .esc_html_x($options['phone_tollfree'], 'la-footer') . '</dd>';
		$html .= '</dl>';
		echo $html;
	}

	/**
	 *
	 * This function is a callback for la_footer_paragraph action
	 *
	 */
	public function get_footer_address() {
		$options = get_option('la_footer_fields');
		//preserve line breaks
		$str  = preg_replace("/\r\n|\r/", "<br />", esc_html_x($options['address'], 'la-footer'));
		$html = '<p>' . $str . '</p>';

		echo $html;
	}

	/**
	 *
	 * This function is a callback for la_footer_paragraph action
	 *
	 */
	public function get_footer_accreditations() {
		$options = get_option('la_footer_accreditations');
		//preserve line breaks
		$html = "<div>" . $options['code'] . "</div>";
		echo $html;
	}	
}