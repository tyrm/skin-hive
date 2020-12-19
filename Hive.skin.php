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
    }

    /**
     * Add CSS via ResourceLoader
     *
     * @param OutputPage $out
     */
    function setupSkinUserCss(OutputPage $out)
    {
        parent::setupSkinUserCss($out);
        $out->addModuleStyles(array(
            'skins.hive'
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
                    <li class="nav-item">
                        <div class="nav-link disabled">Home</div>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="https://wiki.hive.gay/">Wiki<span
                                    class="sr-only"> (current)</span></a>
                    </li>
                </ul>
            </div>
        </nav>

        <div class="container">
            <div class="row">
                <div class="col text-right">

                    <ul id="personaltools">
                        <?php
                        foreach ( $this->getPersonalTools() as $key => $item ) {
                            echo $this->makeListItem( $key, $item );
                        }
                        ?>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
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
                        <?php echo $this->makeSearchInput(); ?>
                    </form>

                    <?php
                    foreach ($this->getSidebar() as $boxName => $box) { ?>
                        <div id="<?php echo Sanitizer::escapeId($box['id']) ?>"<?php echo Linker::tooltip($box['id']) ?>>
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
                <div class="col-md-9">
                    <div class="row">
                        <div class="col">

                            <ul class="nav nav-tabs">
                                <?php
                                foreach ($this->data['content_navigation']['namespaces'] as $key => $tab) {
                                    if ($tab['redundant'] == false) {
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
                                //echo Html::rawElement( 'p', [], $menuItemCount );

                                if ($menuItemCount > 0) {
                                    ?>
                                    <li class="nav-item dropdown ml-auto">
                                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#"
                                           role="button" aria-haspopup="true" aria-expanded="false">Menu</a>
                                        <div class="dropdown-menu">
                                            <?php
                                            foreach ($this->data['content_navigation']['views'] as $key => $tab) {
                                                if ($tab['redundant'] == false) {
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
                                                    if ($tab['redundant'] == false) {
                                                        $aOptions = ['class' => 'dropdown-item', 'href' => $tab['href']];
                                                        if ($tab['class'] == 'selected') {
                                                            $aOptions['class'] = 'dropdown-item active';
                                                        }
                                                        echo Html::rawElement('a', $aOptions, $tab['text']);

                                                    }
                                                }
                                            }
                                            ?>

                                            <a class="dropdown-item" href="#">Separated link</a>
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
                </div>
            </div>
        </div>

        <?php $this->printTrail(); ?>
        </body>
        </html><?php
    }
}
