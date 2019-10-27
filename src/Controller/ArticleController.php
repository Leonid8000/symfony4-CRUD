<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\HttpFoundation\Response;

class ArticleController extends AbstractController
{
//    /**
//     * @Route("/news/{slug}")
//     */
//    public function show($slug){
//
//     $comments = [
//         'coment 1',
//         'coment 2',
//         'coment 3'
//     ];
//
//    return $this->render('article/show.html.twig', [
//        'title' => ucwords(str_replace('-', '', $slug)),
//        'comments' => $comments,
//    ]);
//    }
    
}

///**
// * @Route("/news/{slug}")
// */
//public function show($slug){
//
//    return new Response(sprintf(
//        'Future page of news: %s',
//        $slug
//    ));
//}

///**
// * @Route("/homepage", name="homepage")
// */
//public function homepage(){
//
//    return new Response('Omg this is new way to create route+controller');
//}