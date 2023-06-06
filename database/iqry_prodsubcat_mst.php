<?php	
include_once '../includes/inc_config.php'; //Making paging validation
include_once $inc_nocache; //Clearing the cache information
include_once $adm_session; //checking for session
include_once $inc_cnctn; //Making database Connection
include_once $inc_usr_fnctn; //checking for session
include_once $inc_pgng_fnctns; //Making paging validation
include_once $inc_fldr_pth; //Making paging validation
global $ses_admin;
if(isset($_POST['btnprodscatsbmt']) && (trim($_POST['btnprodscatsbmt']) != "") && isset($_POST['lstprodmcat']) && (trim($_POST['lstprodmcat']) != "") && isset($_POST['lstprodcat']) && (trim($_POST['lstprodcat']) != "") && isset($_POST['txtname']) && (trim($_POST['txtname']) != "") && isset($_POST['txtprior']) && (trim($_POST['txtprior']) != ""))
{
	$name = glb_func_chkvl($_POST['txtname']);//sub cat name
	$prodmncat = glb_func_chkvl($_POST['lstprodmcat']);//main link id
	$prodcat = glb_func_chkvl($_POST['lstprodcat']);//sub cat id
	$prodcattyp   = glb_func_chkvl($_POST['lsttyp']);//list type
	$desc = addslashes(trim($_POST['txtdesc']));//sub cat desc
	$prior = glb_func_chkvl($_POST['txtprior']);//rank
	
	$title = glb_func_chkvl($_POST['txtseotitle']);
	$seodesc = glb_func_chkvl($_POST['txtseodesc']);
	$seokywrd = glb_func_chkvl($_POST['txtseokywrd']);
	$dtptitle  = glb_func_chkvl($_POST['txtdpttitle']);
	$dtphead  = glb_func_chkvl($_POST['txtdpthednm']);
	$dtpname  = glb_func_chkvl($_POST['txtdptnm']);
	$seoh1  = glb_func_chkvl($_POST['txtseohone']);
	$seoh2  = glb_func_chkvl($_POST['txtseohtwo']);
	$sts = glb_func_chkvl($_POST['lststs']);//status
	$curdt = date('Y-m-d h-i-s');
	$sqryprodsubcat_mst = "SELECT prodscatm_name,prodscatm_prodcatm_id,prodscatm_prodmnlnksm_id from prodscat_mst where prodscatm_name ='$name' and prodscatm_prodmncatm_id = '$prodmncat' and prodscatm_prodcatm_id='$prodcat'";
	$srsprodsubcat_mst = mysqli_query($conn,$sqryprodsubcat_mst);
	$rows = mysqli_num_rows($srsprodsubcat_mst);
	if($rows < 1)
	{
		if(isset($_FILES['flescatimg']['tmp_name']) && ($_FILES['flescatimg']['tmp_name']!=""))
		{
			$scatimgval = funcUpldImg('flescatimg','scatimg');
			if($scatimgval != "")
			{
				$scatimgary = explode(":",$scatimgval,2);
				$scatdest = $scatimgary[0];
				$scatsource = $scatimgary[1];
			}
		}
		
	 $iqryprodsubcat_mst="INSERT into prodscat_mst
		( prodscatm_name,
		prodscatm_desc,
		prodscatm_bnrimg,
		prodscatm_typ,
		prodscatm_seotitle,
		prodscatm_seodesc,
		prodscatm_seokywrd,
		prodscatm_seohone,
		prodscatm_seohtwo,
		prodscatm_prodcatm_id,
		prodscatm_prodmnlnksm_id,
		prodscatm_dpttitle,
		prodscatm_dpthead,
		prodscatm_dptname,
		prodscatm_sts,
		prodscatm_prty,
		prodscatm_crtdon,prodscatm_crtdby) 
		
		values ('$name','$desc','$scatdest','$prodcattyp','$title', '$seodesc','$seokywrd','$seoh1','$seoh2','$prodcat','$prodmncat','$dtptitle','$dtphead' ,'$dtpname','$sts','$prior','$curdt','$ses_admin')";
		$irsprodsubcat_mst= mysqli_query($conn,$iqryprodsubcat_mst) or die(mysqli_error($mysql));
		if($irsprodsubcat_mst==true)
		{
			if(($scatsource!='none') && ($scatsource!='') && ($scatdest != ""))
			{
				move_uploaded_file($scatsource,$a_scat_bnrfldnm.$scatdest);
			}
			
			$gmsg = "Record saved successfully";
		}
		else
		{
			$gmsg = "Record not saved";
		}
	}
	else
	{
		$gmsg = "Duplicate name. Record not saved";
	}
}
?>