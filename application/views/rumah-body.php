<?php 
        $this->load->view('rumah-head');
      ?>
    <div class="navbar-affixed-top" data-spy="affix" data-offset-top="200">

        <div class="navbar navbar-default yamm" role="navigation" id="navbar">

            <div class="container">
                <div class="navbar-header">

                    <a class="navbar-brand home" href="<?php echo base_url('Timeline')?>">
                        <img src="<?php echo base_url(); ?>asset/img/lg.png" class="hidden-xs hidden-sm">
                        <img src="<?php echo base_url(); ?>asset/img/lgs.png" class="visible-xs visible-sm"><span class="sr-only">ASI to Share</span>
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
                        <li class="dropdown active">
                            <a href="<?php echo base_url('Timeline')?>" class="dropdown-toggle" data-toggle="dropdown">Home <b></b></a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('BuatProject')?>">Membuat Project<b></b></a>
                        </li>
                        <li class="dropdown use-yamm yamm-fw">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="200">Profil <b class="caret"></b></a>
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
                        <h1>ASI to Share - <?php echo $kategori; ?></h1>
                    </div>
                    <div class="col-md-5">
                        <ul class="breadcrumb">
                            <li><a href="<?php echo base_url();?>">Home</a>
                            </li>
                            <li><?php echo $kategori; ?></li>
                        </ul>

                    </div>
                </div>
            </div>
        </div>

        <div id="content">
            <div class="container">
                
                <div class="row products">
                <?php foreach ($project as $pro) {?>
                    
                     <div class="col-md-4 col-sm-6">
                                <div class="box-image">
                                    <div class="image">
                                        <a href="">
                                            <img src="<?php echo base_url('/asset/img/'). $pro['foto_project']; ?>" alt="" class="img-responsive">
                                        </a>
                                    </div>
                                     <div class="text">
                                        <p class="buttons">
                                            <a href=""  class="btn btn-template-primary">View detail</a>
                                        </p>
                                    </div>
                                </div>
                                <div class="product">
                                    <div class="text">
                                        <h1><a href=""><?php echo $pro['nama_project']; ?></a></h1>
                                        <p> <?php echo $pro['jumlah_susu']; ?> botol</p>
                                         <p><?php echo $pro['deskripsi_project']; ?></p>
                                    </div>
                                </div>
                                <!-- /.product -->
                            </div>
                    <?php } ?>

    <div class="row">
        
    </div>
                    

                </div>
                <!-- /.col-sm-12 -->

            </div>
            <!-- /.container -->
        </div>
        <!-- /#content -->
<?php 
        $this->load->view('rumah-foot');
      ?>