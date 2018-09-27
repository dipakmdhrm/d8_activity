<?php
namespace Drupal\d8_routing_demo\Event;

use Symfony\Component\EventDispatcher\Event;

class DataEntryEvent extends Event {

  const DATA_INSERT = 'd8_routing_demo.data.insert';

  public $node;
  public function __construct($firstName, $lastName) {
    $this->firstName = $firstName;
    $this->lastName = $lastName;
  }
}
