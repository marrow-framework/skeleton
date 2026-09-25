<?php

declare(strict_types=1);

namespace Modules\Home;

use Ironflow\Module\Attributes\Module;
use Ironflow\Module\BaseModule;

/**
 * The default landing-page module, enabled out of the box in
 * config/modules.php. Safe to remove once your own modules take over the
 * "/" route — or keep it as a working reference for `make:module`'s output.
 */
#[Module(name: 'home')]
class HomeModule extends BaseModule
{
}
