<?php

namespace Drupal\d8_routing_demo\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\Core\Config\ConfigFactory;
use Symfony\Component\DependencyInjection\ContainerInterface;
use GuzzleHttp\Client;

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
  protected $httpClient;

  public function __construct(array $configuration, $plugin_id, $plugin_definition, ConfigFactory $configFactory, Client $client) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->weatherConfig = $configFactory->get('d8_routing_demo.weather');
    $this->httpClient = $client;
  }
  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('config.factory'),
      $container->get('http_client')
    );
  }
  /**
   * {@inheritdoc}
   */
  public function build() {
    $client = new \GuzzleHttp\Client();
    $request = $client->request('GET', 'https://samples.openweathermap.org/data/2.5/weather?q=London,uk&appid=b6907d289e10d714a6e88b30761fae22');
    $response = json_decode($request->getBody());
    $city = $response->name;
    $temp = $response->main->temp - 270.15;
    $build['#markup'] = "City: $city, Temperature: $temp C";
    return $build;
  }

}
