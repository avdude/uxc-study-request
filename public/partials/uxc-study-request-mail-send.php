<?php

/**
 * @author David Fleming
 * @copyright 2016
 */


//Send Confirmation Email   
   echo 'Mail is going to '.$email;
   $message_top = "<html><body>
   <style>body{font-family: Segoe UI,Frutiger,Frutiger Linotype,Dejavu Sans,Helvetica Neue,Arial,sans-serif; font-size:12pt;line-height:14pt;}
       p {font-family: Segoe UI,Frutiger,Frutiger Linotype,Dejavu Sans,Helvetica Neue,Arial,sans-serif; font-size:12pt;line-height:14pt;}
       tr {font-family: Segoe UI,Frutiger,Frutiger Linotype,Dejavu Sans,Helvetica Neue,Arial,sans-serif;}
       table { border-collapse: collapse;}
       th, td { padding-left: 15px;font-size: 12pt; font-family: Segoe UI,Frutiger,Frutiger Linotype,Dejavu Sans,Helvetica Neue,Arial,sans-serif;}
       </style>";  
   $message_bottom = "</html></body>";
   $body="";
   //$body .='<h2><b>NEW STUDY REQUEST</b></h2>';
   /*
   **Make this an admin option for mail_message.
   */
  /* $body .= '<br/><br/><p>Thanks for requesting your study with us. We\'ve either already started working on it or will begin very soon. 
   Please take a moment to verify that all the information below is accurate. We\'re moving forward like it is.<p>';*/
   $body .= '<br/><br/><p>Thanks for your study request.  We\'ve received it, and will follow up with you soon to finalize the details.</p>';
   $body .= '<table>';
   $body .= '<tr bgcolor="purple" style="border: none;color:white;font-size:16pt;height:100px;" height="100"><td>User Experience Central<br/><br/><b style="font-size:16pt;">Study Request Form</b></td><td><img src="http://usable/img/mail-image.png" width="280" height="100" align="right"></td></tr>';
   $body .= '<tr bgcolor="lightblue" ><td colspan="2"><b>Overview</b></td></tr>';
   $body .= '<tr  bgcolor="#F5F5F5"><td><b>Study Name:</b></td><td>  '.stripslashes($sql['study_name']).'</td></tr>';
        
   $body .= '<tr><td><b>Contact Email:</b></td><td>  '.$sql['email'].'</td></tr>';
    
    
    $body .= '<tr bgcolor="#F5F5F5"><td><b>Start Date:</b></td><td>  '.$sql['start'].'</td></tr>';
    $body .= '<tr ><td><b>End Date:</b></td><td>  '.$sql['end'].'</td></tr>';
    $body .= '<tr bgcolor="#F5F5F5"><td><b>Primary Researcher:</b></td><td>  '.stripslashes($sql['researcher']).'</td></tr>';
    $body .= '<tr ><td><b>Alternate Researcher:</b></td><td>  '.stripslashes($sql['alternate']).'</td></tr>';
    $body .= '<tr  bgcolor="#F5F5F5"><td><b>Services Requested</b></td><td>';
    $services = "";
        if ($sql['lab']=='Y'){ $services .=" Lab,";}
        if ($sql['participants']=='Y'){ $services .=" Participant,";}
        if ($sql['waiver']=='Y'){ $services .=" Waiver,";}
        if ($sql['gratuity']=='Y'){ $services .=" Gratuity,";}
        if ($sql['survey']=='Y'){ $services .=" Survey";}
    
    $body .=  $services.'</td></tr>';
    $body .= '<tr><td><b>Comments:</b></td><td>  '.stripslashes(nl2br($sql['comments'])).'</td></tr>';
    //Billing
    $body .= '<tr bgcolor="lightblue" ><td colspan="2"><b>Billing</b></td></tr>';
    $body .= '<tr ><td><b>Cost Center or IO to use:</b></td><td>  '.stripslashes($sql['costcenter']).'</td></tr>';    
    //Gratuity
    if ($sql['gratuity']=='Y'){
    $body .= '<tr bgcolor="lightblue" ><td colspan="2"><b>Gratuity</b></td></tr>';
    
    $body .= '<tr bgcolor="#F5F5F5"><td><b>Is this a purchase pass only request?</b></td><td>'.$sql['purchasepass'].'</td></tr>'; 
    $body .= '<tr ><td><b>If purchase pass only, how many purchase passes are needed?</b></td><td>$ '.$sql['passcount'].'.00</td></tr>';
    $body .= '<tr bgcolor="#F5F5F5"><td><b>How many cards?</b></td><td>'.$sql['cardcount'].'</td></tr>';
    $body .= '<tr ><td><b>What amount for each gift card?</b></td><td>$ '.$sql['cardamount'].'.00</td></tr>';
    $body .= '<tr bgcolor="#F5F5F5"><td><b>Do you need "Take In Advance" for the gift cards?</b></td><td>'.$sql['cardadvance'].'</td></tr>'; 
    } 
    if ($sql['participants']=='Y'){   
    //Participants
    $body .= '<tr bgcolor="lightblue" ><td colspan="2"><b>Participants & Location</b></td></tr>';
    $body .= '<tr ><td><b>Type of Participant Study:</b></td><td>  '.$sql['study_type'].'</td></tr>';
    $body .= '<tr  bgcolor="#F5F5F5"><td><b>If Site or Remote Study, what location?</b></td><td>'.stripslashes($sql['location']).'</td></tr>';
    $body .= '<tr ><td><b>Minimum number of Participants required:</b></td><td>  '.$sql['participant_req'].'</td></tr>';
    $body .= '<tr bgcolor="#F5F5F5"><td><b>Extra Participants Requested:</b></td><td>  '.$sql['extra_participant'].'</td></tr>'; 
    $body .= '<tr ><td><b># of Participants per session:</b></td><td>  '.$sql['part_per_session'].'</td></tr>';
    $body .= '<tr bgcolor="#F5F5F5"><td><b>Profile Details:</b></td><td>'.stripslashes(nl2br($sql['profile'])).'</td></tr>';
    $body .= '<tr ><td><b>Screener File:</b></td><td>';
       if ($sql['screener_name'] !=""){
    $body .= '<a href="http://usable/screeners/'.$request_id."_".$sql['screener_name'].'" download >Download Screener</a>';
   }
   $body .= '</td></tr>';
    $body .= '<tr ><td><b>Anything the participants should bring?</b></td><td>  '.stripslashes(nl2br($sql['participant_bring'])).'</td></tr>';
    
    $body .= '<tr bgcolor="lightblue" ><td colspan="2"><b>Study Sessions</b></td></tr>';
    //$body .= '<tr ><td><b>Session Length:</b></td><td></td></tr>';
    $body .= '<tr bgcolor="#F5F5F5"><td><b>Session Date & Times & Duration</b></td><td>'.stripslashes(nl2br($sql['schedule'])).'</td></tr>';
    }
    

    

    if ($sql['lab']=='Y'){    
    $body .= '<tr bgcolor="lightblue" ><td colspan="2"><b>Lab Setup</b></td></tr>';
    $body .= '<tr ><td><b>What type of suite/lab do you need?</b></td><td>  '.$sql['labtype'].'</td></tr>';
    $body .= '<tr ><td><b>What location would you prefer?</b></td><td>  '.$sql['lablocation'].'</td></tr>';    
    $body .= '<tr bgcolor="#F5F5F5"><td><b>How many PCs do you need?</b></td><td>  '.$sql['many_pc'].'</td></tr>';
    if ($sql['many_pc'] >= '1'){
    $body .= '<tr bgcolor="#F5F5F5"><td><b>What Windows OS does the PC require?</b></td><td>  '.$sql['pcos'].'</td></tr>';
    }
    $body .= '<tr ><td><b>Will you bringing your own PC(s) or device(s) to use in the lab?</b></td><td>  '.$sql['bring_device'].'</td></tr>';              
    $body .= '<tr bgcolor="#F5F5F5"><td><b>How much setup time needed before first session?</b></td><td>  '.$sql['setup_time'].'</td></tr>';
    $body .= '<tr ><td><b>Will you be bringing your own device(s)?</b></td><td>  '.$sql['bring_device'].'</td></tr>';
    $body .= '<tr bgcolor="#F5F5F5"><td><b>Do you need a document camera?</b></td><td>  '.$sql['doccam'].'</td></tr>';
    $body .= '<tr ><td><b>Do you need an eyetracker?</b></td><td>  '.$sql['eyetracker'].'</td></tr>';
    $body .= '<tr bgcolor="#F5F5F5"><td><b>Do you have additional hardware requests?</b></td><td>  '.stripslashes(nl2br($sql['hardware_req'])).'</td></tr>';
    $body .= '<tr ><td><b>Any specific lab setup requests?</b></td><td>  '.stripslashes(nl2br($sql['labsetup'])).'</td></tr>';
    }
    
    
            
   $body .= '</table>';
   echo $sql['alias'];
   $email_body = $message_top.$body.$message_bottom;        
   $headers = array('Content-Type: text/html; charset=UTF-8');
   $headers[] = 'MIME-Version: 1.0';
    //$headers[]='From: User Experience Centeral <dfleming@microsoft.com>';
   $headers[]= "Cc: ".$sql['alias']."<".$email.">";
   if (wp_mail('dfleming@microsoft.com', 'New Study Request: '.stripslashes($sql['study_name']), $email_body, $headers)){
    echo "Mail Sent!";
   }
    

   ?>