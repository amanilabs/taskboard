<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Task extends Model
{
    use HasFactory;
    protected $casts = [
    'start_date' => 'date',
    'end_date'   => 'date',
    'assigned_ids' => 'array'
];

    protected $fillable = ['lane_id','title','description','priority','assignee_ids','start_date','end_date','attachment_path','attachment_mime','attachment_name'];
    public function lane() { return $this->belongsTo(Lane::class); }
    public function labels() { return $this->belongsToMany(Label::class, 'task_label'); }
public function getTotalDaysAttribute(): ?int
{
    if (!$this->start_date || !$this->end_date) return null;
    return $this->start_date->startOfDay()->diffInDays($this->end_date->startOfDay()) + 1;
}

// Days elapsed from start_date up to today (inclusive)
public function getElapsedDaysAttribute(): ?int
{
    if (!$this->start_date) return null;
    $today = today();
    if ($today->lt($this->start_date)) return 0;
    return $this->start_date->startOfDay()->diffInDays($today) + 1;
}

// Days remaining in the window (inclusive of today if still within the window)
public function getDaysLeftAttribute(): ?int
{
    if (!$this->start_date || !$this->end_date) return null;

    $today = today();

    // If not started yet, all days are remaining
    if ($today->lt($this->start_date)) {
        return $this->total_days;
    }

    // If already past the end, nothing remains
    if ($today->gt($this->end_date)) {
        return 0;
    }

    // We are inside the window -> inclusive remaining days
    return $today->diffInDays($this->end_date->startOfDay()) + 1;
}

// Optional: how many days overdue (0 if not overdue)
public function getOverdueByAttribute(): int
{
    $today = today();
    if ($this->end_date && $today->gt($this->end_date)) {
        return $this->end_date->startOfDay()->diffInDays($today);
    }
    return 0;
}
}

