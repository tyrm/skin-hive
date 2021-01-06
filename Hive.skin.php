<?php
/**
 * Skin file for skin Foo Bar.
 *
 * @file
 * @ingroup Skins
 */

/**
 * SkinTemplate class for Hive skin
 * @ingroup Skins
 */
class SkinHive extends SkinTemplate
{
    var $skinname = 'hive', $stylename = 'Hive', $template = 'HiveTemplate';

    /**
     * This function adds JavaScript via ResourceLoader
     *
     * Use this function if your skin has a JS file(s).
     * Otherwise you won't need this function and you can safely delete it.
     *
     * @param OutputPage $out
     */

    public function initPage(OutputPage $out)
    {
        parent::initPage($out);
        $out->addModules('skins.hive.js');
        /* 'skins.foobar.js' is the name you used in your skin.json file */

        $out->addMeta('viewport', 'width=device-width, initial-scale=1.0');
        $out->addLink(array('rel' => 'icon', 'type' => 'image/png', 'href' => '/images/HiveLogo_160.png'));
        $out->addModuleStyles(array(
            'mediawiki.skinning.interface', 'skins.hive'
        ));
    }
}

/**
 * BaseTemplate class for Foo Bar skin
 *
 * @ingroup Skins
 */
class HiveTemplate extends BaseTemplate
{
    /**
     * Outputs the entire contents of the page
     */
    public function execute()
    {
        $this->html('headelement'); ?>

        <nav class="navbar navbar-expand-md navbar-dark bg-primary">
            <div class="navbar-brand">The Hive</div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01"
                    aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarColor01">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="https://wiki.hive.gay/">Wiki<span
                                    class="sr-only"> (current)</span></a>
                    </li>
                </ul>
                <a class="btn btn-discord" href="https://discord.gg/vRSXKt6" target="_blank">Join our Discord</a>
            </div>
        </nav>

        <div class="container-fluid">
            <div class="row">
                <div class="col text-right">

                    <ul id="personaltools">
                        <?php
                        foreach ($this->getPersonalTools() as $key => $item) {
                            echo $this->makeListItem($key, $item);
                        }
                        ?>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col-md-9 col-xl-10">
                    <div class="row">
                        <div class="col">

                            <ul id="toptabs" class="nav nav-tabs">
                                <?php
                                foreach ($this->data['content_navigation']['namespaces'] as $key => $tab) {
                                    $redundant = $tab['redundant'] ?? false;
                                    if ($redundant == false) {
                                        $aOptions = ['class' => 'nav-link', 'href' => $tab['href']];
                                        if ($tab['class'] == 'selected') {
                                            $aOptions['class'] = 'nav-link active';
                                        }
                                        $aHref = Html::rawElement('a', $aOptions, $tab['text']);

                                        $liOptions = ['class' => 'nav-item'];
                                        echo Html::rawElement('li', $liOptions, $aHref);
                                    }
                                }

                                $menuItemCount = count($this->data['content_navigation']['views']) + count($this->data['content_navigation']['actions']);

                                if ($menuItemCount > 0) {
                                    ?>
                                    <li class="nav-item dropdown ml-auto">
                                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#"
                                           role="button" aria-haspopup="true" aria-expanded="false">Menu</a>
                                        <div class="dropdown-menu">
                                            <?php
                                            foreach ($this->data['content_navigation']['views'] as $key => $tab) {
                                                $redundant = $tab['redundant'] ?? false;
                                                if ($redundant == false) {
                                                    $aOptions = ['class' => 'dropdown-item', 'href' => $tab['href']];
                                                    if ($tab['class'] == 'selected') {
                                                        $aOptions['class'] = 'dropdown-item active';
                                                    }
                                                    echo Html::rawElement('a', $aOptions, $tab['text']);

                                                }
                                            }

                                            if (count($this->data['content_navigation']['actions']) > 0) {
                                                echo '<div class="dropdown-divider"></div>';
                                                foreach ($this->data['content_navigation']['actions'] as $key => $tab) {
                                                    $redundant = $tab['redundant'] ?? false;
                                                    if ($redundant == false) {
                                                        $aOptions = ['class' => 'dropdown-item', 'href' => $tab['href']];
                                                        if ($tab['class'] == 'selected') {
                                                            $aOptions['class'] = 'dropdown-item active';
                                                        }
                                                        echo Html::rawElement('a', $aOptions, $tab['text']);
                                                    }
                                                }
                                            }
                                            ?>
                                        </div>
                                    </li>
                                    <?php
                                }
                                ?>
                            </ul>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <h1><?php $this->html('title'); ?></h1>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <?php $this->html('bodytext'); ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <?php $this->html('catlinks'); ?>
                        </div>
                    </div>
                    <?php if (array_key_exists('info', $this->getFooterLinks())) { ?>
                        <div class="row">
                            <div class="col text-muted">
                                <ul id="infolinks">
                                    <?php
                                    foreach ($this->getFooterLinks()['info'] as $key) { ?>
                                        <li><?php $this->html($key) ?></li>

                                        <?php
                                    } ?>
                                </ul>
                            </div>
                        </div>
                    <?php } ?>
                    <div class="row">
                        <div class="col">
                            <ul id="footerlinks">
                                <?php
                                foreach ($this->getFooterLinks()['places'] as $key) { ?>
                                    <li><?php $this->html($key) ?></li>

                                    <?php
                                } ?>
                            </ul>
                        </div>
                        <div class="col text-right">
                            <ul id="footericons">
                                <?php
                                foreach ($this->getFooterIcons('icononly') as $blockName => $footerIcons) { ?>
                                    <li>
                                        <?php
                                        foreach ($footerIcons as $icon) {
                                            echo $this->getSkin()->makeFooterIcon($icon);
                                        }
                                        ?>
                                    </li>
                                    <?php
                                } ?>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 col-xl-2 order-first">
                    <div class="text-center">
                        <a
                                href="<?php
                                echo htmlspecialchars($this->data['nav_urls']['mainpage']['href']);
                                // This outputs your wiki's main page URL to the browser.
                                ?>"
                            <?php echo Xml::expandAttributes(Linker::tooltipAndAccesskeyAttribs('p-logo')) ?>
                        >
                            <img src="<?php
                            $this->text('logopath');
                            // This outputs the path to your logo's image
                            // You can also use $this->data['logopath'] to output the raw URL of the image. Remember to HTML-escape
                            // if you're using this method, because the text() method does it automatically.
                            ?>"
                                 alt="<?php $this->text('sitename') ?>"
                            >
                        </a>
                    </div>

                    <form action="<?php $this->text('wgScript'); ?>">
                        <input type="hidden" name="title" value="<?php $this->text('searchtitle') ?>"/>
                        <?php echo $this->makeSearchInput(array('class' => 'form-control mt-1 mb-3')); ?>
                    </form>

                    <?php
                    foreach ($this->getSidebar() as $boxName => $box) { ?>
                        <div id="<?php echo Sanitizer::escapeIdForAttribute($box['id']) ?>"<?php echo Linker::tooltip($box['id']) ?>>
                            <h5><?php echo htmlspecialchars($box['header']); ?></h5>
                            <!-- If you do not want the words "Navigation" or "Tools" to appear, you can safely remove the line above. -->

                            <?php
                            if (is_array($box['content'])) { ?>
                                <ul>
                                    <?php
                                    foreach ($box['content'] as $key => $item) {
                                        echo $this->makeListItem($key, $item);
                                    }
                                    ?>
                                </ul>
                                <?php
                            } else {
                                echo $box['content'];
                            }
                            ?>
                        </div>
                    <?php } ?>

                </div>
            </div>
        </div>

        <?php $this->printTrail(); ?>
        </body>
        </html><?php
    }
}
