<?php

// Exit if accessed directly
if( !defined('ABSPATH') ) {
	exit;
}

/**
 * Класс отвечает за работу страницы логов.
 *
 * @author        Artem Prihodko <webtemyk@yandex.ru>
 * @copyright (c) 2020, Webcraftic
 * @version       1.0
 */
class Wbcr_FactoryLogger114_PageBase extends \WBCR\Factory_Templates_100\Pages\PageBase {

	/**
	 * {@inheritdoc}
	 */
	public $id; // Уникальный идентификатор страницы

	/**
	 * {@inheritdoc}
	 */
	public $page_menu_dashicon = 'dashicons-admin-tools';

	/**
	 * {@inheritdoc}
	 */
	public $type = 'page';

	/**
	 * @param Wbcr_Factory449_Plugin $plugin
	 */
	public function __construct($plugin)
	{
		$this->id = $plugin->getPrefix() . "logger";

		$this->menu_title = __('Plugin Log', 'wbcr_factory_logger_114');
		$this->page_menu_short_description = __('Plugin debug report', 'wbcr_factory_logger_114');

		add_action('wp_ajax_wbcr_factory_logger_114_logs_cleanup', [$this, 'ajax_cleanup']);

		parent::__construct($plugin);
	}

	/**
	 * {@inheritdoc}
	 *
	 * @return void
	 * @since 1.0.0
	 */
	public function assets($scripts, $styles)
	{
		parent::assets($scripts, $styles);

		$this->styles->add(FACTORY_LOGGER_114_URL . '/assets/css/logger.css');
		$this->scripts->add(FACTORY_LOGGER_114_URL . '/assets/js/logger.js', ['jquery'], 'wbcr_factory_logger_114', FACTORY_LOGGER_114_VERSION);
		$this->scripts->localize('wbcr_factory_logger_114', [
			'clean_logs_nonce' => wp_create_nonce('wbcr_factory_logger_114_clean_logs'),
		]);
	}

	/**
	 * {@inheritdoc}
	 */
	public function getMenuTitle()
	{
		return __('Plugin Log', 'wbcr_factory_logger_114');
	}

	/**
	 * {@inheritdoc}
	 */
	public function showPageContent()
	{
		$buttons = "
            <div class='btn-group'>
                <a href='" . wp_nonce_url($this->getActionUrl('export')) . "'
                   class='button button-primary'>" . __('Export Debug Information', 'wbcr_factory_logger_114') . "</a>
                <a href='#'
                   class='button button-secondary'
                   onclick='wbcr_factory_logger_114_LogCleanup(this);return false;'
                   data-working='" . __('Working...', 'wbcr_factory_logger_114') . "'>" . sprintf(__('Clean-up Logs (<span id="wbcr-log-size">%s</span>)', 'wbcr_factory_logger_114'), $this->get_log_size_formatted()) . "
                   </a>
            </div>";
		?>
		<div class="wbcr-factory-page-group-header" style="margin-top:0;">
			<strong><?php _e('Plugin Log', 'wbcr_factory_logger_114') ?></strong>
			<p>
				<?php _e('In this section, you can track how the plugin works. Sending this log to the developer will help you resolve possible issues.', 'wbcr_factory_logger_114') ?>
			</p>
		</div>
		<div class="wbcr-factory-page-group-body" style="padding: 0 20px">
			<?= $buttons; ?>
			<div class="wbcr-log-viewer" id="wbcr-log-viewer">
				<?php echo $this->plugin->logger->prettify() ?>
			</div>
			<?= $buttons; ?>
		</div>
		<?php
	}

	public function ajax_cleanup()
	{
		check_admin_referer('wbcr_factory_logger_114_clean_logs', 'nonce');

		if( !current_user_can('manage_options') ) {
			wp_die(-1);
		}

		if( !$this->plugin->logger->clean_up() ) {
			wp_send_json_error([
				'message' => esc_html__('Failed to clean-up logs. Please try again later.', 'wbcr_factory_logger_114'),
				'type' => 'danger',
			]);
		}

		wp_send_json([
			'message' => esc_html__('Logs clean-up successfully', 'wbcr_factory_logger_114'),
			'type' => 'success',
		]);
	}

	/**
	 * Processing log export action in form of ZIP archive.
	 */
	public function exportAction()
	{
		$export = new WBCR\Factory_Logger_114\Log_Export($this->plugin->logger);

		if( $export->prepare() ) {
			$export->download(true);
		}
	}

	/**
	 * Get log size formatted.
	 *
	 * @return false|string
	 */
	private function get_log_size_formatted()
	{

		try {
			return size_format($this->plugin->logger->get_total_size());
		} catch( \Exception $exception ) {
			$this->plugin->logger->error(sprintf('Failed to get total log size as exception was thrown: %s', $exception->getMessage()));
		}

		return '';
	}
}
