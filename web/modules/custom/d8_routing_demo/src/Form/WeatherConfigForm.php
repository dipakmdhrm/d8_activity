<?php

namespace Drupal\d8_routing_demo\Form;

use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Form\ConfigFormBase;

class WeatherConfigForm extends ConfigFormBase {
  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'd8_routing_demo_weather_config_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $app_id = $this->config('d8_routing_demo.weather')
      ->get('app_id');
    $form ['app_id'] = [
      '#type' => 'textfield',
      '#title' => t('App ID'),
      '#size' => 60,
      '#maxlength' => 128,
      '#required' => TRUE,
      '#default_value' => !empty($app_id) ? $app_id : '',
    ];

    $form['submit'] = [
      '#type' => 'submit',
      '#value' => t('Submit')
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $values = $form_state->getValues();
    $this->config('d8_routing_demo.weather')
      ->set('app_id', $values['app_id'])
      ->save();

    parent::submitForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'd8_routing_demo.weather',
    ];
  }
}
