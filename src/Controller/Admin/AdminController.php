<?php

namespace App\Controller\Admin;

use App\Entity\Orderses;
use App\Repository\OrderDetailsRepository;
use App\Repository\OrdersesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index()
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }


    /**
     * @Route("/orders/{slug}", name="admin_orders_index")
     */
    public function orders($slug, OrdersesRepository $ordersesRepository)
    {
        $orders = $ordersesRepository->findBy(['status' => $slug]);
        return $this->render('admin/orders/index.html.twig', [
            'orders' => $orders,
        ]);
    }

    /**
     * @Route("orders/show/{id}", name="admin_orders_show",methods={"GET"})
     */
    public function show($id, Orderses $orderses, OrderDetailsRepository $orderDetailsRepository): Response
    {

        $orderdetail = $orderDetailsRepository->findBy(['orderid' => $id]);

        return $this->render('admin/orders/show.html.twig', [
            'orderse' => $orderses,
            'orderdetail' => $orderdetail
        ]);
    }

    /**
     * @Route("order/{id}/update", name="admin_orders_update",methods="POST")
     */
    public function order_update($id, Orderses $orderses, Request $request): Response
    {
        $em = $this->getDoctrine()->getManager();

        $sql = "UPDATE Orderses  SET shipinfo=:shipinfo,note=:note, status=:status WHERE id=:id";

        $statement = $em->getconnection()->prepare($sql);

        $statement->bindvalue('shipinfo', $request->request->get('shipinfo'));
        $statement->bindvalue('note', $request->request->get('note'));
        $statement->bindvalue('status', $request->request->get('status'));
        $statement->bindvalue('id', $id);

        $statement->execute();

        $this->addFlash('success', 'Değişiklikler kaydedildi ');

///--------------------


        return $this->redirectToRoute('admin_orders_show', array('id' => $id));

    }




}
