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
            $this->CI->load->model('AnakModel');
            $this->obj2 = $this->CI->AnakModel;
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
            $totalrow= $this->obj1->getTotalRow('permintaan tanpa foto','permintaan','anuanudeh','4','2017-02-02','1anakreziadinda');
            $this->request('POST', 'BuatProject/aksiPermintaan', 
                                       ['nama_project'=>'permintaan tanpa foto', 
                                        'deskripsi_project'=>'anuanudeh',
                                        'jumlah_botol'=>'4',
                                        'tanggal_akhir'=>'2017-02-02',
                                        'untuk_anak'=>'1anakreziadinda']);
            $totalrowafter= $this->obj1->getTotalRow('permintaan tanpa foto','permintaan','anuanudeh','4','2017-02-02','1anakreziadinda');
            $this->assertEquals($totalrowafter,$totalrow+1);
            $expected = $this->obj2->getAnakById('1anakreziadinda')[0]['foto_anak'];
            $actual = $this->obj1->getDistinctRow('permintaan tanpa foto','permintaan','anuanudeh','4','2017-02-02','1anakreziadinda')[0]['foto_project'];
            $this->assertEquals($expected,$actual);
            $this->obj1->deleteRow('permintaan tanpa foto','permintaan','anuanudeh','4','2017-02-02','1anakreziadinda');
    }
   
    public function test_createpenawaran_tanpafoto(){
            $_SESSION['username'] = 'cncnrezi';
            $_SESSION['role'] = 'pendonor';
            $totalrow= $this->obj1->getTotalRow('penawaran tanpafoto','penawaran','anuanudeh','22','2017-02-02', NULL);
            $this->request('POST', 'BuatProject/aksiPenawaran', 
                                       ['nama_project'=>'penawaran tanpafoto', 
                                        'deskripsi_project'=>'anuanudeh',
                                        'jumlah_botol'=>'22',
                                        'tanggal_akhir'=>'2017-02-02']);
            $totalrowafter= $this->obj1->getTotalRow('penawaran tanpafoto','penawaran','anuanudeh','22','2017-02-02', NULL);
            $this->assertEquals($totalrowafter,$totalrow+1);
            $foto_project = $this->obj1->getDistinctRow('penawaran tanpafoto','penawaran','anuanudeh','22','2017-02-02', NULL)[0]['foto_project'];
            $this->assertEquals('default.jpg', $foto_project);
            $this->obj1->deleteRow('penawaran tanpafoto','penawaran','anuanudeh','22','2017-02-02', NULL);
    }
    
    public function test_createproject_withfoto(){
            $_SESSION['username'] = 'cncnrezi';
            $_SESSION['role'] = 'pendonor';
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
            $totalrow= $this->obj1->getTotalRow('penawaran dengan foto','penawaran','anuanudeh','22','2017-02-02', NULL);
            $this->request('POST', 'BuatProject/aksiPenawaran', 
                                       ['nama_project'=>'penawaran dengan foto', 
                                        'deskripsi_project'=>'anuanudeh',
                                        'jumlah_botol'=>'22',
                                        'tanggal_akhir'=>'2017-02-02']);
            $totalrowafter= $this->obj1->getTotalRow('penawaran dengan foto','penawaran','anuanudeh','22','2017-02-02', NULL);
            $this->assertEquals($totalrowafter,$totalrow+1);
            $this->obj1->deleteRow('penawaran dengan foto','penawaran','anuanudeh','22','2017-02-02', NULL);
            
    }
    
    public function test_createpenawaran_judulkosong(){
            $_SESSION['username'] = 'cncnrezi';
            $_SESSION['role'] = 'pendonor';
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
            $totalrow= $this->obj1->getTotalRow('','penawaran','anuanudeh','22','2017-02-02');
            $this->request('POST', 'BuatProject/aksiPenawaran', 
                                       ['nama_project'=>'', 
                                        'deskripsi_project'=>'anuanudeh',
                                        'jumlah_botol'=>'22',
                                        'tanggal_akhir'=>'2017-02-02']);
            $totalrowafter= $this->obj1->getTotalRow('','penawaran','anuanudeh','22','2017-02-02');
            $this->assertEquals($totalrowafter,$totalrow);
            
    }
    
    public function test_createpermintaan_deskripsikosong(){
            $_SESSION['username'] = 'reziadinda';
            $_SESSION['role'] = 'penerima';
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
            $totalrow= $this->obj1->getTotalRow('mintasusu','permintaan','','22','2017-02-02');
            $this->request('POST', 'BuatProject/aksiPermintaan', 
                                       ['nama_project'=>'mintasusu', 
                                        'deskripsi_project'=>'',
                                        'jumlah_botol'=>'22',
                                        'tanggal_akhir'=>'2017-02-02']);
            $totalrowafter= $this->obj1->getTotalRow('mintasusu','permintaan','','22','2017-02-02');
            $this->assertEquals($totalrowafter,$totalrow);     
    }

    public function test_createpermintaan_dekripsilebihmax(){
            $_SESSION['username'] = 'reziadinda';
            $_SESSION['role'] = 'penerima';
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
            $totalrow= $this->obj1->getTotalRow('mintasusu','permintaan','aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa','22','2017-02-02');
            $this->request('POST', 'BuatProject/aksiPermintaan', 
                                       ['nama_project'=>'mintasusu', 
                                        'deskripsi_project'=>'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa',
                                        'jumlah_botol'=>'22',
                                        'tanggal_akhir'=>'2017-02-02']);
            $totalrowafter= $this->obj1->getTotalRow('mintasusu','permintaan','aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa','22','2017-02-02');
            $this->assertEquals($totalrowafter,$totalrow);
        
            
    }
    
       public function test_createpermintaan_botolbukanangka(){
            $_SESSION['username'] = 'reziadinda';
            $_SESSION['role'] = 'penerima';
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
            $totalrow= $this->obj1->getTotalRow('mintasusu','permintaan','anu','2b','2017-02-02');
            $this->request('POST', 'BuatProject/aksiPermintaan', 
                                       ['nama_project'=>'mintasusu', 
                                        'deskripsi_project'=>'anu',
                                        'jumlah_botol'=>'2b',
                                        'tanggal_akhir'=>'2017-02-02']);
            $totalrowafter= $this->obj1->getTotalRow('mintasusu','permintaan','anu','2b','2017-02-02');
            $this->assertEquals($totalrowafter,$totalrow);     
    }

}


