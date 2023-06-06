<?php
include_once '../includes/inc_config.php'; //Making paging validation
include_once $inc_nocache; //Clearing the cache information
include_once $adm_session; //checking for session
include_once $inc_cnctn; //Making database Connection
include_once $inc_usr_fnctn; //checking for session
include_once $inc_pgng_fnctns; //Making paging validation
include_once $inc_fldr_pth;
global $ses_admin;
if (isset($_POST['btneprodcatsbmt']) && (trim($_POST['btneprodcatsbmt']) != "") && isset($_POST['txtname']) && (trim($_POST['txtname']) != "") && isset($_POST['txtprty']) && (trim($_POST['txtprty']) != "")) {
	//echo "here";exit;


	$prodcat  	= glb_func_chkvl($_POST['lstcat']);
	$id = glb_func_chkvl($_POST['hdnprodcatid']);
	$name = glb_func_chkvl($_POST['txtname']);
	$prior = glb_func_chkvl($_POST['txtprty']);
	//$hmprior = glb_func_chkvl($_POST['txthmprior']);
	$desc = addslashes(trim($_POST['txtdesc']));
	$title = glb_func_chkvl($_POST['txtseotitle']);
	$seodesc = glb_func_chkvl($_POST['txtseodesc']);
	$kywrd = glb_func_chkvl($_POST['txtseokywrd']);
	$seoh1 = glb_func_chkvl($_POST['txtseoh1']);
	$seoh2 = glb_func_chkvl($_POST['txtseoh2']);
	//$seoh1_desc = glb_func_chkvl($_POST['txtseoh1desc']);
	//$seoh2_desc = glb_func_chkvl($_POST['txtseoh2desc']);
	$cattyp    	= glb_func_chkvl($_POST['lstcattyp']);
	$disptyp  	= glb_func_chkvl($_POST['lstdsplytyp']);
	$pg = glb_func_chkvl($_REQUEST['hdnpage']);
	$countstart = glb_func_chkvl($_REQUEST['hdncnt']);
	$hdnsmlimg = glb_func_chkvl($_POST['hdnsmlimg']);
	$hdnbnrimg	= glb_func_chkvl($_POST['hdnbgimg']);
	$sts = glb_func_chkvl($_POST['lststs']);
	$srchval = glb_func_chkvl($_REQUEST['hdnval']);
	$chk = glb_func_chkvl($_REQUEST['hdnchk']);
	$cur_dt = date('Y-m-d h:i:s');
	$loc = "&val=$srchval";
	if ($chk != '') {
		$loc .= "&chk=y";
	}
	$sqryprodcat_mst = "SELECT prodcatm_name  from prodcat_mst where prodcatm_name='$name' and prodcatm_prodmnlnksm_id = '$prodcat' and prodcatm_id='$id'";
	$srsprodcat_mst = mysqli_query($conn, $sqryprodcat_mst);
	$rows_cnt = mysqli_num_rows($srsprodcat_mst);
	if ($rows_cnt > 1) { ?>
		<script type="text/javascript">
			location.href = "view_detail_product_category.php?vw=<?php echo $id; ?>&sts=d&pg=<?php echo $pg; ?>&countstart=<?php echo $countstart . $loc; ?>";
		</script>
		<?php
	} else {
		$uqryprodcat_mst = "UPDATE prodcat_mst set 
		prodcatm_name='$name', 
		prodcatm_prodmnlnksm_id ='$prodcat',
		prodcatm_sts='$sts', 
		prodcatm_desc='$desc',
		prodcatm_typ='$cattyp',
		prodcatm_dsplytyp='$disptyp',
		prodcatm_seotitle='$title', 
		prodcatm_seodesc='$seodesc', 
		prodcatm_seokywrd='$kywrd', 
		prodcatm_seohone='$seoh1', 
		
		prodcatm_seohtwo='$seoh2',
		
		prodcatm_prty ='$prior', 
		prodcatm_mdfdon ='$cur_dt',
		prodcatm_mdfdby='$ses_admin'";
		if (isset($_FILES['flebnrimg']['tmp_name']) && ($_FILES['flebnrimg']['tmp_name'] != "")) {
			$bimgval = funcUpldImg('flebnrimg', 'bimg');
			//$bimgval = funcUpldImg('flebnrimg','catimg');
			if ($bimgval != "") {
				$bimgary = explode(":", $bimgval, 2);
				$bdest = $bimgary[0];
				$bsource = $bimgary[1];
			}
			$uqryprodcat_mst .= ", prodcatm_bnrimg = '$bdest'";
		}
		if (isset($_FILES['icnimg']['tmp_name']) && ($_FILES['icnimg']['tmp_name'] != "")) {
			$simgval = funcUpldImg('icnimg', 'simg');
			if ($simgval != "") {
				$simgary    = explode(":", $simgval, 2);
				$sdest 		= $simgary[0];
				$ssource 	= $simgary[1];
			}
			$uqryprodcat_mst .= ",prodcatm_icn='$sdest'";
		}
		if (isset($_POST['chkbximg']) && ($_POST['chkbximg'] != "")) {
			$delimgnm   = glb_func_chkvl($_POST['chkbximg']);
			$delimgpth  = $a_cat_bnrfldnm . $delimgnm;
			if (isset($delimgnm) && file_exists($delimgpth)) {
				unlink($delimgpth);
				$uqryprodcat_mst .= ",prodcatm_bnrimg=''";
			}
		}
		if (isset($_POST['chkbxicn']) && ($_POST['chkbxicn'] != "")) {
			$delimgnm   = glb_func_chkvl($_POST['chkbxicn']);
			$delimgpth  = $a_cat_icnfldnm . $delimgnm;
			if (isset($delimgnm) && file_exists($delimgpth)) {
				unlink($delimgpth);
				$uqryprodcat_mst .= ",prodcatm_icn=''";
			}
		}
		$uqryprodcat_mst .= " where prodcatm_id = $id";
		$ursprodmncat_mst = mysqli_query($conn, $uqryprodcat_mst);
		if ($ursprodmncat_mst == true) {
			if (($bsource != 'none') && ($bsource != '') && ($bdest != "")) {
				$bgimgpth      = $a_cat_bnrfldnm . $hdnbgimg;
				if (($hdnbgimg != '') && file_exists($bgimgpth)) {
					unlink($bgimgpth);
				}
				move_uploaded_file($bsource, $a_cat_bnrfldnm . $bdest);
			}
			if (($ssource != 'none') && ($ssource != '') && ($sdest != "")) {
				$smlimgpth      = $a_cat_icnfldnm . $hdnsmlimg;
				if (($hdnsmlimg != '') && file_exists($smlimgpth)) {
					unlink($smlimgpth);
				}
				move_uploaded_file($ssource, $a_cat_icnfldnm . $sdest);
			}
		?>
			<script type="text/javascript">
				location.href = "view_detail_product_category.php?vw=<?php echo $id; ?>&sts=y&pg=<?php echo $pg; ?>&countstart=<?php echo $countstart . $loc; ?>";
			</script>
		<?php
		} else { ?>
			<script type="text/javascript">
				location.href = "view_detail_product_category.php?vw=<?php echo $id; ?>&sts=n&pg=<?php echo $pg; ?>&countstart=<?php echo $countstart . $loc; ?>";
			</script>
<?php
		}
	}
}
?>