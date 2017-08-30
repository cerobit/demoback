<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Cuenta;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class CuentaController extends Controller
{

    /**
     * @Route("/")
     * @Method("Get")
     */
    public function indexAction( Request $request)
    {
        $response = new Response("<h1>Demo Capacitación !!</h1>", 200 );
        $em = $this->getDoctrine()->getManager();
        $cuentas =  $em->getRepository('AppBundle:Cuenta')->findBy(array(), array('id'=>'desc'));

        return  $this->render("cuenta/list.html.twig", array(
            'cuentas' => $cuentas
        ));
    }
    /**
     * @Route("/cuentas")
     * @Method("Post")
     */
    public function CuentasAction( Request $request)
    {
        $body = $request->getContent();
        $data = json_decode( $body, true);

        $nroCuenta = random_int(1000000, 2000000);
        $em = $this->getDoctrine()->getManager();

        $cuenta = new Cuenta();
        $cuenta->setDocumento( $data["documento"])
            ->setNombre( $data["nombre"])
            ->setNumero($nroCuenta);

        $em->persist( $cuenta );
        $em->flush();

        $response = new JsonResponse();
        $response->setContent( json_encode($cuenta) );

        return $response;
    }

}
