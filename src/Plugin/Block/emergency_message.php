<?php

namespace Drupal\syd_tweaks\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides a 'emergency_message' block.
 *
 * @Block(
 *  id = "emergency_message",
 *  admin_label = @Translation("Emergency Message"),
 * )
 */
class emergency_message extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function defaultConfiguration() {
    return [
                ] + parent::defaultConfiguration();
  }

  /**
   * {@inheritdoc}
   */
  public function blockForm($form, FormStateInterface $form_state) {
    $form['display_message'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Display message'),
      '#default_value' => $this->configuration['display_message'],
      '#weight' => '0',
    ];
    $form['message'] = [
      '#type' => 'text_format',
      '#title' => $this->t('Message'),
      '#default_value' => $this->configuration['message']['value'],
      '#weight' => '1',
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function blockSubmit($form, FormStateInterface $form_state) {
    $this->configuration['display_message'] = $form_state->getValue('display_message');
    $this->configuration['message'] = $form_state->getValue('message');
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    $build = [];
    $build['emergency_message_display_message']['#markup'] = $this->configuration['display_message'];
    $build['emergency_message_message']['#markup'] = $this->configuration['message']['value'];

    return $build;
  }

}
