<?php
/**
 * Part of ci-phpunit-test
 *
 * @author     Kenji Suzuki <https://github.com/kenjis>
 * @license    MIT License
 * @copyright  2015 Kenji Suzuki
 * @link       https://github.com/kenjis/ci-phpunit-test
 */

class Akun_test extends TestCase 
{
    protected $backupGlobalsBlacklist = array( '_SESSION' );
    
     public function setUp()
    {
            $this->resetInstance();
            $this->CI->load->model('loginModel');
            $this->obj1 = $this->CI->loginModel;
    }
    
    public function test_keformlogin()
    {  
        $output = $this->request('GET', 'Login/index');
        $this->assertContains('<h2 class="text-uppercase">ASI To Share</h2>', $output);
    }
    
    public function test_masuk_kehalaman()
    {
        $output = $this->request('GET', 'Login/login');
        $this->assertContains('username dan password salah', $output);
    }
    
    


        public function test_user_normal_penerima()
    {
       $this->request('POST', 'Login/login',
                            [
                            'username' => 'reziadinda',
                            'pass' => 'anuanu1'
                            ]
                            );
            $this->assertEquals('penerima', $_SESSION['role']);
            $this->assertRedirect('Timeline');
    }
    
     public function test_user_normal_pendonor()
    {  
       $this->request('POST', 'Login/login',
                            [
                            'username' => 'cncnrezi',
                            'pass' => 'anuanu'
                            ]
                            );
       $this->assertEquals('pendonor', $_SESSION['role']);
       $this->assertRedirect('Timeline');
    }
    
        public function test_user_normal_admin()
    {
       $this->request('POST', 'Login/login',
                            [
                            'username' => 'iniadmin',
                            'pass' => 'admin'
                            ]
                            );
            $this->assertEquals('iniadmin', $_SESSION['username']);
            $output = $this->request('GET', 'Login/login');
            $this->assertContains('ini admin', $output);
    }
    
     public function test_log_out()
    {
        $this->assertTrue( isset($_SESSION['username']) );
        $this->request('GET', 'Login/logout');
        $this->assertRedirect('Home');
        $this->assertFalse( isset($_SESSION['username']));
    }
    
    
    public function test_login_usernamebenar_passwordsalah()
    {
       $output= $this->request('POST', 'Login/login',
                [
                    'username' => 'cncnrezi',
                    'pass' => 'unmatch'
                ]);
        $this->assertFalse(isset($_SESSION['username']));
        //$this->assertRedirect('Home');
        $this->assertContains('username dan password salah', $output);
    }
    
    public function test_login_usernamebenar_passwordkosong()
    {
        $output = $this->request('POST', 'Login/login',
                [
                    'username' => 'cncnrezi',
                    'pass' => ''
                ]);
        $this->assertFalse(isset($_SESSION['username']));
        $this->assertContains('username dan password salah', $output);
    }
    
    public function test_login_usernamekosong_passwordbenar()
    {
       $output = $this->request('POST', 'Login/login',
                [
                    'username' => '',
                    'pass' => 'anuanu'
                ]);
        $this->assertFalse(isset($_SESSION['username']) );
        //$this->assertRedirect('Home');
        $this->assertContains('username dan password salah', $output);
    }
    
    public function test_login_usernamesalah_passwordsalah()
    {
        $output=  $this->request('POST', 'login/login',
                [
                    'username' => 'fira',
                    'pass' => 'qqq',
                ]);
           
        $this->assertFalse( isset($_SESSION['username']) );
        $this->assertContains('username dan password salah', $output);
    }

 
    
     public function test_index_register(){
            $output = $this->request('GET', 'Login/indexregister');
            $this->assertContains('<input required="true" type="file" class="form-control" name="foto_ktp">', $output);
    }

    public function test_do_upload_gagal(){
        $filename = 'images.png';
	$filepath = 'E:/'.$filename;
	$files = [
			'foto_ktp' => [
				'name'     => $filename,
				'type'     => 'image/png',
				'tmp_name' => $filepath,
			],
		];
		$this->request->setFiles($files);
		$output = $this->request('POST', 'Login/uploadKtp');
		$this->assertContains('Silahkan masukkan foto ktp terlebih dahulu', $output);
    }
    
    
    public function test_register(){
        $filename = '1.jpg';
	$filepath = APPPATH.  'fototest/' .$filename;
	$files = [
			'foto_ktp' => [
				'name'     => $filename,
				'type'     => 'image/jpg',
				'tmp_name' => $filepath,
                                'size' => 14.5,
                                'width' => 846,
                                'height'=>480
			],
		];
		$this->request->setFiles($files);
                $totalrow= $this->obj1->getTotalRowAcc('testing','anuehe','akun testing','jl jalan','testing@testing.com','asasas','081219','2');
		$this->request('POST', 'Login/uploadKtp',
                                        [
                                            'username' => 'testing',
                                            'password' => 'anuehe',
                                            'nama' => 'akun testing',
                                            'alamat' => 'jl jalan',
                                            'email' => 'testing@testing.com',
                                            'no_ktp' => 'asasas',
                                            'no_hp' => '081219',
                                            'role' => '2' 
                                            ]);
                $totalrowafter= $this->obj1->getTotalRowAcc('testing','anuehe','akun testing','jl jalan','testing@testing.com','asasas','081219','2');
                $this->assertEquals($totalrowafter,$totalrow+1);
                
    }
    
   

}


