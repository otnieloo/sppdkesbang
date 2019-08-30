<!-- ======================================== -->
<!-- wrapper  -->
<div class="dashboard-wrapper">
    <div class="influence-profile">
        <div class="container-fluid dashboard-content ">
            <!-- ========================================= -->
            <!-- pageheader -->
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="page-header">
                        <h3 class="mb-2">Dashboard</h3>
                    </div>
                </div>
            </div>
            <!-- end pageheader -->
            <!-- ========================================= -->
            <!-- ========================================= -->
            <!-- content -->
            <div class="row">
                <!-- ==================================== -->
                <!-- profile -->
                <div class="col-xl-5 col-lg-5 col-md-7 col-sm-12 col-12">

                    <div class="card">
                        <div class="card-body">
                            <div class="user-avatar text-center d-block">
                                <img src="<?php echo base_url(). 'assets/images/logo-kesbang2.png'; ?>" alt="User Avatar" class="rounded-circle user-avatar-xxl">
                            </div>
                            <div class="text-center">
                                <h2 class="font-24 mb-0">Kantor Kesatuan Bangsa dan Perlindungan Masyarakat </h2>
                                <p> Kabupaten Tasikmalaya</p>
                            </div>
                        </div>
                        <div class="card-body border-top">
                            <h3 class="font-16">Contact Information</h3>
                            <div class="">
                                <ul class="list-unstyled mb-0">
                                    <li class="mb-2"><i class="fas fa-fw fa-envelope instagram-color mr-2"></i>email@kesbang.com</li>
                                    <li class="mb-0"><i class="fas fa-fw fa-phone mr-2 twitter-color"></i>0265-336438 </li>
                                    <li class="mb-0"><i class="fas fa-fw fa-map-marker-alt mr-2 facebook-color"></i>Jl. Pemuda No. 1 Tasikmalaya </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end profile -->
                <!-- ====================================== -->
                <!-- ====================================== -->
                <!-- KONTEN -->
                <div class="col-xl-6 col-lg-6 col-md-5 col-sm-12 col-12">
                    <div class="row">
                    <!-- =================================== -->
                    <!-- four widgets   -->
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-inline-block">
                                    <h5 class="text-muted">Total Pegawai</h5>
                                    <h2 class="mb-0"> <?php echo $t_pegawai; ?></h2>
                                </div>
                            <div class="float-right icon-circle-medium  icon-box-lg  bg-primary-light mt-1">
                            <i class="fa fa-user fa-fw fa-sm text-primary"></i>
                            </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-inline-block">
                                    <h5 class="text-muted">Perjalanan Dinas</h5>
                                    <h2 class="mb-0"> <?php echo $t_sppd; ?></h2>
                                </div>
                            <div class="float-right icon-circle-medium  icon-box-lg  bg-info-light mt-1">
                            <i class="fa fa-car fa-fw fa-sm text-info"></i>
                            </div>
                            </div>
                        </div>
                    </div>
                    <!-- end four widget  -->
                    <!-- ==================================== -->
                    </div>
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-6 col-sm-12 col-12">
                        <div class="card">
                            <h5 class="card-header">Top Followers by Locations </h5>
                                <div class="card-body">
                                <canvas id="chartjs_bar_horizontal"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end KONTEN -->
                <!-- ===================================== -->
            </div>
            <div class="row">
                            <!-- ============================================================== -->
                            <!-- ARSIP SURAT   -->
                            <div class="col-lg-12">
                                <div class="section-block">
                                    <h3 class="section-title">ARSIP SURAT</h3>
                                </div>
                                <div class="card">
                                    <div class="campaign-table table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr class="border-0">
                                                    <th class="border-0">No</th>
                                                    <th class="border-0">SPPD</th>
                                                    <th class="border-0">Surat Perintah</th>
                                                    <th class="border-0">Laporan Hasil</th>
                                                    <th class="border-0">Tanggal SPPD</th>
                                                    <th class="border-0">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                                $no=1; 
                                                foreach($sppd as $s){ 
                                            ?>
                                                <tr>
                                                    <td><?= $no?></td>
                                                    <td><a href="<?php echo base_url("SPPD/cetakPdf/{$s['id_sppd']}") ?>"><?= $s['no_sppd'];?></a></td>
                                                    <?php  
                                                        $spt = $m_sppd->mread_spt($s['id_sppd']);  
                                                    ?>
                                                    <td>
                                                    	<?php 
                                                    		if(isset($spt[0]['no_spt'])){
                                                    			echo $spt[0]['no_spt'];
                                                    		}else{?>
                                                    			<a href="<?php echo base_url("SuratPerintah/index/{$s['id_sppd']}") ?>">Buat</a>
                                                    		<?php }?>
                                                    </td>
                                                    <?php  
                                                        $laporan = $m_sppd->mread_laporan($s['id_sppd']);  
                                                    ?>
                                                    <td>
                                                    	<?php 
                                                    		if(isset($laporan[0]['id_laporan'])){
                                                    			echo $laporan[0]['id_laporan'];
                                                    		}else{?>
                                                    			<a href="<?php echo base_url("SuratHasil/index/{$s['id_sppd']}"); ?>">Buat</a>
                                                    		<?php } ?>
                                                    </td>
                                                    <td><?= $s['tgl_berangkat']; ?></td>
                                                    <td>
                                                    </td>
                                                </tr>
                                            <?php $no++;}?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- end ARSIP SURAT   -->
                            <!-- ============================================================== -->
                    </div>
        </div>
    </div>
    <!-- end content -->
    <!-- ==================================== -->
    <div class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            Copyright © 2018 Concept. All rights reserved. Dashboard by <a href="https://colorlib.com/wp/">Colorlib</a>.
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="text-md-right footer-links d-none d-sm-block">
                            </div>
                        </div>	
                    </div>
                </div>
    </div>
    <!-- end footer -->
     <!-- =================================== -->
</div>
<!-- end wrapper -->
<!-- ======================================== -->