<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Contact;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
//use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
//use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Doctrine\ORM\Tools\Pagination\Paginator;

class ConferenceController extends Controller {

    /**
     * @Route("/conference/list/{page}", name="conference_list")
     */
    public function conferenceListAction($page = 1) {

        $em = $this->getDoctrine()->getManager();
        $conferences = $this->getAllConferences($page);
        $totalConferencesReturned = $conferences->getIterator()->count();

        $totalConferences = $conferences->count();

        $iterator = $conferences->getIterator();

        $limit = 2;
        $maxPages = ceil($totalConferences / $limit);
        $thisPage = $page;

        return $this->render('pages/conference/conference_list.html.twig', array(
                    'base_dir' => realpath($this->container->getParameter('kernel.root_dir') . '/..') . DIRECTORY_SEPARATOR,
                    'conferences' => $iterator,
                    'maxPages' => $maxPages,
                    'thisPage' => $thisPage
        ));
    }

    /**
     * @Route("/conference/show/{id}", name="conference_show")
     */
    public function conferenceShowAction($id) {

        $em = $this->getDoctrine()->getManager();

        $conferenceData = $em->createQueryBuilder()
                ->select('c')
                ->from('AppBundle:Conference', 'c')
                ->where('c.id = :id')
                ->setParameter('id', $id)
                ->getQuery()
                ->getResult();

        return $this->render('pages/conference/conference_show.html.twig', array(
                    'base_dir' => realpath($this->container->getParameter('kernel.root_dir') . '/..') . DIRECTORY_SEPARATOR,
                    'conference' => $conferenceData
        ));
    }

    /**
     * Our new getAllPosts() method
     *
     * 1. Create & pass query to paginate method
     * 2. Paginate will return a `\Doctrine\ORM\Tools\Pagination\Paginator` object
     * 3. Return that object to the controller
     *
     * @param integer $currentPage The current page (passed from controller)
     *
     * @return \Doctrine\ORM\Tools\Pagination\Paginator
     */
    public function getAllConferences($currentPage = 1) {
        // Create our query

        $em = $this->getDoctrine()->getManager();

        $query = $em->createQueryBuilder()
                ->select('c')
                ->from('AppBundle:Conference', 'c')
                ->getQuery();

        // No need to manually get get the result ($query->getResult())

        $paginator = $this->paginate($query, $currentPage);

        return $paginator;
    }

    /**
     * Paginator Helper
     *
     * Pass through a query object, current page & limit
     * the offset is calculated from the page and limit
     * returns an `Paginator` instance, which you can call the following on:
     *
     *     $paginator->getIterator()->count() # Total fetched (ie: `5` posts)
     *     $paginator->count() # Count of ALL posts (ie: `20` posts)
     *     $paginator->getIterator() # ArrayIterator
     *
     * @param Doctrine\ORM\Query $dql   DQL Query Object
     * @param integer            $page  Current page (defaults to 1)
     * @param integer            $limit The total number per page (defaults to 5)
     *
     * @return \Doctrine\ORM\Tools\Pagination\Paginator
     */
    public function paginate($dql, $page = 1, $limit = 2) {
        $paginator = new Paginator($dql);

        $paginator->getQuery()
                ->setFirstResult($limit * ($page - 1)) // Offset
                ->setMaxResults($limit); // Limit

        return $paginator;
    }

}
