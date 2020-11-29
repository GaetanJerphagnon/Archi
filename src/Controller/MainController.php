<?php

namespace App\Controller;

use App\Entity\Media;
use App\Form\MediaType;
use App\Service\ImageUploader;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="main")
     */
    public function index(): Response
    {
        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }

    /**
     * @Route("/img", name="img")
     */
    public function test(ImageUploader $imageUploader, Request $request): Response
    {
        $image = new Media();

        $form = $this->createForm(MediaType::class, $image);

        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $image = $form->get('path')->getData();
            $imageUploader->upload($image);
        }
        
        return $this->render('media/form.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
