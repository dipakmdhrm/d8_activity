<?php
/**
 * @file
 * Routing controller for D8 Routing demo module.
 * Contains \Drupal\d8_routing_demo\Controller\RouteController.php
 */

namespace Drupal\d8_routing_demo\Controller;

class RouteController {
  public function hello_world() {
    return [
      '#type' => '#markup',
      '#markup' => 'Hello world!'
    ];
  }
}
