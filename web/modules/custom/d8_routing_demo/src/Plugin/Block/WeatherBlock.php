<?php

namespace Drupal\d8_routing_demo\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'Weather Information' block.
 *
 * @Block(
 *  id = "weather_info",
 *  admin_label = @Translation("Weather Information"),
 * )
 */
class WeatherBlock extends BlockBase {
  /**
   * {@inheritdoc}
   */
  public function build() {
    $build['#markup'] = 'Some text';
    return $build;
  }

}
