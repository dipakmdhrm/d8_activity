<?php
/**
 * @file
 * Routing controller for D8 Routing demo module.
 * Contains \Drupal\d8_routing_demo\Controller\RouteController.php
 */

namespace Drupal\d8_routing_demo\Controller;

use Drupal\user\UserInterface;

class RouteController {
  /**
   * Returns hello world.
   *
   * @return array
   */
  public function helloWorld() {
    return [
      '#type' => '#markup',
      '#markup' => 'Hello world!',
    ];
  }

  /**
   * Returns hello world.
   *
   * @return array
   */
  public function helloDynamic($name) {
    return [
      '#type' => '#markup',
      '#markup' => 'Hello ' . $name . '!',
    ];
  }

  /**
   * Returns hello world.
   *
   * @return array
   */
  public function helloDynamicTitleCallback($name) {
    return 'Hello ' . $name;
  }

  /**
   * Returns hello world.
   *
   * @return array
   */
  public function helloDynamicEntity(UserInterface $user) {
    return [
      '#type' => '#markup',
      '#markup' => 'Hello ' . $user->getUsername() . '!',
    ];
  }

  /**
   * Returns hello world.
   *
   * @return array
   */
  public function helloDynamicEntityTitleCallback(UserInterface $user) {
    return 'Hello ' . $user->getUsername();
  }
}
