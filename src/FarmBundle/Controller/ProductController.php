<?php

namespace FarmBundle\Controller;

use FarmBundle\Entity\Image;
use FarmBundle\Entity\Product;

use FarmBundle\Form\ProductType;
use FarmBundle\Form\ImageType;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ProductController extends Controller
{
    /**
    *
    */
    public function addImageAction($productId, Request $request)
    {
//        $this->denyAccessUnlessGranted("ROLE_FARMER");
//
//        $currentUser = $this->getUser();
//
//        dump($currentUser);
//        die();

        // on recupere le produit en bdd pour pouvoir l'associer a notre nouvelle image
        $productRepository = $this->getDoctrine()->getRepository("FarmBundle:Product");
        $product = $productRepository->find($productId);

        if($this->getUser() != null){
            $currentUser = $this->getUser();
            if ($currentUser != $product->getUser()){
                throw $this->createAccessDeniedException();
            }
        } else {
            return $this->redirectToRoute("login");
        }

        $image = new Image();
        $image->setProduct($product);
        $imageForm = $this->createForm(ImageType::class, $image);

        $imageForm->handleRequest($request);



        if ($imageForm->isSubmitted() && $imageForm->isValid()) {
            $filename = uniqid() . "." . $image->getFile()->guessExtension();
            $image->setFilename($filename);

            //on recupere le parametre défini dans app/parameter.yml
            $uploadDir = $this->getParameter("upload_dir");

            //deplace le fichier temporaire vers notre dossier d'uploads
            $simpleImage = new \claviska\SimpleImage();

            $simpleImage->fromFile($image->getFile()->getRealPath())
                  ->bestFit(300, 300)
                  ->toFile($uploadDir . "/" . $filename, "image/jpeg", 90);

            //sauvegarde l'image en bdd
            $em = $this->getDoctrine()->getManager();
            $em->persist($image);
            $em->flush();

            //on redirige vers ici même pour vider le formulaire et afficher le flash
            // et permettre au user d'uploader une autre image
            $this->addFlash("success", "Votre fichier a bien été ajouté !");
            return $this->redirectToRoute("add_image", ["productId" => $productId]);
        }

        return $this->render('FarmBundle:Product:add_image.html.twig', [
            "imageForm" => $imageForm->createView()
        ]);
    }

    public function addAction(Request $request)
    {
        // Créer une instance vide qui sera associée au formulaire
        $product = new Product();
        // récupére l'utilisateur connecter
        $currentUser = $this->getUser();
        //hydrate la propriété qui n'est pas dans le form
        $product->setDateCreated(new \DateTime);
        $product->setUser($currentUser);
        //crée le form, tout en l'associant a notre instance vide
        $productForm = $this->createForm(ProductType::class, $product);

        //prend les données du form soumises dans la requête
        //et l'hydrate dans notre instance vide
        // si le form n'est pas soumis sa ne fait rien
        $productForm->handleRequest($request);

        // le formulaire est soumis
        if ($productForm->isSubmitted() && $productForm->isValid()) {
          $em = $this->getDoctrine()->getManager();
          $em->persist($product);
          $em->flush();

          //crée un message qui s'affiche sur la page suivante
          $this->addFlash("success", "Votre produit à bien été enregistrer !");

          //redirige vers la page d'ajout d'image
          return $this->redirectToRoute("add_image", ["productId" => $product->getId()]);
        }

        return $this->render('FarmBundle:Product:add.html.twig', array('productForm' => $productForm->createView()));
    }

    public function catalogAction(Request $request)
    {
        $idCategory = $request->query->get("cat");

        //recupere le repository des products
        $productRepository = $this->getDoctrine()->getRepository("FarmBundle:Product");
        $productFromDB = $productRepository->findCatalogProducts($idCategory);

        // recupere toute les catégories pour les affichers dans le formulaire de filtre
        $categoryRepository = $this->getDoctrine()->getRepository("FarmBundle:Category");
        $categories = $categoryRepository->findAll();

        return $this->render('FarmBundle:Product:catalog.html.twig', array('products' => $productFromDB,
                                                                                 'categories' => $categories));
    }

    public function detailAction($id)
    {
        $productRepository = $this->getDoctrine()->getRepository("FarmBundle:Product");
        $productFromDB = $productRepository->findOneById($id);

        return $this->render('FarmBundle:Product:detail.html.twig', array('product' => $productFromDB));
    }

}
