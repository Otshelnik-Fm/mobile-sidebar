<?php

/*

  ╔═╗╔╦╗╔═╗╔╦╗
  ║ ║ ║ ╠╣ ║║║ https://otshelnik-fm.ru
  ╚═╝ ╩ ╚  ╩ ╩

 */



function mbs_resource(){
    rcl_enqueue_style( 'mbs_style', rcl_addon_url('res/mobile-sidebar.css', __FILE__) );
    rcl_enqueue_script( 'mbs_script', rcl_addon_url( 'res/mobile-sidebar.js', __FILE__ ) );
}
add_action('rcl_enqueue_scripts','mbs_resource',10);



// регистрируем сайдбар
function mbs_register_widget(){
    register_sidebar( array(
        'name' => "Mobile Sidebar",
        'id' => 'mobile_sidebar',
        'description' => 'Сюда перетаскивайте нужные виджеты для мобильного меню',
        'class'         => 'mbs_widget_displayers',
        'before_widget' => '<div id="%1$s" class="widget %2$s mbs_one_wiget">',
        'after_widget'  => "</div>\n",
        'before_title'  => '<h3 class="mbs_title">',
        'after_title'   => "</h3>\n",
    ) );
}
add_action('widgets_init', 'mbs_register_widget');


// регистрируем одноразовый виджет (вставлять его можно только единожды)
wp_register_sidebar_widget(
    'otfm_mobile_sidebar',      // ID блока обёртки виджета
    'Mobile Sidebar: виджет',   // Заголовок виджета
    'mbs_widget_display',       // callback
    array(                      // опции
        'description' => 'Перенесите его в рабочий сайдбар'
    )
);

// коллбек виджета
function mbs_widget_display($args){
    echo $args['before_widget'];
    // Код виджета, при выводе в шаблон
    dynamic_sidebar('mobile_sidebar');
    echo $args['after_widget'];
}


// кнопка в реколлбаре
function mbs_add_recallbar_bttn(){
    $out = '<div id="mbs_bttn" style="display: none;">';
        $out .= '<i class="fa fa-chevron-down" aria-hidden="true"></i>';
        $out .= '<span>Меню</span>';
    $out .= '</div>';

    echo $out;
}
add_action('rcl_bar_left_icons', 'mbs_add_recallbar_bttn',10);

// кнопка в подвале
function mbs_add_menu_bttn(){
    echo '<div id="mbs_menu" class="mbs_menu_hidden"></div>';
}
add_action('wp_footer', 'mbs_add_menu_bttn', 500);


