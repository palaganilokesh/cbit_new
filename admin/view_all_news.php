<?php
include_once '../includes/inc_config.php'; //Making paging validation 
include_once $inc_nocache; //Clearing the cache information
include_once $adm_session; //checking for session
include_once $inc_cnctn; //Making database Connection
include_once $inc_usr_fnctn; //checking for session 
include_once $inc_pgng_fnctns; //Making paging validation 
include_once $inc_fldr_pth; //Making paging validation
/***************************************************************
Programm : view_product_subcategory.php
Purpose : For Viewing Products sub category
Created By : Bharath
Created On : 25-12-2021
Modified By : 
Modified On :
Company : Adroit
 ************************************************************/
global $msg, $loc, $rowsprpg, $dispmsg, $disppg;
$clspn_val = "6";
$rd_adpgnm = "add_news.php";
$rd_edtpgnm = "edit_news.php";
$rd_crntpgnm = "view_all_news.php";
$rd_vwpgnm = "view_news_detail.php";
$loc = "";
/*****header link********/
$pagemncat = "Setup";
$pagecat = "Updates / Notifications";
$pagenm = "Updates / Notifications";
/*****header link********/
if (($_POST['hdnchksts'] != "") && isset($_REQUEST['hdnchksts'])) {
    $dchkval = substr($_POST['hdnchksts'], 1);
    $id       = glb_func_chkvl($dchkval);
    $updtsts = funcUpdtAllRecSts('nws_mst', 'nwsm_id', $id, 'nwsm_sts');
    if ($updtsts == 'y') {
        $msg = "<font color=red>Record updated successfully</font>";
    } else if ($updtsts == 'n') {
        $msg = "<font color=red>Record not updated</font>";
    }
}
if (($_POST['hdnchkval'] != "") && isset($_REQUEST['hdnchkval'])) {
    $dchkval = substr($_POST['hdnchkval'], 1);
    $did     = glb_func_chkvl($dchkval);
    $delsts = funcDelAllRec('nws_mst', 'nwsm_id', $did);

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
include_once "../includes/inc_paging1.php"; //Includes pagination

$sqrynews_mst1 =  "select
nwsm_id,nwsm_name,nwsm_sts,nwsm_prty,nwsm_typ,
nwsm_dwnfl,date_format(nwsm_dt,'%d-%m-%Y') as nwsm_dt						    
from
nws_mst
where 
nwsm_id != ''";
if (isset($_REQUEST['txtsrchval']) && trim($_REQUEST['txtsrchval']) != '') {
    $val = glb_func_chkvl($_REQUEST['txtsrchval']);
    $loc .= "&txtsrchval=" . $val;
    $fldnm = " and nwsm_name";
    if (isset($_REQUEST['chkexact']) && $_REQUEST['chkexact'] == 'y') {
        $loc  .= "&chkexact=y";
        $sqrynews_mst1 .= " $fldnm ='$val'";
    } else {
        $sqrynews_mst1 .= " $fldnm like '%$val%'";
    }
}
if (isset($_REQUEST['lsttyp']) && trim($_REQUEST['lsttyp']) != '') {
    $lsttyp = glb_func_chkvl($_REQUEST['lsttyp']);
    $loc .= "&lsttyp=" . $lsttyp;
    $lsttypfldnm = " and nwsm_typ";
    if (isset($_REQUEST['chkexact']) && $_REQUEST['chkexact'] == 'y') {
        $loc  .= "&chkexact=y";
        $sqrynews_mst1 .= " $lsttypfldnm ='$lsttyp'";
    } else {
        $sqrynews_mst1 .= " $lsttypfldnm like '%$lsttyp%'";
    }
}
$sqrynews_mst = $sqrynews_mst1 . " order by nwsm_name asc limit $offset,$rowsprpg";
$srsnews_mst = mysqli_query($conn, $sqrynews_mst);
$serchres = mysqli_num_rows($srsnews_mst);
include_once 'script.php';
?>
<script language="javascript">
    function addnew() {
        document.frmnews.action = "<?php echo $rd_adpgnm; ?>";
        document.frmnews.submit();
    }


    function validate() {
        var urlval = "";
        if (document.frmnews.txtsrchval.value == "" && document.frmnews.lsttyp.value == "") {
            alert("Enter Name");
            document.frmnews.lstsrchby.focus();
            return false;
        }

        var lsttyp = document.frmnews.lsttyp.value
        var txtsrchval = document.frmnews.txtsrchval.value;
        if (txtsrchval != '') {
            urlval += "txtsrchval=" + txtsrchval;
        }
        if (lsttyp != '') {
            urlval += "lsttyp=" + lsttyp;
        }
        if (document.frmnews.chkexact.checked == true) {
            document.frmnews.action = "<?php echo $rd_crntpgnm; ?>?" + urlval + "&chkexact=y";
            document.frmnews.submit();
        } else {
            document.frmnews.action = "<?php echo $rd_crntpgnm; ?>?" + urlval;
            document.frmnews.submit();
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
                            Updates / Notifications</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">View All
                                Updates / Notifications</li>
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
                <form method="post" action="<?php $_SERVER['SCRIPT_FILENAME']; ?>" name="frmnews" id="frmnews">
                    <input type="hidden" name="hdnchkval" id="hdnchkval">
                    <input type="hidden" name="hdnchksts" id="hdnchksts">
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
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <?php
                                    $sqryprodcat_mst =  "select
                                    nwsm_id,nwsm_name,nwsm_sts,nwsm_prty,nwsm_typ,
                                    nwsm_dwnfl,date_format(nwsm_dt,'%d-%m-%Y') as nwsm_dt						    
                                    from
                                    nws_mst
                                    where 
                                    nwsm_id != ''";;
                                    $srsprodcat_mst = mysqli_query($conn, $sqryprodcat_mst);
                                    $cnt_prodcat = mysqli_num_rows($srsprodcat_mst);
                                    ?>


                                    <select name="lsttyp" id="lsttyp" class="form-control">
                                        <!--  <option value="n" selected>News</option>-->
                                        <option value="">Select type </option>
                                        <option value="1" <?php if (isset($_REQUEST['lsttyp']) && $_REQUEST['lsttyp'] == "1") {
                                                                echo 'selected';
                                                            } ?>>Results Updates</option>
                                        <option value="2" <?php if (isset($_REQUEST['lsttyp']) && $_REQUEST['lsttyp'] == "2") {
                                                                echo 'selected';
                                                            } ?>>College Notifications</option>
                                        <option value="3" <?php if (isset($_REQUEST['lsttyp']) && $_REQUEST['lsttyp'] == "3") {
                                                                echo 'selected';
                                                            } ?>>University Notifications</option>
                                    </select>
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
                                    <input type="submit" value="Search" class="btn btn-primary" name="btnsbmt" onClick="validate();">
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

                                            <input name="btnsts" id="btnsts" type="button" class="btn btn-xs btn-primary" value="Status" onClick="updatests('hdnchksts','frmnews','chksts')">
                                        </div>
                                    </td>
                                    <td width="7%" align="right" valign="bottom">
                                        <div align="right">
                                            <input name="btndel" id="btndel" type="button" class="btn btn-xs btn-primary" value="Delete" onClick="deleteall('hdnchkval','frmnews','chkdlt');">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="8%" class="td_bg"><strong>SL.No.</strong></td>
                                    <td width="28%" class="td_bg"><strong>Name</strong></td>
                                    <td width="24%" class="td_bg"><strong>Type</strong></td>
                                    <td width="24%" class="td_bg"><strong>Date</strong></td>
                                    <td width="6%" align="center" class="td_bg"><strong>Rank</strong></td>
                                    <td width="7%" align="center" class="td_bg"><strong>Edit</strong></td>
                                    <td width="7%" class="td_bg" align="center"><strong>
                                            <input type="checkbox" name="Check_ctr" id="Check_ctr" value="yes" onClick="Check(document.frmnews.chksts,'Check_ctr','hdnallval')"></strong></td>
                                    <td width="7%" class="td_bg" align="center"><strong>
                                            <input type="checkbox" name="Check_dctr" id="Check_dctr" value="yes" onClick="Check(document.frmnews.chkdlt,'Check_dctr')"></strong></td>
                                </tr>
                                <?php
                                $cnt = $offset;
                                if ($serchres > 0) {
                                    while ($srownews_mst = mysqli_fetch_assoc($srsnews_mst)) {
                                        $db_nwid    = $srownews_mst['nwsm_id'];
                                        $db_nwnm    = $srownews_mst['nwsm_name'];
                                        $db_nwprty  = $srownews_mst['nwsm_prty'];
                                        $db_nwsts   = $srownews_mst['nwsm_sts'];
                                        $flenm        = $srownews_mst['nwsm_dwnfl'];
                                        $nwsDt        = $srownews_mst['nwsm_dt'];
                                        $nwstyp        = $srownews_mst['nwsm_typ'];
                                        $flepth        = $dwnfl_upldpth . $db_nwid . "-" . $flenm;
                                        $cnt += 1;
                                ?>
                                        <tr <?php if ($cnt % 2 == 0) {
                                                echo "";
                                            } else {
                                                echo "";
                                            } ?>>
                                            <td><?php echo $cnt; ?></td>
                                            <!-- <td><?php echo $db_nwid; ?></td> -->
                                            <td>
                                                <a href="<?php echo $rd_vwpgnm; ?>?vw=<?php echo $db_nwid; ?>&pg=<?php echo $pgnum; ?>&countstart=<?php echo $cntstart . $loc; ?>" class="links"><?php echo $db_nwnm; ?></a>
                                            </td>
                                            <td align="left" valign="top"><?php
                                                                            if ($nwstyp == '1') {
                                                                                $db_nwtypnm = 'Results Updates';
                                                                            } elseif ($nwstyp == '2') {
                                                                                $db_nwtypnm = 'College Notifications';
                                                                            } elseif ($nwstyp == '3') {
                                                                                $db_nwtypnm = 'University Notifications';
                                                                            } else {
                                                                                $db_nwtypnm = "";
                                                                            }
                                                                            echo $db_nwtypnm;
                                                                            ?></td>
                                            <td align="left"><?php echo  $nwsDt;   ?></td>
                                            <td align="center"><?php echo $db_nwprty; ?></td>
                                            <td align="center">
                                                <a href="<?php echo $rd_edtpgnm; ?>?edit=<?php echo $db_nwid; ?>&pg=<?php echo $pgnum; ?>&countstart=<?php echo $cntstart . $loc; ?>" class="orongelinks">Edit</a>
                                            </td>
                                            <!-- <td align="left"> -->
                                            <?php

                                            // $imgnm   = $srowveh_brnd_mst['prodscatm_bnrimg'];
                                            // $imgpath = $a_scat_bnrfldnm . $imgnm;
                                            // if (($imgnm != "") && file_exists($imgpath)) {
                                            //     echo "<img src='$imgpath' width='80pixel' height='80pixel'>";
                                            // } else {
                                            //     echo "N.A.";
                                            // }
                                            // 
                                            ?>

                                            <!-- </td> -->
                                            <!-- <td align="center"><?php echo funcDsplyCattwoTyp($db_scttyp); ?></td> -->


                                            <td align="center">
                                                <input type="checkbox" name="chksts" id="chksts" value="<?php echo  $db_nwid;; ?>" <?php if ($db_nwsts == 'a') {
                                                                                                                                        echo "checked";
                                                                                                                                    } ?> onClick="addchkval(<?php echo $db_nwid; ?>,'hdnchksts','frmnews','chksts');">
                                            </td>
                                            <td align="center">
                                                <input type="checkbox" name="chkdlt" id="chkdlt" value="<?php echo  $db_nwid; ?>">
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
                                            <input name="btnsts" id="btnsts" type="button" value="Status" onClick="updatests('hdnchksts','frmnews','chksts')" class="btn btn-xs btn-primary">
                                        </div>
                                    </td>
                                    <td width="7%" align="right" valign="bottom">
                                        <div align="right">
                                            <input name="btndel" id="btndel" type="button" value="Delete" onClick="deleteall('hdnchkval','frmnews','chkdlt');" class="btn btn-xs btn-primary">
                                        </div>
                                    </td>
                                </tr>
                                <?php
                                $disppg = funcDispPag($conn, 'links', $loc, $sqryprodscat_mst1, $rowsprpg, $cntstart, $pgnum);
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