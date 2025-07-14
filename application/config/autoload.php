<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$autoload['packages'] = array();
$autoload['libraries'] = array('session', 'form_validation','TanggalHelper', 'pdf', 'encrypt', 'database', 'encryption', 'user_agent', 'ciqrcode');
$autoload['drivers'] = array();
$autoload['helper'] = array('url', 'file', 'form','html', 'htmlpurifier', 'cookie', 'qrcode_helper');
$autoload['config'] = array();
$autoload['language'] = array();
$autoload['model'] = array();
