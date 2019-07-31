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
                        <form id="validationform form-validation" data-parsley-validate="" novalidate="" action="<?php echo base_url(). 'SuratHasil/tambahhasil'; ?>" method="post" >
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label text-sm-right">Petugas Yang Melaksanakan :</label>
                                <div class="col-sm-9">
                                    <div class="custom-controls-stacked">
                                        <label class="custom-control custom-checkbox">
                                        <div class="row">
<!-- input petugas yang melaksanakan -->
<?php foreach($pegawai as $d){ ?>
<div class="col-md-4 my-1">
    <label class="custom-control custom-checkbox">
    <input name="petugas" value="<?php echo $d['id_pegawai']; ?>" type="checkbox" class="custom-control-input"><span class="custom-control-label"><?php echo $d['nama']; ?></span>
    </label>
</div>
<?php } ?>
<label class="custom-control custom-checkbox">
<input type="checkbox" name="petugas" value="Terlampir"  class="custom-control-input"> <span class="custom-control-label">  Terlampir
<!-- end input petugas yang melaksanakan -->
                                                    
                                        </div>
                                        </label>
                                         <div id="error-container1"></div>
                                    </div>
                                </div>
                            </div>
                                        
                            <div class="form-group row">
                                <label class="col-12 col-sm-3 col-form-label text-sm-right">Tujuan :</label>
                                <div class="col-12 col-sm-8 col-lg-6">
<!-- input tujuan -->
<input name="tujuan" type="text" required="" class="form-control">
<!-- end input tujuan -->
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-12 col-sm-3 col-form-label text-sm-right">Tanggal Berangkat :</label>
                                <div class="col-8 col-sm-4 col-lg-3 input-group date" id="datetimepicker4" data-target-input="nearest">
<!-- input tgl berangkat -->
<input name="tgl_berangkat" type="text" class="form-control datetimepicker-input" data-target="#datetimepicker4" />
 <!-- end input tgl berangkat -->
                                    <div class="input-group-append" data-target="#datetimepicker4" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="far fa-calendar-alt"></i></div>
                                    </div>
                                </div>
                                <span style="color: red;"><?=form_error('tgl_berangkat');?></span>
                            </div>

                            <div class="form-group row">
                                <label class="col-12 col-sm-3 col-form-label text-sm-right">Tanggal Kembali :</label>
                                <div class="col-8 col-sm-4 col-lg-3 input-group date" id="datetimepicker41" data-target-input="nearest">
<!-- input tgl kembali -->
<input name="tgl_kembali" type="text" class="form-control datetimepicker-input" data-target="#datetimepicker41"  />
<!-- end input tgl kembali -->
                                    <div class="input-group-append" data-target="#datetimepicker41" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="far fa-calendar-alt"></i></div>
                                    </div>
                                </div>
                            </div>
                                        
                            <div class="form-group row">
                                <label class="col-12 col-sm-3 col-form-label text-sm-right">Ringkasan Hasil Kegiatan :</label>
                                <div class="col-12 col-sm-8 col-lg-6">
 <!-- input Ringkasan Hasil Kegiatan -->
<textarea name="ringkasan" required="" class="form-control" rows="8"></textarea>
 <!-- end input Ringkasan Hasil Kegiatan -->
                                </div>
                             </div>

                            <div class="form-group row">
                                <label class="col-12 col-sm-3 col-form-label text-sm-right">Pelapor :</label>
                                <div class="col-12 col-sm-8 col-lg-6">
<!-- input Pelapor -->
<select name="pelapor" class="selectpicker" required="" >
    <option value="" >Pilih pegawai</option>
             <!-- ambil data pegawai -->
            <?php foreach($pegawai as $d){ ?>
    <option value="<?php echo $d['nip']; ?> <?=set_value('pelapor') == $d['nip']  ? "selected" :null?>"><?php echo $d['nama']; ?></option>
            <?php } ?>
            <!-- /Tampilkan data pegawai -->
</select>
        <!-- end input Pelapor -->
                                </div>
                            </div>

                            <div class="form-group row text-right">
                                <label class="col-12 col-sm-3 col-form-label text-sm-right"></label>
                                <div class="col-12 col-sm-8 col-lg-6">
                                                
                                    <input type="submit" name="Submit" value="Buat Surat" class="btn btn-block btn-primary" >
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