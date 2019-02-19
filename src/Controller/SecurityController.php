<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\User;
use App\Form\RegistrationType;
class SecurityController extends AbstractController
{
    // /**
    //  * @Route("/security", name="security")
    //  */
    // public function index()
    // {
    //     return $this->render('security/index.html.twig', [
    //         'controller_name' => 'SecurityController',
    //     ]);
    // }

    /**
     * @Route("/registration", name="registration_form")
    */
    public function registration(Request $request) {
    	
    	$user = new User();
    	$form = $this ->createForm(RegistrationType::class ,$user);
    	return  $this->render('security/registration.html.twig',[
    		'form' => $form->createView()
    	]);
    }

}
