<?php

namespace App\Controller;

use App\Repository\StreamerRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/", name="home_app")
     */
    public function index(StreamerRepository $streamerRepository): Response
    {
        return $this->render('home/index.html.twig', [
            'streamer' => $streamerRepository->findAll(),
        ]);
    }

    /**
     * @Route("/every_streamer", name="every_streamer_app")
     */
    public function showEveryStreamer(StreamerRepository $streamerRepository): Response
    {
        return $this->render('home/every_streamer.html.twig', [
            'streamer' => $streamerRepository->findAll(),
        ]);
    }

    /**
     * @Route("/streamer{id}", name="streamer_app")
     */
    public function showStreamer(): Response
    {
        return $this->render('home/streamer.html.twig', [
        ]);
    }
}
