<body onload="startTime()">
    <!-- ============================================================== -->
    <!-- main wrapper -->
    <!-- ============================================================== -->
    <div class="dashboard-main-wrapper">
        <!-- ============================================================== -->
        <!-- navbar -->
        <!-- ============================================================== -->
        <div class="dashboard-header">
            <nav class="navbar navbar-expand-lg bg-white fixed-top">
                <a class="navbar-brand" href="<?=base_url()?>index/index">  <img src="<?php echo base_url(). 'assets/images/logo-kesbang2.png'; ?>" height="50" width="50">SPPD<span style="font-size: 30%;" >Kesbang Kab. Tasikmalaya<span></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse " id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto navbar-right-top">
                        <li class="nav-item">
                            <div style="width: 100%; " class="pt-3">
        <marquee behavior="scroll" direction="left" ><h3><i>"Kota Tasikmalaya Kondusif Menuju Masyarakat Madani"</i></h3></marquee></div>
                        </li>
                        <li class="nav-item">
                            <div id="custom-search" class="top-search-bar px-4">
                                <input class="form-control" type="text" placeholder="Search..">
                            </div>
                        </li>
                        <li class="nav-item dropdown connection px-4 pt-2">
                             <span class="mr-2 d-none d-lg-inline text-gray-800 small "><?php 
                    switch (date("l")) {
                      case 'Sunday':
                         echo "Minggu";
                        break;
                      case 'Monday':
                         echo "Senin";
                        break;
                      case 'Tuesday':
                         echo "Selasa";
                        break;
                      case 'Wednesday':
                        echo "Rabu";
                        break;
                      case 'Thursday':
                         echo "Kamis";
                        break;
                      case 'Friday':
                         echo "Jumat";
                        break;
                      case 'Saturday':
                         echo "Sabtu";
                        break;
                      
                      default:
                        # code...
                        break;
                    }
                    echo date(", d ");
                    switch (date("F")) {
                      case 'January':
                         echo "Januari";
                        break;
                      case 'February':
                         echo "Februari";
                        break;
                      case 'March':
                         echo "Maret";
                        break;
                      case 'April':
                        echo " April";
                        break;
                      case 'June':
                         echo "Juni";
                        break;
                      case 'July':
                         echo "Juli";
                        break;
                      case 'August':
                         echo "Agustus";
                        break;
                      case 'September':
                         echo "September";
                        break;
                      case 'October':
                         echo "Oktober";
                        break;
                      case 'November':
                         echo "November";
                        break;
                      case 'December':
                        echo "Desember";
                        break;
                      case 'May':
                         echo "Mei";
                        break;
                      
                      default:
                        # code...
                        break;
                    }
                    echo date(" Y ");

                ?><div id="txt"></div> </span>
                        </li>
                        <li class="nav-item dropdown nav-user">
                            <a class="nav-link nav-user-img" href="#" id="navbarDropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="<?php echo base_url(). 'assets/images/logo-kesbang2.png'; ?>" alt="" class="user-avatar-md rounded-circle"></a>
                            <div class="dropdown-menu dropdown-menu-right nav-user-dropdown" aria-labelledby="navbarDropdownMenuLink2">
                                <div class="nav-user-info">
                                    <h5 class="mb-0 text-white nav-user-name">John Abraham </h5>
                                    <span class="status"></span><span class="ml-2">Available</span>
                                </div>
                                <a class="dropdown-item" href="#"><i class="fas fa-user mr-2"></i>Account</a>
                                <a class="dropdown-item" href="#"><i class="fas fa-cog mr-2"></i>Setting</a>
                                <a class="dropdown-item" href="#"><i class="fas fa-power-off mr-2"></i>Logout</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <!-- ============================================================== -->
        <!-- end navbar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- left sidebar -->
        <!-- ============================================================== -->
        <div class="nav-left-sidebar sidebar-dark">
            <div class="menu-list">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <a class="d-xl-none d-lg-none" href="#">Dashboard</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav flex-column">
                            <li class="nav-divider">
                                Menu
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link active" href="<?=base_url()?>index/index"><i class="fas fa-industry"></i>Dashboard <span class="badge badge-success">6</span></a>
                                
                            </li>
                            <li class="nav-divider">
                                Input Data
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-2" aria-controls="submenu-2"><i class="fas fa-envelope"></i>Buat Surat</a>
                                <div id="submenu-2" class="collapse submenu" style="">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="<?=base_url()?>SPPD/index">SPPD <span class="badge badge-secondary">New</span></a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="<?=base_url()?>SuratPerintah/index">Surat Perintah</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="<?=base_url()?>SuratHasil/index">Laporan Hasil</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-divider">
                                Data
                            </li>
                            <li class="nav-item <?=($this->uri->segment(1)==='DataPegawai')?'active':''?>">
                                <a class="nav-link " href="<?=base_url()?>DataPegawai/index"><i class="fas fa-users" title="DataPegawai"></i>Data Pegawai <span class="badge badge-success">6</span></a>
                                
                            </li>
                             </li>
                            <li class="nav-item ">
                                <a class="nav-link" href="<?=base_url()?>DataAnggaran/index" title="DataAnggaran" ><i class="far fa-money-bill-alt"></i>Data Anggaran<span class="badge badge-success">6</span></a>
                                
                            </li>
                            <li class="nav-divider">
                               History
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-6" aria-controls="submenu-6"><i class="fas fa-history "></i> History </a>
                                <div id="submenu-6" class="collapse submenu" style="">
                                    <ul class="nav flex-column">
                                         <li class="nav-item">
                                            <a class="nav-link" href="<?=base_url()?>SPPD/history">SPPD <span class="badge badge-secondary">New</span></a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="<?=base_url()?>SuratPerintah/history">Surat Perintah</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="<?=base_url()?>SuratHasil/history">Laporan Hasil</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                           
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- end left sidebar -->
        <!-- ============================================================== -->