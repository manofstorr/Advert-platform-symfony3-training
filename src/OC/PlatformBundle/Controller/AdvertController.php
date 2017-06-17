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
            ->render('OCPlatformBundle:Advert:index.html.twig', array(
                'nom' => 'David',
                'chiffre' => '68',
            ));
        return new Response($content);
    }
}