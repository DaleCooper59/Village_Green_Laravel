<?php

namespace App\Console\Commands;

use App\Models\Address;
use App\Models\Category;
use App\Models\City;
use App\Models\Company;
use App\Models\Country;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;

class insertDatas extends Command
{
    use HasRoles;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:insertDatas';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
     * @return int
     */
    public function handle()
    {

        $this->call('migrate:fresh');
        $this->call('countries');
        $this->call('cities');
        $this->call('initRolesAndPermissions');
        /**
         * insertDatas
         */
        Address::factory()->count(6)->create();

        $dale = User::create(
            [
                'username' => 'Dale',
                'firstname' => 'Chris',
                'lastname' => 'Duvinage',
                'gender' => 'Mr',
                'age' => 26,
                'birth' => now(),
                'email' => 'chirs@gmail.com',
                'tel' => '0616478499',
                'email_verified_at' => now(),
                'password' => Hash::make('dddddddd'), // password
                'remember_token' => 'cnfebd51!e',
            ],

        );

        $rob= User::create(
            [
                'username' => 'Robert',
                'firstname' => 'Rob',
                'lastname' => 'BERT',
                'gender' => 'Mr',
                'age' => 38,
                'birth' => now(),
                'email' => 'rob@gmail.com',
                'tel' => '0619415499',
                'email_verified_at' => now(),
                'password' => Hash::make('rrrrrrrr'), // password
                'remember_token' => 'cnffdekhjghjyr1!e',
            ],

        );



        $user = User::create(
            [
                'username' => 'God',
                'firstname' => 'admin1',
                'lastname' => 'admin1',
                'gender' => 'Ms',
                'age' => 99,
                'birth' => now(),
                'email' => 'admin1@gmail.com',
                'tel' => '0101010101',
                'email_verified_at' => now(),
                'password' => Hash::make('password'), // password
                'remember_token' => 'dfudeuy!e',
            ],

        );

        Company::create(
            [
                'id' => 1,
                'address_id' => 1,
                'name' => 'Village Green',
                'SIRET' => '45657898659875',
            ],

        );

        Employee::create([
            'user_id' => 1,
            'company_id' => 1,
            'department' => 'Vendeur particulier',
        ]);

        $customer1 = Customer::create([
            'user_id' => 1,
            'employee_id' => 1,
            'ref_customer' =>  'client#1',
            'coefficient' => 5.6,
            'type' => 'particulier',
        ]);

        
        $ad2 = Address::where('id', 2)->first();
        
        $customer1->address()->attach($ad2->id);

        $customer1->save();

        $dale->assignRole('supply');
        $rob->assignRole('supply');
        $user->assignRole('god');

        User::factory()->count(6)->create();
        Company::factory()->count(1)->create();
        Employee::factory()->count(6)->create();
        Customer::factory()->count(6)->create();
        Supplier::factory()->count(6)->create();

        $users = User::doesntHave('roles')->get();
        foreach ($users as $user) {
            $user->assignRole('user');
        }



        /**
         * insertCategories
         */
        $categories = [
            'Bois', 'Claviers', 'Cordes', 'Cuivres', 'Percussions', 'Batteries', 'Guitares', 'Autre',
            'Basse', 'Electrique', 'Accoustique', 'clavier ??lectronique & synth??tiseur', 'Piano droit', 'Piano premium', 'Violon',
            'Saxophone', 'Batterie', 'Pad', 'Xylophone', 'Sitar', 'Harmonica', 'Platine vinyle', 'Contr??leur', 'Casque', 'Table de mixage', 'Logiciel', 'effet sonore'
        ];

        for ($i = 0; $i < count($categories); $i++) {
            $i < 8 ? $parent = null : $parent = 1;
            Category::create([
                'parent_id' => $parent,
                'name' => $categories[$i],
                'picture' => 'CATEGORIES_' . $categories[$i] . '.png',
            ]);
        }

        /**
         * insertTags
         */
        $tags = ['En cours de Livraison', 'Livr??', 'En pr??paration', 'Stock critique', 'Stock bas', 'En stock'];

        for ($i = 0; $i < count($tags); $i++) {
            Tag::create([
                'name' => $tags[$i],
                'color' => '#e2e2e2',
            ]);
        }


        /**
         * insertProducts
         */
        $labels = [
            'Guitarre ??lectrique Strat Sterling', 'Guitarre ??lectrique Ltd mh200', 'Guitarre ??lectrique sterling jason richardson natural poplar', 'Batterie pearl decade maple jazz 18inch', 'Batterie debut kit',
            'Nord Drum 3p - Pad de percussion ??lectronique ?? mod??lisation', 'korg piano b2sp', 'korg piano g1b air br', 'nord piano 5 73', 'm-audio axiom air mini 32', 'm-audio oxygen pro mini', 'violon archer 44v-500',
            'stagg shaped violon electrique', 'elkhart 100AS alto saxophone', 'noir et or alto saxophone', 'yanagisawa awo20pg', 'nuvo jsax 2.0', 'rosedale saxophone soprano', 'xylophone 3 octaves', 'ozark 2246 bouzouki guitarre accoustique',
            "sitar chevillier courbe ?? t??te d\'oiseau", "seagull m4 spruce eq dulcimer", "harmonica", "tuba hybride playlite", "CFX Yamaha piano premium", "S7X Yamaha piano premium", "YUS5 Yamaha piano droit",
            "Thorens TD 402 DD", "Pro-Ject Debut RecordMaster II", "Thorens TD 1600", "Native Instruments Traktor S4 MK3", "Native Instruments Traktor S2 MK3 Bundle", "Sennheiser HD-25 Plus",
            "Audio-Technica ATH-M70 X", "the t.bone HD 1500", "Allen & Heath Xone 96", "Behringer DX2000USB", "Rane Seventy-Two MKII", "Serato DJ Expansions", "Boss RC-505 Bundle"
        ];


        $refs = [
            'GUIT01', 'GUIT02', 'GUIT03', 'BAT01', 'BAT02', 'BAT03', 'PIAN01', 'PIAN02', 'PIAN03', 'PIAN04', 'PIAN05', 'VIO01', 'VIO02', 'SAX01', 'SAX02', 'SAX03', 'SAX04', 'SAX05', 'XYL01', 'GUIT04', 'GUIT05', 'GUIT06',
            'HARM01', 'CUIV01', 'PIAN06', 'PIAN07', 'PIAN08', 'DJ01', 'DJ02', 'DJ03', 'DJ04', 'DJ05', 'DJ06', 'DJ07', 'DJ08', 'DJ09', 'DJ10', 'DJ11', 'DJ12', 'DJ13'
        ];


        $descriptions = [
            "Inspir??e des guitares vintages mais agr??ment??e de caract??ristiques modernes, la Cutlass CT30 offre un son intemporel dans la paume de vos mains. La guitare dispose d\'une configuration de micros HSS ou SSS avec un switch 5 positions et un tr??molo de style vintage. Disponible en Fiesta Red (SSS), Charcoal Frost (SSS), Daphne Blue (SSS), Vintage Cream (HSS) et Stealth Black (HSS).",
            "Magnifique guitarre electrique rouge flamboyante", "Suite ?? la popularit?? du mod??le embl??matique de Jason Richardson sorti en 2019, Sterling pr??sente maintenant la nouvelle Richardson Cutlass pour les guitaristes plus traditionnels. Dot??e d'une corne inf??rieure profil??e personnalis??e pour l'acc??s aux frettes, d???un manche en ??rable torr??fi?? avec touche en palissandre et d???une table en loupe de peuplier, cette Cutlass reprend tous les composants de l'originale mais dans une configuration 6 cordes. Cela comprend ??galement deux humbuckers ?? haut rendement, un boost de 12 dB ??Push-Push??, une tonalit?? ??Push-Push?? coil-tap et un tremolo moderne.",
            "Avec la Decade, on entre dans la cat??gorie o?? un batteur peut r??ellement commencer ?? faire sonner la batterie dans sa globalit??, en termes de nuances de frappes, de possibilit??s d???accordages et d???homog??n??it?? entre la caisse claire, la grosse caisse et les toms... Sur la dur??e, en changeant les peaux, on pourra m??me encore ??largir le champ des possibles. Cela dit, avec les Remo Clear UT fournies - en particulier pour la grosse caisse de 18 x 14 pouces dot??e d???une Powerstroke 3 et d???une peau de r??sonance perc??e - et la peau sabl??e pour la caisse claire, on a d??j?? de quoi se r??galer. Et bien au-del?? d???une d??cade ! ",
            "Alesis s'est associ?? ?? Melodics afin de fournir 60 le??ons gratuites pour PC ou tablette. Melodics??? est une application qui permet d'am??liorer son timing, d'??largir son vocabulaire rythmique.",
            "Ne cherchez pas les ??chantillons de sons percussifs, il n'y en a pas ! En effet le moteur de synth??se du Nord Drum 3 P est enti??rement tourn?? vers la mod??lisation analogique et s'il ne contient aucun des sons de percussion habituels, il s???av??re l'appareil id??al pour jouer des sons ??lectro. Vous acc??dez ?? diverses formes d'ondes analogiques de base, ?? des enveloppes, filtres et effets et tout cela en temps r??el. Bien entendu, vous disposez tout de m??me de pr??sets enti??rement modifiables pour initier vos propres programmations. Vous l'aurez compris, ce Nord Drum 3P est aux pads ??lectroniques ce qu'un clavier Nord Lead est aux synth??tiseurs. Le mieux-disant??? ",
            "Une qualit?? acoustique due ?? sa technologie d'??chantillonnage st??r??o. S'y ajoutent la restitution du bruit g??n??r?? par le rel??chement de la p??dale et m??me les r??sonances sympathiques des cordes ! Compact et bien pens??, il se montre id??al pour les apprentis pianistes ou les amateurs en qu??te d'un piano num??rique de qualit?? pour leur domicile ou leur r??sidence secondaire.",
            "La sonorit?? d???une note de piano est exceptionnellement riche et sophistiqu??e. Les pianistes peuvent en moduler le volume ainsi que le timbre en fonction de l???impulsion qu'ils exercent sur les touches. Le G1-Air dispose d'??chantillons tr??s longs, soigneusement enregistr??s et les reproduit avec tous leurs d??tails. Il utilise en outre des technologies exclusives du Kronos pour d??livrer des transitions douces entre chaque note jou??e.",
            "La technologie unique Virtual Hammer Action, associ??e aux mouvements physiques du marteau, offre une authenticit?? et une r??ponse dynamique exceptionnelles, ce qui se traduit par une action de clavier qui g??re le jeu dynamique avec un contr??le incroyable ?? tous les niveaux de v??locit??.",
            "M-Audio a ainsi r??ussi l'exploit de loger dans un clavier compact, 32 touches et 8 pads, tous sensibles ?? la v??locit??, mais aussi 8 potentiom??tres librement assignables aux num??ros de contr??leurs Midi de votre choix, des touches de transport et de d??placement de curseur, de pitchbend et de modulation, de sustain et de changement d'octave. Le mieux, dans tout ??a, c'est qu???en d??pit des dimensions r??duites de l'AirMini32, la disposition de tous ces atouts est parfaitement claire, ce qui lui conf??re une ergonomie irr??prochable. ",
            "Vous avez envie de rejoindre le camp des professionnels avec un clavier de qualit??, proposant de nombreuses fonctionnalit??s et un minimum de tracas de programmation de nombreux logiciels ? Alors la gamme des claviers-ma??tres Oxygen Pro de M-Audio est faite pour vous. L'Oxygen Pro Mini, version ?? 32 touches au format mini, met ?? votre disposition une quantit?? impressionnante de fonctionnalit??s et une suite logicielle tr??s compl??te pour booster votre cr??ativit??, ainsi qu'un workflow tr??s intuitif vous permettant de vous concentrer sur la seule chose qui importe : votre cr??ativit??.",
            "Vous ??tes ?? la recherche d'un instrument r??pondant aux exigences de votre apprentissage en constante ??volution ? Ne cherchez plus, l'Archer 44V-500 de taille 4/4 est la r??ponse ?? vos pri??res. Cet instrument en bois massif est livr?? avec son archet en bois de feuillus et un ??tui rigide l??ger, soit tout ce qu'il vous faut pour passer au niveau suivant.",
            "Commencez ?? exp??rimenter avec votre son d??s aujourd'hui ! Le violon ??lectrique Stagg Shaped est un moyen abordable d'amplifier votre son. Dot?? d'une silhouette de contemporary violon ?? c??t?? d'un Noir brillantfinition, le violon ??lectrique Stagg est vraiment un instrument qui fait tourner les t??tes.",
            "Ce saxophone Elkhart est un excellent achat pour ceux ?? la recherche de leur premier instrument. Il poss??de une superbe intonation, un m??canisme utile et facile d???utilisation ainsi qu???un prix attractif ce qui en fait un saxophone alto d?????tude fantastique. Le corps en cuivre jaune du 100AS saxophone alto est renforc?? avec des rainures ce qui le rend plus r??sistant et adapt?? ?? une pratique fr??quente. La conception solide de ce saxophone en fait l???instrument id??al pour les joueurs interm??diaires et professionnels qui ont besoin d???un instrument de rechange avec un excellent rapport qualit??/prix.",
            "Fiable, solide et abordable, le saxophone alto Gear4music est un instrument id??al pour les d??butants complets et les joueurs de niveau interm??diaire. Il produit un son doux et offre une r??ponse au souffle id??ale pour d??velopper sa technique. Son robuste corps nervur?? a ??t?? con??u pour r??sister ?? une utilisation r??guli??re, ainsi qu'aux secousses induites par le transport. Le saxophone alto Gear4music est par ailleurs fourni avec une embouchure, un ??tui, une anche et une sangle, soit tout le n??cessaire pour vous permettre de commencer ?? jouer d??s sa r??ception.",
            "Rejoignez le elite... Gr??ce ?? un cours de ma??tre sur l'ing??niosit?? japonaise. C'est ce qui d??finit le Yanagisawa AWO20PG en rose gold. En comprenant les besoins des musiciens, Yanagisawa a su cr??er un saxophone alto en bronze dynamique pour ceux qui font partie du milieu professionnel.",
            "Entrez dans le monde de la musique. Commencez ?? vous d??velopper en tant que musicien d??s aujourd'hui avec le jSax de Nuvo. En suivant les doigt??s traditionnels du saxophone, le jSax permet aux enfants de d??velopper leur embouchure et leurs capacit??s de jeu d??s leur plus jeune ??ge. Dot?? d'un corps noir avec des garnitures noires, le jSax est garanti pour maintenir l'int??r??t des jeunes joueurs.",
            "Le saxophone soprano interm??diaire SP0201G est dot?? d'un corps en cuivre et produit un son rond, luxuriant et matur?? ?? un prix imbattable, et son action permet un jeu incroyablement simple. Sa finition au vernis ainsi que son motif grav?? ?? la main lui conf??rent une touche d'??l??gance.
        Le saxo soprano est livr?? avec un bocal droit et un bocal incurv?? vous permettant de jouer dans diff??rentes positions, un ??tui rigide de qualit??, une anche, une sangle, un chiffon et une brosse de nettoyage.",
            "Dot?? de 37 lames en acajou de haute qualit??, le xylophone 3 octaves produit un son chatoyant, id??al pour les ??coles et orchestres. Ses sonorit??s hautes en couleur lui permettront d'harmoniser les ensembles musicaux en tous genres. Facile ?? ranger et ?? transporter, le xylophone d'orchestre Gear4music est livr?? avec un ??tui de transport robuste, un support m??tallique pliant et une paire de mailloches, ainsi vous ne manquerez de rien pour commencer ?? jouer d??s la r??ception.",
            "Ce bouzouki ?? 8 cordes d'Ozark est dot?? d'un corps en forme de guitare unique qui produit un volume suppl??mentaire et un son riche. Il est ??quip?? d'une table en ??pic??a massif pour une grande production sonore et est ??quip?? d'un Fishmanunder saddle transducteur et d'un ??galiseur. Le manche de guitare de largeur r??guli??re rejoint le corps ?? la 14??me frette et comporte huit cordes en quatre rangs. Il s'agit d'un instrument de grande valeur fabriqu?? ?? partir de mat??riaux de haute qualit?? avec l'attention particuli??re port??e au design qui est une caract??ristique de tous les instruments Ozark.",
            "Le sitar Gear4music poss??de 7 cordes m??lodiques en acier qui surmontent ses frettes sur??lev??es, et 11 cordes sympathiques (taraf) qui, lorsqu'elles sont accord??es, vibrent en r??ponse aux vibration des cordes pinc??es. Les sons produits sont amplifi??s par sa caisse de r??sonance (kadu ka tumba) en bois. Cet instrument aux sonorit??s authentiques trouvera sa place au sein de n'importe quel ensemble de musique classique indienne.
        Fabriqu?? et d??cor?? ?? la main
        Fabriqu?? ?? la main par des techniciens experts au Royaume-Uni, ce sitar est un instrument unique, ?? l'apparence authentique et hautement d??corative. Ses chevilles (kunti) et son chevillier ont ??t?? soigneusement confectionn??s.",
            "L'??galiseur Seagull M4 Spruce EQ est con??u pour attirer l'attention des d??butants, des non-joueurs, des guitaristes et des amateurs de folk, offrant un instrument amusant, compact et portable qui est parfait pour les live arrangements, ainsi que pour cr??er de nouvelles m??lodies et des sons plus uniques et mondains. Avec une table en ??pic??a massif et un corps en ??rable massif, l'??galiseur Seagull M4 Spruce EQ produit un son clair, brillant et richement dynamique avec une r??ponse incroyablement polyvalente, beaucoup de mordant et un excellent sustain. De plus, le design de la Seagull M4 est bas?? sur le dulcimer traditionnel, mais est construit avec des techniques modernes pour une meilleure jouabilit?? et portabilit??. De plus, le Seagull M4 EQ est un instrument amusant, confortable et unique pour les d??butants et les guitaristes, ainsi que pour les amateurs de dulcimer qui recherchent un son distinct ?? ajouter ?? leur installation musicale. Enfin, cet instrument accrocheur est ??galement ??quip?? d'une ??lectronique en bande B et d'un syst??me embarqu??, id??al pour les live r??glages et les s??ances d'entra??nement amplifi??es.",
            "L'harmonica Blues Deluxe de Fender est id??al aussi bien pour les d??butants que pour les joueurs chevronn??s ! Cet harmonica en tonalit?? de Do b??n??ficie d'une construction robuste dans une forme traditionnelle et d??livre des sons lumineux avec une articulation nette. Il est livr?? avec un ??tui de protection. ",
            "Le tuba hybride en Si b??mol playLITE par Gear4music repr??sente une alternative l??g??re aux cuivres traditionnels. Dot?? d'un corps en plastique ABS, il est id??al pour les jeunes musiciens comme pour les professionnels ?? la recherche d'un instrument l??ger. Ses pistons rotatifs ?? rev??tement interne en aluminium offrent une jouabilit?? rapide et tr??s agr??able. Le tuba ?? 4 pistons playLITE demeure un instrument authentique, notamment gr??ce ?? sa forme traditionnelle qui d??gage un timbre r??aliste avec une projection claire. Le tuba playLITE est fourni avec une embouchure en plastique et un ??tui ?? mousse rigide.",
            "Avec ses 2,75 m??tres de longueur, le CFX est un piano ?? queue de concert ?? part enti??re, caract??ris?? par une vaste palette sonore et la facult?? de restituer les nuances d???expression les plus subtiles. Le son d??livr?? est riche sur l???ensemble des registres afin d'accompagner un orchestre symphonique dans les salles les plus vastes. Le CFX est le mod??le phare de Yamaha. Il marque une nouvelle ??tape dans l'histoire de la fabrication de piano de concert.",
            "Parfait ??quilibre entre richesse, chaleur, pr??cision et puissance, le S7X donne aux pianistes une infinie libert?? d???expression. Convient ?? la musique de chambre et aux grands salons. ",
            "Fabriqu?? avec un soin m??ticuleux ?? partir des mat??riaux les plus nobles, le mod??le YUS5 est un piano droit ?? l'allure raffin??e.",
            "Platine vinyle ?? entrainement direct", "Platine vinyle audiophile avec enregistrement Hi-Res", "Platine vinyle pro", "Contr??leur DJ 4 canaux et interface audio", "Contr??leur DJ non pro",
            "Casque DJ tr??s bonne qualit?? ?? usage pro", "Casque studio / DJ", "Casque loisir dj", "Table de mixage DJ analogique", "Table de mixage DJ loisir", "Battle Mixer", "Ensemble d'extensions logicielles Serato pour DJ Pro - T??l??chargement",
            "Ensemble effets sonors"
        ];


        $colors = [
            'charcoal frost', 'blood red', 'brown', 'black', 'black', 'red black', 'white', 'brown', 'red', 'black', 'black', 'wood', 'black ivory', 'gold', 'gold and black', 'gold pink',
            'black mat', 'gold pink', 'brown black', 'brown ligth', 'brown sugar', 'brown ligth', 'silver metal', 'black metal', 'black piano', 'black piano', 'Satin Walnut', 'black silver',
            'black walnut', 'black walnut', 'black', 'black', 'black', 'black', 'black', 'silver', 'black carbon', 'black', 'multi', 'black'
        ];


        $prices = [
            365.00, 499.00, 1099.99, 999.00, 249.50, 699.00, 589.00, 1439.89, 2899.00, 69.00, 110.00, 209.75, 235.25, 503.25, 349.99, 8345.99, 99.99, 443.00, 235.00, 750.00, 583.00, 355.00, 12.90, 990.99,
            153278.00, 72894.00, 16174.00, 777.00, 349.00, 2450.00, 745.00, 266.00, 189.00, 255.00, 35.00, 1555.00, 225.00, 1938.00, 279.00, 459.00
        ];

        for ($i = 0; $i < count($labels); $i++) {
            $extension = '.png';
            if ($i > 11) {
                $extension = '.jpg';
            }
            $randomChar = substr(str_shuffle("abcdefghijklmnopqrstuvwxyz"), 0, 4) . substr(str_shuffle("0123456789"), 0, 2);
            $stock = 160000 / $prices[$i];
            Product::create([
                'label' => $labels[$i],
                'ref' => $refs[$i],
                'picture' => $i + 1 . $extension,
                'description' => $descriptions[$i],
                'EAN' => "Code barre",
                'color' => $colors[$i],
                'unit_price_HT' => $prices[$i],
                'supply_ref' => $randomChar,
                'supply_product_name' => substr($labels[$i], -4, -1),
                'supply_unit_price_HT' => $prices[$i] * 0.8,
                'stock' => $stock,
                'stock_alert' => $stock > 1 ? $stock * 0.4 : 0,
            ]);
        }

    }
}
