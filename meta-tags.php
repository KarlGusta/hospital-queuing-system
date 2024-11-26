<?php
// meta-tags.php
class MetaTags {
    private $defaultMeta = [
        'title' => 'Rover gigs',
        'description' => 'A remote job community.',
        'image' => 'assets/images/default_meta_image.png'
    ];
    
    private $baseUrl;
    
    public function __construct() {
        $this->baseUrl = 'https://' . $_SERVER['HTTP_HOST'];
    }
    
    public function getMetaInfo($pageId) {
        // This could be replaced with actual database queries or CMS logic
        $pages = [
            'home' => [
                'title' => 'Rover Gigs - Home',
                'description' => 'A remote job community.',
                'image' => 'assets/images/default_meta_image.png'
            ],
            'apply' => [
                'title' => 'Rover Gigs - Apply',
                'description' => 'Apply now on Rover Gigs.',
                'image' => 'assets/images/apply_meta_image.png'
            ],
            'value-membership' => [
                'title' => 'Rover Gigs - Value Membership',
                'description' => 'Value membership',
                'image' => 'assets/images/default_meta_image.png'
            ],
            'post-a-job' => [
                'title' => 'Rover Gigs - Post a Job',
                'description' => 'Post a job on Rover Gigs.',
                'image' => 'assets/images/default_meta_image.png'
            ]
        ];
        
        return $pages[$pageId] ?? null;
    }
    
    public function generateMetaTags($pageId) {
        $metaInfo = $this->getMetaInfo($pageId);
        $meta = $metaInfo ?? $this->defaultMeta;
        
        // Ensure image URL is absolute
        $imageUrl = strpos($meta['image'], 'http') === 0 
            ? $meta['image'] 
            : $this->baseUrl . $meta['image'];
            
        ob_start();
        ?>
        <!-- Basic Meta Tags -->
        <title><?php echo htmlspecialchars($meta['title']); ?></title>
        <meta name="description" content="<?php echo htmlspecialchars($meta['description']); ?>">
        
        <!-- Open Graph / Facebook -->
        <meta property="og:type" content="website">
        <meta property="og:url" content="<?php echo $this->baseUrl . $_SERVER['REQUEST_URI']; ?>">
        <meta property="og:title" content="<?php echo htmlspecialchars($meta['title']); ?>">
        <meta property="og:description" content="<?php echo htmlspecialchars($meta['description']); ?>">
        <meta property="og:image" content="<?php echo htmlspecialchars($imageUrl); ?>">
        
        <!-- Twitter -->
        <meta property="twitter:card" content="summary_large_image">
        <meta property="twitter:url" content="<?php echo $this->baseUrl . $_SERVER['REQUEST_URI']; ?>">
        <meta property="twitter:title" content="<?php echo htmlspecialchars($meta['title']); ?>">
        <meta property="twitter:description" content="<?php echo htmlspecialchars($meta['description']); ?>">
        <meta property="twitter:image" content="<?php echo htmlspecialchars($imageUrl); ?>">
        <?php
        return ob_get_clean();
    }
}