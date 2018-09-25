<?php

namespace Drupal\d8_routing_demo\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Messenger\MessengerInterface;
use Drupal\Core\Form\FormStateInterface;

/**
 * Defines a simple.
 */
class SimpleForm extends FormBase {
  /**
   * @inheritDoc
   */
  public function getFormId() {
    return 'd8_routing_demo_simple_form';
  }


  /**
   * @inheritDoc
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form ['demo_textfield'] = [
      '#type' => 'textfield',
      '#title' => t('Enter some text'),
      '#size' => 60,
      '#maxlength' => 128,
      '#required' => TRUE,
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
  public function validateForm(array &$form, FormStateInterface $form_state) {
    if (strlen($form_state->getValue('demo_textfield')) < 5) {
      $form_state->setErrorByName(
        'demo_textfield',
        $this->t('Text should be at least 5 characters long.')
      );
    }
  }

  /**
   * @inheritDoc
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->messenger()->addMessage(
      $this->t('Form submitted successfully.')
    );
  }
}
