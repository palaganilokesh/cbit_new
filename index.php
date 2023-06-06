<?php
error_reporting(0);
session_start();
include_once 'includes/inc_config.php'; //Making paging validation	
include_once 'includes/inc_connection.php'; //Making database Connection
include_once 'includes/inc_usr_functions.php'; //checking for session	
include_once 'includes/inc_usr_sessions.php';
include_once 'includes/inc_folder_path.php';
$page_title = "Home | Chaitanya Bharathi Institute of Technology";
$page_seo_title = "Home | Chaitanya Bharathi Institute of Technology";
$db_seokywrd = "";
$db_seodesc = "";
$current_page = "home";
$body_class = "homepage";
include('header2.php');
?>
<!-- banners dynamic start -->
<?php
$sqryqry_bnr = "SELECT bnrm_id, bnrm_name, bnrm_desc,bnrm_text, bnrm_imgnm, bnrm_lnk, bnrm_prty, bnrm_sts FROM bnr_mst WHERE bnrm_sts = 'a' order by bnrm_prty asc ";
$sqry_bnr_mst = mysqli_query($conn, $sqryqry_bnr);
$bnr_cnt = mysqli_num_rows($sqry_bnr_mst);
if ($bnr_cnt > 0) {
?>
	<div class="homeBanners">
		<div class="homeBanner-slider mb-20 owl-carousel owl-theme">
			<?php
			while ($srowbnr_mst = mysqli_fetch_assoc($sqry_bnr_mst)) {
				$bnrid = $srowbnr_mst['bnrm_id'];
				$bnrttl = $srowbnr_mst['bnrm_name'];
				$bnrlnk = $srowbnr_mst['bnrm_lnk'];
				$bnrimgnm = $srowbnr_mst['bnrm_imgnm'];
				$bnrtxt = $srowbnr_mst['bnrm_text'];
				if($bnrtxt=='L')
				{
					$i=1;
				}
				elseif($bnrtxt=='R'){
					$i=2;
				}
				else{
					$i=3;
				}
				$bnrimgpth = $rtpth . $gusrbnr_fldnm . $bnrimgnm;
			?>
				<div class="item">

					<img src="<?php echo $bnrimgpth; ?>" class="w-100 d-md-block d-none" alt="">
					<img src="<?php echo $bnrimgpth; ?>" class="w-100 d-md-none d-block" alt="">

					<div class="banner-know-more-btn-<?php echo $i;?>">
						<!-- <div class="banner-cap-1">
				<h3>A new place for better innovation</h3>
		</div> -->
						<a href="#" class="custom-btn-12 transt"><?php echo $bnrttl;?> <i class="fa-solid fa-chevron-right"></i></a>
					</div>

				</div>

			<?php
			}
			?>
		</div>
	</div>
<?php
}

?>
<!-- banners dynamic end -->

<div class="campus-information-area section-pad-y pb-0 d-none">
	<div class="container">
		<div class="row">
			<div class="col-lg-6">
				<div class="campus-image">
					<img src="assets/images/cbit-welcome-2.jpg" alt="Image">
				</div>
			</div>
			<div class="col-lg-6">
				<div class="campus-content pr-20">

					<div class="section-title  text-start mb-3">
						<h2>WELCOME TO CBIT</h2>
					</div>
					<div class="campus-title">
						<p>We are known for our immaculate engineering and management courses, our emphasis on research
							and advanced methods of instruction always keep pushing towards excellence. </p>
					</div>

					<div>


						<h5>Our History</h5>
						<p>CHAITANYA BHARATHI INSTITUTE OF TECHNOLOGY, established in the Year 1979, esteemed as the
							Premier Engineering Institute in the States of Telangana and Andhra Pradesh, was promoted by
							a Group of Visionaries from varied Professions
							of Engineering, Medical, Legal and Management, with an Objective to facilitate </p>
					</div>

					<div class="mb-lg-0 mb-md-0 mt-3">
						<a href="<?php echo $rtpth; ?>about-us" class="custom-btn-12 green">Read more <i class="fa-solid fa-chevron-right"></i></a>
					</div>



				</div>
			</div>

		</div>

		<!-- <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div>
                        <h5 class="wel-headings">President's Messsage</h5>
                        <p>I welcome you to one of the most reputed and highly ranked Engineering Institutes of the Country. CBIT towers above all the other Private Engineering Institutes in the State for we continually endeavor to foster excellence in Technical
                            Education and Research. This has been possible due to the contribution and participation of every stakeholder, and the Institute's firm reliance, recognition and utilization of their ideas, perspectives, talents, and, abilities.
                        </p>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div>
                        <h5 class="wel-headings">Principal's Messsage</h5>
                        <p>CBIT has the Pride of Place amongst the Private Engineering Colleges in India and competes with the University Colleges in all facets of Education and Students achievements. I am honored and delighted to be the Principal, while
                            the Institute is Celebrating its 42 Years of successful journey and feel privileged to Welcome the Students as the Stake Holders who will uphold the Banner of CBIT high and continue to sustain the Excellence and the Premier
                            Status of the Institute. </p>
                    </div>
                </div>
            </div> -->


	</div>
</div>

<!-- Departments Start  -->

<?php
 $sqry_dept = "SELECT prodmnlnksm_id,prodmnlnksm_name,prodmnlnksm_desc,prodmnlnksm_bnrimg,prodmnlnksm_typ,prodmnlnksm_dsplytyp,prodmnlnksm_prty,prodmnlnksm_sts,prodcatm_id,prodcatm_prodmnlnksm_id,prodcatm_name,prodcatm_desc,prodcatm_bnrimg,prodcatm_icn,prodcatm_dsplytyp,prodcatm_typ,prodcatm_sts,prodcatm_prty,prodscatm_id,prodscatm_name,prodscatm_desc,prodscatm_bnrimg,prodscatm_dpttitle,prodscatm_dpthead,prodscatm_dptname,prodscatm_sts,prodscatm_prodcatm_id,prodscatm_prodmnlnksm_id,prodscatm_prty from  prodmnlnks_mst
 left join  prodcat_mst on prodcatm_prodmnlnksm_id = prodmnlnksm_id
 left join prodscat_mst on prodscatm_prodcatm_id = prodcatm_id
 where prodmnlnksm_id !='' and prodmnlnksm_sts ='a' and prodmnlnksm_sts = 'a' and prodcatm_sts='a' and prodscatm_sts='a' and prodmnlnksm_name='Departments' group by prodcatm_id ";
$sqry_dept_mst = mysqli_query($conn, $sqry_dept);
$dept_cnt = mysqli_num_rows($sqry_dept_mst);
if ($dept_cnt > 0) {
	?>
	<div class="courses-area section-pad-y">
	<div class="container">
		<div class="section-title">
				<h2>Departments</h2>
		</div>
		<div class="courses-slider mb-20 owl-carousel owl-theme">
		<?php
			while ($srowdept_mst = mysqli_fetch_assoc($sqry_dept_mst)) {
				$deptid = $srowdept_mst['prodmnlnksm_id'];
				$deptnm = $srowdept_mst['prodscatm_dpttitle'];//sub category department title
				$deptimgnm = $srowdept_mst['prodcatm_bnrimg'];
				$deptimg = $rtpth . $u_cat_bnrfldnm . $deptimgnm;
				?>
				<div class="single-courses-card style2">
				<div class="courses-img">
					<a href="#"><img src="<?php echo $deptimg;?>" alt="Image"></a>
				</div>
				<div class="courses-content">
					<a href="#">
						<h3><?php echo $deptnm;?></h3>
					</a>
					<a href="#" class="read-more-btn pull-right">Read more<i class="flaticon-next"></i></a>
				</div>
			</div>
			<?php
			}
			?>
		</div>
	</div>
	</div>
	<?php
}
?>






		
		

			<!-- <div class="single-courses-card style2">
				<div class="courses-img">
					<a href="#"><img src="assets/images/courses/2.jpg" alt="Image"></a>
				</div>
				<div class="courses-content">
					<a href="#">
						<h3>Mechanical Engineering</h3>
					</a>
					<a href="#" class="read-more-btn">Read more<i class="flaticon-next"></i></a>
				</div>
			</div>

			<div class="single-courses-card style2">
				<div class="courses-img">
					<a href="#"><img src="assets/images/courses/3.jpg" alt="Image"></a>
				</div>
				<div class="courses-content">
					<a href="#">
						<h3>Electrical & Electronics Engineering</h3>
					</a>
					<a href="#" class="read-more-btn">Read more<i class="flaticon-next"></i></a>
				</div>
			</div>

			<div class="single-courses-card style2">
				<div class="courses-img">
					<a href="#"><img src="assets/images/courses/4.jpg" alt="Image"></a>
				</div>
				<div class="courses-content">
					<a href="#">
						<h3>Computer Science and Engineering</h3>
					</a>
					<a href="#" class="read-more-btn">Read more<i class="flaticon-next"></i></a>
				</div>
			</div>

			<div class="single-courses-card style2">
				<div class="courses-img">
					<a href="#"><img src="assets/images/courses/1.jpg" alt="Image"></a>
				</div>
				<div class="courses-content">
					<a href="#">
						<h3>Civil Engineering</h3>
					</a>
					<a href="#" class="read-more-btn">Read more<i class="flaticon-next"></i></a>
				</div>
			</div> -->

			<!-- <div class="single-courses-card style2">
				<div class="courses-img">
					<a href="#"><img src="assets/images/courses/2.jpg" alt="Image"></a>
				</div>
				<div class="courses-content">
					<a href="#">
						<h3>Mechanical Engineering</h3>
					</a>
					<a href="#" class="read-more-btn">Read more<i class="flaticon-next"></i></a>
				</div>
			</div>

			<div class="single-courses-card style2">
				<div class="courses-img">
					<a href="#"><img src="assets/images/courses/3.jpg" alt="Image"></a>
				</div>
				<div class="courses-content">
					<a href="#">
						<h3>Electrical & Electronics Engineering</h3>
					</a>
					<a href="#" class="read-more-btn">Read more<i class="flaticon-next"></i></a>
				</div>
			</div>

			<div class="single-courses-card style2">
				<div class="courses-img">
					<a href="#"><img src="assets/images/courses/4.jpg" alt="Image"></a>
				</div>
				<div class="courses-content">
					<a href="#">
						<h3>Computer Science and Engineering</h3>
					</a>
					<a href="#" class="read-more-btn">Read more<i class="flaticon-next"></i></a>
				</div>
			</div>


		</div>

	</div>
</div> -->


<div class="podcasts-area section-pad-y news-events-home pt-0">
	<div class="container">
		<div class="row">
			<div class="col-lg-8">

				<!-- <div class="section-title text-start">
                    <h2>News & Events</h2>
                </div> -->
				<div class="row slide-on-mob news-notif">

					<div class="description">
						<div class="container p-0">
							<nav>
								<div class="nav nav-tabs d-flex mb-0" id="nav-tab" role="tablist">
									<button class="nav-link active" id="nav-overview-tab" data-bs-toggle="tab" data-bs-target="#nav-overview" type="button" role="tab" aria-controls="nav-overview" aria-selected="true">Events</button>

									<button class="nav-link" id="nav-curriculum-tab" data-bs-toggle="tab" data-bs-target="#nav-curriculum" type="button" role="tab" aria-controls="nav-curriculum" aria-selected="false">News</button>


								</div>
							</nav>
							<div class="tab-content news-events-tabContent" id="nav-tabContent">

								<div class="tab-pane fade show active" id="nav-overview" role="tabpanel" aria-labelledby="nav-overview-tab">

									<div class="overview">
										<div class="learn row mb-0">

											<div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-12">
												<div class="single-podcasts-card" data-aos="fade-up" data-aos-duration="1200" data-aos-delay="200" data-aos-once="true">
													<div class="row align-items-start gx-lg-3 gx-md-3 gx-0">
														<div class="col-xxl-1 col-xl-1 col-lg-1 col-md-2 col-2">

															<div class="ent-date">
																<div class="dte">
																	<p>04</p>
																</div>
																<div class="mnt">
																	<p>May</p>
																</div>
															</div>

														</div>
														<div class="col-xxl-11 col-xl-11 col-lg-11 col-md-10 col-10">
															<div class="podcast-content">
																<span><img src="assets/images/icon/new.gif" alt=""></span>

																<h3>One Day Workshop on Modern Conctrete and
																	Retrofitting Technique </h3>
																<p><strong>Venue: </strong>Chaitanya Bharathi Institute
																	of Technology.</p>
																<a href="#" class="read-more-btn float-end">Read more<i class="flaticon-next"></i></a>

															</div>
														</div>
													</div>
												</div>
											</div>

											<div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-12">
												<div class="single-podcasts-card" data-aos="fade-up" data-aos-duration="1200" data-aos-delay="200" data-aos-once="true">
													<div class="row align-items-start gx-lg-3 gx-md-3 gx-0">
														<div class="col-xxl-1 col-xl-1 col-lg-1 col-md-2 col-2">

															<div class="ent-date">
																<div class="dte">
																	<p>12</p>
																</div>
																<div class="mnt">
																	<p>June</p>
																</div>
															</div>

														</div>
														<div class="col-xxl-11 col-xl-11 col-lg-11 col-md-10 col-10">
															<div class="podcast-content">
																<span><img src="assets/images/icon/new.gif" alt=""></span>

																<h3>One Day Workshop on Modern Conctrete and
																	Retrofitting Technique </h3>
																<p><strong>Venue: </strong>Chaitanya Bharathi Institute
																	of Technology.</p>
																<a href="#" class="read-more-btn float-end">Read more<i class="flaticon-next"></i></a>

															</div>
														</div>
													</div>
												</div>
											</div>


											<div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-12">
												<div class="single-podcasts-card" data-aos="fade-up" data-aos-duration="1200" data-aos-delay="200" data-aos-once="true">
													<div class="row align-items-start gx-lg-3 gx-md-3 gx-0">
														<div class="col-xxl-1 col-xl-1 col-lg-1 col-md-2 col-2">

															<div class="ent-date">
																<div class="dte">
																	<p>10</p>
																</div>
																<div class="mnt">
																	<p>April</p>
																</div>
															</div>

														</div>
														<div class="col-xxl-11 col-xl-11 col-lg-11 col-md-10 col-10">
															<div class="podcast-content">
																<span><img src="assets/images/icon/new.gif" alt=""></span>

																<h3>One Day Workshop on Modern Conctrete and
																	Retrofitting Technique </h3>
																<p><strong>Venue: </strong>Chaitanya Bharathi Institute
																	of Technology.</p>
																<a href="#" class="read-more-btn float-end">Read more<i class="flaticon-next"></i></a>

															</div>
														</div>
													</div>
												</div>
											</div>

										</div>
									</div>
								</div>


								<div class="tab-pane fade" id="nav-curriculum" role="tabpanel" aria-labelledby="nav-curriculum-tab">

									<div class="overview">
										<div class="learn row mb-0">
											<div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-12">
												<div class="single-podcasts-card" data-aos="fade-up" data-aos-duration="1200" data-aos-delay="200" data-aos-once="true">
													<div class="row align-items-start gx-lg-3 gx-md-3 gx-0">
														<div class="col-xxl-2 col-xl-2 col-lg-2 col-md-2 col-4">
															<div class="podcasts-image">
																<img src="assets/images/events/1.jpg" alt="Image">
															</div>
														</div>
														<div class="col-xxl-10 col-xl-10 col-lg-10 col-md-10 col-8">
															<div class="podcast-content">
																<span>20<sup>th</sup> Feb 2023 <img src="assets/images/icon/new.gif" alt=""></span>
																<h3>One Day Workshop on Modern Conctrete and
																	Retrofitting Technique </h3>
																<!-- <p>Chaitanya Bharathi Institute of Technology, established in the Year 1979,
                                            esteemed as the premier engineering institute.</p> -->
																<a href="#" class="read-more-btn float-end">Read more<i class="flaticon-next"></i></a>

															</div>
														</div>
													</div>
												</div>
											</div>

											<div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-12">
												<div class="single-podcasts-card" data-aos="fade-up" data-aos-duration="1200" data-aos-delay="200" data-aos-once="true">
													<div class="row align-items-start gx-lg-3 gx-md-3 gx-0">
														<div class="col-xxl-2 col-xl-2 col-lg-2 col-md-2 col-4">
															<div class="podcasts-image">
																<img src="assets/images/events/2.jpg" alt="Image">
															</div>
														</div>
														<div class="col-xxl-10 col-xl-10 col-lg-10 col-md-10 col-8">
															<div class="podcast-content">
																<span>15<sup>th</sup> Jan 2023 <img src="assets/images/icon/new.gif" alt=""></span>
																<h3>National Level Workshop On Applications Of
																	Mathematics</h3>
																<a href="#" class="read-more-btn float-end">Read more<i class="flaticon-next"></i></a>

															</div>
														</div>
													</div>
												</div>

											</div>

											<div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-12">
												<div class="single-podcasts-card" data-aos="fade-up" data-aos-duration="1200" data-aos-delay="200" data-aos-once="true">
													<div class="row align-items-start gx-lg-3 gx-md-3 gx-0">
														<div class="col-xxl-2 col-xl-2 col-lg-2 col-md-2 col-4">
															<div class="podcasts-image">
																<img src="assets/images/events/3.jpg" alt="Image">
															</div>
														</div>
														<div class="col-xxl-10 col-xl-10 col-lg-10 col-md-10 col-8">
															<div class="podcast-content">
																<span>3<sup>rd</sup> Dec 2022</span>
																<h3>Latest Competitions And Technical Rules In Athletics
																</h3>
																<a href="#" class="read-more-btn float-end">Read more<i class="flaticon-next"></i></a>

															</div>
														</div>
													</div>
												</div>
											</div>

											<div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-12">
												<div class="single-podcasts-card" data-aos="fade-up" data-aos-duration="1200" data-aos-delay="200" data-aos-once="true">
													<div class="row align-items-start gx-lg-3 gx-md-3 gx-0">
														<div class="col-xxl-2 col-xl-2 col-lg-2 col-md-2 col-4">
															<div class="podcasts-image">
																<img src="assets/images/events/3.jpg" alt="Image">
															</div>
														</div>
														<div class="col-xxl-10 col-xl-10 col-lg-10 col-md-10 col-8">
															<div class="podcast-content">
																<span>3<sup>rd</sup> Dec 2022</span>
																<h3>Latest Competitions And Technical Rules In Athletics
																</h3>
																<a href="#" class="read-more-btn float-end">Read more<i class="flaticon-next"></i></a>

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
					</div>


				</div>



				<div class="single-podcasts-card mb-0">
					<div class="row align-items-center justify-content-end">
						<div class="col-xxl-3 col-xl-3 col-lg-3 col-md-3 col-6">
							<div class="mb-lg-0 mb-md-0 mb-2 text-end">
								<a href="#" class="custom-btn-12 green">View All <i class="fa-solid fa-chevron-right"></i></a>
							</div>

						</div>

					</div>
				</div>



			</div>
<!-- ######### NOTIFICATION START ######## -->
			<?php 
	 $sqrynws_mst = "SELECT  nwsm_id,nwsm_name,nwsm_desc,nwsm_sts, nwsm_dwnfl,nwsm_prty,nwsm_dt,nwsm_img from  nws_mst where  nwsm_sts ='a' and nwsm_typ = 2 order by nwsm_prty desc limit 6	";
			$srsnws_mst = mysqli_query($conn, $sqrynws_mst) or die(mysqli_error($conn));
			$serchres	= mysqli_num_rows($srsnws_mst);
			if ($serchres > 0) { ?>

			<div class="col-lg-4">
				<div class="section-title text-start notific-cus">
					<h2 class="mt-lg-0 mt-md-0 mt-3">Notifications</h2>
				</div>
				<div class="categories">
					<marquee style="height:430px;" scrollamount="6" direction="up" scroll="continuous" onmouseover="this.stop();" onmouseout="this.start();">
						<!-- <h3 class="text-white">Notifications</h3> -->
						<div class="marquee-wrapper">
							<div class="marque-loop">
								<ul>
									<?php
								while($srownws_mstreslt = mysqli_fetch_assoc($srsnws_mst)){
								$resltnwsid   = $srownws_mstreslt['nwsm_id'];
								$resltnewsdate = $srownws_mstreslt['nwsm_dt'];
							$resltnewsname =  $srownws_mstreslt['nwsm_name'];
							$resltnewsdsec =  $srownws_mstreslt['nwsm_desc'];
							?>
									<li>
										<a href="<?php echo  $rtpth ?>feed-details.php?nwsid=<?php echo $resltnwsid ?>" class="d-flex align-items-baseline">
											<span> <i class="fa-regular fa-bell"></i></span>
											<span><?php echo 	$resltnewsname;?> <img src="assets/images/icon/new.gif" alt=""></span>
										</a>
									</li>
						<?php
					 } 
					 ?>
								</ul>
							</div>
						</div>
					</marquee>
				</div>
				
				<div class="single-podcasts-card mt-3 mb-0">
					<div class="row align-items-center justify-content-end">
						<div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-6">
							<div class="mb-lg-0 mb-md-0 mb-2 text-end">
								<a href="<?php echo  $rtpth ?>news_all.php?typval=2" class="custom-btn-12 green">View All <i class="fa-solid fa-chevron-right"></i></a>
							</div>

						</div>

					</div>
				</div>
			</div>

				<?php
					 } 
					 ?>
<!-- ######### NOTIFICATION END ######## -->
		</div>
	</div>
</div>



<section id="numbers" class="cbit-by-numbers">
	<div class="container-fluid">

		<div class="section-title text-center">
			<h2 class="mt-lg-0 mt-md-0 mt-3 pipe-1">CBIT By Numbers</h2>
		</div>
		<div class="row">
			<div class="col-lg-3 col-12 position-relative px-0 hidden-xs cbit-numbers-side-logo">
				<img src="assets/images/cbit-numbers-logo.png" class="w-100 h-100">
			</div>
			<div class="numArea col-lg-9 col-12 px-0">


				<div class="numBox text-center">
					<h3><span class="odometer" data-count="44">00</span><span class="target">+</span></h3>
					<p>Years of Academic Excellence</p>
				</div>
				<div class="numBox text-center">
					<h3><span class="odometer" data-count="22">00</span><span class="target"></span></h3>
					<p>Programmes</p>
				</div>
				<div class="numBox text-center">
					<h3><span class="odometer" data-count="333">00</span><span class="target">+</span></h3>
					<p>Highly Dedicated Faculty</p>
				</div>
				<div class="numBox text-center">
					<h3><span class="odometer" data-count="143">00</span><span class="target">+</span></h3>
					<p>Faculty with Ph.D and 102 Pusuing Ph.D</p>
				</div>
				<div class="numBox text-center">
					<h3><span class="odometer" data-count="68">00</span><span class="target">+</span></h3>
					<p>Research Projects from AICTE, DST, DRDO, MSME and State Government</p>
				</div>
				<div class="numBox text-center">
					<h3><span class="odometer" data-count="140">00</span><span class="target">+</span></h3>
					<p>Recruiters</p>
				</div>
				<div class="numBox text-center">
					<h3><span class="odometer" data-count="56">00</span><span class="target">+</span></h3>
					<p>MoUs with Industry</p>
				</div>
				<div class="numBox text-center">
					<h3><span class="odometer" data-count="5115">00</span><span class="target"></span></h3>
					<p>Students</p>
				</div>
				<div class="numBox text-center">
					<h3><span class="odometer" data-count="7500">00</span><span class="target">+</span></h3>
					<p>Publications</p>
				</div>
				<div class="numBox text-center">
					<h3><span class="odometer" data-count="25000">00</span><span class="target">+</span></h3>
					<p>Alumni Across the Globe</p>
				</div>




			</div>

		</div>
	</div>
</section>

<div class="health-care-area section-pad-y achievements-section" style="background-color: rgba(162, 110, 41, 0);">
	<div class="container">
		<div class="section-title">
			<h2 class="">Achievements</h2>
		</div>
		<div class="health-care-slider owl-carousel owl-theme">


			<div class="single-health-care-card style-3">
				<div class="achievements-img">
					<img src="assets/images/achievements/1.jpg" alt="">
				</div>

				<div class="health-care-content">
					<a href="#" class="mt-4">
						<h3>Congratulations CBIT Students Win, Invesco Hack2Hire 2023</h3>
					</a>
					<a href="#" class="read-more-btn">Winner Price Money &#8377; 50,000</a>
					<p>Chaitanya Bharathi Institute of Technology, established in the Year 1979, esteemed as the premier
						engineering institute in the states of Telangana and Andhra Pradesh. was promoted by a Group of
						Visionaries from varied Professions of Engineering, Medical, Legal and Management, with an
						Objective to facilitate.</p>

					<a href="#" class="read-more-btn float-end">Read more<i class="flaticon-next"></i></a>
				</div>
			</div>

			<div class="single-health-care-card style-3">
				<div class="achievements-img">
					<img src="assets/images/achievements/2.jpg" alt="">
				</div>

				<div class="health-care-content">
					<a href="#" class="mt-4">
						<h3>Congratulations CBIT Students secure third place in Smart Manufacturing & Artificial
							Intelligence(SMAI) Hackathon.</h3>
					</a>
					<a href="#" class="read-more-btn">Winner Price Money &#8377; 50,000</a>
					<p>Chaitanya Bharathi Institute of Technology, established in the Year 1979, esteemed as the premier
						engineering institute in the states of Telangana and Andhra Pradesh. was promoted by a Group of
						Visionaries from varied Professions of Engineering, Medical.</p>

					<a href="#" class="read-more-btn float-end">Read more<i class="flaticon-next"></i></a>
				</div>
			</div>

			<div class="single-health-care-card style-3">
				<div class="achievements-img">
					<img src="assets/images/achievements/1.jpg" alt="">
				</div>

				<div class="health-care-content">
					<a href="#" class="mt-4">
						<h3>Congratulations CBIT Students Win, Invesco Hack2Hire 2023</h3>
					</a>
					<a href="#" class="read-more-btn">Winner Price Money &#8377; 50,000</a>
					<p>Chaitanya Bharathi Institute of Technology, established in the Year 1979, esteemed as the premier
						engineering institute in the states of Telangana and Andhra Pradesh. was promoted by a Group of
						Visionaries from varied Professions of Engineering, Medical, Legal and Management, with an
						Objective to facilitate.</p>

					<a href="#" class="read-more-btn float-end">Read more<i class="flaticon-next"></i></a>
				</div>
			</div>

			<div class="single-health-care-card style-3">
				<div class="achievements-img">
					<img src="assets/images/achievements/2.jpg" alt="">
				</div>

				<div class="health-care-content">
					<a href="#" class="mt-4">
						<h3>Congratulations CBIT Students secure third place in Smart Manufacturing & Artificial
							Intelligence(SMAI) Hackathon.</h3>
					</a>
					<a href="#" class="read-more-btn">Winner Price Money &#8377; 50,000</a>
					<p>Chaitanya Bharathi Institute of Technology, established in the Year 1979, esteemed as the premier
						engineering institute in the states of Telangana and Andhra Pradesh. was promoted by a Group of
						Visionaries from varied Professions of Engineering, Medical.</p>

					<a href="#" class="read-more-btn float-end">Read more<i class="flaticon-next"></i></a>
				</div>
			</div>





		</div>


		<div class="row align-items-center justify-content-end">
			<div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-6">
				<div class="mb-lg-0 mb-md-0 mb-2 text-end">
					<a href="#" class="custom-btn-12 green">Viewl All <i class="fa-solid fa-chevron-right"></i></a>
				</div>

			</div>

		</div>

	</div>
</div>


<div class="campus-information-area placements-section section-pad-y">
	<div class="container">
		<div class="row align-items-center justify-content-center">
			<div class="col-12">
				<div class="campus-content mb-0">
					<div class="section-title">
						<h2 class="text-white">2021-22 Placement Highlights</h2>
					</div>

					<div class="counter">
						<div class="row">
							<div class="col-xxl-3 col-xl-3 col-lg-3 col-md-3 col-6">
								<div class="counter-card text-white">
									<img src="assets/images/icons/companies.png" class="place-icon" alt="">
									<h1>
										<span class="odometer" data-count="140">00</span><span class="target">+</span>
									</h1>
									<p class="text-white text-center">Companies</p>
								</div>
							</div>
							<div class="col-xxl-3 col-xl-3 col-lg-3 col-md-3 col-6">
								<div class="counter-card text-white">
									<img src="assets/images/icons/placements-offer.png" class="place-icon" alt="">
									<h1>
										<span class="odometer" data-count="1736">00</span>
									</h1>
									<p class="text-white text-center">Placement Offers</p>
								</div>
							</div>
							<div class="col-xxl-3 col-xl-3 col-lg-3 col-md-3 col-6">
								<div class="counter-card text-white">
									<img src="assets/images/icons/highest-package.png" class="place-icon" alt="">
									<h1>
										<span class="odometer" data-count="54">00</span><span class="target">L</span>
									</h1>
									<p class="text-white text-center">Highest package</p>
								</div>
							</div>
							<div class="col-xxl-3 col-xl-3 col-lg-3 col-md-3 col-6">
								<div class="counter-card text-white">
									<img src="assets/images/icons/of-placements.png" class="place-icon" alt="">
									<h1>
										<span class="odometer" data-count="83.68">00</span><span class="target">%</span>
									</h1>
									<p class="text-white text-center">Of Placements</p>
								</div>
							</div>



						</div>
					</div>

					<?php 
					$sqrybrnd_mst1 = "SELECT brndm_id,brndm_name,brndm_img,brndm_sts, brndm_prty from brnd_mst where brndm_sts='a' and brndm_img!='' order by brndm_prty  desc";
			$srsbrnd_mst = mysqli_query($conn, $sqrybrnd_mst1) or die(mysqli_error());
			$serchresbrnd	= mysqli_num_rows($srsbrnd_mst);
			if ($serchresbrnd > 0)
			 { 
				?>
					<div class="hire-company mt-xxl-5 mt-lx-4 mt-lg-3 mt-md-2 mt-2">
						<div class="events-area">
							<div class="container">
								<div class="hireCompany-slider mb-20 owl-carousel owl-theme">
									<?php
								while ($srowbrnd_mst = mysqli_fetch_assoc($srsbrnd_mst)) 
								{
							$brnd_id =	$srowbrnd_mst['brndm_id'];
							$brnd_name =	$srowbrnd_mst['brndm_name'];
							$imgnm =	$srowbrnd_mst['brndm_img'];
							$imgpath = $gusrbrnd_upldpth . $imgnm;
							if (($imgnm != "") && file_exists($imgpath)) {
								$brndimgpth = $rtpth . $imgpath;
							} else {

								$brndimgpth   = 'n.a';
							
							}

						?>
									<div class="single-events-card style2">
										<div class="events-image"><img src="<?php echo $brndimgpth ;?>" class="w-100" alt="Image"></div>
									</div>
									<?php 
							 }
			 ?>		
								</div>
							</div>
						</div>
					</div>
				<?php 
			 }
			 ?>
				</div>
			</div>


		</div>
	</div>
</div>







<!-- <section>
        <div class="additional-information qk-links-home">
            <div class="list">
                <ul class="row gx-0">
                    <li class="col-auto col-12"><a href="#"><i class="fa-solid fa-arrow-right-from-bracket"></i> Code of
                            Conduct</a>
                    </li>
                    <li class="col-auto col-12"><a href="#"><i class="fa-solid fa-arrow-right-from-bracket"></i> Time
                            Tables</a>
                    </li>
                    <li class="col-auto col-12"><a href="#"><i class="fa-solid fa-arrow-right-from-bracket"></i>
                            Examinations</a>
                    </li>
                    <li class="col-auto col-12"><a href="#"><i class="fa-solid fa-arrow-right-from-bracket"></i>
                            Results</a></li>
                    <li class="col-auto col-12"><a href="#"><i class="fa-solid fa-arrow-right-from-bracket"></i>
                            Internship</a></li>

                </ul>
            </div>
        </div>
    </section> -->






<div class="health-care-area section-pad-y facilities-holder">
	<div class="container">
		<div class="facilities-wrapper">
			<div class="section-title">
				<h2>Facilities</h2>
			</div>

			<div class="facilities-slider mb-20 owl-carousel owl-theme">

				<div class="item">
					<div class="single-health-care-card style1">
						<div class="img">
							<a href="#"><img src="assets/images/facilities/1.jpg" alt="Image"></a>
						</div>
						<div class="health-care-content">
							<a href="#">
								<h3>Library</h3>
							</a>
						</div>
					</div>
				</div>

				<div class="item">
					<div class="single-health-care-card style1">
						<div class="img">
							<a href="#"><img src="assets/images/facilities/2.jpg" alt="Image"></a>
						</div>
						<div class="health-care-content">
							<a href="#">
								<h3>Indoor Games</h3>
							</a>
						</div>
					</div>
				</div>
				<div class="item">
					<div class="single-health-care-card style1">
						<div class="img">
							<a href="#"><img src="assets/images/facilities/3.jpg" alt="Image"></a>
						</div>
						<div class="health-care-content">
							<a href="#">
								<h3>Digital Room</h3>
							</a>
						</div>
					</div>
				</div>
				<div class="item">
					<div class="single-health-care-card style1">
						<div class="img">
							<a href="#"><img src="assets/images/facilities/4.jpg" alt="Image"></a>
						</div>
						<div class="health-care-content">
							<a href="#">
								<h3>Gym</h3>
							</a>
						</div>
					</div>
				</div>



			</div>

			<div class="single-podcasts-card mt-3 mb-0">
				<div class="row align-items-center justify-content-end">
					<div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-6">
						<div class="mb-lg-0 mb-md-0 mb-2 text-end">
							<a href="#" class="custom-btn-12 green">View All <i class="fa-solid fa-chevron-right"></i></a>
						</div>

					</div>

				</div>
			</div>

		</div>




	</div>
</div>


<!-- <section>
        <div class="additional-information qk-links-home">
            <div class="list">
                <ul class="row gx-0">
                    <li class="col-auto col-12"><a href="#"><i class="fa-solid fa-arrow-right-from-bracket"></i> Explore
                            CBIT</a>
                    </li>
                    <li class="col-auto col-12"><a href="#"><i class="fa-solid fa-arrow-right-from-bracket"></i> Order a
                            Prospectus</a>
                    </li>
                    <li class="col-auto col-12"><a href="#"><i class="fa-solid fa-arrow-right-from-bracket"></i>
                            Book An Open Day</a>
                    </li>
                    <li class="col-auto col-12"><a href="#"><i class="fa-solid fa-arrow-right-from-bracket"></i>
                            Apply Now</a></li>
                </ul>
            </div>
        </div>
    </section> -->



<div class="courses-area section-pad-y  alumni-holder">
	<div class="container">
		<div class="section-title">
			<h2>Distinguished Alumni</h2>
		</div>


		<div class="courses-slider mb-20 owl-carousel owl-theme">
			<div class="single-courses-card style2">
				<div class="courses-img">
					<a href="#"><img src="assets/images/alumni/ravi.jpg" alt="Image"></a>
				</div>
				<div class="courses-content">
					<a href="#">
						<h3><i class="fa-regular fa-user"></i> Mr Ravi Varma</h3>
						<p>BE 2010, EEE</p>
						<h2>Actor</h2>
					</a>
					<a href="#" data-bs-toggle="modal" data-bs-target="#alumni-1PopupModal" class="read-more-btn pull-right">Read more<i class="flaticon-next"></i></a>
				</div>
			</div>

			<div class="single-courses-card style2">
				<div class="courses-img">
					<a href="#"><img src="assets/images/alumni/sekhar.jpg" alt="Image"></a>
				</div>
				<div class="courses-content">
					<a href="#">
						<h3><i class="fa-regular fa-user"></i> Mr. Sekhar Kammula</h3>
						<p>BE 2005, Civil</p>
						<h2>Film Director</h2>
					</a>
					<a href="#" data-bs-toggle="modal" data-bs-target="#alumni-2PopupModal" class="read-more-btn pull-right">Read more<i class="flaticon-next"></i></a>
				</div>
			</div>

			<div class="single-courses-card style2">
				<div class="courses-img">
					<a href="#"><img src="assets/images/alumni/komatireddy.jpg" alt="Image"></a>
				</div>
				<div class="courses-content">
					<a href="#">
						<h3><i class="fa-regular fa-user"></i> Mr. Komatireddy Venkat Reddy</h3>
						<p>BE 1986, CSE</p>
						<h2>Member of Parliament</h2>
					</a>
					<a href="#" data-bs-toggle="modal" data-bs-target="#alumni-3PopupModal" class="read-more-btn pull-right">Read more<i class="flaticon-next"></i></a>
				</div>
			</div>

			<div class="single-courses-card style2">
				<div class="courses-img">
					<a href="#"><img src="assets/images/alumni/ravi.jpg" alt="Image"></a>
				</div>
				<div class="courses-content">
					<a href="#">
						<h3><i class="fa-regular fa-user"></i> Mr Ravi Varma</h3>
						<p>BE 2010, EEE</p>
						<h2>Actor</h2>
					</a>
					<a href="#" data-bs-toggle="modal" data-bs-target="#alumni-1PopupModal" class="read-more-btn pull-right">Read more<i class="flaticon-next"></i></a>
				</div>
			</div>

			<div class="single-courses-card style2">
				<div class="courses-img">
					<a href="#"><img src="assets/images/alumni/sekhar.jpg" alt="Image"></a>
				</div>
				<div class="courses-content">
					<a href="#">
						<h3><i class="fa-regular fa-user"></i> Mr. Sekhar Kammula</h3>
						<p>BE 2005, Civil</p>
						<h2>Film Director</h2>
					</a>
					<a href="#" data-bs-toggle="modal" data-bs-target="#alumni-2PopupModal" class="read-more-btn pull-right">Read more<i class="flaticon-next"></i></a>
				</div>
			</div>

			<div class="single-courses-card style2">
				<div class="courses-img">
					<a href="#"><img src="assets/images/alumni/komatireddy.jpg" alt="Image"></a>
				</div>
				<div class="courses-content">
					<a href="#">
						<h3><i class="fa-regular fa-user"></i> Mr. Komatireddy Venkat Reddy</h3>
						<p>BE 1986, CSE</p>
						<h2>Member of Parliament</h2>
					</a>
					<a href="#" data-bs-toggle="modal" data-bs-target="#alumni-3PopupModal" class="read-more-btn pull-right">Read more<i class="flaticon-next"></i></a>
				</div>
			</div>





		</div>

		<div class="single-podcasts-card mt-lg-3 mt-md-3 mt-5 mb-0">
			<div class="row align-items-center justify-content-end">
				<div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-6">
					<div class="mb-lg-0 mb-md-0 mb-2 text-end">
						<a href="https://alumni.cbit.ac.in/" target="_blank" class="custom-btn-12 green">Alumni Portal <i class="fa-solid fa-chevron-right"></i></a>
					</div>

				</div>

			</div>
		</div>

	</div>
</div>


<div class="section-pad-y pb-0 pt-0">
	<div class="">
		<!-- <div class="section-title">
            <h2>Gallery</h2>
        </div> -->

		<div class="homeGallery">

			<div class="homeGallery-slider-1 owl-carousel owl-theme">
				<div class="item">
					<div class="gal-img-holder">
						<a href="gallery-category.php">
							<img src="assets/images/gallery/1.jpg" classw="w-100" alt="" title="Image category name">
							<p class="gal-cat-home">Event name</p>
						</a>
					</div>
				</div>
				<div class="item">
					<div class="gal-img-holder">
						<a href="gallery-category.php">
							<img src="assets/images/gallery/2.jpg" classw="w-100" alt="" title="Image category name">
							<p class="gal-cat-home">Event name</p>
						</a>
					</div>
				</div>
				<div class="item">
					<div class="gal-img-holder">
						<a href="gallery-category.php">
							<img src="assets/images/gallery/3.jpg" classw="w-100" alt="" title="Image category name">
							<p class="gal-cat-home">Event name</p>
						</a>
					</div>
				</div>
				<div class="item">
					<div class="gal-img-holder">
						<a href="gallery-category.php">
							<img src="assets/images/gallery/4.jpg" classw="w-100" alt="" title="Image category name">
							<p class="gal-cat-home">Event name</p>
						</a>
					</div>
				</div>
				<div class="item">
					<div class="gal-img-holder">
						<a href="gallery-category.php">
							<img src="assets/images/gallery/5.jpg" classw="w-100" alt="" title="Image category name">
							<p class="gal-cat-home">Event name</p>
						</a>
					</div>
				</div>
				<div class="item">
					<div class="gal-img-holder">
						<a href="gallery-category.php">
							<img src="assets/images/gallery/6.jpg" classw="w-100" alt="" title="Image category name">
							<p class="gal-cat-home">Event name</p>
						</a>
					</div>
				</div>

			</div>

			<div class="homeGallery-slider-2 owl-carousel owl-theme">
				<div class="item">
					<div class="gal-img-holder">
						<a href="gallery-category.php">
							<img src="assets/images/gallery/7.jpg" classw="w-100" alt="" title="Image category name">
							<p class="gal-cat-home">Event name</p>
						</a>
					</div>
				</div>
				<div class="item">
					<div class="gal-img-holder">
						<a href="gallery-category.php">
							<img src="assets/images/gallery/8.jpg" classw="w-100" alt="" title="Image category name">
							<p class="gal-cat-home">Event name</p>
						</a>
					</div>
				</div>
				<div class="item">
					<div class="gal-img-holder">
						<a href="gallery-category.php">
							<img src="assets/images/gallery/9.jpg" classw="w-100" alt="" title="Image category name">
							<p class="gal-cat-home">Event name</p>
						</a>
					</div>
				</div>
				<div class="item">
					<div class="gal-img-holder">
						<a href="gallery-category.php">
							<img src="assets/images/gallery/10.jpg" classw="w-100" alt="" title="Image category name">
							<p class="gal-cat-home">Event name</p>
						</a>
					</div>
				</div>
				<div class="item">
					<div class="gal-img-holder">
						<a href="gallery-category.php">
							<img src="assets/images/gallery/11.jpg" classw="w-100" alt="" title="Image category name">
							<p class="gal-cat-home">Event name</p>
						</a>
					</div>
				</div>
				<div class="item">
					<div class="gal-img-holder">
						<a href="gallery-category.php">
							<img src="assets/images/gallery/12.jpg" classw="w-100" alt="" title="Image category name">
							<p class="gal-cat-home">Event name</p>
						</a>
					</div>
				</div>

			</div>

			<div class="gal-center-overlay">
				<div class="cont-holder">
					<h2 class="text-white text-center">Gallery</h2>
					<p class="txt2">Follow Us On</p>
					<div class="copyright p-0">

						<div class="social-content d-flex justify-content-center m-0">
							<ul>
								<li>
									<a class="text-white" href="https://www.facebook.com/CBIThyderabad/" target="_blank"><i class="ri-facebook-fill"></i></a>
								</li>
								<li>
									<a class="text-white" href="https://www.instagram.com/cbithyderabad/" target="_blank"><i class="ri-instagram-line"></i></a>
								</li>
								<li>
									<a class="text-white" href="https://twitter.com/CBIThyd" target="_blank"><i class="ri-twitter-fill"></i></a>
								</li>

								<li>
									<a class="text-white" href="https://www.youtube.com/channel/UCUW8oQB8Fl6j-pg2g_sf1tw" target="_blank"><i class="ri-youtube-fill"></i></a>
								</li>
							</ul>
						</div>

					</div>
				</div>
			</div>



		</div>

	</div>

</div>




<div class="admisssion-area section-pad-y section-line-1 pt-0 pb-0">
	<div class="">
		<div class="admission-bg section-pad-y px-4">
			<div class="row align-items-center">
				<div class="col-lg-6 col-md-6">
					<div class="admission-left-content">
						<h2>Let’s build the future with innovation</h2>
						<p>Chaitanya Bharathi Institute of Technology, established in the Year 1979, esteemed as the
							premier
							engineering institute in the states of Telangana and Andhra Pradesh.
						</p>
						<a href="#" class="custom-btn-12 transt">Virtual Tour 360 degrees <i class="flaticon-next"></i></a>
					</div>
				</div>
				<div class="col-lg-6 col-md-6">
					<div class="admission-right-content">
						<ul>
							<li>
								<div class="icon">
									<a class="popup-youtube play-btn" href="https://www.youtube.com/watch?v=RptoHi3UxGA"><i class="ri-play-fill"></i></a>
								</div>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>

	</div>
</div>




<?php include_once('footer.php'); ?>

<div class="modal fade autoModal-home" id="autoPopupModal" tabindex="-1" aria-labelledby="autoPopupModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header text-center">
				<h5 class="modal-title w-100" id="autoPopupModalLabel">Admission Open for 2024-25</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
					&#x2715;
				</button>
			</div>
			<div class="modal-body">

				<div class="autoPopup-slider owl-carousel owl-theme">

					<div class="item">
						<a href="#">
							<img src="assets/images/popup/1.jpg" class="w-100 " alt="">
						</a>
						<!-- <div class="pop-Links mt-2">
                            <p class="mb-0">Admission open for 2023-24.</p>
                        </div>
                        <a href="#" class="read-more-btn pull-right">Read more<i class="flaticon-next"></i></a> -->
					</div>
					<div class="item">
						<a href="#">
							<img src="assets/images/popup/2.jpg" class="w-100 " alt="">
						</a>
						<!-- <div class="pop-Links mt-2">
                            <p>Chaitanya Bharathi Institute of Technology.</p>
                        </div>
                        <a href="#" class="read-more-btn pull-right">Read more<i class="flaticon-next"></i></a> -->
					</div>
					<div class="item">
						<a href="#">
							<img src="assets/images/popup/3.jpg" class="w-100 " alt="">
						</a>
					</div>
					<div class="item">
						<a href="#">
							<img src="assets/images/popup/4.jpg" class="w-100 " alt="">
						</a>
					</div>

				</div>



			</div>
			<!-- <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div> -->
		</div>
	</div