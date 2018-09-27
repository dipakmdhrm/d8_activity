<?php

namespace Drupal\d8_routing_demo\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Entity\EntityTypeManagerInterface;

/**
 * Provides a 'Last3NodesBlock' block.
 *
 * @Block(
 *  id = "last_3_nodes_block",
 *  admin_label = @Translation("Last 3 Nodes"),
 * )
 */
class Last3NodesBlock extends BlockBase implements ContainerFactoryPluginInterface {

  /**
   * Drupal\Core\Entity\EntityTypeManagerInterface definition.
   *
   * @var \Drupal\Core\Entity\EntityTypeManagerInterface
   */
  protected $entityTypeManager;
  /**
   * Constructs a new Last3NodesBlock object.
   *
   * @param array $configuration
   *   A configuration array containing information about the plugin instance.
   * @param string $plugin_id
   *   The plugin_id for the plugin instance.
   * @param string $plugin_definition
   *   The plugin implementation definition.
   */
  public function __construct(
    array $configuration,
    $plugin_id,
    $plugin_definition,
    EntityTypeManagerInterface $entity_type_manager
  ) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->entityTypeManager = $entity_type_manager;
  }
  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('entity_type.manager')
    );
  }
  /**
   * {@inheritdoc}
   */
  public function build() {
    $query = $this->entityTypeManager->getStorage('node')->getQuery();
    $nids = $query->condition('type', 'page')
      ->condition('status', '1')
      ->range(0, 3)
      ->sort('created' , 'DESC')
      ->execute();
    $nodes = $this->entityTypeManager->getStorage('node')->loadMultiple($nids);

    $build = [];
    $cache_tags = [];
    foreach ($nodes as $node) {
      $build['last_3_nodes_block']['#markup'] .= $node->getTitle() . '<br>';
      $cache_tags[] = 'node:' . $node->id();
    }

    $build['#cache']['tags'] = $cache_tags;

    return $build;
  }

}
