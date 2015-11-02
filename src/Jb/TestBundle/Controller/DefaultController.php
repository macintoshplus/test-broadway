<?php
/**
 * @author Jean-Baptiste Nahan <jean-baptiste@nahan.fr>
 * @license MIT
 */

namespace Jb\TestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Jb\TestBundle\Domain\Command\Test1Command;
use Jb\TestBundle\Domain\Command\Test2Command;
use Jb\TestBundle\Entity\Message;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class DefaultController extends Controller
{

    /**
     * List
     * @param  string   $name
     * @return Response
     */
    public function indexAction()
    {
        //Générate new id
        $list = $this->getDoctrine()->getManager('readmodel')->getRepository('JbTestBundle:Message')->findAll();

        return $this->render('JbTestBundle:Default:index.html.twig', array('list' => $list));
    }

    /**
     * Make new aggregate and save it
     * @param  string   $name
     * @return Response
     */
    public function makeAction(Request $request)
    {
        $form = $this->createFormBuilder(new Message())
            ->add('texte', 'text', array(
                'required'=>true
            ))
            ->add('save', 'submit')
            ->getForm();

        $form->handleRequest($request);

        if ($form->isValid()) {
            $id = $this->get('broadway.uuid.generator')->generate();
            $data = $form->getData();
            try {
                $this->get('broadway.command_handling.command_bus')->dispatch(new Test1Command($id, $data->getTexte()));

                $this->get('session')->getFlashBag()->add('notice', 'Your message were saved!');

                return $this->redirect($this->generateUrl('jb_test_homepage'));

            } catch (\Exception $e) {
                $this->get('session')->getFlashBag()->add('notice', 'Error : '.$e->getMessage());
            }
        }

        return $this->render('JbTestBundle:Default:new.html.twig', array('form' => $form->createView()));
    }

    /**
     *  Change texte in aggragate ID
     * @param  uuid string $id
     * @param  string      $name
     * @return Response
     */
    public function changeAction(Request $request, $id)
    {

        $obj = $this->getDoctrine()->getManager('readmodel')->getRepository('JbTestBundle:Message')->findOneBy(array('id'=>$id));
        if (!$obj) {
            throw new NotFoundHttpException('No object found for this id : '.$id);
        }
        $form = $this->createFormBuilder($obj)
            ->add('texte', 'text', array(
                'required'=>true
            ))
            ->add('id', 'hidden')
            ->add('version', 'hidden')
            ->add('save', 'submit')
            ->getForm();

        $form->handleRequest($request);

        if ($form->isValid()) {
            try {
                $this->get('broadway.command_handling.command_bus')->dispatch(new Test2Command($id, $obj->getTexte(), $obj->getVersion()));

                $this->get('session')->getFlashBag()->add('notice', 'Your message were saved!');

                return $this->redirect($this->generateUrl('jb_test_homepage'));

            } catch (\Exception $e) {
                $this->get('session')->getFlashBag()->add('notice', 'Error : '.$e->getMessage());
            }
        }

        return $this->render('JbTestBundle:Default:new.html.twig', array('form' => $form->createView()));
    }

    /**
     *  Replay all event
     * @param  uuid string $id
     * @param  string      $name
     * @return Response
     */
    public function replayAction(Request $request, $id)
    {
        //Get view object
        $obj = $this->getDoctrine()->getManager('readmodel')->getRepository('JbTestBundle:Message')->findOneBy(array('id'=>$id));
        if ($obj) {
            // If exists : remove it
            $this->getDoctrine()->getManager('readmodel')->remove($obj);
            $this->getDoctrine()->getManager('readmodel')->flush();
        }
        //Load all event from event store
        try {
            $messages = $this->get('broadway.event_store')->load($id);
            //Send event into replay event bus.
            $this->get('jb_test.event_handling.event_bus')->publish($messages);

            $this->get('session')->getFlashBag()->add('notice', 'All event has been replayed !');

        } catch (\Broadway\EventStore\EventStreamNotFoundException $e) {
            $this->get('session')->getFlashBag()->add('notice', sprintf('Error : This id "%s" is not registred !', $id));
        } catch (\Exception $e) {
            $this->get('session')->getFlashBag()->add('notice', 'Error : '.$e->getMessage());
        }

        return $this->render('JbTestBundle:Default:empty.html.twig', array());
        return $this->redirect($this->generateUrl('jb_test_homepage'));
    }
}
