<?php

namespace CombatantsBundle\Controller\Combatants;

use CombatantsBundle\Entity\Combatants\Luck;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Luck controller.
 *
 * @Route("combatants_luck")
 */
class LuckController extends Controller
{
    /**
     * Lists all luck entities.
     *
     * @Route("/", name="combatants_luck_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $lucks = $em->getRepository('CombatantsBundle:Combatants\Luck')->findAll();

        return $this->render('combatants/luck/index.html.twig', array(
            'lucks' => $lucks,
        ));
    }

    /**
     * Creates a new luck entity.
     *
     * @Route("/new", name="combatants_luck_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $luck = new Luck();
        $form = $this->createForm('CombatantsBundle\Form\Combatants\LuckType', $luck);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($luck);
            $em->flush();

            return $this->redirectToRoute('combatants_luck_show', array('id' => $luck->getId()));
        }

        return $this->render('combatants/luck/new.html.twig', array(
            'luck' => $luck,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a luck entity.
     *
     * @Route("/{id}", name="combatants_luck_show")
     * @Method("GET")
     */
    public function showAction(Luck $luck)
    {
        $deleteForm = $this->createDeleteForm($luck);

        return $this->render('combatants/luck/show.html.twig', array(
            'luck' => $luck,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing luck entity.
     *
     * @Route("/{id}/edit", name="combatants_luck_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Luck $luck)
    {
        $deleteForm = $this->createDeleteForm($luck);
        $editForm = $this->createForm('CombatantsBundle\Form\Combatants\LuckType', $luck);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('combatants_luck_edit', array('id' => $luck->getId()));
        }

        return $this->render('combatants/luck/edit.html.twig', array(
            'luck' => $luck,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a luck entity.
     *
     * @Route("/{id}", name="combatants_luck_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Luck $luck)
    {
        $form = $this->createDeleteForm($luck);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($luck);
            $em->flush();
        }

        return $this->redirectToRoute('combatants_luck_index');
    }

    /**
     * Creates a form to delete a luck entity.
     *
     * @param Luck $luck The luck entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Luck $luck)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('combatants_luck_delete', array('id' => $luck->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
