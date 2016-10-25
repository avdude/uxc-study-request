<?php

/**
 * @author David Fleming
 * @copyright 2016
 */
?>
<style>

<style type="text/css">
	.TFtable{
		
		border-collapse:collapse; 
	}
	.TFtable td{ 
		padding:7px; border:#4e95f4 1px solid;
	}
    .TFtable th{ 
		padding:7px; border:#4e95f4 1px solid;
        background: lightgrey;
	}
	/* provide some minimal visual accomodation for IE8 and below */
	.TFtable tr{
		
	}
	/*  Define the background color for all the ODD background rows  */
	.TFtable tr:nth-child(odd){ 
	}
    .datetd {
	   width: 70px;
	}	
	
	/*  Define the background color for all the EVEN background rows  */
	.TFtable tr:nth-child(even){
		background: #dae5f4;
	}
    button {
      display: inline-block;
      width: 70px;
      padding:0;
      font-size: 12px;

      border-radius: 0;
      position: static;
    }

button:focus {
  outline: none
}
</style>


<?php

global $wpdb;
$table_name = $wpdb->prefix . "uxc_study_request";

// this will get the data from your table
$requests = $wpdb->get_results( "SELECT * FROM $table_name WHERE alias = '$alias' ORDER BY id DESC" );
//print_r($this->get_columns());
  
?>
<br />
<table class="wp-list-table widefat fixed posts TFtable">
	<thead>
		<tr>
        <?php 
        foreach($this->get_columns() as $val) {
            echo '<th>'.$val.'</th>';
        } 
        
    
?>
		</tr>
	</thead>
	<tfoot>
		<tr>
        <?php
        foreach($this->get_columns() as $val) {
            echo '<th>'.$val.'</th>';
        }     
?>
		</tr>
	</tfoot>
	<tbody>
		
        <?php 
        if( !empty( $requests ) ) {
            foreach ($requests as $request){
                echo '<tr>';
                echo '<td align="center">';
                echo '<form action="" method="post" >
                   <input type="hidden" name="studyaction" value="copy" />
                   <input type="hidden" name="id" value="'.$request->id.'" />
                   <button type="submit"><i class="fa fa-copy"></i> Copy</button>
                </form>';
                echo '</td>';
               /* echo '<td>'.stripslashes($request->study_name).'<input alt="#TB_inline?height=600&amp;width=950&amp;inlineId=popup'.$request->id.'" 
                title="'.stripslashes($request->study_name).'" class="thickbox" type="button" value="Show Details" /></td>';*/
                echo '<td>'.'<a href="#TB_inline?height=600&amp;width=900&amp;inlineId=popup'.$request->id.'" 
                class="thickbox" title="New Study Request: '.stripslashes($request->study_name).'">'.stripslashes($request->study_name).'</a>'.'</td>';
                echo '<td style="width:100px;">'.$request->start.'</td>';
                echo '<td style="width:100px;">'.$request->end.'</td>';
                echo '<td>'.stripslashes($request->costcenter).'</td>';
                //echo '<td>'.$request->study_type.'</td>';
                echo '<td>'.stripslashes($request->researcher).'</td>';
                 $date = date_create($request->submit_date);
                
                echo '<td>'.date_format($date,"m-d-Y").' at '.date_format($date, "h:i A").'</td>';
                echo '</tr>';
                }
            }
        else {
            ?>
		<tr>
			<td colspan="8"><?php _e('No data found', 'uxc-study-request'); ?></td>
		</tr>
		<?php 
        }
            ?>
		
	</tbody>
</table>
<?php
if( !empty( $requests ) ) {
            foreach ($requests as $request){
                echo '<!-- Start Item -->';
                echo '<div id="popup'.$request->id.'" style="display:none">';
                echo "<div>";
                include "uxc-study-request-popup.php";
                echo $body;
                echo "</div>";
                echo '</div>';
                echo '<!-- End Item -->';
                }
    }
                
?>
<?php

 
    
 /*
//Create an instance of our package class...
    $studies_table = new Study_Request_List_Table();
    //Fetch, prepare, sort, and filter our data...
    $studies_table->prepare_items();
    
    ?>
    <div class="wrap">
        
         <h2><i class="fa fa-calendar"></i>  <?php _e('Study Requests','uxc-study-request');?></h2>

        
        <div style="background:#ECECEC;border:1px solid #CCC;padding:0 10px;margin-top:5px;border-radius:5px;-moz-border-radius:5px;-webkit-border-radius:5px;">
            <p>This page lists alll the events from the events table. Events are sortable by Name, Start Date, End Date, and Location.</p> 
            <p>To Edit or Delete an event, hover over the event name to see the Edit | Delete links. Note: Events that have attendees cannot be deleted, you must delete attendees first.</p>
            <p>To control the number of events listed per page, set the "Events to list per page in admin view" option in the <a href="options-general.php?page=event-registration-options&tab=misc_options">Misc. Settings tab in the Event Registration Options</a></p>
            <p>To create a new event, click here ---></p>
        </div>
        
        <!-- Forms are NOT created automatically, so you need to wrap the table in one to use features like bulk actions -->
        <form id="events-filter" method="get">
            <!-- For plugins, we also need to ensure that the form posts back to our current page -->
            <input type="hidden" name="page" value="<?php echo $_REQUEST['page'] ?>" />
            <!-- Now we can render the completed list table -->
            <?php $studies_table->display() ?>
        </form>
        
    </div>       
*/
?>