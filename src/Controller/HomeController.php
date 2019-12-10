<?php

namespace App\Controller;

use App\Entity\Visiteur;
use App\Form\VisiteurType;
use App\Repository\VisiteurRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     * Afficher des tous les visiteurs
     * @Route("/", name="visiteurs_index")
     */
    public function index(VisiteurRepository $repo)
    {
    
        $visiteurs = $repo->findAll();

        return $this->render('index.html.twig', [
           'visiteurs' => $visiteurs
        ]);
    }

    /**
     * Permet de creer un visiteur
     *
     * @Route("/visiteurs/new", name="visiteurs_create")
     * @IsGranted("ROLE_ADMIN")
     * @return Response
     */
    public function create(Request $request, ObjectManager $manager){

        $visiteur = new Visiteur();

        $form = $this->createForm(VisiteurType::class, $visiteur);

        //lien entre le champ du formulaire a la variable $ad
        $form->handleRequest($request);


        //est ce qu'il a eté soumis et valide
        if ($form->isSubmitted() && $form->isValid()) {


           $manager->persist($visiteur); //elle persiste
           $manager->flush(); //pour que la requete parte belle et bien
          
           //message d'alerte de creation d'annonce
           $this->addFlash(
            'success' , "Le visiteur<strong>{$visiteur->getNomVis()}</strong> a bien été enregistrée !"
           );

           return $this->redirectToRoute('show_id', [
               'id' => $visiteur->getId()
           ]);
        }
        return $this->render('visiteur/new.html.twig', [
            'form'=> $form->createView()
        ]);
    }

    /**
     * Permet d'afficher le formulaire d'edition
     * 
     * @Security("is_granted('ROLE_USER') and user === visiteur or is_granted('ROLE_ADMIN')" , message= "Ce profil ne vous appartient pas, vous ne pouvez pas le modifier") 
     * 
     * @Route("/visiteurs/{id}/edit", name="visiteurs_edit")
     * 
     * @return Response
     */
    public function edit(Visiteur $visiteur, Request $request, ObjectManager $manager){
        
        $form = $this->createForm(VisiteurType::class, $visiteur);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
        
           $manager->persist($visiteur); //elle persiste
           $manager->flush();

           return $this->redirectToRoute('show_id', [
            'id' => $visiteur->getId()]);

            $this->addFlash(
                'success' , "L'annonce <strong>{$visiteur->getNomVis()}</strong> a bien été modifié !");    
        }
        return $this->render('visiteur/new.html.twig', [
            'form'=> $form->createView()
        ]);
    }

     /**
     * Permet d'afficher une seul annonce
     * 
     * @Route("/show/{id}", name="show_id")
     */
        public function show(Visiteur $visiteur)
        {    
            return $this->render('visiteur/show.html.twig', [
                'visiteur' => $visiteur
            ]);
        }
    /**
     * Permet de supprimer une annonce
     * 
     * @Route("/visiteurs/{id}/delete", name="visiteurs_delete")
     * 
     * @param Visiteur $visiteur
     * @param ObjectManager $manager
     * @return Response 
     */
    public function delete(Visiteur $visiteur, ObjectManager $manager ){

        $manager->remove($visiteur);
        $manager->flush();

        return $this->redirectToRoute('visiteurs_index');

        $this->addFlash(
            'danger' , "Le visiteur <strong>{$visiteur->getNomVis()}</strong> a bien été supprimé !"
           );
    }

}
 