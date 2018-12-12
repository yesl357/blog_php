<?php

namespace App\Admin\Extensions;

use Encore\Admin\Form\Field;

class Simplemde extends Field
{
    protected $view = 'admin::form.editor';

    protected static $css = [
        '/packages/admin/simplemde/dist/simplemde.min.css',
//        '/packages/admin/highlight/highlight.js',
    ];

    protected static $js = [
        '/packages/admin/simplemde/dist/simplemde.min.js',
        '/packages/admin/highlight/highlight.js',
    ];

    public function render()
    {
        $this->script = <<<EOT

 var simplemde = new SimpleMDE({
               autofocus: true,
                
                spellChecker: false,
            });

EOT;
        return parent::render();

    }
}