<?php

namespace CombatantsBundle\Controller\Combatants;

use CombatantsBundle\Entity\Combatants\Strength;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Strength controller.
 *
 * @Route("combatants_strength")
 */
class StrengthController extends Controller
{
    /**
     * Lists all strength entities.
     *
     * @Route("/", name="combatants_strength_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $strengths = $em->getRepository('CombatantsBundle:Combatants\Strength')->findAll();

        return $this->render('combatants/strength/index.html.twig', array(
            'strengths' => $strengths,
        ));
    }

    /**
     * Creates a new strength entity.
     *
     * @Route("/new", name="combatants_strength_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $strength = new Strength();
        $form = $this->createForm('CombatantsBundle\Form\Combatants\StrengthType', $strength);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($strength);
            $em->flush();

            return $this->redirectToRoute('combatants_strength_show', array('id' => $strength->id()));
        }

        return $this->render('combatants/strength/new.html.twig', array(
            'strength' => $strength,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a strength entity.
     *
     * @Route("/{id}", name="combatants_strength_show")
     * @Method("GET")
     */
    public function showAction(Strength $strength)
    {
        $deleteForm = $this->createDeleteForm($strength);

        return $this->render('combatants/strength/show.html.twig', array(
            'strength' => $strength,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing strength entity.
     *
     * @Route("/{id}/edit", name="combatants_strength_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Strength $strength)
    {
        $deleteForm = $this->createDeleteForm($strength);
        $editForm = $this->createForm('CombatantsBundle\Form\Combatants\StrengthType', $strength);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('combatants_strength_edit', array('id' => $strength->getId()));
        }

        return $this->render('combatants/strength/edit.html.twig', array(
            'strength' => $strength,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a strength entity.
     *
     * @Route("/{id}", name="combatants_strength_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Strength $strength)
    {
        $form = $this->createDeleteForm($strength);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($strength);
            $em->flush();
        }

        return $this->redirectToRoute('combatants_strength_index');
    }

    /**
     * Creates a form to delete a strength entity.
     *
     * @param Strength $strength The strength entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Strength $strength)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('combatants_strength_delete', array('id' => $strength->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
