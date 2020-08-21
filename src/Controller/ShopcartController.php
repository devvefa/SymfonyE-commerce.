<?php

namespace App\Controller;

use App\Entity\Shopcart;
use App\Form\ShopcartType;
use App\Repository\Admin\CategoryRepository;
use App\Repository\Admin\ProductRepository;
use App\Repository\Admin\SettningRepository;
use App\Repository\ShopcartRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/shopcart")
 */
class ShopcartController extends AbstractController
{
    /**
     * @Route("/", name="shopcart_index", methods={"GET"})
     */

    public function index(ProductRepository$productrepository, CategoryRepository $categoryrepository,SettningRepository $settningrepository, ShopcartRepository $shopcartRepository): Response
    {


        $setSite= $settningrepository->findAll();
        $catlist=$categoryrepository->findby(['parent_id'=>0]);


        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user=$this->getUser();

        //$data= $productrepository->findAll();


        $em=$this->getDoctrine()->getManager();
        $sql="select p.*,s.*from shopcart s, product p   where s.productid=p.id  
       and s.userid=".$user->getid();

        $statement=$em->getconnection()->prepare($sql);
        $statement->bindvalue('userid',$user->getid());
        $statement->execute();
        $shopcart=$statement->fetchAll();





     //   $cats=$this->catgorytree();
      //  $cats[0]='<ul id="menu-v">';

        return $this->render('shopcart/index.html.twig', [
            'setSite'=>$setSite,
            'catlist' => $catlist,
        //    'cats' => $cats,
           // 'data' => $data,
            'shopcarts' => $shopcart,
        ]);
    }

    /**
     * @Route("/new", name="shopcart_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $shopcart = new Shopcart();
        $form = $this->createForm(ShopcartType::class, $shopcart);
        $form->handleRequest($request);

        $submittedToken=$request->request->get('token');

     //   if ($this->isCsrfTokenValid('add-item',$submittedToken)){

            if ($form->isSubmitted()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($shopcart);
            $entityManager->flush();

            return $this->redirectToRoute('shopcart_index');
        }
    //}

        return $this->render('shopcart/new.html.twig', [
            'shopcart' => $shopcart,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="shopcart_show", methods={"GET"})
     */
    public function show(Shopcart $shopcart): Response
    {
        return $this->render('shopcart/show.html.twig', [
            'shopcart' => $shopcart,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="shopcart_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Shopcart $shopcart): Response
    {
        $form = $this->createForm(ShopcartType::class, $shopcart);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('shopcart_index');
        }

        return $this->render('shopcart/edit.html.twig', [
            'shopcart' => $shopcart,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="shopcart_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Shopcart $shopcart): Response
    {
        if ($this->isCsrfTokenValid('delete'.$shopcart->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($shopcart);
            $entityManager->flush();
        }

        return $this->redirectToRoute('shopcart_index');
    }
}
