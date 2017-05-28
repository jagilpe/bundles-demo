<?php

namespace AppBundle\Controller;

use AppBundle\Entity\TestEntity;
use AppBundle\Form\Type\TestEntityType;
use Jagilpe\AjaxModalsBundle\Controller\AjaxViewControllerTrait;
use Jagilpe\AjaxModalsBundle\View\EndAjaxView;
use Jagilpe\AjaxModalsBundle\View\ErrorAjaxView;
use Jagilpe\AjaxModalsBundle\View\FormAjaxView;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

/**
 * @author Javier Gil Pereda <javier@gilpereda.com>
 */
class AjaxModalsController extends Controller
{
    use AjaxViewControllerTrait;

    /**
     * Home page for the ajax modals demo
     *
     * @return Response
     */
    public function ajaxDemoHomeAction()
    {
        return $this->render(':ajax_modals_demo:ajax-modals-index.html.twig');
    }

    /**
     * Controller that return the content for an ajax modal dialog
     *
     * @Route("/ajax/ajax-modal-dialog", name="ajax_modal_dialog")
     */
    public function ajaxDialogAction(Request $request)
    {
        $testEntity = new TestEntity();
        $form = $this->createForm(TestEntityType::class, $testEntity);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $firstName = $testEntity->getFirstName();
                $lastName = $testEntity->getLastName();

                $message = "The form was submitted with first name=$firstName and last name=$lastName";
                $this->addFlash('info', $message);

                // This view will close the ajax dialog
                $view = $this->createAjaxView(EndAjaxView::class);

            } catch(\Exception $exception) {
                // We have to inform the dialog that there was an error
                $view = $this->createAjaxView(ErrorAjaxView::class);
                $view->setErrorFromException($exception);
            }

        } else {
            // Create the form ajax view
            $view = $this->createAjaxView(FormAjaxView::class);
            $view->setTitle("Title of the dialog");
            $view->setContent(
                $this->renderView(':ajax_modals_demo:ajax-modal-dialog.html.twig', array('form' => $form->createView(),))
            );
            // Configure the save button
            $view->getButton(FormAjaxView::BUTTON_SAVE)
                ->showButton()
                ->setUrl($this->get('router')->generate('ajax_modal_dialog'));
        }

        // Return the view
        return $view;
    }
}