<?php

namespace App\Command;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class CreateAdminCommand extends Command
{
    protected static $defaultName = 'app:create-admin';
    private $entityManager;
    private $encoder;

    public function __construct(EntityManagerInterface $entityManager, UserPasswordEncoderInterface $userPasswordEncoder)
    {
        $this->entityManager = $entityManager;
        $this->encoder = $userPasswordEncoder;
        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setDescription('Create a new admin user with password')
            ->addArgument('mail', InputArgument::REQUIRED, 'new email')
            ->addArgument('password', null, InputOption::VALUE_NONE, 'password')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $email = $input->getArgument('mail');
        $password = $input->getArgument('password');
        $io->note(sprintf('Create a User for email: %s | password: %s', $email, $password));

        $user = new User();
        $user->setmail($email);
        $encodedPassword = $this->encoder->encodePassword($user, $password);
        $user->setPassword($encodedPassword);
        $user->setRoles(['ROLE_USER', 'ROLE_ADMIN']);

        $this->entityManager->persist($user);
        $this->entityManager->flush();


        $io->success(sprintf('You have created a new User with the email: %s', $email));
    }
}
