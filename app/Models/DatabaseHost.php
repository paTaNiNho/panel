<?php

namespace Pterodactyl\Models;

/**
 * @property int $id
 * @property string $name
 * @property string $host
 * @property int $port
 * @property string $username
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 *
 * @property \Pterodactyl\Models\Database[]|\Illuminate\Database\Eloquent\Collection $databases
 * @property \Pterodactyl\Models\Node[]|\Illuminate\Database\Eloquent\Collection $nodes
 */
class DatabaseHost extends Model
{
    /**
     * The resource name for this model when it is transformed into an
     * API representation using fractal.
     */
    const RESOURCE_NAME = 'database_host';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'database_hosts';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password'];

    /**
     * Fields that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'host', 'port', 'username', 'password', 'max_databases',
    ];

    /**
     * Cast values to correct type.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'max_databases' => 'integer',
    ];

    /**
     * Validation rules to assign to this model.
     *
     * @var array
     */
    public static $validationRules = [
        'name' => 'required|string|max:191',
        'host' => 'required|string',
        'port' => 'required|numeric|between:1,65535',
        'username' => 'required|string|max:32',
        'password' => 'nullable|string',
    ];

    /**
     * Gets the databases associated with a database host.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function databases()
    {
        return $this->hasMany(Database::class);
    }

    /**
     * Gets the nodes associated with a database host.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function nodes()
    {
        return $this->belongsToMany(Node::class);
    }
}
