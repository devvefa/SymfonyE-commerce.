<?php

namespace App\Controller\Admin;

use App\Entity\Admin\Settning;
use App\Form\Admin\SettningType;
use App\Repository\Admin\SettningRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/settning")
 */
class SettningController extends AbstractController
{
    /**
     * @Route("/", name="admin_settning_index", methods={"GET"})
     */
    public function index(SettningRepository $settningRepository): Response
    {
        $setdate= $settningRepository->findAll();

        if(!$setdate)
        {
           // echo "data bos";
          //  die();

            $settning = new Settning();
            $entityManager = $this->getDoctrine()->getManager();
            $settning->setTitle("Test");
            $entityManager->persist($settning);
            $entityManager->flush();

            $setdate= $settningRepository->findAll();

           // dump($setdate);
            //die();

        }
        return $this->redirectToRoute('admin_settning_edit',['id'=>$setdate[0]->getId()]);

    }

    /**
     * @Route("/new", name="admin_settning_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $settning = new Settning();
        $form = $this->createForm(SettningType::class, $settning);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($settning);
            $entityManager->flush();


            return $this->redirectToRoute('admin_settning_index',['id' => $settning->getId()]);
        }

        return $this->render('admin/settning/new.html.twig', [
            'settning' => $settning,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin_settning_show", methods={"GET"})
     */
    public function show(Settning $settning): Response
    {
        return $this->render('admin/settning/show.html.twig', [
            'settning' => $settning,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="admin_settning_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Settning $settning): Response
    {
        $form = $this->createForm(SettningType::class, $settning);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success','Ayarlar Güncellme İşlemi ');
            return $this->redirectToRoute('admin_settning_index');
        }

        return $this->render('admin/settning/edit.html.twig', [
            'settning' => $settning,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin_settning_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Settning $settning): Response
    {
        if ($this->isCsrfTokenValid('delete'.$settning->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($settning);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_settning_index');
    }
}
