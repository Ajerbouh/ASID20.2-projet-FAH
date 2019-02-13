<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\ConferenceRepository;
use App\Entity\Conference;
// use App\Form\ConferenceType;


class ConferenceController extends AbstractController
{
    //### ROLE_conference ####/

    /**
     * @Route("/conf/list/rated", name="conf_list_rated")
     */
    public function confListRated(ConferenceRepository $confRepository)
    {
        //
    }

    /**
     * @Route("/conf/list/unrated", name="conf_list_unrated")
     */
    public function confListUnrated(ConferenceRepository $confRepository)
    {
        //
    }

    /**
     * @Route("/conf/read/{id}", name="conf_read")
     */
    public function confRead(ConferenceRepository $confRepository)
    {
        //
    }

    //### ROLE_ADMIN ####/

    /**
     * @Route("/admin/conference/create", name="admin_conference_create")
     */
    public function adminConferenceCreate(conferenceRepository $conferenceRepository)
    {
        //
    }

    /**
     * @Route("admin/conference/read/{id}", name="admin_conference_read")
     */
    public function adminConferenceRead(conferenceRepository $conferenceRepository)
    {
        //
    }

    /**
     * @Route("admin/conference/update/{id}", name="admin_conference_update")
     */
    public function adminConferenceUpdate(conferenceRepository $conferenceRepository)
    {
        //
    }

    /**
     * @Route("admin/conference/delete/{id}", name="admin_conference_delete")
     */
    public function adminConferenceDelete(conferenceRepository $conferenceRepository)
    {
        //
    }
}
