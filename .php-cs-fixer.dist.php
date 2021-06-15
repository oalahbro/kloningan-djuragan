<?php

$finder = PhpCsFixer\Finder::create()
    ->exclude('vendor')
    ->exclude('writable')
    // ->exclude('tests')
    // ->notPath('src/Symfony/Component/Translation/Tests/fixtures/resources.php')
    ->in(__DIR__);

$config = new PhpCsFixer\Config();
return $config->setRules([
    '@PSR12'                  => true,
    'align_multiline_comment' => ['comment_type' => 'phpdocs_only'],
    'array_indentation'       => true,
    'array_push'              => true, // risky
    'array_syntax'            => ['syntax' => 'short'],
    'backtick_to_shell_exec'  => true,
    'binary_operator_spaces'  => [
        'default'   => 'single_space',
        'operators' => [
            '='  => 'align_single_space_minimal',
            '=>' => 'align_single_space_minimal',
            '||' => 'align_single_space_minimal',
            '.=' => 'align_single_space_minimal',
        ],
    ],
    'blank_line_after_namespace'   => true,
    'blank_line_after_opening_tag' => true,
    'blank_line_before_statement'  => [
        'statements' => [
            'case',
            'continue',
            'declare',
            'default',
            'do',
            'exit',
            'for',
            'foreach',
            'goto',
            'return',
            'switch',
            'throw',
            'try',
            'while',
            'yield',
            'yield_from',
        ],
    ],
    'braces' => [
        'allow_single_line_anonymous_class_with_empty_body' => true,
        'allow_single_line_closure'                         => true,
        'position_after_anonymous_constructs'               => 'same',
        'position_after_control_structures'                 => 'same',
        'position_after_functions_and_oop_constructs'       => 'next',
    ],
    'cast_spaces'                           => ['space' => 'single'],
    'function_to_constant'                  => true,
    'indentation_type'                      => true,
    'line_ending'                           => true,
    'list_syntax'                           => ['syntax' => 'short'],
    'lowercase_keywords'                    => true,
    'native_function_invocation'            => [
        'include' => ['@compiler_optimized'],
        'scope'   => 'namespaced',
        'strict'  => true,
    ],
    'normalize_index_brace'                 => true,
    'no_whitespace_before_comma_in_array'   => ['after_heredoc' => true],
    'no_trailing_comma_in_singleline_array' => true,
    'no_extra_blank_lines'                  => true,
    'no_alias_functions'                    => ['sets' => ['@all']],
    'ordered_imports'                       => ['sort_algorithm' => 'alpha'],
    'phpdoc_align'                          => true,
    'phpdoc_scalar'                         => [
        'types' => [
            'boolean',
            'callback',
            'double',
            'integer',
            'real',
            'str',
        ],
    ],
    'phpdoc_separation'           => true,
    'single_quote'                => true,
    'static_lambda'               => true,
    'ternary_to_null_coalescing'  => true,
    'trailing_comma_in_multiline' => [
        'after_heredoc' => true,
        'elements'      => ['arrays'],
    ],
    'trim_array_spaces'               => true,
    'whitespace_after_comma_in_array' => true,
    'yoda_style'                      => [
        'equal'                => false,
        'identical'            => null,
        'less_and_greater'     => false,
        'always_move_variable' => false,
    ],
])
    ->setFinder($finder);
