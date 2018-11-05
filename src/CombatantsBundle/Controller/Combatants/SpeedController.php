<?php

namespace CombatantsBundle\Controller\Combatants;

use CombatantsBundle\Entity\Combatants\Speed;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Speed controller.
 *
 * @Route("combatants_speed")
 */
class SpeedController extends Controller
{
    /**
     * Lists all speed entities.
     *
     * @Route("/", name="combatants_speed_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $speeds = $em->getRepository('CombatantsBundle:Combatants\Speed')->findAll();

        return $this->render('combatants/speed/index.html.twig', array(
            'speeds' => $speeds,
        ));
    }

    /**
     * Creates a new speed entity.
     *
     * @Route("/new", name="combatants_speed_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $speed = new Speed();
        $form = $this->createForm('CombatantsBundle\Form\Combatants\SpeedType', $speed);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($speed);
            $em->flush();

            return $this->redirectToRoute('combatants_speed_show', array('id' => $speed->getId()));
        }

        return $this->render('combatants/speed/new.html.twig', array(
            'speed' => $speed,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a speed entity.
     *
     * @Route("/{id}", name="combatants_speed_show")
     * @Method("GET")
     */
    public function showAction(Speed $speed)
    {
        $deleteForm = $this->createDeleteForm($speed);

        return $this->render('combatants/speed/show.html.twig', array(
            'speed' => $speed,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing speed entity.
     *
     * @Route("/{id}/edit", name="combatants_speed_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Speed $speed)
    {
        $deleteForm = $this->createDeleteForm($speed);
        $editForm = $this->createForm('CombatantsBundle\Form\Combatants\SpeedType', $speed);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('combatants_speed_edit', array('id' => $speed->getId()));
        }

        return $this->render('combatants/speed/edit.html.twig', array(
            'speed' => $speed,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a speed entity.
     *
     * @Route("/{id}", name="combatants_speed_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Speed $speed)
    {
        $form = $this->createDeleteForm($speed);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($speed);
            $em->flush();
        }

        return $this->redirectToRoute('combatants_speed_index');
    }

    /**
     * Creates a form to delete a speed entity.
     *
     * @param Speed $speed The speed entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Speed $speed)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('combatants_speed_delete', array('id' => $speed->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
