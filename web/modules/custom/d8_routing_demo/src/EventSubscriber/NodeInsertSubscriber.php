<?php

namespace Drupal\d8_routing_demo\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Drupal\d8_routing_demo\Event\CustomEvent;
use Psr\Log\LoggerInterface;

/**
 * Class NodeInsertSubscriber.
 */
class NodeInsertSubscriber implements EventSubscriberInterface {

  /**
   * {@inheritdoc}
   */
  static function getSubscribedEvents() {
    $events['d8_routing_demo.node.insert'] = ['d8_routing_demo_node_insert'];

    return $events;
  }

  /**
   * This method is called whenever the d8_routing_demo.node.insert event is
   * dispatched.
   *
   * @param GetResponseEvent $event
   */
  public function d8_routing_demo_node_insert(CustomEvent $event) {
    \Drupal::logger('system')->info($event->node->getTitle());
  }

}
