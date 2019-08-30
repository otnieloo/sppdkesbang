<!-- wrapper  -->
<!-- ================================================ -->
<div class="dashboard-wrapper">
    <div class="container-fluid  dashboard-content">
        <!-- ========================================== -->
        <!-- pageheader -->
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="page-header">
                    <h2 class="pageheader-title">Laporan Hasil Perjalanan Dinas </h2>
                </div>
            </div>
        </div>
        <!-- end pageheader -->
        <!-- =========================================== -->
        <div class="row">
        <!-- ========================================= -->
        <!-- valifation types -->
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="card">
                    <h5 class="card-header">Input Data</h5>
                    <?php echo validation_errors('<div class="alert alert-danger style="color: black;">"','</div>') ?>
                    <div class="card-body">
                        <form id="validationform form-validation" data-parsley-validate="" novalidate="" action="<?php echo base_url(). 'SuratHasil/tambahLaporan'; ?>" method="post" >

                            <div class="form-group row">
                                <label class="col-12 col-sm-3 col-form-label text-sm-right">Meneruskan SPPD Nomor :</label>
                                <div class="col-12 col-sm-8 col-lg-6">

<!-- input nomor -->
<?php if(isset($id_sppd)){ ?>
<select class="form-control" name="id_sppd" id="provinsi" required="">
    <option value="<?php echo $id_sppd ?>"      selected="selected"><?= $id_sppd?></option>
</select>
<?php }else{ ?>
<select class="form-control" name="id_sppd" id="provinsi" required="">
    <option value="" selected="">Pilih Nomor SPPD</option>
            <!-- Tampilkan data pegawai -->
            <?php 
            foreach($sppd as $d){ 
            $sp = $this->CRUD->mread_laporan($d['id_sppd']);
            echo($sp);
            if($sp == null){?>
                <option value="<?php echo $d['id_sppd']; ?>"><?php echo $d['no_sppd']; ?> </option>
            <?php }} ?>
            <!-- /Tampilkan data pegawai -->
</select>
<?php } ?>
<!-- end input nomor -->
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-12 col-sm-3 col-form-label text-sm-right">Ringkasan Hasil Kegiatan :</label>
                                <div class="col-12 col-sm-8 col-lg-6">
 <!-- input Ringkasan Hasil Kegiatan -->
<textarea name="hasil" required="" class="form-control" rows="8"></textarea>
 <!-- end input Ringkasan Hasil Kegiatan -->
                                </div>
                             </div>

                            <div class="form-group row text-right">
                                <label class="col-12 col-sm-3 col-form-label text-sm-right"></label>
                                <div class="col-12 col-sm-8 col-lg-6">
                                                
                                    <input type="submit" name="Submit" value="Buat Laporan Hasil" class="btn btn-block btn-primary" >
                                </div>
                            </div>
                         </form>
                     </div>
                </div>
            </div>
                        
         <!-- end valifation types -->
         <!-- ========================================== -->
    </div>
</div>