<?php

// добавление расширенных возможностей
if (! function_exists('universal_theme_setup')) : 
	//Подключение файлов перевода
	load_theme_textdomain( 'universal', get_template_directory() . '/languages' ); 
	function universal_theme_setup() {
		// добавление тэга title
		add_theme_support( 'title-tag' );
		// Подключаем плагин счетчика просмотров статей
		add_theme_support( 'pageviews' );
		//  подключаем нужный вывод миниатюр
		add_theme_support( 'post-thumbnails', array( 'post', 'thumb') );  
		// добавление логатипа
		add_theme_support( 'custom-logo', [
		'width'       => 50,
		'flex-height' => true,
		'header-text' => 'Universal',
		'unlink-homepage-logo' => false, // WP 5.5
		] );
		
		// Регистрация меню
		register_nav_menus( [
				'header_menu' => __('Header menu' , 'universal'),
				'footer_menu' => __('Footer menu' , 'universal')
			] );
		
		add_action( 'init', 'register_post_types' );
    function register_post_types(){
	  register_post_type( 'lessons', [
		'label'  => null,
		'labels' => [
			'name'               => _x('Lessons' ,'taxonomy general name', 'universal'), // основное название для типа записи
			'singular_name'      => _x('Lesson' ,'taxonomy singular', 'universal'), // название для одной записи этого типа
			'add_new'            => __('Add lesson' , 'universal' ), // для добавления новой записи
			'add_new_item'       => __('Add New lesson' , 'universal'), // заголовка у вновь создаваемой записи в админ-панели.
			'edit_item'          => __('Edit lesson', 'universal'), // для редактирования типа записи
			'new_item'           => __('New lesson', 'universal'), // текст новой записи
			'view_item'          => __('Watch lessons', 'universal'), // для просмотра записи этого типа.
			'search_items'       => __('Search lessons', 'universal'), // для поиска по этим типам записи
			'not_found'          => __('Lesson not found', 'universal'), // если в результате поиска ничего не было найдено
			'not_found_in_trash' => __('Lesson not found in trach', 'universal'), // если не было найдено в корзине
			'parent_item_colon'  => '', // для родителей (у древовидных типов)
			'menu_name'          => __('Lessons', 'universal'), // название меню
		],
		'description'         => __('Lessons section', 'universal'),
		'public'              => true,
		// 'publicly_queryable'  => null, // зависит от public
		// 'exclude_from_search' => null, // зависит от public
		// 'show_ui'             => null, // зависит от public
		// 'show_in_nav_menus'   => null, // зависит от public
		'show_in_menu'        => true, // показывать ли в меню адмнки
		// 'show_in_admin_bar'   => null, // зависит от show_in_menu
		'show_in_rest'        => true, // добавить в REST API. C WP 4.7
		'rest_base'           => null, // $post_type. C WP 4.7
		'menu_position'       => 5,
		'menu_icon'           => 'dashicons-welcome-learn-more',
		'capability_type'   => 'post',
		//'capabilities'      => 'post', // массив дополнительных прав для этого типа записи
		//'map_meta_cap'      => null, // Ставим true чтобы включить дефолтный обработчик специальных прав
		'hierarchical'        => false,
		'supports'            => [ 'title', 'editor', 'thumbnail','custom-fields' ], // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
		'taxonomies'          => [],
		'has_archive'         => true,
		'rewrite'             => true,
		'query_var'           => true,
	] );

	
}
	// регистрирующая новые таксономии (create_lessons_taxonomies)
  add_action( 'init', 'create_lessons_taxonomies' );

  // функция, создающая 2 новые таксономии "themes" и "authors" для постов типа "book"
  function create_lessons_taxonomies(){

	// Добавляем древовидную таксономию 'themes' (как категории)
	register_taxonomy('themes', array('lessons'), array(
		'hierarchical'  => true,
		'labels'        => array(
			'name'              => _x( 'Themes', 'taxonomy general name','universal' ),
			'singular_name'     => _x( 'Theme', 'taxonomy singular name','universal' ),
			'search_items'      =>  __( 'Search Themes' ,'universal'),
			'all_items'         => __( 'All Themes' ,'universal'),
			'parent_item'       => __( 'Parent Theme' ,'universal'),
			'parent_item_colon' => __( 'Parent Theme:' ,'universal'),
			'edit_item'         => __( 'Edit Theme' ,'universal'),
			'update_item'       => __( 'Update Theme' ,'universal'),
			'add_new_item'      => __( 'Add New Theme' ,'universal'),
			'new_item_name'     => __( 'New Theme Name' ,'universal'),
			'menu_name'         => __( 'Theme' ,'universal'),
		),
		'show_ui'       => true,
		'query_var'     => true,
		'rewrite'       => array( 'slug' => 'the_theme' ), 
	));

	// Добавляем НЕ древовидную таксономию 'teacher' (как метки)
	register_taxonomy('teacher', 'lessons',array(
		'hierarchical'  => false,
		'labels'        => array(
			'name'                        => _x( 'Teachers', 'taxonomy general name' ,'universal'),
			'singular_name'               => _x( 'Teacher', 'taxonomy singular name','universal' ),
			'search_items'                =>  __( 'Search Teachers' ,'universal'),
			'popular_items'               => __( 'Popular Teachers' ,'universal'),
			'all_items'                   => __( 'All Teachers' ,'universal'),
			'parent_item'                 => null,
			'parent_item_colon'           => null,
			'edit_item'                   => __( 'Edit Teacher' ,'universal'),
			'update_item'                 => __( 'Update Teacher' ,'universal'),
			'add_new_item'                => __( 'Add New Teacher' ,'universal'),
			'new_item_name'               => __( 'New Teacher Name' ,'universal'),
			'separate_items_with_commas'  => __( 'Separate Teachers with commas' ,'universal'),
			'add_or_remove_items'         => __( 'Add or remove Teachers' ,'universal'),
			'choose_from_most_used'       => __( 'Choose from the most used teachers' ,'universal'),
			'menu_name'                   => __( 'Teachers' ,'universal'),
		),
		'show_ui'       => true,
		'query_var'     => true,
		'rewrite'       => array( 'slug' => 'the_teacher' ), 
	));
}
	
	}
endif;

// Хук функции setup
add_action( 'after_setup_theme', 'universal_theme_setup' );

// Задаем размеры миниатюр
add_image_size( 'thumb', 330, 186, true );

// Регистрация второго логотипа
function my_customize_register( $wp_customize ) {
    $wp_customize->add_setting('header_logo', array(
        'default' => '',
        'sanitize_callback' => 'absint',
    ));

    $wp_customize->add_control(new WP_Customize_Media_Control($wp_customize, 'header_logo', array(
        'section' => 'title_tagline',
        'label' => 'Логотип'
    )));

    $wp_customize->selective_refresh->add_partial('header_logo', array(
        'selector' => '.header-logo',
        'render_callback' => function() {
            $logo = get_theme_mod('header_logo');
            $img = wp_get_attachment_image_src($logo, 'full');
            if ($img) {
                return '<img src="' . $img[0] . '" alt="">';
            } else {
                return '';
            }
        }
    ));
}
add_action( 'customize_register', 'my_customize_register' );


// правильный способ подключить стили и скрипты темы
function universal_theme_scripts() {
	// подключаем файл стилей темы,
	wp_enqueue_style( 'style', get_stylesheet_uri() );
	wp_enqueue_style( 'swiper-style', get_template_directory_uri() . 
		'/assets/css/swiper-bundle.min.css',
		'style',
		 time() 
	);
	wp_enqueue_style( 'universal-style', get_template_directory_uri() . 
		'/assets/css/universal-theme.css', 
		'style',
		 time()
	);
	
// Подключаем шрифты
	wp_enqueue_style('Roboto-slab' , 
	"https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@700&display=swap"
	);	
// подключаем js файл темы,
	wp_deregister_script( 'jquery-core' );
	wp_register_script( 'jquery-core', '//code.jquery.com/jquery-3.5.1.min.js');
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'swiper', get_template_directory_uri() .
	 '/assets/js/swiper-bundle.min.js',  time() , true
	);
	 wp_enqueue_script( 'scripts', get_template_directory_uri() .
	 '/assets/js/scripts.js', 'swiper',  time() , true 
	);

}
// Хук подключения скриптов
add_action( 'wp_enqueue_scripts', 'universal_theme_scripts' );

add_action( 'wp_enqueue_scripts', 'adminAjax_data', 99 );
function adminAjax_data(){

	wp_localize_script( 'jquery', 'adminAjax', 
		array(
			'url' => admin_url('admin-ajax.php')
		)
	);  

}

// Функция настройки формы обратной связи 
// add_action('wp_ajax_contacts_form', 'ajax_form');
// add_action('wp_ajax_nopriv_contacts_form', 'ajax_form');
// function ajax_form() {
// 	$contact_name = $_POST['contact_name'];
// 	$contact_email = $_POST['contact_email'];
// 	$contact_comment = $_POST['contact_comment'];
// 	remove_all_filters( 'wp_mail_from' );
//   remove_all_filters( 'wp_mail_from_name' );
//   $headers = 'From: Bernard <green-toffee@yandex.ru>' . "\r\n";
// 	$message = 'Пользователь  ' . $contact_name . 'Отправил сообщение  ' . $message;
// 	$sent_massage = wp_mail('green-toffee@yandex.ru', 'Тема:', 'Новое сообщение', $headers, $message);
// 	if($sent_massage){
// 		echo 'success';
// 	} else {
// 		echo 'error';
// 	}
	
// 	wp_die();
// }
add_filter( 'wpcf7_validate_configuration', '__return_false' );

/*
 * Регестрируем виджет меню сайдбар.
*/
function universal_theme_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( __('Sidebar on main page'), 'universal' ),
			'id'            => 'main-sidebar',
			'description'   => esc_html__( __('Add widget here'), 'universal' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	register_sidebar( 
		array(
			'name'         =>  __('Bottom sidebar on main page' , 'universal'),
			'id'           => 'main-sidebar-bottom',
			'description'  => __('Widget on bottom of the main page' , 'universal'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title' => '<h4 class="widget-title">',
			'after_title'  => '</h4>'
		)
	);
	register_sidebar( 
		array(
			'name'          => esc_html__(  __('Footer navigation menu') , 'universal') ,
			'id'           =>  'sidebar-footer',
			'description'  =>   __('Add menu item in footer menu' , 'universal'),
			'before_widget' => '<section id="%1$s" class="menu-nav %2$s">',
			'after_widget'  => '</section>',
			'before_title' => '<h4 class="menu-title">',
			'after_title'  => '</h4>'
		)
	);
	register_sidebar( 
		array(
			'name' => esc_html__( __('Text in footer') , 'universal'),
			'id'           => 'text-footer',
			'description'  => __('Add text in footer', 'universal'),
			'before_widget' => '<section id="%1$s" class="footer-text-item %2$s">',
			'after_widget'  => '</section>',
			'before_title' => '',
			'after_title'  => ''
		)
	);	
	
}
add_action( 'widgets_init', 'universal_theme_widgets_init' );

//-----------------------------------------------------------------------------------------------
/**
 * Добавление нового виджета Downloader_Widget.
 */
class Downloader_Widget extends WP_Widget {

	// Регистрация виджета используя основной класс
	function __construct() {
		// вызов конструктора выглядит так:
		// __construct( $id_base, $name, $widget_options = array(), $control_options = array() )
		parent::__construct(
			'downloader_widget', // ID виджета, если не указать (оставить ''), то ID будет равен названию класса в нижнем регистре: downloader_widget
			__('Useful files', 'universal'),
			array( 'description' => __('Download files', 'universal'), 'classname' => 'widget-downloader' )
		);

		// скрипты/стили виджета, только если он активен
		 if ( is_active_widget( false, false, $this->id_base ) || is_customize_preview() ) {
			add_action('wp_enqueue_scripts', array( $this, 'add_downloader_widget_scripts' ));
			add_action('wp_head', array( $this, 'add_downloader_widget_style' ) );
		 }
	}

	/**
	 * Вывод виджета во Фронт-энде
	 *
	 * @param array $args     аргументы виджета.
	 * @param array $instance сохраненные данные из настроек
	 */
	function widget( $args, $instance ) {
		$title =  $instance['title'];
		$descriptions =  $instance['descriptions'];
		$link = $instance['link'];

		echo $args['before_widget'];
		if ( ! empty( $title ) ) {
			echo $args['before_title'] . $title . $args['after_title'];
		}
		if ( ! empty( $descriptions ) ) {
			echo '<p class = "widget-description">'. $descriptions . '</p>';
		}
		if ( ! empty( $link ) ) {
			echo '<a target ="_blank" class="widget-link"  href = "'. $link .'"> 
		   Скачать </a>';
		}
		
		echo $args['after_widget'];
	}


	/**
	 * Админ-часть виджета
	 *
	 * @param array $instance сохраненные данные из настроек
	 */
	function form( $instance ) {
		$title = @ $instance['title'] ?: 	__('Useful files', 'universal');
		$descriptions = @ $instance['descriptions'] ?: 	__('Desctiptions', 'universal');
		$link = @ $instance['link'] ?: 	__('Link', 'universal');
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 	__('Title', 'universal') ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'descriptions' ); ?>"><?php _e( __('Desctiptions', 'universal') ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'descriptions' ); ?>" name="<?php echo $this->get_field_name( 'descriptions' ); ?>" type="text" value="<?php echo esc_attr( $descriptions ); ?>">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'link' ); ?>"><?php _e(__('Link', 'universal')); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'link' ); ?>" name="<?php echo $this->get_field_name( 'link' ); ?>" type="text" value="<?php echo esc_attr( $link ); ?>">
		</p>
		<?php 
	}

	/**
	 * Сохранение настроек виджета. Здесь данные должны быть очищены и возвращены для сохранения их в базу данных.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance новые настройки
	 * @param array $old_instance предыдущие настройки
	 *
	 * @return array данные которые будут сохранены
	 */
	function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['descriptions'] = ( ! empty( $new_instance['descriptions'] ) ) ? strip_tags( $new_instance['descriptions'] ) : '';
		$instance['link'] = ( ! empty( $new_instance['link'] ) ) ? strip_tags( $new_instance['link'] ) : '';
		
		return $instance;
	}

	// скрипт виджета
	function add_downloader_widget_scripts() {
		// фильтр чтобы можно было отключить скрипты
		if( ! apply_filters( 'show_downloader_widget_script', true, $this->id_base ) )
			return;

		// $theme_url = get_stylesheet_directory_uri();

		// wp_enqueue_script('my_widget_script', $theme_url .'/my_widget_script.js' );
	}

	// стили виджета
	function add_downloader_widget_style() {
		// фильтр чтобы можно было отключить стили
		if( ! apply_filters( 'show_downloader_widget_style', true, $this->id_base ) )
			return;
			?>
		<style type="text/css">
			.my_widget a{ display:inline; }
		</style>
		<?php
	}

} 
// конец класса Downloader_Widget

// регистрация Downloader_Widget в WordPress
function register_downloader_widget() {
	register_widget( 'Downloader_Widget' );
}
add_action( 'widgets_init', 'register_downloader_widget' );

//------------------------------------------------------------------------------------------------

// Добавление нового виджета соц-сетей Sosial_Widget

class Soсial_Widget extends WP_Widget {
			// Регистрация виджета используя основной класс
	function __construct() {
		// вызов конструктора выглядит так:
		// __construct( $id_base, $name, $widget_options = array(), $control_options = array() )
		parent::__construct(
			'sosial_widget', // ID виджета, если не указать (оставить ''), то ID будет равен названию класса в нижнем регистре: soсial_widget
			__('Social Widget', 'universal'),
			array( 'description' => __('Social Widget', 'universal'), 'classname' => 'widget_soсial' )
		);
	}

	/**
	 * Вывод виджета во Фронт-энде
	 *
	 * @param array $args     аргументы виджета.
	 * @param array $instance сохраненные данные из настроек
	 */
	function widget( $args, $instance ) {
		$title2 = $instance['title2'] ;
		$link_1 = $instance['link_1'] ;
		$link_2 = $instance['link_2'] ;
		$link_3 = $instance['link_3'] ;
		

		echo $args['before_widget'];
		
		if ( ! empty( $title2 ) ) {
			echo $args['before_title'] . $title2 . $args['after_title'];
		}
		echo '<div class="social-links">';
		if ( ! empty( $link_1 ) ) {
				echo '<span class="link_1"><a target ="_blank" href = "'. $link_1 .'"> 
		  </a></span>';
		}
		if ( ! empty( $link_2 ) ) {
			echo '<span class="link_2"><a target ="_blank"   href = "'.$link_2 .'"> 
		  </a></span>';
		}
		if ( ! empty( $link_3 ) ) {
			echo '<span  class="link_3"><a target ="_blank"  href = "'. $link_3 .'"> 
		  </a></span>';
		}
		echo '</div>';
		echo $args['after_widget'];
	}
	

	/**
	 * Админ-часть виджета
	 *
	 * @param array $instance сохраненные данные из настроек
	 */
	function form( $instance ) {
		$title2 = @ $instance['title2'] ?: __('Widget Title' , 'universal');
		$social_name_1 = @ $instance['social_name_1'] ?: __('Social name', 'universal');
		$social_name_2 = @ $instance['social_name_2'] ?: __('Social name', 'universal');
		$social_name_3 = @ $instance['social_name_3'] ?: __('Social name', 'universal');
		$link_1 =  @ $instance['link_1'] ?: __('Social link' , 'universal');
		$link_2 =  @ $instance['link_2'] ?: __('Social link' , 'universal');
		$link_3 =  @ $instance['link_3'] ?: __('Social link' , 'universal');
		
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title2' ); ?>"><?php _e(  __('Widget Title' , 'universal') ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'title2' ); ?>" name="<?php echo $this->get_field_name( 'title2' ); ?>" type="text" value="<?php echo esc_attr( $title2 ); ?>">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'social_name_1' ); ?>"><?php _e( __('Social name', 'universal')); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'social_name_1' ); ?>" name="<?php echo $this->get_field_name( 'social_name_1' ); ?>" type="text" value="<?php echo esc_attr( $social_name_1); ?>">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'link_1' ); ?>"><?php _e( __('Social link' , 'universal') ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'link_1' ); ?>" name="<?php echo $this->get_field_name( 'link_1' ); ?>" type="text" value="<?php echo esc_attr( $link_1 ); ?>">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'social_name_2' ); ?>"><?php _e( __('Social name', 'universal')); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'social_name_2' ); ?>" name="<?php echo $this->get_field_name( 'social_name_2' ); ?>" type="text" value="<?php echo esc_attr( $social_name_2); ?>">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'link_2' ); ?>"><?php _e(__('Social link' , 'universal')); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'link_2' ); ?>" name="<?php echo $this->get_field_name( 'link_2' ); ?>" type="text" value="<?php echo esc_attr( $link_2 ); ?>">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'social_name_3' ); ?>"><?php _e( __('Social name', 'universal')); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'social_name_3' ); ?>" name="<?php echo $this->get_field_name( 'social_name_3' ); ?>" type="text" value="<?php echo esc_attr( $social_name_3); ?>">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'link_3' ); ?>"><?php _e(__('Social link' , 'universal')); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'link_3' ); ?>" name="<?php echo $this->get_field_name( 'link_3' ); ?>" type="text" value="<?php echo esc_attr( $link_3 ); ?>">
		</p>
		
		<?
	
	}

		/**
	 * Сохранение настроек виджета. Здесь данные должны быть очищены и возвращены для сохранения их в базу данных.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance новые настройки
	 * @param array $old_instance предыдущие настройки
	 *
	 * @return array данные которые будут сохранены
	 */
	function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title2'] = ( ! empty( $new_instance['title2'] ) ) ? strip_tags( $new_instance['title2'] ) : '';
		$instance['social_name_1'] = ( ! empty( $new_instance['social_name_1'] ) ) ? strip_tags( $new_instance['social_name_1'] ) : '';
		$instance['social_name_2'] = ( ! empty( $new_instance['social_name_2'] ) ) ? strip_tags( $new_instance['social_name_2'] ) : '';
		$instance['social_name_3'] = ( ! empty( $new_instance['social_name_3'] ) ) ? strip_tags( $new_instance['social_name_3'] ) : '';
		$instance['link_1'] = ( ! empty( $new_instance['link_1'] ) ) ? strip_tags( $new_instance['link_1'] ) : '';
		$instance['link_2'] = ( ! empty( $new_instance['link_2'] ) ) ? strip_tags( $new_instance['link_2'] ) : '';
		$instance['link_3'] = ( ! empty( $new_instance['link_3'] ) ) ? strip_tags( $new_instance['link_3'] ) : '';
		
		return $instance;
	}


}
// окончание виджета соц-сетей Sosial_Widget

// регистрация Sosial_Widget в WordPress
function register_soсial_widget() {
	register_widget( 'Soсial_Widget' );
}
add_action( 'widgets_init', 'register_soсial_widget' );

//------------------------------------------------------------------------------------------
/**
 * Добавление нового виджета Recent_Post_Widget.
 */
class Recent_Post_Widget extends WP_Widget {

	// Регистрация виджета используя основной класс
	function __construct() {
		// вызов конструктора выглядит так:
		// __construct( $id_base, $name, $widget_options = array(), $control_options = array() )
		parent::__construct(
			'recent_post_widget', // ID виджета, если не указать (оставить ''), то ID будет равен названию класса в нижнем регистре: recent_post_widget
			__('Last published posts', 'universal'),
			array( 'description' => __('Last published posts', 'universal'), 'classname' => 'widget-recent_post' )
		);

		// скрипты/стили виджета, только если он активен
		 if ( is_active_widget( false, false, $this->id_base ) || is_customize_preview() ) {
			add_action('wp_enqueue_scripts', array( $this, 'add_recent_post_widget_scripts' ));
			add_action('wp_head', array( $this, 'add_recent_post_widget_style' ) );
		 }
	}

	/**
	 * Вывод виджета во Фронт-энде
	 *
	 * @param array $args     аргументы виджета.
	 * @param array $instance сохраненные данные из настроек
	 */
	function widget( $args, $instance ) {
		$title =  $instance[ 'title' ] ;
		$count =  $instance[ 'count' ] ;
		
		
		echo $args['before_widget'];
		echo '<div class="recent-post-wrapper">';
		
		if (! empty($count)) {
			if ( ! empty( $title ) ) {
			echo $args['before_title'] . $title . $args['after_title'];
			}
			global $post;
			$postslist = get_posts( array( 'posts_per_page' => $count, 'order'=> 'ASC', 'orderby' => 'title' ) );
			foreach ( $postslist as $post ){
			setup_postdata($post);
			?>
		
		<div class="recent-post-items">
		<a href="<?= get_the_permalink() ?>" class="recent-post-link">
		<img src="<?php
						//должно находится внутри цикла
        if( has_post_thumbnail() ) {
         	echo get_the_post_thumbnail_url(null, 'thumbnail');
         }
        else {
	      echo get_template_directory_uri() . '/assets/images/image-default.png';
         }
		 ?>" alt="" class="recent-post-image">
		<div class="recent-post-info">
			<?= wp_trim_words( get_the_title(), 4, $more = ' …' ); ?> <br>
			<span class="recent-post-time">
				<?php $time_diff = human_time_diff( get_post_time('U'), current_time('timestamp') );
			echo " $time_diff назад.";?>
			
			</span>
    
		</div>
		</a>
		</div>
		
			
		<?php
		}
				wp_reset_postdata();
				echo '<a href="#" class="recent-post-btn">Read more</a>';
				echo '</div>';
		}
		
		
		echo $args['after_widget'];
	}


	/**
	 * Админ-часть виджета
	 *
	 * @param array $instance сохраненные данные из настроек
	 */
	function form( $instance ) {
		$title = @ $instance[ 'title' ] ?: __('Title', 'universal') ;
		$count = @ $instance[ 'count' ] ?: __('Counter for the published posts:', 'universal') ;
	
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( __('Title', 'universal')); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'count' ); ?>"><?php _e( __('Counter for the published posts:', 'universal')); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'count' ); ?>" name="<?php echo $this->get_field_name( 'count' ); ?>" type="text" value="<?php echo esc_attr( $count ); ?>">
		</p>
		
		<?php 
	}

	/**
	 * Сохранение настроек виджета. Здесь данные должны быть очищены и возвращены для сохранения их в базу данных.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance новые настройки
	 * @param array $old_instance предыдущие настройки
	 *
	 * @return array данные которые будут сохранены
	 */
	function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['count'] = ( ! empty( $new_instance['count'] ) ) ? strip_tags( $new_instance['count'] ) : '';
		
		return $instance;
	}

	// скрипт виджета
	function add_recent_post_widget_scripts() {
		// фильтр чтобы можно было отключить скрипты
		if( ! apply_filters( 'show_recent_post_widget_script', true, $this->id_base ) )
			return;

		// $theme_url = get_stylesheet_directory_uri();

		// wp_enqueue_script('my_widget_script', $theme_url .'/my_widget_script.js' );
	}

	// стили виджета
	function add_recent_post_widget_style() {
		// фильтр чтобы можно было отключить стили
		if( ! apply_filters( 'show_recent_post_widget_style', true, $this->id_base ) )
			return;
			?>
		<style type="text/css">
			.my_widget a{ display:inline; }
		</style>
		<?php
	}

} 
// конец класса Recent_Post_Widget

// регистрация Recent_Post_Widget в WordPress
function register_recent_post_widget() {
	register_widget( 'Recent_Post_Widget' );
}
add_action( 'widgets_init', 'register_recent_post_widget' );

//--------------------------------------------------------

// Изменяем настройки облака тэгов
add_filter( 'widget_tag_cloud_args', 'edit_widget_tag_cloud_arg');
function edit_widget_tag_cloud_arg( $args){
	// filter...
	$args['unit'] = 'px';
	$args['largest'] = '14';
	$args['smallest'] = '14';
	$args['number'] = '9';

	return $args;
}



## отключаем создание миниатюр файлов для указанных размеров
add_filter( 'intermediate_image_sizes', 'delete_intermediate_image_sizes' );
function delete_intermediate_image_sizes( $sizes ){
	// размеры которые нужно удалить
	return array_diff( $sizes, [
		'medium_large',
		'large',
		'1536x1536',
		'2048x2048'
	] );
}
// меняем стили многоточия в отрывках
add_filter('exerpt_more' , function($more){
	return '...';

});

// функция склонения слов после числительных
function plural_form($number, $after) {
	$cases = array (2, 0, 1, 1, 1, 2);
	echo $number.' '.$after[ ($number%100>4 && $number%100<20)? 2: $cases[min($number%10, 5)] ];
}

// удаляет H2 из шаблона пагинации
add_filter('navigation_markup_template', 'my_navigation_template', 10, 2 );
function my_navigation_template( $template, $class ){
	/*
	Вид базового шаблона:
	<nav class="navigation %1$s" role="navigation">
		<h2 class="screen-reader-text">%2$s</h2>
		<div class="nav-links">%3$s</div>
	</nav>
	*/

	return '
	<nav class="navigation %1$s" role="navigation">
		<div class="nav-links">%3$s</div>
	</nav>    
	';
}
 
/*
 * "Хлебные крошки" для WordPress
 * Author: Dimox
 * версия: 2019.03.03
 * лицензия: MIT
 */
function the_breadcrumbs() {

	/* === ОПЦИИ === */
	$text['home']     = 'Главная'; // текст ссылки "Главная"
	$text['cat_link'] = 'Категории'; // текст ссылки "Категории"
	$text['category'] = '%s'; // текст для страницы рубрики
	$text['search']   = 'Результаты поиска по запросу "%s"'; // текст для страницы с результатами поиска
	$text['tag']      = 'Записи с тегом "%s"'; // текст для страницы тега
	$text['author']   = 'Статьи автора %s'; // текст для страницы автора
	$text['404']      = 'Ошибка 404'; // текст для страницы 404
	$text['page']     = 'Страница %s'; // текст 'Страница N'
	$text['cpage']    = 'Страница комментариев %s'; // текст 'Страница комментариев N'

	$wrap_before    = '<div class="breadcrumbs" itemscope itemtype="http://schema.org/BreadcrumbList">'; // открывающий тег обертки
	$wrap_after     = '</div><!-- .breadcrumbs -->'; // закрывающий тег обертки
	$sep            = '<span class="breadcrumbs__separator"> › </span>'; // разделитель между "крошками"
	$before         = '<span class="breadcrumbs__current">'; // тег перед текущей "крошкой"
	$after          = '</span>'; // тег после текущей "крошки"

	$show_on_home   = 0; // 1 - показывать "хлебные крошки" на главной странице, 0 - не показывать
	$show_home_link = 1; // 1 - показывать ссылку "Главная", 0 - не показывать
	$show_current   = 1; // 1 - показывать название текущей страницы, 0 - не показывать
	$show_last_sep  = 1; // 1 - показывать последний разделитель, когда название текущей страницы не отображается, 0 - не показывать
	/* === КОНЕЦ ОПЦИЙ === */

	global $post;
	$home_url       = home_url('/');
	$link           = '<span itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">';
	$link          .= '<a class="breadcrumbs__link" href="%1$s" itemprop="item"><span itemprop="name">%2$s</span></a>';
	$link          .= '<meta itemprop="position" content="%3$s" />';
	$link          .= '</span>';
	$parent_id      = ( $post ) ? $post->post_parent : '';
	$home_link      = sprintf( $link,  $home_url, $text['home'] , 1 );
	

	if ( is_home() || is_front_page() ) {

		if ( $show_on_home ) echo $wrap_before . $home_link . $wrap_after;

	} else {

		$position = 0;

		echo $wrap_before;

		if ( $show_home_link ) {
			$position += 1;
			echo $home_link;
		}

		if ( is_category() ) {
			$parents = get_ancestors( get_query_var('cat'), 'category' );
			echo $sep . $before . sprintf( $text['cat_link']) . $after;
			foreach ( array_reverse( $parents ) as $cat ) {
				$position += 1;
				if ( $position > 1 ) echo $sep;
				echo sprintf( $link, get_category_link( $cat ), get_cat_name( $cat ), $position );
			}
			if ( get_query_var( 'paged' ) ) {
				$position += 1;
				$cat = get_query_var('cat');
				echo $sep . sprintf( $link,  get_category_link( $cat ), get_cat_name( $cat ), $position );
				echo $sep . $before . sprintf( $text['page'], get_query_var( 'paged' ) ) . $after;
			} else {
				if ( $show_current ) {
					if ( $position >= 1 ) echo $sep;
					echo $before . sprintf( $text['category'], single_cat_title( '', false ) ) . $after;
				} elseif ( $show_last_sep ) echo $sep;
			}

		} elseif ( is_search() ) {
			if ( get_query_var( 'paged' ) ) {
				$position += 1;
				if ( $show_home_link ) echo $sep;
				echo sprintf( $link, $home_url . '?s=' . get_search_query(), sprintf( $text['search'], get_search_query() ), $position );
				echo $sep . $before . sprintf( $text['page'], get_query_var( 'paged' ) ) . $after;
			} else {
				if ( $show_current ) {
					if ( $position >= 1 ) echo $sep;
					echo $before . sprintf( $text['search'], get_search_query() ) . $after;
				} elseif ( $show_last_sep ) echo $sep;
			}

		} elseif ( is_year() ) {
			if ( $show_home_link && $show_current ) echo $sep;
			if ( $show_current ) echo $before . get_the_time('Y') . $after;
			elseif ( $show_home_link && $show_last_sep ) echo $sep;

		} elseif ( is_month() ) {
			if ( $show_home_link ) echo $sep;
			$position += 1;
			echo sprintf( $link, get_year_link( get_the_time('Y') ), get_the_time('Y'), $position );
			if ( $show_current ) echo $sep . $before . get_the_time('F') . $after;
			elseif ( $show_last_sep ) echo $sep;

		} elseif ( is_day() ) {
			if ( $show_home_link ) echo $sep;
			$position += 1;
			echo sprintf( $link, get_year_link( get_the_time('Y') ), get_the_time('Y'), $position ) . $sep;
			$position += 1;
			echo sprintf( $link, get_month_link( get_the_time('Y'), get_the_time('m') ), get_the_time('F'), $position );
			if ( $show_current ) echo $sep . $before . get_the_time('d') . $after;
			elseif ( $show_last_sep ) echo $sep;

		} elseif ( is_single() && ! is_attachment() ) {
			if ( get_post_type() != 'post' ) {
				$position += 1;
				$post_type = get_post_type_object( get_post_type() );
				if ( $position > 1 ) echo $sep;
				echo sprintf( $link, get_post_type_archive_link( $post_type->name ), $post_type->labels->name, $position );
				if ( $show_current ) echo $sep . $before . get_the_title() . $after;
				elseif ( $show_last_sep ) echo $sep;
			} else {
				$cat = get_the_category(); $catID = $cat[0]->cat_ID;
				$parents = get_ancestors( $catID, 'category' );
				$parents = array_reverse( $parents );
				$parents[] = $catID;
				foreach ( $parents as $cat ) {
					$position += 1;
					if ( $position > 1 ) echo $sep;
					echo sprintf( $link, get_category_link( $cat ), get_cat_name( $cat ), $position );
				}
				if ( get_query_var( 'cpage' ) ) {
					$position += 1;
					echo $sep . sprintf( $link, get_permalink(), get_the_title(), $position );
					echo $sep . $before . sprintf( $text['cpage'], get_query_var( 'cpage' ) ) . $after;
				} else {
					if ( $show_current ) echo $sep . $before . get_the_title() . $after;
					elseif ( $show_last_sep ) echo $sep;
				}
			}

		} elseif ( is_post_type_archive() ) {
			$post_type = get_post_type_object( get_post_type() );
			if ( get_query_var( 'paged' ) ) {
				$position += 1;
				if ( $position > 1 ) echo $sep;
				echo sprintf( $link, get_post_type_archive_link( $post_type->name ), $post_type->label, $position );
				echo $sep . $before . sprintf( $text['page'], get_query_var( 'paged' ) ) . $after;
			} else {
				if ( $show_home_link && $show_current ) echo $sep;
				if ( $show_current ) echo $before . $post_type->label . $after;
				elseif ( $show_home_link && $show_last_sep ) echo $sep;
			}

		} elseif ( is_attachment() ) {
			$parent = get_post( $parent_id );
			$cat = get_the_category( $parent->ID ); $catID = $cat[0]->cat_ID;
			$parents = get_ancestors( $catID, 'category' );
			$parents = array_reverse( $parents );
			$parents[] = $catID;
			foreach ( $parents as $cat ) {
				$position += 1;
				if ( $position > 1 ) echo $sep;
				echo sprintf( $link, get_category_link( $cat ), get_cat_name( $cat ), $position );
			}
			$position += 1;
			echo $sep . sprintf( $link, get_permalink( $parent ), $parent->post_title, $position );
			if ( $show_current ) echo $sep . $before . get_the_title() . $after;
			elseif ( $show_last_sep ) echo $sep;

		} elseif ( is_page() && ! $parent_id ) {
			if ( $show_home_link && $show_current ) echo $sep;
			if ( $show_current ) echo $before . get_the_title() . $after;
			elseif ( $show_home_link && $show_last_sep ) echo $sep;

		} elseif ( is_page() && $parent_id ) {
			$parents = get_post_ancestors( get_the_ID() );
			foreach ( array_reverse( $parents ) as $pageID ) {
				$position += 1;
				if ( $position > 1 ) echo $sep;
				echo sprintf( $link, get_page_link( $pageID ), get_the_title( $pageID ), $position );
			}
			if ( $show_current ) echo $sep . $before . get_the_title() . $after;
			elseif ( $show_last_sep ) echo $sep;

		} elseif ( is_tag() ) {
			if ( get_query_var( 'paged' ) ) {
				$position += 1;
				$tagID = get_query_var( 'tag_id' );
				echo $sep . sprintf( $link, get_tag_link( $tagID ), single_tag_title( '', false ), $position );
				echo $sep . $before . sprintf( $text['page'], get_query_var( 'paged' ) ) . $after;
			} else {
				if ( $show_home_link && $show_current ) echo $sep;
				if ( $show_current ) echo $before . sprintf( $text['tag'], single_tag_title( '', false ) ) . $after;
				elseif ( $show_home_link && $show_last_sep ) echo $sep;
			}

		} elseif ( is_author() ) {
			$author = get_userdata( get_query_var( 'author' ) );
			if ( get_query_var( 'paged' ) ) {
				$position += 1;
				echo $sep . sprintf( $link, get_author_posts_url( $author->ID ), sprintf( $text['author'], $author->display_name ), $position );
				echo $sep . $before . sprintf( $text['page'], get_query_var( 'paged' ) ) . $after;
			} else {
				if ( $show_home_link && $show_current ) echo $sep;
				if ( $show_current ) echo $before . sprintf( $text['author'], $author->display_name ) . $after;
				elseif ( $show_home_link && $show_last_sep ) echo $sep;
			}

		} elseif ( is_404() ) {
			if ( $show_home_link && $show_current ) echo $sep;
			if ( $show_current ) echo $before . $text['404'] . $after;
			elseif ( $show_last_sep ) echo $sep;

		} elseif ( has_post_format() && ! is_singular() ) {
			if ( $show_home_link && $show_current ) echo $sep;
			echo get_post_format_string( get_post_format() );
		}

		echo $wrap_after;

	}
} // end of the_breadcrumbs()


  