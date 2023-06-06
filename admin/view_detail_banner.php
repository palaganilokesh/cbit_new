<?php
include_once '../includes/inc_config.php'; //Making paging validation	
include_once $inc_nocache; //Clearing the cache information
include_once $adm_session; //checking for session
include_once $inc_cnctn; //Making database Connection
include_once $inc_usr_fnctn; //checking for session	
include_once $inc_pgng_fnctns; //Making paging validation
include_once $inc_fldr_pth; //Making paging validation
/***************************************************************
Programm : view_detail_banner.php	
Purpose : For Viewing Banner Details
Created By : Bharath
Created On :	27-12-2021
Modified By : 
Modified On :
Purpose : 
Company : Adroit
************************************************************/
global $id,$pg,$countstart;
$rd_crntpgnm = "view_all_banner.php";
$rd_edtpgnm = "edit_banner.php";
$clspn_val = "4";
/*****header link********/
$pagemncat = "Setup";
$pagecat = "Banner";
$pagenm = "Banner"; 
/*****header link********/
if(isset($_REQUEST['vw']) && (trim($_REQUEST['vw'])!="") && isset($_REQUEST['pg']) && (trim($_REQUEST['pg'])!="") && isset($_REQUEST['countstart']) && (trim($_REQUEST['countstart'])!=""))
{
	$id = glb_func_chkvl($_REQUEST['vw']);
	$pg = glb_func_chkvl($_REQUEST['pg']);
	$countstart = glb_func_chkvl($_REQUEST['countstart']);
	$srchval = glb_func_chkvl($_REQUEST['val']);
}
$sqrybnr_mst = "SELECT bnrm_name, bnrm_desc, bnrm_lnk, if(bnrm_sts = 'a', 'Active','Inactive') as bnrm_sts,bnrm_text, bnrm_prty, bnrm_imgnm 
	from bnr_mst where bnrm_id = $id";
$srsbnr_mst = mysqli_query($conn,$sqrybnr_mst);
$rowsbnr_mst = mysqli_fetch_assoc($srsbnr_mst);
$loc= "&val=$srchval";
if(isset($_REQUEST['sts']) && (trim($_REQUEST['sts']) == "y"))
{
	$msg = "<font color=red>Record updated successfully</font>";
}
elseif(isset($_REQUEST['sts']) && (trim($_REQUEST['sts']) == "n"))
{
	$msg = "<font color=red>Record not updated</font>";
}
elseif(isset($_REQUEST['sts']) && (trim($_REQUEST['sts']) == "d"))
{
	$msg = "<font color=red>Duplicate Recored Name Exists & Record Not updated</font>";
}
?>
<script language="javascript">	
	function update1() //for update download details
	{
		document.frmedtbnrid.action="<?php echo $rd_edtpgnm;?>?vw=<?php echo $id;?>&pg=<?php echo $pg;?>&countstart=<?php echo $countstart.$loc;?>";
		document.frmedtbnrid.submit();
	}
</script>
<?php include_once $inc_adm_hdr; ?>
<section class="content">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">View Banner</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item active">View Banner</li>
					</ol>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>
	<form name="frmedtbnrid" id="frmedtbnrid" method="post" action="<?php $_SERVER['PHP_SELF'];?>" onSubmit="return performCheck('frmedtbnrid', rules, 'inline');">
		<input type="hidden" name="hdnbnrid" value="<?php echo $id;?>">
		<input type="hidden" name="hdnpage" value="<?php echo $pg;?>">
		<input type="hidden" name="hdncnt" value="<?php echo $countstart?>">
		<?php
		if($msg !='')
		{
	 		echo "<center><tr bgcolor='#FFFFFF'>
				<td colspan='4' bgcolor='#F3F3F3' align='center'><strong>$msg</strong></td> 
			 </tr></center>";
		}
		?>
		<div class="card">
			<div class="card-body">
				<div class="row justify-content-center">
					<div class="col-md-12">
						<div class="form-group row">
							<label for="txtname" class="col-sm-2 col-md-2 col-form-label">Name</label>
							<div class="col-sm-8">
								<?php echo $rowsbnr_mst['bnrm_name'];?>
							</div>
						</div>
						<div class="form-group row">
							<label for="txtname" class="col-sm-2 col-md-2 col-form-label">Description</label>
							<div class="col-sm-8">
								<?php echo $rowsbnr_mst['bnrm_desc'];?>
							</div>
						</div>
						<div class="form-group row">
							<label for="txtname" class="col-sm-2 col-md-2 col-form-label">Link</label>
							<div class="col-sm-8">
								<?php echo $rowsbnr_mst['bnrm_lnk'];?>
							</div>
						</div>
						<div class="form-group row">
							<label for="txtname" class="col-sm-2 col-md-2 col-form-label">TextAlign</label>
							<div class="col-sm-8">
						<?php if($rowsbnr_mst['bnrm_text']=='L') echo 'Left';?>
								<?php if($rowsbnr_mst['bnrm_text']=='R') echo 'Right';?>
									<?php if($rowsbnr_mst['bnrm_text']=='C') echo 'Center';?>
							
							</div>
						</div>
						<div class="form-group row">
							<label for="txtname" class="col-sm-2 col-md-2 col-form-label">Image</label>
							<div class="col-sm-8">
								<?php
								$bnrimgnm = $rowsbnr_mst['bnrm_imgnm'];
								$bnrimgpath  = $gbnr_fldnm.$bnrimgnm;
								if(($bnrimgnm !="") && file_exists($bnrimgpath))
								{
									echo "<img src='$bnrimgpath' width='100pixel' height='100pixel'>";
								}
								else
								{
									echo "Image not available";
								}
								?>	
							</div>
						</div>
						<div class="form-group row">
							<label for="txtname" class="col-sm-2 col-md-2 col-form-label">Rank</label>
							<div class="col-sm-8">
								<?php echo $rowsbnr_mst['bnrm_prty'];?>
							</div>
						</div>
						<div class="form-group row">
							<label for="txtname" class="col-sm-2 col-md-2 col-form-label">Status</label>
							<div class="col-sm-8"> 
								<?php echo $rowsbnr_mst['bnrm_sts'];?>
							</div>
						</div>
						<p class="text-center">
							<input type="Submit" class="btn btn-primary btn-cst" name="frmedtbnrid" id="frmedtbnrid" value="Edit" 
							onclick="update1();">
							&nbsp;&nbsp;&nbsp;
							<input type="button" name="btnBack" value="Back" class="btn btn-primary btn-cst" onclick="location.href='<?php echo $rd_crntpgnm;?>?<?php echo $loc;?>'">
						</p>
					</div>
				</div>
			</div>
		</div>
	</form> 
</section>
<?php include_once "../includes/inc_adm_footer.php";?>