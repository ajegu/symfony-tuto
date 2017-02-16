<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Post;
use AppBundle\Entity\Task;
use AppBundle\Form\PostType;
use AppBundle\Form\TaskType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;

class BlogController extends Controller
{
    /**
     *
     */
    public function listAction($page = 1)
    {
        $url = $this->generateUrl('blog_show', array('slug' => "my-first-post"));

        $this->get('router')->generate('blog', array(
            'page' => 2,
            'category' => 'Symfony'
        ));

        return $this->render('AppBundle:Blog:list.html.twig', array(
            'pageNumber' => $page,
            'url' => $url
        ));
    }

    /**
     *
     */
    public function showAction($slug)
    {

        //return $this->redirectToRoute('blog');

        //throw new \Exception('Something went wrong!');

        $this->addFlash('notice', 'My notice message');
        $this->addFlash('notice', 'My second notice message');

        return $this->render('AppBundle:Blog:show.html.twig', array(
            'slug' => $slug
        ));
    }

    public function taskAction(Request $request) {
        // create a task and give it some dummy data for this example
        $task = new Task();
        $task->setTask('Write a blog post');
        $task->setDueDate(new \DateTime('tomorrow'));

        $form = $this->createForm(TaskType::class, $task);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $task = $form->getData();


            // ... perform some action, such as saving the task to the database
            // for example, if Task is a Doctrine entity, save it!
            // $em = $this->getDoctrine()->getManager();
            // $em->persist($task);
            // $em->flush();

            return $this->redirectToRoute('blog');
        }


        return $this->render('AppBundle:Blog:task.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function postAction(Request $request) {

        $post = new Post();

        $form = $this->createForm(PostType::class, $post);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $post = $form->getData();


            $em = $this->getDoctrine()->getManager();

            $em->persist($post);

            $em->flush();

            return $this->redirectToRoute('blog');
        }



        return $this->render('AppBundle:Blog:post.html.twig', array(
            'form' => $form->createView(),
        ));
    }

}
