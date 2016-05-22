<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use AppBundle\Entity\Annonce;
use AppBundle\Form\AnnonceType;

class AnnonceController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $Annonce = new Annonce();
        $form = $this->get('form.factory')->create(new AnnonceType(), $Annonce);

        if ($this->get('request')->getMethod() == 'POST')
        {
            if ($form->handleRequest($request)->isValid()) {
              $em = $this->getDoctrine()->getManager();
              $em->persist($Annonce);
              $em->flush();
              
              $request->getSession()->getFlashBag()->add('notice', 'Annonce bien enregistrée.');

              //return $this->redirect($this->generateUrl('oc_platform_view', array('id' => $advert->getId())));
            }
        }

        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
            'form' => $form->createView(), 
        ));
    }
}
