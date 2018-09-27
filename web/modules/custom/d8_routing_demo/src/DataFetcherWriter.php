<?php
namespace Drupal\d8_routing_demo;

use Drupal\Core\Database\Connection;
use Drupal\Core\DependencyInjection\ContainerInjectionInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Component\EventDispatcher\ContainerAwareEventDispatcher;
use Drupal\d8_routing_demo\Event\DataEntryEvent;

/**
 *
 */
class DataFetcherWriter Implements ContainerInjectionInterface{
  protected $connection;
  protected $dispatcher;

  public function __construct(Connection $connection, ContainerAwareEventDispatcher $dispatcher) {
    $this->connection = $connection;
    $this->dispatcher = $dispatcher;
  }
  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('database'),
      $container->get('event_dispatcher')
    );
  }

  public function getLastEntry() {
    $result = $this->connection->select('d8_demo', 'dd')
      ->fields('dd')
      ->orderBy('id', 'DESC')
      ->range(0,1)
      ->execute()
      ->fetchAll();

    return $result[0];
  }

  public function submitEntry($firstName, $lastName) {
    $this->connection->insert('d8_demo')
      ->fields([
        'first_name' => $firstName,
        'last_name' => $lastName,
      ])
      ->execute();

    $this->dispatcher->dispatch(
      DataEntryEvent::DATA_INSERT,
      new DataEntryEvent($firstName, $lastName)
    );
    return $lastEntry;
  }
}
