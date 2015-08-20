<?php
/**
 * @file
 * Contains \Drupal\addthis_fields\Plugin\Field\FieldFormatter\AddThisBasicButtonFormatter.
 */

namespace Drupal\addthis_fields\Plugin\Field\FieldFormatter;

use Drupal\addthis\AddThisBasicButtonFormTrait;
use Drupal\Core\Field\FormatterBase;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\addthis\AddThis;


/**
 * Plugin implementation of the 'addthis_basic_button' formatter.
 *
 * @FieldFormatter(
 *   id = "addthis_basic_button",
 *   label = @Translation("AddThis Basic Button"),
 *   field_types = {
 *     "addthis"
 *   }
 * )
 */
class AddThisBasicButtonFormatter extends FormatterBase {

  use AddThisBasicButtonFormTrait;
  /**
   * {@inheritdoc}
   */
  public static function defaultSettings() {
    return array(
      'button_size' => 'small',
      'extra_css' => '',
    ) + parent::defaultSettings();
  }

  /**
   * {@inheritdoc}
   */
  public function settingsForm(array $form, FormStateInterface $form_state) {
    $settings = $this->getSettings();
    $element = $this->addThisBasicButtonForm($settings);

    return $element;
  }


  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items) {
    $settings = $this->getSettings();
    $add_this_service = \Drupal::service('addthis.addthis');
    $markup = $add_this_service->getBasicButtonMarkup($settings);
    return array(
      '#markup' => $markup
    );
  }


}