<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
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
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AuditLog onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AuditLog withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AuditLog withoutTrashed()
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AuditLog whereDeletedAt($value)
 * @mixin \Eloquent
 */
	class AuditLog extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $name_ar
 * @property string $name_en
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\BrandFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Brand newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Brand newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Brand query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Brand whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Brand whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Brand whereNameAr($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Brand whereNameEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Brand whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\CarModel> $carModels
 * @property-read int|null $car_models_count
 * @property-read string $name
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Brand onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Brand withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Brand withoutTrashed()
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Brand whereDeletedAt($value)
 * @mixin \Eloquent
 */
	class Brand extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $brand_id
 * @property string|null $name_ar
 * @property string|null $name_en
 * @property string $year_range
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\CarModelFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CarModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CarModel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CarModel query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CarModel whereBrandId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CarModel whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CarModel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CarModel whereNameAr($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CarModel whereNameEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CarModel whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CarModel whereYearRange($value)
 * @property-read \App\Models\Brand $brand
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClientVehicle> $clientVehicles
 * @property-read int|null $client_vehicles_count
 * @property-read string $name
 * @property-read string $year_range_formatted
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Product> $products
 * @property-read int|null $products_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CarModel yearFrom($year)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CarModel yearTo($year)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CarModel onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CarModel withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CarModel withoutTrashed()
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CarModel whereDeletedAt($value)
 * @mixin \Eloquent
 */
	class CarModel extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int|null $parent_id
 * @property string|null $name_ar
 * @property string|null $name_en
 * @property string|null $description_ar
 * @property string|null $description_en
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Category> $children
 * @property-read int|null $children_count
 * @property-read bool $is_leaf
 * @property-read Category|null $parents
 * @method static \Database\Factories\CategoryFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category whereDescriptionAr($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category whereDescriptionEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category whereNameAr($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category whereNameEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category whereUpdatedAt($value)
 * @property-read Category|null $parent
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Product> $products
 * @property-read int|null $products_count
 * @property-read mixed $name
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category withoutTrashed()
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category whereDeletedAt($value)
 * @mixin \Eloquent
 */
	class Category extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string|null $name_ar
 * @property string|null $name_en
 * @property string|null $mobile
 * @property string|null $email
 * @property string|null $address_ar
 * @property string|null $address_en
 * @property string|null $notes
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\ClientFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client whereAddressAr($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client whereAddressEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client whereMobile($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client whereNameAr($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client whereNameEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClientVehicle> $vehicles
 * @property-read int|null $vehicles_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\CreditNote> $creditNotes
 * @property-read int|null $credit_notes_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Debt> $debts
 * @property-read int|null $debts_count
 * @property-read mixed $address
 * @property-read mixed $name
 * @property-read float $open_debts_amount
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Invoice> $invoices
 * @property-read int|null $invoices_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client withoutTrashed()
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client whereDeletedAt($value)
 * @mixin \Eloquent
 */
	class Client extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $client_id
 * @property int $car_model_id
 * @property string|null $plate_number
 * @property string|null $chasis_number
 * @property string|null $color
 * @property int|null $manufacturing_year
 * @property string|null $notes
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\ClientVehicleFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ClientVehicle newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ClientVehicle newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ClientVehicle query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ClientVehicle whereCarModelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ClientVehicle whereChasisNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ClientVehicle whereClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ClientVehicle whereColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ClientVehicle whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ClientVehicle whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ClientVehicle whereManufacturingYear($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ClientVehicle whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ClientVehicle wherePlateNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ClientVehicle whereUpdatedAt($value)
 * @property-read \App\Models\CarModel $carModel
 * @property-read \App\Models\Client $client
 * @property-read string $display_name
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Invoice> $invoices
 * @property-read int|null $invoices_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ClientVehicle onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ClientVehicle withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ClientVehicle withoutTrashed()
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ClientVehicle whereDeletedAt($value)
 * @mixin \Eloquent
 */
	class ClientVehicle extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $invoice_id
 * @property int|null $client_id
 * @property string $credit_note_number
 * @property string $issue_date
 * @property string $reason_ar
 * @property string $reason_en
 * @property string $total_refund_amount
 * @property string $payment_refund_method
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\CreditNoteFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CreditNote newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CreditNote newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CreditNote query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CreditNote whereClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CreditNote whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CreditNote whereCreditNoteNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CreditNote whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CreditNote whereInvoiceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CreditNote whereIssueDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CreditNote wherePaymentRefundMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CreditNote whereReasonAr($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CreditNote whereReasonEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CreditNote whereTotalRefundAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CreditNote whereUpdatedAt($value)
 * @property-read \App\Models\Client|null $client
 * @property-read mixed $reason
 * @property-read \App\Models\Invoice $invoice
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\CreditNoteItem> $items
 * @property-read int|null $items_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CreditNote onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CreditNote withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CreditNote withoutTrashed()
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CreditNote whereDeletedAt($value)
 * @property int|null $user_id
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CreditNote whereUserId($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\StockMovement> $stockMovements
 * @property-read int|null $stock_movements_count
 * @mixin \Eloquent
 */
	class CreditNote extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $credit_note_id
 * @property int $invoice_item_id
 * @property int $quantity
 * @property string $refunded_amount
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\CreditNoteItemFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CreditNoteItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CreditNoteItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CreditNoteItem query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CreditNoteItem whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CreditNoteItem whereCreditNoteId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CreditNoteItem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CreditNoteItem whereInvoiceItemId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CreditNoteItem whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CreditNoteItem whereRefundedAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CreditNoteItem whereUpdatedAt($value)
 * @property-read \App\Models\CreditNote $creditNote
 * @property-read mixed $product_name
 * @property-read \App\Models\InvoiceItem $invoiceItem
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CreditNoteItem onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CreditNoteItem withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CreditNoteItem withoutTrashed()
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CreditNoteItem whereDeletedAt($value)
 * @property string|null $notes
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CreditNoteItem whereNotes($value)
 * @property int $product_id
 * @property-read \App\Models\Product|null $product
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CreditNoteItem whereProductId($value)
 * @property bool $is_damaged
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CreditNoteItem whereIsDamaged($value)
 * @mixin \Eloquent
 */
	class CreditNoteItem extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $invoice_id
 * @property int $client_id
 * @property numeric $original_amount
 * @property numeric $paid_amount
 * @property numeric $remaining_amount
 * @property \Illuminate\Support\Carbon|null $due_date
 * @property string|null $notes
 * @property bool $is_settled
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Client $client
 * @property-read \App\Models\Invoice $invoice
 * @method static \Database\Factories\DebtFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Debt newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Debt newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Debt query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Debt whereClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Debt whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Debt whereDueDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Debt whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Debt whereInvoiceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Debt whereIsSettled($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Debt whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Debt whereOriginalAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Debt wherePaidAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Debt whereRemainingAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Debt whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Debt onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Debt withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Debt withoutTrashed()
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Debt whereDeletedAt($value)
 * @mixin \Eloquent
 */
	class Debt extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int|null $client_id
 * @property int|null $client_vehicle_id
 * @property int|null $user_id
 * @property string $invoice_number
 * @property string $date
 * @property string $status
 * @property string $calculated_total
 * @property string $actual_paid_amount
 * @property string $payment_method
 * @property string|null $labor_info
 * @property string|null $notes
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\InvoiceFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Invoice newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Invoice newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Invoice query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Invoice whereActualPaidAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Invoice whereCalculatedTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Invoice whereClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Invoice whereClientVehicleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Invoice whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Invoice whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Invoice whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Invoice whereInvoiceNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Invoice whereLaborInfo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Invoice whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Invoice wherePaymentMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Invoice whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Invoice whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Invoice whereUserId($value)
 * @property numeric $actual_total
 * @property-read \App\Models\Client|null $client
 * @property-read \App\Models\ClientVehicle|null $clientVehicle
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\CreditNote> $creditNotes
 * @property-read int|null $credit_notes_count
 * @property-read array $formatted_labor_info
 * @property-read bool $is_debt
 * @property-read bool $is_draft
 * @property-read bool $is_paid
 * @property-read bool $is_partially_paid
 * @property-read float $remaining_amount
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\InvoiceItem> $items
 * @property-read int|null $items_count
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Invoice whereActualTotal($value)
 * @property-read \App\Models\Debt|null $debt
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Invoice onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Invoice withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Invoice withoutTrashed()
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Invoice whereDeletedAt($value)
 * @mixin \Eloquent
 */
	class Invoice extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $invoice_id
 * @property int $product_id
 * @property int $quantity
 * @property string $unit_price
 * @property string $total_price
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\InvoiceItemFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InvoiceItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InvoiceItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InvoiceItem query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InvoiceItem whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InvoiceItem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InvoiceItem whereInvoiceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InvoiceItem whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InvoiceItem whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InvoiceItem whereTotalPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InvoiceItem whereUnitPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InvoiceItem whereUpdatedAt($value)
 * @property-read \App\Models\Invoice $invoice
 * @property-read \App\Models\Product $product
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InvoiceItem onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InvoiceItem withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InvoiceItem withoutTrashed()
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InvoiceItem whereDeletedAt($value)
 * @mixin \Eloquent
 */
	class InvoiceItem extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string|null $name_ar
 * @property string|null $name_en
 * @property string|null $base_fee
 * @property bool $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\LabourFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Labour newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Labour newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Labour query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Labour whereBaseFee($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Labour whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Labour whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Labour whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Labour whereNameAr($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Labour whereNameEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Labour whereUpdatedAt($value)
 * @property-read mixed $name
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Labour onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Labour withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Labour withoutTrashed()
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Labour whereDeletedAt($value)
 * @mixin \Eloquent
 */
	class Labour extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int|null $category_id
 * @property string|null $code
 * @property string|null $name_ar
 * @property string|null $name_en
 * @property string|null $description_en
 * @property string|null $description_ar
 * @property string|null $buy_price
 * @property string|null $sell_price
 * @property int $min_stock_quantity
 * @property string|null $notes
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\ProductFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereBuyPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereDescriptionAr($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereDescriptionEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereMinStockQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereNameAr($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereNameEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereSellPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\CarModel> $applicableModels
 * @property-read int|null $applicable_models_count
 * @property-read \App\Models\Category|null $category
 * @property-read mixed $name
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\InvoiceItem> $invoiceItems
 * @property-read int|null $invoice_items_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Warehouse> $warehouses
 * @property-read int|null $warehouses_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product withoutTrashed()
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereDeletedAt($value)
 * @property string $current_cost_price
 * @property int $quantity_on_hand
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereCurrentCostPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereQuantityOnHand($value)
 * @property-read bool $is_in_stock
 * @property-read \App\Models\StockMovement|null $latestStockMovement
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\StockMovement> $stockMovements
 * @property-read int|null $stock_movements_count
 * @mixin \Eloquent
 */
	class Product extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\PurchaseFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Purchase newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Purchase newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Purchase query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Purchase whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Purchase whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Purchase whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PurchaseItem> $items
 * @property-read int|null $items_count
 * @property-read \App\Models\Supplier|null $supplier
 * @property-read \App\Models\User|null $user
 */
	class Purchase extends \Eloquent {}
}

namespace App\Models{
/**
 * @property-read \App\Models\Product|null $product
 * @property-read \App\Models\Purchase|null $purchase
 * @property-read \App\Models\Warehouse|null $warehouse
 * @method static \Database\Factories\PurchaseItemFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PurchaseItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PurchaseItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PurchaseItem onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PurchaseItem query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PurchaseItem withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PurchaseItem withoutTrashed()
 */
	class PurchaseItem extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $product_id
 * @property int $warehouse_id
 * @property int $user_id
 * @property string $change_type
 * @property int $quantity_change
 * @property int $previous_stock
 * @property int $current_stock
 * @property string $reference_type
 * @property int $reference_id
 * @property string|null $notes
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\StockLogFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StockLog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StockLog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StockLog query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StockLog whereChangeType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StockLog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StockLog whereCurrentStock($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StockLog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StockLog whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StockLog wherePreviousStock($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StockLog whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StockLog whereQuantityChange($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StockLog whereReferenceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StockLog whereReferenceType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StockLog whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StockLog whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StockLog whereWarehouseId($value)
 * @property-read mixed $change_label
 * @property-read \App\Models\Product $product
 * @property-read \App\Models\User $user
 * @property-read \App\Models\Warehouse $warehouse
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StockLog onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StockLog withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StockLog withoutTrashed()
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StockLog whereDeletedAt($value)
 * @mixin \Eloquent
 */
	class StockLog extends \Eloquent {}
}

namespace App\Models{
/**
 * @method static \Database\Factories\StockMovementFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StockMovement newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StockMovement newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StockMovement onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StockMovement query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StockMovement withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StockMovement withoutTrashed()
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StockMovement whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StockMovement whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StockMovement whereUpdatedAt($value)
 * @property int $product_id
 * @property int|null $warehouse_id
 * @property int $quantity
 * @property string $unit_cost
 * @property string $total_cost
 * @property string $type
 * @property string $reference_type
 * @property int $reference_id
 * @property int $recorded_by_user_id
 * @property string|null $notes
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StockMovement whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StockMovement whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StockMovement whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StockMovement whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StockMovement whereRecordedByUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StockMovement whereReferenceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StockMovement whereReferenceType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StockMovement whereTotalCost($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StockMovement whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StockMovement whereUnitCost($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StockMovement whereWarehouseId($value)
 * @property-read \App\Models\Product $product
 * @property-read \App\Models\User $recordedBy
 * @property-read \App\Models\Warehouse|null $warehouse
 * @mixin \Eloquent
 */
	class StockMovement extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string|null $name_ar
 * @property string|null $name_en
 * @property string|null $contact_person_name_ar
 * @property string|null $contact_person_name_en
 * @property string|null $mobile
 * @property string|null $phone
 * @property string|null $email
 * @property string|null $tax_id
 * @property string|null $address_ar
 * @property string|null $address_en
 * @property string|null $payment_terms
 * @property numeric|null $credit_limit
 * @property string|null $notes
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read string $contact_person_name
 * @property-read string $name
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Purchase> $purchases
 * @property-read int|null $purchases_count
 * @method static \Database\Factories\SupplierFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Supplier newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Supplier newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Supplier onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Supplier query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Supplier whereAddressAr($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Supplier whereAddressEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Supplier whereContactPersonNameAr($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Supplier whereContactPersonNameEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Supplier whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Supplier whereCreditLimit($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Supplier whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Supplier whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Supplier whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Supplier whereMobile($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Supplier whereNameAr($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Supplier whereNameEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Supplier whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Supplier wherePaymentTerms($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Supplier wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Supplier whereTaxId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Supplier whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Supplier withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Supplier withoutTrashed()
 * @mixin \Eloquent
 */
	class Supplier extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\SupplierReturnFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupplierReturn newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupplierReturn newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupplierReturn query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupplierReturn whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupplierReturn whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupplierReturn whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class SupplierReturn extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Permission\Models\Permission> $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Permission\Models\Role> $roles
 * @property-read int|null $roles_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User permission($permissions, $without = false)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User role($roles, $guard = null, $without = false)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User withoutPermission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User withoutRole($roles, $guard = null)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User withoutTrashed()
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereDeletedAt($value)
 * @mixin \Eloquent
 */
	class User extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string|null $name_ar
 * @property string|null $name_en
 * @property string|null $location_ar
 * @property string|null $location_en
 * @property string|null $contact_person
 * @property string|null $phone
 * @property bool $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\WarehouseFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Warehouse newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Warehouse newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Warehouse query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Warehouse whereContactPerson($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Warehouse whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Warehouse whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Warehouse whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Warehouse whereLocationAr($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Warehouse whereLocationEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Warehouse whereNameAr($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Warehouse whereNameEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Warehouse wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Warehouse whereUpdatedAt($value)
 * @property-read string $location
 * @property-read string $name
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Product> $products
 * @property-read int|null $products_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Warehouse onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Warehouse withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Warehouse withoutTrashed()
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Warehouse whereDeletedAt($value)
 * @mixin \Eloquent
 */
	class Warehouse extends \Eloquent {}
}

