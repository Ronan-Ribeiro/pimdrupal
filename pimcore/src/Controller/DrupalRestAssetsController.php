<?php

namespace App\Controller;

use Pimcore\Model\DataObject;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use \Pimcore\Controller\FrontendController;

class DrupalRestAssetsController extends FrontendController {
    /**
     * @Route("/api/drupal/assests/list")
     */
    public function defaultAction(Request $request): JsonResponse {
        // @todo access validation

        $list = new \Pimcore\Model\Asset\Listing();
        $list->setCondition(`type` != 'image');
        $list->load();
        $list->getData();

        $assets = $list->getAssets();


        $data[] = [
          'getTotalCount' => $list->getTotalCount(),
          'getCount' => $list->getCount(),
          '$list->getData()' => $list->getData(),
          '$assets' => $assets,
        ];

        $out = print_r($data, TRUE);
        print "<pre>$out</pre>";

        return $this->json(["success" => true, "data" => $data]);
    }
}
