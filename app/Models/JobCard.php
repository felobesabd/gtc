<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobCard extends Model
{
    use HasFactory;

    protected $fillable = [
        'vehicle_id', 'delivered_by', 'received_by', 'ref_number', 'date_in', 'expected_date_out', 'reg_no',
        'km', 'expected_hour_out', 'location', 'site', 'job_card_type', 'repair_type', 'work_required',
        'estimated_time', 'comments', 'driver_id', 'maintenance_manager', 'maintenance_supervisor',
        'operation_coordinator', 'total_cost', 'lubrication_cost', 'subcontractor_cost', 'parts_cost', 'status'
    ];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'vehicle_id');
    }

    public function getVehicleDetails($vehicle_id)
    {
        $vehicle = Vehicle::with(['category', 'group'])
            ->where('id', $vehicle_id)
            ->first();

        if (!$vehicle) {
            return [
                'vehicle_type' => '---',
                'category_name' => '---',
                'group_name' => '---',
            ];
        }

        return [
            'vehicle_type' => $vehicle->vehicle_type,
            'group_name' => $vehicle->group ? $vehicle->group->group_name : '---',
            'category_name' => $vehicle->category ? $vehicle->category->category_name : '---',
        ];
    }

    public function getStaffDetails()
    {
        return json_decode($this->staff_details, true);
    }
}
