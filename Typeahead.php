<?php

namespace khvalov\widgets;


use yii\helpers\Html;
use yii\helpers\Json;
use yii\web\JsExpression;
use yii\web\View;
use yii\widgets\InputWidget;

class Typeahead extends InputWidget
{
    public $clientOptions = [];
    public $events = [];

    public $options = ['class' => 'form-control'];

    /**
     * @var string the hashed variable to store the pluginOptions
     */
    protected $hashVar;
    public function init()
    {
        parent::init();

    }

    /**
     * @inheritdoc
     */
    public function run()
    {
        if ($this->hasModel()) {
            echo Html::activeTextInput($this->model, $this->attribute, $this->options);
        } else {
            echo Html::textInput($this->name, $this->value, $this->options);
        }
        $this->registerClientScript();
    }

    /**
     * Initializes client options
     */
    protected function initClientOptions()
    {
        $options = $this->clientOptions;
        foreach ($options as $key => $value) {
            if (in_array($key, ['name', 'source']) && !$value instanceof JsExpression) {
                $options[$key] = new JsExpression($value);
            }
        }
        $this->clientOptions = $options;
    }

    /**
     * Registers the needed client script and options.
     */
    public function registerClientScript()
    {
        $js = '';
        $view = $this->getView();
        $this->initClientOptions();
        //$this->hashPluginOptions($view);
        $id = $this->options['id'];
        $encOptions = empty($this->clientOptions) ? '{}' : Json::encode($this->clientOptions);

        $events = '';
        foreach ($this->events as $event => $handler) {
            $events .= ".bind('{$event}', {$handler})";
        }

        $js .= '$("#' . $id . '")' . ".typeahead(null, {$encOptions}){$events};\n";
        TypeaheadAsset::register($view);
        $view->registerJs($js);
    }
}
