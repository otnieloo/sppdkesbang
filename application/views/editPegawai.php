 <!-- Form Edit Data Pegawai -->
                <form id="form" data-parsley-validate="" novalidate="" action="<?php echo base_url(). 'DataPegawai/update/'.$pegawai[0]['id']; ?>" method="post"  enctype="multipart/form-data" >
                    <div class="form-group row">
                        <label for="inputEmail2" class="col-3 col-lg-2 col-form-label text-right">Nama</label>
                        <div class="col-9 col-lg-10">

<input name="nama" type="text" required="" class="form-control" value="<?php echo $pegawai[0]['nama']; ?>">

                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword2" class="col-3 col-lg-2 col-form-label text-right">NIP</label>
                        <div class="col-9 col-lg-10">
<input name="nip" type="text" required="" class="form-control" value="<?php echo $pegawai[0]['nip']; ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                         <label for="inputWebSite" class="col-3 col-lg-2 col-form-label text-right">Pangkat</label>
                        <div class="col-9 col-lg-10">
<input name="pangkat" type="text" required="" class="form-control" value="<?php echo $pegawai[0]['pangkat']; ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                         <label for="inputWebSite" class="col-3 col-lg-2 col-form-label text-right">Golongan</label>
                        <div class="col-9 col-lg-10">
<input name="golongan" type="text" required="" class="form-control" value="<?php echo $pegawai[0]['golongan']; ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                         <label for="inputWebSite" class="col-3 col-lg-2 col-form-label text-right">Jabatan</label>
                        <div class="col-9 col-lg-10">
<input name="jabatan" type="text" required="" class="form-control" value="<?php echo $pegawai[0]['jabatan']; ?>">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="#" class="btn btn-secondary" data-dismiss="modal">Close</a>
                        <input type="submit" name="Submit" value="Submit" class="btn btn-primary" >
                    </div>
                                       
                </form>