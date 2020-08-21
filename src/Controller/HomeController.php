<?php

namespace App\Controller;

use App\Controller\Admin\KullaniciController;
use App\Entity\Admin\Messages;
use App\Entity\Kullanici;
use App\Form\Admin\MessagesType;
use App\Form\KullaniciType;
use App\Repository\Admin\CategoryRepository;
use App\Repository\Admin\ImageRepository;
use App\Repository\Admin\ProductRepository;
use App\Repository\Admin\SettningRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(SettningRepository $settningrepository ,CategoryRepository $categoryrepository)
    {
        $setSite= $settningrepository->findAll();
        $catlist=$categoryrepository->findby(['parent_id'=>0]);
        $cats=$this->catgorytree();

        $cats[0]='<ul id="menu-v">';

        $em=$this->getDoctrine()->getManager();

        ///bu sql  kategoriye gore asıralarız
        /// SELECT * FROM product WHERE  categor_id =3 and status='True' ORDER BY id desc LIMIT 3
        $sql="SELECT * FROM product WHERE status='True' ORDER BY id desc LIMIT 3";

        $statement=$em->getconnection()->prepare($sql);

        $statement->execute();

        $contproducts=$statement->fetchAll();
///--------------------

        $em=$this->getDoctrine()->getManager();

        $sqlqqq="SELECT * FROM slids WHERE status='True' ORDER BY id desc LIMIT 5";

        $statement=$em->getconnection()->prepare($sqlqqq);

        $statement->execute();

        $sliders=$statement->fetchAll();



        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'setSite' => $setSite,
            'catlist' => $catlist,
            'cats' => $cats,
            'sliders' => $sliders,
            'contproducts' => $contproducts

        ]);
    }



    /**
     * @Route("/hakkimizda", name="hakkimizda")
     */
    public function hakkimizda(CategoryRepository $categoryrepository, SettningRepository $settningrepository)
    {
        $catlist=$categoryrepository->findby(['parent_id'=>0]);


        $setSite= $settningrepository->findAll();
        return $this->render('home/hakkimizda.html.twig', [
            'setSite' => $setSite,
            'catlist' => $catlist,
            'setSite'=>$setSite,
        ]);
    }

    /**
     * @Route("/ref", name="ref")
     */
    public function ref(CategoryRepository $categoryrepository,SettningRepository $settningrepository)
    {
        $catlist=$categoryrepository->findby(['parent_id'=>0]);

        $setSite= $settningrepository->findAll();
        return $this->render('home/ref.html.twig', [
            'setSite' => $setSite,

            'catlist' => $catlist,
        ]);
    }

    /**
     * @Route("/iletisim", name="iletisim",methods={"GET","POST"})
     */
    public function iletisim(Request$request,CategoryRepository $categoryrepository,SettningRepository $settningrepository)
    {
        $catlist=$categoryrepository->findby(['parent_id'=>0]);

        $message = new Messages();
        $form = $this->createForm(MessagesType::class, $message);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($message);
            $entityManager->flush();
            $this->addFlash('success','Message Gönderilmiştir');

            return $this->redirectToRoute('iletisim');
        }
        $setSite= $settningrepository->findAll();
        return $this->render('home/iletisim.html.twig', [
            'setSite' => $setSite,
            'catlist' => $catlist,
            'message' => $message,


        ]);
    }




    public function catgorytree($parent=0,$user_tree_array='')
    {
        if(!is_array($user_tree_array))
            $user_tree_array=array();
        $em=$this->getDoctrine()->getManager();
        $sql="SELECT * FROM category WHERE status='True' AND parent_id=".$parent;

        $statement=$em->getconnection()->prepare($sql);
        $statement->execute();
        $result=$statement->fetchAll();

        if(count($result)>0){
            $user_tree_array[]="<ul>";
            foreach ($result as $row){
                $user_tree_array[]="<li> <a href='/category/".$row['id']."'>".$row['title']."</a>";
                $user_tree_array=$this->catgorytree($row['id'],$user_tree_array);
            }
            $user_tree_array[]="</li></ul>";
        }
        return $user_tree_array;
    }




    /**
     * @Route("/category/{catid}", name="category_products")
     */
    public function CategoryProducts( SettningRepository $settningrepository, $catid,CategoryRepository $categoryrepository )
    {

        $cats_is=$categoryrepository->findBy(['id'=>$catid]);
        $catlist=$categoryrepository->findby(['parent_id'=>0]);
        $setSite= $settningrepository->findAll();

        $cats=$this->catgorytree();
        $cats[0]='<ul id="menu-v">';
        //
        $em=$this->getDoctrine()->getManager();

        $sql="SELECT * FROM product WHERE status='True' AND categor_id=".$catid;

        $statement=$em->getconnection()->prepare($sql);
        $statement->bindvalue('catid',$catid);
        $statement->execute();
        $products=$statement->fetchAll();

        return $this->render('home/products.html.twig', [
            '$cats_is' => $cats_is,
            'products' => $products,
            'catlist' => $catlist,
            'cats' => $cats,
            'setSite'=>$setSite,
        ]);
    }



    /**
     * @Route("/products_det/{urn}", name="products_det", methods={"GET","POST"})
     */
    public function product_detail(CategoryRepository $categoryrepository,$urn,ProductRepository $productRepository,imageRepository $imageRepository )
    {

        $data=$productRepository->findby(['id'=>$urn]);

        $images=$imageRepository->findby(['product_id'=>$urn]);
        //dump($images);
       // die();
        $catlist=$categoryrepository->findby(['parent_id'=>0]);
        $cats=$this->catgorytree();
        $cats[0]='<ul id="menu-v">';




       // $shopcart = new Shopcart();



        return $this->render('home/products_det.html.twig', [
            'data' => $data,
            'images' => $images,
            'cats' => $cats,
            'catlist' => $catlist,
            //'shopcart' => $shopcart,
            //'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("/newuser", name="new_user", methods={"GET","POST"})
     */
    public function newuser(Request $request): Response
    {


    //    $catlist = $categoryrepository->findby(['parent_id' => 0]);


        $kullanici = new Kullanici();
        $form = $this->createForm(KullaniciType::class, $kullanici);
        $form->handleRequest($request);


        $submittedToken = $request->request->get('rtoken');
        if ($this->isCsrfTokenValid('kullanici-form', $submittedToken)) {




            if ($form->isSubmitted() && $form->isValid()) {
                $entityManager = $this->getDoctrine()->getManager();
                //  $kullanici = setRoles("ROLE_USER");
                // $kullanici = setStatus("True");
                $entityManager->persist($kullanici);
                $entityManager->flush();
                $this->addFlash('success', 'Üye Kaydınız başarıyla gerçekleşmiştir ');

                return $this->redirectToRoute('login');
            }

        }
            return $this->render('home/newuser.html.twig', [
                'kullanici' => $kullanici,
                'form' => $form->createView(),
            ]);
        }





}
