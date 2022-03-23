<?php

/**
 * @file
 * Contains \Drupal\fsu_twig_filter\Twig\RenderRegion.
 */

namespace Drupal\fsu_twig_filter\Twig;

/**
 * Adds extension to render a menu
 */
class RenderRegion extends \Twig_Extension
{

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'render_fsu_region';
    }

    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction(
                'render_fsu_region',
                [$this, 'render_fsu_region'],
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
    public function render_fsu_region($region_id)
    {
        $blocks = \Drupal::entityTypeManager()->getStorage('block')->loadByProperties([
            'region' => $region_id,
            'theme' => \Drupal::config('system.theme')->get('default'),
        ]);
        $build = [];
        foreach ($blocks as $block_id => $block) {
            /**
             * @var \Drupal\block\Entity\Block $block
             */
            if ($block->access('view') || $block->getPluginId() == "system_menu_block:main") {

                $markup = \Drupal::entityTypeManager()->getViewBuilder('block')->view($block);
                $build[$block_id] = $markup;
            }
        }
        $build['#region'] = $region_id;
        $build['#theme_wrappers'] = ['region'];
        return $build;
    }


}