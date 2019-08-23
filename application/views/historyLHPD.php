 <!-- ======================================================== -->
        <!-- wrapper  -->
<div class="dashboard-wrapper">
    <div class="container-fluid  dashboard-content">
        <!-- ==================================================== -->
        <!-- pageheader -->
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="page-header">
                    <h2 class="pageheader-title">History Laporan Hasil Perjalanan Dinas</h2>
                </div>
            </div>
        </div>
        <!-- end pageheader -->
        <!-- ==================================================== -->
        <div class="row">
            <!-- ================================================ -->
            <!-- basic table  -->
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered first" id="dataTable" >
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Petugas</th>
                                        <th>Tujuan</th>
                                        <th>Berangkat</th>
                                        <th>Ringkasan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
<!-- menampilkan data pegawai -->
<?php 
$no = 1;
foreach($laporan as $d) {
?>
    <tr>
        <td><?php echo $no; ?></td>
        <?php 
            $sppd = $m_sppd->getSppd($d['id_sppd']); 
            $petugas = $m_sppd->read_pegawai($sppd[0]['id_pegawai']);
        ?>
        <td><?php echo  $petugas[0]['nama'];?></td>
        <td><?php echo $sppd[0]['tempat_tujuan']; ?></td>
        <td><?php echo $sppd[0]['tempat_berangkat']; ?></td>
        <td><?php echo $d['hasil'];?></td>
       
        <td style="width: 70px;">
            <a class="btn btn-danger mx-1" href="<?=base_url()."SuratHasil/hapus/".$d['id_laporan'];?>"><i class="fa fa-times" onclick="confirm('Apakah anda yakin?')"> </i></a>
            <a class="btn btn-secondary" href="<?php echo base_url().'SuratHasil/genLap/'.$d['id_laporan']; ?>" > <i class="fa fa-download" style="color: white;">  </i> </a>
        </td>        
    </tr>
<?php $no++;} ?>
<!-- End menampilkan data pegawai -->
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>No.</th>
                                        <th>Petugas</th>
                                        <th>Tujuan</th>
                                        <th>Berangkat</th>
                                        <th>Ringkasan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end basic table  -->
            <!-- ================================================= -->
        </div>
    </div>
</div>