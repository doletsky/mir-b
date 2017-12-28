<!DOCTYPE HTML>
<html>
<head>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-65593204-3"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-65593204-3');
</script>
  <?
  if (file_exists($_SERVER['DOCUMENT_ROOT'] . '/d-robots.php')) {
    include_once ($_SERVER['DOCUMENT_ROOT'] . '/d-robots.php');
    $dRobots = dRobots::fromFile();
    $noindex = $dRobots->checkUrl($_SERVER['REQUEST_URI']) ? '<meta name="googlebot" content="noindex">' . PHP_EOL : '';
  } else $noindex = '';
   
  //Вывод в шаблоне
  echo $noindex;
  ?>
  <meta name="yandex-verification" content="f9d1ac569b596c6a" />
  <meta name="google-site-verification" content="Vr6FWAkbfjhiJzHXDDhmNVE4J8mOhk7h8yNrvjX7A5Q" />
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta name="SKYPE_TOOLBAR" content="SKYPE_TOOLBAR_PARSER_COMPATIBLE" />
  <meta name="format-detection" content="telephone=no" />
  <meta name="viewport" content="width=device-width">
  <meta name="HandheldFriendly" content="true">
  <title><?$APPLICATION->ShowTitle()?></title>
  <link rel="stylesheet" type="text/css" href="<?=SITE_TEMPLATE_PATH?>/css/fonts.css" />
  <link rel="stylesheet" type="text/css" href="<?=SITE_TEMPLATE_PATH?>/css/base.css?v=3" />
  <link rel="stylesheet" type="text/css" href="<?=SITE_TEMPLATE_PATH?>/css/style.css?v=3" />
  <link rel="stylesheet" type="text/css" href="<?=SITE_TEMPLATE_PATH?>/css/flexslider.css" />
  <link rel="stylesheet" type="text/css" href="<?=SITE_TEMPLATE_PATH?>/css/slick.css" />
  <link rel="stylesheet" type="text/css" href="<?=SITE_TEMPLATE_PATH?>/css/sliderkit.css" />
  <link rel="stylesheet" type="text/css" href="<?=SITE_TEMPLATE_PATH?>/css/cusel.css" />
  <link rel="stylesheet" type="text/css" href="<?=SITE_TEMPLATE_PATH?>/css/jquery.fancybox.css" />
  <link rel="stylesheet" type="text/css" href="<?=SITE_TEMPLATE_PATH?>/css/jquery-ui.css" />
  <link rel="stylesheet" type="text/css" href="<?=SITE_TEMPLATE_PATH?>/css/media-queries.css" />
  <link rel="stylesheet" type="text/css" href="<?=SITE_TEMPLATE_PATH?>/css/sv.css?v=5" />
  <!--[if lt IE 9]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]--> 
  <?$APPLICATION->ShowHead()?>
  <script type="text/javascript" src="/ds-comf/lib/jquery-1.11.3.min.js"></script>
	<script type="text/javascript">
		gKweri = $.noConflict(true);
	</script>
	<script type="text/javascript" src="/ds-comf/ds-form/js/dsforms.js"></script>
</head>

<body>
<?$APPLICATION->ShowPanel();?>
<div class="wrapper">
  
  <div class="mobile_nav">
    <span class="close_menu"></span>
    <ul class="top_menu_mob1">
      <?$APPLICATION->IncludeComponent("bitrix:menu", "mob", Array(
        "COMPONENT_TEMPLATE" => ".default",
          "ROOT_MENU_TYPE" => "left",  // Тип меню для первого уровня
          "MENU_CACHE_TYPE" => "A", // Тип кеширования
          "MENU_CACHE_TIME" => "3600",  // Время кеширования (сек.)
          "MENU_CACHE_USE_GROUPS" => "N", // Учитывать права доступа
          "MENU_CACHE_GET_VARS" => "",  // Значимые переменные запроса
          "MAX_LEVEL" => "1", // Уровень вложенности меню
          "CHILD_MENU_TYPE" => "left",  // Тип меню для остальных уровней
          "USE_EXT" => "Y", // Подключать файлы с именами вида .тип_меню.menu_ext.php
          "DELAY" => "N", // Откладывать выполнение шаблона меню
          "ALLOW_MULTI_SELECT" => "N",  // Разрешить несколько активных пунктов одновременно
        ),
        false
      );?>
    </ul>
    <ul class="top_menu_mob2">
      <?$APPLICATION->IncludeComponent("bitrix:menu", "mob", Array(
        "COMPONENT_TEMPLATE" => ".default",
          "ROOT_MENU_TYPE" => "top",  // Тип меню для первого уровня
          "MENU_CACHE_TYPE" => "A", // Тип кеширования
          "MENU_CACHE_TIME" => "3600",  // Время кеширования (сек.)
          "MENU_CACHE_USE_GROUPS" => "N", // Учитывать права доступа
          "MENU_CACHE_GET_VARS" => "",  // Значимые переменные запроса
          "MAX_LEVEL" => "1", // Уровень вложенности меню
          "CHILD_MENU_TYPE" => "left",  // Тип меню для остальных уровней
          "USE_EXT" => "Y", // Подключать файлы с именами вида .тип_меню.menu_ext.php
          "DELAY" => "N", // Откладывать выполнение шаблона меню
          "ALLOW_MULTI_SELECT" => "N",  // Разрешить несколько активных пунктов одновременно
        ),
        false
      );?>
    </ul>
  </div>
  
  <!-- header -->
  <header class="main_head">
    <div class="wrap">
      
      <div class="navbar_toggle">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
      </div>
	<div itemscope itemtype="http://schema.org/Organization">
      <a itemprop="url" href="/" class="logo"><img itemprop="logo" src="<?=SITE_TEMPLATE_PATH?>/img/logo.png" alt="Магазин «Мир бильярда»" title="Магазин «Мир бильярда»"></a>
	</div>      
      <nav class="top_menu">
        <?$APPLICATION->IncludeComponent("bitrix:menu", "main", Array(
        	"COMPONENT_TEMPLATE" => ".default",
        		"ROOT_MENU_TYPE" => "top",	// Тип меню для первого уровня
        		"MENU_CACHE_TYPE" => "A",	// Тип кеширования
        		"MENU_CACHE_TIME" => "3600",	// Время кеширования (сек.)
        		"MENU_CACHE_USE_GROUPS" => "N",	// Учитывать права доступа
        		"MENU_CACHE_GET_VARS" => "",	// Значимые переменные запроса
        		"MAX_LEVEL" => "1",	// Уровень вложенности меню
        		"CHILD_MENU_TYPE" => "left",	// Тип меню для остальных уровней
        		"USE_EXT" => "Y",	// Подключать файлы с именами вида .тип_меню.menu_ext.php
        		"DELAY" => "N",	// Откладывать выполнение шаблона меню
        		"ALLOW_MULTI_SELECT" => "N",	// Разрешить несколько активных пунктов одновременно
        	),
        	false
        );?>
      </nav>
      
      <div class="wfull"><a class="button" data-dspopup-id="dscallme">Заказать звонок</a></div>
      
      <div class="head_r">
        <div class="tabs-content">
           <!--<div class="box phone1">
            <?$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_TEMPLATE_PATH."/include/".LANGUAGE_ID."/phone1.php"), false);?>
          </div>-->
          <div class="box phone2 visible">
            <?$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_TEMPLATE_PATH."/include/".LANGUAGE_ID."/phone2.php"), false);?>
          </div>
          <ul class="tabs5">
           <!-- <li class="phone1"><a href="javascript:void(0);">Красноармейская</a></li>-->
            <li class="phone2 current"><a href="javascript:void(0);">Добролюбова, 1</a></li>
          </ul>
        </div>
      </div>
      
      <div class="w1024"><a class="button" data-dspopup-id="dscallme">Заказать звонок</a></div>
      
      <!-- cart -->
      <a href="javascript:void(0);" class="cart inner_cart" data-reveal-id="cartModal" data-animation="fade" id="cart">
        <span class="items_num"></span>
        <span class="b"></span>
        <span class="strong">0 <span class="rub">i</span></span>
        <span class="em">&gt;</span>
      </a> 
      <a href="/cart/" class="cart inner_cart mobile_cart" id="mobile_cart">
        <span class="items_num"></span>
        <span class="b"></span>
        <span class="strong">0 <span class="rub">i</span></span>
        <span class="em">&gt;</span>
      </a> 
      <!-- /cart -->
      <!-- favorite -->
      <a href="javascript:void(0);" class="favorite inner_fav" data-reveal-id="favoriteModal" data-animation="fade" id="favorite"><span class="items_num">0</span><span class="b"></span></a> 
      <?/*<a href="/favorites/" class="favorite inner_fav mobile_favorite" id="mobile_favorite"><span class="items_num">0</span><b></b></a>*/?>
      <a href="javascript:void(0);" class="favorite inner_fav mobile_favorite" id="mobile_favorite"><span class="items_num">0</span><span class="b"></span></a>
      <!-- /favorite -->

      <div class="logo logo_mob"><img src="<?=SITE_TEMPLATE_PATH?>/img/logo.png" alt=""></div>
      
      <div class="clear"></div>
    
    </div>
  </header>
  <!-- /header -->
  <?if($APPLICATION->GetCurPage()!='/'){?>
  <div class="inner_headline collection_head">
    <div class="wrap">
      <div <?/*if(1){?>href="/"<?}*/?> class="dealer"><img src="<?=SITE_TEMPLATE_PATH?>/img/dealer_logo.png" alt=""><span>Официальный дилер</span></div>
      
      <div class="breadcrumbs">
        <span><?$APPLICATION->ShowTitle(false)?></span>
      </div>
      
      <a href="#" class="link_back"></a>
      
      <form action="/search/" method="get" class="form_search">
        <fieldset>
          <input type="text" placeholder="Поиск" name="q">
          <input type="submit" value="">
          <span class="form_layout"></span>
        </fieldset>
      </form>
      
      <form action="/search/" method="post" class="form_search form_search_mob">
        <fieldset>
          <div class="input_box"><input type="text" name="q" placeholder="Поиск"></div>
          <div class="submit_box"><input type="submit" value=""></div>
          <span class="form_layout"></span>
        </fieldset>
      </form>
    </div>
  </div>
  
  
  <div class="wrap">
  
    <!-- catalogue menu -->
    <div class="left_col">
      <?$APPLICATION->IncludeComponent(
      	"bitrix:menu", 
      	"left-catalog", 
      	array(
      		"COMPONENT_TEMPLATE" => "left-catalog",
      		"ROOT_MENU_TYPE" => "left",
      		"MENU_CACHE_TYPE" => "N",
      		"MENU_CACHE_TIME" => "3600",
      		"MENU_CACHE_USE_GROUPS" => "N",
      		"MENU_CACHE_GET_VARS" => array(
      		),
      		"MAX_LEVEL" => "4",
      		"CHILD_MENU_TYPE" => "subleft",
      		"USE_EXT" => "Y",
      		"DELAY" => "N",
      		"ALLOW_MULTI_SELECT" => "N"
      	),
      	false
      );?>
      <?/*?><!--<div class="cat_menu_in">
        <div class="block_pattern_top3"></div>
        <div class="block_pattern_bottom3"></div>
        <ul>
          <li class="active">
            <a href="#"><span>Бильярдные коллекции</span></a>
            <ul>
              <li><a href="#">High-tech</a></li>
              <li><a href="#">Барон-Люкс</a></li>
              <li><a href="#">Венеция</a></li>
              <li><a href="#">Император</a></li>
              <li><a href="#">Император Голд</a></li>
              <li><a href="#">Император-Люкс</a></li>
            </ul>
          </li>
          <li>
            <a href="#"><span>Бильярдные столы</span></a>
            <ul>
              <li><a href="#">Суперпрофессиональная серия</a></li>
              <li><a href="#">Эксклюзивная серия</a></li>
              <li><a href="#">Профессиональная серия</a></li>
              <li><a href="#">Любительская серия</a></li>
            </ul>
          </li>
          <li>
            <a href="#"><span>Кии</span></a>
            <ul>
              <li><a href="#">Кии мастера Сергея Рябова</a></li>
              <li><a href="#">Кии Dinamika</a></li>
              <li><a href="#">Billiards</a></li>
              <li><a href="#">Кии Vantex</a></li>
            </ul>
          </li>
          <li>
            <a href="#"><span>Аксессуары для бильярда и киёв</span></a>
            <ul>
              <li><a href="#">Cукно </a></li>
              <li><a href="#">Киевницы</a></li>
              <li><a href="#">Шары</a></li>
              <li><a href="#">Светильники</a></li>
              <li><a href="#">Треугольники</a></li>
              <li><a href="#">Покрывала</a></li>
              <li><a href="#">Уход за шарами и сукном</a></li>
            </ul>
            <ul>
              <li><a href="#">Чехлы, кейсы, тубусы</a></li>
              <li><a href="#">Мел</a></li>
              <li><a href="#">Наклейки для кия (набойки, насадки)</a></li>
              <li><a href="#">Инструмент по уходу за киями и наклейками</a></li>
            </ul>
          </li>
          <li>
            <a href="#"><span>Мебель для бильярдной</span></a>
            <ul>
              <li><a href="#">Тумбы</a></li>
              <li><a href="#">Табуреты</a></li>
              <li><a href="#">Столики</a></li>
              <li><a href="#">Мебельные секции</a></li>
              <li><a href="#">Полочки</a></li>
            </ul>
          </li>
          <li>
            <a href="#"><span>Игротека</span></a>
            <ul>
              <li><a href="#">Дартс</a></li>
              <li><a href="#">Аэрохоккей</a></li>
              <li><a href="#">Клубный футбол</a></li>
              <li><a href="#">Столы трансформеры</a></li>
              <li><a href="#">Теннис</a></li>
            </ul>
          </li>
        </ul>
      </div>--><?*/?>
      <div class="links">
        <?/*<!--a href="#" title="Консультация онлайн" class="online_consult">
          <b></b>
          <span>Консультация <br>онлайн</span>
        </a-->*/?>
        <a href="/shipping/" title="Доставка" class="delivery">
          <span class="b"></span>
          <span>Доставка</span>
        </a>
        <a href="/payment/" title="Оплата" class="payment">
          <span class="b"></span>
          <span>Оплата</span>
        </a>
        <a href="/returns/" title="Возврат и обмен" class="return">
          <span class="b"></span>
          <span>Возврат <br>и обмен</span>
        </a>
      </div>
      
    </div>
    <!-- /catalogue menu -->
    
    <!-- content -->
    <div class="content clearfix">
      <div class="content__inner <?=$APPLICATION->GetPageProperty("content_inner_class")?>">
        
        <h1><?$APPLICATION->ShowTitle(false)?></h1>

        <?if($APPLICATION->GetPageProperty("note_top")){?>
        <div class="note_wrap2">
          <div class="pattern_bottom"></div>
          <div class="pattern_top"></div>
          <div class="note_box">
            <span class="em"><?$APPLICATION->ShowProperty("note_top")?></span>
          </div>
        </div>
        <?}?>
  <?}?>
