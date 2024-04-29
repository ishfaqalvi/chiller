<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [];
        for($i = 1; $i < 13; $i++) {
            $data[] = [
                'title'=>'The quick, brown fox jumps over a lazy dog.',
                'thumbnail'=>'images/blog/'.$i.'.jpg',
                'description' => 'The quick, brown fox jumps over a lazy dog. DJs flock by when MTV ax quiz prog. Junk MTV quiz graced by fox whelps. Bawds jog, flick quartz, vex nymphs. Waltz, bad nymph, for quick jigs vex! Fox nymphs grab quick-jived waltz. Brick quiz',
                'detail' => '
                In today’s energy-conscious world, optimizing chiller operations has become crucial for businesses seeking to enhance efficiency and reduce operational costs. Chiller systems play a vital role in commercial environments such as malls, shopping centers, and airports, where maintaining comfortable indoor temperatures is essential. This blog post explores the importance of chiller optimization and how ChillerWise, a cutting-edge software solution, can help businesses achieve significant energy savings and streamline their operations.

                MAXIMIZING ENERGY EFFICIENCY:
                Chiller optimization is all about finding the perfect balance between cooling capacity and energy consumption. By using ChillerWise, businesses can analyze their chiller systems’ performance and identify areas for improvement. The software’s advanced algorithms consider various factors like load conditions, chiller performance, and energy consumption to calculate the most efficient chiller combination at each load step. This optimization process allows businesses to minimize energy wastage and reduce their carbon footprint, resulting in substantial cost savings and environmental benefits.

                STREAMLINING OPERATIONS:
                Managing a complex chiller system can be challenging without the right tools. ChillerWise simplifies the process by providing a user-friendly interface for data entry and analysis. By inputting chiller data and specific needs into the software, users gain valuable insights and recommendations for optimal chiller operation. This streamlined approach eliminates guesswork and empowers facility managers and chiller operators to make informed decisions, resulting in improved performance, reduced downtime, and enhanced occupant comfort.

                COST SAVINGS AND RETURN ON INVESTMENT:
                Chiller optimization directly impacts a company’s bottom line. By using ChillerWise to fine-tune chiller operations, businesses can achieve significant energy savings, leading to reduced utility bills. The return on investment can be substantial, particularly in large-scale commercial environments where chiller systems operate continuously. The cost savings realized through optimized chiller operations can be redirected to other areas of the business, driving growth and sustainability.
                '
            ];
        }
        DB::table('blogs')->insert($data);
    }
}
