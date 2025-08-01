<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $user_id
 * @property string $action
 * @property string $subject_type
 * @property int|null $subject_id
 * @property string $description_ar
 * @property string $description_en
 * @property string|null $old_values
 * @property string|null $new_values
 * @property string|null $ip_address
 * @property string|null $user_agent
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\AuditLogFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AuditLog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AuditLog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AuditLog query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AuditLog whereAction($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AuditLog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AuditLog whereDescriptionAr($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AuditLog whereDescriptionEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AuditLog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AuditLog whereIpAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AuditLog whereNewValues($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AuditLog whereOldValues($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AuditLog whereSubjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AuditLog whereSubjectType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AuditLog whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AuditLog whereUserAgent($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AuditLog whereUserId($value)
 * @property-read mixed $action_label
 * @property-read \App\Models\User $user
 * @mixin \Eloquent
 */
class AuditLog extends Model {
    /** @use HasFactory<\Database\Factories\AuditLogFactory> */
    use HasFactory;
    protected $fillable = [
        'user_id',
        'action',
        'subject_type',
        'subject_id',
        'description_ar',
        'description_en',
        'old_values',
        'new_values',
        'ip_address',
        'user_agent',
    ];
    protected $casts = [
        'old_values' => 'array',
        'new_values' => 'array',
    ];

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }
    public function getActionLabelAttribute() {
        $labels = [
            'invoice_created' => ['ar' => 'تم إنشاء فاتورة', 'en' => 'Invoice Created'],
            'invoice_status_changed' => ['ar' => 'تغيرت حالة الفاتورة', 'en' => 'Invoice Status Changed'],
            'product_updated' => ['ar' => 'تم تعديل منتج', 'en' => 'Product Updated'],
        ];

        return $labels[$this->action][app()->isLocale('ar') ? 'ar' : 'en'] ?? $this->action;
    }
}
