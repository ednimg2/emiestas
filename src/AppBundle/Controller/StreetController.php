<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Street;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

/**
 * Street controller.
 *
 * @Route("street")
 */
class StreetController extends Controller
{
    /**
     * Lists all street entities.
     *
     * @Route("/search", name="street_search")
     * @Method("GET")
     */
    public function searchAction(Request $request)
    {
        $em = $this->getDoctrine()->getRepository(Street::class);

        $streets = [];

        $search_query = $request->query->get('q');
        if(strlen($search_query) >= 3) {
            $streets = $em->findStreetBySearchQuery($search_query);
        }

        $encoders = array(new XmlEncoder(), new JsonEncoder());
        $normalizers = array(new ObjectNormalizer());

        $serializer = new Serializer($normalizers, $encoders);

        $jsonContent = $serializer->serialize($streets, 'json');

        return new Response($jsonContent);
    }

}
