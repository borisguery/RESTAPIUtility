<?php


namespace Bgy\Annotation;


use Doctrine\Common\Annotations\Annotation;

class AnnotationDriver
{
    private $reader;

    public function __construct(Annotation $reader)
    {
        $this->reader = $reader;
    }
    /**
     * This event will fire during any controller call
     */
    public function onKernelController(FilterControllerEvent $event)
    {

        if (!is_array($controller = $event->getController())) { //return if no controller

            return;
        }

        $event->

        $object = new \ReflectionObject($controller[0]);// get controller
        $method = $object->getMethod($controller[1]);// get method

        foreach ($this->reader->getMethodAnnotations($method) as $configuration) { //Start of annotations reading
            if(isset($configuration->perm)){//Found our annotation
                $perm = new Permission($controller[0]->get('doctrine.odm.mongodb.document_manager'));
                $userName = $controller[0]->get('security.context')->getToken()->getUser()->getUserName();
                if(!$perm->isAccess($userName,$configuration->perm)){
                    //if any throw 403
                    throw new AccessDeniedHttpException();

                }

            }
        }
    }
}
