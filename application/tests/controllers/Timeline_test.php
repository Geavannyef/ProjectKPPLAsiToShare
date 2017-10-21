<?php
/**
 * Part of ci-phpunit-test
 *
 * @author     Kenji Suzuki <https://github.com/kenjis>
 * @license    MIT License
 * @copyright  2015 Kenji Suzuki
 * @link       https://github.com/kenjis/ci-phpunit-test
 */

class Timeline_test extends TestCase 
{
    protected $backupGlobalsBlacklist = array( '_SESSION' );
    
     public function setUp()
    {
            $this->resetInstance();
            $this->CI->load->model('TimelineModel');
            $this->obj1 = $this->CI->TimelineModel;
    }
     public function test_index_timeline_notlogin(){
        $output= $this->request('GET', 'Timeline/index');
        $this->assertContains('Please do login!', $output); 
    }
    
    public function test_index_home_notlogin(){
        $output= $this->request('GET', 'Home/index');
        $this->assertContains('<h1>Fakta lain tentang Asi</h1>', $output); 
    }
    
    public function test_index_home_login(){
        $_SESSION['role']='pendonor';
        $this->request('GET', 'Home/index');
        $this->assertRedirect('Timeline'); 
    }

        public function test_index_permintaan(){
        $_SESSION['role']='pendonor';
        $output= $this->request('GET', 'Timeline/index');
        $this->assertContains('<li>Permintaan</li>', $output); 
    }
    
     public function test_index_penawaran(){
        $_SESSION['role']='penerima';
        $output= $this->request('GET', 'Timeline/index');
        $this->assertContains('<li>Penawaran</li>', $output); 
    }
    
    public function test_index_admin(){
        $_SESSION['role']='admin';
        $output= $this->request('GET', 'Timeline/index');
        $this->assertContains('Maaf halaman admin belum ada', $output); 
    }
    
    
    
    
    
}