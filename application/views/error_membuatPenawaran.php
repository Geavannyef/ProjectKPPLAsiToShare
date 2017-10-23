      <?php 
        $this->load->view('rumah-head');
      ?>
  <div class="navbar-affixed-top" data-spy="affix" data-offset-top="200">

        <div class="navbar navbar-default yamm" role="navigation" id="navbar">

            <div class="container">
                <div class="navbar-header">

                    <a class="navbar-brand home" href="<?php echo base_url('Timeline')?>">
                        <img src="<?php echo base_url(); ?>asset/img/logo.png" class="hidden-xs hidden-sm">
                        <img src="<?php echo base_url(); ?>asset/img/logo-small.png" class="visible-xs visible-sm"><span class="sr-only">ASI to Share</span>
                    </a>
                    <div class="navbar-buttons">
                        <button type="button" class="navbar-toggle btn-template-main" data-toggle="collapse" data-target="#navigation">
                            <span class="sr-only">Toggle navigation</span>
                            <i class="fa fa-align-justify"></i>
                        </button>
                    </div>
                </div>
                <!--/.navbar-header -->

                <div class="navbar-collapse collapse" id="navigation">

                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a href="<?php echo base_url('Home')?>">Home</a>
                        </li>
                        <li class="active">
                            <a href="<?php echo base_url('BuatProject')?>">Membuat Project<b></b></a>
                        </li>
                        <li class="dropdown use-yamm yamm-fw">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="200">Profil<b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li>
                                    <div class="yamm-content">
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <ul>
                                                    <li><a href="#">Edit Profil</a>
                                                    </li>
                                                    <li><a href="#">Tambah Anak</a>
                                                    </li>
                                                    <li><a href="#">Cek Status</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                        <li class="dropdown">
                            <a href="<?php echo base_url('/Login/logout'); ?>">Keluar <i class="fa fa-door"></i></a>
                        </li>
                    </ul>

                </div>
               

            </div>


        </div>
        <!-- /#navbar -->

    </div>
<div id="heading-breadcrumbs">
            <div class="container">
                <div class="row">
                    <div class="col-md-7">
                        <h1>ASI to Share</h1>
                    </div>
                    <div class="col-md-5">
                        <ul class="breadcrumb">
                            <li><a href="<?php echo base_url('Timeline');?>">Home</a>
                            </li>
                            <li>Membuat Penawaran</li>
                        </ul>

                    </div>
                </div>
            </div>
        </div>

        <div id="content">
            <div class="container">

                <div class="row">
                    <div class="col-sm-12">
                        <div class="box">
                            <h2 class="text-uppercase">Membuat Penawaran</h2>
                            <hr>
                            <p style="color:red"><strong>Errornya:<br><?php echo $errornya?></strong></p>
                             <?php echo form_open_multipart('BuatProject/aksiPenawaran'); ?>
                                <div class="form-group">
                                    <label for="judul">Judul Penawaran</label>
                                    <input type="text" class="form-control" id="name-login" name="nama_project">
                                </div>
                                <div class="form-group">
                                    <label for="tgl">Tanggal Kadaluarsa</label>
                                    <input type="date" date="dd-MM-yyyy" class="form-control" name="tanggal_akhir">
                                </div>
                                <div class="form-group">
                                    <label for="bot">Banyak Botol Yang Ditawarkan</label>
                                    <input type="number" class="form-control" id="jumlah_botol" name="jumlah_botol">
                                </div>
                                <div class="form-group">
                                    <label for="desk">Deskripsi Penawaran</label>
                                    <input type="text" class="form-control" id="name-login" name="deskripsi_project">
                                </div>
                                <div class="form-group">
                                    <label for="foto">Foto Penawaran</label>
                                    <input type="file" class="form-control" id="foto_project" name="foto_project">
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-template-main"><i class="fa fa-user-md"></i> Create</button>
                                </div>
                            <?php echo form_close(); ?>
                        </div>
                    </div>

                 

                </div>
                <!-- /.row -->

            </div>
            <!-- /.container -->
        </div>
        <!-- /#content -->





</body>

      <?php 
        $this->load->view('foot');
      ?>
