 <!-- ======================================================== -->
        <!-- wrapper  -->
<div class="dashboard-wrapper">
    <div class="container-fluid  dashboard-content">
        <!-- ==================================================== -->
        <!-- pageheader -->
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="page-header">
                    <h2 class="pageheader-title">Data Pegawai</h2>
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
<!-- Button Tambah data  -->
<a href="#" class="btn btn-secondary mb-2" style="float: right;" data-toggle="modal" data-target="#exampleModal"> <i class="fa fa-plus"> </i> Tambah Data</a>
<!-- End Button Tambah data  -->
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered first" id="dataTable" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th style="width: 10px;">No.</th>
                                        <th>Nama</th>
                                        <th>NIP</th>
                                        <th>Pangkat</th>
                                        <th>Golongan</th>
                                        <th>Jabatan</th>
                                        <th>Unit Kerja</th>
                                        <th style="width: 70px;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
<!-- menampilkan data pegawai -->
<?php 
$no = 1;
foreach($pegawai as $d) {
?>
    <tr>
        <td><?php echo $no; ?></td>
        <td><?php echo $d['nama']; ?></td>
        <td><?php echo $d['id_pegawai']; ?></td>
        <td><?php echo $d['pangkat']; ?></td>
        <td><?php echo $d['golongan']; ?></td>
        <td style="max-width: 150px;"><?php echo $d['jabatan']; ?></td>
        <td><?php echo $d['unit_kerja']; ?></td>
        <td style="width: 130px;">
<a class="btn btn-warning" data-toggle="modal" data-target="#exampleModal2<?php echo $d['id_pegawai'];?>" data-popup="tooltip"> <i class="fa fa-edit" style="color: white;" > </i> </a>

            <a class="btn btn-danger" data-toggle="modal" data-target="#deleteModal<?php echo $d['id_pegawai'];?>" data-popup="tooltip"> <i class="fa fa-times" style="color: white;">  </i> </a>
        </td>        
    </tr>
<?php $no++;} ?>
<!-- End menampilkan data pegawai -->
                                </tbody>
                             
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end basic table  -->
            <!-- ================================================= -->
        </div>
    </div>
</div>>
        <!-- End wrapper  -->
 <!-- ======================================================== -->

<!-- ================================================= -->
<!-- Modal Delete -->
<?php 
$no = 1;
foreach($pegawai as $d) {
?>
<div class="modal fade" id="deleteModal<?php echo $d['id_pegawai'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Apakah Anda Yakin Hapus Data Pegawai <?php echo $d['nama'];?> </h5>
                        </a>
            </div>
            <div class="modal-body">
                <div style="text-align: center; padding: 50px;">
                    <i class="fas fa-trash-alt" style="font-size: 30px;" data-test='puffIn'></i>
                </div>
                <a class="btn btn-danger mx-1" href="<?=base_url()."DataPegawai/hapus/".$d['id_pegawai'];?>"> Ya, Hapus</a>

                 <a href="#"  style="float: right;" class="btn btn-secondary" data-dismiss="modal">Batalkan</a>
            </div>
        </div>
    </div>
</div>
<?php } ?>

<!--End Modal Delete -->
<!-- ================================================= -->



<!-- ================================================= -->
<!-- Modal Tambah Data -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Input Data Pegawai</h5>
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </a>
            </div>
            <div class="modal-body">
                <!-- Form Tambah Data Pegawai -->
                <form id="form" data-parsley-validate="" novalidate="" action="<?php echo base_url(). 'DataPegawai/tambah'; ?>" method="post">
                    <div class="form-group row">
                        <label for="inputEmail2" class="col-3 col-lg-2 col-form-label text-right">Nama</label>
                        <div class="col-9 col-lg-10">

<input name="nama" type="text" required="" class="form-control">

                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword2" class="col-3 col-lg-2 col-form-label text-right">NIP</label>
                        <div class="col-9 col-lg-10">
<input name="id_pegawai" type="text" required="" class="filterme form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                         <label for="inputWebSite" class="col-3 col-lg-2 col-form-label text-right">Pangkat</label>
                        <div class="col-9 col-lg-10">
<input name="pangkat" type="text" required="" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                         <label for="inputWebSite" class="col-3 col-lg-2 col-form-label text-right">Golongan</label>
                        <div class="col-9 col-lg-10">
<input name="golongan" type="text" required="" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                         <label for="inputWebSite" class="col-3 col-lg-2 col-form-label text-right">Jabatan</label>
                        <div class="col-9 col-lg-10">
<input name="jabatan" type="text" required="" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                         <label for="inputWebSite" class="col-3 col-lg-2 col-form-label text-right">Unit Kerja</label>
                        <div class="col-9 col-lg-10">
<input name="unit_kerja" type="text"  class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="#" class="btn btn-danger" data-dismiss="modal">Close</a>
                        <input type="submit" name="Submit" value="Submit" class="btn btn-primary" >
                    </div>
                                       
                </form>
                <!-- End Form Tambah Data Pegawai -->   
            </div>
        </div>
    </div>
</div>
<!--End Modal Tambah Data -->
<!-- ================================================= -->


<!-- ================================================= -->
<!-- Modal Edit Data -->
<?php 
foreach ($pegawai as $d) {
    # code...
?>
<div class="modal fade" id="exampleModal2<?php echo $d['id_pegawai'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Data Pegawai</h5>
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </a>
            </div>
            <div class="modal-body">
                <div class="dash">
                     <!-- Form Edit Data Pegawai -->
                <form id="form" data-parsley-validate="" novalidate="" action="<?php echo base_url(). 'DataPegawai/update/'.$d['id_pegawai']; ?>" method="post"  enctype="multipart/form-data" >
                    <div class="form-group row">
                        <label for="inputEmail2" class="col-3 col-lg-2 col-form-label text-right">Nama</label>
                        <div class="col-9 col-lg-10">

<input name="nama" type="text" required="" class="form-control" value="<?php echo $d['nama']; ?>">

                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword2" class="col-3 col-lg-2 col-form-label text-right">NIP</label>
                        <div class="col-9 col-lg-10">
<input name="id_pegawai" type="text" required="" class="filterme form-control" value="<?php echo $d['id_pegawai']; ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                         <label for="inputWebSite" class="col-3 col-lg-2 col-form-label text-right">Pangkat</label>
                        <div class="col-9 col-lg-10">
<input name="pangkat" type="text" required="" class="form-control" value="<?php echo $d['pangkat']; ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                         <label for="inputWebSite" class="col-3 col-lg-2 col-form-label text-right">Golongan</label>
                        <div class="col-9 col-lg-10">
<input name="golongan" type="text" required="" class="form-control" value="<?php echo $d['golongan']; ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                         <label for="inputWebSite" class="col-3 col-lg-2 col-form-label text-right">Jabatan</label>
                        <div class="col-9 col-lg-10">
<input name="jabatan" type="text" required="" class="form-control" value="<?php echo $d['jabatan']; ?>">
                        </div>
                    </div>
                     <div class="form-group row">
                         <label for="inputWebSite" class="col-3 col-lg-2 col-form-label text-right">Unit Kerja</label>
                        <div class="col-9 col-lg-10">
<input name="unit_kerja" type="text" class="form-control" value="<?php echo $d['unit_kerja']; ?>">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="#" class="btn btn-danger" data-dismiss="modal">Close</a>
                        <input type="submit" name="Submit" value="Submit" class="btn btn-primary" >
                    </div>
                                       
                </form>
               
            </div>
                <!-- End Form Edit Data Pegawai -->   
            </div>
        </div>
    </div>
</div>
<?php } ?>
<!--End Modal Edit Data -->
<!-- ================================================= -->


<!--Javascript Edit Form dengan Modal -->

 <!--Javascript Edit Form dengan Modal -->

<!-- ================================================= -->
