<?php
include_once '../includes/inc_config.php'; //Making paging validation
include_once $inc_nocache; //Clearing the cache information
include_once $adm_session; //checking for session
include_once $inc_cnctn; //Making database Connection
include_once $inc_usr_fnctn; //checking for session
include_once $inc_pgng_fnctns; //Making paging validation
global $ses_admin;
if(isset($_POST['btneprodscatsbmt']) && (trim($_POST['btneprodscatsbmt']) != "") && isset($_POST['lstprodcat']) && (trim($_POST['lstprodcat']) != "") && isset($_POST['txtname']) && (trim($_POST['txtname']) != "") && isset($_POST['hdnprodscatid']) && (trim($_POST['hdnprodscatid']) != "") && isset($_POST['txtprior']) && (trim($_POST['txtprior']) != ""))
{
	$id = glb_func_chkvl($_POST['hdnprodscatid']);//id
	$prodmncat = glb_func_chkvl($_POST['lstprodmcat']);//main link
	$prodcat = glb_func_chkvl($_POST['lstprodcat']);//catageroy
	$name = glb_func_chkvl($_POST['txtname']);//name
	$prior = glb_func_chkvl($_POST['txtprior']);//rank
	$prodcattyp  = glb_func_chkvl($_POST['lsttyp']);//list type
	$desc = addslashes(trim($_POST['txtdesc']));//description
	$seotitle = glb_func_chkvl($_POST['txtseotitle']);//seo title
	$seodesc = glb_func_chkvl($_POST['txtseodesc']);//seo desc
	$seokeyword = glb_func_chkvl($_POST['txtkywrd']);//seo keywords
	$seoh1 = glb_func_chkvl($_POST['txtseoh1']);//seo h1
	$seoh2= glb_func_chkvl($_POST['txtseoh2']);//seo h2
	$dtptitle = glb_func_chkvl($_POST['txtdpttitle']);//dept title
	$dtphead = glb_func_chkvl($_POST['txtdpthednm']);//dept head
	$dtpname  = glb_func_chkvl($_POST['txtdptnm']);//dept name
	$pg = glb_func_chkvl($_REQUEST['hdnpage']);
	$countstart = glb_func_chkvl($_REQUEST['hdncnt']);	
	$sts = glb_func_chkvl($_POST['lststs']);
	$hdnscatimg	= glb_func_chkvl($_REQUEST['hdnscatimg']);
	$hdnscatbnrimg	= glb_func_chkvl($_REQUEST['hdnscatbnrimg']);
	$srchval = addslashes(trim($_POST['hdnloc']));
	$curdt = date('Y-m-d h:i:s');

	$sqryprodscat_mst = "SELECT prodscatm_name from prodscat_mst where prodscatm_name='$name' and prodscatm_prodmnlnksm_id='$prodmncat' and prodscatm_prodcatm_id='$prodcat' and prodscatm_id != $id";
	$srsprodscat_mst = mysqli_query($conn,$sqryprodscat_mst);
	$cntscatm = mysqli_num_rows($srsprodscat_mst);
	if($cntscatm < 1)
			{
				$uqryprodscat_mst ="update prodscat_mst set 
				prodscatm_name='$name',
				prodscatm_desc='$desc',
				prodscatm_typ = '$prodcattyp',
				prodscatm_dpttitle ='$dtptitle',
				prodscatm_dpthead='$dtphead',
				prodscatm_dptname='$dtpname',
				prodscatm_seotitle='$seotitle',								
				prodscatm_seodesc = '$seodesc',
				prodscatm_seokywrd = '$seokeyword',
				prodscatm_seohone = '$seoh1',
				prodscatm_seohtwo = '$seoh2',
				prodscatm_sts='$sts',								
				prodscatm_prty ='$prior',
				prodscatm_prodcatm_id='$prodcat',
				prodscatm_prodmnlnksm_id = $prodmncat,								
				prodscatm_mdfdon ='$curdt',
				prodscatm_mdfdby='$ses_admin'	";
		
		if(isset($_FILES['flescatimg']['tmp_name']) && ($_FILES['flescatimg']['tmp_name']!=""))
		{
			$scatimgval = funcUpldImg('flescatimg','scatimg');
			if($scatimgval != "")
			{
				$scatimgary = explode(":",$scatimgval,2);
				$scatdest = $scatimgary[0];
				$scatsource = $scatimgary[1];
			}
			$uqryprodscat_mst .= ", prodscatm_bnrimg='$scatdest'";
		}
		if(isset($_POST['chkbximg']) && ($_POST['chkbximg'] != "")){
			$delimgnm   = glb_func_chkvl($_POST['chkbximg']);	
			$delimgpth  = $a_scat_bnrfldnm.$delimgnm;								
			if(isset($delimgnm) && file_exists($delimgpth)){
				unlink($delimgpth);											
				$uqryprodscat_mst .= ",prodscatm_bnrimg=''";
			}					
		}	
		
		$uqryprodscat_mst .= " where prodscatm_id='$id'";
		$ursprodscat_mst = mysqli_query($conn,$uqryprodscat_mst);
		if($ursprodscat_mst==true)
		{
			if(($scatsource!='none') && ($scatsource!='') && ($scatdest != ""))
			{ 
				$scatimgpth = $a_scat_bnrfldnm.$hdnscatimg;
				if(($hdnscatimg != '') && file_exists($scatimgpth))
				{
					unlink($scatimgpth);
				}
				move_uploaded_file($scatsource,$a_scat_bnrfldnm.$scatdest);
			}
			
			?>
			<script>location.href="view_detail_product_subcategory.php?vw=<?php echo $id;?>&sts=y&pg=<?php echo $pg;?>&countstart=<?php echo $countstart.$srchval;?>";</script>
			<?php
		}
		else
		{ ?>
			<script>location.href="view_detail_product_subcategory.php?vw=<?php echo $id;?>&sts=n&pg=<?php echo $pg;?>&countstart=<?php echo $countstart.$srchval;?>";</script>
			<?php
		}
	}
	else
	{ ?>
		<script>location.href="view_detail_product_subcategory.php?vw=<?php echo $id;?>&sts=d&pg=<?php echo $pg;?>&countstart=<?php echo $countstart;?>";</script>
		<?php
	}
}
?>