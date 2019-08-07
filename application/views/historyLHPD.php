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
foreach($ringkasan as $d) {
?>
    <tr>
        <td style="max-width: 50px;"><?php echo $no; ?></td>
        <td><?php ?></td>
        <td><?php  ?></td>
        <td><?php  ?></td>
        <td><?php echo nl2br(htmlspecialchars_decode($d['ringkasan'])); ?></td>
       
        <td style="width: 70px;">
            <a class="btn btn-danger mx-1" href="<?=base_url()."SuratHasil/hapus/".$d['id'];?>"><i class="fa fa-times" onclick="confirm('Apakah anda yakin?')"> </i></a>
            <a class="btn btn-secondary" href="<?php echo base_url().'SuratHasil/genLap/'.$d['id_spt']; ?>" > <i class="fa fa-download" style="color: white;">  </i> </a>
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