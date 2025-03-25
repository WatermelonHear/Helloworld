<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MainController
{
    #[Route('/helloworld')]
    public function homepage()
    {
        return new Response('<h1>Hellow World</h1>');
    }


}