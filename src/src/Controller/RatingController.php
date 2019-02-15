<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\RatingRepository;
use App\Entity\Rating;
use App\Entity\Conference;
use App\Form\RatingType;

class RatingController extends AbstractController
{
    //### ROLE_USER ####/

    /**
     * @Route("/rating/create/{conf_id}/{value}", name="rating_create")
     */
    public function ratingCreate(Conference $conference)
    {
        $rating = new Rating();
        $rating->setUser($this->getUser());
        $rating->setConference($conference);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($rating);
        $entityManager->flush();

        return $this->redirectToRoute('conference_read', array('id' => $conference->getId()));
    }
}
