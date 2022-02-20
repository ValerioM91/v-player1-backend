# Create block
red=`tput setaf 1`
green=`tput setaf 2`

read -p "Enter Block Name: " block_name

if [ -d "./blocks/$block_name" ]
then
    echo "${red}Block already exists"
else

read -p "Enter Block Title: " title
read -p "Heading: (y/n) " heading_true_false
read -p "Content: (y/n) " content_true_false
read -p "Image: (y/n) " image_true_false
read -p "Buttons: (y/n) " buttons_true_false
if [ $buttons_true_false == 'y' ]
then
read -p "Max Buttons?: (number) " max_buttons
fi

if [ $heading_true_false == 'y' ]
then
heading=$(cat <<-EOM
{
      "key": "field_$block_name-heading-type",
      "label": "Heading Type",
      "name": "heading_type",
      "type": "select",
      "instructions": "Choose a heading tag for this block",
      "required": 0,
      "conditional_logic": 0,
      "wrapper": {
        "width": "40",
        "class": "",
        "id": ""
      },
      "choices": {
        "h1": "H1",
        "h2": "H2",
        "h3": "H3",
        "h4": "H4",
        "h5": "H5",
        "h6": "H6"
      },
      "default_value": "h2",
      "allow_null": 0,
      "multiple": 0,
      "ui": 0,
      "return_format": "value",
      "ajax": 0,
      "placeholder": ""
    },
    {
      "key": "field_$block_name-heading",
      "label": "Heading",
      "name": "heading",
      "type": "text",
      "instructions": "",
      "required": 0,
      "conditional_logic": 0,
      "wrapper": {
          "width": "",
          "class": "",
          "id": ""
      },
      "default_value": "",
      "placeholder": "",
      "prepend": "",
      "append": "",
      "maxlength": ""
    },
EOM
)
fi

if [ $heading_true_false == 'y' ]
then
heading_fields=$(cat <<-EOM
'heading_type'          => get_field( 'heading_type' ),
                'heading'               => get_field( 'heading' ),
EOM
)
fi

if [ $content_true_false == 'y' ]
then
content=$(cat <<-EOM
    {
      "key": "field_$block_name-content",
      "label": "Content",
      "name": "content",
      "type": "wysiwyg",
      "instructions": "",
      "required": 0,
      "conditional_logic": 0,
      "wrapper": {
        "width": "",
        "class": "",
        "id": ""
      },
      "default_value": "",
      "tabs": "all",
      "toolbar": "full",
      "media_upload": 0
    },
EOM
)
fi

if [ $content_true_false == 'y' ]
then
content_fields=$(cat <<-EOM
'content'               => get_field( 'content' ),
EOM
)
fi

if [ $image_true_false == 'y' ]
then
image=$(cat <<-EOM
    {
      "key": "field_$block_name-image",
      "label": "Image",
      "name": "image",
      "type": "image",
      "instructions": "",
      "required": 0,
      "conditional_logic": 0,
      "wrapper": {
        "width": "",
        "class": "",
        "id": ""
      },
      "return_format": "id",
      "preview_size": "thumbnail",
      "library": "all",
      "min_width": "",
      "min_height": "",
      "min_size": "",
      "max_width": "",
      "max_height": "",
      "max_size": "",
      "mime_types": ""
    },
EOM
)
fi

if [ $image_true_false == 'y' ]
then
image_fields=$(cat <<-EOM
'image'                 => get_field( 'image' ),
EOM
)
fi


if [ $buttons_true_false == 'y' ]
then
buttons=$(cat <<-EOM
    {
      "key": "field_$block_name-buttons-repeater",
      "label": "Buttons",
      "name": "buttons",
      "type": "repeater",
      "instructions": "",
      "required": 0,
      "conditional_logic": 0,
      "wrapper": {
        "width": "",
        "class": "",
        "id": ""
      },
      "collapsed": "",
      "min": 0,
      "max": "$max_buttons",
      "layout": "block",
      "button_label": "Add Button",
      "sub_fields": [
        {
          "key": "field_$block_name-buttons-color",
          "label": "Button Color",
          "name": "color",
          "type": "select",
          "instructions": "",
          "required": 0,
          "conditional_logic": 0,
          "wrapper": {
            "width": "25",
            "class": "",
            "id": ""
          },
          "choices": {
            "primary": "Primary Colour",
            "secondary": "Secondary Colour",
            "tertiary": "Tertiary Colour",
            "quaternary": "Quaternary Colour",
            "quinary": "Quinary Color",
            "senary": "Senary Color",
            "white": "White Color"
          },
          "default_value": "primary",
          "allow_null": 0,
          "multiple": 0,
          "ui": 0,
          "return_format": "value",
          "ajax": 0,
          "placeholder": ""
        },
        {
          "key": "field_$block_name-buttons-type",
          "label": "Button Type",
          "name": "type",
          "type": "select",
          "instructions": "",
          "required": 0,
          "conditional_logic": 0,
          "wrapper": {
            "width": "25",
            "class": "",
            "id": ""
          },
          "choices": {
            "": "Full",
            "outline": "Outlined"
          },
          "default_value": "",
          "allow_null": 0,
          "multiple": 0,
          "ui": 0,
          "return_format": "value",
          "ajax": 0,
          "placeholder": ""
        },
        {
          "key": "field_$block_name-buttons-label",
          "label": "Button Label",
          "name": "label",
          "type": "text",
          "instructions": "",
          "required": 0,
          "conditional_logic": 0,
          "wrapper": {
            "width": "25",
            "class": "",
            "id": ""
          },
          "default_value": "",
          "placeholder": "",
          "prepend": "",
          "append": "",
          "maxlength": ""
        },
        {
          "key": "field_$block_name-buttons-url",
          "label": "Link URL",
          "name": "link",
          "type": "text",
          "instructions": "",
          "required": 0,
          "conditional_logic": 0,
          "wrapper": {
            "width": "25",
            "class": "",
            "id": ""
          },
          "default_value": "",
          "placeholder": "",
          "prepend": "",
          "append": "",
          "maxlength": ""
        }
      ]
    }
EOM
)
fi

if [ $buttons_true_false == 'y' ]
then
buttons_fields=$(cat <<-EOM
'buttons'               => get_field( 'buttons' ),
EOM
)
fi




    mkdir -p -- "./blocks/$block_name" && touch -- "./blocks/$block_name/$block_name.json" && touch -- "./blocks/$block_name/$block_name.php"

cat <<EOF >./blocks/$block_name/$block_name.json
{
  "key": "group_$block_name",
  "title": "$title",
  "fields": [
      $heading
      $content
      $image
      $buttons
  ],
  "location": [
      [
          {
              "param": "block",
              "operator": "==",
              "value": "acf\/$block_name"
          }
      ]
  ],
  "menu_order": 0,
  "position": "normal",
  "style": "default",
  "label_placement": "top",
  "instruction_placement": "label",
  "hide_on_screen": "",
  "active": true,
  "description": "",
  "modified": 1591085985
}
EOF

cat <<EOF >./blocks/$block_name/$block_name.php
<?php
if ( function_exists( 'acf_register_block' ) ) {

    acf_register_block( array(
        'name'              => '$block_name',
        'title'             => __( '$title', 'translation' ),
        'description'       => __( '', 'translation' ),
        'align'             => 'full',
        'category'          => 'content',
        'icon'              => 'desktop',
        'keywords'          => array( 'content' ),
        'mode'              => 'edit',
        'supports'          => array('mode' => false),
        'render_callback'   => 'vp1_${block_name//[-]/_}',
        'data'              => placeholder_content(
            array(
                'heading' => __( '$title', 'translation' )
            )
        ),
        'example'  => array(
            'attributes' => array(
                'mode' => 'preview',
                'data' => array(
                    'preview_image_help' => get_template_directory_uri() . '/blocks/$block_name/$block_name.jpg',
                )
            )
        )
    ));
}

function vp1_${block_name//[-]/_}( \$block ) {

    if( isset( \$block['data']['preview_image_help'] )  ) :    /* rendering in inserter preview  */

        echo '<img src="' . \$block['data']['preview_image_help'] .'" style="width:100%; height:auto;">';

    endif;
}
?>
EOF

    echo "${green}Block created"
fi