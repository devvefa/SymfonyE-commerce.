<?php

namespace App\Controller;

use App\Entity\OrderDetails;
use App\Entity\Orderses;
use App\Form\OrdersesType;
use App\Repository\Admin\CategoryRepository;
use App\Repository\OrderDetailsRepository;
use App\Repository\OrdersesRepository;
use App\Repository\ShopcartRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/orderses")
 */
class OrdersesController extends AbstractController
{
    /**
     * @Route("/", name="orderses_index", methods={"GET"})
     */
    public function index(CategoryRepository $categoryrepository,OrdersesRepository $ordersesRepository): Response
    {
        $catlist=$categoryrepository->findby(['parent_id'=>0]);
        $user = $this->getUser();
        $kuserid = $user->getid();

        $ord=$ordersesRepository->findBy(['userid'=>$kuserid]);

        return $this->render('orderses/index.html.twig', [
          //  'orderses' => $ordersesRepository->findAll(),
            'catlist' => $catlist,
            'ord' => $ord
        ]);
    }

    /**
     * @Route("/new", name="orderses_new", methods={"GET","POST"})
     */
    public function new(Request $request ,ShopcartRepository $shopcartrepository): Response
    {
        $orderse = new Orderses();
        $form = $this->createForm(OrdersesType::class, $orderse);
        $form->handleRequest($request);
/////*------------------
        // üründetayı sorgusu olustur  dışarı gönder..
        //
        // ----------------------,
        $user = $this->getUser();
        $userid = $user->getid();
        $total = $shopcartrepository->toplam($userid);
        $submittedToken = $request->request->get('token');
        if ($this->isCsrfTokenValid('form-orderses',$submittedToken)) {

            if ($form->isSubmitted() ) {
                $entityManager = $this->getDoctrine()->getManager();
                $orderse->setUserid($userid);
                $orderse->setAmount($total);
                $orderse->setStatus("NEW");
                $entityManager->persist($orderse);
                $entityManager->flush();
                $orderid=$orderse->getId();
                $shopcart=$shopcartrepository->getusershopcart($userid);
                foreach ($shopcart as $item) {
                    $orderdetail = new OrderDetails();
                    $orderdetail->setOrderid($orderid);
                    $orderdetail->setUserid($userid);
                    $orderdetail->setProductid($item["id"]);
                    $orderdetail->setPrice($item["sprice"]);
                    $orderdetail->setQuantity($item["quantity"]);
                    $orderdetail->setAmount($item["total"]);
                    $orderdetail->setName($item["title"]);
                    $orderdetail->setStatus("ordered");
                    $entityManager->persist($orderdetail);
                    $entityManager->flush();
                }
                /// shopcart'ı sil
                $entityManager = $this->getDoctrine()->getManager();
                $query=$entityManager->createQuery('DELETE FROM App\Entity\Shopcart s where s.userid='.$userid);
                $query->execute();
                $this->addFlash('success','Siparişiniz başarıyla GErçekleşti ');

                return $this->redirectToRoute('orderses_index');
            }
        }
            return $this->render('orderses/new.html.twig', [
                'orderse' => $orderse,
                'total'=>$total,
                'form' => $form->createView(),
            ]);
        }

    /**
     * @Route("/{id}", name="orderses_show", methods={"GET"})
     */
    public function show($id,CategoryRepository $categoryrepository, Orderses $orderse,OrderDetailsRepository $orderdetailsrepository): Response
    {

        $catlist=$categoryrepository->findby(['parent_id'=>0]);


        $orderid=$orderse->getid();
        $orderdet =$orderdetailsrepository->findBy(['orderid'=>$orderid]);

        return $this->render('orderses/show.html.twig', [
            'orderse' => $orderse,
            'orderdet' => $orderdet,
            'catlist' => $catlist,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="orderses_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Orderses $orderse): Response
    {
        $form = $this->createForm(OrdersesType::class, $orderse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('orderses_index');
        }

        return $this->render('orderses/edit.html.twig', [
            'orderse' => $orderse,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="orderses_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Orderses $orderse): Response
    {
        if ($this->isCsrfTokenValid('delete'.$orderse->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($orderse);
            $entityManager->flush();
        }

        return $this->redirectToRoute('orderses_index');
    }
}
