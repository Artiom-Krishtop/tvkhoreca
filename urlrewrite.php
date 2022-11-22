<?php
$arUrlRewrite=array (
  0 => 
  array (
    'CONDITION' => '#^/bitrix/services/ymarket/([\\w\\d\\-]+)?(/)?(([\\w\\d\\-]+)(/)?)?#',
    'RULE' => 'REQUEST_OBJECT=$1&METHOD=$4',
    'ID' => '',
    'PATH' => '/bitrix/services/ymarket/index.php',
    'SORT' => 100,
  ),
  1 => 
  array (
    'CONDITION' => '#^/online/([\\.\\-0-9a-zA-Z]+)(/?)([^/]*)#',
    'RULE' => 'alias=$1',
    'ID' => '',
    'PATH' => '/desktop_app/router.php',
    'SORT' => 100,
  ),
  98 => 
  array (
    'CONDITION' => '#^/video/([\\.\\-0-9a-zA-Z]+)(/?)([^/]*)#',
    'RULE' => 'alias=$1&videoconf',
    'ID' => 'bitrix:im.router',
    'PATH' => '/desktop_app/router.php',
    'SORT' => 100,
  ),
  2 => 
  array (
    'CONDITION' => '#^/home/company/partners/retail/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/home/company/partners/retail/index.php',
    'SORT' => 100,
  ),
  3 => 
  array (
    'CONDITION' => '#^/home/company/partners/horeca/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/home/company/partners/horeca/index.php',
    'SORT' => 100,
  ),
  4 => 
  array (
    'CONDITION' => '#^/personal/history-of-orders/#',
    'RULE' => '',
    'ID' => 'bitrix:sale.personal.order',
    'PATH' => '/personal/history-of-orders/index.php',
    'SORT' => 100,
  ),
  10 => 
  array (
    'CONDITION' => '#^/site_ai/company/licenses/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/site_ai/company/licenses/index.php',
    'SORT' => 100,
  ),
  9 => 
  array (
    'CONDITION' => '#^/retail/company/vacancies/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/retail/company/vacancies/index.php',
    'SORT' => 100,
  ),
  6 => 
  array (
    'CONDITION' => '#^/horeca/company/vacancies/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/horeca/company/vacancies/index.php',
    'SORT' => 100,
  ),
  7 => 
  array (
    'CONDITION' => '#^/retail/company/producers/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/retail/company/producers/index.php',
    'SORT' => 100,
  ),
  11 => 
  array (
    'CONDITION' => '#^/retail/company/vacancies/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/retail/company/vacansies/index.php',
    'SORT' => 100,
  ),
  8 => 
  array (
    'CONDITION' => '#^/site_ai/company/partners/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/site_ai/company/partners/index.php',
    'SORT' => 100,
  ),
  14 => 
  array (
    'CONDITION' => '#^/site_ai/company/vacancy/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/site_ai/company/vacancy/index.php',
    'SORT' => 100,
  ),
  15 => 
  array (
    'CONDITION' => '#^/company/partners/retail/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/company/partners/retail/index.php',
    'SORT' => 100,
  ),
  13 => 
  array (
    'CONDITION' => '#^/company/partners/horeca/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/company/partners/horeca/index.php',
    'SORT' => 100,
  ),
  16 => 
  array (
    'CONDITION' => '#^/horeca/company/articles/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/horeca/company/articles/index.php',
    'SORT' => 100,
  ),
  12 => 
  array (
    'CONDITION' => '#^/site_ai/company/history/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/site_ai/company/history/index.php',
    'SORT' => 100,
  ),
  21 => 
  array (
    'CONDITION' => '#^/home/company/partners/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/home/company/partners/index.php',
    'SORT' => 100,
  ),
  20 => 
  array (
    'CONDITION' => '#^/site_ai/info/articles/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/site_ai/info/articles/index.php',
    'SORT' => 100,
  ),
  19 => 
  array (
    'CONDITION' => '#^/horeca/company/shares/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/horeca/company/shares/index.php',
    'SORT' => 100,
  ),
  17 => 
  array (
    'CONDITION' => '#^/home/company/licenses/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/home/company/licenses/index.php',
    'SORT' => 100,
  ),
  18 => 
  array (
    'CONDITION' => '#^/site_ai/company/staff/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/site_ai/company/staff/index.php',
    'SORT' => 100,
  ),
  25 => 
  array (
    'CONDITION' => '#^/home/company/history/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/home/company/carriers/index.php',
    'SORT' => 100,
  ),
  22 => 
  array (
    'CONDITION' => '#^/home/company/history/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/home/company/history/index.php',
    'SORT' => 100,
  ),
  23 => 
  array (
    'CONDITION' => '#^/home/company/vacancy/#',
    'RULE' => '',
    'ID' => 'bitrix:news.list',
    'PATH' => '/company/vacancy/index.php',
    'SORT' => 100,
  ),
  24 => 
  array (
    'CONDITION' => '#^/home/company/vacancy/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/home/company/vacancy/index.php',
    'SORT' => 100,
  ),
  26 => 
  array (
    'CONDITION' => '#^/home/company/history/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/company/carriers/index.php',
    'SORT' => 100,
  ),
  27 => 
  array (
    'CONDITION' => '#^/retail/press-centre/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/retail/press-centre/index.php',
    'SORT' => 100,
  ),
  28 => 
  array (
    'CONDITION' => '#^/horeca/company/news/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/horeca/company/news/index.php',
    'SORT' => 100,
  ),
  32 => 
  array (
    'CONDITION' => '#^/home/info/articles/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/home/info/articles/index.php',
    'SORT' => 100,
  ),
  29 => 
  array (
    'CONDITION' => '#^/horeca/catalog-new/#',
    'RULE' => '',
    'ID' => 'evg:catalog',
    'PATH' => '/horeca/catalog-new/index.php',
    'SORT' => 100,
  ),
  31 => 
  array (
    'CONDITION' => '#^/home/company/staff/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/home/company/staff/index.php',
    'SORT' => 100,
  ),
  30 => 
  array (
    'CONDITION' => '#^/site_ai/info/stock/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/site_ai/info/stock/index.php',
    'SORT' => 100,
  ),
  33 => 
  array (
    'CONDITION' => '#^/online/(/?)([^/]*)#',
    'RULE' => '',
    'ID' => '',
    'PATH' => '/desktop_app/router.php',
    'SORT' => 100,
  ),
  34 => 
  array (
    'CONDITION' => '#^/site_ai/info/news/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/site_ai/info/news/index.php',
    'SORT' => 100,
  ),
  38 => 
  array (
    'CONDITION' => '#^/stssync/calendar/#',
    'RULE' => '',
    'ID' => 'bitrix:stssync.server',
    'PATH' => '/bitrix/services/stssync/calendar/index.php',
    'SORT' => 100,
  ),
  40 => 
  array (
    'CONDITION' => '#^/site_ai/services/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/site_ai/services/index.php',
    'SORT' => 100,
  ),
  41 => 
  array (
    'CONDITION' => '#^/site_wz/services/#',
    'RULE' => '',
    'ID' => 'bitrix:catalog',
    'PATH' => '/site_wz/services/index.php',
    'SORT' => 100,
  ),
  39 => 
  array (
    'CONDITION' => '#^/site_ai/projects/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/site_ai/projects/index.php',
    'SORT' => 100,
  ),
  35 => 
  array (
    'CONDITION' => '#^/site_wz/products/#',
    'RULE' => '',
    'ID' => 'bitrix:catalog',
    'PATH' => '/site_wz/products/index.php',
    'SORT' => 100,
  ),
  114 => 
  array (
    'CONDITION' => '#^/company/partners/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/company/partners/index.php',
    'SORT' => 100,
  ),
  37 => 
  array (
    'CONDITION' => '#^/site_ai/info/faq/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/site_ai/info/faq/index.php',
    'SORT' => 100,
  ),
  110 => 
  array (
    'CONDITION' => '#^/company/licenses/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/company/licenses/index.php',
    'SORT' => 100,
  ),
  45 => 
  array (
    'CONDITION' => '#^/site_ai/catalog/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/site_ai/catalog/index.php',
    'SORT' => 100,
  ),
  111 => 
  array (
    'CONDITION' => '#^/company/reviews/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/company/reviews/index.php',
    'SORT' => 100,
  ),
  43 => 
  array (
    'CONDITION' => '#^/horeca/partners/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/horeca/partners/index.php',
    'SORT' => 100,
  ),
  105 => 
  array (
    'CONDITION' => '#^/company/vacancy/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/company/vacancy/index.php',
    'SORT' => 100,
  ),
  44 => 
  array (
    'CONDITION' => '#^/home/info/stock/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/home/info/stock/index.php',
    'SORT' => 100,
  ),
  42 => 
  array (
    'CONDITION' => '#^/contacts/stores/#',
    'RULE' => '',
    'ID' => 'bitrix:catalog.store',
    'PATH' => '/contacts/stores/index.php',
    'SORT' => 100,
  ),
  51 => 
  array (
    'CONDITION' => '#^/home/info/news/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/home/info/news/index.php',
    'SORT' => 100,
  ),
  47 => 
  array (
    'CONDITION' => '#^/horeca/catalog/#',
    'RULE' => '',
    'ID' => 'evg:catalog',
    'PATH' => '/site_wz/horeca/catalog/index.php',
    'SORT' => 100,
  ),
  48 => 
  array (
    'CONDITION' => '#^/catalog/brands/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/catalog/brands/index.php',
    'SORT' => 100,
  ),
  50 => 
  array (
    'CONDITION' => '#^/personal/order/#',
    'RULE' => '',
    'ID' => 'bitrix:sale.personal.order',
    'PATH' => '/personal/order/index.php',
    'SORT' => 100,
  ),
  49 => 
  array (
    'CONDITION' => '#^/catalog/retail/#',
    'RULE' => '',
    'ID' => 'bitrix:catalog',
    'PATH' => '/catalog/retail/index.php',
    'SORT' => 100,
  ),
  46 => 
  array (
    'CONDITION' => '#^/retail/catalog/#',
    'RULE' => '',
    'ID' => 'evg:catalog',
    'PATH' => '/site_wz/retail/catalog/index.php',
    'SORT' => 100,
  ),
  57 => 
  array (
    'CONDITION' => '#^/retail/catalog#',
    'RULE' => '',
    'ID' => 'evg:catalog',
    'PATH' => '/retail/catalog/index.php',
    'SORT' => 100,
  ),
  53 => 
  array (
    'CONDITION' => '#^/home/projects/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/home/projects/index.php',
    'SORT' => 100,
  ),
  106 => 
  array (
    'CONDITION' => '#^/company/staff/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/company/staff/index.php',
    'SORT' => 100,
  ),
  54 => 
  array (
    'CONDITION' => '#^/home/info/faq/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/home/info/faq/index.php',
    'SORT' => 100,
  ),
  100 => 
  array (
    'CONDITION' => '#^/info/articles/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/info/articles/index.php',
    'SORT' => 100,
  ),
  52 => 
  array (
    'CONDITION' => '#^/home/services/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/home/services/index.php',
    'SORT' => 100,
  ),
  55 => 
  array (
    'CONDITION' => '#^/horeca/catalog#',
    'RULE' => '',
    'ID' => 'evg:catalog',
    'PATH' => '/horeca/catalog/index.php',
    'SORT' => 100,
  ),
  58 => 
  array (
    'CONDITION' => '#^/info/article/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/info/article/index.php',
    'SORT' => 100,
  ),
  103 => 
  array (
    'CONDITION' => '#^/company/news/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/company/news/index.php',
    'SORT' => 100,
  ),
  59 => 
  array (
    'CONDITION' => '#^/home/catalog/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/home/catalog/index.php',
    'SORT' => 100,
  ),
  60 => 
  array (
    'CONDITION' => '#^/site_wz/news/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/site_wz/news/index.php',
    'SORT' => 100,
  ),
  112 => 
  array (
    'CONDITION' => '#^/company/docs/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/company/docs/index.php',
    'SORT' => 100,
  ),
  108 => 
  array (
    'CONDITION' => '#^/sharebasket/#',
    'RULE' => '',
    'ID' => 'aspro:basket.share.max',
    'PATH' => '/sharebasket/index.php',
    'SORT' => 100,
  ),
  62 => 
  array (
    'CONDITION' => '#^/info/brands/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/info/brands/index.php',
    'SORT' => 100,
  ),
  64 => 
  array (
    'CONDITION' => '#^/info/brand/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/info/brand/index.php',
    'SORT' => 100,
  ),
  94 => 
  array (
    'CONDITION' => '#^/info/stock/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/info/stock/index.php',
    'SORT' => 100,
  ),
  76 => 
  array (
    'CONDITION' => '#^/info/news/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/info/news/index.php',
    'SORT' => 100,
  ),
  77 => 
  array (
    'CONDITION' => '#^/info/news/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/company/news/index.php',
    'SORT' => 100,
  ),
  66 => 
  array (
    'CONDITION' => '#^/blog/blog/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/blog/blog/index.php',
    'SORT' => 100,
  ),
  109 => 
  array (
    'CONDITION' => '#^/lookbooks/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/lookbooks/index.php',
    'SORT' => 100,
  ),
  107 => 
  array (
    'CONDITION' => '#^/landings/#',
    'RULE' => '',
    'ID' => 'bitrix:catalog',
    'PATH' => '/landings/index.php',
    'SORT' => 100,
  ),
  113 => 
  array (
    'CONDITION' => '#^/personal/#',
    'RULE' => '',
    'ID' => 'bitrix:sale.personal.section',
    'PATH' => '/personal/index.php',
    'SORT' => 100,
  ),
  67 => 
  array (
    'CONDITION' => '#^/services/#',
    'RULE' => '',
    'ID' => 'bitrix:catalog',
    'PATH' => '/services/index.php',
    'SORT' => 100,
  ),
  104 => 
  array (
    'CONDITION' => '#^/projects/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/projects/index.php',
    'SORT' => 100,
  ),
  69 => 
  array (
    'CONDITION' => '#^/products/#',
    'RULE' => '',
    'ID' => 'bitrix:catalog',
    'PATH' => '/products/index.php',
    'SORT' => 100,
  ),
  68 => 
  array (
    'CONDITION' => '#^/services/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/services/index.php',
    'SORT' => 100,
  ),
  115 => 
  array (
    'CONDITION' => '#^/catalog/#',
    'RULE' => '',
    'ID' => 'bitrix:catalog',
    'PATH' => '/catalog/index.php',
    'SORT' => 100,
  ),
  71 => 
  array (
    'CONDITION' => '#^/forum/#',
    'RULE' => '',
    'ID' => 'bitrix:forum',
    'PATH' => '/forum/index.php',
    'SORT' => 100,
  ),
  72 => 
  array (
    'CONDITION' => '#^/sale/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/sale/index.php',
    'SORT' => 100,
  ),
  73 => 
  array (
    'CONDITION' => '#^/news/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/news/index.php',
    'SORT' => 100,
  ),
  85 => 
  array (
    'CONDITION' => '#^/rest/#',
    'RULE' => '',
    'ID' => NULL,
    'PATH' => '/bitrix/services/rest/index.php',
    'SORT' => 100,
  ),
  101 => 
  array (
    'CONDITION' => '#^/blog/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/blog/index.php',
    'SORT' => 100,
  ),
  102 => 
  array (
    'CONDITION' => '#^/auth/#',
    'RULE' => '',
    'ID' => 'aspro:auth.max',
    'PATH' => '/auth/index.php',
    'SORT' => 100,
  ),
);
