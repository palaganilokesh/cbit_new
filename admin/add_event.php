<?php
include_once '../includes/inc_config.php'; //Making paging validation
include_once $inc_nocache; //Clearing the cache information
include_once $adm_session; //checking for session
include_once $inc_cnctn; //Making database Connection
include_once $inc_usr_fnctn; //checking for session 
include_once $inc_pgng_fnctns; //Making paging validation
include_once $inc_fldr_pth; //Making paging validation
include_once 'searchpopcalendar.php';
/**********************************************************
Programm : add_banner.php 
Purpose : For add Vehicle Brand Details
Created By : Bharath
Created On : 25-12-2021
Modified By : 
Modified On : 
Purpose : 
Company : Adroit
 ************************************************************/
/*****header link********/
$pagemncat = "Setup";
$pagecat = "Events";
$pagenm = "Events";
/*****header link********/
global $gmsg;
if(isset($_POST['btnaddevnt']) && ($_POST['btnaddevnt'] != "") && 	
isset($_POST['txtname']) && ($_POST['txtname'] != "") && 
	isset($_POST['txtdesc']) && ($_POST['txtdesc'] != "") && 
isset($_POST['txtcity']) && ($_POST['txtcity'] != "") && 
isset($_POST['txtstdate']) && ($_POST['txtstdate'] != "") && 
isset($_POST['txtprior']) && ($_POST['txtprior'] != ""))
{
	include_once '../includes/inc_fnct_fleupld.php'; // For uploading files	   
include_once "../database/iqry_event_mst.php";
}
$val  =  glb_func_chkvl($_REQUEST['val']); 
$rd_crntpgnm = "view_all_events.php";
$clspn_val = "4";
?>
<script language="javaScript" type="text/javascript" src="js/ckeditor.js"></script>
<script language="javascript" src="../includes/yav.js"></script>
<script language="javascript" src="../includes/yav-config.js"></script>
<link rel="stylesheet" type="text/css" href="../includes/yav-style1.css">
<script language="javascript" type="text/javascript">
	var rules=new Array();
    	rules[0]='txtname:Event Name|required|Enter name';
		rules[1]='txtdesc:Event Description|required|Enter Description';
    	rules[2]='txtprior:Priority|required|Enter Priority';
		rules[3]='txtprior:Priority|numeric|Enter Only Numbers';
		rules[4]='txtcity:City|required|Enter City';
		rules[5]='txtstdate:Start Date|required|Enter Start Date';
		rules[6]='txtnvets:Vets|required|Enter No. of Vets/Batches';
	function setfocus() {
		document.getElementById('txtname').focus();
	}
</script>
<?php
include_once('script.php');
include_once('../includes/inc_fnct_ajax_validation.php');
?>
<script language="javascript" type="text/javascript">
	function setfocus(){
			document.getElementById('txtname').focus();
		}
		function funcChkDupName(){
			var name,txtstdate;
			name = document.getElementById('txtname').value;
			evntstrtdt = document.getElementById('txtstdate').value;		
			if(name != ""){
				var url = "chkduplicate.php?evntname="+name+"&evntstrtdt="+evntstrtdt;
				xmlHttp	= GetXmlHttpObject(stateChanged);
				xmlHttp.open("GET", url , true);
				xmlHttp.send(null);
			}
			else{
				document.getElementById('errorsDiv_txtstdate').value = "";
			}	
		}
		function stateChanged(){ 
			if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete"){ 	
				var temp=xmlHttp.responseText;
				document.getElementById("errorsDiv_txtstdate").innerHTML = temp;
				if(temp!=0){
					document.getElementById('txtstdate').focus();
				}		
			}
		}
			/********************Multiple Image Upload********************************/
			var nfiles=1;
		  function expand()
		  {
		  	nfiles++;
		  	var htmlTxt = '<?php
		  	echo "<table border=0 cellpadding=3 cellspacing=1 width=100%>";
		  	echo "<tr >";
		  	echo "<td colspan=3 height=2 bgcolor=#f0f0f0 valign=middle></td>";
		  	echo "</tr>";
		  	echo "<tr>";
		  	echo "<td colspan=3 height=4 valign=middle></td>";
		  	echo "</tr>";
		  	echo "</table><br>";
		  	echo "<table border=0 cellpadding=0 cellspacing=1 width=100%>";
		  	echo "<tr>";
		  	echo "<td align=center width=5%> ' + nfiles + '</td>";
		  	echo "<td align=center width=15%>";
		  	echo "<input type=text name=txtphtname' + nfiles + ' id=txtphtname' + nfiles + ' class=form-control size=15 placeholder=Name>";
		  	echo "</td>";
		  	echo "<td align=center width=30%>";
		  	echo "<input type=file name=flesimg' + nfiles + ' id=flesimg' + nfiles + ' class=form-control><br>";
		  	echo "</td>";
		  
		  	echo "<td align=center width=10%>";
		  	echo "<input type=text name=txtphtprior' + nfiles + ' id=txtphtprior' + nfiles + ' class=form-control size=5 maxlength=3 placeholder=Priority>";
		  	echo "</td>";
		  	echo "<td align=center width=10%>";
		  	echo "<select name=lstphtsts' + nfiles + ' id=lstphtsts' + nfiles + ' class=form-control>";
		  	echo "<option value=a>Active</option>";
		  	echo "<option value=i>Inactive</option>";
		  	echo "</select>";
		  	echo "</td></tr></table><br>";
		  	?>';
		  	var Cntnt = document.getElementById ("myDiv");
		  	if (document.createRange)
		  	{
		  		//all browsers, except IE before version 9
		  		var rangeObj = document.createRange();
		  		Cntnt.insertAdjacentHTML('BeforeBegin' , htmlTxt);
		  		document.frmprod.hdntotcntrl.value = nfiles;
		  		if (rangeObj.createContextualFragment)
		  		{
		  			// all browsers, except IE
		  			//var documentFragment = rangeObj.createContextualFragment (htmlTxt);
		  			//Cntnt.insertBefore (documentFragment, Cntnt.firstChild);	//Mozilla
		  		}
		  		else
		  		{
		  			//Internet Explorer from version 9
		  			Cntnt.insertAdjacentHTML('BeforeBegin' , htmlTxt);
		  		}
		  	}
		  	else
		  	{
		  		//Internet Explorer before version 9
		  		Cntnt.insertAdjacentHTML ("BeforeBegin", htmlTxt);
		  	}
		  	document.getElementById('hdntotcntrl').value = nfiles;
		  	document.frmprod.hdntotcntrl.value = nfiles;
		  }
		</script>
<?php include_once $inc_adm_hdr; ?>
<section class="content">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">Add Events</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item active">Add Events</li>
					</ol>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>
	<!-- Default box -->
	<div class="card">
		<?php
		if ($gmsg != "") {
			echo "<center><div class='col-12'>
			<font face='Arial' size='2' color = 'red'>$gmsg</font>
			</div></center>";
		}
		if (isset($_REQUEST['sts']) && (trim($_REQUEST['sts']) == "y")) { ?>
			<div class="alert alert-danger alert-dismissible fade show" role="alert" id="delids">
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
		<form name="frmaddevnt" id="frmaddevnt" method="POST" action="<?php $_SERVER['PHP_SELF'];?>" 
		  		onSubmit="return performCheck('frmaddevnt', rules, 'inline');" enctype="multipart/form-data">
				<div class="col-md-12">
					<div class="row justify-content-center align-items-center">
						<div class="col-md-12">
							<div class="row mb-2 mt-2">
								<div class="col-sm-3">
									<label>Name *</label>
								</div>
								<div class="col-sm-9">
									<input name="txtname" type="text"  id="txtname" size="45" maxlength="40" onBlur="funcChkDupName()" class="form-control">
									<span id="errorsDiv_txtname"></span>
								</div>
							</div>
						</div>
						<div class="col-md-12">
							<div class="row mb-2 mt-2">
								<div class="col-sm-3">
									<label>Description </label>
								</div>
								<div class="col-sm-9">
									<textarea name="txtdesc" id="txtdesc" cols="60" rows="3" class="form-control"></textarea>
									<span id="errorsDiv_txtdesc"></span>
								</div>
							</div>
						</div>
						<div class="col-md-12">
							<div class="row mb-2 mt-2">
								<div class="col-sm-3">
									<label>Link</label>
								</div>
								<div class="col-sm-9">
									<div class="custom-file">
										<input name="txtlnk" type="text"  class="form-control" id="txtlnk" maxlength="50">
										<span id="errorsDiv_txtlnk"></span>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-12">
							<div class="row mb-2 mt-2">
								<div class="col-sm-3">
									<label>District</label>
								</div>
								<div class="col-sm-9">
									<select name="lstdstrct" id="lstdstrct" class="form-control">
									<option value="" selected>--Select--</option>
									<?php 
							$sqrydstrct_mst = "SELECT 	ctym_id,ctym_name from 	cty_mst";
							$srsdstrct_mst=mysqli_query($conn,$sqrydstrct_mst);
							while($rowsdstrct_mst=mysqli_fetch_assoc($srsdstrct_mst)){	?>
								<option value="<?php echo $rowsdstrct_mst['ctym_id'];?>"><?php echo $rowsdstrct_mst['ctym_name'];?></option>
							<?php
							}
					
							?>
									</select>

								</div>
							</div>
						</div>
						<div class="col-md-12">
							<div class="row mb-2 mt-2">
								<div class="col-sm-3">
									<label>City</label>
								</div>
								<div class="col-sm-9">
								<input name="txtcity" type="text" class="form-control" id="txtcity" maxlength="50">
										<span id="errorsDiv_txtcity"></span>

								</div>
							</div>
						</div>
						<div class="col-md-12">
							<div class="row mb-2 mt-2">
								<div class="col-sm-3">
									<label>Venue</label>
								</div>
								<div class="col-sm-9">
									<input type="text" name="txtvenue" id="txtvenue" size="45" maxlength="250" class="form-control">
									<span id="errorsDiv_txtvenue"></span>
								</div>
							</div>
						</div>
					
						<div class="col-md-12">
							<div class="row mb-2 mt-2">
								<div class="col-sm-3">
									<label>Start Date and Time</label>
								</div>
								<div class="col-sm-9">
									<input type="datetime-local" name="txtstdate" id="txtstdate" class="form-control" >
									<span id="errorsDiv_txtstdate"></span>
								
								</div>
							</div>
						</div>
						<div class="col-md-12">
							<div class="row mb-2 mt-2">
								<div class="col-sm-3">
									<label>End Date and Time</label>
								</div>
								<div class="col-sm-9">
									<input type="datetime-local" name="txteddt" id="txteddt" class="form-control" >
									<span id="errorsDiv_txteddt"></span>
								</div>
							</div>
						</div>
						<div class="col-md-12">
							<div class="row mb-2 mt-2">
								<div class="col-sm-3">
									<label>No. of seats</label>
								</div>
								<div class="col-sm-9">
									<input type="text" name="txtnvets" id="txtnvets" class="form-control">
									<span id="errorsDiv_txtnvets"></span>
								</div>
							</div>
						</div>
						<div class="col-md-12">
							<div class="row mb-2 mt-2">
								<div class="col-sm-3">
									<label>File</label>
								</div>
								<div class="col-sm-9">
									<input type="file" name="evntfle" id="evntfle" class="form-control">
									<span id="errorsDiv_evntfle"></span>
								</div>
							</div>
						</div>
						<div class="col-md-12">
							<div class="row mb-2 mt-2">
								<div class="col-sm-3">
									<label>Rank *</label>
								</div>
								<div class="col-sm-9">
									<input type="text" name="txtprior" id="txtprior" class="form-control">
									<span id="errorsDiv_txtprior"></span>
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
										<option value="a" selected>Active</option>
										<option value="i">Inactive</option>
									</select>

								</div>
							</div>
						</div>
						<div class="table-responsive">
									<table width="100%"  border="0" cellspacing="1" cellpadding="1" class="table table-striped table-bordered">
										<tr bgcolor="#FFFFFF">
											<td width="1%"  align="center" ><strong>S.No.</strong></td>
											<td width="10%" align="center" ><strong>Name</strong></td>
											<td width="35%"  align="center" ><strong> Image</strong></td>
												<td width="10%"  align="center" ><strong>Priority</strong></td>
											<td width="10%"  align="center" ><strong>Status</strong></td>
										</tr>
									</table>
								</div>
								<div class="table-responsive">
									<table width="100%"  border="0" cellspacing="1" cellpadding="1" class="table table-striped table-bordered" >
										<table width="100%" border="0" cellspacing="3" cellpadding="3">
											<tr bgcolor="#FFFFFF">
												<td width="5%" align="center">1</td>
												<td width="15%"  align="center">
													<input type="text" name="txtphtname1" id="txtphtname1" placeholder="Name" class="form-control" size="15"><br>
													<span id="errorsDiv_txtphtname1" style="color:#FF0000"></span>
												</td>
												<td width="30%"  align="center" >
													<input type="file" name="flesimg1" class="form-control" id="flesimg1"><br/>
													<span id="errorsDiv_flesimg1" style="color:#FF0000"></span>
												</td>
												<td width="10%"  align="center">
													<input type="text" name="txtphtprior1" id="txtphtprior1" class="form-control" placeholder="Priority" size="5" maxlength="3"><br>
													<span id="errorsDiv_txtphtprior1" style="color:#FF0000"></span>
												</td>
												<td width="10%" align="center" >					
													<select name="lstphtsts1" id="lstphtsts1" class="form-control">
														<option value="a" selected>Active</option>
														<option value="i">Inactive</option>
													</select>
												</td>
											</tr>
										</table>
									</table>
									<input type="hidden" name="hdntotcntrl" value="1">
									<div id="myDiv">
										<table width="100%" cellspacing='2' cellpadding='3'>
											<tr>
												<td align="center">
													<input name="btnadd" type="button" onClick="expand()" value="Add Another Image" class="btn btn-primary mb-3">
												</td>
											</tr>
										</table>
									</div>
								</div>
						<p class="text-center">
							<input type="Submit" class="btn btn-primary" name="btnaddevnt" id="btnaddevnt" value="Submit">
							&nbsp;&nbsp;&nbsp;
							<input type="reset" class="btn btn-primary" name="btnaddevntreset" value="Clear" id="btnaddevntreset">
							&nbsp;&nbsp;&nbsp;
							<input type="button" name="btnBack" value="Back" class="btn btn-primary" onClick="location.href='<?php echo $rd_crntpgnm; ?>'">
						</p>
					</div>
				</div>
			</form>
		</div>
		<!-- /.card-body -->
	</div>
	<!-- /.card -->
</section>
<?php include_once "../includes/inc_adm_footer.php"; ?>
<script language="javascript" type="text/javascript">
	CKEDITOR.replace('txtdesc');
</script>