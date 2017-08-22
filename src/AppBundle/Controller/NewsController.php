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

class NewsController extends Controller {

    /**
     * @Route("/news/list/{page}", name="news_list")
     */
    public function newsListAction($page = 1) {

        $em = $this->getDoctrine()->getManager();
        $posts = $this->getAllPosts($page); // Returns 5 posts out of 20
        // You can also call the count methods (check PHPDoc for `paginate()`)
        # Total fetched (ie: `5` posts)
        $totalPostsReturned = $posts->getIterator()->count();

        # Count of ALL posts (ie: `20` posts)
        $totalPosts = $posts->count();

        # ArrayIterator
        $iterator = $posts->getIterator();


//        $postData = $em->createQueryBuilder()
//                ->select('p', 'i')
//                ->from('AppBundle:Post', 'p')
//                ->leftJoin('p.images', 'i')
//                ->getQuery()
//                ->getResult();

        $limit = 1;
        $maxPages = ceil($totalPosts / $limit);
        $thisPage = $page;

        return $this->render('pages/news/news_list.html.twig', array(
                    'base_dir' => realpath($this->container->getParameter('kernel.root_dir') . '/..') . DIRECTORY_SEPARATOR,
                    'posts' => $iterator,
                    'maxPages' => $maxPages,
                    'thisPage' => $thisPage
        ));
    }

    /**
     * @Route("/news/show/{id}", name="news_show")
     */
    public function newsShowAction($id) {

        $em = $this->getDoctrine()->getManager();

        $postData = $em->createQueryBuilder()
                ->select('p', 'i')
                ->from('AppBundle:Post', 'p')
                ->leftJoin('p.images', 'i')
                ->where('p.id = :id')
                ->setParameter('id', $id)
                ->getQuery()
                ->getResult();

        return $this->render('pages/news/news_show.html.twig', array(
                    'base_dir' => realpath($this->container->getParameter('kernel.root_dir') . '/..') . DIRECTORY_SEPARATOR,
                    'post' => $postData
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
    public function getAllPosts($currentPage = 1) {
        // Create our query

        $em = $this->getDoctrine()->getManager();

        $query = $em->createQueryBuilder()
                ->select('p')
                ->from('AppBundle:Post', 'p')
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
    public function paginate($dql, $page = 1, $limit = 1) {
        $paginator = new Paginator($dql);

        $paginator->getQuery()
                ->setFirstResult($limit * ($page - 1)) // Offset
                ->setMaxResults($limit); // Limit

        return $paginator;
    }

}
