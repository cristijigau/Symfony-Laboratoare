<?php
namespace App\Controller;

use App\Entity\Task;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Form\Type\TaskType;

class TaskController extends AbstractController
{
     /**
     * @Route("/form", name="form")
     */
    public function new(Request $request)
    {
        // creates a task object and initializes some data for this example
        $task = new Task(); 

        $dueDateIsRequired = true;

        $form = $this->createForm(TaskType::class, $task, [
            'require_due_date' => $dueDateIsRequired,
            'action' => $this->generateUrl('form'),
            'method' => 'GET',
        ]);

        $form = $this->get('form.factory')->createNamed('My_form_name', TaskType::class, $task);
    
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $task = $form->getData();
    
            // ... perform some action, such as saving the task to the database
            // for example, if Task is a Doctrine entity, save it!
            // $entityManager = $this->getDoctrine()->getManager();
            // $entityManager->persist($task);
            // $entityManager->flush();
    
            return $this->redirectToRoute('app_task_added');
        }
        return $this->render('task/form.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/added")
     */
    public function added(){
        return $this->render('task/added.html.twig');
    }
}