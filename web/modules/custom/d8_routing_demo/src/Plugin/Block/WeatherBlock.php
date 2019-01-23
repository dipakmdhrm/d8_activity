<?php

namespace Drupal\d8_routing_demo\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\Core\Config\ConfigFactory;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides a 'Weather Information' block.
 *
 * @Block(
 *  id = "weather_info",
 *  admin_label = @Translation("Weather Information"),
 * )
 */
class WeatherBlock extends BlockBase Implements ContainerFactoryPluginInterface {
  protected $weatherConfig;

  public function __construct(array $configuration, $plugin_id, $plugin_definition, ConfigFactory $configFactory) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->weatherConfig = $configFactory->get('d8_routing_demo.weather');
  }
  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('config.factory')
    );
  }
  /**
   * {@inheritdoc}
   */
  public function build() {
    $appId = $this->weatherConfig->get('app_id');
    $build['#markup'] = $appId;
    return $build;
  }

}
