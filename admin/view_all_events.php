<?php
error_reporting(0);
include_once '../includes/inc_config.php'; //Making paging validation 
include_once $inc_nocache; //Clearing the cache information
include_once $adm_session; //checking for session
include_once $inc_cnctn; //Making database Connection
include_once $inc_usr_fnctn; //checking for session 
include_once $inc_pgng_fnctns; //Making paging validation 
include_once $inc_fldr_pth; //Making paging validation
/***************************************************************/
//Programm 	  : events.php
//Package 	  : APVC
//Purpose 	  : For Viewing New events 
//Created By  : 
//Created On  :
//Modified On : 
//Company 	  : Adroit
/************************************************************/
global $msg, $loc, $rowsprpg, $dispmsg, $disppg;
$loc = "";
$clspn_val = "6";
$rd_adpgnm = "add_event.php";
$rd_edtpgnm = "edit_event.php";
$rd_crntpgnm = "view_all_events.php";
$rd_vwpgnm = "view_detail_event.php";


/*****header link********/
$pagemncat = "Setup";
$pagecat = "Events";
$pagenm = "Events";
/*****header link********/

if (($_POST['hidchksts'] != "") && isset($_REQUEST['hidchksts'])) {
	$dchkval = substr($_POST['hidchksts'], 1);
	$id  	 = glb_func_chkvl($dchkval);

	$updtsts = funcUpdtAllRecSts('evnt_mst', 'evntm_id', $id, 'evntm_sts');
	if ($updtsts == 'y') {
		$msg = "<font color=red>Record updated successfully</font>";
	} elseif ($updtsts == 'n') {
		$msg = "<font color=red>Record not updated</font>";
	}
}
if (($_POST['hidchkval'] != "") && isset($_REQUEST['hidchkval'])) {
	$dchkval    =  substr($_POST['hidchkval'], 1);
	$did 	    =  glb_func_chkvl($dchkval);
	$del        =  explode(',', $did);
	$count      =  sizeof($del);
	$img        =  array();
	$imgpth     =  array();
	for ($i = 0; $i < $count; $i++) {
		$sqryevnt_mst = "SELECT 
			                       evntm_img
							    from 
					               evnt_mst
					            where
					                evntm_id=$del[$i]";
		$srsevnt_mst     = mysqli_query($conn, $sqryevnt_mst);
		$srowevnt_mst    = mysqli_fetch_assoc($srsevnt_mst);
		$img[$i]         = glb_func_chkvl($srowevnt_mst['evntm_img']);
		$imgpth[$i]      = $imgevnt_fldnm . $img[$i];
	}
	$delsts = funcDelAllRec('evnt_mst', 'evntm_id', $did);
	if ($delsts == 'y') {
		for ($i = 0; $i < $count; $i++) {
			if (($img[$i] != "") && file_exists($imgpth[$i])) {
				unlink($imgpth[$i]);
			}
		}
		$msg   = "<font color=red>Record deleted successfully</font>";
	} elseif ($delsts == 'n') {
		$msg  = "<font color=red>Record can't be deleted(child records exist)</font>";
	}
}
/*if(($_POST['hidchkval']!="") && isset($_REQUEST['hidchkval'])){
		$dchkval    =  substr($_POST['hidchkval'],1);
		$did 	    =  glb_func_chkvl($dchkval);
		
				//echo "hi".$dchkval." Hello";

		$delsts = funcDelAllRec($conn,'evnt_mst','evntm_id',$did);										
		if($delsts == 'y'){
			$msg   = "<font color=red>Record deleted successfully</font>";
		}
		elseif($delsts == 'n'){
			$msg  = "<font color=red>Record can't be deleted(child records exist)</font>";
		}
    }*/
if (isset($_REQUEST['sts']) && (trim($_REQUEST['sts']) == "y")) {
	$msg = "<font color=red>Record updated successfully</font>";
} elseif (isset($_REQUEST['sts']) && (trim($_REQUEST['sts']) == "n")) {
	$msg = "<font color=red>Record not updated</font>";
} elseif (isset($_REQUEST['sts']) && (trim($_REQUEST['sts']) == "d")) {
	$msg = "<font color=red>Duplicate Recored Name Exists & Record Not updated</font>";
}

$rowsprpg  = 20; //maximum rows per page
include_once "../includes/inc_paging1.php"; //Includes pagination	
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	<title><?php echo $pgtl; ?></title>
	<?php include_once('script.php') ?>
	<script language="javascript">
		function addnew() {
			var val = document.frmevnt.txtsrchval.value;
			document.frmevnt.action = "add_event.php";
			document.frmevnt.submit();
		}
	</script>
	<script language="javascript">

		function srch() {
			if (document.frmevnt.txtsrchval.value == "") {
				alert("select search criteria");
				document.frmevnt.txtsrchval.focus();
				return false;
			}
			if (document.frmevnt.txtsrchval.value != "") {
				var optn = document.frmevnt.txtsrchval.value;
			
						}
		
			return true;
		}
	</script>
<script language="javascript" type="text/javascript" src="../includes/chkbxvalidate.js"></script>
<link href="docstyle.css" rel="stylesheet" type="text/css">


<body>
	<?php include_once $inc_adm_hdr; ?>
	<section class="content">
		<div class="content-header">
			<div class="container-fluid">
				<div class="row mb-2">
					<div class="col-sm-6">
						<h1 class="m-0 text-dark">View All
							Events</h1>
					</div><!-- /.col -->
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item"><a href="#">Home</a></li>
							<li class="breadcrumb-item active">View All
								Events</li>
						</ol>
					</div><!-- /.col -->
				</div><!-- /.row -->
			</div><!-- /.container-fluid -->
		</div>
		<!-- Default box -->
		<div class="card">
			<?php if (isset($_REQUEST['sts']) && (trim($_REQUEST['sts']) == "y")) { ?>
				<div class="alert alert-danger alert-dismissible fade show" role="alert" id="delids" style="display:none">
					<strong>Deleted Successfully !</strong>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
			<?php
			}
			?>
			<div class="alert alert-warning alert-dismissible fade show" role="alert" id="updid" style="display:none">
				<strong>Updated Successfully !</strong>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="alert alert-info alert-dismissible fade show" role="alert" id="sucid" style="display:none">
				<strong>Added Successfully !</strong>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="card-body p-0">

				<form method="post" action="<?php $_SERVER['SCRIPT_FILENAME']; ?>" name="frmevnt" id="frmevnt">

					<input type="hidden" name="hidchkval" id="hidchkval">
					<input type="hidden" name="hidchksts" id="hidchksts">
					<input type="hidden" name="hdnallval" id="hdnallval">
					<div class="col-md-12">
						<div class="row justify-content-left align-items-center mt-3">
							<div class="col-sm-5">
								<div class="form-group">
									<div class="col-8">
										<div class="row">
											<div class="col-10">
												<input type="text" name="txtsrchval" placeholder="Search by name" id="txtsrchval" class="form-control" value="<?php if (isset($_REQUEST['txtsrchval']) && $_REQUEST['txtsrchval'] != "") {
																																																																				echo $_REQUEST['txtsrchval'];
																																																																			} ?>">
											</div>
										</div>
									</div>
								</div>
							</div>


							<div class="col-sm-4">
								<div class="form-group">Exact
									<!-- <input type="checkbox" name="chkexact" value="y" <?php if (isset($_POST['chkexact']) && ($_POST['chkexact'] == 1)) {
																																					echo 'checked';
																																				} elseif (isset($_REQUEST['chk']) && ($_REQUEST['chk'] == 'y')) {
																																					echo 'checked';
																																				} ?>> -->
									<input type="checkbox" name="chkexact" value="y" <?php
																																		if (isset($_REQUEST['chkexact']) && (glb_func_chkvl($_REQUEST['chkexact']) == 'y')) {
																																			echo 'checked';
																																		}
																																		?> id="chkexact">
									&nbsp;&nbsp;&nbsp;
									<input type="submit" value="Search" class="btn btn-primary" name="button" onClick="srch()">
									<a href="<?php echo $rd_crntpgnm; ?>" class="btn btn-primary">Refresh</a>
									<button type="submit" class="btn btn-primary" onClick="addnew();">+ Add</button>
								</div>
							</div>
						</div>
					</div>
					<div class="card-body p-0">
						<div class="table-responsive">
							<table width="100%" border="0" cellpadding="3" cellspacing="1" class="table table-striped projects">
								<tr>
									<td colspan="<?php echo $clspn_val; ?>" align="center">
										<!-- <?PHP if ($msg != "") {
														echo $msg;
													}
													?> -->
									</td>
									<td width="7%" align="right" valign="bottom">
										<div align="right">

											<input name="btnsts" id="btnsts" type="button" class="btn btn-xs btn-primary" value="Status" onClick="updatests('hdnchksts','frmevnt','chksts')">
										</div>
									</td>
									<td width="7%" align="right" valign="bottom">
										<div align="right">
											<input name="btndel" id="btndel" type="button" class="btn btn-xs btn-primary" value="Delete" onClick="deleteall('hdnchkval','frmevnt','chkdlt');">
										</div>
									</td>
								</tr>
								<tr>

									<td width="10%" class="td_bg" align="left"><strong>Sl.No.</strong></td>
									<td width="31%" class="td_bg" align="left"><strong>Name</strong></td>
									<td width="14%" class="td_bg" align="left"><strong>City</strong></td>
									<td width="14%" class="td_bg" align="left"><strong>Date</strong></td>
									<td width="7%" class="td_bg" align="center"><strong>Priority</strong></td>
									<td width="10%" class="td_bg" align="center"><strong>Edit</strong></td>
									<td width="7%" class="td_bg" align="center"><strong>
											<input type="checkbox" name="Check_ctr" id="Check_ctr" value="yes" onClick="Check(document.frmevnt.chksts,'Check_ctr','hdnallval')"></strong></td>
									<td width="7%" class="td_bg" align="center"><strong>
											<input type="checkbox" name="Check_dctr" id="Check_dctr" value="yes" onClick="Check(document.frmevnt.chkdlt,'Check_dctr')">
								</tr>
								<?php
								$sqryevnt_mst1 = "select 
									evntm_id,evntm_name,evntm_fle,evntm_sts,
							   	    evntm_prty,date_format(evntm_strtdt,'%d-%m-%Y') as evntm_strtdt,evntm_city
							   from evnt_mst";

								if (
									isset($_REQUEST['optn']) && ($_REQUEST['optn']) == 'n' &&
									isset($_REQUEST['val']) && ($_REQUEST['val'] != "")
								) {
									$val = glb_func_chkvl($_REQUEST['val']);
									if (isset($_REQUEST['chk']) && ($_REQUEST['chk'] == 'y')) {
										$loc = "&optn=n&val=" . $val . "&chk=y";
										$sqryevnt_mst1 .= " where evntm_name like '$val'";
									} else {
										$loc = "&optn=n&val=" . $val;
										$sqryevnt_mst1 .= " where evntm_name like '%$val%'";
									}
								} else if (
									isset($_REQUEST['optn']) && ($_REQUEST['optn']) == 'c' &&
									isset($_REQUEST['val']) && $_REQUEST['val'] != ""
								) {
									$val = glb_func_chkvl($_REQUEST['val']);
									if (isset($_REQUEST['chk']) && $_REQUEST['chk'] == 'y') {
										$loc = "&optn=c&val=" . $val . "&chk=y";
										$sqryevnt_mst1 .= " where evntm_city='$val'";
									} else {
										$loc = "&optn=c&val=" . $value;
										$sqryevnt_mst1 .= " where evntm_city like '%$val%'";
									}
								} else if (
									isset($_REQUEST['optn']) && ($_REQUEST['optn']) == 'stdt' &&
									isset($_REQUEST['val']) && ($_REQUEST['val'] != "")
								) {
									$val = glb_func_chkvl($_REQUEST['val']);
									$val = date('Y-m-d', strtotime($val));
									if (isset($_REQUEST['chk']) && ($_REQUEST['chk'] == 'y')) {
										$loc = "&optn=stdt&val=" . $val . "&chk=y";
										$sqryevnt_mst1 .= " where evntm_strtdt like '$val'";
									} else {
										$loc = "&optn=stdt&val=" . $val;
										$sqryevnt_mst1 .= " where evntm_strtdt like '%$val%'";
									}
								}
								$sqryevnt_mst = $sqryevnt_mst1 . " order by evntm_name asc
							                   limit $offset,$rowsprpg";
								$srsevnt_mst = mysqli_query($conn, $sqryevnt_mst) or die(mysqli_error());
								$cnt = $offset;
								$cont = mysqli_num_rows($srsevnt_mst);
								if ($cont == 0) {
									echo "	<tr bgcolor='#F2F1F1'>
							<td  colspan='8' align='center'>
								No Records Found
							</td>
						</tr>";
								} else if ($cont > 0) {
									while ($srowevnt_mst = mysqli_fetch_assoc($srsevnt_mst)) {
										$cnt += 1;
										$db_evntmid	= $srowevnt_mst['evntm_id'];

								?>
										<tr <?php if ($cnt % 2 == 0) {
													echo "bgcolor='#f1f6fd'";
												} else {
													echo "bgcolor='#f1f6fd'";
												} ?>>
											<td><?php echo $cnt; ?></td>
											<td align="left">
												<a href="view_event.php?edit=<?php echo $srowevnt_mst['evntm_id']; ?>&pg=<?php echo $pgnum; ?>&countstart=<?php echo $cntstart . $loc; ?>" class="links">
													<?php echo $srowevnt_mst['evntm_name']; ?>
												</a>
											</td>
											<td align="left"><?php echo $srowevnt_mst['evntm_city']; ?></td>
											<td align="left"><?php echo $srowevnt_mst['evntm_strtdt']; ?></td>
											<td align="left"><?php echo $srowevnt_mst['evntm_prty']; ?></td>
											<td align="center">
												<a href="edit_event.php?edit=<?php echo $srowevnt_mst['evntm_id']; ?>&pg=<?php echo $pgnum; ?>&countstart=<?php echo $cntstart . $loc; ?>" class="contentlinks">
													Edit
												</a>
											</td>
											<td align="center">
												<input type="checkbox" name="chksts" id="chksts" value="<?php echo $db_evntmid; ?>" <?php if ($srowevnt_mst['evntm_sts'] == 'a') {
																																																							echo "checked";
																																																						} ?> onClick="addchkval(<?php echo $db_evntmid; ?>,'hidchksts','frmevnt','chksts');">
											</td>
											<td align="center">
												<input type="checkbox" name="chkdlt" id="chkdlt" value="<?php echo $db_evntmid; ?>">
											</td>
										</tr>

								<?php
									}
								}
								?>
								<tr>
									<td colspan="<?php echo $clspn_val; ?>">&nbsp;</td>
									<td width="7%" align="right" valign="bottom">
										<div align="right">
											<input name="btnsts" id="btnsts" type="button" value="Status" onClick="updatests('hdnchksts','frmevnt','chksts')" class="btn btn-xs btn-primary">
										</div>
									</td>
									<td width="7%" align="right" valign="bottom">
										<div align="right">
											<input name="btndel" id="btndel" type="button" value="Delete" onClick="deleteall('hdnchkval','frmevnt','chkdlt');" class="btn btn-xs btn-primary">
										</div>
									</td>
								</tr>

								<?php
								$disppg = funcDispPag($conn, 'links', $loc, $sqryevnt_mst1, $rowsprpg, $cntstart, $pgnum);
								$colspanval = $clspn_val + 2;
								if ($disppg != "") {
									$disppg = "<br><tr><td colspan='$colspanval' align='center' >$disppg</td></tr>";
									echo $disppg;
								}
								if ($msg != "") {
									$dispmsg = "<tr><td colspan='$colspanval' align='center' >$msg</td></tr>";
									echo $dispmsg;
								}



								?>
							</table>
						</div>
					</div>
				</form>
			</div>
			<!-- /.card-body -->
		</div>
		<!-- /.card -->
	</section>
</body>
<?php include_once "../includes/inc_adm_footer.php"; ?>