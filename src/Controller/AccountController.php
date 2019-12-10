<?php

namespace App\Controller;

use App\Entity\Visiteur;
use App\Form\AccountType;
use App\Entity\PasswordUpdate;
use App\Form\RegistrationType;
use App\Form\PasswordUpdateType;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AccountController extends AbstractController
{
    /**
     * Permet d'afficher et de gerer le formulaire de connexion
     * 
     * @Route("/login", name="account_login")
     * 
     * @return Response
     */
    public function login(AuthenticationUtils $utils)
    {
        $error = $utils->getLastAuthenticationError();
        $username = $utils->getLastUsername();

        return $this->render('account/login.html.twig', [
            'hasError' => $error !== null,
            'username'=> $username

        ]);
    
    }

    /**
     * Permet de se deconnecter
     *
     * @Route("/logout", name="account_logout")
     * 
     * @return void
     */
    public function logout(){
        //..rien
    }
    /**
     * Permet d'afficher le formulaire d'inscription
     * 
     *  @IsGranted("ROLE_ADMIN")
     *  @Route("/register", name="account_register")
     * 
     * @return Response
     */
    public function register(Request $request, ObjectManager $manager, UserPasswordEncoderInterface $encoder){
       
        $visiteur = new Visiteur();

        $form = $this->createForm(RegistrationType::class, $visiteur);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $hash = $encoder->encodePassword($visiteur, $visiteur->getHash());
            $visiteur->setHash($hash);

            $manager->persist($visiteur);
            $manager->flush();

            $this->addFlash(
                'success',
                "Votre compte a bien crée ! Vous pouvez maintenant vous connecter !"
            );

            return $this->redirectToRoute('account_login');
        }

            return $this->render('account/registration.html.twig', [
                'form' => $form->createView()
            ]);

    }

    /**
     * Permet d'afficher et de traiter le formulaire de modification de profil
     *
     * @Route("/account/profile" ,name="account_profile")
     * 
     * @IsGranted("ROLE_USER")
     * 
     * @return Response
     */
    public function profil( Request $request, ObjectManager $manager){ //importer la fonction request

        //remplissage des champs de la bdd 
        $visiteur = $this->getUser(); 

        $form = $this->createForm(AccountType::class, $visiteur);

        //gere la request et valide le changement
        $form->handleRequest($request);

        //si le form a ete soumis et que le form est valide
        if($form->isSubmitted() && $form->isValid()){
            $manager->persist($visiteur);
            $manager->flush();

            //message flash de prevention
            $this->addFlash(
                'success',
                "Les données du profil ont été enregistrée avec success"
            );
        }

        return $this->render('account/profile.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * Permet de modifier le mot de passe
     * 
     * @Route("/account/password-update", name="account_password")
     *
     * @IsGranted("ROLE_USER")
     * @return Response
     */
    public function updatePassword( Request $request, ObjectManager $manager, UserPasswordEncoderInterface $encoder){
        $passwordUpdate = new PasswordUpdate();
        
        //on a l'utilisateur
        $visiteur = $this->getUser();

        $form = $this->createForm(PasswordUpdateType::class, $passwordUpdate);

        //on gere la reponse 
        $form->handleRequest($request);
       
        if($form->isSubmitted() && $form->isValid()){
            //Verifier que le oldPassword du formulaire soit le meme que le password de l'user
            if(!password_verify($passwordUpdate->getOldPassword(), $visiteur->getHash())){
            //gerer l'erreur
                $form->get('oldPassword')->addError(new FormError("Le mot de passe que vous avez tapé n'est pas votre mot de passe actuel !"));

            }else {
                //on choppe le newPassword
                $newPassword = $passwordUpdate->getNewPassword();
                //encoder le mdp
                $hash = $this->$encoder->encodePassword($visiteur, $newPassword);
                
                //remplace le nouveau mot de passe haché
                $visiteur->setHash($hash);

                $manager->persist($visiteur);
                $manager->flush();

                $this->addFlash(
                    'success',
                    "Votre mot de passe a bien été modifié"
                );

                return $this->redirectToRoute('visiteurs_index');

            }
        }
            
        $form = $this->createForm(PasswordUpdateType::class, $passwordUpdate);
        //retourne un affichage
        return $this->render('account/password.html.twig', [
            'form'=> $form->createView()
        ]);
    }

        /**
        * Permet d'afficher le profil de l'utilisateur connecté
        * 
        *@Route("/account", name="account_index")
        *
        *@IsGranted("ROLE_USER")
        * @return Response
        */

        public function myAccount(){

            dump($this->getUser());
            return $this->render('user/compte.html.twig', [
                'user' => $this->getUser()
            ]);
        }

}
