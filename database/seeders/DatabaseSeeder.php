<?php

namespace Database\Seeders;

use Throwable;
use App\Models\Page;
use App\Models\User;
use App\Models\About;
use App\Models\Office;
use App\Models\Policy;
use App\Models\Contact;
use App\Models\Section;
use App\Models\Trainer;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Service;
use App\Models\Training;
use App\Models\TrainingMedia;
use Illuminate\Support\Str;
use App\Models\TrainingTest;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $pages = [
            [
                'name' => 'მთავარი',
                'slug' => '/',
                'display_in_menu' => 1,
                'image' => 'noimage.jpg',
            ],

            [
                'name' => 'ტრენინგები',
                'slug' => '/trainings',
                'display_in_menu' => 1,
                'image' => '2022-01-24_17-50-55.jpeg',
            ],

            [
                'name' => 'სერვისები',
                'slug' => '/services',
                'display_in_menu' => 1,
                'image' => '2022-01-24_17-50-55.jpeg',
            ],

            [
                'name' => 'ბლოგი',
                'slug' => '/blogs',
                'display_in_menu' => 1,
                'image' => '2022-01-24_17-51-23.jpeg',

            ],

            [
                'name' => 'ჩვენ შესახებ',
                'slug' => '/about-us',
                'display_in_menu' => 1,
                'image' => '2022-01-24_17-52-08.jpeg',


            ],

            [
                'name' => 'კონტაქტი',
                'slug' => '/contact',
                'display_in_menu' => 1,
                'image' => '2022-01-24_17-52-27.jpeg',


            ],

            [
                'name' => 'ავტორიზაცია',
                'slug' => '/login',
                'display_in_menu' => 2,
                'image' => '2022-01-24_17-52-51.jpeg',
            ],

            [
                'name' => 'დეშბორდი',
                'slug' => '/dashboard',
                'display_in_menu' => 2,
                'image' => '2022-01-24_18-02-01.jpeg',

            ],

            [
                'name' => 'წესები და პირობები',
                'slug' => '/terms-of-service',
                'display_in_menu' => 2,
                'image' => '2022-01-24_17-54-19.jpeg',
            ],

            [
                'name' => 'კონფიდენციალობის პოლიტიკა',
                'slug' => '/privacy-policy',
                'display_in_menu' => 2,
                'image' => '2022-01-24_17-54-57.jpeg',
            ],
        ];
        //create pages
        foreach($pages as $p){
            $page = new Page();
            $page->name = $p['name'];
            $page->slug = $p['slug'];
            $page->display_in_menu = $p['display_in_menu'];
            $page->image = $p['image'];


            $page->save();
        }

        //create services data`
        $services_data = [
            [
                'name' => 'დიაგნოსტირება',
                'text' => '<p>სისტემის შიდა ინსპექცია</p>
                <ul>
                <li>არსებული დოკუმენტაციის ანალიზი</li>
                <li>არსებული პროცედურების ანალიზი</li>
                <li>დასაქმებულებთან გასაუბრება და პროცესებზე დაკვირვება</li>
                <li>კანონმდებლობასთან და საერთაშორისო პრაქტიკასთან განსვლის ანალიზი</li>
                <li>სამუშაო არეალის განსაზღვრა</li>
                </ul>
                <p>კომპანიაში შრომის უსაფრთხოების კუთხით არსებული მდგომარეობის&nbsp; შესწავლის, ხარვეზების გამოვლენის და შემდგომი ნაბიჯების სწორად&nbsp; შემუშვების მიზნით, აუცილებელია თავდაპირველი დიაგნოსტირება და&nbsp; შეფასება. ეს პროცესი მოიცავს როგორც ადგილზე დათვალიერებას,&nbsp; ასევე შესაბამისი დოკუმენტაციისა და პროცედურების გაცნობა/შესწავლას.</p>
                <p>პირველ ეტაპზე კომპანია კოსი (კონცეფთ ოფ სეიფთი) განახორციელებს „შრომისა და ტექნიკური უსაფრთხოების ტურს“ ორგანიზაციის ობიექტზე,&nbsp; მოახდენს არსებული დოკუმენტაციის და პროცედურების შესწავლას,&nbsp; ჩაატარებს დაკვირვებას და ინტერვიუს დასაქმებულებთან.</p>
                <p>აღნიშნულ საფეხურზე მოხდება ობიექტების შემოწმება/ინსპექტირება&nbsp; და სამუშაო არეალზე ძირითადი შეუსაბამობების აღმოჩენა. მირებული ინფორმაციის საფუძველზე განისაზღვრება საჭირო&nbsp; პროცედურები, მოხდება სისტემის ხედვის შემუშავება და დაიგეგმება&nbsp; შემდგომი ნაბიჯები. დიაგნოსტირების ეტაპის დასასრულს, კომპანია&nbsp; კოსი წარმოადგენს დამკვეთის სპეციფიკაზე მორგებულ უსაფრთხოების&nbsp; სისტემის შეთავაზებას, რომელიც საბოლოოდ შეთანხმდება დამკვეთი ორგანიზაციის პასუხისმგებელ პირებთან.</p>',
            ],
            [
                'name' => 'პროცესების და პროცედურების განვითარება:',
                'text' => '
                <ul>
                <li>შრომის უსაფრთხოების პოლიტიკისა და დოკუმენტაციის რევიზია, საჭიროების შემთხვევაში – განახლება და სრულყოფა;</li>
                <li>სტანდარტების და პროცედურების გაწერა;</li>
                <li>ინსტრუქციების შექმნა;</li>
                <li>პასუხისმგებლობების გადანაწილებ;</li>
                </ul>
                <p>მას შემდეგ, რაც მოხდება შრომის უსაფრთხოების სისტემის დასანერგად სამუშაო არეალის განსაზღვრა, კომპანია კოსის სერთიფიცირებული&nbsp; სპეციალისტები&nbsp; შეიმუშავებენ პოლიტიკის განვითარებისთვის საჭირო სისტემის დეტალურ&nbsp; დიზაინს. განავითარებენ პროცედურებს და მოახდენენ მათ ინტეგრაციას&nbsp; ორგანიზაციაში უკვე არსებულ პროცედურებთან. პროცესი წარიმართება დამკვეთ ორგანიზაციასთან აქტიური თანამშრომლობით. სისტემა და პროცედურები წარმოდგენილი იქნება შესაბამისი დოკუმენტაციის სახით.</p>',
            ],
            [
                'name' => 'სწავლება/ტრენინგი/ინსტრუქტაჟი',
                'text' => '
                <p>კომპანიის შრომის უსაფრთხოების პოლიტიკის განსაზღვრის და პროცედურების&nbsp; დამტკიცების შემდგომ, შესაძლებელი გახდება სასწავლო სატრენინგო&nbsp; მოდულების განვითარება და განხორციელება. ტრენინგები და კონსულტაციები ჩატარდება შემდეგ&nbsp; თემებზე:</p>
                <ul>
                <li>საკანონმდებლო მოთხოვნები და რეგულაციები; </li>
                <li>საფრთხეები და რისკები – რისკების შეფასების პროცედურა; </li>
                <li>შემთხვევების მოკვლევა და ანალიზი; </li>
                <li>კონტრაქტორებთან ურთიერთობა; </li>
                <li>ტრენინგი და სწავლება; </li>
                <li>სარემონტო სამუშაოების უსაფრთხოდ წარმოება; </li>
                <li>სწავლებები კონკრეტულ უსაფრთხოების თემებზე სამუშაოს სპეციფიკიდან გამომდინარე</li>
                </ul>
                <p>ტრენინგების ციკლის დასრულების შემდეგ, სწავლების შედეგიანობის&nbsp; გასაზრდელად, კომპანია კოსის სერთიფიცირებული სპეციალისტები დაეხმარებიან მონაწილეებს შეძენილი ცოდნის პრაქტიკულ დანერგვაში, რაც განხორციელდება პროგრამის&nbsp; მიმდინარეობის შემდგომ ეტაპზე „დანერგვის მხარდაჭერა“</p>'
            ],
            [
                'name' => 'ტექნიკური ინსპექტირება და სისტემის აუდიტი',
                'text' => '
                <p>ჩვენი დამატებითი სერვისია ტექნიკურ ინსპექტირება და სისტემის აუდიტი ჩატარება:</p>
                <p>გაზგასამართი სადგურებისთვის;<br>
                საქვაბე დანადგარებისთვის;<br>
                ამიაკიანი დანადგარებისთვის;<br>
                წნევაზე მომუშავე ჭურჭლებისთვის;<br>
                წნევაზე მომუშავე აირბალონებისთვის,</p>
                <p>ეს მომსახურება ტექნიკური ინსპექტირების შემდეგ გულისხმობს რეკომენდაციების გაცემას, საწყისი ინსტრუქტაჟის ჩატარებას და საჭიროებისამებრ, დამატებით სწავლებას და ტრენინგების ციკლს, რომ თქვენი საქმიანობა იყოს ნორმატიულ დოკუმენტებთან შესაბამისობაში.</p>',
            ],
            [
                'name' => 'სურსათის უვნებლობის და ხარისხის სპეციალისტის მომსახურება',
                'text' => '
               <p><b>სურსათის უვნებლობისა და ხარისხის სპეციალისტის მომსახურება მოიცავს</b><b>:</b></p>
                <ul>
                <li>სურსათის უვნებლობის სფეროებში ბიზნეს ოპერატორის საქმიანობის საქართველოს კანონმდებლობით განსაზღვრულ მოთხოვნებთან შესაბამისობის შეფასებას;</li>
                <li>მონიტორინგს;</li>
                <li>დოკუმენტური შემოწმებას;</li>
                <li>მიკვლევადობის სისტემის შემოწმებასა და პერიოდულად მონიტორინგს;</li>
                <li>პერსონალის სწავლებას ჰიგიენურ საკითხებთან დაკავშირებით; ეტიკეტების შემუშავებას;</li>
                <li>HACCP პრინციპებზე დაფუძნებული სისტემის დანერგვას კომპანიებისათვის სამართლებრივი მხარდაჭერის უზრუნველყოფა შრომითი სამართალიშრომითი ხელშეკრულებების, შიდა შრომითი პოლიტიკის და პროცედურების შედგენა/გადახედვა/ექსპერტიზა/შესაბამისობის დადგენა;</li>
                <li>ზეპირი / წერილობითი კონსულტაციები, სამართლებრივი საბუთების შედგენა, შრომითი დავების, კონფიდენციალურობის, კონკურენციის შემთხვევების და რეპუტაციული რისკების – მართვის და პრევენციის მიზნით;</li>
                </ul>',
            ],
            [
                'name' => 'დანერგვის მხარდაჭერა',
                'text' => '<p>სისტემის მდგრადი და ეფექტური მუშაობის&nbsp; უზრუნველსაყოფად კონსულტაციები და ქოუჩინგი, რაც მოიცავს შემდეგ სერვისებს:</p>
                <ul>
                <li><b>დისტანციური კონსულტაცია და ქოუჩინგი </b>– იმის მიხედვით, რომელი&nbsp; თანამშრომელი რა პასუხისმგებლობით დაიტვირთება, თითოეულს დასჭირდება&nbsp; გარკვეული მხარდაჭერა ამ პასუხისმგებლობების შესრულების პირველ ეტაპზე.&nbsp; დისტანციური ქოუჩინგის საშუალებით მოხდება პასუხისმგებელი პირების&nbsp; საქმიანობის გადამოწმება და საჭიროების შემთხვევაში დამატებითი&nbsp; კონსულტირება.</li>
                <li><b>სამუშაო ადგილზე კონსულტირება </b>– გარდა ონლაინ დისტანციური&nbsp; კომუნიკაციისა, კომპანია კოსის სპეციალისტები განახორციელებენ ვიზიტებს&nbsp; სამუშაო პროცესის გადამოწმებისა და დამატებითი მხარდაჭერის გაწევის მიზნით.&nbsp; ამ გზით მოხდება სისტემის მუშაობის შეფასება, ხარვეზების დროული დანახვა&nbsp; და აღმოფხვრა.</li>
                </ul>',
            ],
            [
                'name' => 'მდგრადობის უზრუნველყოფა',
                'text' => '
                <p><strong>შრომითი სამართალი</strong></p>
                <ul>
                <li>შრომითი ხელშეკრულებების, შიდა შრომითი პოლიტიკის და პროცედურების შედგენა/გადახედვა/ექსპერტიზა/შესაბამისობის დადგენა;</li>
                <li>ზეპირი / წერილობითი კონსულტაციები, სამართლებრივი საბუთების შედგენა, შრომითი დავების, კონფიდენციალურობის, კონკურენციის შემთხვევების და რეპუტაციული რისკების მართვის და პრევენციის მიზნით;</li>
                <li>შრომის ინსპექციის სამსახურთან დავების პრევენცია და მართვა</li>
                </ul>
                <p><b>პერსონალურ </b><b>მონაცემთა</b> <b>დაცვა</b></p>
                <ul>
                <li>პერსონალურ მონაცემთა დაცვის კანონმდებლობასთან შესაბამისობის დადგენა, შიდა პოლიტიკის და პროცედურების გადახედვა/შედგენა;</li>
                <li>ზეპირი, წერილობითი კონსულტაციები, სამართლებრივი საბუთების შედგენა&nbsp;პერსონალურ მონაცემთა დაცვის რეპუტაციული რისკების მართვის და პრევენციის მიზნით;</li>
                <li>სახელმწიფო ინსპექტორის სამსახურთან დავების პრევენცია და მართვა.</li>
                </ul>',
            ],
            [
                'name' => 'შრომის უსაფრთხოების მოწვეული სპეციალისტები',
                'text' => '
                <p>დამკვეთი კომპანიის უზრუნველყოფას&nbsp; შრომის უსაფრთხოების მოწვეული სპეციალისტით (ებით), რომლებსაც&nbsp; ხელშეკრულების მოქმედების ვადის განმავლობაში ექნებათ შემდეგი&nbsp; ფუნქცია-მოვალეობები:</p>
                <ul>
                <li>დამკვეთი კომპანიის ობიექტებზე რეგულარული ვიზიტები და შრომის (მინიმუმ კვირაში ერთხელ) პირობების ინსპექტირება და სისტემის აუდიტი;</li>
                <li>კომპანიის მენეჯმენტთან კონსულტაციების მეშვეობით, ობიექტებზე შრომის უსაფრთხოების მართვის სისტემების დანერგვის პარალელურად, შემდეგი პროცესების წარმართვა:</li>
                <li>საფრთხეების იდენტიფიცირება, რისკების შეფასება, დარღვევების პოვნა და ანგარიშგება, კონტროლის მექანიზმების განსაზღვრა, სამუშაო პროცესზე დაკვირვება, ინციდენტების ანგარიშგება და მოკვლევა,&nbsp; ინსპექციები, რეპორტების მომზადება, სტატისტიკის წარმოება, ა.შ;</li>
                <li>დამკვეთი კომპანიის მენეჯმენტთან და დასაქმებულებთან კომუნიკაციის გზების განსაზღვრა და რეგულარული შეხვედრების წარმოება;</li>
                <li>სავალდებულო შრომის უსაფრთხოების ინსტრუქტაჟების ჩატარება და შესაბამისი ანგარიშგების წარმოება;</li>
                <li>ობიექტზე დასაქმებულთათვის პერიოდული ტრენინგის ჩატარება.</li>
                </ul>',
            ],
            [
                'name' => 'სახანძრო უსაფრთხოება',
                'text' => '
                <p>სახანძრო უსაფრთხოება</p>
                <p>საგანგებო სიტუაციებისა და სახანძრო უსაფრთხოების საკითხებში მომსახურება:</p>
                <p>1. საევაკუაციო გეგმების შემუშავება (სართულის, სექციის, ლოკალური ან საერთო) საქართველოს მთავრობის 2015 წლის 23 ივლისის №370 დადგენილების „სახანძრო უსაფრთხოების წესებისა და პირობების შესახებ ტექნიკური რეგლამენტის დამტკიცების თაობაზე“ მოთხოვნათა შესაბამისად.</p>
                <p><strong>საევაკუაციო გეგმების შემუშავება გულისხმობს:</strong></p>
                <p>მოცემული დროისათვის შენობის არსებული/დამტკიცებული მუშა ნახაზების (სართულის გეგმები ზომების ჩვენებით) გადმოცემას ელექტრონული ან ქაღალდზე ნაბეჭდის სახით;<br>
                გადმოცემული გეგმების დამუშავებას, რაც გულისხმობს დამკვეთთან დეტალების (როგორიცაა კომპანიის სრული დასახელება, მისამართი, ზომები და სხვა) დაზუსტებას;<br>
                დამკვეთთან საბოლოოდ შეთანხმებული საკითხების გათვალისწინებით ევაკუაციის გეგმების დახაზვას კომპიუტერულ გრაფიკულ რედაქტორში სტანდარტების დაცვით;<br>
                შეთანხმებულ დროში დამკვეთისათვის დასრულებული ევაკუაციის გეგმების გადაცემას ელექტრონული სახით PDF ფორმატში.</p>
                <p>2. სახანძრო უსაფრთხოების ზომების შემუშავება რეგლამენტის მოთხოვნების შესაბამისად;</p>
                <p>3. სახანძრო უსაფრთხოების მოთხოვნების შესრულების უზრუნველყოფის ტექნიკური გადაწყვეტილებების შემუშავება:</p>
                <p>– რეკომენდაციების გაცემა სახანძრო უსაფრთხოების ან საგანგებო სიტუაციების მოთხოვნების შესასრულებლად;<br>
                – სახანძრო ან სამაშველო (ცეცხლმაქრები, კვამლის დეტექტორები და სასიგნალო მოწყობილობები, პლაკატები/სტიკერები, ინდივიდუალური დაცვის საშუალებები და ა.შ.) ინვენტარის შეძენის მიზნით მათი რაოდენობებისა და პარამეტრების დათვლა არსებული წესის დაცვით;<br>
                – საწყისი ინსტრუქტაჟის ჩატარება ხანძრის ან სხვა საგანგებო სიტუაციებში წესების გაცნობის მიზნით;</p>',
            ],
        ];

        foreach($services_data as $s){
            $service = new Service();
            $service->name = $s['name'];
            $service->text = $s['text'];
            $service->save();

        }


        $policies = [
            [
                'name' => 'Terms Of Service',
                'text' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Odio ullam repellendus, laudantium quas, est cupiditate rerum neque ratione, sit facere at optio dolore unde enim? Praesentium vitae, sed at possimus hic amet ullam magnam, tempore accusantium magni accusamus. Similique vitae, nobis enim eveniet explicabo nulla velit, cumque id tempora illo atque libero officia porro et corporis, debitis nesciunt sunt. Odio, maxime necessitatibus? Vero dolore rem, error aliquid alias nostrum eum modi amet magni odio natus ipsam delectus consectetur impedit magnam nesciunt quo ut eaque? Tempore impedit saepe, quos corporis deleniti porro, eos, ipsa dignissimos quas eligendi voluptatem fugit nostrum ea labore mollitia temporibus recusandae! Ab sequi qui repudiandae iure voluptatem pariatur nesciunt at distinctio nulla reprehenderit odio a, modi est enim, omnis recusandae hic corporis obcaecati esse ipsum eius tempora? Eum repudiandae neque dolore at deleniti quo ea adipisci, ut rerum sed iusto obcaecati, sint temporibus odit qui dolorem illo error possimus sapiente suscipit ducimus excepturi alias nostrum? Sit, fugit blanditiis, recusandae aut rerum pariatur impedit labore quasi laborum ducimus consequatur. Quae nulla ex modi. Repellat quam veritatis veniam. Sint ad facilis porro perspiciatis quis. Ea maiores laborum nam modi. Dolor voluptatum pariatur aut natus incidunt. Sint nam quae sapiente, autem aperiam nobis? Deleniti molestias ipsa nam at aliquam non animi, maiores hic accusantium consequatur id veritatis repellat qui aliquid harum dolore voluptate ea optio blanditiis reprehenderit quae magni assumenda? Ad ipsum atque nesciunt dolorum perferendis magni consectetur non dolore numquam eum blanditiis consequatur, dicta saepe minima omnis inventore repudiandae enim corrupti pariatur praesentium fugit minus aliquid? Labore aliquam commodi, officia hic quidem doloribus, molestiae nihil corrupti, quos repudiandae eveniet blanditiis iusto saepe? Veritatis doloribus voluptatem recusandae reprehenderit perspiciatis minus architecto aliquid neque fuga vitae? Aperiam id molestias quaerat sit! Harum suscipit doloribus tempora tenetur sunt fuga molestiae consequuntur alias, totam quasi mollitia. Numquam, adipisci a aut minus distinctio deserunt optio ullam hic at quam. Omnis necessitatibus nulla modi. Rerum iusto eius quasi reiciendis quidem? Hic ducimus accusamus architecto dicta eos delectus obcaecati. Pariatur porro cumque numquam, repellendus quisquam quod fugit ullam facere beatae aliquam nam aperiam id ipsa omnis quia distinctio! Voluptate inventore libero maxime ratione ipsa omnis. Maiores amet incidunt nobis aut, voluptates ipsam fugiat, vero repellendus sed voluptatem assumenda nostrum velit corporis dolorem suscipit animi, placeat ea! Amet mollitia laborum quaerat officiis hic iusto maiores eos, illo minus rerum et quo architecto porro labore tempora ea nobis voluptate, adipisci dolores reprehenderit rem dolorem doloremque? Iure impedit sunt recusandae voluptatibus molestias debitis nesciunt deserunt nam nostrum. Dolores, error. Vero blanditiis aspernatur a sit. Hic unde ipsum aperiam exercitationem ipsam ullam repudiandae distinctio. Ad ipsa molestias adipisci eius ut necessitatibus? In officiis consequatur quidem totam repellendus fugit accusantium consectetur iusto animi facere amet, ipsam ducimus beatae ut debitis tempora corrupti adipisci? Eum assumenda ducimus non reprehenderit alias nisi nostrum cum minus voluptas, ipsa praesentium veniam incidunt soluta odit ex, provident hic deserunt neque aliquam eligendi, asperiores dolores quia accusamus! Architecto repudiandae nobis quo voluptate eaque, consequuntur esse qui suscipit ad voluptates dolorum reiciendis similique quam sunt exercitationem, laudantium est incidunt, accusantium atque. Earum beatae nesciunt id officia odio sequi repellendus perspiciatis esse illo exercitationem, quibusdam natus doloremque aliquam, ab ad saepe pariatur. Nobis ducimus nisi fugiat. Id tempore amet excepturi, rem quo illo non quis, officiis praesentium eaque incidunt aliquam inventore itaque minus ab quisquam repellendus vel, consectetur debitis! Odit ea soluta voluptatibus nisi sit necessitatibus et reiciendis, laboriosam repellat aspernatur, officiis dolor quis quo ipsum quaerat eligendi atque aut officia. Eveniet iure nemo consequatur! Ipsam harum quis nulla odio alias ipsa et dolorum aspernatur repellat rem unde necessitatibus optio, veniam expedita ullam dolores porro deserunt voluptatem at debitis modi minima animi illum? Odit, quos voluptatem nihil tempore animi autem sed impedit nulla quas tempora laudantium maxime facere reprehenderit aut, corporis quo tenetur totam iusto dignissimos, possimus earum. Alias quia nam id nostrum adipisci suscipit aperiam ipsa impedit architecto in repudiandae eligendi ea commodi ut pariatur, veniam sequi rem. Mollitia aperiam molestiae cumque officia! Quis fugiat molestiae amet nihil ipsa earum autem temporibus, eius, eaque cum accusamus ex atque ipsam. Sit ab animi quas error nostrum nemo praesentium est. Autem necessitatibus quod, excepturi iusto blanditiis eveniet libero corporis cum nostrum minus debitis soluta! Sequi repellat architecto molestiae quibusdam laudantium vitae harum ab quasi placeat consectetur, aspernatur iste voluptatum nobis ut adipisci cumque aliquid atque maxime voluptatibus ullam dolor nihil nam voluptate ipsum. Ducimus vitae voluptate asperiores mollitia harum, eos officia, minima error assumenda illo ea exercitationem corrupti impedit esse voluptates nisi. Quo tenetur laborum vel quod odit! Vitae voluptatum maiores molestiae aut? Earum ipsam et reprehenderit asperiores nam cupiditate facere id sunt, culpa nulla vero laborum reiciendis, necessitatibus natus quo atque ea autem labore. Vero veniam optio a tempore ipsam fugit temporibus, dignissimos perspiciatis rem doloremque nam quos quisquam molestias, animi similique impedit ipsa earum cumque itaque totam blanditiis asperiores nesciunt laudantium? Beatae ab eius molestias aut. Praesentium ut alias optio nisi voluptas odit temporibus repudiandae nam? Vitae, sed! Fugiat ipsum porro, facilis eos molestias veritatis sit quidem eum autem ducimus rem obcaecati ea maiores magnam mollitia aperiam debitis similique alias pariatur error ut. Libero expedita, possimus aut itaque ullam laborum fugit quis similique quam molestias sequi animi maxime obcaecati, ducimus a magni excepturi placeat ipsa odit velit ipsum facilis illo doloribus neque. Voluptatem, provident iusto esse ullam ab recusandae consequuntur obcaecati accusamus, quis inventore quos! Laborum veritatis laboriosam consequuntur, asperiores debitis delectus ipsum reprehenderit ad culpa tempore expedita minima, fuga cum odit dignissimos modi vel accusantium quis deleniti quaerat. Voluptate veritatis corrupti minus omnis aliquam, quasi autem enim. Ipsa ipsam quas hic veritatis? Placeat dolorum consequuntur fugit neque inventore voluptate voluptates nulla quos quod recusandae, architecto excepturi, odit minima praesentium beatae consectetur aperiam sit animi, ea provident? In sit modi molestiae optio dolore repellendus, error placeat eaque aliquid quas, ad neque sapiente provident est voluptatibus. Deserunt nobis dolorem veritatis maiores magnam voluptatem iure sapiente, ex esse. Officiis numquam blanditiis sapiente minima similique at cumque consequatur dicta, nemo perspiciatis.',
            ],

            [
                'name' => 'Privacy Policy',
                'text' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Odio ullam repellendus, laudantium quas, est cupiditate rerum neque ratione, sit facere at optio dolore unde enim? Praesentium vitae, sed at possimus hic amet ullam magnam, tempore accusantium magni accusamus. Similique vitae, nobis enim eveniet explicabo nulla velit, cumque id tempora illo atque libero officia porro et corporis, debitis nesciunt sunt. Odio, maxime necessitatibus? Vero dolore rem, error aliquid alias nostrum eum modi amet magni odio natus ipsam delectus consectetur impedit magnam nesciunt quo ut eaque? Tempore impedit saepe, quos corporis deleniti porro, eos, ipsa dignissimos quas eligendi voluptatem fugit nostrum ea labore mollitia temporibus recusandae! Ab sequi qui repudiandae iure voluptatem pariatur nesciunt at distinctio nulla reprehenderit odio a, modi est enim, omnis recusandae hic corporis obcaecati esse ipsum eius tempora? Eum repudiandae neque dolore at deleniti quo ea adipisci, ut rerum sed iusto obcaecati, sint temporibus odit qui dolorem illo error possimus sapiente suscipit ducimus excepturi alias nostrum? Sit, fugit blanditiis, recusandae aut rerum pariatur impedit labore quasi laborum ducimus consequatur. Quae nulla ex modi. Repellat quam veritatis veniam. Sint ad facilis porro perspiciatis quis. Ea maiores laborum nam modi. Dolor voluptatum pariatur aut natus incidunt. Sint nam quae sapiente, autem aperiam nobis? Deleniti molestias ipsa nam at aliquam non animi, maiores hic accusantium consequatur id veritatis repellat qui aliquid harum dolore voluptate ea optio blanditiis reprehenderit quae magni assumenda? Ad ipsum atque nesciunt dolorum perferendis magni consectetur non dolore numquam eum blanditiis consequatur, dicta saepe minima omnis inventore repudiandae enim corrupti pariatur praesentium fugit minus aliquid? Labore aliquam commodi, officia hic quidem doloribus, molestiae nihil corrupti, quos repudiandae eveniet blanditiis iusto saepe? Veritatis doloribus voluptatem recusandae reprehenderit perspiciatis minus architecto aliquid neque fuga vitae? Aperiam id molestias quaerat sit! Harum suscipit doloribus tempora tenetur sunt fuga molestiae consequuntur alias, totam quasi mollitia. Numquam, adipisci a aut minus distinctio deserunt optio ullam hic at quam. Omnis necessitatibus nulla modi. Rerum iusto eius quasi reiciendis quidem? Hic ducimus accusamus architecto dicta eos delectus obcaecati. Pariatur porro cumque numquam, repellendus quisquam quod fugit ullam facere beatae aliquam nam aperiam id ipsa omnis quia distinctio! Voluptate inventore libero maxime ratione ipsa omnis. Maiores amet incidunt nobis aut, voluptates ipsam fugiat, vero repellendus sed voluptatem assumenda nostrum velit corporis dolorem suscipit animi, placeat ea! Amet mollitia laborum quaerat officiis hic iusto maiores eos, illo minus rerum et quo architecto porro labore tempora ea nobis voluptate, adipisci dolores reprehenderit rem dolorem doloremque? Iure impedit sunt recusandae voluptatibus molestias debitis nesciunt deserunt nam nostrum. Dolores, error. Vero blanditiis aspernatur a sit. Hic unde ipsum aperiam exercitationem ipsam ullam repudiandae distinctio. Ad ipsa molestias adipisci eius ut necessitatibus? In officiis consequatur quidem totam repellendus fugit accusantium consectetur iusto animi facere amet, ipsam ducimus beatae ut debitis tempora corrupti adipisci? Eum assumenda ducimus non reprehenderit alias nisi nostrum cum minus voluptas, ipsa praesentium veniam incidunt soluta odit ex, provident hic deserunt neque aliquam eligendi, asperiores dolores quia accusamus! Architecto repudiandae nobis quo voluptate eaque, consequuntur esse qui suscipit ad voluptates dolorum reiciendis similique quam sunt exercitationem, laudantium est incidunt, accusantium atque. Earum beatae nesciunt id officia odio sequi repellendus perspiciatis esse illo exercitationem, quibusdam natus doloremque aliquam, ab ad saepe pariatur. Nobis ducimus nisi fugiat. Id tempore amet excepturi, rem quo illo non quis, officiis praesentium eaque incidunt aliquam inventore itaque minus ab quisquam repellendus vel, consectetur debitis! Odit ea soluta voluptatibus nisi sit necessitatibus et reiciendis, laboriosam repellat aspernatur, officiis dolor quis quo ipsum quaerat eligendi atque aut officia. Eveniet iure nemo consequatur! Ipsam harum quis nulla odio alias ipsa et dolorum aspernatur repellat rem unde necessitatibus optio, veniam expedita ullam dolores porro deserunt voluptatem at debitis modi minima animi illum? Odit, quos voluptatem nihil tempore animi autem sed impedit nulla quas tempora laudantium maxime facere reprehenderit aut, corporis quo tenetur totam iusto dignissimos, possimus earum. Alias quia nam id nostrum adipisci suscipit aperiam ipsa impedit architecto in repudiandae eligendi ea commodi ut pariatur, veniam sequi rem. Mollitia aperiam molestiae cumque officia! Quis fugiat molestiae amet nihil ipsa earum autem temporibus, eius, eaque cum accusamus ex atque ipsam. Sit ab animi quas error nostrum nemo praesentium est. Autem necessitatibus quod, excepturi iusto blanditiis eveniet libero corporis cum nostrum minus debitis soluta! Sequi repellat architecto molestiae quibusdam laudantium vitae harum ab quasi placeat consectetur, aspernatur iste voluptatum nobis ut adipisci cumque aliquid atque maxime voluptatibus ullam dolor nihil nam voluptate ipsum. Ducimus vitae voluptate asperiores mollitia harum, eos officia, minima error assumenda illo ea exercitationem corrupti impedit esse voluptates nisi. Quo tenetur laborum vel quod odit! Vitae voluptatum maiores molestiae aut? Earum ipsam et reprehenderit asperiores nam cupiditate facere id sunt, culpa nulla vero laborum reiciendis, necessitatibus natus quo atque ea autem labore. Vero veniam optio a tempore ipsam fugit temporibus, dignissimos perspiciatis rem doloremque nam quos quisquam molestias, animi similique impedit ipsa earum cumque itaque totam blanditiis asperiores nesciunt laudantium? Beatae ab eius molestias aut. Praesentium ut alias optio nisi voluptas odit temporibus repudiandae nam? Vitae, sed! Fugiat ipsum porro, facilis eos molestias veritatis sit quidem eum autem ducimus rem obcaecati ea maiores magnam mollitia aperiam debitis similique alias pariatur error ut. Libero expedita, possimus aut itaque ullam laborum fugit quis similique quam molestias sequi animi maxime obcaecati, ducimus a magni excepturi placeat ipsa odit velit ipsum facilis illo doloribus neque. Voluptatem, provident iusto esse ullam ab recusandae consequuntur obcaecati accusamus, quis inventore quos! Laborum veritatis laboriosam consequuntur, asperiores debitis delectus ipsum reprehenderit ad culpa tempore expedita minima, fuga cum odit dignissimos modi vel accusantium quis deleniti quaerat. Voluptate veritatis corrupti minus omnis aliquam, quasi autem enim. Ipsa ipsam quas hic veritatis? Placeat dolorum consequuntur fugit neque inventore voluptate voluptates nulla quos quod recusandae, architecto excepturi, odit minima praesentium beatae consectetur aperiam sit animi, ea provident? In sit modi molestiae optio dolore repellendus, error placeat eaque aliquid quas, ad neque sapiente provident est voluptatibus. Deserunt nobis dolorem veritatis maiores magnam voluptatem iure sapiente, ex esse. Officiis numquam blanditiis sapiente minima similique at cumque consequatur dicta, nemo perspiciatis.',
            ],

            [
                'name' => 'We use cookies',
                'text' => 'We use cookies and other tracking technologies to improve your browsing experience on our website, to show you personalized content and targeted ads, to analyze our website traffic, and to understand where our visitors are coming from',
            ]
        ];

        // $organizations =  \App\Models\Organization::factory(10)->create();
        // foreach ($organizations as $organization) {

        //     $offices =  \App\Models\Office::factory(rand(2, 7))->create(['organization_id' => $organization->id]);
        //     //create office customers

        // }

        // $positions =  \App\Models\Position::factory(rand(2, 7))->create();

        // $admin = new Customer();
        // $admin->name = 'admin';
        // $admin->email = 'customer@example.com';
        // $admin->password = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'; // password
        // $admin->office_id = Office::first()->id;
        // $admin->position_id = $positions->random(1)[0]->id;
        // $admin->save();

        //create policies
        foreach($policies as $pp){

            $policy = new Policy();
            $policy->name = $pp['name'];
            $policy->text = $pp['text'];
            $policy->save();
        }




                // foreach($offices as $office){
                //     $position = $positions->random(1)[0];
                //     $cusomer = \App\Models\Customer::factory(rand(2, 15))->create(['office_id' => $office->id, 'position_id' => $position->id]);
                // }


        //create admin
        $admin = new User();
        $admin->name = 'admin';
        $admin->email = 'khonelia1@gmail.com';
        $admin->email_verified_at = now();
        $admin->password = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'; // password
        $admin->remember_token = Str::random(10);
        $admin->save();



        //contact data
        $cotanct = new Contact();
        $cotanct->email = 'info@example.com';
        $cotanct->phone = '551 11-11-11';
        $cotanct->facebook = 'https://facebook.com';
        $cotanct->youtube = 'https://youtube.com';
        $cotanct->linkedin = 'https://linked.com';

        $cotanct->address = 'Tbilisi, Georgia Test Street #6';
        $cotanct->map = '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d76585.73377967358!2d44.77561332836155!3d41.735655951570884!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x40440cef543a5e2f%3A0x1d2e538dc87da98e!2sGeorgian%20National%20Museum!5e0!3m2!1sen!2sge!4v1642018778149!5m2!1sen!2sge" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>';
        $cotanct->image = '2022-01-13_22-47-05.jpeg';
        $cotanct->address = 'Test Address, Tbilisi, Georgia';
        $cotanct->save();

        //About data
        $about = new About();
        $about->title = 'About Us title';
        $about->text = 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nam, mollitia aliquam incidunt cupiditate facere suscipit eum rerum nisi illo illum modi non! Similique vero est debitis dolore mollitia atque eos maiores consequatur sit dolor deserunt ipsam culpa maxime nemo harum ipsum explicabo, reprehenderit eius accusantium beatae vitae tempora. Dolorum deleniti debitis dignissimos eaque similique, dicta doloribus ullam maiores. Velit, reprehenderit? Et libero mollitia beatae dolorum odit ab excepturi adipisci saepe sed numquam harum soluta nostrum laborum amet eius perferendis eos, ullam corporis dolor consequuntur. Officia corporis earum obcaecati corrupti excepturi! Reiciendis quidem, tempora vitae a nemo quisquam, mollitia repudiandae voluptates fuga fugit consectetur officiis, rem deserunt fugiat.';
        $about->stats = '[{"stat_icon":"fa-chalkboard-teacher","stat_name":"Clients","stat_number":"260"},{"stat_icon":"fa-chalkboard-teacher","stat_name":"Sold","stat_number":"430"},{"stat_icon":"fa-chalkboard-teacher","stat_name":"Team","stat_number":"320"}]';
        $about->image = '2022-01-13_22-47-26.jpeg';
        $about->save();

        //create sections
        $about = new Section();
        $about->title = 'We Can Help You In Different Situations buy this HTML';
        $about->text = 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis';
        $about->url = 'https://cos.com.ge';
        $about->stats = '["Coaching Courses for Life","Every Video included in package","We have best support community","Call us 24/7 we are Online"]';
        $about->image = '2022-01-24_18-11-24.jpeg';
        $about->save();

        $about = new Section();
        $about->title = 'We are the first and trusted Business Consulting company in your city. The best service is our goal.';
        $about->text = 'We’re also experts at finding the sweet spot between Google’s guidelines and what is commercially right for you. We have progressive theories on search as a tool for retention of customers, not just for acquisition';
        $about->stats = '[{"stat_icon":"fa-chalkboard-teacher","stat_name":"Happy Clients","stat_number":"260"},{"stat_icon":"fa-chalkboard-teacher","stat_name":"reciently sold","stat_number":"430"},{"stat_icon":"fa-chalkboard-teacher","stat_name":"Expert Team","stat_number":"320"}]';
        $about->image = '2022-01-24_18-11-14.jpeg';
        $about->save();


        //create trainers
        // \App\Models\Trainer::factory(rand(5, 10))->create();
        //create categories
        // \App\Models\Category::factory(rand(3,7))->create();

        // for($i = 0; $i < rand(7, 15); $i++){
        // //create Trainings
        //     $trainer = Trainer::all()->random(1)->first();
        //     $category = Category::all()->random(1)->first();
        //     $trainings = \App\Models\Training::factory()->create(['trainer_id' => $trainer->id, 'category_id' => $category->id])->get();
        // }

        //create sliders
        \App\Models\Slider::factory(1)->create();

        //create partners
        // \App\Models\Partner::factory(6)->create();

        //create blogs
        // \App\Models\Blog::factory(20)->create();

        //create appointments
        // $appointments = \App\Models\Appointment::factory(rand(10,15))->create();

        //create training tests
        // $trainings = Training::all();
        // foreach($trainings as $training){
        //     $amount_of_questions = rand(15, 25);
        //     \App\Models\TrainingTest::factory($amount_of_questions)->create(['training_id' => $training->id]);
        //     $training->point_to_pass = round($amount_of_questions / 2);
        // }

        // foreach($appointments as $appointment){



        //     try{
        //         $tests = $appointment->training->tests;
        //         $number_of_answers = 0;
        //         $answers = [];
        //         foreach($tests as $test){
        //             $number_of_answers = count(json_decode($test['answers']), true);
        //             $answers[] = rand(0, $number_of_answers - 1);

        //         }
        //     //create appointments for customer@example.com
        //     $customer = Customer::where('email', 'customer@example.com')->first();
        //         //crate appointment customer link
        //         if($appointment->end_date < date("Y-m-d H:i:s")){

        //             \App\Models\AppointmentCustomer::factory(1)->create([
        //                 'appointment_id' => $appointment->id,
        //                  'customer_id' => $customer->id,
        //                  'test' => json_encode($appointment->training->tests),
        //                  'answers' => json_encode($answers),
        //                  'point_to_pass' => $appointment->training->point_to_pass,
        //                  'final_point' => rand(5, 15),
        //                  'start_date' => $appointment->start_date,
        //                  'finished_at' => $appointment->end_date,
        //                 ]);

        //         }else{
        //             \App\Models\AppointmentCustomer::factory(1)->create([
        //                 'appointment_id' => $appointment->id,
        //                  'customer_id' => $customer->id,
        //                  'test' => json_encode($appointment->training->tests),
        //                  'point_to_pass' => $appointment->training->point_to_pass,
        //                 ]);
        //         }


        //     }catch(Throwable $e){
        //         report($e);
        //     }
        //     $customers = Customer::all()->random(rand(5, 15));

        //     foreach($customers as $cusomer){
        //         try{
        //             $tests = $appointment->training->tests;
        //             $number_of_answers = 0;
        //             $answers = [];
        //             foreach($tests as $test){
        //                 $number_of_answers = count(json_decode($test['answers']), true);
        //                 $answers[] = rand(0, $number_of_answers - 1);

        //             }
        //             //crate appointment customer link
        //             \App\Models\AppointmentCustomer::factory(1)->create([
        //                 'appointment_id' => $appointment->id,
        //                  'customer_id' => $cusomer->id,
        //                  'test' => json_encode($appointment->training->tests),
        //                  'answers' => json_encode($answers),
        //                  'point_to_pass' => rand(7, 15),
        //                  'final_point' => rand(5, 15),
        //                  'finished_at' => $appointment->end_date,
        //                 ]);

        //         }catch(Throwable $e){

        //         }

        //     }

        // }

        // //create trainingMedia
        // $trainings = Training::all();
        // foreach($trainings as $training){
        //     $media = new TrainingMedia();
        //     $media->type = TrainingMedia::TYPE_DOCUMENT;
        //     $media->path = 'trainings/media/sample_012956100_1643939635.pdf';
        //     $media->name = 'document 1';
        //     $media->training_id = $training->id;
        //     $media->save();

        //     $media = new TrainingMedia();
        //     $media->type = TrainingMedia::TYPE_DOCUMENT;
        //     $media->path = 'trainings/media/sample_012956100_1643939635.pdf';
        //     $media->name = 'document 2';
        //     $media->training_id = $training->id;
        //     $media->save();

        //     $media = new TrainingMedia();
        //     $media->type = TrainingMedia::TYPE_DOCUMENT;
        //     $media->path = 'trainings/media/sample_012956100_1643939635.pdf';
        //     $media->name = 'document 3';
        //     $media->training_id = $training->id;
        //     $media->save();

        //     $media = new TrainingMedia();
        //     $media->type = TrainingMedia::TYPE_DOCUMENT;
        //     $media->path = 'trainings/media/sample_012956100_1643939635.pdf';
        //     $media->name = 'document 4';
        //     $media->training_id = $training->id;
        //     $media->save();

        //     $media = new TrainingMedia();
        //     $media->type = TrainingMedia::TYPE_VIDEO;
        //     $media->path = 'trainings/media/5_oauth_20_solution_065787000_1641744061.mp4';
        //     $media->name = 'video';
        //     $media->training_id = $training->id;
        //     $media->save();

        // }

    }
}
