<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\UserRepository;
use App\Entity\User;
// use App\Form\UserType;

class UserController extends AbstractController
{
    //### ROLE_USER ####/

    /**
     * @Route("/user/profile", name="user_profile")
     */
    public function userProfile(UserRepository $userRepository)
    {
        $currentUser = $this->getUser();
        return $this->render('user/profile.html.twig', [
            'user' => $currentUser,
        ]);
    }
    
    /**
     * @Route("/user/read/{id}", name="user_read")
     */
    public function userRead(User $user)
    {
        return $this->render('user/profile.html.twig', [
            'user' => $user,
        ]);
    }

    //### ROLE_ADMIN ####/

    /**
     * @Route("/admin/user/list", name="admin_user_list")
     */
    public function adminUserList(UserRepository $userRepository)
    {
        $users = $userRepository->findAll();

        return $this->render('user/list.html.twig', [
            'users' => $users,
        ]);
    }

}
