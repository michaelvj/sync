<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

        // Create groups
        $this->call('GroupTableSeeder');

        // Create users
		$this->call('UserTableSeeder');

        // Create categories
        $this->call('CategoryTableSeeder');

        // Create News
        $this->call('NewsTableSeeder');
	}

}

class UserTableSeeder extends Seeder {
    public  function run()
    {
        User::create(array(
            'firstname' => 'Wouter',
            'lastname' => 'van Hezel',
            'email' => 'whezel@nova.nl',
            'password' => Hash::make('randomPassword0192'),
            'group_id' => 1
        ));
    }
}

class GroupTableSeeder extends Seeder {
    public function run()
    {

        /**
         * true means allowed for that entire group
         * absent means not allowed
         *
         * example
         *  user.update = true
         * is the same as
         *  user.update => array(
         *      own => true,
         *      other => true,
         *      other => array(
         *          name => true
         *      )
         *  )
         */

        // Admins can do anything they please
        Group::create(array(
            'name' => 'Beheerder',
            'permissions' => json_encode(array(
                'user' => true,
                'news' => true,
                'workshop' => true
            ))
        ));

        Group::create(array(
            'name' => 'Leraar',
            'permissions' => json_encode(array(
                'user' => array(
                    'show' => true,
                    'create' => array(
                        'Leerling' => true // Leerling because that's the groups name
                    ),
                    'update' => array(
                        'Leerling' => true
                    )
                ),
                'news' => true,
                'workshop' => true
            ))
        ));

        Group::create(array(
            'name' => 'Leerling',
            'permissions' => json_encode(array(
                'news' => array(
                    'create' => true // they can only update what they own
                ),
                'user' => array(
                    'update' => array(
                        'Leerling' => true // Needed to update self
                    )
                )
            ))
        ));
    }
}
class NewsTableSeeder extends Seeder {
    public function run ()
    {
        $first = <<<EOT
Dit is je <i>eerste bericht</i>.
<br />
<br />
Verwijder het, of <b>pas het aan</b> om te beginnen!
EOT;

        $second = <<<EOT
"Binnen&nbsp;de opleiding AO (Applicatie Ontwikkeling) aan de ICT Academie van het Nova College werken leerlingen aan prachtige applicaties. Zo word er gewerkt aan&nbsp;<b>SYNC</b>, een applicatie waarop studenten het laatste opleiding- en&nbsp;vak gerelateerde&nbsp;nieuws kunnen bekijken en een overzicht van workshops kunnen zien waarop op ze zich via een&nbsp;QR-code op kunnen inschrijven.&nbsp;<br><br>Het innovatieve&nbsp;ontwikkelteam is constant bezig met het bedenken en maken van extra features die er voor zorgen dat&nbsp;<b>SYNC</b>&nbsp;perfect aansluit op de belevingswereld van de&nbsp;doelgroep. Zo laat de applicatie meteen even zien wat voor weer het is, zodat de studenten het oogcontact met&nbsp;hun scherm niet hoeven&nbsp;te verbreken om naar buiten te kijken. Er wordt&nbsp;zelfs aan een "<i>Holliday-counter</i>"&nbsp;gewerkt om onnodig multitasking (SYNC/Agenda/telefoon/horloge) te voorkomen.<br><br>Ben je benieuwd welke features&nbsp;<b>SYNC</b> nog meer zal hebben? Binnen enkele weken kun je het zelf ervaren bij de eerste release!"
EOT;


        News::create(array(
            'title' => 'Eerste post',
            'text' => $first,
            'category_id' => '1',
            'shows_at' => new \Carbon\Carbon(),
            'user_id' => 1,
            'is_featured' => true
        ));

        News::create(array(
            'title' => 'Studenten Nova College maken geweldige software!!!',
            'text' => $second,
            'category_id' => '1',
            'shows_at' => new \Carbon\Carbon(),
            'user_id' => 1,
            'is_featured' => true
        ));
    }
}

class CategoryTableSeeder extends \Illuminate\Database\Seeder{
    public function run()
    {
        Eloquent::unguard();

        Category::create(array(
            'name' => 'Nieuws'
        ));

        Category::create(array(
            'name' => 'Oproepen'
        ));
    }
}