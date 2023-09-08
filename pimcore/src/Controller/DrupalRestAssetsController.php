<?php

namespace App\Controller;

use Pimcore\Model\DataObject;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use \Pimcore\Controller\FrontendController;

class DrupalRestAssetsController extends FrontendController {
    /**
     * @Route("/api/drupal/assets/list")
     */
    public function defaultAction(Request $request): JsonResponse {
        // @todo access validation

        $list = new \Pimcore\Model\Asset\Listing();
        $list->setCondition("`type` = 'folder'");
        $list->load();
        $assets = $list->getAssets();


        $data[] = [
          'getTotalCount' => $list->getTotalCount(),
          'getCount' => $list->getCount(),
          '$assets' => $assets,
          '$list' => $list,
        ];

        $out = print_r($data, TRUE);
        print "<pre>$out</pre>";

        return $this->json(["success" => true, "data" => '$data']);
    }
}
