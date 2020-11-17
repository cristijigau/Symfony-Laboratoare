<?php
// src/Controller/DefaultController.php
namespace App\Controller;

use App\GreetingGenerator;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DefaultController extends AbstractController
 {
     /**
      * @Route("/hello/{name}")
      */
     public function index($name, LoggerInterface $logger, GreetingGenerator $generator)
     {
       $greeting = $generator->getRandomGreeting();

       $logger->info("Saying hello to $name!");
       
       return $this->render('default/index.html.twig', [
            'name' => $name,
        ]);
     }
    /**
     * @Route("/simplicity")
     */
    public function simple()
    {
        return new Response('Simple! Easy! Great!');
    }
        public function apiExample($name)
    {
        return $this->json([
            'name' => $name,
            'symfony' => 'rocks',
        ]);
    }
}