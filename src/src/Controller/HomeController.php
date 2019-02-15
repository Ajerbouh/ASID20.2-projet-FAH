<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\HttpFoundation\Request;
use App\Repository\ConferenceRepository;
use App\Entity\Conference;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(ConferenceRepository $conferenceRepository)
    {
        return $this->page($conferenceRepository, 0);
    }

    /**
     * @Route("/page/{numPage}", name="page")
     */
    public function page(ConferenceRepository $conferenceRepository, int $numberPage)
    {
        $numberPerPage = 10;
        /*
        $offset = ($numPage * $numberPerPage);
        
        $conferences = $conferenceRepository->findBy(
            array(),
            null,
            $numberPerPage,
            $offset
        );
        */
        $conferences = $conferenceRepository->findPage( $numberPerPage, $numberPage, $this->getUser()->getId() );
        
        // echo '<pre>';
        // var_dump($conferences);
        // echo '</pre>';
        
        // TODO : check if next or previous page exist
        return $this->render('home/index.html.twig', [
            'conferences'     => $conferences,
            'numPagePrevious' => $numberPage - 1,
            'numPage'         => $numberPage,
            'numPageNext'     => $numberPage + 1,
        ]);
    }
}
