<?php

namespace CombatantsBundle\Controller\Combatants;

use CombatantsBundle\Entity\Combatants\Health;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Health controller.
 *
 * @Route("combatants_health")
 */
class HealthController extends Controller
{
    /**
     * Lists all health entities.
     *
     * @Route("/", name="combatants_health_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $healths = $em->getRepository('CombatantsBundle:Combatants\Health')->findAll();

        return $this->render('combatants/health/index.html.twig', array(
            'healths' => $healths,
        ));
    }

    /**
     * Creates a new health entity.
     *
     * @Route("/new", name="combatants_health_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $health = new Health();
        $form = $this->createForm('CombatantsBundle\Form\Combatants\HealthType', $health);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($health);
            $em->flush();

            return $this->redirectToRoute('combatants_health_show', array('id' => $health->id()));
        }

        return $this->render('combatants/health/new.html.twig', array(
            'health' => $health,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a health entity.
     *
     * @Route("/{id}", name="combatants_health_show")
     * @Method("GET")
     */
    public function showAction(Health $health)
    {
        $deleteForm = $this->createDeleteForm($health);

        return $this->render('combatants/health/show.html.twig', array(
            'health' => $health,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing health entity.
     *
     * @Route("/{id}/edit", name="combatants_health_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Health $health)
    {
        $deleteForm = $this->createDeleteForm($health);
        $editForm = $this->createForm('CombatantsBundle\Form\Combatants\HealthType', $health);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('combatants_health_edit', array('id' => $health->id()));
        }

        return $this->render('combatants/health/edit.html.twig', array(
            'health' => $health,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a health entity.
     *
     * @Route("/{id}", name="combatants_health_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Health $health)
    {
        $form = $this->createDeleteForm($health);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($health);
            $em->flush();
        }

        return $this->redirectToRoute('combatants_health_index');
    }

    /**
     * Creates a form to delete a health entity.
     *
     * @param Health $health The health entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Health $health)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('combatants_health_delete', array('id' => $health->id())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
