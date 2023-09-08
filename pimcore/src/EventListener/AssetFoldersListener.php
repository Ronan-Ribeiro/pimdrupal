<?php

namespace App\EventListener;

use Pimcore\Bundle\DataHubBundle\Event\GraphQL\Model\QueryTypeEvent;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;


class AssetFoldersListener
{

  public function onPreBuild(QueryTypeEvent $event)
  {
    $config = $event->getConfig();

    $folder = new ObjectType([
      'name' => 'AssetFolders',
      'fields' => [
        'id' => [
          'type' => Type::int(),
          'resolve' => function ($source, $args, $context, ResolveInfo $info) {
            return 'id';
          },
        ],
        'filename' => [
          'type' => Type::string(),
          'resolve' => function ($source, $args, $context, ResolveInfo $info) {
            return 'filename';
          },
        ],
        'fullpath' => [
          'type' => Type::string(),
          'resolve' => function ($source, $args, $context, ResolveInfo $info) {
            return 'fullpath';
          },
        ],
      ],
    ]);

    $outputType = new ObjectType([
      'name' => "asset_folders",
      'fields' => [
        'outputFieldA' => [
          'type' => Type::string(),
          'resolve' => function ($source, $args, $context, ResolveInfo $info) {
            return "A-value for item " . $source['resolvedId'] . " is " . uniqid();
          },
        ],
      ]
    ]);

    $operation = [
      'type' => $outputType,
      'args' => ['itemId' => ['type' => Type::int()]],
      'resolve' => function ($source, $args, $context, ResolveInfo $info) {
        // resolve the item using the input parameters. Result will be passed
        // to the field-level resolvers
        return ['resolvedId' => $args['itemId']];
      }
    ];

    $config['fields']['getAssetFolders'] = $operation;
    $event->setConfig($config);
  }
}
