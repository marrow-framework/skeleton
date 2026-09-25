<?php

declare(strict_types=1);

namespace Modules\Account;

use Ironflow\Module\Attributes\Module;
use Ironflow\Module\BaseModule;

/**
 * Owns the User model, the RBAC/2FA/audit-log schema, and the roles seeder.
 * Ships with no routes/controllers/views of its own on purpose — add a
 * login/registration flow here (or a dedicated module importing this one)
 * once the app needs one; until then this module is pure domain model +
 * schema, which is a perfectly valid, routeless module.
 */
#[Module(name: 'account')]
class AccountModule extends BaseModule
{
}
