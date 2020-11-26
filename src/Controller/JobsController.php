<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Jobs;

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
}
