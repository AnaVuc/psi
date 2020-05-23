<?php namespace App\Models;

use CodeIgniter\Model;

class SlikaModel extends Model
{
    protected $table      = 'slika';
    protected $primaryKey = 'idSl';

    protected $returnType     = 'object';
   

    protected $allowedFields = ['Opis', 'Slika','idRec'];
    
    public function slikaRestorana($imeRestorana){
        return $this->where('idSl',$imeRestorana);
    }

}