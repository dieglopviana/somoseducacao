<?php

namespace Config;

use CodeIgniter\Validation\CreditCardRules;
use CodeIgniter\Validation\FileRules;
use CodeIgniter\Validation\FormatRules;
use CodeIgniter\Validation\Rules;

class Validation
{
	//--------------------------------------------------------------------
	// Setup
	//--------------------------------------------------------------------

	/**
	 * Stores the classes that contain the
	 * rules that are available.
	 *
	 * @var string[]
	 */
	public $ruleSets = [
		Rules::class,
		FormatRules::class,
		FileRules::class,
		CreditCardRules::class,
	];

	/**
	 * Specifies the views that are used to display the
	 * errors.
	 *
	 * @var array<string, string>
	 */
	public $templates = [
		'list'   => 'CodeIgniter\Validation\Views\list',
		'single' => 'CodeIgniter\Validation\Views\single',
	];
	

	//--------------------------------------------------------------------
	// Rules
	//--------------------------------------------------------------------

	public $responsavel = [
		'nome' => 'required|min_length[5]'
	];

	public $responsavel_errors = [
        'nome' => [
            'required' => '* Preencha o campo nome',
			'min_length' => '* É esperado no mínimo 5 caracteres'
        ]
    ];

	public $categoria = [
		'descricao' => 'required|min_length[5]'
	];

	public $categoria_errors = [
        'descricao' => [
            'required' => '* Preencha o nome da categoria',
			'min_length' => '* É esperado no mínimo 5 caracteres'
        ]
    ];


	public $tarefa = [
		'responsavel_id' => 'required',
		'categoria_id' => 'required',
		'titulo' => 'required|min_length[5]',
		'descricao' => 'required|min_length[5]',
		'data_finalizacao' => 'required|valid_date[Y-m-d]'
	];

	public $tarefa_errors = [
        'responsavel_id' => [
            'required' => '* Selecione o responsável'
		],

		'categoria_id' => [
			'required' => '* Selecione a categoria'
		],

		'titulo' => [
			'required' => '* Preencha o título da tarefa',
			'min_lenght' => '* É esperado no mínimo 5 caracteres'
		],

		'descricao' => [
			'required' => '* Digite a descrição da tarefa',
			'min_lenght' => '* É esperado no mínimo 5 caracteres'
		],

		'data_finalizacao' => [
			'required' => '* Informe a data de finalização da tarefa',
			'valid_date' => '* Data informada é inválida'
		]
    ];


}
