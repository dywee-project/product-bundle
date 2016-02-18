<?php

namespace Dywee\ProductBundle\Controller;

use Dywee\ProductBundle\Entity\Brand;
use Dywee\ProductBundle\Entity\Feature;
use Dywee\ProductBundle\Form\FeatureType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class FeatureController extends Controller
{
    public function tableAction($page)
    {
        $em = $this->getDoctrine()->getManager();

        $br = $em->getRepository('DyweeProductBundle:Feature');
        $featureList = $br->findAll();
        return $this->render('DyweeProductBundle:Feature:table.html.twig', array('featureList' => $featureList));
    }

    public function addAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $feature = new Feature();

        $form = $this->get('form.factory')->create(new FeatureType(), $feature);

        if($form->handleRequest($request)->isValid()){

            $em->persist($feature);
            $em->flush();

            $request->getSession()->getFlashBag()->add('success', 'Caractéristique bien ajoutée');
            return $this->redirect($this->generateUrl('dywee_product_feature_table'));
        }
        return $this->render('DyweeProductBundle:Feature:add.html.twig', array('form' => $form->createView()));
    }

    public function updateAction(Feature $feature, Request $request)
    {
        $form = $this->get('form.factory')->create(new FeatureType(), $feature);

        if($form->handleRequest($request)->isValid()){

            $em = $this->getDoctrine()->getManager();
            $em->persist($feature);
            $em->flush();

            $request->getSession()->getFlashBag()->add('success', 'Caractéristique bien modifiée');
            return $this->redirect($this->generateUrl('dywee_product_feature_table'));
        }
        return $this->render('DyweeProductBundle:Feature:edit.html.twig', array('form' => $form->createView()));
    }

    public function deleteAction(Feature $feature)
    {
        $em = $this->getDoctrine()->getManager();

        $em->remove($feature);
        $em->flush();

        $this->get('session')->getFlashBag()->add('success', 'Caractéristique bien supprimée');

        return $this->redirect($this->generateUrl('dywee_product_feature_table'));
    }
}