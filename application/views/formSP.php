<!-- wrapper  -->
<!-- =============================================== -->
<div class="dashboard-wrapper">
    <div class="container-fluid  dashboard-content">
        <!-- ======================================= -->
        <!-- pageheader -->
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="page-header">
                    <h2 class="pageheader-title">Surat Perintah Tugas</h2>
                </div>
            </div>
        </div>
        <!-- end pageheader -->
        <!--======================================= -->
        <div class="row">
            <!-- ===================================== -->
            <!-- valifation types -->
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="card">
                    <h5 class="card-header">Input Data</h5>
                    <div class="card-body">
                        <form id="validationform" data-parsley-validate="" novalidate=""  action="<?php echo base_url(). 'SuratPerintah/tambahSP'; ?>" method="post" >

                            
                            <div class="form-group row">
                                <label class="col-12 col-sm-3 col-form-label text-sm-right">Meneruskan SPPD Nomor :</label>
                                <div class="col-12 col-sm-8 col-lg-6">
<!-- input nomor -->
<select class="form-control" name="id_sppd" required="">
    <option value="" selected="">Pilih Nomor SPPD</option>
            <!-- Tampilkan data pegawai -->
            <?php foreach($sppd as $d){ ?>
    <option value="<?php echo $d['id_sppd']; ?>"><?php echo $d['no_sppd']; ?> </option>
            <?php } ?>
            <!-- /Tampilkan data pegawai -->
</select>
<!-- end input nomor -->
                                </div>
                            </div>


                            <div class="form-group row">
                                <label class="col-12 col-sm-3 col-form-label text-sm-right">Nomor Surat :</label>
                                <div class="col-12 col-sm-8 col-lg-6">
<!-- input nomor -->
<input name="no_spt" type="text" required="" class="form-control" value="800/___ /III/KBL/2019">
<!-- end input nomor -->
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-12 col-sm-3 col-form-label text-sm-right">Dasar Surat :</label>
                                <div class="col-12 col-sm-8 col-lg-6">
<!-- input Dasar Surat -->
<textarea name="dasar" type="text" required="" class="form-control">Surat dari Badan Perencanaan Pembangunan Daerah Kabupaten Tasikmalaya Nomor: </textarea>
<!-- end input Dasar Surat -->
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-12 col-sm-3 col-form-label text-sm-right"> Tanggal Surat:</label>
                                 <div class="col-8 col-sm-4 col-lg-3 input-group date" id="datetimepicker3" data-target-input="nearest">
<!-- input tgl kembali -->
<input name="tanggal_surat" type="text" class="form-control datetimepicker-input" data-target="#datetimepicker3"  />
<!-- end input tgl kembali -->
                                <div class="input-group-append" data-target="#datetimepicker3" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="far fa-calendar-alt"></i></div>
                                </div>
                            </div>
                            </div>


                            <div class="form-group row">
                                <label class="col-12 col-sm-3 col-form-label text-sm-right">Untuk :</label>
                                <div class="col-12 col-sm-8 col-lg-6">
<!-- input Ringkasan Hasil Kegiatan -->
<textarea name="untuk" required="" class="form-control" rows="8"></textarea>
<!-- end input Ringkasan Hasil Kegiatan -->
                                </div>
                            </div>

                            <div class="form-group row text-right">
                                <div class="col col-sm-10 col-lg-9 offset-sm-1 offset-lg-0">
                                <input type="submit" name="Submit" value="Buat Surat" class="btn btn-space btn-primary" >
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
                <!-- end valifation types -->
                <!-- ======================================= -->
        </div>
           
    </div>