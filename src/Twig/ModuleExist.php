<?php

/**
 * @file
 * Contains \Drupal\fsu_twig_filter\Twig\RenderRegion.
 */

namespace Drupal\fsu_twig_filter\Twig;

/**
 * Adds extension to render a menu
 */
class ModuleExist extends \Twig_Extension {

  /**
   * {@inheritdoc}
   */
  public function getName() {
    return 'module_exist';
  }

  public function getFunctions() {
    return [
      new \Twig_SimpleFunction(
        'module_exist',
          [$this, 'module_exist'],
          ['is_safe' => ['html']]
      ),
    ];
  }

  /**
   * Provides function to programmatically rendering a block.
   *
   * @param String $block_id
   *   The machine id of the block to render
   */
  public function module_exist($module) {
      if(\Drupal::moduleHandler()->moduleExists($module)){
          return true;
      }else{
          return false;
      }

  }


}