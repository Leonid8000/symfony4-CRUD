<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\HttpFoundation\Response;

class ArticleController extends AbstractController
{
    /**
     * @Route("/homepage", name="homepage")
     */
    public function homepage(){

        return new Response('Omg this is new way to create route+controller');
    }

    /**
     * @Route("/news/{slug}")
     */
    public function show($slug){

        return new Response(sprintf(
            'Future page of news: %s',
            $slug
        ));
    }
}