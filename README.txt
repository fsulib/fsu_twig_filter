
1) Create Desired Image Style at - admin/config/media/image-styles

2) Use below code to render image with style you've created in step-1, here "block_template_test_style" is image style name


  {% set image_style_url = image_style(item.content['#field_collection_item'].field_image.entity.fid.value, ['block_template_test_style']) %}

            <div class="col-xs-4">
              <img class="img-responsive img-expand" alt="" src="{{ image_style_url[block_template_test_style] }}">
            </div>