<?php

use Illuminate\Database\Seeder;

/**
 * Class SeedDBLangTranslations
 */
class SeedDBLangTranslations extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Laralang::trans('Hello world!');
        Laralang::trans('Hello world!')->setTo('es');
        Laralang::trans('my name is')->setTo('es');
        Laralang::trans('how are you')->setTo('es');
        Laralang::trans('welcome')->setTo('es');
    }
}
