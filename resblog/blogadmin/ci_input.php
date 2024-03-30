<?php

/**
 * CodeIgniter
 *
 * An open-source application development framework for PHP 7.2.5 or newer
 *
 * @package		CodeIgniter
 * @author		ExpressionEngine Dev Team
 * @copyright	Copyright (c) 2008 - 2019, EllisLab, Inc.
 * @license		https://codeigniter.com/userguide3/license.html
 * @link		https://codeigniter.com
 * @since		Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * Input Class
 *
 * Pre-processes global input data for security
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Input
 * @author		ExpressionEngine Dev Team
 * @link		https://codeigniter.com/userguide3/libraries/input.html
 */
class CI_Input
{
    /**
     * @var bool Whether to globally enable the XSS processing
     */
    private bool $use_xss_clean = false;

    /**
     * @var string XSS hash for protecting URLs
     */
    private string $xss_hash = '';

    /**
     * @var string|false IP address
     */
    private mixed $ip_address = false;

    /**
     * @var string|false User agent
     */
    private mixed $user_agent = false;

    /**
     * @var bool Whether to allow the $_GET array
     */
    private bool $allow_get_array = false;

    /**
     * @var string Character set
     */
    private string $charset = 'iso-8859-1';

    /**
     * @var array Never allowed string replacements
     */
    private array $never_allowed_str = [
        'document.cookie' => '[removed]',
        'document.write' => '[removed]',
        '.parentNode' => '[removed]',
        '.innerHTML' => '[removed]',
        'window.location' => '[removed]',
        '-moz-binding' => '[removed]',
        '<!--' => '&lt;!--',
        '-->' => '--&gt;',
        '<![CDATA[' => '&lt;![CDATA['
    ];

    /**
     * @var array Never allowed regex replacements
     */
    private array $never_allowed_regex = [
        'javascript\s*:' => '[removed]',
        'expression\s*(\(|&\#40;)' => '[removed]', // CSS and IE
        'vbscript\s*:' => '[removed]', // IE, surprise!
        'Redirect\s+302' => '[removed]'
    ];

    /**
     * CI_Input constructor.
     */
    public function __construct()
    {
        $this->use_xss_clean = false;
        $this->allow_get_array = true;
        $this->_sanitize_globals();
    }

    // --------------------------------------------------------------------

    /**
     * Sanitize Globals
     *
     * This function does the following:
     *
     * - Unsets $_GET data (if query strings are not enabled)
     * - Unsets all globals if register_globals is enabled
     * - Standardizes newline characters to \n
     *
     * @access	private
     * @return	void
     */
    private function _sanitize_globals(): void
    {
        $protected = [
            '_SERVER', '_GET', '_POST', '_FILES', '_REQUEST', '_SESSION', '_ENV', 'GLOBALS', 'HTTP_RAW_POST_DATA',
            'system_folder', 'application_folder', 'BM', 'EXT', 'CFG', 'URI', 'RTR', 'OUT', 'IN'
        ];

        foreach (['_GET', '_POST', '_COOKIE', '_SERVER', '_FILES', '_ENV', (isset($_SESSION) && is_array($_SESSION)) ? $_SESSION : []] as $global) {
            if (!is_array($global)) {
                if (!in_array($global, $protected)) {
                    unset($GLOBALS[$global]);
                }
            } else {
                foreach ($global as $key => $val) {
                    if (!in_array($key, $protected)) {
                        unset($GLOBALS[$key]);
                    }

                    if (is_array($val)) {
                        foreach ($val as $k => $v) {
                            if (!in_array($k, $protected)) {
                                unset($GLOBALS[$k]);
                            }
                        }
                    }
                }
            }
        }

        if (!$this->allow_get_array) {
            $_GET = [];
        } else {
            $_GET = $this->_clean_input_data($_GET);
        }

        $_POST = $this->_clean_input_data($_POST);

        unset($_COOKIE['$Version'], $_COOKIE['$Path'], $_COOKIE['$Domain']);
        $_COOKIE = $this->_clean_input_data($_COOKIE);
    }

    // --------------------------------------------------------------------

    /**
     * Clean Input Data
     *
     * This is a helper function. It escapes data and
     * standardizes newline characters to \n
     *
     * @access	private
     * @param	array
     * @return	array
     */
    private function _clean_input_data(array $data): array
    {
        foreach ($data as $key => $val) {
            $data[$key] = $this->_clean_input_data_
