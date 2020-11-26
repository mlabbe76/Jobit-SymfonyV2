<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Jobs;
use App\Form\CreajobType;

class JobsController extends AbstractController
{
    /**
     * @Route("/jobs", name="jobs")
     */
    public function index(Request $rq): Response
    {
        $jobId = $rq->query->get('jobId');
        $job = $this->getDoctrine()
                    ->getRepository('App\Entity\Jobs')
                    ->find($jobId);

        return $this->render('jobs/index.html.twig', [
            'controller_name' => 'JobsController', 'job' => $job
        ]);
    }
    /**
     * @Route("/createjob", name="createjob")
     */ 
    public function createjob(Request $request)
    {
        $job = new Jobs();
        $form = $this->createForm(CreajobType::class, $job);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $job = $form->getData();

            $doctrine = $this->getDoctrine()->getManager();
            $doctrine->persist($job);
            $doctrine->flush();
        }

        return $this->render('jobs/createform.html.twig', [
            'form' => $form->createView()
        ]);
    }   


}
