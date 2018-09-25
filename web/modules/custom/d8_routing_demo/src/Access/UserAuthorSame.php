<?php
namespace Drupal\d8_routing_demo\Access;

use Drupal\Core\Routing\Access\AccessInterface;
use Drupal\node\NodeInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

class UserAuthorSame implements AccessInterface {
  public function access(NodeInterface $node, AccountInterface $account) {
    return AccessResult::allowedIf($node->getOwnerId() === $account->id());
  }
}
