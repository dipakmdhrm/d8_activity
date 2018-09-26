<?php

namespace Drupal\d8_routing_demo\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\EventDispatcher\Event;
use Drupal\Core\Path\CurrentPathStack;

/**
 * Class TestSubscriber.
 */
class TestSubscriber implements EventSubscriberInterface {

  /**
   * Drupal\Core\Path\CurrentPathStack definition.
   *
   * @var \Drupal\Core\Path\CurrentPathStack
   */
  protected $pathCurrent;

  /**
   * Constructs a new TestSubscriber object.
   */
  public function __construct(CurrentPathStack $path_current) {
    $this->pathCurrent = $path_current;
  }

  /**
   * {@inheritdoc}
   */
  static function getSubscribedEvents() {
    $events['kernel.response'] = ['kernel_response'];

    return $events;
  }

  /**
   * This method is called whenever the kernel.response event is
   * dispatched.
   *
   * @param GetResponseEvent $event
   */
  public function kernel_response(Event $event) {
    if(substr( $this->pathCurrent->getPath(), 0, 5 ) === "/node") {
      $response = $event->getResponse();
      $response->headers->set('access-control-allow-origin', '*');
    }
  }
}
