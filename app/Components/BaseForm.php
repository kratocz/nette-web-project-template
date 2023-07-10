<?php

namespace App\Controls;

/**
 * @author krato
 */
class BaseForm extends \Nette\Application\UI\Form
{

	public function __construct($name = NULL)
	{
		parent::__construct($name);
		// https://doc.nette.org/cs/2.3/forms#toc-obrana-pred-cross-site-request-forgery-csrf
		$this->addProtection('Vypršel časový limit, odešlete formulář znovu');
	}

	public function setAjax()
	{
		$this->getElementPrototype()->class[] = 'ajax';
	}

}
