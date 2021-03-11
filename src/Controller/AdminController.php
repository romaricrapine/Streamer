<?php

namespace App\Controller;

use App\Entity\Streamer;
use App\Entity\Support;
use App\Form\StreamerType;
use App\Repository\StreamerRepository;
use App\Repository\SupportRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/admin", name="admin_app")
     */
    public function index(StreamerRepository $streamerRepository): Response
    {
        return $this->render('admin/index.html.twig', [
            'streamer' => $streamerRepository->findAll(),
        ]);
    }

    /**
     * @Route("/admin/show_streamer/{id}", name="admin_streamer_show")
     */
    public function showStreamer(Streamer $streamer, StreamerRepository $streamerRepository): Response
    {
        return $this->render('admin/showstreamer.html.twig', [
            'stream' => $streamer,
            'streamer' => $streamerRepository->findAll()
        ]);
    }

    /**
     * @Route("/admin/new_streamer", name="admin_streamer_new")
     */
    public function newStreamer(Request $request, StreamerRepository $streamerRepository): Response
    {
        $streamer = new Streamer();
        $form = $this->createForm(StreamerType::class, $streamer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->persist($streamer);
            $this->entityManager->flush();
            $this->addFlash('success', 'Streamer créer avec succès');
            return $this->redirectToRoute('admin_app');
        }
        return $this->render('admin/newstreamer.html.twig', [
            'streamers' => $streamer,
            'form' => $form->createView(),
            'streamer' => $streamerRepository->findAll()
        ]);
    }

    /**
     * @Route("/admin/edit_streamer/{id}", name="admin_streamer_edit")
     */
    public function editStreamer(Streamer $streamer,Request $request, StreamerRepository $streamerRepository)
    {
        $form = $this->createForm(StreamerType::class, $streamer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->flush();
            $this->addFlash('success', 'Streamer modifier avec succès');
            return $this->redirectToRoute('admin_app');
        }

        return $this->render('admin/editstreamer.html.twig', [
            'streamers' => $streamer,
            'form' => $form->createView(),
            'streamer' => $streamerRepository->findAll()
        ]);
    }

    /**
     * @Route("/admin/delete_streamer/{id}", name="admin_streamer_delete")
     */
    public function deleteStreamer(Streamer $streamer, Request $request): Response
    {
        if ($this->isCsrfTokenValid('delete' . $streamer->getId(), $request->get('_token'))) {
            $this->entityManager->remove($streamer);
            $this->entityManager->flush();
            $this->addFlash('success', 'Streamer supprimer avec succès');
        }
        return $this->redirectToRoute('admin_app');
    }
    /**
     * @Route("/admin/support", name="admin_support")
     */
    public function support(SupportRepository $supportRepository, StreamerRepository $streamerRepository): Response
    {
        return $this->render('admin/support.html.twig', [
            'support' => $supportRepository->findAll(),
            'streamer' => $streamerRepository->findAll(),
        ]);
    }

    /**
     * @Route("/admin/support/{id}", name="admin_support_show")
     */
    public function supportShow(Support $support, StreamerRepository $streamerRepository): Response
    {
        return $this->render('admin/supportshow.html.twig', [
            'support' => $support,
            'streamer' => $streamerRepository->findAll(),
        ]);
    }

    /**
     * @Route("/admin/every_streamer", name="admin_every_streamer")
     */
    public function streamerShow(StreamerRepository $streamerRepository): Response
    {
        return $this->render('admin/everystreamer.html.twig', [
            'streamer' => $streamerRepository->findAll(),
        ]);
    }


}
