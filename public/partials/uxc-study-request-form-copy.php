<?php

/**
 * @author David Fleming
 * @copyright 2016
 */

global $wpdb;
$id = $_REQUEST['id'];
$dbstring = 'wp_uxc_study_request';
$sql = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM $dbstring WHERE ID = '$id'" ), ARRAY_A );
?>


<h2>UXC NEW STUDY REQUEST</h2>
<div id="dialog"><i class="fa fa-asterisk" aria-hidden="true"  style="color:#F08080;">
 Indicates required field.</i> </div>
 <form name="newstudyform" id="newstudyform" action="" method="POST" enctype="multipart/form-data">
  <?php wp_nonce_field( 'uxc_nonce_action', 'uxc_nonce_field' ); ?> 
    <h3 class="sectionhead">General Details</h3>
    <input type="hidden" name="user" id="user" value="<?php echo $alias;?>">
        <div class="newstudyquestion">
            <label for="studyname">Study Name:<i class="fa fa-asterisk" aria-hidden="true"  style="color:#F08080;"></i> </label>
            <input type="text" name="studyname" id="studyname" value="<?php echo stripslashes($sql['study_name']);?>" placeholder="What's the name of your study?">
        </div>
        <div class="newstudyquestion">
            <label for="email">E-mail:<i class="fa fa-asterisk" aria-hidden="true"  style="color:#F08080;"></i> </label>
            <input type="email" name="email" id="email" value="<?php echo $alias.'@microsoft.com';?>">
        </div>

        <div class="newstudyquestion" id="services" >
        
            <legend>What services are you requesting (check all that apply)?<i class="fa fa-asterisk" aria-hidden="true"  style="color:#F08080;"></i> </legend>
            <ul style="list-style-type: none;">
            <div id="errors"></div>
            <label for="lab"></label>
                   <li><input type="checkbox" name="lab" id="lab" value="lab" <?php if ($sql['lab']=='Y'){echo "checked";}?>/><label for="lab">Usability Suite/Lab</label></li>
                   <li><input type="checkbox" name="participants" id="participants" value="participants" <?php if ($sql['participants']=='Y'){echo "checked";}?>/><label for="participants">Participant Recruiting/Scheduling</label></li>
                   <li><input type="checkbox" name="waiver" id="waiver" value="waiver" <?php if ($sql['waiver']=='Y'){echo "checked";}?>/><label for="waiver">Waiver</label></li>
                   <li><input type="checkbox" name="gratuity" id="gratuity" value="gratuity" <?php if ($sql['gratuity']=='Y'){echo "checked";}?>/><label for="gratuity">Gratuity</label></li>
                   <li><input type="checkbox" name="survey" id="survey" value="survey" <?php if ($sql['survey']=='Y'){echo "checked";}?>/><label for="survey">Survey</label></li>

            </ul>
        </div>
        <div class="newstudyquestion" >
            <legend>WhatCost Center or IO to use?<i class="fa fa-asterisk" aria-hidden="true"  style="color:#F08080;"></i> </legend>
            <input type="text" id="costcenter" name="costcenter" value="<?php echo stripslashes($sql['costcenter']);?>" />
        </div>       
        <div class="newstudyquestion" >
            <legend>What is the proposed start date of your study?<i class="fa fa-asterisk" aria-hidden="true"  style="color:#F08080;"></i> </legend>
            <input type="text" id="start" name="start" autocomplete="off" />
        </div>
        <div class="newstudyquestion" >
            <legend>What is the proposed end date of your study?<i class="fa fa-asterisk" aria-hidden="true"  style="color:#F08080;"></i> </legend>
            <input type="text" id="end" name="end" autocomplete="off" />
        </div>
        <div class="newstudyquestion" >
            <legend>What is your alias?<i class="fa fa-asterisk" aria-hidden="true"  style="color:#F08080;"></i> </legend>
            <input type="text" id="researcher" name="researcher" value="<?php echo $alias;?>" />
        </div>
        <div class="newstudyquestion" >
            <legend>What is the alias of an alternate researcher on the project?</legend>
            <input type="text" id="alternate" name="alternate" value="<?php echo stripslashes($sql['alternate']);?>"/>
        </div>

        <div class="newstudyquestion" >
        <legend>Additional General Comments?</legend>
        <textarea id="generalcomments" name="generalcomments"><?php echo stripslashes($sql['comments']);?></textarea>
    </div>
    <!--End Section-->
    <div id="participantsection" style="display: none;">
    <br />
    <hr />
    <h3 class="sectionhead">Participant Specific Details</h3>
        <div class="newstudyquestion" >
            <label for="studytype">What type of study are you requesting participants for?<i class="fa fa-asterisk" aria-hidden="true"  style="color:#F08080;"></i> </label>
            <select id="studytype" name="studytype">
                <?php if ($sql['study_type']!= ''){echo '<option value="'.$sql['study_type'].'">'.$sql['study_type'].'</option>';}?>
                <option></option>
            	<option value="Site">Site</option>
            	<option value="Remote">Remote</option>
            	<option value="Focus">Focus Group</option>
            	<option value="1:1">1:1</option>
                <option value="Panel">Panel/Longitudinal</option>
          
            </select>
        </div>
        <div class="newstudyquestion" >
            <legend>If Site or Remote, what location will you be testing?</legend>
            <input type="text" id="location" name="location" value="<?php echo stripslashes($sql['location']);?>" />
        </div>
        <div class="newstudyquestion" >
            <legend>How many Participants are required?<i class="fa fa-asterisk" aria-hidden="true"  style="color:#F08080;"></i> </legend>
            <input type="text" id="partreq" name="partreq" value="<?php echo stripslashes($sql['participant_req']);?>" />
        </div>    
        <div class="newstudyquestion" >
            <legend>How many extra Participants would you like to request?</legend>
            <input type="text" id="extrapart" name="extrapart" value="<?php echo stripslashes($sql['extra_participant']);?>" />
        </div>
        <div class="newstudyquestion" >
            <legend>What are the profile details?</legend>
            <textarea name="profile" id="profile"><?php echo stripslashes($sql['profile']);?></textarea>
        </div>    
        <div class="newstudyquestion" >
            <legend>Add Screener File (must be Excel Doc)</legend>
            <input type="hidden" name="MAX_FILE_SIZE" value="2000000"/>
            <input type="file" id="screener" name="screener" />
        </div>
         <div class="newstudyquestion" >
            <legend>How many Participants per session would you like?<i class="fa fa-asterisk" aria-hidden="true"  style="color:#F08080;"></i> </legend>
            <input type="text" id="partpersession" name="partpersession" value="<?php echo stripslashes($sql['part_per_session']);?>" />
        </div>
        <div class="newstudyquestion" >
            <legend>Study session details (i.e. 09-28-2016 / 9:00am / 1 hour)(1 per line)<i class="fa fa-asterisk" aria-hidden="true"  style="color:#F08080;"></i> </legend>
            <textarea id="sessionschedule" name="sessionschedule" placeholder="Date/Time/Duration for each session" ><?php echo stripslashes($sql['schedule']);?></textarea>
        </div>
        <div class="newstudyquestion" >
            <legend>Anything the participant needs to bring or do ahead of time?</legend>
            <textarea id="participantbring" name="participantbring" ><?php echo stripslashes($sql['participant_bring']);?></textarea>
        </div>      
    </div>
    <!--End Section-->
    <div id="gratuitysection" style="display: none;">
    <br />
    <hr />
    <h3 class="sectionhead">Gratuity Specific Details</h3>
        <div class="newstudyquestion" >
            <legend>How many gift cards would you like?<i class="fa fa-asterisk" aria-hidden="true"  style="color:#F08080;"></i> </legend>
            <input type="text" id="cardcount" name="cardcount" value="<?php echo stripslashes($sql['cardcount']);?>" />
        </div>
        <div class="newstudyquestion" >
            <label for="cardamount">What amount would you like for each gift card ( As low as $25, as high as $250 ) ?<i class="fa fa-asterisk" aria-hidden="true"  style="color:#F08080;"></i> </label>
            <select id="cardamount" name="cardamount">
                <?php if ($sql['cardamount']!= ''){echo '<option value="'.$sql['cardamount'].'">$ '.$sql['cardamount'].'.00</option>';}?>
                <option>None</option>
            	<option value="25">$ 25.00</option>
            	<option value="50">$ 50.00</option>
            	<option value="75">$ 75.00</option>
            	<option value="100">$ 100.00</option>
                <option value="125">$ 125.00</option>
            	<option value="150">$ 150.00</option>
            	<option value="175">$ 175.00</option>
            	<option value="200">$ 200.00</option>
                <option value="225">$ 225.00</option>
            	<option value="250">$ 250.00</option>
            </select>
          </div>
        <div class="newstudyquestion" >
            <legend>Do you need to pick the gratuities up yourself in advance of the study (e.g. take-in-advance gratuity)?</legend>
            <ul style="list-style-type: none;">
                   <li><input type="checkbox" name="takenadvance" id="takenadvance" value="takenadvance" <?php if ($sql['cardadvance']=='Y'){echo "checked";}?>/><label for="takenadvance"> Yes I want Take In Advance</label></li>
            </ul>
        </div>       
    </div>
    <!--End Section-->
    <div id="labsection" style="display: none;">
    <br />
    <hr />
    <h3 class="sectionhead">Usability Suite/Lab Specific Details</h3>
        <div class="newstudyquestion" >
            <label for="labtype">What type of suite/lab do you require?<i class="fa fa-asterisk" aria-hidden="true"  style="color:#F08080;"></i> </label>
            <select id="labtype" name="labtype">
                 <?php if ($sql['labtype']!= ''){echo '<option value="'.$sql['labtype'].'">'.$sql['labtype'].'</option>';}?>
                 <option></option>
            	<option value="individual" <?php echo ($sql['labtype'] == 'individual' ? ' selected="selected"' : '');?> >Individual</option>
            	<option value="livingroom" <?php echo ($sql['labtype'] == 'livingroom' ? ' selected="selected"' : '');?> >Living Room</option>
            	<option value="focusgroup" <?php echo ($sql['labtype'] == 'focusgroup' ? ' selected="selected"' : '');?> >Focus Group</option>
                <option value="accessibility" <?php echo ($sql['labtype'] == 'accessibility' ? ' selected="selected"' : '');?> >Accessbility</option>
                <option value="other" <?php echo ($sql['labtype'] == 'other' ? ' selected="selected"' : '');?> >Other (please describe in lab setup)</option>
                </select>
        </div>
        <div class="newstudyquestion" >
            <label for="lablocation"></i> What building would you prefer to run your study in?</label>
            <select id="lablocation" name="location">
                <option></option>
            	<!--<option value="30">30</option> -->
                <option value="16" <?php echo ($sql['lablocation'] == '16' ? ' selected="selected"' : '');?> >16 (Private Lab)</option>
                <option value="36" <?php echo ($sql['lablocation'] == '36' ? ' selected="selected"' : '');?> >36</option>
            	<option value="40" <?php echo ($sql['lablocation'] == '40' ? ' selected="selected"' : '');?> >40</option>
            	<option value="84" <?php echo ($sql['lablocation'] == '84' ? ' selected="selected"' : '');?> >84</option>
                <option value="99" <?php echo ($sql['lablocation'] == '99' ? ' selected="selected"' : '');?> >99</option>
                <option value="Bravern" <?php echo ($sql['lablocation'] == 'Bravern' ? ' selected="selected"' : '');?> >Bravern</option>
                <option value="Cambridge" <?php echo ($sql['lablocation'] == 'Cambridge' ? ' selected="selected"' : '');?> >Cambridge (Boston, MA)</option>
                <option value="Fargo" <?php echo ($sql['lablocation'] == 'Fargo' ? ' selected="selected"' : '');?> >Fargo (Fargo, ND)</option>
                <option value="Studio D" <?php echo ($sql['lablocation'] == 'Studio D' ? ' selected="selected"' : '');?> >Studio D</option>
                <option value="Studio H" <?php echo ($sql['lablocation'] == 'Studio H' ? ' selected="selected"' : '');?> >Studio H</option>
                <option value="SVC 3" <?php echo ($sql['lablocation'] == 'SVC 3' ? ' selected="selected"' : '');?> >SVC 3 (San Jose, CA)</option>
                <option value="Red West A" <?php echo ($sql['lablocation'] == 'Red West A' ? ' selected="selected"' : '');?> >Red West A</option>
                <option value="Insights" <?php echo ($sql['lablocation'] == 'Insights' ? ' selected="selected"' : '');?> >Insights (Private Lab)</option>
             </select>
        </div>
        <div class="newstudyquestion" >
            <legend>How much setup time needed before first session?<i class="fa fa-asterisk" aria-hidden="true"  style="color:#F08080;"></i> </legend>
            <select id="setuptime" name="setuptime">
                <option value="0">0</option>
            	<option value="1 hour" <?php echo ($sql['setup_time'] == '1 hour' ? ' selected="selected"' : '');?> >1 hour</option>
            	<option value="2 hours" <?php echo ($sql['setup_time'] == '2 hours' ? ' selected="selected"' : '');?> >2 hours</option>
            	<option value="3 hours" <?php echo ($sql['setup_time'] == '3 hours' ? ' selected="selected"' : '');?> >3 hours</option>
                <option value="4 hours" <?php echo ($sql['setup_time'] == '4 hours' ? ' selected="selected"' : '');?> >3 hours</option>
             </select>
        </div>
        <div class="newstudyquestion" >
            <label for="manypc">How many UXC supplied PCs do you need??</label>
            <select id="manypc" name="manypc">
                <option value="0">0</option>
            	<option value="1" <?php echo ($sql['many_pc'] == '1' ? ' selected="selected"' : '');?> >1</option>
            	<option value="2" <?php echo ($sql['many_pc'] == '2' ? ' selected="selected"' : '');?> >2</option>
            	<option value="3" <?php echo ($sql['many_pc'] == '3' ? ' selected="selected"' : '');?> >3</option>
             </select>
        </div>
        <div id="pcos" class="newstudyquestion" style="display: none;">
            <label for="pcos">What version of Windows do you need on the PC?</label>
            <select id="pcos" name="pcos" >
            <option></option>
            <option value="Windows 10/64 Enterprise" <?php echo ($sql['pcos'] == 'Windows 10/64 Enterprise' ? ' selected="selected"' : '');?> >Windows 10/64 Enterprise</option>
            <option value="Windows 10/86 Enterprise" <?php echo ($sql['pcos'] == 'Windows 10/86 Enterprise' ? ' selected="selected"' : '');?> >Windows 10/86 Enterprise</option>
            <option value="Windows 10/64 Pro" <?php echo ($sql['pcos'] == 'Windows 10/64 Pro' ? ' selected="selected"' : '');?> >Windows 10/64 Pro</option>
            <option value="Windows 10/86 Pro" <?php echo ($sql['pcos'] == 'Windows 10/86 Pro' ? ' selected="selected"' : '');?> >Windows 10/86 Pro</option>
            <option value="Windows 8.1/64 Pro" <?php echo ($sql['pcos'] == 'Windows 8.1/64 Pro' ? ' selected="selected"' : '');?> >Windows 8.1/64 Pro</option>
            <option value="Windows 8.1/86 Pro" <?php echo ($sql['pcos'] == 'Windows 8.1/86 Pro' ? ' selected="selected"' : '');?> >Windows 8.1/86 Pro</option>
            <option value="Windows 8.1/64 Enterprise" <?php echo ($sql['pcos'] == 'Windows 8.1/64 Enterprise' ? ' selected="selected"' : '');?> >Windows 8.1/64 Enterprise</option>
            <option value="Windows 8.1/86 Enterprise" <?php echo ($sql['pcos'] == 'Windows 8.1/86 Enterprise' ? ' selected="selected"' : '');?> >Windows 8.1/86 Enterprise</option>
            <option value="Windows 7/64" <?php echo ($sql['pcos'] == 'Windows 7/64' ? ' selected="selected"' : '');?> >Windows 7/64</option>
            <option value="Windows 7/86" <?php echo ($sql['pcos'] == 'Windows 7/86' ? ' selected="selected"' : '');?> >Windows 7/86</option>
            </select>
        </div>
        <fieldset data-role="controlgroup">
            <legend>Are you bringing your own PC or device?</legend>
            <label for="bringdeviceyes">Yes</label>
            <input type="radio" name="bringdevice" id="bringdeviceyes" value="yes" <?php if ($sql['bring_device']=='yes'){echo "checked";}?> />
            <label for="bringdeviceno">No</label>
            <input type="radio" name="bringdevice" id="bringdeviceno" value="no" <?php if ($sql['bring_device']!='yes'){echo "checked";}?> /> 
        </fieldset>
        <fieldset data-role="controlgroup">
            <legend>Do you need a document camera?</legend>
            <label for="doccamyes">Yes</label>
            <input type="radio" name="doccam" id="doccamyes" value="yes" <?php if ($sql['doccam']=='yes'){echo "checked";}?> />
            <label for="doccamno">No</label>
            <input type="radio" name="doccam" id="doccamno" value="no" <?php if ($sql['doccam']!='yes'){echo "checked";}?> /> 
        </fieldset>         
        <fieldset data-role="controlgroup">
            <legend>Do you need an Eye Tracker?</legend>
            <label for="eyeyes">Yes</label>
            <input type="radio" name="eyetracker" id="eyeyes" value="yes" <?php if ($sql['eyetracker']=='yes'){echo "checked";}?> />
            <label for="eyeno">No</label>
            <input type="radio" name="eyetracker" id="eyeno" value="no" <?php if ($sql['eyetracker']!='yes'){echo "checked";}?> /> 
        </fieldset> 
        <div class="newstudyquestion" >
            <legend>Do you have additional hardware requests?</legend>
            <textarea id="hardwarereq" name="hardwarereq" ><?php echo stripslashes($sql['hardware_req']);?></textarea>
        </div>  
        <div class="newstudyquestion" >
            <legend>Any lab setup requests?</legend>
            <textarea id="labsetup" name="labsetup" ><?php echo stripslashes($sql['labsetup']);?></textarea>
        </div> 
    </div>
    <!--End Section-->
    <input name="studyaction" id="studyaction" type="hidden" value="add">
    <br />
    <input type="submit" name="submit" value="SUBMIT REQUEST">
                    
    </form>
 
