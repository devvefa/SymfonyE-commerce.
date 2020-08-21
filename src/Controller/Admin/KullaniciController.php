<?php

namespace App\Controller\Admin;

use App\Entity\Kullanici;
use App\Form\KullaniciType;
use App\Repository\KullaniciRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("admin/kullanici")
 */
class KullaniciController extends AbstractController
{
    /**
     * @Route("/", name="kullanici_index", methods={"GET"})
     */
    public function index(KullaniciRepository $kullaniciRepository): Response
    {
        return $this->render('admin/kullanici/index.html.twig', [
            'kullanicis' => $kullaniciRepository->findAll(),


        ]);
    }

    /**
     * @Route("/new", name="kullanici_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $kullanici = new Kullanici();
        $form = $this->createForm(KullaniciType::class, $kullanici);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($kullanici);
            $entityManager->flush();

            return $this->redirectToRoute('kullanici_index');
        }

        return $this->render('admin/kullanici/new.html.twig', [
            'kullanici' => $kullanici,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="kullanici_show", methods={"GET"})
     */
    public function show(Kullanici $kullanici): Response
    {
        return $this->render('admin/kullanici/show.html.twig', [
            'kullanici' => $kullanici,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="kullanici_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Kullanici $kullanici): Response
    {
        $form = $this->createForm(KullaniciType::class, $kullanici);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('kullanici_index',[
                    'id' => $kullanici->getId(),]
            );
        }

        return $this->render('admin/kullanici/edit.html.twig', [
            'kullanici' => $kullanici,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="kullanici_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Kullanici $kullanici): Response
    {
        if ($this->isCsrfTokenValid('delete'.$kullanici->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($kullanici);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_kullanici_index');
    }
}
