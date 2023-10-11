<?php

namespace App\Controller\Platform\Staff\Ajax;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/checkupmoment', name: 'checkupmoment_')]
class CheckupmomentController extends AbstractController
{
    #[Route('/create', name: 'create', methods: ['POST'])]
    public function create(Response $response): JsonResponse {

    }
}