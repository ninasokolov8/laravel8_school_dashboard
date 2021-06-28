<?php
	
	namespace App\Http\Controllers\Dashboard;
	
	use App\Http\Controllers\Controller;
	use App\Models\Lesson;
	use App\Services\CalendarService;
	
	class CalendarController extends Controller {
		public function index(CalendarService $calendarService) {
			$weekDays = Lesson::WEEK_DAYS;
			$calendarData = $calendarService->generateCalendarData($weekDays);
			return view('dashboard.calendar', compact('weekDays', 'calendarData'));
		}
	}
