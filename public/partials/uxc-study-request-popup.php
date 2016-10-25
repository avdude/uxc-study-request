<?php

/**
 * @author David Fleming
 * @copyright 2016
 */


   echo '<style>body{font-family: Segoe UI,Frutiger,Frutiger Linotype,Dejavu Sans,Helvetica Neue,Arial,sans-serif; font-size:12pt;line-height:14pt;}
       table { border-collapse: collapse;}
       th, td { padding-left: 15px;font-size: 12pt;}
       </style>';  
  
   $body ='';
   /*
   **Make this an admin option for mail_message.
   */
   $date = date_create($request->submit_date);
   $body .= '<p>This study was submitted on '.date_format($date,"m-d-Y").' at '.date_format($date, "h:i A").'<p>';
   if ($request->screener_name !=""){
    $body .= '<a href="http://usable/screeners/'.$request->id."_".$request->screener_name.'" download >Download Screener</a>';
   }
   
   
   
  
   $body .= '<table>';
   $body .= '<tr bgcolor="purple" style="border: none;color:white;font-size:16pt;height:100px;" height="100"><td>User Experience Central<br/><br/><b style="font-size:16pt;">Study Request Form</b></td><td><img src="http://usable/img/mail-image.png" width="280" height="100" align="right"></td></tr>';
   $body .= '<tr bgcolor="lightblue" ><td colspan="2"><b>Overview</b></td></tr>';
   $body .= '<tr ><td><b>Study Name:</b></td><td>  '.stripslashes($request->study_name).'</td></tr>';
      
    $body .= '<tr bgcolor="#F5F5F5"><td><b>Contact Email:</b></td><td>  '.$request->email.'</td></tr>';
    
    
    $body .= '<tr bgcolor="#F5F5F5"><td><b>Start Date:</b></td><td>  '.$request->start.'</td></tr>';
    $body .= '<tr ><td><b>End Date:</b></td><td>  '.$request->end.'</td></tr>';
    $body .= '<tr bgcolor="#F5F5F5"><td><b>Primary Researcher:</b></td><td>  '.stripslashes($request->researcher).'</td></tr>';
    $body .= '<tr ><td><b>Alternate Researcher:</b></td><td>  '.stripslashes($request->alternate).'</td></tr>';
    $body .= '<tr  bgcolor="#F5F5F5"><td><b>Services Requested</b></td><td>';
    $services = "";
        if ($request->lab=='Y'){ $services .=" Lab,";}
        if ($request->participants=='Y'){ $services .=" Participant,";}
        if ($request->waiver=='Y'){ $services .=" Waiver,";}
        if ($request->gratuity=='Y'){ $services .=" Gratuity,";}
        if ($request->survey=='Y'){ $services .=" Survey";}
    
    $body .=  $services.'</td></tr>';
    $body .= '<tr ><td><b>Comments:</b></td><td>  '.stripslashes(nl2br($request->comments)).'</td></tr>';
    //Billing
    $body .= '<tr bgcolor="lightblue" ><td colspan="2"><b>Billing</b></td></tr>';
    $body .= '<tr ><td><b>Cost Center or IO to use:</b></td><td>  '.$request->costcenter.'</td></tr>';    
    //Gratuity
    if ($request->gratuity=='Y'){
    $body .= '<tr bgcolor="lightblue" ><td colspan="2"><b>Gratuity</b></td></tr>';
    
    $body .= '<tr bgcolor="#F5F5F5"><td><b>How many cards?</b></td><td>'.$request->cardcount.'</td></tr>';
    $body .= '<tr ><td><b>What amount for each gift card?</b></td><td>$ '.$request->cardamount.'.00</td></tr>';
    $body .= '<tr bgcolor="#F5F5F5"><td><b>Do you need "Take In Advance" for the gift cards?</b></td><td>'.$request->cardadvance.'</td></tr>';
    }    
    //Participants
     if ($request->participants=='Y'){   
    $body .= '<tr bgcolor="lightblue" ><td colspan="2"><b>Participants & Location</b></td></tr>';
    $body .= '<tr ><td><b>Type of Study:</b></td><td>  '.$request->study_type.'</td></tr>';
    $body .= '<tr ><td><b>If Site or Remote Study, what location?</b></td><td> </td></tr>';
    $body .= '<tr ><td><b>Minimum number of Participants required:</b></td><td>  '.$request->participant_req.'</td></tr>';
    $body .= '<tr bgcolor="#F5F5F5"><td><b>Extra Participants Requested:</b></td><td>  '.$request->extra_participant.'</td></tr>'; 
    $body .= '<tr ><td><b># of Participants per session:</b></td><td>  '.$request->part_per_session.'</td></tr>';
    $body .= '<tr bgcolor="#F5F5F5"><td><b>Profile Details:</b></td><td>'.stripslashes(nl2br($request->profile)).'</td></tr>';
    $body .= '<tr ><td><b>Screener File:</b></td><td>';
       if ($request->screener_name !=""){
    $body .= '<a href="http://usable/screeners/'.$request->id."_".$request->screener_name.'" download >Download Screener</a>';
   }
   $body .= '</td></tr>';
    $body .= '<tr bgcolor="lightblue" ><td colspan="2"><b>Study Requirements</b></td></tr>';
    $body .= '<tr ><td><b>Anything the participants should bring?</b></td><td>  '.stripslashes(nl2br($request->participant_bring)).'</td></tr>';
    //$body .= '<tr bgcolor="#F5F5F5"><td><b>Additional comments?</b></td><td>  '.nl2br($request->comments).'</td></tr>';
    
    
     //$body .= '<tr bgcolor="#F5F5F5"><td><b>Lab(s) needed:</b></td><td></td></tr>';

    
    $body .= '<tr bgcolor="lightblue" ><td colspan="2"><b>Study Sessions</b></td></tr>';
    //$body .= '<tr ><td><b>Session Length:</b></td><td></td></tr>';
    $body .= '<tr bgcolor="#F5F5F5"><td><b>Session Date & Times & Duration</b></td><td>'.stripslashes(nl2br($request->schedule)).'</td></tr>';
    }

    

     if ($request->lab=='Y'){    
    $body .= '<tr bgcolor="lightblue" ><td colspan="2"><b>Lab Setup</b></td></tr>';
    $body .= '<tr ><td><b>What type of suite/lab do you need?</b></td><td>  '.$request->labtype.'</td></tr>';
    $body .= '<tr ><td><b>What location would you prefer?</b></td><td>  '.$request->lablocation.'</td></tr>';    
    $body .= '<tr bgcolor="#F5F5F5"><td><b>How many PCs do you need?</b></td><td>  '.$request->many_pc.'</td></tr>';
    if ($request->many_pc >= '1'){
    $body .= '<tr bgcolor="#F5F5F5"><td><b>What Windows OS does the PC require?</b></td><td>  '.$request->pcos.'</td></tr>';
    }
    $body .= '<tr ><td><b>Will you bringing your own PC(s) or device(s) to use in the lab?</b></td><td>  '.$request->bring_device.'</td></tr>';              
    $body .= '<tr bgcolor="#F5F5F5"><td><b>How much setup time needed before first session?</b></td><td>  '.$request->setup_time.'</td></tr>';
    $body .= '<tr ><td><b>Will you be bringing your own device(s)?</b></td><td>  '.$request->bring_device.'</td></tr>';
    $body .= '<tr bgcolor="#F5F5F5"><td><b>Do you need a document camera?</b></td><td>  '.$request->doccam.'</td></tr>';
    $body .= '<tr ><td><b>Do you need an eyetracker?</b></td><td>  '.$request->eyetracker.'</td></tr>';
    $body .= '<tr bgcolor="#F5F5F5"><td><b>Do you have additional hardware requests?</b></td><td>  '.stripslashes(nl2br($request->hardware_req)).'</td></tr>';
    $body .= '<tr ><td><b>Any specific lab setup requests?</b></td><td>  '.stripslashes(nl2br($request->labsetup)).'</td></tr>';
    }
    $body .= '</table>';
?>