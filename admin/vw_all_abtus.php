<?php
include_once '../includes/inc_config.php'; //Making paging validation 
include_once $inc_nocache; //Clearing the cache information
include_once $adm_session; //checking for session
include_once $inc_cnctn; //Making database Connection
include_once $inc_usr_fnctn; //checking for session 
include_once $inc_pgng_fnctns; //Making paging validation 
include_once $inc_fldr_pth; //Making paging validation
/***************************************************************
Programm : view_all_banner.php
Purpose : For Viewing Home page banners
Created By : Bharath
Created On : 05-01-2022
Modified By : 
Modified On :
Company : Adroit
 ************************************************************/
global $msg, $loc, $rowsprpg, $dispmsg, $disppg;
$clspn_val = "5";
$rd_adpgnm = "add_abtus.php";
$rd_edtpgnm = "edit_abtus.php";
$rd_crntpgnm = "vw_all_abtus.php";
$rd_vwpgnm = "view_abtus_detail.php";
$loc = "";
/*****header link********/
$pagemncat = "Setup";
$pagecat = "About Us";
$pagenm = "About Us";
/*****header link********/
if (isset($_POST['hdnchksts']) && (trim($_POST['hdnchksts']) != "") || isset($_POST['hdnallval']) && (trim($_POST['hdnallval']) != "")) {
    $dchkval = substr($_POST['hdnchksts'], 1);
    $id = glb_func_chkvl($dchkval);
    $chkallval = glb_func_chkvl($_POST['hdnallval']);
    $updtsts = funcUpdtAllRecSts('abtus_mst', 'abtusm_id', $id, 'abtusm_sts', $chkallval);
    if ($updtsts == 'y') {
        $msg = "<font color=red>Record updated successfully</font>";
    } elseif ($updtsts == 'n') {
        $msg = "<font color=red>Record not updated</font>";
    }
}
if (($_POST['hdnchkval'] != "") && isset($_REQUEST['hdnchkval'])) {
    $dchkval = substr($_POST['hdnchkval'], 1);
    $did = glb_func_chkvl($dchkval);
    $del = explode(',', $did);
    $count = sizeof($del);
    $smlimg = array();
    $smlimgpth = array();
    for ($i = 0; $i < $count; $i++) {
        $sqryprodimgd_dtl = "select 
			                       brndm_img,brndm_zmimg
							    from 
					               brnd_mst
					            where
					                brndm_id=$del[$i]";
        $srsprodimgd_dtl = mysqli_query($conn, $sqryprodimgd_dtl);
        $cntrecprodimgd_dtl = mysqli_num_rows($srsprodimgd_dtl);
        while ($srowprodimgd_dtl = mysqli_fetch_assoc($srsprodimgd_dtl)) {
            $smlimg[$i] = glb_func_chkvl($srowprodimgd_dtl['brndm_img']);
            $smlimgpth[$i] = $gbrnd_upldpth . $smlimg[$i];
            for ($j = 0; $j < $cntrecprodimgd_dtl; $j++) {
                if (($smlimg[$i] != "") && file_exists($smlimgpth[$i])) {
                    unlink($smlimgpth[$i]);
                }
            }
        }
    }
    $delsts = funcDelAllRec('abtus_mst', 'abtusm_id', $did);
    if ($delsts == 'y') {
        $msg = "<font color=red>Record deleted successfully</font>";
    } elseif ($delsts == 'n') {
        $msg = "<font color=red>Record can't be deleted(child records exist)</font>";
    }
}
if (isset($_REQUEST['sts']) && (trim($_REQUEST['sts']) == "y")) {
    $msg = "<font color=red>Record updated successfully</font>";
} elseif (isset($_REQUEST['sts']) && (trim($_REQUEST['sts']) == "n")) {
    $msg = "<font color=red>Record not updated</font>";
} elseif (isset($_REQUEST['sts']) && (trim($_REQUEST['sts']) == "d")) {
    $msg = "<font color=red>Duplicate Recored Name Exists & Record Not updated</font>";
}
$rowsprpg = 20; //maximum rows per page
include_once '../includes/inc_paging1.php'; //Includes pagination



$sqrybrnd_mst1 = "select abtusm_id,abtusm_name,abtusm_imgnm,abtusm_sts,abtusm_lnk,abtusm_prty 
from
abtus_mst";
if (isset($_REQUEST['optn']) && (trim($_REQUEST['optn']) == "t")) {
    $val = trim($_REQUEST['val']);
    if (isset($_REQUEST['chk']) && (trim($_REQUEST['chk']) == 'y')) {
        $loc = "&optn=t&val=" . $val . "&chk=y";
        $sqrybrnd_mst1 .= " where abtusm_name='$val'";
    } else {
        $loc = "&optn=t&val=" . $val;
        $sqrybrnd_mst1 .= " where abtusm_name like '%$val%'";
    }
}
if (isset($_REQUEST['optn']) && (trim($_REQUEST['optn']) == "a")) {
    $val = $_REQUEST['val'];
    $loc = "&optn=a&val=" . $val . "&chka=y";
    $sqrybrnd_mst1 .= " where abtusm_sts='$val'";
}
// if (isset($_REQUEST['txtname']) && (trim($_REQUEST['txtname']) != "")) {
//     $txtname = glb_func_chkvl($_REQUEST['txtname']);
//     $loc .= "&txtname=" . $txtname;
//     if (isset($_REQUEST['chk']) && (trim($_REQUEST['chk']) == 'y')) {
//         $sqrybrnd_mst1 .= " where abtusm_name ='$txtname'";
//     } else {
//         $sqrybrnd_mst1 .= " where abtusm_name like '%$txtname%'";
//     }
// }
$sqrybrnd_mst1 = $sqrybrnd_mst1;
$sqrybrnd_mst = $sqrybrnd_mst1 . " order by abtusm_name limit $offset, $rowsprpg";
//echo $sqrybrnd_mst; exit;
$srsbrnd_mst = mysqli_query($conn, $sqrybrnd_mst);
$cnt_recs = mysqli_num_rows($srsbrnd_mst);
include_once 'script.php';
?>
<script language="javascript">
    function chng() {
        var div1 = document.getElementById("div1");
        var div2 = document.getElementById("div2");
        if (document.frmabtus.lstsrchby.value == 't') {
            div1.style.display = "block";
            div2.style.display = "none";
        } else if (document.frmabtus.lstsrchby.value == 'a') {
            div1.style.display = "none";
            div2.style.display = "block";
        }
    }

    function addnew() {
        document.frmabtus.action = "<?php echo $rd_adpgnm; ?>";
        document.frmabtus.submit();
    }

    // function srch() {
    //     //alert("");
    //     var urlval = "";
    //     if ((document.frmabtus.txtname.value == "")) {
    //         alert("Select Search Criteria");
    //         document.frmabtus.txtname.focus();
    //         return false;
    //     }
    //     var txtname = document.frmabtus.txtname.value;
    //     if (txtname != '') {
    //         if (urlval == "") {
    //             urlval += "txtname=" + txtname;
    //         } else {
    //             urlval += "&txtname=" + txtname;
    //         }
    //     }
    //     if (document.frmabtus.chkexact.checked == true) {
    //         document.frmabtus.action = "<?php echo $rd_crntpgnm; ?>?" + urlval + "&chk=y";
    //         document.frmabtus.submit();
    //     } else {
    //         document.frmabtus.action = "<?php echo $rd_crntpgnm; ?>?" + urlval;
    //         document.frmabtus.submit();
    //     }
    //     return true;
    // }


    function validate() {
        if (document.frmabtus.lstsrchby.value == "") {
            alert("Please Select Search Criteria");
            document.frmabtus.lstsrchby.focus();
            return false;
        }
        if (document.frmabtus.lstsrchby.value == "t") {
            if (document.frmabtus.txtname.value == "") {
                alert("Please Enter Name");
                document.frmabtus.txtname.focus();
                return false;
            }
        }
        if (document.frmabtus.lstsrchby.value == "a") {
            if (document.frmabtus.lstprodcatname.value == "") {
                alert("Please select Any One");
                document.frmabtus.lstprodcatname.focus();
                return false;
            }
        }
        var optn = document.frmabtus.lstsrchby.value;
        if (optn == 't') {
            var val = document.frmabtus.txtname.value;
            if (document.frmabtus.chkexactt.checked == true) {
                document.frmabtus.action = "vw_all_abtus.php?optn=t&val=" + val + "&chk=y";
                document.frmabtus.submit();
            } else {
                document.frmabtus.action = "vw_all_abtus.php?optn=t&val=" + val;
                document.frmabtus.submit();
            }
        } else if (optn == 'a') {
            var val = document.frmabtus.lstprodcatname.value;
            document.frmabtus.action = "vw_all_abtus.php?optn=a&val=" + val;
            document.frmabtus.submit();
        }
        return true;
    }

    function onload() {
        <?php
        if (isset($_POST['lstsrchby']) && $_POST['lstsrchby'] == 't') {
        ?>
            div1.style.display = "block";
            div2.style.display = "none";
        <?php
        } elseif (isset($_POST['lstsrchby']) && $_POST['lstsrchby'] == 'a') {
        ?>
            div1.style.display = "none";
            div2.style.display = "block";
        <?php
        }
        ?>
    }
</script>
<script language="javascript" type="text/javascript" src="../includes/chkbxvalidate.js"></script>
<link href="docstyle.css" rel="stylesheet" type="text/css">

<body onLoad="onload()">
    <?php include_once $inc_adm_hdr; ?>
    <section class="content">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">View All About Us</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">View All About Us</li>
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
                <form method="post" action="<?php $_SERVER['SCRIPT_FILENAME']; ?>" name="frmabtus" id="frmabtus">
                    <input type="hidden" name="hdnchkval" id="hdnchkval">
                    <input type="hidden" name="hdnchksts" id="hdnchksts">
                    <input type="hidden" name="hdnallval" id="hdnallval">
                    <div class="col-md-12">
                        <div class="row justify-content-left align-items-center mt-3">
                            <div class="col-sm-7">
                                <div class="form-group">
                                    <div class="col-8">
                                        <div class="row">
                                            <div class="col-10">

                                                <td width="9%">
                                                    <select name="lstsrchby" onChange="chng()" class="form-control">
                                                        <option value="">--Select--</option>
                                                        <option value="t" <?php if (isset($_REQUEST['lstsrchby']) && (trim($_REQUEST['lstsrchby']) == 't')) {
                                                                                echo 'selected';
                                                                            } elseif (isset($_REQUEST['optn']) && (trim($_REQUEST['optn']) == 't')) {
                                                                                echo 'selected';
                                                                            } ?>>Name</option>
                                                        <option value="a" <?php if (isset($_REQUEST['lstsrchby']) && (trim($_REQUEST['lstsrchby']) == 'a')) {
                                                                                echo 'selected';
                                                                            } elseif (isset($_REQUEST['optn']) && (trim($_REQUEST['optn']) == 'a')) {
                                                                                echo 'selected';
                                                                            } ?>>Status</option>
                                                    </select>
                                                </td>
                                                <!-- <input type="text" name="txtname" placeholder="Search by name" id="txtname" class="form-control" value="<?php if (isset($_REQUEST['txtname']) && $_REQUEST['txtname'] != "") {
                                                                                                                                                                    echo $_REQUEST['txtname'];
                                                                                                                                                                } ?>"> -->







                                                <div id="div1" <?php if ((isset($_REQUEST['optn']) &&
                                                                    (trim($_REQUEST['optn']) == 't')) || (!isset($_REQUEST['optn']))) { ?> style="display:block" <?php  } else { ?>style="display:none" <?php } ?>>
                                                    <input type="text" class="form-control" name="txtname" id="txtname" value="<?php
                                                                                                                                if (isset($_REQUEST['txtname']) && (trim($_REQUEST['txtname']) != "")) {
                                                                                                                                    echo $_POST['txtname'];
                                                                                                                                } elseif (
                                                                                                                                    isset($_REQUEST['val']) && (trim($_REQUEST['val']) != "") &&
                                                                                                                                    isset($_REQUEST['optn']) && (trim($_REQUEST['optn']) == "t")
                                                                                                                                ) {
                                                                                                                                    echo $_REQUEST['val'];
                                                                                                                                }
                                                                                                                                ?>" />
                                                    Exact
                                                    <input type="checkbox" name="chkexactt" id="chkexactt" value="1" <?php
                                                                                                                        if (isset($_POST['chkexactt']) && (trim($_POST['chkexactt']) == 1)) {
                                                                                                                            echo 'checked';
                                                                                                                        } elseif (isset($_REQUEST['chk']) && (trim($_REQUEST['chk']) == 'y')) {
                                                                                                                            echo 'checked';
                                                                                                                        }
                                                                                                                        ?> />





                                                </div>
                                                <div id="div2" <?php if (isset($_REQUEST['optn']) && (trim($_REQUEST['optn']) == 'a')) { ?> style="display:block" <?php  } else { ?>style="display:none" <?php } ?>>
                                                    <select name="lstprodcatname" id="lstprodcatname" class="form-control">
                                                        <option value="">--Select--</option>
                                                        <option value='a' <?php if ($_REQUEST['optn'] == 'a' && $_REQUEST['val'] == 'a') {
                                                                                echo 'selected';
                                                                            } ?>>Active</option>
                                                        <option value='i' <?php if ($_REQUEST['optn'] == 'a' && $_REQUEST['val'] == 'i') {
                                                                                echo 'selected';
                                                                            } ?>>Inactive</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <!-- Exact -->
                                    <!-- <input type="checkbox" name="chkexact" value="1" <?php if (isset($_POST['chkexact']) && ($_POST['chkexact'] == 1)) {
                                                                                                echo 'checked';
                                                                                            } elseif (isset($_REQUEST['chk']) && ($_REQUEST['chk'] == 'y')) {
                                                                                                echo 'checked';
                                                                                            } ?>> -->
                                    &nbsp;&nbsp;&nbsp;
                                    <input type="submit" value="Search" class="btn btn-primary" name="btnsbmt" onclick='validate();'>
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
                                    <td colspan="<?php echo $clspn_val; ?>" align='center'></td>

                                    <td width="7%" align="right" valign="bottom">
                                        <div align="right">

                                            <input name="btnsts" id="btnsts" type="button" class="btn btn-xs btn-primary" value="Status" onClick="updatests('hdnchksts','frmabtus','chksts')">
                                        </div>
                                    </td>
                                    <td width="7%" align="right" valign="bottom">
                                        <div align="right">
                                            <input name="btndel" id="btndel" type="button" class="btn btn-xs btn-primary" value="Delete" onClick="deleteall('hdnchkval','frmabtus','chkdlt');">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="8%" class="td_bg"><strong>SL.No.</strong></td>
                                    <td width="28%" class="td_bg"><strong>Name</strong></td>
                                    <td width="15%" class="td_bg"><strong>Image</strong></td>
                                    <!-- <td width="15%" class="td_bg"><strong>Link</strong></td> -->
                                    <td width="6%" align="center" class="td_bg"><strong>Rank</strong></td>
                                    <td width="7%" align="center" class="td_bg"><strong>Edit</strong></td>
                                    <td width="7%" class="td_bg" align="center"><strong>
                                            <input type="checkbox" name="Check_ctr" id="Check_ctr" value="yes" onClick="Check(document.frmabtus.chksts,'Check_ctr','hdnallval')"></strong></td>
                                    <td width="7%" class="td_bg" align="center"><strong>
                                            <input type="checkbox" name="Check_dctr" id="Check_dctr" value="yes" onClick="Check(document.frmabtus.chkdlt,'Check_dctr')"></strong></td>
                                </tr>
                                <?php
                                $cnt = $offset;
                                if ($cnt_recs > 0) {
                                    while ($srowbrnd_mst = mysqli_fetch_assoc($srsbrnd_mst)) {
                                        $pgval_srch = $pgnum . $loc;
                                        $db_subid = $srowbrnd_mst['abtusm_id'];
                                        $db_subname = $srowbrnd_mst['abtusm_name'];
                                        $db_sublink = $srowbrnd_mst['abtusm_lnk'];
                                        $db_prty = $srowbrnd_mst['abtusm_prty'];
                                        $db_sts  = $srowbrnd_mst['abtusm_sts'];
                                        $db_typ  = $srowbrnd_mst['brndm_typ'];
                                        $db_szchrt = $srowbrnd_mst['abtusm_imgnm'];
                                        $cnt += 1;
                                ?>
                                        <tr <?php if ($cnt % 2 == 0) {
                                                echo "";
                                            } else {
                                                echo "";
                                            } ?>>
                                            <td><?php echo $cnt; ?></td>
                                            <!-- <td><?php echo $db_subid; ?></td> -->
                                            <td>
                                                <a href="<?php echo $rd_vwpgnm; ?>?vw=<?php echo $db_subid; ?>&pg=<?php echo $pgnum; ?>&countstart=<?php echo $cntstart . $loc; ?>" class="links"><?php echo $db_subname; ?></a>
                                            </td>
                                            <td align="left">
                                                <?php
                                                $imgnm = $db_szchrt;
                                                $imgpath = $gabtus_fldnm . $imgnm;
                                                if (($imgnm != "") && file_exists($imgpath)) {
                                                    echo "<img src='$imgpath' width='50pixel' height='50pixel'>";
                                                } else {
                                                    echo "NA";
                                                }
                                                ?>
                                            </td>
                                            <!-- <td align="center"><?php echo $db_sublink; ?></td>  -->
                                            <td align="center"><?php echo $db_prty; ?></td>
                                            <td align="center">
                                                <a href="<?php echo $rd_edtpgnm; ?>?edit=<?php echo $db_subid; ?>&pg=<?php echo $pgnum; ?>&countstart=<?php echo $cntstart . $loc; ?>" class="orongelinks">Edit</a>
                                            </td>
                                            <td align="center">
                                                <input type="checkbox" name="chksts" id="chksts" value="<?php echo $db_subid; ?>" <?php if ($db_sts == 'a') {
                                                                                                                                        echo "checked";
                                                                                                                                    } ?> onClick="addchkval(<?php echo $db_subid; ?>,'hdnchksts','frmabtus','chksts');">
                                            </td>
                                            <td align="center">
                                                <input type="checkbox" name="chkdlt" id="chkdlt" value="<?php echo $db_subid; ?>">
                                            </td>
                                        </tr>
                                <?php
                                    }
                                } else {
                                    $msg = "<font color=red>No Records In Database</font>";
                                }
                                ?>
                                <tr>
                                    <td colspan="<?php echo $clspn_val; ?>">&nbsp;</td>
                                    <td width="7%" align="right" valign="bottom">
                                        <div align="right">
                                            <input name="btnsts" id="btnsts" type="button" value="Status" onClick="updatests('hdnchksts','frmabtus','chksts')" class="btn btn-xs btn-primary">
                                        </div>
                                    </td>
                                    <td width="7%" align="right" valign="bottom">
                                        <div align="right">
                                            <input name="btndel" id="btndel" type="button" value="Delete" onClick="deleteall('hdnchkval','frmabtus','chkdlt');" class="btn btn-xs btn-primary">
                                        </div>
                                    </td>
                                </tr>
                                <?php
                                $disppg = funcDispPag($conn, 'links', $loc, $sqrybrnd_mst1, $rowsprpg, $cntstart, $pgnum);
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