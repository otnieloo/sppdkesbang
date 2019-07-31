<!-- wrapper  -->
<!-- ================================================ -->
<div class="dashboard-wrapper">
    <div class="container-fluid  dashboard-content">
        <!-- =============================================== -->
        <!-- pageheader -->
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="page-header">
                    <h2 class="pageheader-title">Surat Pelaksanaan Perjalanan Dinas </h2>
                </div>
            </div>
        </div>
        <!-- end pageheader -->
        <!-- ======================================================= -->
        <div class="row">
            <!-- ============================================= -->
            <!-- valifation types -->
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="card">
                    <h5 class="card-header">Input Data</h5>
                    <div class="card-body">
                        <form id="validationform" data-parsley-validate="" novalidate=""  action="<?php echo base_url(). 'SPPD/tambahSPPD'; ?>" method="post" >

 <div class="form-group row">
                                <label class="col-12 col-sm-3 col-form-label text-sm-right">Kode No. :</label>
                                <div class="col-12 col-sm-8 col-lg-6">
 <!-- input Ringkasan Hasil Kegiatan -->
<input name="kode_sppd" class="form-control">
<!-- end input Ringkasan Hasil Kegiatan -->
                                </div>
                            </div>

                             <div class="form-group row">
                                <label class="col-12 col-sm-3 col-form-label text-sm-right">Nomor :</label>
                                <div class="col-12 col-sm-8 col-lg-6">
 <!-- input Ringkasan Hasil Kegiatan -->
<input name=no_sppd class="form-control">
<!-- end input Ringkasan Hasil Kegiatan -->
                                </div>
                            </div>


                            <div class="form-group row">
                                <label class="col-12 col-sm-3 col-form-label text-sm-right">Pejabat yang memerintah :</label>
                                <div class="col-12 col-sm-8 col-lg-6">
<!-- input nomor -->
<select class="form-control" name="pejabat" onchange="" id="pejabat" required="" >
    <option value="" selected="">Pilih Pejabat</option>
    <option value="KEPALA KANTOR KESBANG DAN LINMAS KABUPATEN">KEPALA KANTOR KESBANG DAN LINMAS KABUPATEN</option>
    <option value="SEKRETARIS DAERAH">SEKRETARIS DAERAH</option>
    <option value="ASISTEN PEMERINTAH">ASISTEN PEMERINTAH</option>
    <option value="ASISTEN UMUM">ASISTEN UMUM</option>
</select>
<!-- end input nomor -->
                                </div>
                            </div>


                            <div class="form-group row">
                                <label class="col-12 col-sm-3 col-form-label text-sm-right">Pegawai yang diperintah :</label>
                                <div class="col-12 col-sm-8 col-lg-6">
<!-- input nomor -->
<select class="form-control" name="id_pegawai" required="">
    <option value="" selected="">Pilih pegawai</option>
            <!-- Tampilkan data pegawai -->
            <?php foreach($pegawai as $d){ ?>
    <option value="<?php echo $d['id_pegawai']; ?>"><?php echo $d['nama']; ?> - <?php echo $d['pangkat']; ?> - <?php echo $d['jabatan']; ?></option>
            <?php } ?>
            <!-- /Tampilkan data pegawai -->
</select>
<!-- end input nomor -->
                                </div>
                            </div>


                            <div class="form-group row">
                                <label class="col-12 col-sm-3 col-form-label text-sm-right">Tingkat menurut peraturan :</label>
                                <div class="col-12 col-sm-8 col-lg-6">
<!-- input nomor -->
<select class="form-control" name="tingkat" required="" >
    <option value="" selected="">Pilih Pejabat</option>
    <option value="Dalam Daerah - Wilayah I">Dalam Daerah - Wilayah I</option>
    <option value="Dalam Daerah - Wilayah II">Dalam Daerah - Wilayah II</option>
    <option value="Dalam Daerah - Wilayah III">Dalam Daerah - Wilayah III</option>
    <option value="Luar Daerah - Wilayah I">Luar Daerah - Wilayah I</option>
    <option value="Luar Daerah - Wilayah II">Luar Daerah - Wilayah II</option>
    <option value="Luar Daerah - Wilayah III">Luar Daerah - Wilayah III</option>
    <option value="Tempat Lain di Luar Provinsi Jawa Barat, DKI dan Banten">Tempat Lain di Luar Provinsi Jawa Barat, DKI dan Banten</option>
</select>
<!-- end input nomor -->
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-12 col-sm-3 col-form-label text-sm-right">Maksud Perjalanan Dinas :</label>
                                <div class="col-12 col-sm-8 col-lg-6">
 <!-- input Ringkasan Hasil Kegiatan -->
<textarea name="maksud" required="" class="form-control"></textarea>
<!-- end input Ringkasan Hasil Kegiatan -->
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-12 col-sm-3 col-form-label text-sm-right">Alat angkut yang dipergunakan :</label>
                                <div class="col-12 col-sm-8 col-lg-6">
<!-- input nomor -->
<select class="form-control" name="alat_angkut" onchange="" id="transportasi" required="">
    <option value="" selected="">Pilih Kendaraan</option>
    <option value="Kendaraan Dinas">Kendaraan Dinas</option>
    <option value="Sewa">Sewa</option>
    <option value="Pribadi">Pribadi</option>
</select>
<!-- end input nomor -->
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-12 col-sm-3 col-form-label text-sm-right">Tempat :</label>
                                <div class="col-12 col-sm-10 col-lg-8">
                                <!-- input Tempat -->
                                <div class="form-row">
                                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-2">
                                        <label for="validationCustom04">Berangkat</label>
<!-- input Tempat Berangkat -->
<input name="tempat_berangkat" type="text" class="form-control" id="validationCustom04" value="Kantor Kesbang dan Linmas Kab. Tasikmalaya" required>
<!-- input Tempat Berangkat -->
                                        <div class="invalid-feedback">
                                        Masukkan Tempat Berangkat
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-2">
                                        <label for="validationCustom05">Tujuan</label>
<!-- input Tempat Tujuan -->
<input name="tempat_tujuan" type="text" class="form-control" id="validationCustom05" required>
<!-- end input Tempat Tujuan -->
                                        <div class="invalid-feedback">
                                        Masukkan tempat tujuan
                                        </div>
                                    </div>
                                </div>
                                <!-- end input Tempat -->
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-12 col-sm-3 col-form-label text-sm-right">Lamanya perjalanan Dinas :</label>
                                <div class="col-12 col-sm-10 col-lg-8">
                                <!-- input nomor -->
                                <div class="form-row">
                                    <div class="col-xl-2 col-lg-2 col-md-12 col-sm-12 col-12 mb-2">
                                        <label for="validationCustom03"></label>
<!-- input nomor -->
                                        <div class="input-group">
<input type="text" name="lama_dinas" class="filterme form-control">
                                        <div class="input-group-append"><span class="input-group-text">Hari</span></div>
                                        </div>
<!-- input nomor -->
                                        <div class="invalid-feedback">
                                      Please provide a valid city.
                                        </div>
                                    </div>
                                    <div class="col-xl-5 col-lg-5 col-md-12 col-sm-12 col-12 mb-2">
                                        <label for="validationCustom04">Tanggal Berangkat</label>
            <!-- Date Picker -->
            <div class=" input-group date" id="datetimepicker4" data-target-input="nearest">
<!-- input tgl kembali -->
<input name="tgl_berangkat" type="text" class="form-control datetimepicker-input" data-target="#datetimepicker4"  />
<!-- end input tgl kembali -->
                <div class="input-group-append" data-target="#datetimepicker4" data-toggle="datetimepicker">
                    <div class="input-group-text"><i class="far fa-calendar-alt"></i></div>
                </div>
            </div>
            <!-- end date picker -->
                                        <div class="invalid-feedback">
                                        Please provide a valid state.
                                        </div>
                                    </div>
                                    <div class="col-xl-5 col-lg-5 col-md-12 col-sm-12 col-12 mb-2">
                                        <label for="validationCustom05">Tanggal Kembali</label>
            <!-- Date Picker -->
            <div class=" input-group date" id="datetimepicker41" data-target-input="nearest">
<!-- input tgl kembali -->
<input name="tgl_kembali" type="text" class="form-control datetimepicker-input" data-target="#datetimepicker41"  />
 <!-- end input tgl kembali -->
                <div class="input-group-append" data-target="#datetimepicker41" data-toggle="datetimepicker">
                    <div class="input-group-text"><i class="far fa-calendar-alt"></i></div>
                </div>
            </div>
            <!-- end date picker -->
                                        <div class="invalid-feedback">
                                        Please provide a valid zip.
                                        </div>     
                                    </div>
                                </div>
                                <!-- end input nomor -->
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-12 col-sm-3 col-form-label text-sm-right">Pengikut :</label>
                                <div class="col-12 col-sm-10 col-lg-8">
<!-- select pegawai -->
            <div class="row">
<!-- input pengikut -->
        <?php foreach($pegawai as $d){ ?>
        <div class="col-md-4 my-1">
            <label class="custom-control custom-checkbox">
<input name="id_pengikut[]" id="id_pengikut" value="<?php echo $d['id_pegawai']; ?>" type="checkbox" class="custom-control-input"><span class="custom-control-label"><?php echo $d['nama']; ?></span>
            </label>
        </div>
        <?php } ?>
        <label class="custom-control custom-checkbox">
<input type="checkbox" name="id_pengikut" value="Terlampir"  class="custom-control-input"> <span class="custom-control-label">  Terlampir
<!-- end input pengikut -->
                                                    
            </div>
            <!-- end select pegawai -->
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-12 col-sm-3 col-form-label text-sm-right">Pembebanan Anggaran :</label>
                                <div class="col-12 col-sm-10 col-lg-8">
                                <!-- input Tempat -->
                                <div class="form-row">
                                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-2">
                                        <label for="validationCustom04">Instansi</label>
<!-- input instansi -->
<input name="instansi" type="text" class="form-control" id="validationCustom04" value="Kantor Kesbang dan Linmas Kab. Tasikmalaya" required>
<!-- input instansi -->
                                        <div class="invalid-feedback">
                                        Masukkan Instansi
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-2">
                                        <label for="validationCustom05">Mata Anggaran</label>
<!-- input mata anggaran -->
<!-- input nomor -->
<select class="form-control" name="id_anggaran" onchange="" id="pegawai" required="">
    <option value="" selected="">Pilih Mata Anggaran</option>
            <!-- Tampilkan data pegawai -->
            <?php foreach($anggaran as $d){ ?>
    <option value="<?php echo $d['id_anggaran']; ?>"><?php echo $d['kode_anggaran']; ?> - <?php echo $d['uraian']; ?></option>
            <?php } ?>
            <!-- /Tampilkan data pegawai -->
</select>
<!-- end input nomor -->
<!-- end input mata anggaran -->
                                        <div class="invalid-feedback">
                                        Masukkan Anggaran
                                        </div>
                                    </div>
                                </div>
                                <!-- end input Tempat -->
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-12 col-sm-3 col-form-label text-sm-right">Keterangan dan lain-lain :</label>
                                <div class="col-12 col-sm-10 col-lg-8">
<!-- input Ringkasan Hasil Kegiatan -->
<textarea name="keterangan" required="" class="form-control" ></textarea>
<!-- end input Ringkasan Hasil Kegiatan -->
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
            <!-- =================================================== -->
        </div>
       
    </div>
</div>