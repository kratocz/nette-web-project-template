<?php

namespace App\Presenters;

use Nette;

abstract class BasePresenter extends Nette\Application\UI\Presenter
{
	public function requireUser()
	{
		if (!$this->user->loggedIn) {
			$this->redirect('Sign:in');
			$this->terminate();
		}
	}

	public function requireAdmin()
	{
		$this->requireUser();

		$role = $this->user->identity->role;
		if ($role != 'admin') {
			throw new \Nette\Security\AuthenticationException('Access denied for role: ' . $role);
		}
	}


	/**
	 * Formats view template file names.
	 * @return array
	 */
	public function formatTemplateFiles(): array
	{
		$files = parent::formatTemplateFiles();
		$dir = dirname($this->getReflection()->getFileName());
		$files[] = "$dir/$this->view.latte";
		return $files;
	}

	/**
	 * Formats layout template file names.
	 * @return array
	 */
	public function formatLayoutTemplateFiles(): array
	{
		$files = parent::formatLayoutTemplateFiles();
		$dir = dirname($this->getReflection()->getFileName());
		$files[] = dirname($dir) . '/@layout.latte';
		return $files;
	}

	/**
	 * Sends JSON data to the output.
	 * @param mixed
	 * @return void
	 * @throws Nette\Application\AbortException
	 */
	public function sendPrettyJson($data)
	{
		$this->sendResponse(new \App\Helpers\PrettyJsonResponse($data));
	}
}
