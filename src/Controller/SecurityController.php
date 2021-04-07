<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use App\Entity\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="app_login")
     * @param AuthenticationUtils $authenticationUtils
     * @return Response
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
//        if ($this->getUser()) {
//             return $this->redirectToRoute('inicio');
//        }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout()
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }

    /**
     * @Route("/", name="app_inicio")
     * @return Response
     */
    public function inicio(): Response
    {
        return $this->redirectToRoute('app_login');
    }

    /**
     * @Route("/creauser", name="creauser")
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @return Response
     */
    public function creaUser(UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $em = $this->getDoctrine()->getManager();
        $user = new User();
        $user->setUsername('jserrano');
        $user->getNombre('JOSE LUIS SERRANO');
        $user->setPassword($passwordEncoder->encodePassword(
            $user,
            'pruebas'
        ));
        $roles[] = 'ROLE_ADMIN';
        $user->setRoles($roles);
        $em->persist($user);
        $em->flush();


        return new Response();
    }
}
