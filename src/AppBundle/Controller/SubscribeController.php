<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use AppBundle\Entity\User;

class SubscribeController extends Controller {

    public function indexAction(Request $request) {
        $user = new User();

        $form = $this->createFormBuilder($user)
                ->setAction($this->generateUrl('subscribe_index'))
                ->add('name', TextType::class, array('label' => 'Nom : '))
                ->add('lastName', TextType::class, array('label' => 'Prénom : '))
                ->add('email', TextType::class, array('label' => 'Email : '))
                ->add('login', TextType::class, array('label' => "Nom d'utilisateur : "))
                ->add('password', PasswordType::class, array('label' => 'Mot de passe : '))
                ->add('image', FileType::class, array('label' => 'Image : '))
                ->add('movieTypes', ChoiceType::class, array(
                    'label' => 'Vos style de films : ',
                    'multiple' => true,
                    'choices' => array(
                        'action' => "Action",
                        'drama' => "Drama",
                        'aventure' => "Aventure",
                        'sifi' => "Sifi",
                        'musicale' => "Musicale",
                        'historique' => "Historique"
                    ),
                    'choices_as_values' => true,
                ))
                ->add('movieNumber', ChoiceType::class, array(
                    'label' => 'Nombre de films que vous regarder par semaine : ',
                    'choices' => array(
                        'Choisir un nombre' => "",
                        '1' => "1",
                        '2' => "2",
                        '3' => "3",
                        '4' => "4",
                        '5' => "5",
                        '6' => "6",
                        '7' => "7",
                    ),
                    'choices_as_values' => true,
                ))
                ->add('subscribe', SubmitType::class, array('label' => 'Valider', "attr" => array("class" => "btn btn-info pull-right")))
                ->getForm();




        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            if ($form->isValid()) {

                //image upload 
                $image = $user->getImage();
                $imageName = md5(uniqid()) . '.' . $image->guessExtension();
                $avatarDir = $this->container->getParameter('kernel.root_dir') . '/../web/uploads/avatars';
                $image->move($avatarDir, $imageName);
                $user->setImage($imageName);

                //data save 
                $user->setPassword(md5($user->getPassword()));
                $user->setMovieTypes(implode(",", $user->getMovieTypes()));
                $user->setCreatedAt(new \DateTime('now'));
                $user->setEditedAt(new \DateTime('now'));


                // $em = $this->getDoctrine()->getManager();
                //$em->persist($user);
                //$em->flush();
                // return $this->redirect($this->generateUrl('index_index'));
            } else {
                die('Nooo');
            }
        }


        return $this->render('subscribe/index.html.twig', array('form' => $form->createView()));
    }

    public function checkAction(Request $request) {

        $login = $request->request->get('login');
        $user = $this->getDoctrine()
                ->getRepository('AppBundle:User')
                ->findOneBy(array('login' => $login));
        if (empty($user)) {
            $response = new Response(json_encode(array('status' => 200)));
        } else {
            $response = new Response(json_encode(array('status' => 300, "errorMessage" => "Ce nom d'utilisateur existe déja !")));
        }
        return $response;
    }

    public function loginAction(Request $request) {

        $login = $request->request->get('login');
        $password = $request->request->get('password');


        $user = $this->getDoctrine()
                ->getRepository('AppBundle:User')
                ->findOneBy(array('login' => $login, 'password' => md5($password)));

        if (empty($user)) {
            $response = new Response(json_encode(array('status' => 300)));
        } else {
            $session = new Session();
            $session->start();
            $session->set('name', $user->getName());
            $session->set('lastName', $user->getLastName());
            $session->set('image', $user->getImage());
            $session->set('id', $user->getId());

            $response = new Response(json_encode(array('status' => 200)));
        }

        return $response;
    }

}
