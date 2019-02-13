<?php
/**
 * Created by PhpStorm.
 * User: aminejerbouh
 * Date: 10/01/2019
 * Time: 11:16
 */

namespace App\Manager;


use App\Entity\User;
use App\Repository\UserRepository;

class UserManager
{
    private $userRepository;
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param string $email
     * @return User|null
     */
    public function getUserByEmail(string $email): ?User
    {
        return $this->userRepository->findOneBy(['email' => $email]);
    }

    public function getUserByFirstname(string $firstname): ?array
    {
        return $this->userRepository->findBy(['firstname' => $firstname], ['mail' => 'ASC']);
    }

    public function getUserById(int $id): ?User
    {
        return $this->userRepository->find($id);
    }
}