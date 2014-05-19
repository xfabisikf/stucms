<?php
 
use App\Models\Subject;
use App\Models\Page;
 
class ContentSeeder extends Seeder {
 
    public function run()
    {
        DB::table('subjects')->delete();
        DB::table('pages')->delete();
 
        Subject::create(array(
            'title'   => 'Prvý predmet',
            'slug'    => 'prvy-predmet',
            'body'    => 'Toto je prvý, skúšobný predmet. Môžete ho replikovať, editovať alebo vymazať.',
            'semester'=> 1,
            'user_id' => 1,
        ));
 
        Page::create(array(
            'title'   => 'Hlavná stránka',
            'slug'    => 'hlavna-stranka',
            'body'    => '<h2>Vitajte</h2><br>na svojej prvej stránke!',
            'user_id' => 1,
            'menu'    => 1,
            'solid'   => 1,
            'edit'    => 1,
        ));
    }
 
}