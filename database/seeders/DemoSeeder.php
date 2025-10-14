<?php

namespace Database\Seeders;
use Illuminate\Support\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Board;
use App\Models\Lane;
use App\Models\User;
use App\Models\task;

class DemoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1) a board + 3 lanes
        $board = Board::firstOrCreate(["name" => "TASKBOARD"]);
        $todo = Lane::firstOrCreate(
            ["board_id" => $board->id, "name" => "To Do"],
            ["position" => 1],
        );
        $doing = Lane::firstOrCreate(
            ["board_id" => $board->id, "name" => "In Progress"],
            ["position" => 2],
        );
        $done = Lane::firstOrCreate(
            ["board_id" => $board->id, "name" => "Done"],
            ["position" => 3],
        );

        task::create([
            "lane_id" => $done->id,
            "title" => "Design Login Page",
            "description" =>
                "Build the reusable modal for adding and editing tasks. Load the form dynamically using AJAX and Flowbite’s modal system.",
            "position" => 1,
            "priority" => "high",
            "attachment_path" =>
                "attachments/DyYC8JQozkitPgXcbGWxAOsdfshYKDt06YCe9mSB.png",
            "attachment_name" => "login.png",
            "start_date" => Carbon::today()->toDateString(),
            "end_date" => Carbon::today()
                ->addDays(3)
                ->toDateString(),
            "assignee_ids" => json_encode([1]), // <— JSON array
        ]);

        task::create([
            "lane_id" => $doing->id,
            "title" => "Implement Task Modal",
            "description" =>
                'Build the reusable modal for adding and editing tasks. Load the form dynamically using AJAX and Flowbite’s modal system.',
            "position" => 2,
            "priority" => "medium",
            "attachment_path" => null,
            "attachment_name" => null,
            "start_date" => Carbon::today()
                ->subDays(1)
                ->toDateString(),
            "end_date" => Carbon::today()
                ->addDays(5)
                ->toDateString(),
            "assignee_ids" => json_encode([1]),
        ]);

        task::create([
            "lane_id" => $doing->id,
            "title" => "Database Seeding Setup",
            "description" =>
                'Create seeders for users, boards, lanes, and tasks with example data for quick demo setup.',
            "position" => 2,
            "priority" => "medium",
            "attachment_path" => null,
            "attachment_name" => null,
            "start_date" => Carbon::today()
                ->subDays(1)
                ->toDateString(),
            "end_date" => Carbon::today()
                ->addDays(2)
                ->toDateString(),
            "assignee_ids" => json_encode([1]),
        ]);

        task::create([
            "lane_id" => $todo->id,
            "title" => "Deploy to Production",
            "description" =>
                'Configure environment variables, cache routes and config, and deploy TaskBoard to the live server with Laravel Forge.',
            "position" => 2,
            "priority" => "high",
            "attachment_path" => null,
            "attachment_name" => null,
            "start_date" => Carbon::today()
                ->subDays(1)
                ->toDateString(),
            "end_date" => Carbon::today()
                ->addDays(10)
                ->toDateString(),
            "assignee_ids" => json_encode([1]),
        ]); 

        user::create([
            "name" => "Task Board ",
            "email" => "task@board.com",
            "password" => '123456',
        ]);              
    }
}
