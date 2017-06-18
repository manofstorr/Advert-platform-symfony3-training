<?php
/**
 * Created by PhpStorm.
 * User: David
 * Date: 17/06/2017
 * Time: 16:52
 */


// src/OC/PlatformBundle/Controller/AdvertController.php

namespace OC\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class AdvertController extends Controller
{
    public function indexAction()
    {
        /*
         * $this->get('templating')  ? Qu'est-ce que c'est exactement ?
         * Bonne question ! Cette syntaxe $this->get('mon_service') depuis
         * les contrôleurs retourne un objet dont le nom est "mon_service",
         * cet objet permet ensuite d'effectuer quelques actions.
         * Par exemple ici l'objet "templating" permet de récupérer
         * le contenu d'un template grâce à sa méthode render .
         * Ces objets, appelés services, sont une fonctionnalité phare
         * de Symfony.
         */
        $content = $this->get('templating')
            ->render('OCPlatformBundle:Advert:index.html.twig');
        return new Response($content);
    }

    public function viewAction($id)
    {
        // todo : code
        return new Response('coucou ' . $id);
    }

    // On récupère tous les paramètres en arguments de la méthode
    public function viewSlugAction($slug, $year, $_format)
    {
        return new Response(
            "On pourrait afficher l'annonce correspondant au
            slug '" . $slug . "', créée en " . $year . " et au format " . $_format . "."
        );
    }


    /* CRUD */

    public function addAction()
    {
        // todo : code
    }

    
    /* SAMPLES BELOW */

    /*
     * A sample to use git, eat after reading
     */
    public function goodbyeAction()
    {


        //short and long method
        $url = $this->get('router')->generate('oc_platform_home');
        $url = $this->generateUrl('oc_platform_home');

        // sample use of generating absolute interface
        $url = $this->get('router')->generate('oc_platform_home', array(),
            UrlGeneratorInterface::ABSOLUTE_URL);


        $advert_id = 5;

        // sample use of generating url from router
        $url = $this->get('router')->generate(
            'oc_platform_view', // 1er argument : le nom de la route
            array('id' => $advert_id)    // 2e argument : les valeurs des paramètres
        );


        // $url vaut « /platform/advert/5 »
        $content = $this->get('templating')
            ->render('OCPlatformBundle:Advert:goodbye.html.twig', array(
                'nom' => 'David',
                'heure' => date('H:i'),
                'url' => $url,
                'advert_id' => $advert_id,
            ));




        return new Response($content);
    }
}