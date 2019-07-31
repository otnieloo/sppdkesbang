 <!-- ======================================================== -->
        <!-- wrapper  -->
<div class="dashboard-wrapper">
    <div class="container-fluid  dashboard-content">
        <!-- ==================================================== -->
        <!-- pageheader -->
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="page-header">
                    <h2 class="pageheader-title">Data Anggaran</h2>
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
                                        <th>Kode Anggaran</th>
                                        <th>Uraian</th>
                                       <!-- <th>Lokasi</th>
                                        <th>Target Kinerja</th>
                                         <th>Sumber Dana</th> -->
                                         <th style="width: 80px;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
<!-- menampilkan data pegawai -->
<?php 
$no = 1;
foreach($anggaran as $d) {
?>
    <tr>
        <td style="max-width: 50px;"><?php echo $no; ?></td>
        <td><?php echo $d['kode_anggaran']; ?></td>
        <td><?php echo $d['uraian']; ?></td>
         <!--<td><?php echo $d['lokasi']; ?></td>
        <td><?php echo $d['target_kinerja']; ?></td>
        <td><?php echo $d['sumber_dana']; ?></td> -->
        <td >
<a class="btn btn-warning" data-toggle="modal" data-target="#exampleModal2<?php echo $d['id_anggaran'];?>" data-popup="tooltip"> <i class="fa fa-edit"> </i> </a>

 <a class="btn btn-danger" data-toggle="modal" data-target="#deleteModal<?php echo $d['id_anggaran'];?>" data-popup="tooltip"> <i class="fa fa-times" style="color: white;">  </i> </a>
           
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
foreach($anggaran as $d) {
?>
<div class="modal fade" id="deleteModal<?php echo $d['id_anggaran'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Apakah Anda Yakin Hapus Data Anggaran <?php echo $d['uraian'];?> </h5>
                        </a>
            </div>
            <div class="modal-body">
                <div style="text-align: center; padding: 50px;">
                    <i class="fas fa-trash-alt" style="font-size: 30px;" data-test='puffIn'></i>
                </div>
                <a class="btn btn-danger mx-1" href="<?=base_url()."DataAnggaran/hapus/".$d['id_anggaran'];?>"></i>Ya, Hapus</a>

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
                <h5 class="modal-title" id="exampleModalLabel">Input Data Anggaran</h5>
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </a>
            </div>
            <div class="modal-body">
                <!-- Form Tambah Data Pegawai -->
                <form id="form" data-parsley-validate="" novalidate="" action="<?php echo base_url(). 'DataAnggaran/tambah'; ?>" method="post">
                    <div class="form-group row">
                        <label for="inputEmail2" class="col-4 col-lg-3 col-form-label text-right">Kode</label>
                        <div class="col-8 col-lg-9">

<input name="kode_anggaran" type="text" required="" class="form-control">

                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword2" class="col-4 col-lg-3 col-form-label text-right">Uraian</label>
                        <div class="col-8 col-lg-9">
<textarea name="uraian" type="text" required="" class=" form-control"></textarea>
                        </div>
                    </div>

                     <!--
                    <div class="form-group row">
                        <label for="inputEmail2" class="col-4 col-lg-3 col-form-label text-right">Lokasi Kegiatan</label>
                        <div class="col-8 col-lg-9">

<input name="lokasi" type="text" class="form-control">

                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword2" class="col-4 col-lg-3 col-form-label text-right">Target Kinerja</label>
                        <div class="col-8 col-lg-9">
<textarea name="target_kinerja" type="text" class=" form-control"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail2" class="col-4 col-lg-3 col-form-label text-right">Sumber Dana</label>
                        <div class="col-8 col-lg-9">

<input name="sumber_dana" type="text" class="form-control">

                        </div>
                    </div>

                    -->  
                    <div class="modal-footer">
                        <a href="#" class="btn btn-secondary" data-dismiss="modal">Close</a>
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
foreach ($anggaran as $d) {
    # code...
?>
<div class="modal fade" id="exampleModal2<?php echo $d['id_anggaran'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Data Anggaran</h5>
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </a>
            </div>
            <div class="modal-body">
                <div class="dash">
                     <!-- Form Edit Data Pegawai -->
                <form id="form" data-parsley-validate="" novalidate="" action="<?php echo base_url(). 'DataAnggaran/update/'.$d['id_anggaran']; ?>" method="post"  enctype="multipart/form-data" >

                    <div class="form-group row">
                        <label for="inputEmail2" class="col-4 col-lg-3 col-form-label text-right">Kode</label>
                        <div class="col-8 col-lg-9">

<input name="kode_anggaran" type="text" required="" class="form-control" value="<?php echo $d['kode_anggaran']; ?>">

                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword2" class="col-4 col-lg-3 col-form-label text-right">Uraian</label>
                        <div class="col-8 col-lg-9">
<textarea name="uraian" type="text" required="" class=" form-control"><?php echo $d['uraian']; ?></textarea>
                        </div>
                    </div>

                    <!--
                    <div class="form-group row">
                        <label for="inputEmail2" class="col-4 col-lg-3 col-form-label text-right">Lokasi Kegiatan</label>
                        <div class="col-8 col-lg-9">

<input name="lokasi" type="text" class="form-control" value="<?php echo $d['lokasi']; ?>">

                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword2" class="col-4 col-lg-3 col-form-label text-right">Target Kinerja</label>
                        <div class="col-8 col-lg-9">
<textarea name="target_kinerja" type="text" class=" form-control"><?php echo $d['target_kinerja']; ?></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail2" class="col-4 col-lg-3 col-form-label text-right">Sumber Dana</label>
                        <div class="col-8 col-lg-9">

<input name="sumber_dana" type="text" class="form-control" value="<?php echo $d['sumber_dana']; ?>">

                        </div>
                    </div>
-->  

                    
                    <div class="modal-footer">
                        <a href="#" class="btn btn-secondary" data-dismiss="modal">Close</a>
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
