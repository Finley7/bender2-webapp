<?php

namespace App\Controller\Platform\Staff;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    #[Route('/login', name: 'security_login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        return $this->render('platform/staff/security/login.html.twig', [
            'lastUsername' => $authenticationUtils->getLastUsername(),
            'lastError' => $authenticationUtils->getLastAuthenticationError()
        ]);
    }
}