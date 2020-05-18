<?php namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class UsertFilter implements FilterInterface
{
    public function before(RequestInterface $request)
    {
       $session=session();
        if($session->has('autor'))
            return redirect ()->to ('Gost');
    }

    //--------------------------------------------------------------------

    public function after(RequestInterface $request, ResponseInterface $response)
    {
        // Do something here
    }
}