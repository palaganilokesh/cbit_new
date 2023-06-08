<?php
include_once "includes/inc_config.php";
include_once 'includes/inc_connection.php'; //Making database Connection
include_once 'includes/inc_usr_functions.php'; //checking for session	
include_once 'includes/inc_usr_sessions.php';
include_once 'includes/inc_folder_path.php';
?>
<!DOCTYPE html>
<html lang="zxx">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="author" content="CBIT">

	<title><?php if (isset($page_seo_title) && !empty($page_seo_title)) echo $page_seo_title; ?></title>

	<?php if (isset($db_seodesc) && isset($db_seokywrd)) { ?>
		<meta name="description" content="<?php echo $db_seodesc; ?>">
		<meta name="keywords" content="<?php echo $db_seokywrd; ?>">

	<?php } ?>

	<link rel="icon" type="image/png" href="assets/images/icons/favicon-16x16.png" sizes="16x16">
	<link rel="icon" type="image/png" href="assets/images/icons/favicon-32x32.png" sizes="32x32">
	<link rel="icon" type="image/png" href="assets/images/icons/favicon-96x96.png" sizes="96x96">

	<link rel="apple-touch-icon" sizes="57x57" href="assets/images/icons/apple-touch-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="114x114" href="assets/images/icons/apple-touch-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="72x72" href="assets/images/icons/apple-touch-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="144x144" href="assets/images/icons/apple-touch-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="60x60" href="assets/images/icons/apple-touch-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="120x120" href="assets/images/icons/apple-touch-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="76x76" href="assets/images/icons/apple-touch-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="152x152" href="assets/images/icons/apple-touch-icon-152x152.png">

	<meta name="twitter:card" content="CBIT">
	<meta name="twitter:site" content="https://www.cbit.ac.in/">
	<meta name="twitter:creator" content="CBIT">
	<meta name="twitter:title" content="Home">
	<meta name="twitter:description" content="Chaitanya Bharathi Institute of Technology">
	<meta name="twitter:image" content="">

	<meta property="og:url" content="">
	<meta property="og:title" content="">
	<meta property="og:description" content="">
	<meta property="og:type" content="website">
	<meta property="og:image" content="">
	<meta property="og:image:type" content="">
	<meta property="og:image:width" content="">
	<meta property="og:image:height" content="">

	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/meanmenu.css">
	<link rel="stylesheet" href="assets/css/owl.carousel.min.css">
	<link rel="stylesheet" href="assets/css/owl.theme.default.min.css">
	<link rel="stylesheet" href="assets/css/magnific-popup.css">
	<link rel="stylesheet" href="assets/css/flaticon.css">
	<link rel="stylesheet" href="assets/css/remixicon.css">
	<!-- <link href="https://cdn.jsdelivr.net/npm/remixicon@2.2.0/fonts/remixicon.css" rel="stylesheet"> -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link rel="stylesheet" href="assets/css/odometer.min.css">
	<link rel="stylesheet" href="assets/css/aos.css">

	<link rel="stylesheet" href="mega-menu.css">

	<link rel="stylesheet" href="assets/css/style.css">
	<link rel="stylesheet" href="assets/css/dark.css">
	<link rel="stylesheet" href="assets/css/responsive.css">

	<link rel="stylesheet" href="https://cdn.rawgit.com/sachinchoolur/lightgallery.js/master/dist/css/lightgallery.css">
</head>

<body>
	<div class="preloader-area">
		<!-- <img src="assets/images/icon/load-2.gif" alt=""> -->
		<div class="d-flex justify-content-center align-items-center h-100">
			<div class="loaders">
				<div class="loader">
					<div class="loader-inner ball-pulse">
						<div></div>
						<div></div>
						<div></div>
					</div>
				</div>
			</div>
		</div>

		<!-- <div class="spinner">
            <div class="inner">
                <div class="disc"></div>
                <div class="disc"></div>
                <div class="disc"></div>
            </div>
        </div> -->
	</div>
	<?php
	$sqryanounce_mst =  "SELECT nwsm_id,nwsm_name,nwsm_sts,nwsm_prty,nwsm_typ,nwsm_dwnfl,date_format(nwsm_dt,'%d-%m-%Y') as nwsm_dt,nwsm_desc,nwsm_lnk	from nws_mst where nwsm_id != ''and nwsm_sts='a' and nwsm_typ=4";;
	$srsanounce_mst = mysqli_query($conn, $sqryanounce_mst);
	$cnt_anounce = mysqli_num_rows($srsanounce_mst);
	?>
	<div class="navbar-area">
		<div class="top-header-area">
		
				<?php 
				if($cnt_anounce > 0)
				{
					?>
						<div class="an-label">
							<div class="an-label-holder">
								<p class="d-flex align-items-center"><span class="d-lg-block d-md-block d-none">Announcements</span>
								<span class="ms-2"><i class="fas fa-bullhorn"></i></span>
							</p>
					</div>
				</div>
			<?php	
		}
		?>
				
		
			<div class="container-fluid">
				<div class="row align-items-center justify-content-lg-between justify-content-md-between justify-content-end">
					<div class="col-lg-11 col-md-11 col-12 mb-lg-0 mb-md-0 mb-2">
					<div class="head-mar-holder">
							<marquee class="marquee" onmouseover="this.stop();" onmouseout="this.start();">
								<div class="header-left-content header-right-content">
									<div class="list top-not-links">
										<ul>
						<?php 
						while($anounce=mysqli_fetch_assoc($srsanounce_mst)){
							$ancmt_id=$anounce['nwsm_id'];
							$ancmt_nm=$anounce['nwsm_name'];
							$ancmt_desc=$anounce['nwsm_desc'];
							$ancmt_link=$anounce['nwsm_lnk'];
							$ancmt_dt=$anounce['nwsm_dt'];
							?>
							<li>
								<a href="<?php echo $rtpth .$ancmt_link;?>"><img src="assets/images/icon/new.gif" alt=""> <?php echo $ancmt_desc ;?></a></li>
						<?php	}

						?>
										
										</ul>
									</div>
								</div>
							</marquee>
						</div>


					</div>

					<div class="col-lg-1 col-md-1 col-2 d-xl-none d-lg none d-md-none d-block">
						<div class="">
							<div class="list d-flex align-items-center justify-content-lg-end justify-content-md-end justify-content-start">
								<div class="search-box">
									<a href="#" data-bs-toggle="modal" data-bs-target="#searchPopupModal"><i class="fas fa-search text-dark"></i></a>
								</div>
							</div>
						</div>
					</div>


					<div class="col-lg-1 col-md-1 col-10  pl-0">

						<div class="header-right-content">
							<div class="list top-not-links">

								<div class="desktop-nav">
									<div class="navbar d-flex justify-content-end">
										<div class="others-options">
											<div class="icon">
												<!-- <div class="d-flex align-items-center">
                                            <span class="imp-links-text-desk d-xxl-block d-xl-block d-lg-block d-md-block d-none">Important Links</span> <i class="ri-menu-3-fill d-xxl-block d-xl-block d-lg-block d-md-block d-none" data-bs-toggle="modal" data-bs-target="#sidebarModal"></i> </div>
                                             -->
												<span class="imp-links-text" data-bs-toggle="modal" data-bs-target="#sidebarModal">
													<!-- <i class="ri-menu-3-fill" data-bs-toggle="modal" data-bs-target="#sidebarModal"></i> -->
													<i class="fas fa-bars" data-bs-toggle="modal" data-bs-target="#sidebarModal"></i>
												</span>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>
		<div class="mid-area py-xxl-1 py-xl-1 py-lg-1 py-md-1">
			<div class="container-fluid">
				<div class="row align-items-center justify-content-between">

					<div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 d-xl-block d-lg block d-md-block d-none">
						<a href="<?php echo $rtpth; ?>home">
							<img src="assets/images/logos/cbit-logo-green.png" class="main-logo" alt="logo">
						</a>

					</div>

					<div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 d-xl-block d-lg block d-md-block d-none">

						<div class="row flex-column justify-content-end align-items-center">

							<div class="col-lg-12 col-md-12">

								<div class="navbar-area">

									<div class="desktop-nav">
										<div class="container-fluid">
											<nav class="navbar navbar-expand-md navbar-light">
												<!-- #########  Start Top Menu display based on mainlink table display type =news  ########### -->
												<?php
												$sqlmenu = "SELECT prodmnlnksm_id,prodmnlnksm_name,prodmnlnksm_dsplytyp,prodmnlnksm_typ,prodmnlnksm_sts,prodmnlnksm_prty from  prodmnlnks_mst  where prodmnlnksm_typ='n' and prodmnlnksm_sts='a' and prodmnlnksm_id !='' ";
												$result = mysqli_query($conn, $sqlmenu);
												$cnt = mysqli_num_rows($result);
												if ($cnt > 0) {
												?>
													<div class="collapse navbar-collapse mean-menu " id="navbarSupportedContent">
														<ul class="navbar-nav">
															<?php
															while ($row = mysqli_fetch_assoc($result)) {
																$name = $row['prodmnlnksm_name'];
															?>
																<li class="nav-item">
																	<a href="<?php echo $rtpth; ?>" class="nav-link"><?php echo $name; ?></a>
																</li>
															<?php
															}
															?>
														</ul>
													</div>
												<?php
												}
												?>
												<!-- #########  close Top Menu display based on mainlink table display type =news  ########### -->
											</nav>
										</div>
									</div>


								</div>

							</div>

							<div class="col-lg-12 col-md-12">
								<div class="row justify-content-end align-items-center">

									<div class="col-xl-4 col-lg-4 col-md-4 d-xl-block d-lg block d-md-block d-none">
										<div class="row asso-logos gx-xl-2 gx-lg-2 gx-md-2 align-items-center justify-content-end">

											<div class="approveLogos-slider mb-20 owl-carousel owl-theme">

												<div class="item py-0 px-0">
													<a href="#">
														<img src="assets/images/logos/nba.jpg" class="w-100 " alt="logo">
													</a>
												</div>
												<!-- <div class="item py-0 px-0">
                                                    <a href="#">
                                                        <img src="assets/images/logos/naac.jpg" class="w-100 "
                                                            alt="logo">
                                                    </a>
                                                </div> -->
												<div class="item py-0 px-0">
													<a href="#">
														<img src="assets/images/logos/nirf.jpg" class="w-100 " alt="logo">
													</a>
												</div>
												<div class="item py-0 px-0">
													<a href="#">
														<img src="assets/images/logos/a-naac.jpg" class="w-100 " alt="logo">
													</a>
												</div>
												<!-- <div class="item py-0 px-0">
                                                    <a href="#">
                                                        <img src="assets/images/logos/44-years.jpg" class="w-100 "
                                                            alt="logo">
                                                    </a>
                                                </div> -->


											</div>



										</div>

									</div>

									<div class="col-xl-5 col-lg-5 col-md-5 d-xl-block d-lg block d-md-block d-none">

										<div class="serch-pop header-search">
											<form action="">
												<div class="input-group mb-0">
													<input type="text" class="form-control" placeholder="Search here.." aria-label="Recipient's username" aria-describedby="basic-addon2">
													<span class="input-group-text" id="basic-addon2"><i class="fas fa-search"></i></span>
												</div>
											</form>

										</div>
										<!-- <div class="">
                                    <div
                                     class="list d-flex align-items-center justify-content-lg-end justify-content-md-end justify-content-start">
                                 <div class="search-box">
                                       <a href="#" data-bs-toggle="modal" data-bs-target="#searchPopupModal"><i class="fas fa-search text-dark"></i></a>
                                 </div>
                                         </div>
                                        </div> -->
									</div>

								</div>
							</div>






						</div>

					</div>


					<div class="col-lg-4 col-md-4 d-xl-none d-lg none d-md-none d-block">
						<div class="mobile-responsive-nav py-2">
							<div class="container-fluid gx-0">
								<div class="">
									<div class="logo">

										<a href="<?php echo $rtpth; ?>home">

											<img src="assets/images/logos/cbit-logo-green.png" class="main-logo " lt="logo">

										</a>
									</div>
								</div>
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>

		<!-- Main navigatin menu start here -->
		<header id="header" class="full-header">
			<div id="header-wrap" class="mega-menu-extarnal">
				<div class="container">
					<div class="header-row">



						<div id="primary-menu-trigger">
							<svg class="svg-trigger" viewBox="0 0 100 100">
								<path d="m 30,33 h 40 c 3.722839,0 7.5,3.126468 7.5,8.578427 0,5.451959 -2.727029,8.421573 -7.5,8.421573 h -20">
								</path>
								<path d="m 30,50 h 40"></path>
								<path d="m 70,67 h -40 c 0,0 -7.5,-0.802118 -7.5,-8.365747 0,-7.563629 7.5,-8.634253 7.5,-8.634253 h 20">
								</path>
							</svg>
						</div>
						<?php
						$sqryprodcat_mst_nav = "SELECT prodmnlnksm_id,prodmnlnksm_name,prodcatm_prodmnlnksm_id,prodcatm_id,prodcatm_name,prodcatm_prty,prodcatm_typ,prodmnlnksm_typ,prodmnlnksm_dsplytyp from prodcat_mst
							inner join prodmnlnks_mst on prodmnlnksm_id=prodcatm_prodmnlnksm_id where prodmnlnksm_sts='a' and prodcatm_sts='a' group by prodmnlnksm_id order by prodmnlnksm_prty desc,prodcatm_prty desc";
						$srsprodcat_mst_nav = mysqli_query($conn, $sqryprodcat_mst_nav);
						$cntrec_nav         = mysqli_num_rows($srsprodcat_mst_nav);
						if ($cntrec_nav > 0) {
						?>
							<nav class="primary-menu">
								<ul class="menu-container ps-0">
									<?php
									while ($srowprodcat_mst = mysqli_fetch_assoc($srsprodcat_mst_nav)) {
										$catname 	 = $srowprodcat_mst['prodmnlnksm_name'];
										$mnlnks 		 = $srowprodcat_mst['prodmnlnksm_id'];
										$prodcattyp  = $srowprodcat_mst['prodmnlnksm_typ'];
										$prodscattyp = $srowprodcat_mst['prodcatm_typ'];
										$catid		 = $srowprodcat_mst['prodcatm_id'];
										$disptype		 = $srowprodcat_mst['prodmnlnksm_dsplytyp'];
									?>
										<!-- verticle menu  start-->
										<?php
										if ($disptype == 1) {
										?>
											<li class="menu-item">
											<?php
										} elseif ($disptype == 2) {
											?>
											<li class="menu-item mega-menu">
											<?php
										}
											?>

											<a class="menu-link" href="<?php echo $rtpth . $catname; ?>">
												<div><?php echo $catname; ?> <i class="fa fa-chevron-down nav-with-icon"></i></div>
											</a>

											<?php
											$sqryprodscat_mst = "SELECT prodcatm_id,prodcatm_name,prodcatm_sts, prodcatm_typ,prodcatm_prodmnlnksm_id from prodcat_mst where prodcatm_prodmnlnksm_id ='$mnlnks' and prodcatm_sts ='a' group by prodcatm_id order by prodcatm_prty desc";
											$srsprodscat_mst = mysqli_query($conn, $sqryprodscat_mst);
											$cntrec_scat_nav = mysqli_num_rows($srsprodscat_mst);
											if ($cntrec_scat_nav > 0) {
											?>
												<!-- verticle menu -->


												<?php
												if ($disptype == 1) {
												?>
													<ul class="sub-menu-container">
													<?php
												} elseif ($disptype == 2) {
													?>
														<div class="mega-menu-content mega-menu-style-2">
															<div class="container">
																<div class="row" data-aos="fade-up" data-aos-duration="1200" data-aos-delay="600" data-aos-once="true">
																	<ul class="sub-menu-container mega-menu-column col-lg-12">
																		<li class="menu-item mega-menu-title cst-anim">
																			<ul class="sub-menu-container row">
																			<?php
																		}
																			?>

																			<?php
																			while ($srowprodscat_mst 	= mysqli_fetch_assoc($srsprodscat_mst)) {
																				$scatid 		  	= $srowprodscat_mst['prodscatm_id']; //ref
																				$scatname_nav	  	= $srowprodscat_mst['prodcatm_name'];
																				$scatnew_id	  		= $srowprodscat_mst['prodcatm_id'];
																				$scatnew_sts	  	= $srowprodscat_mst['prodcatm_sts'];
																				$scat_typ			= $srowprodscat_mst['prodcatm_typ'];
																			?>
																				<?php if ($disptype == 1) {
																				?>
																					<li class="menu-item">
																					<?php
																				} elseif ($disptype == 2) { ?>
																					<li class="menu-item col-lg-3 col-md-3">
																					<?php	}
																					?>
																					<a class="menu-link" href="#">
																						<div><?php echo $scatname_nav; ?></div>
																					</a>
																					</li>
																					<?php
																					// 	$sqryprodscat_mst_r = "SELECT prodscatm_id,prodscatm_name,pgcntsd_id,pgcntsd_name from prodscat_mst
																					// 	inner join pgcnts_dtl on pgcntsd_prodscatm_id=prodscatm_id where
																					// 	prodscatm_prodcatm_id = '$scatnew_id'  and prodscatm_sts='a' and pgcntsd_sts='a' group by pgcntsd_name asc limit 1";
																					//  $srsprodscat_mst_r = mysqli_query($conn, $sqryprodscat_mst_r);
																					// $cntrec_scat_nav_r = mysqli_num_rows($srsprodscat_mst_r);
																					// if ($cntrec_scat_nav_r > 0) {
																					// 	
																					?>
																					<!-- <ul class="sub-menu-container"> -->
																					<?php
																					// while ($srowprodscat_mst_r 	= mysqli_fetch_assoc($srsprodscat_mst_r)) {
																					// $scatname_nav_r	  	= $srowprodscat_mst_r['prodscatm_name'];
																					// $scatnew_id_r	   = $srowprodscat_mst_r['prodscatm_id'];
																					// $prodid   = $srowprodscat_mst_r['pgcntsd_id'];
																					// 
																					?>
																					<!-- <li class="menu-item"> -->
																					<!-- <a class="menu-link" href="#">
 					<div>new</div>
 			</a>
 	</li>
 </ul> -->
																				<?php
																				// }
																				// } 
																			}
																				?>
																				<?php
																				if ($disptype == 1) {
																				?>
																			</ul>
																		<?php
																				} elseif ($disptype == 2) {
																		?>
																	</ul>
											</li>
								</ul>
					</div>
				</div>
			</div>


	<?php
																				}
																			}
	?>

	<!-- menu close <li> -->
	</li>
<?php
									}
?>
<li class="menu-item">
	<a class="menu-link" href="<?php echo $rtpth; ?>contact-us">
		<div>Contact Us</div>
	</a>
</li>

</ul>
</nav>
<?php
						}

?>
	</div>
	</div>
	</div>
	<div class="header-wrap-clone"></div>
	</header>
	</div>


	<div class="sidebarModal modal right fade" id="sidebarModal" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<button type="button" class="close" data-bs-dismiss="modal"><i class="ri-close-line"></i></button>
				<div class="modal-body">
					<a href="#">
						<img src="assets/images/logos/cbit-logo-green.png" class="main-logo " alt="logo">
						<img src="assets/images/logos/cbit-logo-green.png" class="white-logo " alt="logo">




					</a>


					<div class="sidebar-content">
						<!-- <h3>Important Links</h3> -->

						<div class="imp-links-side">


							<ul class="navbar-nav m-auto">

								<li class="nav-item d-lg-none d-block">
									<a href="#" class="nav-link">CAMU</a>
								</li>
								<li class="nav-item d-lg-none d-block">
									<a href="#" class="nav-link">HR App</a>
								</li>
								<li class="nav-item d-lg-none d-block">
									<a href="#" class="nav-link">IQAC</a>
								</li>
								<li class="nav-item d-lg-none d-block">
									<a href="#" class="nav-link">Library</a>
								</li>
								<li class="nav-item d-lg-none d-block">
									<a href="#" class="nav-link">Alumni</a>
								</li>


								<li class="nav-item">
									<a href="#" class="nav-link">Mandatory Disclosures</a>
								</li>
								<li class="nav-item"><a href="#" class="nav-link">Student Info</a></li>
								<li class="nav-item">
									<a href="#" class="nav-link">AEC & COE</a>
								</li>
								<li class="nav-item"><a href="#" class="nav-link">NIRF/ARIIA</a></li>
								<li class="nav-item"><a href="#" class="nav-link">NAAC</a></li>
								<li class="nav-item"><a href="#" class="nav-link">NBA</a></li>
								<li class="nav-item"><a href="#" class="nav-link">LMS</a></li>
								<li class="nav-item"><a href="#" class="nav-link">Library</a></li>
								<li class="nav-item"><a href="#" class="nav-link">NISP</a></li>
								<li class="nav-item"><a href="#" class="nav-link">Recruitment</a></li>
								<li class="nav-item"><a href="#" class="nav-link">Covid Update</a></li>
								<li class="nav-item"><a href="#" class="nav-link">Login</a></li>
							</ul>



						</div>



					</div>




				</div>
			</div>
		</div>
	</div>