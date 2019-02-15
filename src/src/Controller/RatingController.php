<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\RatingRepository;
use App\Entity\Rating;
// use App\Form\RatingType;

class RatingController extends AbstractController
{
    //### ROLE_USER ####/

    /**
     * @Route("/rating/create", name="ratig_create")
     */
    public function ratingCreate(RatingRepository $confRepository)
    {
        //
    }
    
    //### ROLE_ADMIN ####/

    /**
     * @Route("admin/rating/read/{id}", name="admin_rating_read")
     */
    public function adminRatingRead(ratingRepository $ratingRepository)
    {
        //
    }

    /**
     * @Route("admin/rating/update/{id}", name="admin_rating_update")
     */
    public function adminRatingUpdate(ratingRepository $ratingRepository)
    {
        //
    }

    /**
     * @Route("admin/rating/delete/{id}", name="admin_rating_delete")
     */
    public function adminRatingDelete(ratingRepository $ratingRepository)
    {
        //
    }
}
