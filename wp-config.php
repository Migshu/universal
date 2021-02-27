<?php
/**
 * Основные параметры WordPress.
 *
 * Скрипт для создания wp-config.php использует этот файл в процессе
 * установки. Необязательно использовать веб-интерфейс, можно
 * скопировать файл в "wp-config.php" и заполнить значения вручную.
 *
 * Этот файл содержит следующие параметры:
 *
 * * Настройки MySQL
 * * Секретные ключи
 * * Префикс таблиц базы данных
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** Параметры MySQL: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define( 'DB_NAME', 'berny' );

/** Имя пользователя MySQL */
define( 'DB_USER', 'root' );

/** Пароль к базе данных MySQL */
define( 'DB_PASSWORD', '' );

/** Имя сервера MySQL */
define( 'DB_HOST', 'localhost' );

/** Кодировка базы данных для создания таблиц. */
define( 'DB_CHARSET', 'utf8mb4' );

/** Схема сопоставления. Не меняйте, если не уверены. */
define( 'DB_COLLATE', '' );

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу.
 * Можно сгенерировать их с помощью {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными. Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '/ sny`nB23e5/$?*Q#+nnf@>A7&ATOy4|OWo0t>oR!CNYewD2(#zjuHsa;J5uA-o' );
define( 'SECURE_AUTH_KEY',  'G,-~[Mgb>3R6;iFw-}5t;!1O!7p 7V#:dwASD#4kLGRNZq)s^00w}Lb>mSyGL_Ai' );
define( 'LOGGED_IN_KEY',    'j4dsVj J,b,a0QWp`xA6ufQ@qNRvDVLB?]g`P..n$l(zXQh[y+PSE>;RSz37C}eA' );
define( 'NONCE_KEY',        'uNhMZ3:*?4_|luA+{}{Ye`Zdxq`s>$8x~YE_?M(V7kRhHX%,|ihB9Y385!Lrv*Ld' );
define( 'AUTH_SALT',        'x/gqN>]SG@9ET!y` Mm4=:5RemnZ)X!d2hneRQd~)rU}yK-}#8Nmcff$MGTFfCo4' );
define( 'SECURE_AUTH_SALT', 'Mt@lR&`]dzix?#Ln!XP_d]/0>dN(50yny}H/T] G#.`-B1U.P^CxFVU5 @Xuz%87' );
define( 'LOGGED_IN_SALT',   'jk8,!c^hUi3t|goa~U{mJE^|(>%j|{J~<$N(Zq]_h=,?:a.dt0a[pGQS1CePU^0h' );
define( 'NONCE_SALT',       'AFN$]WkR bG[d%@IcDdi<[y.X>=%xA>EI1#P@B)1XSx<J{N6B3aA9s;Q/S1J<5fg' );

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix = 'universal';

/**
 * Для разработчиков: Режим отладки WordPress.
 *
 * Измените это значение на true, чтобы включить отображение уведомлений при разработке.
 * Разработчикам плагинов и тем настоятельно рекомендуется использовать WP_DEBUG
 * в своём рабочем окружении.
 *
 * Информацию о других отладочных константах можно найти в Кодексе.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', true );

/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Инициализирует переменные WordPress и подключает файлы. */
require_once( ABSPATH . 'wp-settings.php' );
