<?if($APPLICATION->GetPageProperty("include")){?>
<?}?>

<?if($APPLICATION->GetCurPage()!='/'){?>
    </div>
  </div>
  <!-- /content -->
  <div class="clear"></div>
</div>
<?}?>
<div class="push"></div>
</div>

<!-- footer -->
<footer>
  <div class="footer_top">
    <span class="pattern_top_2"></span>
    <span class="pattern_bottom_2"></span>
    <div class="wrap">
      <div class="foot_left">
        <nav class="foot_nav">
          <?$APPLICATION->IncludeComponent(
            "bitrix:menu", 
            "footer-catalog", 
            array(
              "COMPONENT_TEMPLATE" => "left-catalog",
              "ROOT_MENU_TYPE" => "left",
              "MENU_CACHE_TYPE" => "N",
              "MENU_CACHE_TIME" => "3600",
              "MENU_CACHE_USE_GROUPS" => "N",
              "MENU_CACHE_GET_VARS" => array(
              ),
              "MAX_LEVEL" => "3",
              "CHILD_MENU_TYPE" => "subleft",
              "USE_EXT" => "Y",
              "DELAY" => "N",
              "ALLOW_MULTI_SELECT" => "N"
            ),
            false
          );?>
        </nav>
        <ul class="bottom_menu">
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
        <form action="/search/" method="get" class="search_form_foot">
          <fieldset>
            <input type="text" placeholder="Поиск" name="q">
            <input type="submit" value="">
          </fieldset>
        </form>
        <a href="/sitemap/" class="site_map_link"><span class="b"></span>Карта сайта</a>
        <div class="clear"></div>
      </div>
      <ul class="foot_mobile_nav">
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
      <div class="foot_right">
        <div class="foot_shops">
          <span></span>
          <a href="/contacts/">Магазины <br>в Екатеринбурге</a>
          <p class="addr_1">ул. Добролюбова, д. 1. <br>Тел. <a href="tel:+73432005848" class="phone-tel-footer">+7 (343) 200-58-48</a></p>
         <?/*<!-- <p><b>ул. Красноармейская, 10. <br>Тел. +7 (343) 200-58-48</b></p>-->*/?>
        </div>
        <div class="pay_systems">
          <div href="#" class="pay1"></div>
          <div href="#" class="pay2"></div>
          <div href="#" class="pay3"></div>
          <div href="#" class="pay4"></div>
        </div>
      </div>
      <div class="clear"></div>
    </div>
  </div>
  <div class="foot_bottom">
    <div class="wrap">
      <p class="copy">© 2017 Мир бильярда<br/>Интернет-магазин бильярдных товаров и аксессуаров</p>
      <?/*<p class="made"><a href="http://www.studio-v.ru/" class="made_logo"><img src="<?=SITE_TEMPLATE_PATH?>/img/logo_made.png" alt=""></a><span><a href="http://www.studio-v.ru/" class="made_link" rel="nofollow">Разработка сайта</a> – студия «Восхождение»</span></p>*/?>
      <div class="foot_dealer">
        <img src="<?=SITE_TEMPLATE_PATH?>/img/dealer_logo_foot.png" alt="">
        <span>Официальный дилер<br>фабрики «Старт»</span>
      </div>
      <div class="clear"></div>
    </div>
  </div>
</footer> 
<!-- /footer -->


<!-- cart modal -->
<div id="cartModal" class="reveal-modal">
  <a href="javascript:void(0);" class="close-reveal-modal close">Закрыть<span class="b"></span></a>
  <div class="cart_bg">
    <div class="pattern_top"></div>
    <div class="pattern_bottom"></div>
    <div class="cart_content">
      <?$APPLICATION->IncludeComponent(
        "bitrix:sale.basket.basket", 
        "cart-full", 
        array(
          "AJAX_MODE" => "Y",
          "COMPONENT_TEMPLATE" => ".default",
          "COLUMNS_LIST" => array(
            0 => "NAME",
            1 => "PROPS",
            2 => "DELETE",
            3 => "DELAY",
            4 => "TYPE",
            5 => "PRICE",
            6 => "QUANTITY",
          ),
          "PATH_TO_ORDER" => "/order/",
          "HIDE_COUPON" => "Y",
          "PRICE_VAT_SHOW_VALUE" => "N",
          "COUNT_DISCOUNT_4_ALL_QUANTITY" => "N",
          "USE_PREPAYMENT" => "N",
          "QUANTITY_FLOAT" => "N",
          "SET_TITLE" => "N",
          "ACTION_VARIABLE" => "action",
          "OFFERS_PROPS" => array(
			'0' => '',
          )
        ),
        false
      );?>
    </div>
  </div>
</div>
<!-- /cart modal -->

<!-- favorite modal -->
<div id="favoriteModal" class="reveal-modal">
  <a href="javascript:void(0);" class="close-reveal-modal close">Закрыть<span class="b"></span></a>
  <div class="cart_bg">
    <div class="pattern_top"></div>
    <div class="pattern_bottom"></div>
    <div class="cart_content">
      ... идет загрузка ...
    </div>
  </div>
</div>
<!-- /favorite modal -->

<!-- cue helper modal -->
<div id="cueHelperModal" class="reveal-modal">
  <a href="javascript:void(0);" class="close-reveal-modal close">Закрыть<span class="b"></span></a>
  <div class="cue-length-helper">
    <div class="pattern_top"></div>
    <div class="pattern_bottom"></div>
    <div class="cue_helper_body">
      <div class="h2">Подбор кия по росту</div>
      <div class="cue-length-slider-block">
        <span class="b">2 м</span>
        <span class="b marg">1,90</span>
        <span class="b marg">1,80</span>
        <span class="b">1,70</span>
        <span class="b">1,60</span>
        <span class="b">1,50</span>
        <div class="height-slider"></div>
      </div>
      <div class="cue-length-text">
        <div class="pattern_top"></div>
        <div class="pattern_bottom"></div>
        <div class="cue_text_head">
          <span>Ваш рост</span>
          <span class="strong">1,80 м</span>
        </div>
        <div class="cue_helper_description">
          <p>Скорее всего, вам подойдет кий длиной</p>
          <span class="strong">160 см</span>
          <div class="clear"></div>
          <input type="button" value="Показать кии" class="button button_show_cues">
        </div>
      </div>
      <div class="clear cl3"></div>
      <div class="cue_helper_text">
        <p>Стандартная длина киёв для русского бильярда — 160 см, обычно эта длина подходит большинству взрослых людей. Но если ваш рост больше 180 см — воспользуйтесь помощником. </p>
        <p>Разброс ±2 см не играет огромной роли.</p>
      </div>
      <div class="clear"></div>
    </div>
  </div>
</div>
<!-- /cue helper modal -->

<script type="text/javascript" src="<?=SITE_TEMPLATE_PATH?>/js/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="<?=SITE_TEMPLATE_PATH?>/js/jquery-migrate-1.2.1.min.js"></script> 
<script type="text/javascript" src="<?=SITE_TEMPLATE_PATH?>/js/jquery.placeholder.min.js"></script>
<script type="text/javascript" src="<?=SITE_TEMPLATE_PATH?>/js/jquery.flexslider.js"></script> 
<script type="text/javascript" src="<?=SITE_TEMPLATE_PATH?>/js/jquery.mousewheel.js"></script> 
<script type="text/javascript" src="<?=SITE_TEMPLATE_PATH?>/js/cusel.js?v=2"></script> 
<script type="text/javascript" src="<?=SITE_TEMPLATE_PATH?>/js/jScrollPaneCusel.js"></script>
<script type="text/javascript" src="<?=SITE_TEMPLATE_PATH?>/js/checkbox.js"></script>
<script type="text/javascript" src="<?=SITE_TEMPLATE_PATH?>/js/slick.js"></script> 
<script type="text/javascript" src="<?=SITE_TEMPLATE_PATH?>/js/jquery.reveal.js"></script> 
<script type="text/javascript" src="<?=SITE_TEMPLATE_PATH?>/js/jquery.sliderkit.1.9.2.pack.js"></script>
<script type="text/javascript" src="<?=SITE_TEMPLATE_PATH?>/js/jquery.fancybox.js"></script> 
<script type="text/javascript" src="<?=SITE_TEMPLATE_PATH?>/js/jquery-ui.js"></script>
<?if(CSite::inDir('/contacts/')){?>
<script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?sid=Gzsj5T38gBXOSpTyBK80jLKt_OOafxLy&amp;width=632&amp;height=288&amp;lang=ru_RU&amp;sourceType=constructor&amp;scroll=true&amp;id=map"></script>
<!--<script type="text/javascript" charset="utf-8" src="https://api-maps.yandex.ru/services/constructor/1.0/js/?sid=Xc1Uf5QofWKQQnAm94eEfnOmc84D129d&amp;width=auto&amp;height=288&amp;id=map"></script> -->
<?}?>
<script type="text/javascript" src="<?=SITE_TEMPLATE_PATH?>/js/cloud-zoom.3.1.js"></script>
<script type="text/javascript" src="<?=SITE_TEMPLATE_PATH?>/js/scripts.js"></script>
<script type="text/javascript" src="<?=SITE_TEMPLATE_PATH?>/js/sv.js?v=4"></script>

<div id="ajax-container" style="width:0;height:0;visibility:hidden">
  <?$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_TEMPLATE_PATH."/ajax/basket-status.php"), false);?>
  <?$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_TEMPLATE_PATH."/ajax/favorites-status.php"), false);?>
</div>

<!-- Yandex.Metrika counter -->
<script type="text/javascript" >
    (function (d, w, c) {
        (w[c] = w[c] || []).push(function() {
            try {
                w.yaCounter44533048 = new Ya.Metrika({
                    id:44533048,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true,
                    webvisor:true
                });
            } catch(e) { }
        });

        var n = d.getElementsByTagName("script")[0],
            s = d.createElement("script"),
            f = function () { n.parentNode.insertBefore(s, n); };
        s.type = "text/javascript";
        s.async = true;
        s.src = "https://mc.yandex.ru/metrika/watch.js";

        if (w.opera == "[object Opera]") {
            d.addEventListener("DOMContentLoaded", f, false);
        } else { f(); }
    })(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/44533048" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->

<script>
 (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
   (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
   })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
 
   ga('create', 'UA-98513506-1', 'auto');
   ga('send', 'pageview');
 
</script>

<script type="text/javascript" src="/d-goals.js"></script>
</body>
</html>