<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Doctrine\ORM\Tools\Pagination\Paginator;
use AppBundle\Entity\Movie;
use AppBundle\Entity\Rate;
use Doctrine\ORM\Query\ResultSetMapping;

class IndexController extends Controller {

    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request) {



        /* $em = $this->getDoctrine()->getManager();
          $query = $em->createQuery(
         */



        $search = $request->get('search', NULL);
        $order = $request->get('order', 'ASC');
        $sort = $request->get('sort', 'id');
        $page = $request->get('page', 1);
        $countPerPage = 8;
        $offset = 0;

        if ($page > 1) {
            $offset = $countPerPage * ($page - 1);
        }

        $em = $this->getDoctrine()->getManager();
        /*   $rsm = new ResultSetMapping();

          $qb = $em->createQueryBuilder();

          $qb->select('m')
          ->addSelect('AVG(r.rate) AS avg_rate')
          ->from('AppBundle:Movie', 'm')
          ->join('AppBundle:Rate', 'r')
          ->where('m.id = r.movie_id')
          ->orderBy('m.id', 'desc')
          ->groupBy('m.id');
          $query = $qb->getQuery();
         */


        if (empty($search)) {
            $query = $em->createQuery('SELECT m FROM AppBundle:Movie m
          ORDER BY m.' . $sort . ' ' . $order . '');
        } else {
            $parameters = array(
                'searchTitle' => '%' . $search . '%',
                'searchYear' => '%' . $search . '%',
                'searchDir' => '%' . $search . '%'
            );

            $query = $em->createQuery('SELECT m FROM AppBundle:Movie m
          WHERE m.title LIKE :searchTitle OR m.year LIKE :searchYear
          OR m.director LIKE :searchDir ORDER BY m.' . $sort . '   ' . $order . '')
                    ->setParameters($parameters);
        }
        $query = $query->setFirstResult($offset)
                ->setMaxResults($countPerPage);


        $paginator = new Paginator($query, $fetchJoinCollection = true);
        $totalCount = $paginator->count();
        if ($totalCount <= $countPerPage) {
            $page = 1;
        }

        $currentPage = $page;
        $totalPages = ceil($totalCount / $countPerPage);


        return $this->render('index/index.html.twig', array("movies" => $paginator,
                    "totalPages" => $totalPages,
                    "currentPage" => $currentPage,
                    "sort" => $sort,
                    'search' => $search,
                    'order' => $order));
    }

}
