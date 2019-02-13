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
    //### ANONYMOUS ####/

    /**
     * @Route("/anon/login", name="login")
     */
    public function login(UserRepository $userRepository)
    {
        //
    }

    /**
     * @Route("/anon/signup", name="signup")
     */
    public function signup(UserRepository $userRepository)
    {
        //
    }

    //### ROLE_USER ####/

    /**
     * @Route("/user/update", name="user_update")
     */
    public function userUpdate(UserRepository $userRepository)
    {
        //
    }

    /**
     * @Route("/user/delete", name="user_delete")
     */
    public function userDelete(UserRepository $userRepository)
    {
        //
    }

    //### ROLE_ADMIN ####/

    /**
     * @Route("/admin/user/list", name="admin_user_list")
     */
    public function adminUserList(UserRepository $userRepository)
    {
        //
    }

    /**
     * @Route("/admin/user/create", name="admin_user_create")
     */
    public function adminUserCreate(UserRepository $userRepository)
    {
        //
    }

    /**
     * @Route("admin/user/read/{id}", name="admin_user_read")
     */
    public function adminUserRead(UserRepository $userRepository)
    {
        //
    }

    /**
     * @Route("admin/user/update/{id}", name="admin_user_update")
     */
    public function adminUserUpdate(UserRepository $userRepository)
    {
        //
    }

    /**
     * @Route("admin/user/delete/{id}", name="admin_user_delete")
     */
    public function adminUserDelete(UserRepository $userRepository)
    {
        //
    }

}
