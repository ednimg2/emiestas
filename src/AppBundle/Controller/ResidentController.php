<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Resident;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

/**
 * Resident controller.
 *
 * @Route("resident")
 */
class ResidentController extends Controller
{
    public function __construct()
    {
        $this->session = new Session();
    }

    /**
     * Lists all resident entities.
     *
     * @Route("/", name="resident_index")
     * @Method("GET")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getRepository(Resident::class);

        $filters = $this->getFilters('resident');

        $query = $em->createQueryBuilder('r');

        if(isset($filters['street_id']) && $filters['street_id'] > 0){
            $query->leftJoin('r.street', 's');
            $query->where('s.id = :streetId')
                ->setParameter('streetId', $filters['street_id']);
        }

        if(isset($filters['birthday']) && $filters['birthday'] > 0){
            $query->andWhere('r.birthday = :enterBirthday')
                ->setParameter('enterBirthday', $filters['birthday']);
        }

        $query->orderBy('r.id', 'ASC');

        $paginator = $this->get('knp_paginator');
        $result = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            $request->query->getInt('limit', 10)
        );

        return $this->render('resident/index.html.twig', array(
            'residents' => $result,
            'filters' => $filters,
            'filter_apply' => 'resident_filters',
            'filter_clear' => 'resident_filters_clear',
            'filter_id' => 'resident'
        ));
    }

    /**
     * @Route("/filters",name="resident_filters")
     */
    public function filtersApplyAction(Request $request)
    {
        $this->updateFilters($request, 'resident');
        return $this->redirect($request->headers->get('Referer'));
    }
    /**
     * @Route("/filters_clear",name="resident_filters_clear")
     */
    public function filtersClearAction(Request $request)
    {
        $this->session->clear();
        return $this->redirect($request->headers->get('Referer'));
    }

    public function getFilters($id)
    {
        return $this->session->get($id);
    }

    public function updateFilters($request, $id)
    {
        foreach($request->query as $key => $value) {
            if($key != 'filter_id') $arr[$key] = $value;
        }
        $this->session->set($id, $arr);
    }

    /**
     * Creates a new resident entity.
     *
     * @Route("/new", name="resident_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $resident = new Resident();
        $form = $this->createForm('AppBundle\Form\ResidentType', $resident);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($resident);
            $em->flush();

            $request->getSession()
                ->getFlashBag()
                ->add('success', 'Naujo gyventojo duomenys išsaugoti!');

            return $this->redirectToRoute('resident_show', array('id' => $resident->getId()));
        }

        return $this->render('resident/new.html.twig', array(
            'resident' => $resident,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a resident entity.
     *
     * @Route("/{id}", name="resident_show")
     * @Method("GET")
     */
    public function showAction(Resident $resident)
    {
        $deleteForm = $this->createDeleteForm($resident);

        return $this->render('resident/show.html.twig', array(
            'resident' => $resident,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing resident entity.
     *
     * @Route("/{id}/edit", name="resident_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Resident $resident)
    {
        $deleteForm = $this->createDeleteForm($resident);
        $editForm = $this->createForm('AppBundle\Form\ResidentType', $resident);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $request->getSession()
                ->getFlashBag()
                ->add('success', 'Gyventojo duomenys išsaugoti!');

            return $this->redirectToRoute('resident_edit', array('id' => $resident->getId()));
        }

        return $this->render('resident/edit.html.twig', array(
            'resident' => $resident,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a resident entity.
     *
     * @Route("/{id}", name="resident_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Resident $resident)
    {
        $form = $this->createDeleteForm($resident);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($resident);
            $em->flush();

            $request->getSession()
                ->getFlashBag()
                ->add('success', 'Gyventojo duomenys ištrinti!');
        }

        return $this->redirectToRoute('resident_index');
    }

    /**
     * Creates a form to delete a resident entity.
     *
     * @param Resident $resident The resident entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Resident $resident)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('resident_delete', array('id' => $resident->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
