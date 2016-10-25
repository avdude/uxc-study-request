/*(function( $ ) {
	'use strict';
	/**
	 * All of the code for your public-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */
/*
})( jQuery );
$(document).ready(function () {
    $('#lab').change(function () {
      $('#labselect').fadeToggle();
    });
});
*/
jQuery(document).ready(function(){ 
     //alert('test'); 
     /*
     **Handles the show/hide of form sections
     */
    jQuery('#lab').change(function () {
      jQuery('#labsection').fadeToggle();
      
    });
    jQuery('#participants').change(function () {
      jQuery('#participantsection').fadeToggle();
   
    });
    jQuery('#waiver').change(function () {
      jQuery('#waiversection').fadeToggle();
    });
    jQuery('#gratuity').change(function () {
      jQuery('#gratuitysection').fadeToggle();
    });
    jQuery('#survey').change(function () {
      jQuery('#surveysection').fadeToggle();
    });
    if (jQuery("#lab").is(':checked')) {
        jQuery('#labsection').fadeToggle();
    }
    if (jQuery("#participants").is(':checked')) {
        jQuery('#participantsection').fadeToggle();
    }
    if (jQuery("#waiver").is(':checked')) {
        jQuery('#waiversection').fadeToggle();
    }
    if (jQuery("#gratuity").is(':checked')) {
        jQuery('#gratuitysection').fadeToggle();
    }
    if (jQuery("#survey").is(':checked')) {
        jQuery('#surveysection').fadeToggle();
    }
    if (jQuery('#manypc options:selected').val() != 0) { jQuery('#pcos').show(); }
    
    
    jQuery('#manypc').change(function () {
        if( jQuery('#manypc').val() != '0') {
             //alert(" field does not match!");
             jQuery('#pcos').show();
             //jQuery('#pcos').fadeToggle();   
        } 
        else if(jQuery('#manypc').val() == '0'){
            jQuery('#pcos').hide();
            
        }
    });
    
    /*
    **Handles validation for new study request form
    **
    */

   
   //validation
   jQuery( "#newstudyform" ).validate({
                        errorElement: "div",
                    //place all errors in a <div id="errors"> element
                    errorPlacement: function(error, element) {
                        error.appendTo("div#errors");
                    }, 
	  rules: {
	      //main area
          studyname: {
	           required: true
	       },
	       email: {
	           required: true,
	           email: true
	       },
           /*
           id=services           
               lab
               participants
               waiver
               gratuity
               survey
           */
           costcenter: {
	           required: true
	       },
           start: {
	           required: true,
               
	       },
           end: {
	           required: true,
                
	       }, 
           researcher: {
	           required: true
	       },
           alternate: {
	           //required: true
	       },
           generalcomments: {
	           //required: true
	       },
           lab:{
                servicesChecked: true
           },
            //participant area  use required:  "#participantsection:visible"
           studytype: {
	           required:  "#participantsection:visible"
	       }, 
           partreq: {
	           required:  "#participantsection:visible"
	       },
           extrapart: {
	           //required:  "#participantsection:visible"
	       },
           profile: {
	           required:  "#participantsection:visible"
	       },
           partpersession: {
	           required:  "#participantsection:visible"
	       },
           sessionschedule: {
	           required:  "#participantsection:visible"
	       },
           participantbring: {
	          // required:  "#participantsection:visible"
	       },
            //gratuity area  use required:  "#gratuitysection:visible"
            cardcount: {
                required:  "#gratuitysection:visible"
            },
            cardamount: {
                required:  "#gratuitysection:visible",
                min: 25,
                max:250
            },
            takenadvance: {
                //required:  "#gratuitysection:visible"
            },
            //lab area  use required:  "#labsection:visible"
            
            manypc: {
                required:  "#labsection:visible"
            },
            setuptime: {
                required:  "#labsection:visible"
            },
            bringdevice: {
                required:  "#labsection:visible"
            },
            eyetracker: {
                required:  "#labsection:visible"
            },
            doccam: {
                required:  "#labsection:visible"
            },
            hardwarereq: {
                //required:  "#labsection:visible"
            },
            labtype: {
                required:  "#labsection:visible"
            },
            labsetup: {
               // required:  "#labsection:visible"
            }
            
	  },
      messages: {
            studyname: "",
            email:"",
            costcenter:"",
            start:"",
            end: "",
            researcher: "",
            lab: "You must select at least one service",
            alternate: "",
            generalcomments: "",
            studytype: "",
            partreq: "",
            extrapart: "",
            profile: "",
            partpersession: "",
            sessionschedule: "",
            participantbring: "",
            cardcount: "",
            cardamount: "",
            takenadvance: "",
            manypc: "",
            setuptime: "",
            bringdevice: "",
            doccam: "",
            eyetracker: "",
            hardwarereq: "",
            labsetup: ""
         },
            errorClass: "invalid"

	});
    
    jQuery.validator.addMethod("nourl", function(value, element) {
         return !/http\:\/\/|www\.|link\=|url\=/.test(value);
            }, 
         "No URL's"
              );

    jQuery.validator.addMethod("servicesChecked", function(value, element) {
        	var checkedCount = 0;
        
        	if (jQuery("#lab").is(":checked")){
        		checkedCount += 1;
        	}
        	if (jQuery("#participants").is(":checked")){
        		checkedCount += 1;
        	}
            if (jQuery("#waiver").is(":checked")){
        		checkedCount += 1;
        	}
            if (jQuery("#gratuity").is(":checked")){
        		checkedCount += 1;
        	}
            if (jQuery("#survey").is(":checked")){
        		checkedCount += 1;
        	}
                      
            return checkedCount > 0;
        });


}); 
jQuery( function() {
    jQuery( "#start" ).datepicker({ dateFormat:'mm-dd-yy',minDate:+1,onSelect: function(dateText, inst){
        jQuery("#end").datepicker("option","minDate",
        jQuery("#start").datepicker("getDate"));
        },onClose: function(){jQuery("#start").valid()}         
    } );
  } );
jQuery( function() {
    jQuery( "#end" ).datepicker({dateFormat:'mm-dd-yy',minDate:+1,onClose: function(){jQuery("#end").valid()}  } );
  } );
  
 