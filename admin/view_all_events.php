<?php
	include_once '../includes/inc_nocache.php'; // Clearing the cache information
	include_once "../includes/inc_adm_session.php";//checking for session
	include_once "../includes/inc_connection.php";//Making database Connection
	include_once "../includes/inc_usr_functions.php";//Use function for validation and more 
	include_once "../includes/inc_paging_functions.php";//Making paging validation
	include_once '../includes/inc_config.php';
	include_once "../includes/inc_folder_path.php";
	/***************************************************************/
	//Programm 	  : events.php
	//Package 	  : APVC
	//Purpose 	  : For Viewing New events 
	//Created By  : Nischit N Desai
	//Created On  :	04/06/2013
	//Modified By : 
	//Modified On : 
	//Company 	  : Adroit
	/************************************************************/
	global $msg,$loc,$rowsprpg,$dispmsg,$disppg;
	$loc = "";
 $clspn_val = "8";
$rd_adpgnm = "add_event.php";
$rd_edtpgnm = "edit_event.php";
$rd_crntpgnm = "view_all_events.php";
$rd_vwpgnm = "view_detail_event.php";
	

    /*****header link********/
$pagemncat = "Setup";
$pagecat = "Events";
$pagenm = "Events";
/*****header link********/

	if(($_POST['hidchksts']!="") && isset($_REQUEST['hidchksts'])){
			 $dchkval = substr($_POST['hidchksts'],1);
			 $id  	 = glb_func_chkvl($dchkval);
					
			$updtsts = funcUpdtAllRecSts($conn,'evnt_mst','evntm_id',$id,'evntm_sts');		
			if($updtsts == 'y'){
				$msg = "<font color=red>Record updated successfully</font>";
			}
			elseif($updtsts == 'n'){
				$msg = "<font color=red>Record not updated</font>";
			}
	}	
	if(($_POST['hidchkval']!="") && isset($_REQUEST['hidchkval'])){
		    $dchkval    =  substr($_POST['hidchkval'],1);
			$did 	    =  glb_func_chkvl($dchkval);
			$del        =  explode(',',$did);
			$count      =  sizeof($del);
			$img        =  array();
			$imgpth     =  array();
			for($i=0;$i<$count;$i++){	
			     $sqryevnt_mst="select 
			                       evntm_img
							    from 
					               evnt_mst
					            where
					                evntm_id=$del[$i]";				 				 				 				 			
			     $srsevnt_mst     = mysqli_query($conn,$sqryevnt_mst);
			     $srowevnt_mst    = mysqli_fetch_assoc($srsevnt_mst);		     			   				
		         $img[$i]         = glb_func_chkvl($srowevnt_mst['evntm_img']);
		         $imgpth[$i]      = $imgevnt_fldnm.$img[$i];				
				 
		    }						
			$delsts = funcDelAllRec($conn,'evnt_mst','evntm_id',$did);	
			if($delsts == 'y'){
			     for($i=0;$i<$count;$i++){				     	         
					 if(($img[$i] != "") && file_exists($imgpth[$i])) {
						unlink($imgpth[$i]);
					 }					
				 } 
				 $msg   = "<font color=red>Record deleted successfully</font>";
			}
			elseif($delsts == 'n'){
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
	if(isset($_REQUEST['sts']) && (trim($_REQUEST['sts']) == "y")){
		$msg = "<font color=red>Record updated successfully</font>";
	}
	elseif(isset($_REQUEST['sts']) && (trim($_REQUEST['sts']) == "n")){
		$msg = "<font color=red>Record not updated</font>";
	}
	elseif(isset($_REQUEST['sts']) && (trim($_REQUEST['sts']) == "d")){
	    $msg = "<font color=red>Duplicate Recored Name Exists & Record Not updated</font>";
	}
	
    $rowsprpg  = 20;//maximum rows per page
	include_once "../includes/inc_paging1.php";//Includes pagination	
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title><?php echo $pgtl; ?></title>
<?php include_once ('script.php')?>
	<script language="javascript">
		function addnew()
		{
			var val=document.frmevnt.txtsrchval.value;
			document.frmevnt.action="add_event.php";
			document.frmevnt.submit();
		}
	</script>
	<script language="javascript">
		function chng()
		{
			var div1 = document.getElementById("div1");
			var div2 = document.getElementById("div2");
			if(document.frmevnt.lstsrchby.value=='n')
			{
				div1.style.display="block";
				div2.style.display="none";
			}
			else if(document.frmevnt.lstsrchby.value=='stdt')
			{
				div1.style.display="none";
				div2.style.display="block";
			}
		}
		function onload()
		{
		 <?php
		 	if(isset($_POST['lstsrchby']) && $_POST['lstsrchby']=='n')
		 	{
		 ?>
				div1.style.display="block";
				div2.style.display="none";
		 <?php
		 	}
		 	else if(isset($_POST['lstsrchby']) && $_POST['lstsrchby']=='t')
		 	{
		 ?>
				div1.style.display="none";
				div2.style.display="block";
		 <?php
		 	}
		 ?>
		}
		function srch(){
			if(document.frmevnt.lstsrchby.value ==""){
				alert("select search criteria");
				document.frmevnt.lstsrchby.focus();
				return false;
			}
			if(document.frmevnt.lstsrchby.value !=""){
				var optn = document.frmevnt.lstsrchby.value;							
				if(optn =="n"){
					if(document.frmevnt.txtsrchval.value == ""){
					alert("Enter Event Name");
					document.frmevnt.txtsrchval.focus();
					return false;
					}
				}			
				if(optn == "c"){
					if(document.frmevnt.txtsrchval.value == ""){
					alert("Enter City Name");
					document.frmevnt.txtsrchval.focus();
					return false;
					}
				}
				if(optn == "stdt"){
					if(document.frmevnt.txtsrchval.value == ""){
					alert("Enter Start Date");
					document.frmevnt.txtsrchval.focus();
					return false;
					}
				}
			}
			var optn=document.frmevnt.lstsrchby.value;
			var val=document.frmevnt.txtsrchval.value;
			if(optn =='n'){			
				if(document.frmevnt.chkexact.checked==true){
					document.frmevnt.action="events.php?optn=n&val="+val+"&chk=y";
					document.frmevnt.submit();
				}
				else{
					document.frmevnt.action="events.php?optn=n&val="+val;
					document.frmevnt.submit();
				}
			}
			if(optn =='c'){			
				if(document.frmevnt.chkexact.checked==true){
					document.frmevnt.action="events.php?optn=c&val="+val+"&chk=y";
					document.frmevnt.submit();
				}
				else{
					document.frmevnt.action="events.php?optn=c&val="+val;
					document.frmevnt.submit();
				}
			}
			if(optn =='stdt'){			
				if(document.frmevnt.chkexact.checked==true){
					document.frmevnt.action="events.php?optn=stdt&val="+val+"&chk=y";
					document.frmevnt.submit();
				}
				else{
					document.frmevnt.action="events.php?optn=stdt&val="+val;
					document.frmevnt.submit();
				}
			}
			return true;
		}
</script>
<script language="javascript" type="text/javascript" src="../includes/chkbxvalidate.js"></script>
<link href="docstyle.css" rel="stylesheet" type="text/css">
</head>
<body onLoad="onload()">
<?php 
	include_once '../includes/inc_adm_header.php';
	include_once '../includes/inc_adm_leftlinks.php';?>
<table width="977"  border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td valign="top"><table width="100%"  border="0" cellspacing="0" cellpadding="0" class="admcnt_bdr">
      <tr>
        
        <td width="930" height="325" rowspan="2" valign="top"  bgcolor="#FFFFFF" class="contentpadding" style="background-position:top; background-repeat:repeat-x; "><span class="maintitles">
            Events/Programs
</span><br>
            <FORM METHOD="POST" ACTION="" name="frmevnt" id="frmevnt">
			<input type="hidden" name="hidchkval" id="hidchkval">
			<input type="hidden" name="hidchksts" id="hidchksts">
			<table width="100%"  border="0" cellspacing="0" cellpadding="5">
              <tr>
			  	<td width="91%">
					<table width="100%">
						<tr>
							<td width="20%"><strong>Search By</strong></td>
							<td width="13%" align="center">
								<select name="lstsrchby" id="lstsrchby" >
								  <option value="">-- Select --</option>                       
								 <option value="n" <?php if(isset($_POST['lstsrchby']) && $_POST['lstsrchby'] == 'n'){echo 'selected';} else if($_REQUEST['optn'] && $_REQUEST['optn'] =='n'){echo 'selected';}?>>Name</option>
								 <?php /*?><option value="c" <?php if(isset($_POST['lstsrchby']) && $_POST['lstsrchby'] == 'c'){echo 'selected';} else if($_REQUEST['optn'] && $_REQUEST['optn'] =='c'){echo 'selected';}?>>City</option>
								<option value="stdt" <?php if(isset($_POST['lstsrchby']) && $_POST['lstsrchby'] == 'stdt'){echo 'selected';} else if($_REQUEST['optn'] && $_REQUEST['optn'] =='stdt'){echo 'selected';}?>>Start Date</option>
<?php */?>								</select>
							</td>
						  <td width="37%">
						  <div id="div1" style="display:block">
						  <input type="text" name="txtsrchval" value="<?php 
						  if(isset($_POST['txtsrchval']) && ($_POST['txtsrchval']!="")){
						  	echo $_POST['txtsrchval'];
						  }
						  elseif(isset($_REQUEST['val']) && ($_REQUEST['val']!="")){
						     echo $_REQUEST['val'];
						  }
						?>">
						  Exact
						  <input type="checkbox" name="chkexact" value="1"<?php 						  
						  	if(isset($_POST['chkexact']) && ($_POST['chkexact']==1)){
								echo 'checked';
							}
							elseif(isset($_REQUEST['chk']) && ($_REQUEST['chk']=='y')){
								echo 'checked';							
							}						  						  
						  ?>>
</div>					</td>
						  <td width="30%"><input name="button" type="button" class="textfeild" onClick="srch()" value="Search" $>
					      <a href="events.php" class="orongelinks"><strong>Refresh</strong></a></td>
						</tr>
					</table> 
				</td>
                <td width="9%" align="right">
				<input name="btn" type="button" class="textfeild" value="&laquo; Add" onClick="addnew()">
				</td>
              </tr>
            </table>
              <table width="100%"  border="0" cellpadding="3" cellspacing="1" bgcolor="#D8D7D7">
			  <tr>
                <td bgcolor="#FFFFFF" colspan="6" align="center"></td>				
                <td width="7%" align="right" valign="bottom" bgcolor="#FFFFFF">
					<div align="right">
					<input name="btnsts" id="btnsts" type="button"  value="Status" onClick="updatests('hidchksts','frmevnt','chksts')">
					</div>
				</td>
                <td width="7%" align="right" valign="bottom" bgcolor="#FFFFFF" >
					<div align="right">
					<input name="btndel" id="btndel" type="button"  value="Delete" onClick="deleteall('hidchkval','frmevnt','chkdlt');" >
					</div>
				</td>
              </tr>
              <tr>
                <td width="10%" bgcolor="#bed8f9" class="tableheadings" align="left"><strong>Sl.No.</strong></td>
                <td width="31%" bgcolor="#bed8f9" class="tableheadings" align="left"><strong>Name</strong></td>
				<td width="14%" bgcolor="#bed8f9" class="tableheadings" align="left"><strong>City</strong></td>
				<td width="14%" bgcolor="#bed8f9" class="tableheadings" align="left"><strong>Date</strong></td> 
                <td width="7%" bgcolor="#bed8f9" class="tableheadings" align="center"><strong>Priority</strong></td>
				<td width="10%" bgcolor="#bed8f9" class="tableheadings" align="center"><strong>Edit</strong></td>
                <td width="7%" bgcolor="#bed8f9" class="tableheadings" class="tableheadings" align="center"><strong>
				  <input type="checkbox" name="Check_ctr"  id="Check_ctr" value="yes"onClick="Check(document.frmevnt.chksts,'Check_ctr')"></strong></td>
				<td width="7%" bgcolor="#bed8f9" class="tableheadings" class="tableheadings" align="center"><strong>
				<input type="checkbox" name="Check_dctr"  id="Check_dctr" value="yes" onClick="Check(document.frmevnt.chkdlt,'Check_dctr')"><b></b> 
				</strong>
				</td>
              </tr>
			  <?php
				$sqryevnt_mst1="select 
									evntm_id,evntm_name,evntm_fle,evntm_sts,
							   	    evntm_prty,date_format(evntm_strtdt,'%d-%m-%Y') as evntm_strtdt,evntm_city
							   from evnt_mst";
							   
				if(isset($_REQUEST['optn']) && ($_REQUEST['optn'])=='n' &&						
				   isset($_REQUEST['val']) && ($_REQUEST['val'] !="")){
						$val = glb_func_chkvl($_REQUEST['val']);
						if(isset($_REQUEST['chk']) && ($_REQUEST['chk'] == 'y')){
							$loc = "&optn=n&val=".$val."&chk=y";
							$sqryevnt_mst1.= " where evntm_name like '$val'";
						}
						else{
							 $loc = "&optn=n&val=".$val;
							 $sqryevnt_mst1.= " where evntm_name like '%$val%'";
						}
			    }
				else if(isset($_REQUEST['optn']) && ($_REQUEST['optn'])=='c' &&	
						isset($_REQUEST['val']) && $_REQUEST['val']!=""){
						$val = glb_func_chkvl($_REQUEST['val']);
						if(isset($_REQUEST['chk']) && $_REQUEST['chk']=='y'){
							$loc = "&optn=c&val=".$val."&chk=y";
							$sqryevnt_mst1.=" where evntm_city='$val'";
						}
						else{
							$loc = "&optn=c&val=".$value;
							$sqryevnt_mst1.=" where evntm_city like '%$val%'";
						}
				}					  
				else if(isset($_REQUEST['optn']) && ($_REQUEST['optn'])=='stdt' &&						
						isset($_REQUEST['val']) && ($_REQUEST['val'] !="")){
						$val = glb_func_chkvl($_REQUEST['val']);
						$val= date('Y-m-d',strtotime($val));
						if(isset($_REQUEST['chk']) && ($_REQUEST['chk'] == 'y')){
							$loc = "&optn=stdt&val=".$val."&chk=y";
							$sqryevnt_mst1.= " where evntm_strtdt like '$val'";
						}
						else{
							$loc = "&optn=stdt&val=".$val;
							$sqryevnt_mst1.= " where evntm_strtdt like '%$val%'";
						}
				}				
				$sqryevnt_mst = $sqryevnt_mst1." order by evntm_name asc
							                   limit $offset,$rowsprpg";
				$srsevnt_mst =mysqli_query($conn,$sqryevnt_mst) or die(mysqli_error());
			  	$cnt = $offset;
				$cont=mysqli_num_rows($srsevnt_mst);
				if($cont==0){
				echo "	<tr bgcolor='#F2F1F1'>
							<td  colspan='8' align='center'>
								No Records Found
							</td>
						</tr>";

				}
				else if($cont>0){
				while($srowevnt_mst=mysqli_fetch_assoc($srsevnt_mst))
				{
					$cnt+=1;
					$db_evntmid	= $srowevnt_mst['evntm_id'];

			  ?>
              <tr <?php if($cnt%2==0){echo "bgcolor='#f1f6fd'";}else{echo "bgcolor='#f1f6fd'";}?>>
                <td><?php echo $cnt;?></td>
                <td align="left">
				<a href="view_event.php?edit=<?php echo $srowevnt_mst['evntm_id'];?>&pg=<?php echo $pgnum;?>&countstart=<?php echo $cntstart.$loc;?>" class="links">
				<?php echo $srowevnt_mst['evntm_name'];?>
				</a>
				</td>
				<td align="left"><?php echo $srowevnt_mst['evntm_city'];?></td>
				<td align="left"><?php echo $srowevnt_mst['evntm_strtdt'];?></td>
                <td align="left"><?php echo $srowevnt_mst['evntm_prty'];?></td>
				<td align="center">
				<a href="edit_event.php?edit=<?php echo $srowevnt_mst['evntm_id'];?>&pg=<?php echo $pgnum;?>&countstart=<?php echo $cntstart.$loc;?>" class="contentlinks">
				Edit
				</a>
				</td>
                <td align="center">
					<input type="checkbox" name="chksts"  id="chksts" value="<?php echo $db_evntmid;?>" <?php if($srowevnt_mst['evntm_sts'] =='a') { echo "checked";}?> onClick="addchkval(<?php echo $db_evntmid;?>,'hidchksts','frmevnt','chksts');">
				</td>
				<td align="center">
					<input type="checkbox" name="chkdlt"  id="chkdlt" value="<?php echo $db_evntmid;?>">
				</td>
              </tr>
			 
			  <?php
			  	}
				}
				?>
				 <tr>
                <td bgcolor="#FFFFFF" colspan="6" align="center"></td>				
                <td width="7%" align="right" valign="bottom" bgcolor="#FFFFFF">
					<div align="right">
					<input name="btnsts" id="btnsts" type="button"  value="Status" onClick="updatests('hidchksts','frmevnt','chksts')">
					</div>
				</td>
                <td width="7%" align="right" valign="bottom" bgcolor="#FFFFFF" >
					<div align="right">
					<input name="btndel" id="btndel" type="button"  value="Delete" onClick="deleteall('hidchkval','frmevnt','chkdlt');" >
					</div>
				</td>
              </tr>
				<?php
				$disppg = funcDispPag('links',$loc,$sqryevnt_mst1,$rowsprpg,$cntstart,$pgnum,$conn);	
				if($disppg != "")
				{	
					$disppg = "<br><tr><td colspan='10' align='center' bgcolor='#F2F1F1'>$disppg</td></tr>";
					echo $disppg;
				}				
				if($msg != "")
				{
					$dispmsg = "<tr><td colspan='10' align='center' bgcolor='#F2F1F1'>$msg</td></tr>";
					echo $dispmsg;				
				}				
			  ?>			  
            </table></FORM ><br>
          </td>
      </tr>
    </table></td>
  </tr>
</table>
<?php include_once "../includes/inc_adm_footer.php";?>
</body>
</html>
