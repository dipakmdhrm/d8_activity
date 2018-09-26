<?php
namespace Drupal\d8_routing_demo\Event;

use Symfony\Component\EventDispatcher\Event;
use Drupal\node\NodeInterface;

class CustomEvent extends Event {
  public $node;
  public function __construct(NodeInterface $node) {
    $this->node = $node;
  }
}
