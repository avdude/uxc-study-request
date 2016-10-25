<?php

/**
* @author David Fleming
* @copyright 2016
*/
global $wpdb;
//printf("<pre>%s</pre>",print_r($_FILES, true));
//general data

$study = sanitize_text_field( $_POST['studyname'] );
$email = sanitize_email( $_POST['email'] );
//services fields
    $lab = $this->post_checkbox('lab');
    $participants = $this->post_checkbox('participants');
    $waiver = $this->post_checkbox('waiver');
    $gratuity = $this->post_checkbox('gratuity');
    $survey = $this->post_checkbox('survey');
$cost = sanitize_text_field( $_POST['costcenter'] );
$start = sanitize_text_field( $_POST['start'] );
$end = sanitize_text_field( $_POST['end'] );
$researcher = sanitize_text_field( $_POST['researcher'] );
$alternate = sanitize_text_field( $_POST['alternate'] );
//Santize General Comments Text Area:
// $comments = sanitize_text_field( $_POST['generalcomments'] );
//get comments data and put each line into an array
$comments = explode( "\n", (string) $_POST['generalcomments'] );
//santize each line
$comments = array_map( 'sanitize_text_field', (array) $comments );
//return line array into a single string after sanitation
$comments = implode( "\n", $comments );


//participant related fields
$type = sanitize_text_field( $_POST['studytype'] );
$partreq = sanitize_text_field( $_POST['partreq'] );
$extrapart = sanitize_text_field( $_POST['extrapart'] );
//Sanitize profile text area
$profile = sanitize_text_field( $_POST['profile'] );
//get comments data and put each line into an array
$profile = explode( "\n", (string) $_POST['profile'] );
//santize each line
$profile = array_map( 'sanitize_text_field', (array) $profile );
//return line array into a single string after sanitation
$profile = implode( "\n", $profile );



$partpersession = sanitize_text_field( $_POST['partpersession'] );
//get schedule info and put each line into an array
$schedule = explode( "\n", (string) $_POST['sessionschedule'] );
//santize each line
$schedule = array_map( 'sanitize_text_field', (array) $schedule );
//return line array into a single string after sanitation
$schedule = implode( "\n", $schedule );


//$participantbring = sanitize_text_field( $_POST['participantbring'] );
//get schedule info and put each line into an array
$participantbring  = explode( "\n", (string) $_POST['participantbring'] );
//santize each line
$participantbring  = array_map( 'sanitize_text_field', (array) $participantbring  );
//return line array into a single string after sanitation
$participantbring  = implode( "\n", $participantbring  );


$location = sanitize_text_field( $_POST['location'] );

//gratuity related fields
$cardcount = sanitize_text_field( $_POST['cardcount'] );
$cardamount = sanitize_text_field( $_POST['cardamount'] );
$cardadvance = $this->post_checkbox('takenadvance');
//lab realted fields


$manypc = sanitize_text_field( $_POST['manypc'] );
$pcos = sanitize_text_field( $_POST['pcos']);
$bringdevice = sanitize_text_field( $_POST['bringdevice'] );
$setuptime = sanitize_text_field( $_POST['setuptime'] );
$doccam = sanitize_text_field( $_POST['doccam'] );
$eyetracker = sanitize_text_field( $_POST['eyetracker'] );
//get hardware req textarea info and put each line into an array
$hardwarereq = explode( "\n", (string) $_POST['hardwarereq'] );
//santize each line
$hardwarereq= array_map( 'sanitize_text_field', (array) $hardwarereq );
//return line array into a single string after sanitation
$hardwarereq = implode( "\n", $hardwarereq );
//Sanitize $labsetup textarea
//get hardware req textarea info and put each line into an array
$labsetup = explode( "\n", (string) $_POST['labsetup'] );
//santize each line
$labsetup= array_map( 'sanitize_text_field', (array) $labsetup );
//return line array into a single string after sanitation
$labsetup = implode( "\n", $labsetup );
//End input fields
// 30 feilds

$labtype = sanitize_text_field ( $_POST['labtype']);
$lablocation = sanitize_text_field ( $_POST['location']);

$path = "C:\inetpub\wwwroot\screeners";

//File upload
if ($_FILES['screener']['size'] > 0){
        $fileName = $_FILES['screener']['name'];
        $tmpName  = $_FILES['screener']['tmp_name'];
        $fileSize = $_FILES['screener']['size'];
        $fileType = $_FILES['screener']['type'];
        
     /*   $fp      = fopen($tmpName, 'r');
        $screenercontent = fread($fp, filesize($tmpName));
        $screenercontent = addslashes($content);
        fclose($fp);
      */
        $fileName = sanitize_text_field($fileName);
        $screenercontent = file_get_contents($_FILES['screener']['tmp_name']);
       /* 
      if ( move_uploaded_file ($_FILES['screener']['tmp_name'],$path."/{$_FILES['screener']['name']}") ) {
              echo '<P>FILE UPLOADED TO: <a href="http://usable/screeners/'.$_FILES['screener']['name'].'" download >Here</a></P>';
              
           } else {
              echo "<P>MOVE UPLOADED FILE FAILED!</P>";
              print_r(error_get_last());
           }
           */
        
        
} 






$mysqldate = date( 'Y-m-d H:i:s');
//'submit_date'=>current_time('mysql', 1),
$sql=array( 'alias'=>$alias,  'submit_date'=>current_time('mysql', 1),'study_name'=>$study, 'email'=>$email, 'lab'=>$lab,
            'participants'=>$participants,'waiver'=>$waiver,'gratuity'=>$gratuity,'survey'=>$survey,'costcenter'=>$cost, 
            'start'=>$start, 'end'=>$end, 'researcher'=>$researcher, 'alternate'=>$alternate, 'comments'=>$comments,
            'study_type'=>$type, 'participant_req'=>$partreq,'extra_participant'=>$extrapart, 'profile'=>$profile, 'part_per_session'=>$partpersession, 
            'schedule'=>$schedule, 'participant_bring'=>$participantbring,'cardcount'=>$cardcount,'cardamount'=>$cardamount, 'cardadvance'=>$cardadvance,
            'labtype'=>$labtype, 'lablocation'=>$lablocation,'many_pc'=>$manypc,'pcos'=>$pcos, 'bring_device'=>$bringdevice, 'setup_time'=>$setuptime, 'doccam'=>$doccam,
            'eyetracker'=>$eyetracker,'hardware_req'=>$hardwarereq,  'labsetup'=>$labsetup,'location'=>$location,'screener_name'=>$fileName,'screener'=>$filename);

//printf("<pre>%s</pre>",print_r($sql, true));

$sql_data = array(  '%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s',
                    '%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s',
                    '%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s' );

if ($wpdb->insert( 'wp_uxc_study_request', $sql, $sql_data )){ 
        //this is where we send mail
        $request_id = $wpdb->get_var("SELECT LAST_INSERT_ID()");
        echo "Your request ID is ".$request_id."<br/>";
        if ($_FILES['screener']['size'] > 0){
        $fileName = $_FILES['screener']['name'];
        $tmpName  = $_FILES['screener']['tmp_name'];
        $fileSize = $_FILES['screener']['size'];
        $fileType = $_FILES['screener']['type'];

        if ( move_uploaded_file ($_FILES['screener']['tmp_name'],$path."/".$request_id."_{$_FILES['screener']['name']}") ) {
              echo '<P>FILE UPLOADED TO: <a href="http://usable/screeners/'.$request_id."_".$_FILES['screener']['name'].'" download >Here</a></P>';
              
           } else {
              echo "<P>MOVE UPLOADED FILE FAILED!</P>";
              print_r(error_get_last());
           }
        
        
} 
        
        
        include_once 'uxc-study-request-mail-send.php';
        header('Location: ' . get_bloginfo('url').'/index.php/my-studies');
    } else { ?>
        <div id="message" class="error"><p><strong><?php _e('There was an error in your submission, please try again.','uxc-study-request');?><?php print $wpdb->last_error; ?>.</strong></p>
        </div>
<?php 
} 


?>