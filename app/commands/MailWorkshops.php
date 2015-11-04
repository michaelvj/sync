<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Carbon\Carbon;

class MailWorkshops extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'workshops:mail';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Send an email to all users going to a workshop';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
        $now = Carbon::now();
        $later = Carbon::now()->addMinutes(30);
        // Get all workshops that start within half an hour
        $workshops = Workshop::with('user', 'signups')->where('begins_at', '>=', $now)->where('begins_at', '<=', $later)->get();

        // TODO: async this
        foreach($workshops as $workshop)
        {
            // Mail teacher
            Mail::send('emails.workshop_teacher', compact('workshop'), function($message) use ($workshop)
            {
                $message->to($workshop->teacher_email)->subject('Workshop ' . $workshop->title);
            });

            // Mail all signups
            foreach($workshop->signups as $signup)
            {
                Mail::send('emails.workshop_student', compact('workshop'), function($message) use ($workshop, $signup)
                {
                    $message->to($signup->email)->subject('Workshop ' . $workshop->title);
                });
            }
        }
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return array();
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return array();
	}

}
