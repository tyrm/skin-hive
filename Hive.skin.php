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
class SkinHive extends SkinTemplate {
	var $skinname = 'hive', $stylename = 'Hive', $template = 'HiveTemplate';

	/**
	 * This function adds JavaScript via ResourceLoader
	 *
	 * Use this function if your skin has a JS file(s).
	 * Otherwise you won't need this function and you can safely delete it.
	 *
	 * @param OutputPage $out
	 */
	
	public function initPage( OutputPage $out ) {
		parent::initPage( $out );
		$out->addModules( 'skins.hive.js' );
		/* 'skins.foobar.js' is the name you used in your skin.json file */
	}

	/**
	 * Add CSS via ResourceLoader
	 *
	 * @param OutputPage $out
	 */
	function setupSkinUserCss( OutputPage $out ) {
		parent::setupSkinUserCss( $out );
		$out->addModuleStyles( array(
			'mediawiki.skinning.interface', 'skins.hive'
			/* 'skins.foobar' is the name you used in your skin.json file */
		) );
	}
}

/**
 * BaseTemplate class for Foo Bar skin
 *
 * @ingroup Skins
 */
class HiveTemplate extends BaseTemplate {
	/**
	 * Outputs the entire contents of the page
	 */
	public function execute() {
		$this->html( 'headelement' ); ?>

<nav class="navbar navbar-expand-md navbar-dark bg-primary">
  <div class="navbar-brand">The Hive</div>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarColor01">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <div class="nav-link disabled">Home</div>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="https://wiki.hive.gay/">Wiki<span class="sr-only"> (current)</span></a>
      </li>
    </ul>
  </div>
</nav>

<div class="container">
  <div class="row">
    <div class="col-md-3">
      <div class="text-center">
      <a
	href="<?php 
		echo htmlspecialchars( $this->data['nav_urls']['mainpage']['href'] );
		// This outputs your wiki's main page URL to the browser.
		?>"
	<?php echo Xml::expandAttributes( Linker::tooltipAndAccesskeyAttribs( 'p-logo' ) ) ?>
      >
	<img src="<?php 
		 	$this->text( 'logopath' ); 	
		 	// This outputs the path to your logo's image
		 	// You can also use $this->data['logopath'] to output the raw URL of the image. Remember to HTML-escape
		 	// if you're using this method, because the text() method does it automatically.
		?>"
		alt="<?php $this->text( 'sitename' ) ?>"
	>
      </a>
      </div>
    </div>
    <div class="col-md-9">
      One of three columns
    </div>
  </div>
</div>

<?php $this->printTrail(); ?>
</body>
</html><?php
	}
}
