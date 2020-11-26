<?php

namespace App\Controller;

use App\Repository\CategoriesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\JobsRepository;
use Doctrine\ORM\EntityManagerInterface;

class AccueilController extends AbstractController
{
    /**
     * @Route("/", name="accueil")
     */
    public function index(JobsRepository $JobsRepository,CategoriesRepository $CategoriesRepository, EntityManagerInterface $em): Response
    {
        // return $this->render('accueil/index.html.twig', [
        //     'controller_name' => 'AccueilController',
        // ]);


        $categories = $CategoriesRepository->findAll();
            

        $jobs = $JobsRepository->findBy([], ['updated'=>'DESC','category'=>'ASC'], 10);
        $arraycat = array();
        foreach($jobs as $job){
            // Si pas dans le tableau, recupérer le nom de la catégorie recherchée
            if(!in_array($job->getCategory()->getNom(),$arraycat)){
                $arraycat[]=$job->getCategory()->getNom();
            }
        }
            return $this->render('accueil/index.html.twig', [
            'jobs' => $jobs,
            'categos'=> $arraycat
        ]);
    }
}