<?php
/**
 * Desc: 配置 cURL 请求参数
 * Author: zobeen@163.com
 * Time: 2020/4/12 10:40
 */

$envFile = dirname(__FILE__) . '/.env.php';
if (is_file($envFile)) {
    $env = require($envFile);
} else {
    $env = [];
}

/**********************************************************************************************************************
 * 是否写日志
 *********************************************************************************************************************/
define('MWS_CURL_LOG', ($env['MWS_CURL_LOG'] ?? false));

/**********************************************************************************************************************
 * CURLOPT_CONNECTTIMEOUT 用来告诉 PHP 脚本在成功连接服务器前等待多久（连接成功之后就会开始缓冲输出），
 * 这个参数是为了应对目标服务器的过载，下线，或者崩溃等可能状况。
 * 在尝试连接时等待的秒数。设置为0，则无限等待。
 * 单位：秒
 * 数据类型：integer
 * 设置为 false, 则不生效
 *********************************************************************************************************************/
define('MWS_CURLOPT_CONNECTTIMEOUT', ($env['MWS_CURLOPT_CONNECTTIMEOUT'] ?? false));

/**********************************************************************************************************************
 * CURLOPT_CONNECTTIMEOUT_MS 用来告诉 PHP 脚本在成功连接服务器前等待多久（连接成功之后就会开始缓冲输出），
 * 这个参数是为了应对目标服务器的过载，下线，或者崩溃等可能状况。
 * 在尝试连接时等待的秒数。设置为0，则无限等待。
 * 单位：毫秒
 * 数据类型：integer
 * 设置为 false, 则不生效
 *********************************************************************************************************************/
define('MWS_CURLOPT_CONNECTTIMEOUT_MS', ($env['MWS_CURLOPT_CONNECTTIMEOUT_MS'] ?? false));

/**********************************************************************************************************************
 * CURLOPT_TIMEOUT 用来告诉 PHP 脚本，从服务器接收缓冲完成前需要等待多长时间。如果目标是个巨大的文件，
 * 生成内容速度过慢或者链路速度过慢，这个参数就会很有用。
 * 允许 cURL 函数执行的最长秒数。
 * 单位：秒
 * 数据类型：integer
 * 设置为 false, 则不生效
 *********************************************************************************************************************/
define('MWS_CURLOPT_TIMEOUT', ($env['MWS_CURLOPT_TIMEOUT'] ?? false));

/**********************************************************************************************************************
 * CURLOPT_TIMEOUT_MS 用来告诉 PHP 脚本，从服务器接收缓冲完成前需要等待多长时间。如果目标是个巨大的文件，
 * 生成内容速度过慢或者链路速度过慢，这个参数就会很有用。
 * 允许 cURL 函数执行的最长秒数。
 * 单位：秒
 * 数据类型：integer
 * 设置为 false, 则不生效
 *********************************************************************************************************************/
define('MWS_CURLOPT_TIMEOUT_MS', ($env['MWS_CURLOPT_TIMEOUT_MS'] ?? false));

/**
 * Desc: 设置 cURL 参数
 *
 * @param $ch
 * @return bool
 * Author: zobeen@163.com
 */
function mws_curl_setopt(&$ch)
{
    try {
        // 设置 cURL 的 CURLOPT_CONNECTTIMEOUT 参数
        if (defined('MWS_CURLOPT_CONNECTTIMEOUT')) {
            if (MWS_CURLOPT_CONNECTTIMEOUT !== false) {
                curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, MWS_CURLOPT_CONNECTTIMEOUT);
            }
        }

        // 设置 cURL 的 CURLOPT_TIMEOUT 参数
        if (defined('MWS_CURLOPT_TIMEOUT')) {
            if (MWS_CURLOPT_TIMEOUT !== false) {
                curl_setopt($ch, CURLOPT_TIMEOUT, MWS_CURLOPT_TIMEOUT);
            }
        }

        return true;
    } catch (Exception $e) {
        return false;
    }
}

/**
 * Desc: 将 cURL 请求信息写入日志
 *
 * @param $ch
 * @return bool
 * Author: zobeen@163.com
 */
function mws_curl_log(&$ch)
{
    try {
        if (defined('MWS_CURL_LOG')) {
            if (MWS_CURL_LOG) {
                $logFile = dirname(__FILE__) . '/../Storage/curl_logs.txt';
                $curlInfo = curl_getinfo($ch);
                $curlInfoWithTime = '[' . date('Y-m-d H:i:s') . '] curl_getinfo: ' . json_encode($curlInfo) . "\r\n";
                $curlInfoWithTime .= '[' . date('Y-m-d H:i:s') . '] curl_error: ' . curl_error($ch) . "\r\n";
                file_put_contents($logFile, $curlInfoWithTime, FILE_APPEND);
            }
        }

        return true;
    } catch (Exception $e) {
        return false;
    }
}