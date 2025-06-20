<?php

return [
    'options' => [
        'id' => 'id',
        'text' => 'title',
        'prevent-enter' => true,
        'auto-select' => false,
        'allow-new' => false,
        'load-once-on-focus' => true,
        'inline' => false,
        'inline-styles' => '',
        'overlay-styles' => '',
        'result-focus-styles' => '',
    ],

    'components' => [
        'outer-container' => 'cms-multi::autocomplete.outer-container',
        'clear-button' => 'cms-multi::autocomplete.clear-button',
        'dropdown' => 'cms-multi::autocomplete.dropdown',
        'input' => 'cms-multi::autocomplete.input',
        'result-row' => 'cms-multi::autocomplete.result-row',
        'loading' => 'loading',
        'results-container' => 'results-container',
        'prompt' => 'cms-multi::autocomplete.prompt',
        'add-new-row' => 'add-new-row',
        'no-results' => 'cms-multi::autocomplete.no-results',
    ],

    // Set this to true if you would prefer it to use the global namespace <x-autocomplete />
    'use_global_namespace' => true,

    // Disable scripts included with package instead
    'inline-scripts' => false,
];
