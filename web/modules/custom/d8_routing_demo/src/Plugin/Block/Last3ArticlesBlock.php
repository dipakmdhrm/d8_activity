<?php

namespace Drupal\d8_routing_demo\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Entity\EntityTypeManagerInterface;

/**
 * Provides a 'Last3ArticlesBlock' block.
 *
 * @Block(
 *  id = "last3articles_block",
 *  admin_label = @Translation("Last 3 Articles"),
 * )
 */
class Last3ArticlesBlock extends BlockBase implements ContainerFactoryPluginInterface {

  /**
   * Drupal\Core\Entity\EntityManagerInterface definition.
   *
   * @var \Drupal\Core\Entity\EntityManagerInterface
   */
  protected $entityType_manager;
  /**
   * Constructs a new Last3ArticlesBlock object.
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
    EntityTypeManagerInterface $entityType_manager
  ) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->entityTypeManager = $entityType_manager;
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
    $nids = $query->condition('type', 'article')
      ->condition('status', '1')
      ->range(0, 3)
      ->sort('created' , 'DESC')
      ->execute();
    $nodes = $this->entityTypeManager->getStorage('node')->loadMultiple($nids);

    $build = [];
    $cache_tags = [];
    foreach ($nodes as $node) {
      $build['#markup'] .= $node->getTitle() . ' - ';
      $cache_tags[] = 'node:' . $node->id();
    }

    $build['#cache']['max-age'] = 3600;
    $build['#cache']['tags'] = $cache_tags;

    return $build;
  }

}
