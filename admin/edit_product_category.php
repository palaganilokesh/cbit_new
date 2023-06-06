<?php
include_once '../includes/inc_config.php'; //Making paging validation	
include_once $inc_nocache; //Clearing the cache information
include_once $adm_session; //checking for session
include_once $inc_cnctn; //Making database Connection
include_once $inc_usr_fnctn; //checking for session	
include_once $inc_pgng_fnctns; //Making paging validation
include_once $inc_fldr_pth; //Making paging validation
/***********************************************************
Programm : edit_product_category.php	
Package : 
Purpose : For Edit Vehicle Product Category
Created By : Bharath
Created On : 20-01-2022
Modified By : 
Modified On : 
Purpose : 
Company : Adroit
 ************************************************************/
global $id, $pg, $countstart;
$rd_vwpgnm = "view_detail_product_category.php";
$clspn_val = "4";
/*****header link********/
$pagemncat = "Setup";
$pagecat = "Product Group";
$pagenm = "Category";
/*****header link********/
if (isset($_POST['btneprodcatsbmt']) && (trim($_POST['btneprodcatsbmt']) != "") && isset($_POST['txtname']) && (trim($_POST['txtname']) != "") && isset($_POST['txtprty']) && (trim($_POST['txtprty']) != "")) {
	include_once "../includes/inc_fnct_fleupld.php";
	include_once "../database/uqry_prodcat_mst.php";
}
if (isset($_REQUEST['edit']) && (trim($_REQUEST['edit']) != "") && isset($_REQUEST['pg']) && (trim($_REQUEST['pg']) != "") && isset($_REQUEST['countstart']) && (trim($_REQUEST['countstart']) != "")) {
	$id = glb_func_chkvl($_REQUEST['edit']);
	$pg = glb_func_chkvl($_REQUEST['pg']);
	$countstart = glb_func_chkvl($_REQUEST['countstart']);
	$srchval = glb_func_chkvl($_REQUEST['val']);
} elseif (isset($_REQUEST['hdnprodcatid']) && (trim($_REQUEST['hdnprodcatid']) != "") && isset($_REQUEST['hdnpage']) && (trim($_REQUEST['hdnpage']) != "") && isset($_REQUEST['hdncnt']) && (trim($_REQUEST['hdncnt']) != "")) {
	$id = glb_func_chkvl($_REQUEST['hdnprodcatid']);
	$pg = glb_func_chkvl($_REQUEST['hdnpage']);
	$countstart = glb_func_chkvl($_REQUEST['hdncnt']);
	$srchval = glb_func_chkvl($_REQUEST['val']);
	$chk = glb_func_chkvl($_REQUEST['chk']);
}
$sqryprodcat_mst = "select 
								prodcatm_name,prodcatm_desc,prodcatm_seotitle,prodcatm_seodesc,
								prodcatm_seohone,prodcatm_seohtwo,prodcatm_seokywrd,prodcatm_prty,
								 prodcatm_sts,
								prodcatm_typ,prodcatm_dsplytyp,prodcatm_bnrimg,prodcatm_prodmnlnksm_id,
								prodmnlnksm_name,prodmnlnksm_id,prodcatm_icn
							from 
								prodcat_mst
						inner join prodmnlnks_mst
						on		prodmnlnks_mst.prodmnlnksm_id=prodcat_mst.prodcatm_prodmnlnksm_id
							where 
								prodcatm_id='$id'";
$srsprodcat_mst  = mysqli_query($conn, $sqryprodcat_mst);
$cntrecprodcat_mst = mysqli_num_rows($srsprodcat_mst);
if ($cntrecprodcat_mst  > 0) {
	$rowsprodcat_mst = mysqli_fetch_assoc($srsprodcat_mst);
	$db_mnlnksid	 = $rowsprodcat_mst['prodmnlnksm_id'];
	$db_mnlnksnm	 = $rowsprodcat_mst['prodmnlnksm_name'];
	$db_catmnlnksid	 = $rowsprodcat_mst['prodcatm_prodmnlnksm_id'];
	$db_catname		 = $rowsprodcat_mst['prodcatm_name'];
	$db_catdesc		 = stripslashes($rowsprodcat_mst['prodcatm_desc']);
	$db_cattyp		 = $rowsprodcat_mst['prodcatm_typ'];
	$db_dsplytyp     = $rowsprodcat_mst['prodcatm_dsplytyp'];
	$db_catseottl	 = $rowsprodcat_mst['prodcatm_seotitle'];
	$db_catseodesc	 = $rowsprodcat_mst['prodcatm_seodesc'];
	$db_catseokywrd	 = $rowsprodcat_mst['prodcatm_seokywrd'];
	$db_catseohone	 = $rowsprodcat_mst['prodcatm_seohone'];
	$db_catseohtwo	 = $rowsprodcat_mst['prodcatm_seohtwo'];
	$db_catprty		 = $rowsprodcat_mst['prodcatm_prty'];
	$db_catsts		 = $rowsprodcat_mst['prodcatm_sts'];
}
$loc = "&val=$srchval";
$pagetitle = "Edit Category";
?>
<script language="javaScript" type="text/javascript" src="js/ckeditor.js"></script>
<script language="javascript" src="../includes/yav.js"></script>
<script language="javascript" src="../includes/yav-config.js"></script>
<link rel="stylesheet" type="text/css" href="../includes/yav-style1.css">
<script language="javascript" type="text/javascript">
	var rules = new Array();
	rules[0] = 'lstcat:Category|required|Select Main Link';
	rules[1] = 'txtname:Name|required|Enter Category Name';
	rules[2] = 'txtprty:Priority|required|Enter Rank';
	rules[3] = 'txtprty:Priority|numeric|Enter Only Numbers';

	function setfocus() {
		document.getElementById('txtname').focus();
	}
</script>
<?php
include_once('script.php');
include_once('../includes/inc_fnct_ajax_validation.php');
?>
<script language="javascript" type="text/javascript">
	function funcChkDupName() {
		var name;
		name = document.getElementById('txtname').value;
		var prodmcatid = document.getElementById('lstcat').value;
		id = <?php echo $id; ?>;
		if (name != "" && prodmcatid != "" && id != "") {
			var url = "chkduplicate.php?prodcatname=" + name + "&prodmcatid=" + prodmcatid + "&prodcatid=" + id;
			xmlHttp = GetXmlHttpObject(stateChanged);
			xmlHttp.open("GET", url, true);
			xmlHttp.send(null);
		} else {
			document.getElementById('errorsDiv_txtname').innerHTML = "";
		}
	}

	function stateChanged() {
		if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {
			var temp = xmlHttp.responseText;
			document.getElementById("errorsDiv_txtname").innerHTML = temp;
			if (temp != 0) {
				document.getElementById('txtname').focus();
			}
		}
	}
</script>
<?php
include_once $inc_adm_hdr;
include_once $inc_adm_lftlnk;
?>
<section class="content">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">Edit Category</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item active">Edit Category</li>
					</ol>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>
	<form name="frmedtprodcatid" id="frmedtprodcatid" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data" onSubmit="return performCheck('frmedtprodcatid', rules, 'inline');">
		<input type="hidden" name="hdnprodcatid" value="<?php echo $id; ?>">
		<input type="hidden" name="hdnpage" value="<?php echo $pg; ?>">
		<input type="hidden" name="hdnval" value="<?php echo $srchval; ?>">
		<input type="hidden" name="hdnchk" value="<?php echo $chk; ?>">
		<input type="hidden" name="hdncnt" value="<?php echo $countstart ?>">
		<input type="hidden" name="hdnbgimg" id="hdnbgimg" value="<?php echo $rowsprodcat_mst['prodcatm_bnrimg']; ?>">
		<input type="hidden" name="hdnsmlimg" id="hdnsmlimg" value="<?php echo $rowsprodscat_mst['prodcatm_icn']; ?>">
		<div class="card">
			<div class="card-body">
				<div class="row justify-content-center">
					<div class="col-md-12">
						<div class="row mb-2 mt-2">
							<div class="col-sm-3">
								<label>Main Links *</label>
							</div>
							<div class="col-sm-9">
								<?php
								$sqryprodmncat_mst = "select 
								prodmnlnksm_id,prodmnlnksm_name						
							from 
								prodmnlnks_mst 
							where	 
								prodmnlnksm_sts = 'a'
							order by
							   prodmnlnksm_name";
								$srsprodcat_mst1   = mysqli_query($conn, $sqryprodmncat_mst);
								$cnt_prodmncat = mysqli_num_rows($srsprodcat_mst1);
								?>
								<select name="lstcat" id="lstcat" class="form-control">
									<option value="">--Select Main Category--</option>
									<?php
									if ($cnt_prodmncat > 0) {
										while ($rowsprodmncat_mst = mysqli_fetch_assoc($srsprodcat_mst1)) {
											$mncatid = $rowsprodmncat_mst['prodmnlnksm_id'];
											$mncatname = $rowsprodmncat_mst['prodmnlnksm_name'];
									?>
											<option value="<?php echo $mncatid; ?>" <?php if ($db_catmnlnksid == $mncatid) echo 'selected';  ?>><?php echo $mncatname; ?></option>
									<?php
										}
									}
									?>
								</select>
								<span id="errorsDiv_lstcat"></span>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="row mb-2 mt-2">
							<div class="col-sm-3">
								<label>Category Name *</label>
							</div>
							<div class="col-sm-9">
								<input name="txtname" type="text" id="txtname" size="45" maxlength="40" onBlur="funcChkDupName()" class="form-control" value="<?php echo $db_catname; ?>">
								<span id="errorsDiv_txtname"></span>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="row mb-2 mt-2">
							<div class="col-sm-3">
								<label>Description</label>
							</div>
							<div class="col-sm-9">
								<textarea name="txtdesc" cols="60" rows="3" id="txtdesc" class="form-control"><?php echo $db_catdesc; ?></textarea>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="row mb-2 mt-2">
							<div class="col-sm-3">
								<label>Baner Image</label>
							</div>
							<div class="col-sm-9">
								<div class="custom-file">
									<input name="flebnrimg" type="file" class="form-control" id="flebnrimg">
								</div>
								<?php
								$imgnm   = $rowsprodcat_mst['prodcatm_bnrimg'];
								$imgpath = $a_cat_bnrfldnm . $imgnm;
								if (($imgnm != "") && file_exists($imgpath)) {
									echo "<img src='$imgpath' width='80pixel' height='80pixel'><br><input type='checkbox' name='chkbximg' id='chkbximg' value='$imgpath'>Remove Image";
								} else {
									echo "N.A.";
								}
								?>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="row mb-2 mt-2">
							<div class="col-sm-3">
								<label>Icon</label>
							</div>
							<div class="col-sm-9">
								<div class="custom-file">
									<input name="icnimg" type="file" class="form-control" id="icnimg">
								</div>
								<?php
								$imgnm   = $rowsprodcat_mst['prodcatm_icn'];
								$imgpath = $a_cat_icnfldnm . $imgnm;
								if (($imgnm != "") && file_exists($imgpath)) {
									echo "<img src='$imgpath' width='80pixel' height='80pixel'><br><input type='checkbox' name='chkbxicn' id='chkbxicn' value='$imgpath'>Remove Image";
								} else {
									echo "N.A.";
								}
								?>
							</div>
						</div>
					</div>

					<div class="col-md-12">
						<div class="row mb-2 mt-2">
							<div class="col-sm-3">
								<label>Type</label>
							</div>
							<div class="col-sm-9">
								<select name="lstcattyp" id="lstcattyp" class="form-control">
									<option value="g" <?php if ($db_cattyp == 'g') echo 'selected'; ?>>General</option>
									<option value="d" <?php if ($db_cattyp == 'd') echo 'selected'; ?>>Department</option>
									<option value="n" <?php if ($db_cattyp == 'n') echo 'selected'; ?>>News</option>
								</select>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="row mb-2 mt-2">
							<div class="col-sm-3">
								<label>Display Type</label>
							</div>
							<div class="col-sm-9">
								<select name="lstdsplytyp" id="lstdsplytyp" class="form-control">

									<option value="1" <?php if ($db_dsplytyp == '1') echo 'selected'; ?>>General</option>
									<option value="2" <?php if ($db_dsplytyp == '2') echo 'selected'; ?>>Tabular</option>
								</select>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="row mb-2 mt-2">
							<div class="col-sm-3">
								<label>SEO Title</label>
							</div>


							<div class="col-sm-9">
								<input type="text" name="txtseotitle" id="txtseotitle" size="45" maxlength="250" class="form-control" value="<?php echo $db_catseottl; ?>">
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="row mb-2 mt-2">
							<div class="col-sm-3">
								<label>SEO Description</label>
							</div>
							<div class="col-sm-9">
								<textarea name="txtseodesc" rows="3" cols="60" id="txtseodesc" class="form-control"><?php echo $db_catseodesc; ?></textarea>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="row mb-2 mt-2">
							<div class="col-sm-3">
								<label>SEO Keyword</label>
							</div>
							<div class="col-sm-9">
								<textarea name="txtseokywrd" rows="3" cols="60" id="txtseokywrd" class="form-control"><?php echo $db_catseokywrd; ?></textarea>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="row mb-2 mt-2">
							<div class="col-sm-3">
								<label>SEO H1 </label>
							</div>
							<div class="col-sm-9">
								<input type="text" name="txtseoh1" id="txtseoh1" size="45" maxlength="250" class="form-control" value="<?php echo $db_catseohone; ?>">
							</div>
						</div>
					</div>

					<div class="col-md-12">
						<div class="row mb-2 mt-2">
							<div class="col-sm-3">
								<label>SEO H2 </label>
							</div>
							<div class="col-sm-9">
								<input type="text" name="txtseoh2" id="txtseoh2" size="45" maxlength="250" class="form-control" value="<?php echo $db_catseohtwo; ?>">
							</div>
						</div>
					</div>

					<div class="col-md-12">
						<div class="row mb-2 mt-2">
							<div class="col-sm-3">
								<label>Rank *</label>
							</div>
							<div class="col-sm-9">
								<input type="text" name="txtprty" id="txtprty" class="form-control" size="4" maxlength="3" value="<?php echo $db_catprty; ?>">
								<span id="errorsDiv_txtprty"></span>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="row mb-2 mt-2">
							<div class="col-sm-3">
								<label>Status</label>
							</div>
							<div class="col-sm-9">
								<select name="lststs" id="lststs" class="form-control">
									<option value="a" <?php if ($db_catsts == 'a') echo 'selected'; ?>>Active</option>
									<option value="i" <?php if ($db_catsts == 'i') echo 'selected'; ?>>Inactive</option>
								</select>
							</div>
						</div>
					</div>
					<p class="text-center">
						<input type="Submit" class="btn btn-primary btn-cst" name="btneprodcatsbmt" id="btneprodcatsbmt" value="Submit">
						&nbsp;&nbsp;&nbsp;
						<input type="reset" class="btn btn-primary btn-cst" name="btnprodcatreset" value="Clear" id="btnprodcatreset">
						&nbsp;&nbsp;&nbsp;
						<input type="button" name="btnBack" value="Back" class="btn btn-primary btn-cst" onclick="location.href='<?php echo $rd_vwpgnm; ?>?vw=<?php echo $id; ?>&pg=<?php echo $pg; ?>&countstart=<?php echo $countstart . $loc; ?>'">
					</p>
				</div>
			</div>
		</div>
	</form>
</section>
<?php include_once "../includes/inc_adm_footer.php"; ?>
<script language="javascript" type="text/javascript">
	CKEDITOR.replace('txtdesc');
</script>