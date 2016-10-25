<?php

if(!class_exists('WP_List_Table')){
    require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}

/************************** CREATE A PACKAGE CLASS *****************************
 *******************************************************************************
 * Create a new list table package that extends the core WP_List_Table class.
 * WP_List_Table contains most of the framework for genestart_date the table, but we
 * need to define and override some methods so that our data can be displayed
 * exactly the way we need it to be.
 * 
 * To display this example on a page, you will first need to instantiate the class,
 * then call $yourInstance->prepare_items() to handle any data manipulation, then
 * finally call $yourInstance->display() to render the table to the page.
 */
class Study_Request_List_Table extends WP_List_Table {
    

    /** ************************************************************************
     * REQUIRED. Set up a constructor that references the parent constructor. We 
     * use the parent reference to set some default configs.
     ***************************************************************************/
    public function __construct(){
        global $status, $page;
                
        //Set parent defaults
        parent::__construct( array(
            'singular'  => 'study',     //singular name of the listed records
            'plural'    => 'studies',    //plural name of the listed records
            'ajax'      => false        //does this table support ajax?
        ) );
        
    }


    /** ************************************************************************
     * This method is called when the parent class can't find a method
     * specifically built for a given column. Generally, it's recommended to include
     * one method for each column you want to render, keeping your package class
     * neat and organized. For example, if the class needs to process a column
     * named 'event', it would first see if a method named $this->column_event() 
     * exists - if it does, that method will be used. If it doesn't, this one will
     * be used. Generally, you should try to use custom column methods as much as 
     * possible. 
     * 
     * Since we have defined a column_event() method later on, this method doesn't
     * need to concern itself with any column with a name of 'event'. Instead, it
     * needs to handle everything else.
     * 
     * For more detailed insight into how columns are handled, take a look at 
     * WP_List_Table::single_row_columns()
     * 
     * @param array $item A singular item (one full row's worth of data)
     * @param array $column_name The name/slug of the column to be processed
     * @return string Text or HTML to be placed inside the column <td>
     **************************************************************************/
    public function column_default($item, $column_name){
        switch($column_name){
            case 'start_date':
                return $item[$column_name];
            case 'end_date':
                return $item[$column_name];
            default:
                return print_r($item,true); //Show the whole array for troubleshooting purposes
        }
    }
    /**
	 * Render the checkbox, with associated id for each row, in the column before the 'Event Name' column
	 *
	 * @since  1.0.0
	 */    
    public function column_cb($item){
        return sprintf(
            '<input type="checkbox" name="%1$s[]" value="%2$s" />',
            /*$1%s*/ $this->_args['singular'],  //Let's simply repurpose the table's singular label ("movie")
            /*$2%s*/ $item['id']                //The value of the checkbox should be the record's id
        );
    }
    /**
	 * Render the content for each row in the 'Event Name' column
	 *
	 * @since  1.0.0
	 */
    public function column_event_name($item){
        
        //Build row actions
        $actions = array(
            'edit'      => sprintf('<a href="?page=%s&action=%s&event=%s">Edit</a>',$_REQUEST['page'],'edit',$item['id']),
            'copy'      => sprintf('<a href="?page=%s&action=%s&event=%s">Copy</a>',$_REQUEST['page'],'copy',$item['id']),
            'delete'    => sprintf('<a href="?page=%s&action=%s&event=%s">Delete</a>',$_REQUEST['page'],'delete',$item['id']),
        );
        
        //Return the event contents
        return sprintf('%1$s <span style="color:silver">(id:%2$s)</span>%3$s',
            /*$1%s*/ stripslashes($item['event_name']),
            /*$2%s*/ $item['id'],
            /*$3%s*/ $this->row_actions($actions)
        );
    }
    public function column_event_shortcode($item){
        return sprintf ('[EVR_SINGLE event_id="%s"]',$item['id'] );

    }
    /**
	 * Queries the attendee database and returns number of attendees for current row's event.
	 *
	 * @since  1.0.0
	 */
     public function column_attendee_count($item){
        global $wpdb;
        $number_attendees = $wpdb->get_var($wpdb->prepare("SELECT SUM(quantity) FROM " . get_option('evr_attendee') . " WHERE event_id= %d",$item['id']));
        if ($number_attendees == '' || $number_attendees == 0){ $number_attendees = '0'; }
        if ($item['reg_limit'] == "" || $item['reg_limit'] == " "){ $available_spaces = "Unlimited";} else { $available_spaces = $item['reg_limit'];}
        return sprintf ('%s / %s',$number_attendees, $available_spaces );
    }
    /**
	 * Render the content for each row in the 'Location' column
	 *
	 * @since  1.0.0
	 */
    public function column_event_location($item){
        return stripslashes($item['event_location']);
    }
    /** ************************************************************************
     * REQUIRED! This method dictates the table's columns and events. This should
     * return an array where the key is the column slug (and class) and the value 
     * is the column's event text. If you need a checkbox for bulk actions, refer
     * to the $columns array below.
     * 
     * The 'cb' column is treated differently than the rest. If including a checkbox
     * column in your table you must create a column_cb() method. If you don't need
     * bulk actions or checkboxes, simply leave the 'cb' entry out of your array.
     * 
     * @see WP_List_Table::::single_row_columns()
     * @return array An associative array containing column information: 'slugs'=>'Visible Events'
     **************************************************************************/
    public function get_columns(){
        $columns = array(
            'cb'                => '<input type="checkbox" />', //Render a checkbox instead of text
            'study_name'        => 'Study Name',
            'start'             => 'Start Date',
            'end'               => 'End Date',
            'costcenter'        => 'Cost Center',
            'study_type'        => 'Study Type',
            'researcher'        => 'Primary Researcher',
            'alternate'         => 'Alternate Researcher'
            
            
        );
        return $columns;
    }

/*
$sql=array( 'alias'=>$alias, 'study_name'=>$study, 'email'=>$email, 'study_type'=>$type, 'costcenter'=>$cost, 
            'start'=>$start, 'end'=>$end, 'researcher'=>$researcher, 'alternate'=>$alternate,
            'profile'=>$profile, 'comments'=>$comments, 'labsetup'=>$labsetup, 'participant_req'=>$partreq,
            'extra_participant'=>$extrapart, 'part_per_session'=>$partpersession, 'participant_bring'=>$participantbring,
            'bring_device'=>$bringdevice, 'setup_time'=>$setuptime, 'doccam'=>$doccam,
            'hardware_req'=>$hardwarereq, 'eyetracker'=>$eyetracker, 'many_pc'=>$manypc);*/
            
    /** ************************************************************************
     * Optional. If you want one or more columns to be sortable (ASC/DESC toggle), 
     * you will need to register it here. This should return an array where the 
     * key is the column that needs to be sortable, and the value is db column to 
     * sort by. Often, the key and value will be the same, but this is not always
     * the case (as the value is a column name from the database, not the list table).
     * 
     * This method merely defines which columns should be sortable and makes them
     * clickable - it does not handle the actual sorting. You still need to detect
     * the ORDERBY and ORDER querystring variables within prepare_items() and sort
     * your data accordingly (usually by modifying your query).
     * 
     * @return array An associative array containing all the columns that should be sortable: 'slugs'=>array('data_values',bool)
     **************************************************************************/
    public function get_sortable_columns() {
        $sortable_columns = array(
            'study_name'     => array('study_name',false),     //true means it's already sorted
            'start'    => array('start',false),
            'end'    => array('end',false),
            'costcenter'  => array('costcenter',false)
        );
        return $sortable_columns;
    }


    /** ************************************************************************
     * Optional. If you need to include bulk actions in your list table, this is
     * the place to define them. Bulk actions are an associative array in the format
     * 'slug'=>'Visible Event'
     * 
     * If this method returns an empty value, no bulk action will be rendered. If
     * you specify any bulk actions, the bulk actions box will be rendered with
     * the table automatically on display().
     * 
     * Also note that list tables are not automatically wrapped in <form> elements,
     * so you will need to create those manually in order for bulk actions to function.
     * 
     * @return array An associative array containing all the bulk actions: 'slugs'=>'Visible Events'
     **************************************************************************/
    public function get_bulk_actions() {
        $actions = array(
           // dont enable at this time to prevent user error
           // 'delete'    => 'Delete'
        );
        return $actions;
    }


    /** ************************************************************************
     * Optional. You can handle your bulk actions anywhere or anyhow you prefer.
     * For this example package, we will handle it in the class to keep things
     * clean and organized.
     * 
     * @see $this->prepare_items()
     **************************************************************************/
    private function process_bulk_action() {
        global $wpdb; //This is used only if making any database queries
        //Detect when a bulk action is being triggered...
        if( 'delete'===$this->current_action() ) {
            //wp_die('Items deleted (or they would be if we had items to delete)!');
            $id = $_REQUEST['id'];
            $sql="DELETE FROM ".get_option('evr_event')." WHERE id=".$event;
                if ($wpdb->query($sql)){
		            $wpdb->query($wpdb->prepare(" DELETE FROM wp_evr_attendee WHERE event_id = %d", $event));
                    $wpdb->query($wpdb->prepare(" DELETE FROM wp_evr_attendee WHERE event_id = %d", $event));
                    ?>
                    <script> alert("<?php _e('There event was successfully deleted.','event-registration'); ?>"); </script>
                    <meta http-equiv="Refresh" content="1; url=?page=events"/>
                    <?php     
                     
            } else 
                { 
                ?>
                <script> alert("<?php _e('There was an error in your submission, please try again. The event was not deleted!','event-registration'); ?>"); </script>
                <meta http-equiv="Refresh" content="1; url=?page=events"/>
                <?php 
                }
            }   
       }
     public function new_event_button(){
             ?>
             <form name="form" method="post" action="<?php echo $_SERVER["REQUEST_URI"]?>">
                                        <input type="hidden" name="action" value="new">
                                        <input class="evr_button evr_add" type="submit" name="new" value="<?php  _e('REQUEST STUDY','uxc-study-request');?>" />
             </form>
             <?php
        }
    /** ************************************************************************
     * REQUIRED! This is where you prepare your data for display. This method will
     * usually be used to query the database, sort and filter the data, and generally
     * get it ready to be displayed. At a minimum, we should set $this->items and
     * $this->set_pagination_args(), although the following properties and methods
     * are frequently interacted with here...
     * 
     * @global WPDB $wpdb
     * @uses $this->_column_headers
     * @uses $this->items
     * @uses $this->get_columns()
     * @uses $this->get_sortable_columns()
     * @uses $this->get_pagenum()
     * @uses $this->set_pagination_args()
     **************************************************************************/
    public function prepare_items() {
        global $wpdb; //This is used only if making any database queries
        /**
         * First, determine how many records per page to show, based on options defined in misc. tab.
         */
        $per_page = 25;
         /**
         * REQUIRED. Now we need to define our column headers. This includes a complete
         * array of columns to be displayed (slugs & events), a list of columns
         * to keep hidden, and a list of columns that are sortable. Each of these
         * can be defined in another method (as we've done here) before being
         * used to build the value for our _column_headers property.
         */
        $columns = $this->get_columns();
        $hidden = array();
        $sortable = $this->get_sortable_columns();
        /**
         * REQUIRED. Finally, we build an array to be used by the class for column 
         * headers. The $this->_column_headers property takes an array which contains
         * 3 other arrays. One for all columns, one for hidden columns, and one
         * for sortable columns.
         */
        $this->_column_headers = array($columns, $hidden, $sortable);
        /**
         * Optional. You can handle your bulk actions however you see fit. In this
         * case, we'll handle them within our package just to keep things clean.
         */
        $this->process_bulk_action();
        /**
         * Query the database, return results in the form of an array.
         */
        $table_name = $wpdb->prefix . "uxc_study_request";
        $data= $wpdb->get_results( "SELECT * FROM $table_name ",ARRAY_A );
        //ORDER BY date(start) DESC
        /**
         * This checks for sorting input and sorts the data in our array accordingly.
         */
        function usort_reorder($a,$b){
            $orderby = (!empty($_REQUEST['orderby'])) ? $_REQUEST['orderby'] : 'id'; //If no sort, default to event
            $order = (!empty($_REQUEST['order'])) ? $_REQUEST['order'] : 'asc'; //If no order, default to asc
            $result = strcmp($a[$orderby], $b[$orderby]); //Determine sort order
            return ($order==='asc') ? $result : -$result; //Send final sort direction to usort
        }
        usort($data, 'usort_reorder');
    
        /**
         * REQUIRED for pagination. 
         */
        $current_page = $this->get_pagenum();
        
        /**
         * REQUIRED for pagination. 
         */
        $total_items = count($data);
        
        
        /**
         * The WP_List_Table class does not handle pagination for us, so we need
         * to ensure that the data is trimmed to only the current page. We can use
         * array_slice() to 
         */
        $data = array_slice($data,(($current_page-1)*$per_page),$per_page);
         /**
         * REQUIRED. Now we can add our *sorted* data to the items property, where 
         * it can be used by the rest of the class.
         */
        $this->items = $data;
       /**
         * REQUIRED. We also have to register our pagination options & calculations.
         */
        $this->set_pagination_args( array(
            'total_items' => $total_items,                  //WE have to calculate the total number of items
            'per_page'    => $per_page,                     //WE have to determine how many items to show on a page
            'total_pages' => ceil($total_items/$per_page)   //WE have to calculate the total number of pages
        ) );
    }


public function evr_prep_content($content='') {
    return wpautop(stripslashes_deep(html_entity_decode($content, ENT_QUOTES, "UTF-8")));
}
}
