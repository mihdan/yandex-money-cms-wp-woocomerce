<?php
/**
 * Plugin Name: yandexmoney_wp_woocommerce
 * Plugin URI: https://github.com/yandex-money/yandex-money-cms-wp-woocomerce
 * Description: Online shop with Yandex.Money support.
 * Version: 2.2.0
 * Author: Yandex.Money
 * Author URI: http://money.yandex.ru
 */
include_once 'yamoney_gateway.class.php';


function ya_all_gateway_icon( $gateways ) {
	$list_icons = array( 'yandex_money'    => 'pc',
	                     'bank'            => 'ac',
	                     'terminal'        => 'gp',
	                     'mobile'          => 'mc',
	                     'yandex_webmoney' => 'wm',
	                     'alfabank'        => 'ab',
	                     'sberbank'        => 'sb',
	                     'masterpass'      => 'ma',
	                     'psbank'          => 'pb',
	                     'qiwi'            => 'qw',
	                     'qppi'            => 'qp',
	                     'mpos'            => 'ac'
	);
	$url        = ( empty( $_SERVER['HTTPS'] ) ) ? WP_PLUGIN_URL : str_replace( 'http://', 'https://', WP_PLUGIN_URL );
	$url .= "/" . dirname( plugin_basename( __FILE__ ) ) . '/images/';
	foreach ( $list_icons as $name => $png_name ) {
		if ( isset( $gateways[ $name ] ) ) {
			$gateways[ $name ]->icon = $url . $png_name . '.png';
		}
	}

	return $gateways;
}

add_filter( 'woocommerce_available_payment_gateways', 'ya_all_gateway_icon' );

class WC_ym_PC extends WC_yam_Gateway {
	public function __construct() {
		$this->id           = 'yandex_money';
		$this->method_title = 'Кошелек Яндекс.Деньги';
		$this->long_name    = 'Оплата из кошелька в Яндекс.Деньгах';
		$this->payment_type = 'PC';
		parent::__construct();
	}
}

class WC_ym_AC extends WC_yam_Gateway {
	public function __construct() {
		$this->id           = 'bank';
		$this->method_title = 'Банковская карта';
		$this->long_name    = 'Оплата с произвольной банковской карты';
		$this->payment_type = 'AC';
		parent::__construct();
	}
}

class WC_ym_GP extends WC_yam_Gateway {
	public function __construct() {
		$this->id           = 'terminal';
		$this->method_title = 'Наличными через кассы и терминалы';
		$this->long_name    = 'Оплата наличными через кассы и терминалы';
		$this->payment_type = 'GP';
		parent::__construct();
	}
}

class WC_ym_MC extends WC_yam_Gateway {
	public function __construct() {
		$this->id           = 'mobile';
		$this->method_title = 'Счет мобильного телефона';
		$this->long_name    = 'Платеж со счета мобильного телефона';
		$this->payment_type = 'MC';
		parent::__construct();
	}
}

class WC_ym_WM extends WC_yam_Gateway {
	public function __construct() {
		$this->id           = 'yandex_webmoney';
		$this->method_title = 'Кошелек WebMoney';
		$this->long_name    = 'Оплата из кошелька в системе WebMoney';
		$this->payment_type = 'WM';
		parent::__construct();
	}
}

class WC_ym_AB extends WC_yam_Gateway {
	public function __construct() {
		$this->id           = 'alfabank';
		$this->method_title = 'Альфа-Клик';
		$this->long_name    = 'Оплата через Альфа-Клик';
		$this->payment_type = 'AB';
		parent::__construct();
	}
}

class WC_ym_SB extends WC_yam_Gateway {
	public function __construct() {
		$this->id           = 'sberbank';
		$this->method_title = 'Сбербанк: оплата по SMS или Сбербанк Онлайн';
		$this->long_name    = 'Оплата через Сбербанк: оплата по SMS или Сбербанк Онлайн';
		$this->payment_type = 'SB';
		parent::__construct();
	}
}

class WC_ym_PB extends WC_yam_Gateway {
	public function __construct() {
		$this->id           = 'psbank';
		$this->method_title = 'Интернет-банк Промсвязьбанка';
		$this->long_name    = 'Оплата через интернет-банк Промсвязьбанка';
		$this->payment_type = 'PB';
		parent::__construct();
	}
}

class WC_ym_QW extends WC_yam_Gateway {
	public function __construct() {
		$this->id           = 'qiwi';
		$this->method_title = 'QIWI Wallet';
		$this->long_name    = 'Оплата через QIWI Wallet';
		$this->payment_type = 'QW';
		parent::__construct();
	}
}

class WC_ym_QP extends WC_yam_Gateway {
	public function __construct() {
		$this->id           = 'qppi';
		$this->method_title = 'Доверительный платеж (Куппи.ру)';
		$this->long_name    = 'Оплата через доверительный платеж (Куппи.ру)';
		$this->payment_type = 'QP';
		parent::__construct();
	}
}

class WC_ym_MA extends WC_yam_Gateway {
	public function __construct() {
		$this->id           = 'masterpass';
		$this->method_title = 'MasterPass';
		$this->long_name    = 'Оплата через MasterPass';
		$this->payment_type = 'MA';
		parent::__construct();
	}
}

class WC_ym_MP extends WC_mpos_Gateway {
	public function __construct() {
		$this->id           = 'mpos';
		$this->method_title = 'Мобильный терминал';
		$this->long_name    = 'Оплата через мобильный терминал';
		$this->payment_type = 'MP';
		parent::__construct();
	}
}

function woocommerce_add_all_payu_gateway( $methods ) {
	$methods[] = 'WC_ym_PC';
	$methods[] = 'WC_ym_AC';
	$methods[] = 'WC_ym_GP';
	$methods[] = 'WC_ym_MC';
	$methods[] = 'WC_ym_WM';
	$methods[] = 'WC_ym_AB';
	$methods[] = 'WC_ym_SB';
	$methods[] = 'WC_ym_MA';
	$methods[] = 'WC_ym_PB';
	$methods[] = 'WC_ym_QW';
	$methods[] = 'WC_ym_QP';
	$methods[] = 'WC_ym_MP';

	return $methods;
}

add_filter( 'woocommerce_payment_gateways', 'woocommerce_add_all_payu_gateway' );

function register_my_setting() {
	register_setting( 'woocommerce-yamoney', 'ym_Scid' );
	register_setting( 'woocommerce-yamoney', 'ym_ShopID' );
	register_setting( 'woocommerce-yamoney', 'ym_shopPassword' );
	register_setting( 'woocommerce-yamoney', 'ym_Demo' );

	register_setting( 'woocommerce-yamoney', 'ym_page_mpos' );
	register_setting( 'woocommerce-yamoney', 'ym_success' );
	register_setting( 'woocommerce-yamoney', 'ym_fail' );
	//error_log("register_my_setting");
}

add_action( 'admin_menu', 'register_yandexMoney_submenu_page' );
add_action( 'update_option_ym_ShopID', 'after_update_setting' );
function register_yandexMoney_submenu_page() {
	add_submenu_page( 'woocommerce', 'Яндекс.Деньги Настройка', 'Яндекс.Деньги Настройка', 'manage_options', 'yandex_money_menu', 'yandexMoney_submenu_page_callback' );
	add_action( 'admin_init', 'register_my_setting' );
}

function yandexMoney_submenu_page_callback() {
	?>
	<div class="wrap">
		<h2>Настройки Яндекс.Деньги</h2>

		<p>Любое использование Вами программы означает полное и безоговорочное принятие Вами условий лицензионного
			договора, размещенного по адресу <a href='https://money.yandex.ru/doc.xml?id=527132' target='_blank'>https://money.yandex.ru/doc.xml?id=527132</a>
			(далее – «Лицензионный договор»). Если Вы не принимаете условия Лицензионного договора в полном объёме, Вы
			не имеете права использовать программу в каких-либо целях.</p>

		<form method="post" action="options.php">
			<?php
			wp_nonce_field( 'update-options' );
			settings_fields( 'woocommerce-yamoney' );
			do_settings_sections( 'woocommerce-yamoney' );
			?>

			<table class="form-table">

				<tr valign="top">
					<th scope="row">paymentAvisoUrl and checkUrl<br/><span
							style="line-height: 1;font-weight: normal;font-style: italic;font-size: 12px;">Генерируются автоматически для Вашего сайта<span>
					</th>
					<td><code><?php
							echo 'https://' . $_SERVER['HTTP_HOST'] . '/?yandex_money=check';
							?></code></td>
				</tr>

				<tr valign="top">
					<th scope="row">Демо режим<br/><span
							style="line-height: 1;font-weight: normal;font-style: italic;font-size: 12px;">Включить демо режим для тестирования<span>
					</th>
					<td><input type="checkbox"
					           name="ym_Demo" <?php echo get_option( 'ym_Demo' ) == 'on' ? 'checked="checked"' : ''; ?>"
						/>
					</td>
				</tr>

				<tr valign="top">
					<th scope="row">ShopID<br/><span
							style="line-height: 1;font-weight: normal;font-style: italic;font-size: 12px;">Идентификатор магазина<span>
					</th>
					<td><input type="text" name="ym_ShopID" value="<?php echo get_option( 'ym_ShopID' ); ?>"/></td>
				</tr>

				<tr valign="top">
					<th scope="row">Scid<br/><span
							style="line-height: 1;font-weight: normal;font-style: italic;font-size: 12px;">Номер витрины магазина<span>
					</th>
					<td><input type="text" name="ym_Scid" value="<?php echo get_option( 'ym_Scid' ); ?>"/></td>
				</tr>
				<tr valign="top">
					<th scope="row">shopPassword<br/><span
							style="line-height: 1;font-weight: normal;font-style: italic;font-size: 12px;">Устанавливается при регистрации магазина в системе Яндекс.Деньги<span>
					</th>
					<td><input type="text" name="ym_shopPassword"
					           value="<?php echo get_option( 'ym_shopPassword' ); ?>"/></td>
				</tr>
				<tr valign="top">
					<th scope="row">Страница с инструкцией для оплаты через мобильный терминал<br/><span
							style="line-height: 1;font-weight: normal;font-style: italic;font-size: 12px;">Страница, которая содержит инструкцию для плательщика по оплате через мобильный терминал<span>
					</th>
					<td><select id="ym_page_mpos" name="ym_page_mpos">
							<?php
							if ( $pages = get_pages() ) {
								foreach ( $pages as $page ) {
									$selected = ( $page->ID == get_option( 'ym_page_mpos' ) ) ? ' selected' : '';
									echo '<option value="' . $page->ID . '"' . $selected . '>' . $page->post_title . '</option>';
								}
							}
							?></select>
					</td>
				</tr>

				<tr valign="top">
					<th scope="row">Страница успеха<br/><span
							style="line-height: 1;font-weight: normal;font-style: italic;font-size: 12px;">Страница, которая отображается после успешной оплаты<span>
					</th>
					<td><select id="ym_success" name="ym_success">
							<?php
							if ( $pages = get_pages() ) {
								foreach ( $pages as $page ) {
									$selected = ( $page->ID == get_option( 'ym_success' ) ) ? ' selected' : '';
									echo '<option value="' . $page->ID . '"' . $selected . '>' . $page->post_title . '</option>';
								}
							}
							?></select>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">Страница отказа<br/><span
							style="line-height: 1;font-weight: normal;font-style: italic;font-size: 12px;">Страница, которая отображается после отказа в оплате<span>
					</th>
					<td><select id="ym_fail" name="ym_fail">
							<?php
							if ( $pages = get_pages() ) {
								foreach ( $pages as $page ) {
									$selected = ( $page->ID == get_option( 'ym_fail' ) ) ? ' selected' : '';
									echo '<option value="' . $page->ID . '"' . $selected . '>' . $page->post_title . '</option>';
								}
							}
							?></select>
					</td>
				</tr>

			</table>

			<input type="hidden" name="action" value="update"/>
			<input type="hidden" name="page_options"
			       value="ym_Scid,ym_ShopID,ym_shopPassword,ym_Demo,ym_success,ym_fail,ym_page_mpos"/>

			<p class="submit">
				<input type="submit" class="button-primary" value="<?php _e( 'Save Changes' ) ?>"/>
			</p>

		</form>
	</div>
	<?php
}

add_action( 'parse_request', 'YMcheckPayment' );

function after_update_setting( $one ) {
	new yamoney_statistics();
}

function YMcheckPayment() {
	global $wpdb;
	if ( isset( $_REQUEST['yandex_money'] ) && $_REQUEST['yandex_money'] == 'check' ) {
		$hash = md5( $_POST['action'] . ';' . $_POST['orderSumAmount'] . ';' . $_POST['orderSumCurrencyPaycash'] . ';' .
		             $_POST['orderSumBankPaycash'] . ';' . $_POST['shopId'] . ';' . $_POST['invoiceId'] . ';' .
		             $_POST['customerNumber'] . ';' . get_option( 'ym_shopPassword' ) );
		header( 'Content-Type: application/xml' );
		$code        = 1;
		$techMessage = 'bad md5';
		if ( isset( $_POST['md5'] ) && strtolower( $hash ) == strtolower( $_POST['md5'] ) ) {
			$order      = $wpdb->get_row( 'SELECT * FROM ' . $wpdb->prefix . 'posts WHERE ID = ' . (int) $_POST['customerNumber'] );
			$order_summ = ( isset( $order->ID ) ) ? get_post_meta( $order->ID, '_order_total', true ) : 0;
			if ( $order ) {
				if ( $order_summ != $_POST['orderSumAmount'] ) { // !=
					$code        = 100;
					$techMessage = 'wrong orderSumAmount';
				} else {
					$code        = 0;
					$techMessage = 'ok';
					$order_w     = new WC_Order( $order->ID );
					$order_w->update_status( ( $_POST['action'] == 'paymentAviso' ) ? 'completed' : 'processing', __( 'Awaiting BACS payment', 'woocommerce' ) );
					$order_w->reduce_order_stock();
				}
			} elseif ( $_POST['paymentType'] == 'MP' ) {
				$code        = 0;
				$techMessage = 'Mpos ok';
			} else {
				$code        = 200;
				$techMessage = 'wrong customerNumber';
			}
		}
		$answer = '<?xml version="1.0" encoding="UTF-8"?>
			<' . $_POST['action'] . 'Response performedDatetime="' . date( 'c' ) . '" code="' . $code . '" invoiceId="' . $_POST['invoiceId'] . '" shopId="' . get_option( 'ym_ShopID' ) . '" techMessage="' . $techMessage . '"/>';
		die( $answer );
	}
}

class yamoney_statistics {
	public function __construct() {
		$this->send();
	}

	private function send() {
		global $wp_version;
		$array = array(
			'url'      => get_option( 'siteurl' ),
			'cms'      => 'wordpress-woo',
			'version'  => $wp_version,
			'ver_mod'  => '2.2.0',
			'yacms'    => false,
			'email'    => get_option( 'admin_email' ),
			'shopid'   => get_option( 'ym_ShopID' ),
			'settings' => array(
				'kassa' => true
			)
		);

		$key_crypt   = gethostbyname( $_SERVER['HTTP_HOST'] );
		$array_crypt = $this->crypt_encrypt( $array, $key_crypt );

		$url     = 'https://statcms.yamoney.ru/';
		$curlOpt = array(
			CURLOPT_HEADER         => false,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_SSL_VERIFYPEER => false,
			CURLOPT_SSL_VERIFYHOST => false,
			CURLINFO_HEADER_OUT    => true,
			CURLOPT_POST           => true,
		);

		$curlOpt[ CURLOPT_HTTPHEADER ] = array( 'Content-Type: application/x-www-form-urlencoded' );
		$curlOpt[ CURLOPT_POSTFIELDS ] = http_build_query( array( 'data' => $array_crypt ) );

		$curl = curl_init( $url );
		curl_setopt_array( $curl, $curlOpt );
		$rbody = curl_exec( $curl );
		$errno = curl_errno( $curl );
		$error = curl_error( $curl );
		$rcode = curl_getinfo( $curl, CURLINFO_HTTP_CODE );
		curl_close( $curl );
	}

	private function crypt_encrypt( $data, $key ) {
		$key       = hash( 'sha256', $key, true );
		$data      = serialize( $data );
		$init_size = mcrypt_get_iv_size( MCRYPT_RIJNDAEL_256, MCRYPT_MODE_CBC );
		$init_vect = mcrypt_create_iv( $init_size, MCRYPT_RAND );
		$str       = $this->randomString( strlen( $key ) ) . $init_vect . mcrypt_encrypt( MCRYPT_RIJNDAEL_256, $key, $data, MCRYPT_MODE_CBC, $init_vect );

		return base64_encode( $str );
	}

	private function randomString( $len ) {
		$str      = '';
		$pool     = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$pool_len = strlen( $pool );
		for ( $i = 0; $i < $len; $i ++ ) {
			$str .= substr( $pool, mt_rand( 0, $pool_len - 1 ), 1 );
		}

		return $str;
	}
}
