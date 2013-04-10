<?php

/**
 * Copyright: milkyway <yhxxlm@gmail.com>
 * Base on <http://trirand.com/blog/jqgrid/jqgrid.html>
 * Created on 2013-04-10
 * 
 * This extension have to be installed into:
 * <Yii-Application>/proected/extensions/jqgrid
 * 
 * Usage:
 * <?php 
 *   $this->widget('ext.jqgrid.JqGrid', array(
 *       'id'=>'demo',
 *       'language'=>'cn',
 *       'options'=>array(
 *           'treeGrid'=>'true',
 *           'treeGridModel'=>'adjacency',
 *           'ExpandColumn'=>'name',
 *           'rowNum'=>'-1',
 *           'url'=>'/path/to/grid.json',
 *           'datatype'=>'json',
 *           'treedatatype'=>'json',
 *           'treeIcons'=>array(
 *               'plus'=>'icon-plus',
 *               'minus'=>'icon-minus',
 *               'leaf'=>'icon-cancel',               
 *           ),
 *           'mtype'=>'POST',
 *           'ExpandColClick'=>'true',
 *           'colNames'=>array('id', 'name'),
 *           'colModel'=>array(
 *               array(
 *                   'name'=>'id',
 *                   'index'=>'id',
 *                   'width'=>'100',
 *                   'hidden'=>false,
 *                   'key'=>true,
 *                   ),
 *               array(
 *                   'name'=>'name',
 *                   'index'=>'name',
 *                   'width'=>'300',
 *                   'sortable'=>false,
 *               ),
 *               ),
 *           'height'=>'auto',
 *           'caption'=>'View Groups',
 *       )
 *   ))
 * ?>
 * 
 * See also:<https://github.com/tonytomov/jqGrid>
 */
class jqgrid extends CWidget {

    public $coreCss = true;
    public $coreJs = true;
    public $forceCopyAssets = true;
    public $options = array();
    public $language = '';

    /**
     * @var array the HTML attributes that should be rendered in the HTML tag representing the JUI widget.
     */
    public $htmlOptions = array();

    /**
     * @var string handles the assets folder path.
     */
    protected $_assetsUrl;

    public function init() {
        // Register the jqgrid path alias.
        if (Yii::getPathOfAlias('jqgrid') === false)
            Yii::setPathOfAlias('jqgrid', realpath(dirname(__FILE__) . '/'));

        if ($this->coreCss !== false)
            $this->registerCoreCss();

        if ($this->coreJs !== false)
            $this->registerCoreJs();
    }

    /**
     * Registers the jqgrid CSS.
     */
    public function registerCoreCss() {
        $this->registerAssetCss('ui.jqgrid.css');
    }

    /**
     * Registers a specific css in the asset's css folder
     * @param string $cssFile the css file name to register
     * @param string $media the media that the CSS file should be applied to. If empty, it means all media types.
     */
    public function registerAssetCss($cssFile, $media = '') {
        Yii::app()->getClientScript()->registerCssFile($this->getAssetsUrl() . "/css/{$cssFile}", $media);
    }

    /**
     * Registers the jqgrid JS.
     */
    public function registerCoreJs() {
        $this->registerJS('jquery.jqGrid.js');
    }

    /**
     * Registers the jqgrid JavaScript.
     * @param int $position the position of the JavaScript code.
     * @see CClientScript::registerScriptFile
     */
    public function registerJS($jsFile, $position = CClientScript::POS_HEAD) {
        /* @var CClientScript $cs */
        $cs = Yii::app()->getClientScript();
        $cs->registerCoreScript('jquery');
        $cs->registerCoreScript('jquery.ui');
        $cs->registerScriptFile($this->getAssetsUrl() . "/js/{$jsFile}", $position);
    }

    public function run() {
        $id = $this->getId();
        if (isset($this->htmlOptions['id']))
            $id = $this->htmlOptions['id'];
        else
            $this->htmlOptions['id'] = $id;
        echo '<table id="'.$id.'"></table>';
        echo '<div id="pager"></div>';
        $options = CJavaScript::encode($this->options);

        $cs = Yii::app()->getClientScript();
        $cs->registerScript(__CLASS__ . '#' . $id, "$(function(){jQuery('#{$id}').jqGrid($options);})", CClientScript::POS_HEAD);
        $cs->registerScriptFile($this->getAssetsUrl() . '/js/i18n/grid.locale-' . $this->language . '.js', CClientScript::POS_HEAD);
    }

    /**
     * Returns the URL to the published assets folder.
     * @return string the URL
     */
    public function getAssetsUrl() {
        if (isset($this->_assetsUrl))
            return $this->_assetsUrl;
        else {
            $assetsPath = Yii::getPathOfAlias('jqgrid.assets');
            $assetsUrl = Yii::app()->assetManager->publish($assetsPath, false, -1, $this->forceCopyAssets);
            return $this->_assetsUrl = $assetsUrl;
        }
    }

}