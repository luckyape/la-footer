<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://www.luckyape.com
 * @since      1.0.0
 *
 * @package    La_Footer
 * @subpackage La_Footer/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    La_Footer
 * @subpackage La_Footer/public
 * @author     Devin Vinson <devinvinson@gmail.com>
 */
class La_Footer_Public {

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->load_dependencies();
	}
	/**
	 * Load the required dependencies for the Admin facing functionality.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - La_Footer_Admin_Settings. Registers the admin settings and page.
	 *
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) .  'public/class-la-footer-settings.php';

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in La_Footer_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The La_Footer_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/la-footer-public.css', array(), $this->version, 'all' );

	}


	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in La_Footer_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The La_Footer_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/la-footer-public.js', array( 'jquery' ), $this->version, false );

	}
	public function custom_nav_menu_items( $items, $menu ){
	  // only add item to a specific menu
	  $options = get_option('la_footer_social_options');

	  if ( $menu->slug == 'social-links' ){

	    for ($i =0; $i < count($items); $i++) {
	    	$item = $items[$i];
	    	if($item->title == 'Facebook') {
	    		$item->url = $options['facebook'];
	    	} else if ($item->title == 'Instagram') {
	    		$item->url = $options['instagram'];
	    	} else if ($item->title == 'Twitter') {
	    		$item->url = $options['twitter'];
	    	}
	    }
	  }	    
	  return $items;
	}
	/**
	 * Simple helper function for make menu item objects
	 * 
	 * @param $title      - menu item title
	 * @param $url        - menu item url
	 * @param $order      - where the item should appear in the menu
	 * @param int $parent - the item's parent item
	 * @return \stdClass
	 */ 
	private function custom_nav_menu_item( $title, $url, $order, $parent = 0 ){
		  $item = new stdClass();
		  $item->ID = 1000000 + $order + $parent;
		  $item->db_id = $item->ID;
		  $item->title = $title;
		  $item->url = $url;
		  $item->menu_order = $order;
		  $item->menu_item_parent = $parent;
		  $item->type = '';
		  $item->object = '';
		  $item->object_id = '';
		  $item->classes = array();
		  $item->target = '';
		  $item->attr_title = '';
		  $item->description = '';
		  $item->xfn = '';
		  $item->status = '';
		  return $item;
	}
}
