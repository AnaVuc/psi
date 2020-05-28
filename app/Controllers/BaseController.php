<?php
namespace App\Controllers;


use CodeIgniter\Controller;
use App\Models\RestoranModel;
use App\Models\SlikaModel;
use App\Models\KorisnikModel;
use App\Models\AdminModel;

class BaseController extends Controller
{

	/**
	 * An array of helpers to be loaded automatically upon
	 * class instantiation. These helpers will be available
	 * to all other controllers that extend BaseController.
	 *
	 * @var array
	 */
	   protected $helpers = ['form', 'url'];

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
                $autoload['libraries'] = array('session', 'database');
		$this->session = \Config\Services::session();
	}
        
        protected function prikaz($page,$data){
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        
        public function index()
        {
       
        }
         public function promena_lozinke($poruka=null){
          
         echo view('sablon/header_ulogovan');
         echo view('stranice/promenasifre',['errors'=>$poruka]);
         echo view('sablon/footer');
        }

        public function promenaLoz(){



            if(!$this->validate(['password'=>'required', 'new'=>'required|min_length[6]|max_length[18]|alpha_numeric', 'new2'=>'required|matches[new]|min_length[6]|max_length[18]|alpha_numeric'],
                    ['password'=>[
                     'required'=> 'Ovo polje je obavezno',
                    ],
                     'new'=>[
                     'alpha_numeric'=>'Ovo polje mora da sadrži samo slova i cifre',
                     'min_length' => 'Minimalna dužina polja je 6 karaktera',
                     'required'=> 'Ovo polje je obavezno',
                     'max_length' => 'Maksimalna dužina polja je 18 karaktera'
                    ],
                     'new2'=>[
                     'matches'=>'Pogrešno uneta šifra', 
                     'alpha_numeric'=>'Ovo polje mora da sadrži samo slova i cifre',
                     'min_length' => 'Minimalna dužina polja je 6 karaktera',
                     'required'=> 'Ovo polje je obavezno',
                     'max_length' => 'Maksimalna dužina polja je 18 karaktera'
                    ]])) 
                     {
                    var_dump($this->validator->getErrors());
                    return $this->promena_lozinke($this->validator->getErrors());
                }
             //provera da li je to njegova sifra
                $korModel=new KorisnikModel();
                $modModel=new \App\Models\ModeratorModel;
                $adminModel=new AdminModel;
                $prom=$this->session->get('korisnik');
                $ime=$this->session->get('korisnik')->Korisnicko_ime;
                if($prom->Password!=$this->request->getVar('password'))
                  return $this->promena_lozinke('Pogresna stara lozinka');
                 var_dump($korModel->nadjiPoKI($ime));
                var_dump($modModel->nadjiPoKI($ime));
                
                var_dump($korModel->nadjiPoKI($ime)===$prom);
                var_dump($modModel->nadjiPoKI($ime)===$prom);

              //promena u bazi
                if ($korModel->nadjiPoKI($ime)==$prom){
                    $korModel->update($prom->Korisnicko_ime,['Password'=>$this->request->getVar('new')]);
                    $this->session->set('password');
                    return redirect()->to(site_url('Korisnik'));
                    
                }
                if ($modModel->nadjiPoKI($ime)==$prom){
                    $modModel->update($prom->Korisnicko_ime,['Password'=>$this->request->getVar('new')]);
                    $this->session->set('password');
                    return redirect()->to(site_url('Moderator'));
                }
                if ($adminModel->nadjiPoKI($ime)==$prom){
                    $adminModel->update($prom->Korisnicko_ime,['Password'=>$this->request->getVar('new')]);
                    $this->session->set('password');
                    return redirect()->to(site_url('Admin'));
                }
                else{
                    echo"Greska";
                }

                  //gde da skoci??

               
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
            echo view('stranice/boxRestoran',['restoran'=>$r]);
            
            
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
            echo view('stranice/najboljeOcenjeni',['restoran'=>$r]);
            
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
        
       

         public function restoran($id)
	{
            $restoranModel=new \App\Models\RestoranModel;
            $restoran=$restoranModel->find($id);
            $this->prikaz('restoran',['restoran'=>$restoran]);
		
        }
        
        public function pretraga($res){


            // get the q parameter from URL
            $q = $_REQUEST["q"];

            $hint = "";

            // lookup all hints from array if $q is different from ""
            if ($q !== "") {
            $q = strtolower($q);
            $len=strlen($q);
            foreach($res as $name) {
                if (stristr($q, substr($name->Ime, 0, $len))) {
                    if ($hint === "") {
                        $hint = $name->Ime;
                    } else {
                        $hint .= ", $name->Ime";
                }
            }
        }
        }

            // Output "no suggestion" if no hint was found or output correct values
            echo $hint === "" ? "no suggestion" : $hint;

        }
        
       public function ispisiNalog(){
        echo view('sablon/header_ulogovan');
        $prom=$this->session->get('korisnik');
        echo view('stranice/nalog',['korisnik'=>$prom]);
        echo view('sablon/footer');
        }
    
        public function izlogujse() {
            $this->session->destroy();
           return  redirect()->to(site_url('/')); //podrazumevano
        }
        
        public function ispisSvihRestorana(){
            
            $restoranModel=new RestoranModel();
            $restorani=$restoranModel->findAll();
            $data=[
                'niz'=>$restoranModel->paginate(4),
                'pager'=>$restoranModel->pager
            ];
           
            $prom=$this->session->get('korisnik');
            var_dump($prom);
            if (!empty ($prom)){
                echo view('sablon/header_ulogovan',['korisnik'=>$prom]);
                echo view('stranice/restoranListing',['data'=>$data,'model'=>$restoranModel,'korisnik'=>$prom]);
                echo view('sablon/footer');
            }
            else{
                echo view('sablon/header');
                echo view('stranice/restoranListing',['data'=>$data,'model'=>$restoranModel,'korisnik'=>$prom]);
                echo view('sablon/footer');
            }
                
            
        }
        
        public function ispisJednogRestorana($id) {
                $restoranModel=new RestoranModel();
                $slikaModel=new SlikaModel();
                $slika=$slikaModel->slikaRestorana(1);
                $res=$restoranModel->dohvatiRestoranSaId($id);
                $prom=$this->session->get('korisnik');
                if (empty($prom)){
                    echo view('sablon/header');
                }
                else{
                    echo view('sablon/header_ulogovan',['korisnik'=>$prom]);
                }
                echo view('stranice/restoran',['restoran'=>$res,'korisnik'=>$prom,'slika'=>$slika]);
                echo view('sablon/footer');
                
                
            
        }
      

        

       
        
}
