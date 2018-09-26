<?php

namespace Drupal\d8_routing_demo\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\DependencyInjection\ContainerInjectionInterface;

/**
 * Provides a 'TestBlock' block.
 *
 * @Block(
 *  id = "test_block",
 *  admin_label = @Translation("Test block"),
 * )
 */
class TestBlock extends BlockBase implements ContainerFactoryPluginInterface {

  /**
   * Drupal\Core\DependencyInjection\ContainerInjectionInterface definition.
   *
   * @var \Drupal\Core\DependencyInjection\ContainerInjectionInterface
   */
  protected $d8RoutingDemoDataFetcherWriter;
  /**
   * Constructs a new TestBlock object.
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
    ContainerInjectionInterface $d8_routing_demo_data_fetcher_writer
  ) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->d8RoutingDemoDataFetcherWriter = $d8_routing_demo_data_fetcher_writer;
  }
  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('d8_routing_demo.data_fetcher_writer')
    );
  }
  /**
   * {@inheritdoc}
   */
  public function build() {
    $lastEntry = $this->d8RoutingDemoDataFetcherWriter->getLastEntry();
    $userName = $lastEntry->first_name . ' ' . $lastEntry->last_name;
    $build = [];
    $build['test_block']['#markup'] = $userName;

    return $build;
  }

}
