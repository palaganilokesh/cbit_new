<?php	
	global $pgtl,$usr_pgtl;	
	$pgtl		= "cbit";	
	$usr_pgtl	= "cbit";
	$prefix_tl  = "cbit";
	date_default_timezone_set('UTC');
	$crntyr = date('Y');
	if($crntyr != 2023){
		$prd	= "2023" .'--'. $crntyr;
	}
	else{
		$prd = 2023;	
	}
	$pgftr 	= "$prd, $pgtl Designed &amp; Developed By";	
	
	$usr_cmpny 	= "cbit";	
	
	$u_prjct_url		= "https://www.cbit.ac.in/";
	$u_prjct_mnurl		= "https://www.cbit.ac.in/";
	$prjct_dmn			= "cbit.in/";
	$u_prjct_email		= "info"."@$prjct_dmn";	
	$u_prjct_email_info	= "info"."@$prjct_dmn";	
	
	
	$rtpth = "/~adroitprojects/design/C/cbit/v6/";
	
	
	
	$site_logo = '/images/liberty-exclusive-logo.png';
	
/*form variables */	




/*
$itm179 = "";*/



?>