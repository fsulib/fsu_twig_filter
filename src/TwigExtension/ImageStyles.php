<?php

/**
 * @file
 * Contains custom_migrate.module.
 */
namespace Drupal\fsu_twig_filter\TwigExtension;
 
use Drupal\node\Entity\Node;
use Drupal\Core\Link;
use Drupal\Core\Url;

use Drupal\file\Entity\File;
use Drupal\image\Entity\ImageStyle;

class ImageStyles extends \Twig\Extension\AbstractExtension {
 
    /**
     * Generates a list of all Twig functions that this extension defines.
     */
     public function getFunctions(){
         return array(
             new \Twig\TwigFunction('image_style', array($this, 'imageStyle'), array('is_safe' => array('html'))),
         );
     }

    /**
    * Gets a unique identifier for this Twig extension.
    */
    public function getName() {
        return 'fsu_twig_filter.twig.images';
    }


     /**
      * Generate images styles for given image
      */
      public static function imageStyle($file_id, $styles) {
          $file = File::load($file_id);
          $transform = array();
          if (isset($file->uri->value)) {
              $transform['source'] = $file->url();
              foreach ($styles as $style) {
                  $transform[$style] = ImageStyle::load($style)->buildUrl($file->uri->value);
              }
          }
         return $transform;
      }
 
}
