<?php

namespace CombatantsBundle\Controller\Combatants;

use CombatantsBundle\Entity\Combatants\Defense;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Defense controller.
 *
 * @Route("combatants_defense")
 */
class DefenseController extends Controller
{
    /**
     * Lists all defense entities.
     *
     * @Route("/", name="combatants_defense_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $defenses = $em->getRepository('CombatantsBundle:Combatants\Defense')->findAll();

        return $this->render('combatants/defense/index.html.twig', array(
            'defenses' => $defenses,
        ));
    }

    /**
     * Creates a new defense entity.
     *
     * @Route("/new", name="combatants_defense_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $defense = new Defense();
        $form = $this->createForm('CombatantsBundle\Form\Combatants\DefenseType', $defense);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($defense);
            $em->flush();

            return $this->redirectToRoute('combatants_defense_show', array('id' => $defense->id()));
        }

        return $this->render('combatants/defense/new.html.twig', array(
            'defense' => $defense,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a defense entity.
     *
     * @Route("/{id}", name="combatants_defense_show")
     * @Method("GET")
     */
    public function showAction(Defense $defense)
    {
        $deleteForm = $this->createDeleteForm($defense);

        return $this->render('combatants/defense/show.html.twig', array(
            'defense' => $defense,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing defense entity.
     *
     * @Route("/{id}/edit", name="combatants_defense_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Defense $defense)
    {
        $deleteForm = $this->createDeleteForm($defense);
        $editForm = $this->createForm('CombatantsBundle\Form\Combatants\DefenseType', $defense);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('combatants_defense_edit', array('id' => $defense->id()));
        }

        return $this->render('combatants/defense/edit.html.twig', array(
            'defense' => $defense,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a defense entity.
     *
     * @Route("/{id}", name="combatants_defense_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Defense $defense)
    {
        $form = $this->createDeleteForm($defense);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($defense);
            $em->flush();
        }

        return $this->redirectToRoute('combatants_defense_index');
    }

    /**
     * Creates a form to delete a defense entity.
     *
     * @param Defense $defense The defense entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Defense $defense)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('combatants_defense_delete', array('id' => $defense->id())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
