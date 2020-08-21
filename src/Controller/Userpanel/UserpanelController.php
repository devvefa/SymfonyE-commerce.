<?php

namespace App\Controller\Userpanel;

use App\Entity\Kullanici;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
/**
 * @Route("/userpanel")
 */
class UserpanelController extends AbstractController
{
    /**
     * @Route("/", name="userpanel")
     */
    public function index()
    {

        return $this->render('userpanel/show.html.twig');
    }


    /**
     * @Route("/edit", name="userpanel_edit", methods={"GET","POST"})
     */
    public function edit(Request $request ): Response
    {
        $usersession=$this->getUser();


        $user=$this->getDoctrine()->getRepository(Kullanici::class);
        if($request->isMethod('post')) {
            $submittedToken = $request->request->get('_token');

          //
            if ($this->isCsrfTokenValid('user-form', $submittedToken))
            $user->setName($request->request->get("name"));
            $user->setAddress($request->request->get("Address"));
            $user->setCity($request->request->get("city"));
            $user->setPhone($request->request->get("phone"));
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('userpanel_show');
        }
            return $this->render('userpanel/edit.html.twig',['user'=>$user]);



    }


    /**
     * @Route("/{id}", name="userpanel_show", methods={"GET"})
     */
    public function show(): Response
    {
       return $this->render('userpanel/show.html.twig');


    }


}