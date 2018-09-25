<?php
namespace Drupal\d8_routing_demo;

use Drupal\Core\Database\Connection;
use Drupal\Core\DependencyInjection\ContainerInjectionInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 *
 */
class DataFetcherWriter Implements ContainerInjectionInterface{
  protected $connection;

  public function __construct(Connection $connection) {
    $this->connection = $connection;
  }
  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('database')
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
    return $this->connection->insert('d8_demo')
      ->fields([
        'first_name' => $firstName,
        'last_name' => $lastName,
      ])
      ->execute();
  }
}
