 <!-- ================================================== -->
        <!-- wrapper  -->
<div class="dashboard-wrapper">
    <div class="container-fluid  dashboard-content">
        <!-- =============================================== -->
        <!-- pageheader -->
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="page-header">
                    <h2 class="pageheader-title">History Laporan Hasil Perjalanan Dinas</h2>
                </div>
            </div>
        </div>
        <!-- end pageheader -->
        <!-- ============================================ -->
        <div class="row">
            <!-- ======================================== -->
            <!-- basic table  -->
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered first" id="dataTable" >
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nomer Surat</th>
                                        <th>Dasar Surat</th>
                                        <th>Untuk</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
<!-- menampilkan data pegawai -->
<?php 
$no = 1;
foreach($spt as $d) {
?>
    <tr>
        <td style="max-width: 50px;"><?php echo $no; ?></td>
        <td><?php echo $d['no_spt']; ?></td>
        <td><?php echo $d['dasar']; ?> Pada Tanggal <?php echo $d['tanggal_surat']; ?></td>
        <td><?php echo nl2br(htmlspecialchars_decode($d['untuk'])); ?></td>
       
        <td style="width: 120px;">
                <a class="btn btn-danger" data-toggle="modal" data-target="#deleteModal<?php echo $d['id_spt'];?>" data-popup="tooltip"> <i class="fa fa-times" style="color: white;">  </i> </a>
                <a class="btn btn-secondary" href="<?php echo base_url().'SuratPerintah/genSPT/'.$d['id_spt']; ?>" > <i class="fa fa-download" style="color: white;">  </i> </a>
        </td>        
    </tr>
<?php $no++;} ?>
<!-- End menampilkan data pegawai -->
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nomer Surat</th>
                                        <th>Dasar Surat</th>
                                        <th>Untuk</th>
                                        <th>Aksi</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end basic table  -->
            <!-- ======================================= -->
        </div>
    </div>
</div>

<!-- ================================================= -->
<!-- Modal Delete -->
<?php 
$no = 1;
foreach($spt as $d) {
?>
<div class="modal fade" id="deleteModal<?php echo $d['id_spt'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Apakah Anda Yakin Hapus Data Surat Perintah Tugas <?php echo $d['no_spt'];?> </h5>
                        </a>
            </div>
            <div class="modal-body">
                <div style="text-align: center; padding: 50px;">
                    <i class="fas fa-trash-alt" style="font-size: 30px;" data-test='puffIn'></i>
                </div>
                <a class="btn btn-danger mx-1" href="<?=base_url()."SuratPerintah/hapus/".$d['id_spt'];?>"> Ya, Hapus</a>

                 <a href="#"  style="float: right;" class="btn btn-secondary" data-dismiss="modal">Batalkan</a>
            </div>
        </div>
    </div>
</div>
<?php } ?>
<!--End Modal Delete -->
<!-- ================================================= -->