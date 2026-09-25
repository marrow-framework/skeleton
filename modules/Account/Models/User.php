<?php

declare(strict_types=1);

namespace Modules\Account\Models;

use Ironflow\Auth\Concerns\Auditable;
use Ironflow\Auth\Concerns\HasPermission;
use Ironflow\Auth\Concerns\HasRole;
use Ironflow\Auth\Concerns\HasTwoFactor;
use Ironflow\Database\Model;

/**
 * The default authenticatable model — matches config/auth.php's
 * guards.*.table ('users') and the columns created by this module's own
 * migrations (modules/Account/Database/Migrations/).
 *
 * Lives in the Account module rather than app/Models: nothing about
 * authentication is truly cross-cutting framework glue — it's a domain
 * concern like any other, so it gets its own module like Home does.
 * Other modules can still reference this class directly by its namespace
 * (`use Modules\Account\Models\User;`) without importing the Account
 * module — the container's module-export isolation (see docs/container.md)
 * only applies to container-resolved bindings, and a Model is never
 * resolved through the container (it's Active Record: `new`/`::find()`/
 * `::create()`), so there's nothing to export here.
 *
 * HasRole and HasPermission both declare a private getPrimaryKeyValue()
 * helper; using both traits on the same class is a genuine PHP trait
 * collision (private visibility doesn't exempt it), so it must be resolved
 * explicitly below even though the two implementations are identical.
 */
class User extends Model
{
    use HasRole, HasPermission, HasTwoFactor, Auditable {
        HasRole::getPrimaryKeyValue insteadof HasPermission;
    }

    protected string $table = 'users';

    protected array $fillable = ['name', 'email', 'password'];

    protected array $hidden = [
        'password',
        'two_factor_secret',
        'two_factor_recovery_codes',
    ];

    protected array $casts = [
        'email_verified_at' => 'datetime',
        'two_factor_enabled_at' => 'datetime',
    ];

    /**
     * Extend Auditable's default exclusion list (password/password_confirmation/
     * remember_token) with the 2FA secret columns.
     *
     * This can't be done by redeclaring $auditExclude as a class property with
     * a different default value: PHP treats a class and a trait it uses
     * declaring the same property with different defaults as a fatal
     * "incompatible" composition error, not an override. Assigning it at
     * runtime instead is legal, since the property is only ever declared once
     * (by the trait).
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->auditExclude = array_merge($this->auditExclude, ['two_factor_secret', 'two_factor_recovery_codes']);
    }

    /**
     * Auditable's auditCreated()/auditUpdated()/auditDeleted() are never
     * called automatically by Model — there is no shipped
     * Ironflow\Events\Model\{Created,Updated,Deleted} event class for
     * fireEvent() to dispatch (see docs/database.md#model-events) — so
     * without overriding save()/delete() here, the audit_logs table this
     * module migrates would never actually receive a row.
     */
    public function save(): bool
    {
        $wasNew = !$this->exists();
        $original = $this->getOriginal();

        $saved = parent::save();

        if ($saved) {
            $wasNew ? $this->auditCreated() : $this->auditUpdated($original);
        }

        return $saved;
    }

    public function delete(): bool
    {
        $deleted = parent::delete();

        if ($deleted) {
            $this->auditDeleted();
        }

        return $deleted;
    }
}
