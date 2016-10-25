<?php

/**
 * @author David Fleming
 * @copyright 2016
 */

$file = base64_decode($_POST['file']);
$filename=base64_decode($_POST['filename']);
         $file = $fileinfo['screener'];
        	//header_remove();
            //header("Cache-Control: no-cache private");
        	header("Content-Description: File Transfer");
        	
           //	header('Content-disposition: attachment; filename="test.xls');
        //	header("Content-Type: application/vnd.ms-excel");
        	//header("Content-Transfer-Encoding: binary");
        	header('Content-Length: '. strlen($file));
            
               header('Content-disposition: attachment; filename='.$filename); 
                header("Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, charset=utf-8;");
                header("Content-Type: application/vnd.ms-excel");
                //('Content-Disposition: attachment; filename="downloaded.pdf"');
                header("Pragma: no-cache"); 
                header("Expires: 0"); 
        	echo $file;
            exit;

?>
