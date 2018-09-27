<?php

namespace Drupal\d8_routing_demo\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\EventDispatcher\Event;
use Drupal\Core\Logger\LoggerChannelFactory;

/**
 * Class DataEntryEventSubscriber.
 */
class DataEntryEventSubscriber implements EventSubscriberInterface {

  protected $logFactory;
  /**
   * Constructs a new DataEntryEventSubscriber object.
   */
  public function __construct(LoggerChannelFactory $logFactory) {
    $this->logFactory = $logFactory;
  }

  /**
   * {@inheritdoc}
   */
  static function getSubscribedEvents() {
    $events['d8_routing_demo.data.insert'] = ['logFirstLastName'];

    return $events;
  }

  /**
   * This method is called whenever the d8_routing_demo.data.insert event is
   * dispatched.
   *
   * @param GetResponseEvent $event
   */
  public function logFirstLastName(Event $event) {
    $this->logFactory->get('system')->info($event->firstName . ' ' . $event->lastName);
  }

}
