<?php
/*
 * File mostly created new, with parts copied from or based on the original 1.x Scratch Wiki Skin.
 */

use MediaWiki\MediaWikiServices;

class SkinScratchWikiSkin1 extends SkinTemplate {

    var $skinname = 'scratchwikiskin1', $stylename = 'ScratchWikiSkin1',
        $template = 'ScratchWikiSkin1Template';

    public function initPage(OutputPage $out){
        parent::initPage($out);
        
        $out->addModules('skins.scratchwikiskin1.js');
        $out->addModuleStyles([
            'mediawiki.skinning.elements',
            'mediawiki.skinning.content',
            'mediawiki.skinning.interface',
            'skins.scratchwikiskin1'
        ]);
    }

}

class ScratchWikiSkin1Template extends BaseTemplate {

    public function execute() {
        global $wgRequest;

        $action = $wgRequest->getText('action');
        $config = MediaWikiServices::getInstance()->getMainConfig();

        $this->html('headelement');
        ?>

        <div id="globalWrapper">
            <div id="header">
                <div class="logo">
                    <a href="<?= htmlspecialchars($this->data['nav_urls']['mainpage']['href']) ?>"></a>
                </div>

                <ul id="nav">
                    <li><a href="https://scratch.mit.edu/"><?php $this->msg('scratchwikiskin1-nav-home') ?></a></li>
                    <li><a href="https://scratch.mit.edu/explore/projects/all"><?php $this->msg('scratchwikiskin1-nav-projects') ?></a></li>
                    <li><a href="https://scratch.mit.edu/explore/studios/all"><?php $this->msg('scratchwikiskin1-nav-galleries') ?></a></li>
                    <li id="active"><a href="https://scratch.mit.edu/ideas"><?php $this->msg('scratchwikiskin1-nav-support') ?></a></li>
                    <li><a href="https://scratch.mit.edu/discuss"><?php $this->msg('scratchwikiskin1-nav-forums') ?></a></li>
                    <li><a href="https://scratch.mit.edu/about"><?php $this->msg('scratchwikiskin1-nav-about') ?></a></li>
                    <li><a href="https://scratch.mit.edu/mystuff"><?php $this->msg('scratchwikiskin1-nav-mystuff') ?></a></li>
                </ul>

                <div id="userbar">
                    <?php
                    if(isset($this->data['personal_urls']['userpage'])) {
                        ?>
                        Welcome, <a href="<?= htmlspecialchars($this->data['personal_urls']['userpage']['href']) ?>"><?= htmlspecialchars($this->data['personal_urls']['userpage']['text']) ?></a> | <a href="<?= htmlspecialchars($this->data['personal_urls']['logout']['href']) ?>"><?php $this->msg('scratchwikiskin1-user-logout') ?></a> <a href="javascript:void(0)" id="scratchwikiskin1-show-personal-links">[+]</a>
                        <?php
                    }else{
                        ?>
                        <a href="<?= htmlspecialchars($this->data['personal_urls']['login']['href']) ?>"><?php $this->msg('scratchwikiskin1-user-login-signup') ?></a> for an account
                        <?php
                    }
                    ?>
                </div>

                <div id="searchbar">
                    <?php
                    // TODO: Implementation needed
                    if($config->get('SWS1UseCSESearch')) {
                        ?>
                        <form action="<?php $this->text('wgScript'); ?>" id="cse-search-box">
                            <div>
                                <input type="hidden" name="title" value="<?= htmlspecialchars(Title::newFromText($config->get('SWS1CSESearchPage'))->getPrefixedDBkey()) ?>">
                                <input type="hidden" name="cx" value="<?= htmlspecialchars($config->get('SWS1CSESearchID')) ?>" />
                                <input type="hidden" name="cof" value="FORID:11" />
                                <input type="hidden" name="ie" value="UTF-8" />
                                <input type="text" name="q" size="31" />
                                <input type="submit" name="sa" value="<?php $this->msg('scratchwikiskin1-search') ?>" />
                            </div>
                        </form>
                        <script type="text/javascript" src="http://www.google.com/cse/brand?form=cse-search-box&lang=en"></script>
                        <?php
                    }else{
                        ?>
                        <form action="<?php $this->text('wgScript'); ?>">
                            <input type="hidden" name="title" value="<?php $this->text('searchtitle'); ?>" />
                            <?= $this->makeSearchInput(['type' => 'text', 'size' => '31']) ?>
                            <?= $this->makeSearchButton('go', ['value' => $this->getMsg('scratchwikiskin1-search')->escaped()]) ?>
                        </form>
                        <?php
                    }
                    ?>
                </div>
            </div>

            <div id="scratchpersonallinks">
                <?php
                foreach($this->data['personal_urls'] as $key=>$item){
                    if($key == 'userpage' && $key == 'logout' && $key == 'login') continue;
                    ?>
                    <span id="<?= Sanitizer::escapeIdForAttribute( "pt-$key" ) ?>" <?php if ($item['active']) { ?>class="active"<?php } ?>>
                        <a href="<?= htmlspecialchars($item['href']) ?>" <?= Xml::expandAttributes(Linker::tooltipAndAccesskeyAttribs('pt-'.$key)) ?> <?php if(!empty($item['class'])) { ?> class="<?= htmlspecialchars($item['class']) ?>"<?php } ?>>
                            <?= htmlspecialchars($item['text']) ?>
                        </a>
                    </span> | 
                    <?php
                }
                ?>
                <a href="javascript:void(0)" id="scratchwikiskin1-hide-personal-links">(hide)</a>
            </div>

            <div id="scratchpagefunctions">
                <?php
                foreach($this->data['content_actions'] as $key=>$tab){
                    ?>
                    <span id="<?= Sanitizer::escapeIdForAttribute("ca-$key") ?>" class="<?= htmlspecialchars($tab['class']) ?>">
                        <img src="<?= htmlspecialchars("{$this->get('stylepath')}/{$this->getSkin()->stylename}/resources/images/icons/page-$key.png") ?>" />
                        <a href="<?= htmlspecialchars($tab['href']) ?>" <?php // <a>
                            if(in_array($action, ['edit', 'submit']) && in_array($key, ['edit', 'watch', 'unwatch'])){
                                echo Linker::tooltip("ca-$key");
                            }else{
                                echo Xml::expandAttributes(Linker::tooltipAndAccesskeyAttribs("ca-$key"));
                            }
                            // <a>?>>
                            <?= htmlspecialchars($tab['text']) ?>
                        </a>
                    </span>
                    <?php
                }
                ?>
            </div>

            <div id="column-content">
                <div id="content">
                    <a name="top" id="top"></a>

                    <?php if($this->data['sitenotice']){ ?><div id="siteNotice"><?php $this->html('sitenotice') ?></div><?php } ?>

                    <h1 id="firstHeading" class="firstHeading">
                        <?php $this->data['displaytitle'] != '' ? $this->html('title') : $this->text('title') ?>
                    </h1>

                    <div id="bodyContent">
                        <h3 id="siteSub"><?php $this->msg('tagline') ?></h3>
                        <div id="contentSub"><?php $this->html('subtitle') ?></div>
                        <?php if($this->data['undelete']) { ?>
                            <div id="contentSub2">
                                <?php $this->html('undelete') ?>
                            </div>
                        <?php } ?>
                        <?php if($this->data['newtalk'] ) { ?>
                            <div class="usermessage">
                                <?php $this->html('newtalk') ?>
                            </div>
                        <?php } ?>
                        <?php if($this->data['showjumplinks']) { ?>
                            <div id="jump-to-nav">
                                <?php $this->msg('jumpto') ?>
                                <a href="#column-one"><?php $this->msg('jumptonavigation') ?></a>, <a href="#searchInput"><?php $this->msg('jumptosearch') ?></a>
                            </div>
                        <?php } ?>

                        <?php
                        $this->html('bodytext');
                        if($this->data['catlinks']) {
                            $this->html('catlinks');
                        }
                        ?>
                        
                        <?php
                        if($this->data['dataAfterContent']) {
                            $this->html('dataAfterContent');
                        }
                        ?>
                        <div class="visualClear"></div>
                    </div>
                </div>
            </div>

            <div class="column-one">
                <?php
                $sidebar = $this->data['sidebar'];
                if(!isset($sidebar['SEARCH'])) $sidebar['SEARCH'] = [];
                if(!isset($sidebar['TOOLBOX'])) $sidebar['TOOLBOX'] = [];
                if(!isset($sidebar['LANGUAGES'])) $sidebar['LANGUAGES'] = [];
                foreach($sidebar as $boxName=>$cont){
                    if($boxName == 'SEARCH'){
                    }elseif($boxName == 'TOOLBOX'){
                        $this->toolbox();
                    }elseif($boxName == 'LANGUAGES'){
                        $this->languageBox();
                    }else{
                        $this->customBox($boxName, $cont);
                    }
                }
                ?>
            </div>

            <div class="visualClear"></div>

            <div id="footer">
                <a href="https://scratch.mit.edu/download"><?php $this->msg('scratchwikiskin1-footer-download') ?></a> | 
                <a href="https://secure.donationpay.org/scratchfoundation/"><?php $this->msg('scratchwikiskin1-footer-donate') ?></a> | 
                <a href="https://scratch.mit.edu/privacy_policy"><?php $this->msg('scratchwikiskin1-footer-privacy') ?></a> | 
                <a href="https://scratch.mit.edu/terms_of_use"><?php $this->msg('scratchwikiskin1-footer-terms') ?></a> | 
                <a href="https://scratch.mit.edu/DMCA"><?php $this->msg('scratchwikiskin1-footer-copyright') ?></a> | 
                <a href="https://scratch.mit.edu/contact-us"><?php $this->msg('scratchwikiskin1-footer-contact') ?></a>
            </div>
        </div>

        <?php $this->printTrail(); ?>
        </body>
        </html>
        <?php
    }

    private function toolbox(){
        ?>
        <div class="portlet" id="p-tb">
            <h5><?php $this->msg('toolbox') ?></h5>
            <div class="pBody">
                <ul>
                    <?php
                    foreach($this->data['sidebar']['TOOLBOX'] as $key=>$tbitem){
                        echo $this->makeListItem($key, $tbitem);
                    }
                    ?>
                </ul>
            </div>
        </div>
        <?php
    }

    private function languageBox(){
        if(!$this->data['language_urls']) return;
        ?>
        <div class="portlet" id="p-lang">
            <h5><?php $this->msg('otherlanguages') ?></h5>
            <div class="pBody">
                <ul>
                    <?php
                    foreach($this->data['language_urls'] as $key=>$langLink){
                        echo $this->makeListItem($key, $langLink);
                    }
                    ?>
                </ul>
            </div>
        </div>
        <?php
    }

    private function customBox($bar, $cont){
        ?>
        <div class="generated-sidebar portlet" id="<?= Sanitizer::escapeIdForAttribute("p-$bar") ?>" <?= Linker::tooltip("p-$bar") ?>>
            <h5><?= wfMessage($bar)->exists() ? wfMessage($bar)->escaped() : $bar ?></h5>
            <div class="pBody">
                <?php if(is_array($cont)){ ?>
                    <ul><?php
                    foreach($cont as $key=>$val){
                        echo $this->makeListItem($key, $val);
                    }
                    ?></ul>
                <?php }else{ echo $cont; } ?>
            </div>
        </div>
        <?php
    }

}