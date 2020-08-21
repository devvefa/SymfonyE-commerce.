<?php

namespace App\Controller;

use App\Entity\Orders;
use App\Form\OrdersType;
use App\Repository\Admin\CategoryRepository;
use App\Repository\Admin\SettningRepository;
use App\Repository\OrdersRepository;
use App\Repository\ShopcartRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/orders")
 */
class OrdersController extends AbstractController
{
    /**
     * @Route("/", name="orders_index", methods={"GET"})
     */
    public function index(OrdersRepository $ordersRepository): Response
    {
    //    $setSite= $settningrepository->findAll();
        //$catlist=$categoryrepository->findby(['parent_id'=>0]);
       // $cats=$this->catgorytree();

        //$cats[0]='<ul id="menu-v">';
    return $this->render('orders/index.html.twig', [
            'orders' => $ordersRepository->findAll(),
            //'setSite' =>  $setSite,
           // 'catlist' =>$catlist

        ]);
    }

    /**
     * @Route("/new", name="orders_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
    //----------
         //$setSite= $settningrepository->findAll();
      //   $catlist=$categoryrepository->findby(['parent_id'=>0]);

        $orders = new Orders();
        $form = $this->createForm(OrdersType::class, $orders);
        $form->handleRequest($request);

       // $user=$this->getUser();
       // $userid=$user->getid();
      //  $total=$shopcartrepository->toplam($userid);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
          //  $orders->setUserid($userid);
           // $orders->setAmount($total);

            $entityManager->persist($orders);
            $entityManager->flush();




            return $this->redirectToRoute('orders_index');
        }

        return $this->render('orders/index.html.twig', [
            'orders' => $orders,
            'form' => $form->createView(),
        ]);
    }



    /**
     * @Route("/{id}", name="orders_show", methods={"GET"})
     */
    public function show(Orders $order): Response
    {
        return $this->render('orders/show.html.twig', [
            'order' => $order,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="orders_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Orders $order): Response
    {
        $form = $this->createForm(OrdersType::class, $order);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('orders_index');
        }

        return $this->render('orders/edit.html.twig', [
            'order' => $order,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="orders_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Orders $order): Response
    {
        if ($this->isCsrfTokenValid('delete'.$order->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($order);
            $entityManager->flush();
        }

        return $this->redirectToRoute('orders_index');
    }
}
