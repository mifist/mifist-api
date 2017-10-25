<?php
/**
 * Created by PhpStorm.
 * User: avant
 * Date: 28.02.17
 * Time: 21:18
 */
namespace includes\custom_post_type;

class PortfolioPostType {
	
	public function __construct()
	{
		/*
		 * Регистрируем Custom Post Type
		 */
		add_action( 'init', array( &$this, 'registerPortfolioPostType' ) );
		
		// хук, через который подключается функция
		// регистрирующая новые таксономии  createPortfolioTaxonomies
		add_action( 'init', array( &$this, 'createPortfolioTaxonomies' ) );
		
		// Сообщения при публикации или изменении типа записи portfolio
		add_filter('post_updated_messages',  array( &$this, 'portfolioUpdatedMessages' ));
		// Раздел "помощь" типа записи portfolio
		add_action( 'contextual_help', array( &$this, 'addHelpText' ), 10, 3 );
		
		// подключаем функцию активации мета блока (my_extra_fields)
		add_action('add_meta_boxes', array( &$this, 'priceExtraFields' ), 1);
		
		// включаем обновление полей при сохранении
		add_action('save_post', array( &$this, 'priceExtraFieldsUpdate' ), 0);
		
		// фильтр передает переменную $template - путь до файла шаблона.
		// Изменяя этот путь мы изменяем файл шаблона.
		add_filter('template_include',  array( &$this, 'my_template' ));
		
	}
	
	public function registerPortfolioPostType(){
		/*
		* Регистрируем новый тип записи
		*/
		register_post_type('mif_portfolio', array(
			'labels'             => array(
				'name'               => 'Портфолио', // Основное название типа записи
				'singular_name'      => 'Портфолио', // отдельное название записи типа Portfolio
				'add_new'            => 'Добавить новый элемент',
				'add_new_item'       => 'Добавить новый элемент портфолио',
				'edit_item'          => 'Редактировать портфолио',
				'new_item'           => 'Новая книга',
				'view_item'          => 'Посмотреть портфолио',
				'search_items'       => 'Найти элемент портфолио',
				'not_found'          => 'Портфолио не найдено',
				'not_found_in_trash' => 'В корзине портфолио не найдено',
				'parent_item_colon'  => '',
				'menu_name'          => 'Портфолио'
			
			),
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => array( 'slug' => 'mif_portfolio' ),
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => null,
			'supports'           => array('title','editor','author','thumbnail'),
			'taxonomies'          => array( 'sites', 'other' ),
		) );
		
		
	}

	
	public function portfolioUpdatedMessages(){
		global $post;
		
		$messages['mif_portfolio'] = array(
			0 => '', // Не используется. Сообщения используются с индекса 1.
			1 => sprintf( 'Портфолио обновлено. <a href="%s">Посмотреть запись портфолио</a>', esc_url( get_permalink($post->ID) ) ),
			2 => 'Произвольное поле обновлено.',
			3 => 'Произвольное поле удалено.',
			4 => 'Запись Портфолио обновлена.',
			/* %s: дата и время ревизии */
			5 => isset($_GET['revision']) ? sprintf( 'Запись Портфолио восстановлена из ревизии %s', wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
			6 => sprintf( 'Запись Портфолио опубликована. <a href="%s">Перейти к записи portfolio</a>', esc_url( get_permalink($post->ID) ) ),
			7 => 'Запись Portfolio сохранена.',
			8 => sprintf( 'Запись Портфолио сохранена. <a target="_blank" href="%s">Предпросмотр записи Портфолио</a>', esc_url( add_query_arg( 'preview', 'true', get_permalink($post->ID) ) ) ),
			9 => sprintf( 'Запись Портфолио запланирована на: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Предпросмотр записи Портфолио</a>',
				// Как форматировать даты в PHP можно посмотреть тут: http://php.net/date
				date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post->ID) ) ),
			10 => sprintf( 'Черновик записи Портфолио обновлен. <a target="_blank" href="%s">Предпросмотр записи Портфолио</a>', esc_url( add_query_arg( 'preview', 'true', get_permalink($post->ID) ) ) ),
		);
		
		return $messages;
	}
	
	
	public function addHelpText($contextual_help, $screen_id, $screen ){
//$contextual_help .= print_r($screen); // используйте чтобы помочь определить параметр $screen->id
		if('portfolio' == $screen->id ) {
			$contextual_help = '
		<p>Напоминалка при редактировании записи Портфолио:</p>
		<ul>
			<li>Указать жанр, например Фантастика или История.</li>
			<li>Указать автора книги.</li>
		</ul>
		<p>Если нужно запланировать публикацию на будущее:</p>
		<ul>
			<li>В блоке с кнопкой "опубликовать" нажмите редактировать дату.</li>
			<li>Измените дату на нужную, будущую и подтвердите изменения кнопкой ниже "ОК".</li>
		</ul>
		<p><strong>За дополнительной информацией обращайтесь:</strong></p>
		<p><a href="/" target="_blank">Блог о WordPress</a></p>
		<p><a href="http://wordpress.org/support/" target="_blank">Форум поддержки</a></p>
		';
		}
		elseif( 'edit-portfolio' == $screen->id ) {
			$contextual_help = '<p>Это раздел помощи показанный для типа записи Портфолио и т.д. и т.п.</p>';
		}
		
		return $contextual_help;
	}
	
	
	public function createPortfolioTaxonomies(){
		// определяем заголовки для 'genre'
		$labels = array(
			'name' => _x( 'Sites', 'taxonomy general name' ),
			'singular_name' => _x( 'Sites', 'taxonomy singular name' ),
			'search_items' =>  __( 'Search Sites' ),
			'all_items' => __( 'All Sites' ),
			'parent_item' => __( 'Parent Sites' ),
			'parent_item_colon' => __( 'Parent Sites:' ),
			'edit_item' => __( 'Edit Sites' ),
			'update_item' => __( 'Update Sites' ),
			'add_new_item' => __( 'Add New Sites' ),
			'new_item_name' => __( 'New Sites Name' ),
			'menu_name' => __( 'Sites' ),
		);
		
		// Добавляем древовидную таксономию 'tax_portfolio' (как категории) жанр
		register_taxonomy('sites', array('mif_portfolio'), array(
			'hierarchical' => true,
			'labels' => $labels,
			'show_ui' => true,
			'show_admin_column' => true,
			'query_var' => true,
			'rewrite' => array( 'slug' => 'sites' ),
		));
		
		// определяем заголовки для 'writer'
		$labels = array(
			'name' => _x( 'Other', 'taxonomy general name' ),
			'singular_name' => _x( 'Writer', 'taxonomy singular name' ),
			'search_items' =>  __( 'Search Other' ),
			'popular_items' => __( 'Popular Other' ),
			'all_items' => __( 'All Other' ),
			'parent_item' => null,
			'parent_item_colon' => null,
			'edit_item' => __( 'Edit Writer' ),
			'update_item' => __( 'Update Writer' ),
			'add_new_item' => __( 'Add New Writer' ),
			'new_item_name' => __( 'New Writer Name' ),
			'separate_items_with_commas' => __( 'Separate Other with commas' ),
			'add_or_remove_items' => __( 'Add or remove Other' ),
			'choose_from_most_used' => __( 'Choose from the most used Other' ),
			'menu_name' => __( 'Other' ),
		);
		
		// Добавляем НЕ древовидную таксономию 'writer' (как метки)
		register_taxonomy('other', 'mif_portfolio',array(
			'hierarchical' => false,
			'labels' => $labels,
			'show_ui' => true,
			'show_admin_column' => true,
			'query_var' => true,
			'rewrite' => array( 'slug' => 'other' ),
		));
		
	}
	// Создадим новый мета блок для постов
	public function priceExtraFields(){
		add_meta_box(
			'price_extra_fields', // id атрибут HTML тега, контейнера блока.
			'Стоимость', // Заголовок/название блока. Виден пользователям.
			array( &$this, 'renderPriceExtraFields' ),  //Функция, которая выводит на экран HTML содержание блока
			'mif_portfolio', // Название экрана для которого добавляется блок.
			'normal', // Место где должен показываться блок
			'high' // Приоритет блока для показа выше или ниже остальных блоков:
		);
	}
	// Заполним этот блок полями html формы.
	// Делается это через, указанную в add_meta_box() функцию renderPriceExtraFields(). Именно она отвечает за содержание мета блока:
	//Функция, которая выводит на экран HTML содержание блока
	public function renderPriceExtraFields($post){
		?>
		<p>
			<label>
				<input type="number" name="price_extra[price]" value="<?php echo get_post_meta($post->ID, 'price', 1); ?>" />
				Стоимость
			</label>
		</p>
		<?php
	}
	
	/*
	 * Сохраняем данные
	 * На этом этапе, мы уже создали блок произвольных полей, теперь нужно обработать данные полей при сохранении поста.
	 *  Обработать, значит записать их в в базу данных или удалить от туда. Для этого используем хук save_post, который
	 * срабатывает в момент сохранения поста. В этот момент мы получим данные из массива price_extra[] и обработаем них:
	 */
	public function priceExtraFieldsUpdate($post_id ){
		if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE  ) return false; // выходим если это автосохранение
		
		if( !isset($_POST['price_extra']) ) return false; // выходим если данных нет
		
		// Все ОК! Теперь, нужно сохранить/удалить данные
		$priceExtra = array_map('trim', $_POST['price_extra']); // чистим все данные от пробелов по краям
		foreach( $priceExtra as $key=>$value ){
			if( empty($value) ){
				delete_post_meta($post_id, $key); // удаляем поле если значение пустое
				continue;
			}
			
			update_post_meta($post_id, $key, $value); // add_post_meta() работает автоматически
		}
		return $post_id;
	}
	
	function my_template( $template ) {
		
		# аналог второго способа
		// если это страница со слагом portfolio, используем файл шаблона page-portfolio.php
		// используем условный тег is_page()
		if( is_page('portfolio-post-type') ){
			if ( $new_template = locate_template( array( 'page-portfolio.php' ) ) )
				return $new_template ;
		} else {}
		
		// файл шаблона расположен в папке плагина, не работает
	/*	global $post;
		if( $post->post_type == 'mif_portfolio' ){
			if ( $new_template = wp_normalize_path(( MIFISTSLICK_PlUGIN_URL ) . '/includes/views/site/pages/MifistPortfolio.view.php') )
			return  $new_template;
		}*/
		return $template;
	}
	
}