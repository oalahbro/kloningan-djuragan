<?php

$finder = PhpCsFixer\Finder::create()
    ->exclude('vendor')
    ->exclude('writable')
    // ->exclude('tests')
    // ->notPath('src/Symfony/Component/Translation/Tests/fixtures/resources.php')
    ->in(__DIR__);

$config = new PhpCsFixer\Config();
return $config->setRules([
    '@PSR12' => true,
    // 'strict_param' => true,
    'array_syntax' => ['syntax' => 'short'],
    'no_trailing_comma_in_singleline_array' => true,
    'constant_case' => ['case' => 'lower'],
    'array_indentation' => true,
    'single_quote' => true,
    'binary_operator_spaces' => [
        'operators' => [
            '=>' => 'align',
            '||' => 'align',
            '=' => 'align',
            'xor' => null
        ]
    ],
    'ordered_imports' => ['sort_algorithm' => 'alpha', 'imports_order' => ['const', 'class', 'function']],
    'semicolon_after_instruction' => false,
    'new_with_braces' => true,
    'linebreak_after_opening_tag' => true,
    'blank_line_before_statement' => ['statements' => ['break', 'continue', 'declare', 'return', 'throw', 'try', 'if']],
    'braces' => [
        'allow_single_line_anonymous_class_with_empty_body' => true
    ],
    'lowercase_keywords' => true,
    'whitespace_after_comma_in_array' => true,
    // 'ordered_class_elements' => ['order' => ['method_public'], 'sort_algorithm' => 'alpha'],
])
    ->setFinder($finder);
