<?php
/**
 * 站点元信息工具类
 * 用于管理和生成站点描述文本
 */
class SiteMeta {
    private array $metaData = [
        'site_name' => 'Portal Fishing Battle',
        'domain' => 'portal-fishingbattle.com',
        'keywords' => ['捕鱼大作战', '钓鱼', '对战', '休闲游戏'],
        'description' => 'Portal Fishing Battle - 捕鱼大作战在线游戏平台',
        'author' => 'Game Studio',
        'version' => '2.1.0',
        'founded_year' => 2020,
    ];

    /**
     * 构造函数，可传入自定义配置覆盖默认值
     */
    public function __construct(array $config = []) {
        if (!empty($config)) {
            $this->metaData = array_merge($this->metaData, $config);
        }
    }

    /**
     * 获取站点名称
     */
    public function getSiteName(): string {
        return htmlspecialchars($this->metaData['site_name'], ENT_QUOTES, 'UTF-8');
    }

    /**
     * 获取域名
     */
    public function getDomain(): string {
        return htmlspecialchars($this->metaData['domain'], ENT_QUOTES, 'UTF-8');
    }

    /**
     * 获取关键词列表
     */
    public function getKeywords(): array {
        return $this->metaData['keywords'];
    }

    /**
     * 生成简短的站点描述文本（用于SEO或页面header）
     */
    public function generateShortDescription(): string {
        $name = $this->getSiteName();
        $domain = $this->getDomain();
        $keywords = implode('、', $this->metaData['keywords']);
        $version = htmlspecialchars($this->metaData['version'], ENT_QUOTES, 'UTF-8');
        $year = (int)$this->metaData['founded_year'];

        return sprintf(
            '%s (%s) 提供%s等精彩玩法。版本 %s，成立于 %d 年。',
            $name,
            $domain,
            $keywords,
            $version,
            $year
        );
    }

    /**
     * 生成HTML友好的meta标签片段
     */
    public function generateMetaTags(): string {
        $desc = htmlspecialchars($this->generateShortDescription(), ENT_QUOTES, 'UTF-8');
        $keywordsStr = htmlspecialchars(implode(',', $this->metaData['keywords']), ENT_QUOTES, 'UTF-8');
        
        $tags = [];
        $tags[] = '<meta name="description" content="' . $desc . '">';
        $tags[] = '<meta name="keywords" content="' . $keywordsStr . '">';
        $tags[] = '<meta name="author" content="' . htmlspecialchars($this->metaData['author'], ENT_QUOTES, 'UTF-8') . '">';
        
        return implode("\n", $tags);
    }

    /**
     * 获取所有元数据
     */
    public function getAllMeta(): array {
        return $this->metaData;
    }
}

// 示例用法
$siteMeta = new SiteMeta();
echo "站点名称: " . $siteMeta->getSiteName() . "\n";
echo "域名: " . $siteMeta->getDomain() . "\n";
echo "简短描述: " . $siteMeta->generateShortDescription() . "\n";
echo "Meta标签:\n" . $siteMeta->generateMetaTags() . "\n";

// 使用自定义配置覆盖示例
$customConfig = [
    'site_name' => '捕鱼大作战 Portal',
    'keywords' => ['捕鱼大作战', '联机对战', '深海狩猎'],
    'version' => '3.0.0',
];
$customMeta = new SiteMeta($customConfig);
echo "\n自定义配置描述: " . $customMeta->generateShortDescription() . "\n";