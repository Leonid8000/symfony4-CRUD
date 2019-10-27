<?php

namespace App\Controller;

use App\Entity\Article;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     * @Method ({"GET"})
     */
    public function index()
    {
        $articles = $this->getDoctrine()->getRepository(Article::class)->findAll();

        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
            'articles' => $articles,
        ]);
    }

    /**
     * @Route("/article/create", name="article_create")
     * Method({"GET", "POST"})
     */
    public function create(Request $request){
        $article = new Article();

        $form = $this->createFormBuilder($article)
            ->add('title', TextType::class, array('attr' => array('class' => 'form-control')))
            ->add('body', TextareaType::class, array('required' => false,
            'attr' => array('class' => 'form-control')))
        ->add('save', SubmitType::class, array(
            'label' => 'Create',
            'attr' => array('class' => 'btn btn-primary mt-3')
        ))
        ->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $article = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($article);
            $entityManager->flush();

            return $this->redirectToRoute('homepage');

        }

        return $this->render('article/create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/article/{id}", name="article_show")
     */
    public function show($id)
    {
        $articles = $this->getDoctrine()->getRepository(Article::class)->find($id);

        return $this->render('article/show.html.twig', [
            'articles' => $articles,
        ]);
    }

    /**
     * @Route("/article/delete/{id}")
     * Method({"DELETE"})
     */

    public function delete(Request $request, $id){

        $article = $this->getDoctrine()->getRepository(Article::class)->find($id);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($article);
        $entityManager->flush();

        $response = new Response();
        $response->send();
    }

    /**
     * @Route("/article/edit/{id}", name="article_edit")
     * Method({"GET", "POST"})
     */
    public function edit(Request $request, $id){
        $article = new Article();
        $article = $this->getDoctrine()->getRepository(Article::class)->find($id);

        $form = $this->createFormBuilder($article)
            ->add('title', TextType::class, array('attr' => array('class' => 'form-control')))
            ->add('body', TextareaType::class, array('required' => false,
                'attr' => array('class' => 'form-control')))
            ->add('save', SubmitType::class, array(
                'label' => 'Update',
                'attr' => array('class' => 'btn btn-primary mt-3')
            ))
            ->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();

            return $this->redirectToRoute('homepage');
        }

        return $this->render('article/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }


}


//    /**
//     * @Route("/article/save")
//     */
//    public function save(){
//        $entityManager = $this->getDoctrine()->getManager();
//
//        $article = new Article();
//
//        $article->setTitle('Article One');
//        $article->setBody('Article1 Body');
//
//        $entityManager->persist($article);
//        $entityManager->flush();
//
//        return new Response('Save an Article with id of '.$article->getId());
//    }



//        $form = $this->createFormBuilder($article)->add('title', TextType::class,
//            ['attr'=>
//                ['class'=>'form-control']])->add('body', TextareaType::class, [])