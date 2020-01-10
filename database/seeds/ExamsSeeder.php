<?php


class ExamsSeeder extends \Illuminate\Database\Seeder
{

    public function run()
    {
        \DB::table((new \App\Entity\Exam())->getTable())->delete();
        $handle = fopen(__DIR__. '/csv/' . '/AndroidDevsImpact.csv', "r");

        for (;($row = fgetcsv($handle, 0, ";")) !== false;) {
            \App\Entity\Exam::create([
                'category' => $row[0],
                'url' => $row[1],
                'title' => $row[2],
            ]);
        }
        fclose($handle);
    }

}
