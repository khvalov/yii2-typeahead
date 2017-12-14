<?php

namespace khvalov\widgets;


use yii\web\AssetBundle;

class TypeaheadAsset extends AssetBundle
{
    /**
     * @inheritdoc
     */
    public $sourcePath = './js';

    /**
     * @inheritdoc
     */
    public $js = [
        'bootstrap-typeahead-ajax.js',
    ];
}
