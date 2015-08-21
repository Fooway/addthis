<?php

/**
 * @file
 * Contains \Drupal\addthis\Element\AddThisBasicButton
 */
namespace Drupal\addthis\Element;

use Drupal\Core\Render\Element\RenderElement;
use Drupal\Core\Template\Attribute;

/**
 * Class AddThisBasicButton
 *
 * @RenderElement("addthis_basic_button")
 */
class AddThisBasicButton extends RenderElement {

  /**
   * {@inheritdoc}
   */
  public function getInfo() {
    $class = get_class($this);
    $config = $this->configuration;
    return [
      '#theme' => 'addthis_basic_button',
      '#size' => $config['basic_button']['button_size'],
      '#extra_classes' => $config['basic_button']['extra_css'],
      '#pre_render' => [
        [$class, 'preRender'],
      ],
    ];
  }

  public function preRender($element) {
    // Add button.
    $button_img = 'http://s7.addthis.com/static/btn/sm-share-en.gif';
    if ($element['size'] === 'big') {
      $button_img = 'http://s7.addthis.com/static/btn/v2/lg-share-en.gif';
    }

    // Create img button.
    $element['image'] = [
      '#theme' => 'image',
      '#uri' => $button_img,
      '#alt' => t('Share page with AddThis'),
    ];

    // Add Script.
    $element['#attached']['library'][] = 'addthis/addthis.widget';

    $script_manager = \Drupal::getContainer()->get('addthis.script_manager');

    $addThisConfig = $script_manager->getAddThisConfig();
    $addThisShareConfig = $script_manager->getAddThisShareConfig();

    $element['#attached']['drupalSettings']['addThisWidget'] = [
      'widgetScript' => 'http://example.dev/thing.js',
      'config' => $addThisConfig,
      'share' => $addThisShareConfig,
    ];

    return $element;
  }

}