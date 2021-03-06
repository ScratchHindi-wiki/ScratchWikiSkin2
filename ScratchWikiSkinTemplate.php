<?php
/**
 * BaseTemplate class for ScratchWikiSkin
 *
 * @file
 * @ingroup Skins
 */

class ScratchWikiSkinTemplate extends BaseTemplate {
	public function execute() {
		global $wgRequest, $wgStylePath, $wgUser, $wgLogo;
		$skin = $this->data['skin'];
		wfSuppressWarnings();
		$this->html('headelement');
		?>
<div id="navigation">
	<div class="inner">
		<ul>
			<li class="logo"><a aria-label="Scratch" href="https://scratch.mit.edu/"></a></li>
			<li class="link create">
				<a href="https://scratch.mit.edu/projects/editor/"><span><?=wfMessage( 'scratchwikiskin-create' )->escaped() ?></span></a>
			</li>
			<li class="link explore">
				<a href="https://scratch.mit.edu/explore/projects/all"><span><?=wfMessage( 'scratchwikiskin-explore' )->escaped() ?></span></a>
			</li>
			<li class="link discuss">
				<a href="https://scratch.mit.edu/discuss"><span><?=wfMessage( 'scratchwikiskin-discuss' )->escaped() ?></span></a>
			</li>
			<li class="link tips">
				<a href="https://scratch.mit.edu/tips"><span><?=wfMessage( 'scratchwikiskin-tips' )->escaped() ?></span></a>
			</li>
			<li class="link about">
				<a href="https://scratch.mit.edu/about"><span><?=wfMessage( 'scratchwikiskin-about' )->escaped() ?></span></a>
			</li>
			<li class="search">
				<form class="form" action="<?php $this->text( 'wgScript' ) ?>">
					<button class="button btn-search"></button>
					<div class="form-group row no-label">
						<div class="col-sm-9">
							<input type="text" class="input" id="searchInput" accesskey="<?=wfMessage( 'accesskey-search' )->text() ?>" title="Search Scratch Wiki [alt-shift-<?=wfMessage( 'accesskey-search' )->text()?>]" name="search" autocomplete="off" placeholder="Search the Wiki" />
							<input type="hidden" value="Special:Search" name="title" />
							<span class="help-block">Not Required</span>
						</div>
					</div>
				</form>
			</li>
			<li class="link right content-actions">
				<a class="user-info"></a>
				<ul class="dropdown">
<?php foreach ($this->data['content_actions'] as $key => $tab) { ?>
					<?=$this->makeListItem($key, $tab)?>

<?php } ?>

				</ul>
			</li>
			<li class="link right account-nav">
				<a class="user-info">
					<span class="profile-name"><?php if (!$wgUser->isLoggedIn()) { ?><?=wfMessage( 'scratchwikiskin-notloggedin' )->escaped()?><?php } else { ?><?=htmlspecialchars($wgUser->mName)?><?php } ?></span>
				</a>
				<ul class="dropdown">
<?php foreach ($this->data['personal_urls'] as $key => $tab) { ?>
					<li <?php if ($tab['class']) { ?>class="<?=htmlspecialchars($tab['class'])?>"<?php } ?>><a name="<?=htmlspecialchars($key)?>" href="<?=htmlspecialchars($tab['href'])?>"><span><?=htmlspecialchars($tab['text'])?></span></a></li>

<?php } ?>

				</ul>
			</li>
		</ul>
	</div>
</div>
<div id="view">
	<div class="splash">
		<div class="inner mod-splash">
			<div class="left">
				<div class="wikilogo_space"><a class="wikilogo" style="background-image: url(<?=$wgLogo?>);" href="<?=htmlspecialchars($this->data['nav_urls']['mainpage']['href'])?>" title="<?=wfMessage( 'mainpage' )->escaped()?>"></a></div>
<?php foreach ($this->getSidebar() as $box) {
	if ($box['header'] != 'Toolbox' || $wgUser->isLoggedIn()) { ?>
				<div class="box">
					<div class="box-header">
						<h4><?=htmlspecialchars($box['header'])?></h4>
					</div>
					<div class="box-content">
<?php if (is_array($box['content'])) { ?>
						<ul>
<?php foreach ($box['content'] as $name => $item) { ?>
							<?=$this->makeListItem($name, $item)?>

<?php } ?>

						</ul>
<?php } else { ?>
						<?=$box['content']?>
<?php } ?>
					</div>
				</div>
<?php }
}
if (!$wgUser->isLoggedIn()) { ?>
				<div class="box">
					<div class="box-header">
						<h4><?=wfMessage( 'scratchwikiskin-helpthewiki' )->escaped()?></h4>
					</div>
					<div class="box-content">
						<p><?=wfMessage( 'scratchwikiskin-madeforscratchers')->parse()?></p>
						<p><a href="<?php echo Title::newFromText(wfMessage( 'scratchwikiskin-becomeacontributor-page' )->text())->getLocalURL();?>"><?=wfMessage( 'scratchwikiskin-learnaboutjoining' )->escaped()?></a></p>
						<p><a href="<?php echo Title::newFromText(wfMessage( 'portal-url' )->text())->getLocalURL();?>"><?=wfMessage( 'scratchwikiskin-seeportal' )->escaped()?></a></p>
					</div>
				</div>
<?php } ?>
			</div>
			<div class="right">
				<?php if ($this->data['newtalk']) { ?><div class="box"><div class="box-header"><h4><?php $this->html('newtalk') ?></h4></div></div><?php } ?>
				<?php if ($this->data['sitenotice']) { ?><div id="siteNotice"><?php $this->html('sitenotice'); ?></div><?php } ?>
				<div class="box">
					<div class="box-header">
						<h1 id="firstHeading" class="firstHeading"><?php $this->html('title')?><?=$this->getIndicators()?></h1>
					</div>
					<div class="box-content" id="content">
<p id="siteSub"><?=wfMessage( 'tagline' )->escaped()?></p>
<?php if ($this->data['subtitle']) { ?><p id="contentSub"><?php $this->html('subtitle') ?></p><?php } ?>
<?php if ($this->data['undelete']) { ?><p><?php $this->html('undelete') ?></p><?php } ?>
<?php $this->html('bodytext') ?>
<?php $this->html('dataAfterContent'); ?>
<?php if ($this->data['catlinks']) {
	$this->html( 'catlinks' );
} ?>
					</div>
				</div>
				<ul id="feet">
<?php foreach ( $this->getFooterLinks('flat') as $key ) { ?>
					<li><?php $this->html( $key ) ?></li>
<?php } ?>
				</ul>
			</div>
		</div>
	</div>
</div>
<div id="footer">
	<div class="inner">
		<div class="lists">
			<dl>
				<dt><span><?=wfMessage('scratchwikiskin-footer-about-title')->parse()?></span></dt>
<dd><span><a href="https://scratch.mit.edu/about/"><?=wfMessage('scratchwikiskin-footer-about')->parse()?></a></span></dd>
<dd><span><a href="https://scratch.mit.edu/parents/"><?=wfMessage('scratchwikiskin-footer-parents')?></a></span></dd>
<dd><span><a href="https://scratch.mit.edu/educators/"><?=wfMessage('scratchwikiskin-footer-educators')->parse()?></a></span></dd>
<dd><span><a href="https://scratch.mit.edu/developers/"><?=wfMessage('scratchwikiskin-footer-developers')->parse()?></a></span></dd>
<dd><span><a href="https://scratch.mit.edu/info/credits"><?=wfMessage('scratchwikiskin-footer-credits')->parse()?></a></span></dd>
<dd><span><a href="https://scratch.mit.edu/jobs"><?=wfMessage('scratchwikiskin-footer-jobs')->parse()?></a></span></dd>
<dd><span><a href="https://en.scratch-wiki.info/wiki/Scratch_Press"><?=wfMessage('scratchwikiskin-footer-press')->parse()?></a></span></dd>
			</dl>
			<dl>
				<dt><span><?=wfMessage('scratchwikiskin-footer-community-title')->parse()?></span></dt>
<dd><span><a href="https://scratch.mit.edu/community_guidelines"><?=wfMessage('scratchwikiskin-footer-cgs')->parse()?></a></span></dd>
<dd><span><a href="https://scratch.mit.edu/discuss/"><?=wfMessage('scratchwikiskin-footer-discuss')->parse()?></a></span></dd>
<dd><span><a href="https://en.scratch-wiki.info"><?=wfMessage('scratchwikiskin-footer-wiki')->parse()?></a></span></dd>
<dd><span><a href="https://scratch.mit.edu/statistics/"><?=wfMessage('scratchwikiskin-footer-stats')->parse()?></a></span></dd>
			</dl>
			<dl>
				<dt><span><?=wfMessage('scratchwikiskin-footer-support-title')->parse()?></span></dt>
<dd><span><a href="https://scratch.mit.edu/tips"><?=wfMessage('scratchwikiskin-footer-tips')->parse()?></a></span></dd>
<dd><span><a href="https://scratch.mit.edu/info/faq"><?=wfMessage('scratchwikiskin-footer-faq')->parse()?></a></span></dd>
<dd><span><a href="https://scratch.mit.edu/download"><?=wfMessage('scratchwikiskin-footer-offline')->parse()?></a></span></dd>
<dd><span><a href="https://scratch.mit.edu/contact-us"><?=wfMessage('scratchwikiskin-footer-contact')->parse()?></a></span></dd>
<dd><span><a href="https://scratch.mit.edu/store"><?=wfMessage('scratchwikiskin-footer-store')->parse()?></a></span></dd>
<dd><span><a href="https://secure.donationpay.org/scratchfoundation/"><?=wfMessage('scratchwikiskin-footer-donate')->parse()?></a></span></dd>
			</dl>
			<dl>
				<dt><span><?=wfMessage('scratchwikiskin-footer-legal-title')->parse()?></span></dt>
<dd><span><a href="https://scratch.mit.edu/terms_of_use"><?=wfMessage('scratchwikiskin-footer-tos')->parse()?></a></span></dd>
<dd><span><a href="https://scratch.mit.edu/privacy_policy"><?=wfMessage('scratchwikiskin-footer-privacy')->parse()?></a></span></dd>
<dd><span><a href="https://scratch.mit.edu/DMCA"><?=wfMessage('scratchwikiskin-footer-dmca')->parse()?></a></span></dd>
			</dl>
			<dl>
				<dt><span><?=wfMessage('scratchwikiskin-footer-family-title')->parse()?></span></dt>
<dd><span><a href="http://scratched.gse.harvard.edu"><?=wfMessage('scratchwikiskin-footer-scratched')->parse()?></a></span></dd>
<dd><span><a href="https://www.scratchjr.org"><?=wfMessage('scratchwikiskin-footer-scratchjr')->parse()?></a></span></dd>
<dd><span><a href="https://day.scratch.mit.edu"><?=wfMessage('scratchwikiskin-footer-scratchday')->parse()?></a></span></dd>
<dd><span><a href="https://scratch.mit.edu/conference"><?=wfMessage('scratchwikiskin-footer-conference')->parse()?></a></span></dd>
<dd><span><a href="https://www.scratchfoundation.org"><?=wfMessage('scratchwikiskin-footer-foundation')->parse()?></a></span></dd>
			</dl>
		</div>
		<div class="copyright">
			<p><span><?=wfMessage('scratchwikiskin-footer-llk')->parse()?></span></p>
		</div>
	</div>
</div>
<?php $this->printTrail();
	}
}
