<?php
/**
 * @file
 * Routing controller for D8 Routing demo module.
 * Contains \Drupal\d8_routing_demo\Controller\RouteController.php
 */

namespace Drupal\d8_routing_demo\Controller;

use Drupal\user\UserInterface;
use Drupal\node\NodeInterface;
use Drupal\Core\Access\AccessResult;
use Drupal\Core\Session\AccountInterface;

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

  /**
   *
   */
  public function listNode(NodeInterface $node) {
    $owner = $node->getOwner()->getAccountName();
    return [
      '#type' => '#markup',
      '#markup' => $node->getTitle() . '|' . $owner,
    ];
  }

  /**
   *
   */
  public function listNodeTitleCallback(NodeInterface $node) {
    return $node->getTitle();
  }

  /**
   *
   */
  public function listNodeAccess(NodeInterface $node, AccountInterface $account) {
    return AccessResult::allowedIf($node->getOwnerId() === $account->id());
  }
}
