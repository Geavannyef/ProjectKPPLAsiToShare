<?php
/**
 * Part of ci-phpunit-test
 *
 * @author     Kenji Suzuki <https://github.com/kenjis>
 * @license    MIT License
 * @copyright  2015 Kenji Suzuki
 * @link       https://github.com/kenjis/ci-phpunit-test
 */

class UntukProject_test extends TestCase 
{
    protected $backupGlobalsBlacklist = array( '_SESSION' );
    
     public function setUp()
    {
            $this->resetInstance();
            $this->CI->load->model('BuatProjectModel');
            $this->obj1 = $this->CI->BuatProjectModel;
    }
    
     public function test_index(){
        $output = $this->request('GET', 'BuatProject/index');
        $this->assertContains('Please do login!', $output);
    }
    
    public function test_index_pendonor(){
        $_SESSION['role']='pendonor';
        $output = $this->request('GET', 'BuatProject/index');
        $this->assertContains('<li>Membuat Penawaran</li>', $output);
    }
    
    public function test_index_penerima(){
        $_SESSION['role']='penerima';
        $output = $this->request('GET', 'BuatProject/index');
        $this->assertContains('<li>Membuat Permintaan</li>', $output);
    }
    
    public function test_createpermintaan_tanpafoto(){
            $_SESSION['username'] = 'reziadinda';
            $_SESSION['role'] = 'penerima';
            $totalrow= $this->obj1->getTotalRow('anupenerima','permintaan','anuanudeh','22','2017-02-02','1anakreziadinda');
            $this->request('POST', 'BuatProject/addFotoDulu', 
                                       ['nama_project'=>'anupenerima', 
                                        'tipe_project' => 'permintaan',
                                        'deskripsi_project'=>'anuanudeh',
                                        'jumlah_botol'=>'22',
                                        'tanggal_akhir'=>'2017-02-02',
                                        'untuk_anak'=>'1anakreziadinda']);
            $totalrowafter= $this->obj1->getTotalRow('anupenerima','permintaan','anuanudeh','22','2017-02-02','1anakreziadinda');
            $this->assertEquals($totalrowafter,$totalrow+1);
            //$this->obj1->deleteRow('anu','penawaran','anuanudeh','22','2017-02-02');
    }
    
    public function test_createproject_tanpafoto(){
            $_SESSION['username'] = 'cncnrezi';
            $totalrow= $this->obj1->getTotalRow('anu','penawaran','anuanudeh','22','2017-02-02');
            $output = $this->request('POST', 'BuatProject/addFotoDulu', 
                                       ['nama_project'=>'anu', 
                                        'tipe_project' => 'penawaran',
                                        'deskripsi_project'=>'anuanudeh',
                                        'jumlah_botol'=>'22',
                                        'tanggal_akhir'=>'2017-02-02']);
            $totalrowafter= $this->obj1->getTotalRow('anu','penawaran','anuanudeh','22','2017-02-02');
            $this->assertEquals($totalrowafter,$totalrow+1);
            $this->obj1->deleteRow('anu','penawaran','anuanudeh','22','2017-02-02');
    }
    
    public function test_createproject_withfoto(){
            $_SESSION['username'] = 'cncnrezi';
            $filename = '1.jpg';
            $filepath = APPPATH. 'fototest/' .$filename;
            $files = [
			'foto_project' => [
				'name'     => $filename,
				'type'     => 'image/jpg',
				'tmp_name' => $filepath,
			],
		];
	
            $this->request->setFiles($files);
            $totalrow= $this->obj1->getTotalRow('anutesting','penawaran','anuanudeh','22','2017-02-02');
            $this->request('POST', 'BuatProject/addFotoDulu', 
                                       ['nama_project'=>'anutesting', 
                                        'tipe_project' => 'penawaran',
                                        'deskripsi_project'=>'anuanudeh',
                                        'jumlah_botol'=>'22',
                                        'tanggal_akhir'=>'2017-02-02']);
            $totalrowafter= $this->obj1->getTotalRow('anutesting','penawaran','anuanudeh','22','2017-02-02');
            $this->assertEquals($totalrowafter,$totalrow+1);
            
    }
    
    
}


