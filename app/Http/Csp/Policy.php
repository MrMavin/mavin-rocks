<?php

namespace App\Http\Csp;

use Spatie\Csp\Directive;
use Spatie\Csp\Policies\Basic;
use Spatie\Csp\Value;

class Policy extends Basic
{
	public function configure()
	{
		parent::configure();

		$this
			->addDirective(Directive::SCRIPT, 'https://cdnjs.cloudflare.com')
			->addDirective(Directive::STYLE, 'https://cdnjs.cloudflare.com')
			->addDirective(Directive::STYLE, 'https://use.fontawesome.com')
			->addDirective(Directive::STYLE, 'https://fonts.googleapis.com')
			->addDirective(Directive::FONT, 'https://use.fontawesome.com')
			->addDirective(Directive::FONT, 'https://fonts.gstatic.com');

		$this->reportOnly();
	}
}