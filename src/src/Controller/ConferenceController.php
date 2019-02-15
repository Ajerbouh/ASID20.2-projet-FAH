<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\ConferenceRepository;
use App\Entity\Conference;
use App\Form\ConferenceType;

class ConferenceController extends AbstractController
{
    //### ROLE_USER ####/

    /**
     * @Route("/conference/list/rated", name="conference_list_rated")
     * @param ConferenceRepository $conferenceRepository
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function conferenceListRated(ConferenceRepository $conferenceRepository)
    {
        $conferences = $conferenceRepository->findRated();

        return $this->render('conference/list.html.twig', [
            'conferences' => $conferences,
            'title'       => 'Rated Conferences',
        ]);
    }

    /**
     * @Route("/conference/list/unrated", name="conference_list_unrated")
     * @param ConferenceRepository $conferenceRepository
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function conferenceListUnrated(ConferenceRepository $conferenceRepository)
    {
        $conferences = $conferenceRepository->findUnrated();
        
        return $this->render('conference/list.html.twig', [
            'conferences' => $conferences,
            'title'       => 'Unrated Conferences',
        ]);
    }

    /**
     * @Route("/conference/search/{keyword}", name="conference_search")
     * @param ConferenceRepository $conferenceRepository
     * @param string $keyword
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function conferenceSearch(ConferenceRepository $conferenceRepository, string $keyword)
    {
        $conferences = $conferenceRepository->searchKeyword($keyword);
        
        return $this->render('conference/list.html.twig', [
            'conferences' => $conferences,
            'title' => "Search result for '".$keyword."'",
        ]);
    }

    /**
     * @Route("/conference/read/{id}", name="conference_read")
     * @param Conference $conference
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function id(Conference $conference)
    {
        return $this->render('conference/read.html.twig', [
            'conference' => $conference,
        ]);
    }

    //### ROLE_ADMIN ####/

    /**
     * @Route("/admin/conference/create", name="admin_conference_create")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function adminConferenceCreate(Request $request)
    {
        $conference = new Conference();
        $form = $this->createForm(ConferenceType::class, $conference);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($conference);
            $entityManager->flush();

            return $this->redirectToRoute('conference_read', array('id' => $conference->getId()) );
        }

        return $this->render('conference/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/conference/read/{id}", name="admin_conference_read")
     * @param Conference $conference
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function adminConferenceRead(Conference $conference)
    {
        return $this->render('conference/read.html.twig', [
            'conference' => $conference,
        ]);
    }

    /**
     * @Route("/admin/conference/update/{id}", name="admin_conference_update")
     * @param Request $request
     * @param Conference $conference
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function adminConferenceUpdate(Request $request, Conference $conference)
    {
        $form = $this->createForm(ConferenceType::class, $conference);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($conference);
            $entityManager->flush();
//to
            return $this->redirectToRoute('conference_read', ['id', $conference->getId()]);
        }

        return $this->render('conference/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }


    // TODO: test if the foreach's flush is needed

    /**
     * @Route("/admin/conference/delete/{id}", name="admin_conference_delete")
     * @param Conference $conference
     * @param EntityManagerInterface $entityManager
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function adminConfDelete(Conference $conference, EntityManagerInterface $entityManager)
    {
        foreach($conference->getRatings() as $rating) {

            $entityManager->remove($rating); 

        }
        $entityManager->flush();
        
        $entityManager->remove($conference);
        $entityManager->flush();

        return $this->redirectToRoute('home');
    }
}
