<?php

namespace SvetliDotName\Bundle\PartnerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Oro\Bundle\SecurityBundle\Annotation\Acl;
use Oro\Bundle\SecurityBundle\Annotation\AclAncestor;
use Oro\Bundle\SoapBundle\Entity\Manager\ApiEntityManager;

class PartnerController extends Controller
{
    /**
     * @Route(
     *      "/{_format}",
     *      name="svetlidotname_partner_index",
     *      requirements={
     *          "_format" = "html|json"
     *      },
     *      defaults={
     *          "_format"="html"
     *      }
     * )
     * @AclAncestor("svetlidotname_partner_view")
     * @Template()
     */
    public function indexAction()
    {
        return [];
    }

    /**
     * @Route(
     *      "/view/{id}",
     *      name="svetlidotname_partner_view",
     *      requirements={
     *          "id" = "\d+"
     *      }
     * )
     * @Acl(
     *      id="svetlidotname_partner_view",
     *      type="entity",
     *      permission="VIEW",
     *      class="SvetliDotNamePartnerBundle:Partner"
     * )
     * @Template()
     */
    public function viewAction(Partner $partner)
    {
        return [];
    }

    /**
     * Create partner form
     *
     * @Route(
     *      "/create",
     *      name="svetlidotname_partner_create"
     * )
     * @Acl(
     *      id="svetlidotname_partner_create",
     *      type="entity",
     *      permission="CREATE",
     *      class="SvetliDotNamePartnerBundle:Partner"
     * )
     * @Template("SvetliDotNamePartnerBundle:Partner:update.html.twig")
     */
    public function createAction()
    {
        return $this->update();
    }

    /**
     * Edit partner form
     *
     * @Route(
     *      "/update/{id}",
     *      name="svetlidotname_partner_update",
     *      requirements={
     *          "id" = "\d+"
     *      }
     * )
     * @Acl(
     *      id="svetlidotname_partner_update",
     *      type="entity",
     *      permission="EDIT",
     *      class="SvetliDotNamePartnerBundle:Partner"
     * )
     * @Template()
     */
    public function updateAction(Partner $partner)
    {
        return $this->update($partner);
    }

    /**
     * @param Partner $partner
     * @return array
     */
    protected function update(Partner $partner = null)
    {
        if ($partner) {
            $partner = $this->getManager()->createEntity();
        }

        if ($this->get('svetlidotname_partner.form.handler.partner')->process($partner))
        {
            $this->get('session')->getFlashBag()->add('success', $this->get('translator')->trans('svetlidotname.partner.controller.partner.saved.message'));

            return $this->get('oro_ui.router')->redirectAfterSave(
                ['route' => 'svetlidotname_partner_update', 'parameters' => ['id' => $partner->getId()]],
                ['route' => 'svetlidotname_partner_view', 'parameters' => ['id' => $partner->getId()]],
                $partner);
        }

        return array(
            'entity'    => $partner,
            'form'      => $this->get('svetlidotname_partner.form.partner')->createView());
    }

    /**
     * @return ApiEntityManager
     */
    protected function getManager()
    {
        return $this->get('svetlidotname_partner.partner.manager.api');
    }
}
