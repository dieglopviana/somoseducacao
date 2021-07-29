<?php

namespace App\Controllers;

use App\Models\ResponsavelModel;
use Exception;

class Responsavel extends BaseController
{
	public $responsavel;


	public function __construct()
	{
		$this->responsavel = new ResponsavelModel();
	}
	
	
	public function index()
	{
		return view('responsavel/index', [
			'responsaveis' => $this->responsavel->paginate(5, 'responsaveis'),
			'pager'        => $this->responsavel->pager,
		]);
	}


	public function form($id = ''){
		if ( ! empty($id)){
			$responsavel = $this->responsavel->find($id);

			return view('responsavel/form', ['responsavel' => $responsavel]);
		}
		
		return view('responsavel/form');
	}
	
	
	public function create(){
		if ($this->request->isAJAX()){
			$validation = \Config\Services::validation();
			$validation->setRuleGroup('responsavel');
			
			if ($validation->withRequest($this->request)->run()){
				$nome = $this->request->getVar('nome');
				$id   = $this->request->getVar('id');
				
				$data = ['nome' => $nome];

				if (empty($id)){
					if ($this->responsavel->save($data)){
						return $this->response->setJSON(['status_error' => 0, $data]);
					}
				} else {
					if ($this->responsavel->update($id, $data)){
						return $this->response->setJSON(['status_error' => 0, $data]);
					}
				}
			} else {
				return $this->response->setJSON(['status_error' => 1, 'validator' => $validation->getErrors()]);
			}
		}
	}


	public function delete(){
		if ($this->request->isAJAX()){
			$id = $this->request->getVar('id');
			$responsavel = $this->responsavel->find($id);

			if ($responsavel){
				try {
					if ($this->responsavel->delete($responsavel['id'])){
						return $this->response->setJSON(['status_error' => 0]);
					}

					throw new Exception('Não foi possível excluir o responsável');
				} catch (\Exception $e) {
					return $this->response->setJSON(['status_error' => 1, 'error' => $e->getMessage()]);
				}
			}
			
			return $this->response->setJSON(['status_error' => 1, 'error' => 'Código de responsável inválido']);
		}
	}
}
