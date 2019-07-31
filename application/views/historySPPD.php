 <!-- ======================================================== -->
        <!-- wrapper  -->
<div class="dashboard-wrapper">
    <div class="container-fluid  dashboard-content">
        <!-- ==================================================== -->
        <!-- pageheader -->
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="page-header">
                    <h2 class="pageheader-title">History Surat Pelaksanaan Perjalanan Dinas</h2>
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
                            <table class="table table-striped table-bordered first">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>No. SPPD</th>
                                        <th>Pegawai</th>
                                        <th>Tanggal Berangkat</th>
                                        <th>Tempat Tujuan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
<!-- menampilkan data pegawai -->
<?php 
$no = 1;
foreach($sppd as $d) {
?>
    <tr>
        <td style="max-width: 50px;"><?php echo $no; ?></td>
        <td><a href="<?php echo base_url().'SPPD/cetakPdf/'.$d['id_sppd']; ?>" style="color: blue;"><?php echo $d['no_sppd']; ?>
            </a></td>
        <td><?php echo $d['id_pegawai']; ?></td>
        <td><?php echo $d['tgl_berangkat']; ?></td>
        <td><?php echo nl2br(htmlspecialchars_decode($d['tempat_tujuan'])); ?></td>
       
        <td style="width: 70px;">
                 <a class="btn btn-danger" data-toggle="modal" data-target="#deleteModal<?php echo $d['id_sppd'];?>" data-popup="tooltip"> <i class="fa fa-times" style="color: white;">  </i> </a>
        </td>        
    </tr>
<?php $no++;} ?>
<!-- End menampilkan data pegawai -->
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>No.</th>
                                        <th>No. SPPD</th>
                                        <th>Pegawai</th>
                                        <th>Tanggal Berangkat</th>
                                        <th>Tempat Tujuan</th>
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

<!-- ================================================= -->
<!-- Modal Delete -->
<?php 
$no = 1;
foreach($sppd as $d) {
?>
<div class="modal fade" id="deleteModal<?php echo $d['id_sppd'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Apakah Anda Yakin Hapus Data SPPD Nomer <?php echo $d['no_sppd'];?> </h5>
                        </a>
            </div>
            <div class="modal-body">
                <div style="text-align: center; padding: 50px;">
                    <i class="fas fa-trash-alt" style="font-size: 30px;" data-test='puffIn'></i>
                </div>
                <a class="btn btn-danger mx-1" href="<?=base_url()."SPPD/hapus/".$d['id_sppd'];?>"> Ya, Hapus</a>

                 <a href="#"  style="float: right;" class="btn btn-secondary" data-dismiss="modal">Batalkan</a>
            </div>
        </div>
    </div>
</div>
<?php } ?>

<!--End Modal Delete -->
<!-- ================================================= -->