<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       www.avdude.com
 * @since      1.0.0
 *
 * @package    Uxc_Study_Request
 * @subpackage Uxc_Study_Request/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Uxc_Study_Request
 * @subpackage Uxc_Study_Request/public
 * @author     David Fleming <consultant@avdude.com>
 */
class Uxc_Study_Request_Public {

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
  	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0word
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Uxc_Study_Request_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Uxc_Study_Request_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/uxc-study-request-public.css', array(), $this->version, 'all' );
        //wp_enqueue_style( $this->plugin_name.'-jquery', plugin_dir_url( __FILE__ ) . 'css/uxc-study-request-jquery-ui.css', array(), $this->version, 'all' );
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Uxc_Study_Request_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Uxc_Study_Request_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/uxc-study-request-public.js', array( 'jquery' ), $this->version, false );
        wp_enqueue_script( $this->plugin_name.'-validate', plugin_dir_url( __FILE__ ) . 'js/jquery.validate.min.js' ,array( 'jquery'), $this->version, false );
       

	}
    private function load_dependencies() {
		/**
		 * These classes are responsible for supporting all actions that occur in the event admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . '/partials/uxc-study-request-listtable.php';
        
		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		//$this->loader = new Event_Registration_Loader();

	}
    public function new_study_form_function( $atts ) {
 
        //extract(shortcode_atts(array('event_id' => 'No ID Supplied'), $atts));
        //$id = "{$event_id}";
    	ob_start();
        $this->new_study_page();
        $buffer = ob_get_contents();
        ob_end_clean();
        return $buffer;
    }
    public function get_alias(){
         $user_chunks = explode("\\",strtoupper(getenv("REMOTE_USER")));
         $user_domain = $user_chunks[0];
         $user_name = $user_chunks[1];
         return $user_name;
    }
    public function get_columns(){
        $columns = array(
            'cb'                => '<input type="checkbox" />', //Render a checkbox instead of text
            'study_name'        => 'Study Name',
            'start'             => 'Start Date',
            'end'               => 'End Date',
            'costcenter'        => 'Cost Center',
            'researcher'        => 'Primary Researcher',
            'requestdate'         => 'Date Requested'
            
            
        );
        return $columns;
    }

    public function post_checkbox($value){
                if(isset($_POST[$value]) && 
                   $_POST[$value] == $value) 
                {
                    return  "Y";
                }
                else
                {
                    return "N";
                }    
            }
    public function download($fileinfo)
        {
        	//$file = base64_decode($fileinfo['screener']);
            $file = $fileinfo['screener'];
        	//header_remove();
            //header("Cache-Control: no-cache private");
        	header("Content-Description: File Transfer");
        	
           //	header('Content-disposition: attachment; filename="test.xls');
        //	header("Content-Type: application/vnd.ms-excel");
        	//header("Content-Transfer-Encoding: binary");
        	header('Content-Length: '. strlen($file));
            
               header('Content-disposition: attachment; filename='.$fileinfo['screener_name']); 
                header("Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, charset=utf-8;");
                header("Content-Type: application/vnd.ms-excel");
                //('Content-Disposition: attachment; filename="downloaded.pdf"');
                header("Pragma: no-cache"); 
                header("Expires: 0"); 
        	echo stripslashes($file);
        	exit;
        }
    public function new_study_page(){
        $action = $_POST['studyaction'];
        $alias = $this->get_alias();
        switch ($action)
            {
                case "new":
                    include_once 'partials/uxc-study-request-form.php';
                    break;
                
                case "add":
                    //print_r($_POST);
                    if (isset( $_POST['uxc_nonce_field'] ) && wp_verify_nonce( $_POST['uxc_nonce_field'], 'uxc_nonce_action' ) ) {

                        include_once 'partials/uxc-study-request-form-process.php';
                    }
                    else { echo "Your submission failed our security check!";}

                    break;
                case "copy":
                    
                    include_once 'partials/uxc-study-request-form-copy.php';

                    break;
                
                default:
                    ?>
                    <form name="newstudybutton" id="newstudybutton" action="" method="POST">
                    <input name="studyaction" id="studyaction" type="hidden" value="new">
                    <input type="submit" name=myButton value="NEW REQUEST">
                    </form>
                    
                    <?php
                    include_once 'partials/uxc-study-request-list.php';
            }
        
        
    }
    

}
