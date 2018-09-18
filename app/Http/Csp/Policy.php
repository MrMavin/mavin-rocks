<?php

namespace App\Http\Csp;

use Spatie\Csp\Directive;
use Spatie\Csp\Policies\Basic;

class Policy extends Basic
{
    /**
     * @throws \Spatie\Csp\Exceptions\InvalidDirective
     */
    public function configure()
    {
        parent::configure();

        $this->addDirective(Directive::SCRIPT, 'https://cdnjs.cloudflare.com');
        $this->addDirective(Directive::STYLE, 'https://cdnjs.cloudflare.com');
        $this->addDirective(Directive::STYLE, 'https://use.fontawesome.com');
        $this->addDirective(Directive::STYLE, 'https://fonts.googleapis.com');
        $this->addDirective(Directive::FONT, 'https://use.fontawesome.com');
        $this->addDirective(Directive::FONT, 'https://fonts.gstatic.com');

        $this->reportOnly();
    }
}