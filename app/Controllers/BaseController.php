<?php
namespace App\Controllers;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 *
 * @package CodeIgniter
 */

use CodeIgniter\Controller;
use App\Models\RestoranModel;

class BaseController extends Controller
{

	/**
	 * An array of helpers to be loaded automatically upon
	 * class instantiation. These helpers will be available
	 * to all other controllers that extend BaseController.
	 *
	 * @var array
	 */
	protected $helpers = [];

	/**
	 * Constructor.
	 */
	public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
	{
		// Do Not Edit This Line
		parent::initController($request, $response, $logger);

		//--------------------------------------------------------------------
		// Preload any models, libraries, etc, here.
		//--------------------------------------------------------------------
		// E.g.:
		 $this->session = \Config\Services::session();
	}
        
        protected function prikaz($page,$data){
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        
        public function index()
        {
            $restoranModel=new RestoranModel();
            $restorani=$restoranModel->findAll();
            $this->najpopularniji($restorani);
            $this->sortPoOceni($restorani);
            $this->sortPoCeni($restorani);
            echo('Svi restorani');
            echo view('stranice/restoran',['restoran'=>$restorani]);
		
        }
        
        public function najpopularniji($r){
            
            usort($r,function($a,$b){
                if ($a->brojRecenzija * $a->Prosecna_ocena > $b->brojRecenzija * $b->Prosecna_ocena) {
                        return -1;
                } else if ($a->brojRecenzija * $a->Prosecna_ocena < $b->brojRecenzija * $b->Prosecna_ocena) {
                        return +1;
                } else {
                        return 0;
            }
            });
                echo ('Sortirani po popularnosti');
                echo view('stranice/najpopularniji',['restoran'=>$r]);
            
            
        }
        
        public function sortPoOceni($r){
            usort($r,function($a,$b){
                if ($a->Prosecna_ocena > $b->Prosecna_ocena) {
                        return -1;
                } else if ($a->Prosecna_ocena < $b->Prosecna_ocena) {
                        return +1;
                } else {
                        return 0;
            }
            });
            echo ('Sortirani po oceni');
            echo view('stranice/restoran',['restoran'=>$r]);
            
        }
        
        public function sortPoCeni($r){
            usort($r,function($a,$b){
                if (strlen($a->Cenovni_rang) > strlen($b->Cenovni_rang)) {
                        return -1;
                } else if (strlen($a->Cenovni_rang) < strlen($b->Cenovni_rang)) {
                        return +1;
                } else {
                        return 0;
            }
            });
            echo ('Sortirani po ceni');
            echo view('stranice/restoran',['restoran'=>$r]);
            
        }
        

       
        
  
}
