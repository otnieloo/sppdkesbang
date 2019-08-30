 <!-- ================================================== -->
        <!-- wrapper  -->
<div class="dashboard-wrapper">
    <div class="container-fluid  dashboard-content">
        <!-- =============================================== -->
        <!-- pageheader -->
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="page-header">
                    <h2 class="pageheader-title">Laporan Per Kegiatan</h2>
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
                                        <th>Kegiatan</th>
                                        <th>Mata Anggaran</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
<!-- menampilkan data pegawai -->
<?php 
$no = 1;
foreach($anggaran as $a) {
?>
    <tr>
        <td style="max-width: 50px;"><?php echo $no; ?></td>
        <td><?php echo $a['uraian']; ?></td>
        <td><?php echo $a['kode_anggaran']; ?></td>
       
        <td style="width: 120px;">
                <a href="<?php echo base_url("Laporan/genLaporan/{$a['id_anggaran']}") ?>">Lihat Laporan</i> </a>
        </td>        
    </tr>
<?php $no++;} ?>
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
foreach($anggaran as $a) {
?>
<div class="modal fade" id="deleteModal<?php echo $a['kode_anggaran'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Apakah Anda Yakin Hapus Data Surat Perintah Tugas <?php echo $a['kode_anggaran'];?> </h5>
                        </a>
            </div>
            <div class="modal-body">
                <div style="text-align: center; padding: 50px;">
                    <i class="fas fa-trash-alt" style="font-size: 30px;" data-test='puffIn'></i>
                </div>
                <a class="btn btn-danger mx-1" href="<?=base_url()."SuratPerintah/hapus/".$a['kode_anggaran'];?>"> Ya, Hapus</a>

                 <a href="#"  style="float: right;" class="btn btn-secondary" data-dismiss="modal">Batalkan</a>
            </div>
        </div>
    </div>
</div>
<?php } ?>
<!--End Modal Delete -->
<!-- ================================================= -->