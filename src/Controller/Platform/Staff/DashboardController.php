<?php

namespace App\Controller\Platform\Staff;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractController
{
    #[Route('/', name: 'dashboard')]
    public function dashboard() {

        return $this->render('platform/staff/dashboard.html.twig');
    }
}