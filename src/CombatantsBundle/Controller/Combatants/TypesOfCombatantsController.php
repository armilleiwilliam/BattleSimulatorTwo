<?php

namespace CombatantsBundle\Controller\Combatants;

use CombatantsBundle\Entity\Combatants\TypesOfCombatants;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Typesofcombatant controller.
 *
 * @Route("combatants_typesofcombatants")
 */
class TypesOfCombatantsController extends Controller
{
    /**
     * Lists all typesOfCombatant entities.
     *
     * @Route("/", name="combatants_typesofcombatants_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $typesOfCombatants = $em->getRepository('CombatantsBundle:Combatants\TypesOfCombatants')->findAll();

        return $this->render('combatants/typesofcombatants/index.html.twig', array(
            'typesOfCombatants' => $typesOfCombatants,
        ));
    }

    /**
     * Creates a new typesOfCombatant entity.
     *
     * @Route("/new", name="combatants_typesofcombatants_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $typesOfCombatant = new Typesofcombatants();
        $form = $this->createForm('CombatantsBundle\Form\Combatants\TypesOfCombatantsType', $typesOfCombatant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($typesOfCombatant);
            $em->flush();

            return $this->redirectToRoute('combatants_typesofcombatants_show', array('id' => $typesOfCombatant->getId()));
        }

        return $this->render('combatants/typesofcombatants/new.html.twig', array(
            'typesOfCombatant' => $typesOfCombatant,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a typesOfCombatant entity.
     *
     * @Route("/{id}", name="combatants_typesofcombatants_show")
     * @Method("GET")
     */
    public function showAction(TypesOfCombatants $typesOfCombatant)
    {
        $deleteForm = $this->createDeleteForm($typesOfCombatant);

        return $this->render('combatants/typesofcombatants/show.html.twig', array(
            'typesOfCombatant' => $typesOfCombatant,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing typesOfCombatant entity.
     *
     * @Route("/{id}/edit", name="combatants_typesofcombatants_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, TypesOfCombatants $typesOfCombatant)
    {
        $deleteForm = $this->createDeleteForm($typesOfCombatant);
        $editForm = $this->createForm('CombatantsBundle\Form\Combatants\TypesOfCombatantsType', $typesOfCombatant);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('combatants_typesofcombatants_edit', array('id' => $typesOfCombatant->getId()));
        }

        return $this->render('combatants/typesofcombatants/edit.html.twig', array(
            'typesOfCombatant' => $typesOfCombatant,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a typesOfCombatant entity.
     *
     * @Route("/{id}", name="combatants_typesofcombatants_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, TypesOfCombatants $typesOfCombatant)
    {
        $form = $this->createDeleteForm($typesOfCombatant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($typesOfCombatant);
            $em->flush();
        }

        return $this->redirectToRoute('combatants_typesofcombatants_index');
    }

    /**
     * Creates a form to delete a typesOfCombatant entity.
     *
     * @param TypesOfCombatants $typesOfCombatant The typesOfCombatant entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(TypesOfCombatants $typesOfCombatant)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('combatants_typesofcombatants_delete', array('id' => $typesOfCombatant->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
