<?php

namespace Drupal\dipaks_module\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Class RouteController.
 */
class RouteController extends ControllerBase {

  /**
   * Hellodynamic.
   *
   * @return string
   *   Return Hello string.
   */
  public function helloDynamic($name) {
    return [
      '#type' => 'markup',
      '#markup' => $this->t('Hello @name', [
        '@name' => $name,
      ]),
    ];
  }

  /**
   * Hellodynamic.
   *
   * @return string
   *   Return Hello string.
   */
  public function helloWorld() {
    return [
      '#type' => 'markup',
      '#markup' => $this->t('Hello'),
    ];
  }

}
