<?php
/**
 * DokuWiki Starter Template
 *
 * @link   http://dokuwiki.org/template:starter
 * @author Anika Henke <anika@selfthinker.org>
 */

if (!defined('DOKU_INC')) die(); /* must be run from within DokuWiki */
@require_once(dirname(__FILE__).'/tpl_functions.php'); /* include hook for template functions */

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $conf['lang'] ?>"
  lang="<?php echo $conf['lang'] ?>" dir="<?php echo $lang['direction'] ?>">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?php tpl_pagetitle() ?> [<?php echo strip_tags($conf['title']) ?>]</title>
    <?php tpl_metaheaders() ?>
    <link rel="shortcut icon" href="<?php echo _tpl_getFavicon() /* DW versions > 2010-11-12 can use the core function tpl_getFavicon() */ ?>" />
    <?php @include(dirname(__FILE__).'/meta.html') /* include hook */ ?>
</head>

<body>
    <?php /* with these Conditional Comments you can better address IE issues in CSS files,
             precede CSS rules by #IE6 for IE6, #IE7 for IE7 and #IE8 for IE8 (div closes at the bottom) */ ?>
    <!--[if IE 6 ]><div id="IE6"><![endif]--><!--[if IE 7 ]><div id="IE7"><![endif]--><!--[if IE 8 ]><div id="IE8"><![endif]-->

    <?php /* classes mode_<action> are added to make it possible to e.g. style a page differently if it's in edit mode,
         see http://www.dokuwiki.org/devel:action_modes for a list of action modes */ ?>
    <?php /* .dokuwiki should always be in one of the surrounding elements (e.g. plugins and templates depend on it) */ ?>
    <div id="dokuwiki__site"><div class="dokuwiki site mode_<?php echo $ACT ?>">
        <?php html_msgarea() /* occasional error and info messages on top of the page */ ?>
        <?php @include(dirname(__FILE__).'/header.html') /* include hook */ ?>

        <!-- ********** HEADER ********** -->
        <div id="dokuwiki__header"><div class="pad">
            <p class="claim">7th International Symposium on Wikis and Open Collaboration</p>

            <h1><?php tpl_link(wl(),'<img src="'.DOKU_TPL.'pix/logo.png" alt="'.$conf['title'].'" />','id="dokuwiki__top" accesskey="h" title="[H]"') ?></h1>
            <div class="more">
                <p class="loc">
                    Mountain View, California<br />
                    October 3-5, 2011
                </p>

                <p class="until">
                    <span><?php echo round((strtotime('2011-10-03')-time())/(60*60*24)) ?></span><br />
                    days left
                </p>
            </div>

            <div class="clearer"></div>

            <div class="clearer"></div>
            <hr class="a11y" />
        </div></div><!-- /header -->

        <div id="dokuwiki__navigation"><div class="pad">
            <?php tpl_include_page('navigation') ?>
            <div class="clearer"></div>
        </div></div>

        <div class="wrapper">

            <!-- ********** ASIDE ********** -->
            <div id="dokuwiki__aside"><div class="pad">
                <div class="searchform">
                    <?php tpl_searchform() ?>
                </div>

                    <?php
                       if($_SERVER['REMOTE_USER']){
                            echo '<div id="wiki__tools">';

                            echo '<ul>';
                            tpl_action('edit', 1, 'li');
                            tpl_action('history', 1, 'li');
                            tpl_action('backlink', 1, 'li');
                            tpl_action('subscribe', 1, 'li');
                            tpl_action('recent', 1, 'li');
                            tpl_action('admin', 1, 'li');
                            tpl_action('profile', 1, 'li');
                            tpl_action('login', 1, 'li');
                            echo '</ul>';

                            echo '<p class="logininfo">';
                            tpl_userinfo();
                            echo '</p>';

                            echo '</div>';
                        }else{
                            ?>
                            <div id="wiki__login">
                                <form action="" method="post" >
                                    <input type="hidden" name="do" value="login" />
                                    <label for="user__name" class="block">
                                        Username
                                        <input type="text" name="u" id="user__name" class="edit" />
                                    </label>
                                    <label for="pass__word" class="block">
                                        Password
                                        <input type="password" name="p" id="pass_word" class="edit" />
                                    </label>

                                    <label for="remember__me" class="remember">
                                        <input type="checkbox" id="remember__me" name="r" value="1" />
                                        Remember me
                                    </label>

                                    <input type="submit" value="Login" class="button" />
                                </form>
                                <div class="clearer"></div>
                                <p class="resendpwd"><a href="<?php echo wl($ID,array('do'=>'resendpwd'))?>">Forgot your Password ▸</a></p>
                                <p class="register"><a href="<?php echo wl($ID,array('do'=>'register'))?>">Register ▸</a></p>
                                <div class="clearer"></div>
                            </div>
                    <?php } ?>
                <hr />
                <div class="include">
                    <?php tpl_include_page('sidebar') ?>
                </div>
                <div class="clearer"></div>
            </div></div><!-- /aside -->

            <!-- ********** CONTENT ********** -->
            <div id="dokuwiki__content"><div class="pad">

                <!-- BREADCRUMBS -->
                <?php if($conf['breadcrumbs']){ ?>
                  <div class="breadcrumbs"><?php tpl_breadcrumbs() ?></div>
                <?php } ?>
                <?php if($conf['youarehere']){ ?>
                  <div class="breadcrumbs"><?php tpl_youarehere() ?></div>
                <?php } ?>



                <?php tpl_flush() /* flush the output buffer */ ?>
                <?php @include(dirname(__FILE__).'/pageheader.html') /* include hook */ ?>

                <div class="page">
                    <!-- wikipage start -->
                    <?php tpl_content() /* the main content */ ?>
                    <!-- wikipage stop -->
                    <div class="clearer"></div>
                </div>

                <?php tpl_flush() ?>
                <?php @include(dirname(__FILE__).'/pagefooter.html') /* include hook */ ?>
            </div></div><!-- /content -->

            <div class="clearer"></div>
            <hr class="a11y" />


        </div><!-- /wrapper -->

        <!-- ********** FOOTER ********** -->
        <div id="dokuwiki__footer"><div class="pad">
            <div class="doc"><?php tpl_pageinfo() /* 'Last modified' etc */ ?></div>
            <?php tpl_license('button') /* content license, parameters: img=*badge|button|0, imgonly=*0|1, return=*0|1 */ ?>
        </div></div><!-- /footer -->


        <div id="wikisym__footer"><div class="pad">
            &copy; 2010 The International Symposium on Wikis and Open collaboration<br />
            Powered by <a href="http://www.cosmocode.de">CosmoCode GmbH</a> and <a href="http://www.dokuwiki.org">DokuWiki</a>
        </div></div>

    </div></div><!-- /site -->

    <div class="no"><?php tpl_indexerWebBug() /* provide DokuWiki housekeeping, required in all templates */ ?></div>
    <!--[if ( IE 6 | IE 7 | IE 8 ) ]></div><![endif]-->
</body>
</html>
