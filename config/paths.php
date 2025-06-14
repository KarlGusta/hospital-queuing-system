<?php
// config/paths.php
// To make it easy to manage my URLs when I upload to production, that is cpanel
class PathConfig {
    private static $instance = null;
    private $config;
    
    private function __construct() {
        // Base path configuration
        $this->config = [
            'development' => [
                'base_path' => '/rovergigs',
                'paths' => [
                    'home' => '/',
                    'assets' => [
                        'images' => '/images/',
                        'sponsor_images' => '/src/img/logo/',
                        'dist' => '/dist/'
                    ],
                    'apply' => '/apply.php',
                    'value_membership' => '/value-membership.php',
                    'post_a_job' => '/post-a-job.php'
                ]
            ],
            'production' => [
                'base_path' => 'https://www.rovergigs.com', // Update this with your production base path
                'paths' => [
                    // Same structure as development, but with production paths
                    'home' => '/',
                    'assets' => [
                        'images' => '/images/',
                        'sponsor_images' => '/src/img/logo/',
                        'dist' => '/dist/'
                    ],
                    'apply' => '/apply.php',
                    'value_membership' => '/value-membership.php',
                    'post_a_job' => '/post-a-job.php'
                ]
            ]
        ];
    }
    
    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new PathConfig();
        }
        return self::$instance;
    }
    
    public function getPath($key, $subkey = null) {
        $environment = $this->getCurrentEnvironment();
        $base = $this->config[$environment]['base_path'];
        
        if ($subkey) {
            return $base . $this->config[$environment]['paths'][$key][$subkey];
        }
        
        return $base . $this->config[$environment]['paths'][$key];
    }
    
    private function getCurrentEnvironment() {
        // You can modify this logic based on your needs
        if ($_SERVER['SERVER_NAME'] === 'localhost') {
            return 'development';
        }
        return 'production';
    }
}

// Helper function for easy access
function path($key, $subkey = null) {
    return PathConfig::getInstance()->getPath($key, $subkey);
}