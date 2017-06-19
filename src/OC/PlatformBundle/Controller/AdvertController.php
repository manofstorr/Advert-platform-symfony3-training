<?php
/**
 * Created by PhpStorm.
 * User: David
 * Date: 17/06/2017
 * Time: 16:52
 */


// src/OC/PlatformBundle/Controller/AdvertController.php

namespace OC\PlatformBundle\Controller;

// basics
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
// more for samples
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class AdvertController extends Controller
{

    public function menuAction()
    {
        // sample data
        $listAdverts = array(
            array('id' => 2, 'title' => 'Recherche développeur Symfony'),
            array('id' => 5, 'title' => 'Mission de webmaster'),
            array('id' => 9, 'title' => 'Offre de stage webdesigner')
        );
        
        return $this->render('OCPlatformBundle:Advert:menu.html.twig', array(
            'listAdverts' => $listAdverts
        ));

    }

    public function indexAction($page)
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
         * $content = $this->get('templating')
            ->render('OCPlatformBundle:Advert:index.html.twig');
            return new Response($content);
         */

        if ($page < 1) {
            // exception NotFoundHttpException, because page must be
            throw new NotFoundHttpException('Page "' . $page . '" inexistante.');
        }

        return $this->render('OCPlatformBundle:Advert:index.html.twig');

    }

    public function viewAction($id)
    {

        return $this->render(
            'OCPlatformBundle:Advert:viewAdvert.html.twig', array(
                'id' => $id,
            )
        );

    }


    /* CRUD */
    public function addAction(Request $request)
    {

        // Sample text todo : get out !
        $text = '...';
        $text = 'Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l\'imprimerie depuis les années 1500, quand un peintre anonyme assembla ensemble des morceaux de texte pour réaliser un livre spécimen de polices de texte. Il n\'a pas fait que survivre cinq siècles, mais s\'est aussi adapté à la bureautique informatique, sans que son contenu n\'en soit modifié. Il a été popularisé dans les années 1960 grâce à la vente de feuilles Letraset contenant des passages du Lorem Ipsum, et, plus récemment, par son inclusion dans des applications de mise en page de texte, comme Aldus PageMaker.';
        $antispam = $this->get('oc_platform.antispam');

        if ($antispam->isSpam($text)) {
            throw new \Exception('Votre message a été détecté comme spam !');
        }
        // Test form submit
        if ($request->isMethod('POST')) {
            // use of flash
            $session = $request->getSession();
            $session->getFlashBag()->add('info', 'Annonce bien enregistrée');
            $session->getFlashBag()->add('info', 'Well done !');
            return $this->redirectToRoute('oc_platform_view', array('id' => 5));
        }

        // show form
        return $this->render('OCPlatformBundle:Advert:add.html.twig');

    }

    public function editAction($id, Request $request)
    {
        // Test form submit
        if ($request->isMethod('POST')) {
            // use of flash
            $session = $request->getSession();
            $session->getFlashBag()->add('info', 'Annonce mise à jour');
            $session->getFlashBag()->add('info', 'Well done !');
            return $this->redirectToRoute('oc_platform_view', array('id' => 5));
        }

        // show form
        return $this->render('OCPlatform:Advert:edit.html.twig');
    }

    public function deleteAction($id)
    {
        return $this->render('OCPlatformBundle:Advert:delete.html.twig');
    }


    /* SAMPLES BELOW ******************************************** */

    /*
     * A sample to use git, eat after reading
     * Sample : Using extra-route parameters with typehint Request
     */
    public function goodbyeAction(Request $request)
    {
        $advert_id = 5;

        //extra route parameters
        $tag = $request->query->get('tag');


        // url generators
        //short and long method
        $url = $this->get('router')->generate('oc_platform_home');
        $url = $this->generateUrl('oc_platform_home');
        // sample use of generating absolute interface
        $url = $this->get('router')->generate('oc_platform_home', array(),
            UrlGeneratorInterface::ABSOLUTE_URL);

        // sample use of generating url from router
        $url = $this->get('router')->generate(
            'oc_platform_view', // 1er argument : le nom de la route
            array('id' => $advert_id)    // 2e argument : les valeurs des paramètres
        );

        /* redirection with use Symfony\Component\HttpFoundation\RedirectResponse;
        $url = $this->get('router')->generate('oc_platform_home');
        return new RedirectResponse($url);
        // or
        return $this->redirectToRoute('oc_platform_home');
        */

        // $url vaut « /platform/advert/5 »
        /*
        $content = $this->get('templating')
            ->render('OCPlatformBundle:Advert:goodbye.html.twig', array(
                'nom' => 'David',
                'heure' => date('H:i'),
                'url' => $url,
                'tag' => $tag,
                'advert_id' => $advert_id,
            ));
        return new Response($content);
        */

        // Récupération de la session
        $session = $request->getSession();
        // On récupère le contenu de la variable user_id
        $userId = $session->get('user_id');
        // On définit une nouvelle valeur pour cette variable user_id
        $session->set('user_id', 91);

        // simpliest way equals what's above :
        return $this->render(
            'OCPlatformBundle:Advert:goodbye.html.twig', array(
                'nom' => 'Juni',
                'heure' => date('H:i'),
                'url' => $url,
                'tag' => $tag,
                'advert_id' => $advert_id,
            )
        );
    }

    // On récupère tous les paramètres en arguments de la méthode
    public function viewSlugAction($slug, $year, $_format)
    {
        return new Response(
            "On pourrait afficher l'annonce correspondant au
            slug '" . $slug . "', créée en " . $year . " et au format " . $_format . "."
        );
    }
}