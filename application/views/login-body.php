      <?php 
        $this->load->view('login-head');
      ?>



        <div id="content">
            <div class="container">

                <div class="row">
                    <div class="col-sm-12">
                        <!-- Tabs -->
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="tabs">
                                    <div class="box">
                            <h2 class="text-uppercase">ASI To Share</h2>
                            <hr>
                                    <ul class="nav nav-tabs">
                                        <li class="<?php echo  $statuslogin; ?>"><a href="#tab4-1" data-toggle="tab"><i class="icon-star"></i>Login</a>
                                        </li>
                                        <li class="<?php echo  $statusregister; ?>"><a href="#tab4-2" data-toggle="tab">Register</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content">
                                         
                                        <div class="tab-pane <?php echo  $statuslogin; ?> " id="tab4-1">
                                            
                                            <h2 class="text-uppercase">ASI To Share - Login</h2>
                                            <p>Segera Daftarkan diri Anda dan bergabunglah dengan kami</p>
                                            <br>
                                            
                                            
                                             <form action="<?php echo base_url('Login/login'); ?>" method="post">
                            <div class="form-group">
                                <input type="text" class="form-control" id="email_modal" placeholder=" email" name="username">

                            </div>
                            <div class="form-group" >

                                <input type="password" class="form-control" id="password_modal" placeholder="kata sandi" name="pass">
                            </div>

                            <p class="text-center">
                                <button class="btn btn-template-main"><i class="fa fa-sign-in"></i>Masuk</button>
                            </p>

                        </form>
                                             
                                        </div>
                                        <div class="tab-pane <?php echo  $statusregister; ?>" id="tab4-2">
                                            <h2 class="text-uppercase">ASI To Share - Register</h2>
                                            <hr>
                                            <p>Segera Daftarkan diri Anda dan bergabunglah dengan kami</p>
                                            <br>
                                <?php echo validation_errors(); ?>
                                <?php echo form_open_multipart('Login/uploadKtp'); ?>
                                <div class="form-group">
                                    <label for="name-login">Username</label>
                                    <input type="text" required="true"  class="form-control" name= "username" id="name-login">
                                </div>
                                <div class="form-group">
                                    <label for="email-login">Email</label>
                                    <input type="email" class="form-control" name="email" id="email-login">
                                </div>
                                <div class="form-group">
                                    <label for="password-login">Password</label>
                                    <input type="password" required="true" class="form-control" name="password" id="password-login">
                                </div>
                                <div class="form-group">
                                    <label for="name-login">Nama Lengkap</label>
                                    <input required="true" type="text" class="form-control" name="nama" id="Nama">
                                </div>
                                <div class="form-group">
                                    <label for="email-login">Alamat</label>
                                    <input required="true" type="text" class="form-control" name="alamat" id="alamat">
                                </div>
                                <div class="form-group">
                                    <label for="email-login">Nomer HP</label>
                                    <input required="true" type="text" class="form-control" name="no_hp" id="no_hp">
                                </div>
                                <div class="form-group">
                                    <label for="email-login">Nomer KTP</label>
                                    <input required="true" type="text" class="form-control" name="no_ktp" id="no_ktp">
                                </div>            
                                <div class="form-group">
                                    <label for="file">Upload KTP</label>
                                    <input required="true" type="file" class="form-control" name="foto_ktp">
                                </div>
                                <div class="form-group">
                                    <label class="role">Berperan sebagai</label>
                                    <select name="role">
                                    <option value="">Silahkan Pilih</option>
                                    <option value="2">Pendonor</option>
                                    <option value="3">Penerima</option>
                                    </select>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-template-main"><i class="fa fa-user-md"></i> Register</button>
                                </div>
                            <?php echo form_close(); ?>
                        </div>
                    </div>

                                        </div>
                                    </div>
                                    <!-- /.tab-content 
                                </div>
                                <!-- /.tabs -->
                            </div>
                            <!-- /.col-md-6 -->





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
