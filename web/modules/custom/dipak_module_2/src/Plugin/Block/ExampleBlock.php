<?php

namespace Drupal\dipak_module_2\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'Example' block.
 *
 * @Block(
 *   id = "dipak_module_2_example",
 *   admin_label = @Translation("Example"),
 *   category = @Translation("dipak_module_2")
 * )
 */
class ExampleBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    $build['content'] = [
      '#markup' => $this->t('It works!'),
    ];
    return $build;
  }

}
