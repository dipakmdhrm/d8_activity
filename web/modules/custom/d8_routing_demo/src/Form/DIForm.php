<?php

namespace Drupal\d8_routing_demo\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Messenger\MessengerInterface;
use Drupal\Core\Form\FormStateInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\d8_routing_demo\DataFetcherWriter;

/**
 * Defines a simple.
 */
class DIForm extends FormBase {
  protected $dataFetcherWriter;

  public function __construct(DataFetcherWriter $dataFetcherWriter) {
    $this->dataFetcherWriter = $dataFetcherWriter;
  }
  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('d8_routing_demo.data_fetcher_writer')
    );
  }

  /**
   * @inheritDoc
   */
  public function getFormId() {
    return 'd8_routing_demo_di_form';
  }


  /**
   * @inheritDoc
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $last_entry = $this->dataFetcherWriter->getLastEntry();

    $form ['first_name'] = [
      '#type' => 'textfield',
      '#title' => t('First Name'),
      '#size' => 40,
      '#maxlength' => 40,
      '#required' => TRUE,
      '#default_value' => !empty($last_entry->first_name) ? $last_entry->first_name : '',
    ];

    $form ['last_name'] = [
      '#type' => 'textfield',
      '#title' => t('Last Name'),
      '#size' => 40,
      '#maxlength' => 40,
      '#required' => TRUE,
      '#default_value' => !empty($last_entry->last_name) ? $last_entry->last_name : '',
    ];

    $form['submit'] = [
      '#type' => 'submit',
      '#value' => t('Submit')
    ];

    return $form;
  }

  /**
   * @inheritDoc
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $firstName = $form_state->getValue('first_name');
    $lastName = $form_state->getValue('last_name');

    try {
      $this->dataFetcherWriter->submitEntry($firstName, $lastName);
    }
    catch (Exception $e) {
      $this->messenger()->addMessage(
        $this->t($e->getMessage(), 'error')
      );
    }
  }
}
