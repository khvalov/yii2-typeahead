<?php

namespace khvalov\widgets;


use yii\web\AssetBundle;

class TypeaheadAsset extends AssetBundle
{
    /**
     * @inheritdoc
     */
    public $sourcePath = '@vendor/two20';

    /**
     * @inheritdoc
     */
    public $js = [
        'bootstrap-typeahead-ajax.js',
    ];
}
