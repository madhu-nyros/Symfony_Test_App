<?php
// src/Controller/LuckyController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;



use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use App\Entity\Stories;

class StoryController extends Controller
{
    /**
     * @Route("/",name="story_list")
     * @Method({"GET"})
    */
    public function index()
    {
      $stories =$this->getDoctrine()->getRepository(Stories::class)->findAll();
      return $this->render('stories/index.html.twig',array('stories' => $stories ));
    }
    /**
     * @Route("/new_story",name="new_story")
     * @Method({"GET","POST"})
    */
    public function new(Request $request)
    {
      $story = new Stories();
      $form= $this->createFormBuilder($story)
        ->add('title',TextType::class,array('attr' =>
          array('class' => 'form-control')))
        ->add('description',TextareaType::class,array('attr'=>
          array('class' => 'form-control')))
        ->add('created_by',TextType::class,array('attr'=>
          array('class' => 'form-control')))
        ->add('save',SubmitType::class,array(
          'label' => 'Create',
          'attr'  => array('class' => 'btn btn-info mt-3')))
        
        -> getForm();

        $form ->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
          $story = $form -> getData();
          $entityManager = $this ->getDoctrine()->getManager();
          $entityManager->persist($story);
          $entityManager->flush($story);
          return $this->redirectToRoute('story_list');
        }

        return $this->render('stories/new.html.twig',array(
            'form' =>$form ->createView()
        )); 
    }
    /**
     * @Route("story/edit/{id}",name="edit_story")
     * @Method({"GET","POST"})
    */
    public function edit(Request $request,$id)
    {
      $story = new Stories();
      $story = $this->getDoctrine()->getRepository(Stories:: class)->find($id);
      $form= $this->createFormBuilder($story)
        ->add('title',TextType::class,array('attr' =>
          array('class' => 'form-control')))
        ->add('description',TextareaType::class,array('attr'=>
          array('class' => 'form-control')))
        ->add('created_by',TextType::class,array('attr'=>
          array('class' => 'form-control')))
        ->add('save',SubmitType::class,array(
          'label' => 'Update',
          'attr'  => array('class' => 'btn btn-info mt-3')))
        
        -> getForm();

        $form ->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
          $entityManager = $this ->getDoctrine()->getManager();
          $entityManager->flush($story);
          return $this->redirectToRoute('story_list');
        }

        return $this->render('stories/edit.html.twig',array(
            'form' =>$form ->createView()
        )); 
    }
    /**
     * @Route("/story/delete/{id}")
     * @Method({"DELETE"})
    */
    public function delete(Request $request,$id)
    {
      $story = $this->getDoctrine()->getRepository(Stories:: class)->find($id);
      $entityManager = $this ->getDoctrine()->getManager();
      $entityManager->remove($story);
      $entityManager->flush();
      return $this->redirectToRoute('story_list');
    }

    /**
      * @Route("/story/{id}",name="story_show")
    */
    public function show($id)
    {
      $story = $this->getDoctrine()->getRepository(Stories:: class)->find($id);
      return $this->render('stories/show.html.twig',array('story' => $story ));
    } 
}