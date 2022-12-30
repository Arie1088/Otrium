<?php


namespace App\Controller;


use App\Infra\RequestCounterInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

class MainController extends AbstractController
{
    public function index(RequestCounterInterface $requestCounter)
    {
        return new JsonResponse([
           'calls' => $requestCounter->increase()
        ]);
    }
}