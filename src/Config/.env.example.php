<?php
/**
 * Desc: 配置举例
 * 在生产环境中，如果要配置，请在 Config 目录下新建 .env.php 文件，按照本文件的格式编辑即可
 * Author: zobeen@163.com
 * Time: 2020/4/12 10:40
 */

return [
    'MWS_CURL_LOG' => true,
    'MWS_CURLOPT_CONNECTTIMEOUT' => 30,
    'MWS_CURLOPT_CONNECTTIMEOUT_MS' => false,
    'MWS_CURLOPT_TIMEOUT' => 30 * 60,
    'MWS_CURLOPT_TIMEOUT_MS' => false,
];