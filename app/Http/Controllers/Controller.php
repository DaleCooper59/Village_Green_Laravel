<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Category;
use App\Models\City;
use App\Models\Company;
use App\Models\Country;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\Order;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function test(){
        $product = Product::all();
        $owner = Company::find(1);
        return view('test', compact('product'));
    }

    public function factories(){
       
        User::factory()->count(3)->create();
        Country::factory()->count(3)->create();
        City::factory()->count(3)->create();
        Address::factory()->count(3)->create();
        Company::factory()->count(3)->create();
        Customer::factory()->count(3)->create();
        Employee::factory()->count(3)->create();
        Supplier::factory()->count(3)->create();

    }

    public function insertCategories(){
        $categories = ['Bois', 'Claviers', 'Cordes', 'Cuivres', 'Percussions', 'Batteries', 'Guitares', 'Sono', 'Accessoires',
         'Basse', 'Electrique', 'Accoustique', 'clavier électronique & synthétiseur', 'Piano droit', 'Piano premium', 'Violon',
          'Saxophone', 'Batterie', 'Pad', 'Xylophone', 'Sitar', 'Harmonica', 'Platine vinyle', 'Contrôleur', 'Casque', 'Table de mixage', 'Logiciel', 'effet sonore'];

          for ($i=0; $i < count($categories); $i++) {
            
             Category::create([
                 'parent_id' => null,
                 'name' => $categories[$i],
             ]);
         }
    }

    public function insertTags(){
        $tags = ['En cours de Livraison','Livré', 'En préparation', 'Stock critique', 'Stock bas', 'En stock'];

          for ($i=0; $i < count($tags); $i++) {
             Tag::create([
                 'name' => $tags[$i],
                 'color' => '#e2e2e2',
             ]);
         }
    }

    public function insertProduct(){
        $labels = ['Guitarre électrique Strat Sterling','Guitarre électrique Ltd mh200','Guitarre électrique sterling jason richardson natural poplar','Batterie pearl decade maple jazz 18inch','Batterie debut kit',
        'Nord Drum 3p - Pad de percussion électronique à modélisation','korg piano b2sp','korg piano g1b air br','nord piano 5 73','m-audio axiom air mini 32','m-audio oxygen pro mini','violon archer 44v-500',
        'stagg shaped violon electrique','elkhart 100AS alto saxophone','noir et or alto saxophone','yanagisawa awo20pg','nuvo jsax 2.0','rosedale saxophone soprano','xylophone 3 octaves','ozark 2246 bouzouki guitarre accoustique',
        "sitar chevillier courbe à tête d\'oiseau", "seagull m4 spruce eq dulcimer","harmonica","tuba hybride playlite","CFX Yamaha piano premium","S7X Yamaha piano premium","YUS5 Yamaha piano droit",
        "Thorens TD 402 DD","Pro-Ject Debut RecordMaster II","Thorens TD 1600","Native Instruments Traktor S4 MK3","Native Instruments Traktor S2 MK3 Bundle","Sennheiser HD-25 Plus",
        "Audio-Technica ATH-M70 X","the t.bone HD 1500","Allen & Heath Xone 96","Behringer DX2000USB","Rane Seventy-Two MKII","Serato DJ Expansions","Boss RC-505 Bundle"];


        $refs = ['GUIT01','GUIT02','GUIT03','BAT01','BAT02','BAT03','PIAN01','PIAN02','PIAN03','PIAN04','PIAN05','VIO01','VIO02','SAX01','SAX02','SAX03','SAX04','SAX05','XYL01','GUIT04','GUIT05','GUIT06',
        'HARM01','CUIV01','PIAN06','PIAN07','PIAN08','DJ01', 'DJ02', 'DJ03', 'DJ04', 'DJ05', 'DJ06', 'DJ07', 'DJ08', 'DJ09', 'DJ10', 'DJ11', 'DJ12', 'DJ13'];


        $descriptions = ["Inspirée des guitares vintages mais agrémentée de caractéristiques modernes, la Cutlass CT30 offre un son intemporel dans la paume de vos mains. La guitare dispose d\'une configuration de micros HSS ou SSS avec un switch 5 positions et un trémolo de style vintage. Disponible en Fiesta Red (SSS), Charcoal Frost (SSS), Daphne Blue (SSS), Vintage Cream (HSS) et Stealth Black (HSS).",
        "Magnifique guitarre electrique rouge flamboyante","Suite à la popularité du modèle emblématique de Jason Richardson sorti en 2019, Sterling présente maintenant la nouvelle Richardson Cutlass pour les guitaristes plus traditionnels. Dotée d'une corne inférieure profilée personnalisée pour l'accès aux frettes, d’un manche en érable torréfié avec touche en palissandre et d’une table en loupe de peuplier, cette Cutlass reprend tous les composants de l'originale mais dans une configuration 6 cordes. Cela comprend également deux humbuckers à haut rendement, un boost de 12 dB «Push-Push», une tonalité «Push-Push» coil-tap et un tremolo moderne.",
        "Avec la Decade, on entre dans la catégorie où un batteur peut réellement commencer à faire sonner la batterie dans sa globalité, en termes de nuances de frappes, de possibilités d’accordages et d’homogénéité entre la caisse claire, la grosse caisse et les toms... Sur la durée, en changeant les peaux, on pourra même encore élargir le champ des possibles. Cela dit, avec les Remo Clear UT fournies - en particulier pour la grosse caisse de 18 x 14 pouces dotée d’une Powerstroke 3 et d’une peau de résonance percée - et la peau sablée pour la caisse claire, on a déjà de quoi se régaler. Et bien au-delà d’une décade ! ",
        "Alesis s'est associé à Melodics afin de fournir 60 leçons gratuites pour PC ou tablette. Melodics™ est une application qui permet d'améliorer son timing, d'élargir son vocabulaire rythmique.",
        "Ne cherchez pas les échantillons de sons percussifs, il n'y en a pas ! En effet le moteur de synthèse du Nord Drum 3 P est entièrement tourné vers la modélisation analogique et s'il ne contient aucun des sons de percussion habituels, il s’avère l'appareil idéal pour jouer des sons électro. Vous accédez à diverses formes d'ondes analogiques de base, à des enveloppes, filtres et effets et tout cela en temps réel. Bien entendu, vous disposez tout de même de présets entièrement modifiables pour initier vos propres programmations. Vous l'aurez compris, ce Nord Drum 3P est aux pads électroniques ce qu'un clavier Nord Lead est aux synthétiseurs. Le mieux-disant… ",
        "Une qualité acoustique due à sa technologie d'échantillonnage stéréo. S'y ajoutent la restitution du bruit généré par le relâchement de la pédale et même les résonances sympathiques des cordes ! Compact et bien pensé, il se montre idéal pour les apprentis pianistes ou les amateurs en quête d'un piano numérique de qualité pour leur domicile ou leur résidence secondaire.",
        "La sonorité d’une note de piano est exceptionnellement riche et sophistiquée. Les pianistes peuvent en moduler le volume ainsi que le timbre en fonction de l’impulsion qu'ils exercent sur les touches. Le G1-Air dispose d'échantillons très longs, soigneusement enregistrés et les reproduit avec tous leurs détails. Il utilise en outre des technologies exclusives du Kronos pour délivrer des transitions douces entre chaque note jouée.",
        "La technologie unique Virtual Hammer Action, associée aux mouvements physiques du marteau, offre une authenticité et une réponse dynamique exceptionnelles, ce qui se traduit par une action de clavier qui gère le jeu dynamique avec un contrôle incroyable à tous les niveaux de vélocité.",
        "M-Audio a ainsi réussi l'exploit de loger dans un clavier compact, 32 touches et 8 pads, tous sensibles à la vélocité, mais aussi 8 potentiomètres librement assignables aux numéros de contrôleurs Midi de votre choix, des touches de transport et de déplacement de curseur, de pitchbend et de modulation, de sustain et de changement d'octave. Le mieux, dans tout ça, c'est qu’en dépit des dimensions réduites de l'AirMini32, la disposition de tous ces atouts est parfaitement claire, ce qui lui confère une ergonomie irréprochable. ",
        "Vous avez envie de rejoindre le camp des professionnels avec un clavier de qualité, proposant de nombreuses fonctionnalités et un minimum de tracas de programmation de nombreux logiciels ? Alors la gamme des claviers-maîtres Oxygen Pro de M-Audio est faite pour vous. L'Oxygen Pro Mini, version à 32 touches au format mini, met à votre disposition une quantité impressionnante de fonctionnalités et une suite logicielle très complète pour booster votre créativité, ainsi qu'un workflow très intuitif vous permettant de vous concentrer sur la seule chose qui importe : votre créativité.",
        "Vous êtes à la recherche d'un instrument répondant aux exigences de votre apprentissage en constante évolution ? Ne cherchez plus, l'Archer 44V-500 de taille 4/4 est la réponse à vos prières. Cet instrument en bois massif est livré avec son archet en bois de feuillus et un étui rigide léger, soit tout ce qu'il vous faut pour passer au niveau suivant.",
        "Commencez à expérimenter avec votre son dès aujourd'hui ! Le violon électrique Stagg Shaped est un moyen abordable d'amplifier votre son. Doté d'une silhouette de contemporary violon à côté d'un Noir brillantfinition, le violon électrique Stagg est vraiment un instrument qui fait tourner les têtes.",
        "Ce saxophone Elkhart est un excellent achat pour ceux à la recherche de leur premier instrument. Il possède une superbe intonation, un mécanisme utile et facile d’utilisation ainsi qu’un prix attractif ce qui en fait un saxophone alto d’étude fantastique. Le corps en cuivre jaune du 100AS saxophone alto est renforcé avec des rainures ce qui le rend plus résistant et adapté à une pratique fréquente. La conception solide de ce saxophone en fait l’instrument idéal pour les joueurs intermédiaires et professionnels qui ont besoin d’un instrument de rechange avec un excellent rapport qualité/prix.",
        "Fiable, solide et abordable, le saxophone alto Gear4music est un instrument idéal pour les débutants complets et les joueurs de niveau intermédiaire. Il produit un son doux et offre une réponse au souffle idéale pour développer sa technique. Son robuste corps nervuré a été conçu pour résister à une utilisation régulière, ainsi qu'aux secousses induites par le transport. Le saxophone alto Gear4music est par ailleurs fourni avec une embouchure, un étui, une anche et une sangle, soit tout le nécessaire pour vous permettre de commencer à jouer dès sa réception.",
        "Rejoignez le elite... Grâce à un cours de maître sur l'ingéniosité japonaise. C'est ce qui définit le Yanagisawa AWO20PG en rose gold. En comprenant les besoins des musiciens, Yanagisawa a su créer un saxophone alto en bronze dynamique pour ceux qui font partie du milieu professionnel.",
        "Entrez dans le monde de la musique. Commencez à vous développer en tant que musicien dès aujourd'hui avec le jSax de Nuvo. En suivant les doigtés traditionnels du saxophone, le jSax permet aux enfants de développer leur embouchure et leurs capacités de jeu dès leur plus jeune âge. Doté d'un corps noir avec des garnitures noires, le jSax est garanti pour maintenir l'intérêt des jeunes joueurs.",
        "Le saxophone soprano intermédiaire SP0201G est doté d'un corps en cuivre et produit un son rond, luxuriant et maturé à un prix imbattable, et son action permet un jeu incroyablement simple. Sa finition au vernis ainsi que son motif gravé à la main lui confèrent une touche d'élégance.
        Le saxo soprano est livré avec un bocal droit et un bocal incurvé vous permettant de jouer dans différentes positions, un étui rigide de qualité, une anche, une sangle, un chiffon et une brosse de nettoyage.",
        "Doté de 37 lames en acajou de haute qualité, le xylophone 3 octaves produit un son chatoyant, idéal pour les écoles et orchestres. Ses sonorités hautes en couleur lui permettront d'harmoniser les ensembles musicaux en tous genres. Facile à ranger et à transporter, le xylophone d'orchestre Gear4music est livré avec un étui de transport robuste, un support métallique pliant et une paire de mailloches, ainsi vous ne manquerez de rien pour commencer à jouer dès la réception.",
        "Ce bouzouki à 8 cordes d'Ozark est doté d'un corps en forme de guitare unique qui produit un volume supplémentaire et un son riche. Il est équipé d'une table en épicéa massif pour une grande production sonore et est équipé d'un Fishmanunder saddle transducteur et d'un égaliseur. Le manche de guitare de largeur régulière rejoint le corps à la 14ème frette et comporte huit cordes en quatre rangs. Il s'agit d'un instrument de grande valeur fabriqué à partir de matériaux de haute qualité avec l'attention particulière portée au design qui est une caractéristique de tous les instruments Ozark.",
        "Le sitar Gear4music possède 7 cordes mélodiques en acier qui surmontent ses frettes surélevées, et 11 cordes sympathiques (taraf) qui, lorsqu'elles sont accordées, vibrent en réponse aux vibration des cordes pincées. Les sons produits sont amplifiés par sa caisse de résonance (kadu ka tumba) en bois. Cet instrument aux sonorités authentiques trouvera sa place au sein de n'importe quel ensemble de musique classique indienne.
        Fabriqué et décoré à la main
        Fabriqué à la main par des techniciens experts au Royaume-Uni, ce sitar est un instrument unique, à l'apparence authentique et hautement décorative. Ses chevilles (kunti) et son chevillier ont été soigneusement confectionnés.",
        "L'égaliseur Seagull M4 Spruce EQ est conçu pour attirer l'attention des débutants, des non-joueurs, des guitaristes et des amateurs de folk, offrant un instrument amusant, compact et portable qui est parfait pour les live arrangements, ainsi que pour créer de nouvelles mélodies et des sons plus uniques et mondains. Avec une table en épicéa massif et un corps en érable massif, l'égaliseur Seagull M4 Spruce EQ produit un son clair, brillant et richement dynamique avec une réponse incroyablement polyvalente, beaucoup de mordant et un excellent sustain. De plus, le design de la Seagull M4 est basé sur le dulcimer traditionnel, mais est construit avec des techniques modernes pour une meilleure jouabilité et portabilité. De plus, le Seagull M4 EQ est un instrument amusant, confortable et unique pour les débutants et les guitaristes, ainsi que pour les amateurs de dulcimer qui recherchent un son distinct à ajouter à leur installation musicale. Enfin, cet instrument accrocheur est également équipé d'une électronique en bande B et d'un système embarqué, idéal pour les live réglages et les séances d'entraînement amplifiées.",
        "L'harmonica Blues Deluxe de Fender est idéal aussi bien pour les débutants que pour les joueurs chevronnés ! Cet harmonica en tonalité de Do bénéficie d'une construction robuste dans une forme traditionnelle et délivre des sons lumineux avec une articulation nette. Il est livré avec un étui de protection. ",
        "Le tuba hybride en Si bémol playLITE par Gear4music représente une alternative légère aux cuivres traditionnels. Doté d'un corps en plastique ABS, il est idéal pour les jeunes musiciens comme pour les professionnels à la recherche d'un instrument léger. Ses pistons rotatifs à revêtement interne en aluminium offrent une jouabilité rapide et très agréable. Le tuba à 4 pistons playLITE demeure un instrument authentique, notamment grâce à sa forme traditionnelle qui dégage un timbre réaliste avec une projection claire. Le tuba playLITE est fourni avec une embouchure en plastique et un étui à mousse rigide.",
        "Avec ses 2,75 mètres de longueur, le CFX est un piano à queue de concert à part entière, caractérisé par une vaste palette sonore et la faculté de restituer les nuances d’expression les plus subtiles. Le son délivré est riche sur l’ensemble des registres afin d'accompagner un orchestre symphonique dans les salles les plus vastes. Le CFX est le modèle phare de Yamaha. Il marque une nouvelle étape dans l'histoire de la fabrication de piano de concert.",
        "Parfait équilibre entre richesse, chaleur, précision et puissance, le S7X donne aux pianistes une infinie liberté d’expression. Convient à la musique de chambre et aux grands salons. ",
        "Fabriqué avec un soin méticuleux à partir des matériaux les plus nobles, le modèle YUS5 est un piano droit à l'allure raffinée.",
        "Platine vinyle à entrainement direct","Platine vinyle audiophile avec enregistrement Hi-Res","Platine vinyle pro","Contrôleur DJ 4 canaux et interface audio","Contrôleur DJ non pro",
        "Casque DJ très bonne qualité à usage pro","Casque studio / DJ","Casque loisir dj","Table de mixage DJ analogique","Table de mixage DJ loisir","Battle Mixer","Ensemble d'extensions logicielles Serato pour DJ Pro - Téléchargement",
        "Ensemble effets sonors"];


        $colors = ['charcoal frost' ,'blood red' ,'brown' ,'black' ,'black' ,'red black' ,'white' ,'brown' ,'red' , 'black' ,'black' ,'wood' ,'black ivory' ,'gold' ,'gold and black', 'gold pink' ,
            'black mat' ,'gold pink' ,'brown black','brown ligth' ,'brown sugar' ,'brown ligth' ,'silver metal' ,'black metal' ,'black piano' ,'black piano' ,'Satin Walnut' ,'black silver' ,
            'black walnut' ,'black walnut' ,'black' ,'black' ,'black' ,'black' ,'black' ,'silver' ,'black carbon' ,'black' , 'multi' ,'black'];


        $prices = [365.00,499.00, 1099.99, 999.00,249.50, 699.00,589.00,1439.89,2899.00,69.00,110.00,209.75,235.25,503.25,349.99,8345.99,99.99,443.00, 235.00,750.00,583.00,355.00,12.90,990.99,
        153278.00,72894.00,16174.00,777.00,349.00,2450.00,745.00,266.00,189.00,255.00,35.00,1555.00,225.00,1938.00,279.00,459.00];
    
        for ($i=0; $i < count($labels); $i++) {
           $randomChar = substr(str_shuffle("abcdefghijklmnopqrstuvwxyz"),0,4) . substr(str_shuffle("0123456789"),0,2);
           $stock = 160000/$prices[$i];
            Product::create([
                'label' => $labels[$i],
                'ref' => $refs[$i],
                'picture' => $i,
                'description' => $descriptions[$i],
                'EAN' => "Code barre",
                'color' => $colors[$i],
                'unit_price_HT' => $prices[$i],
                'supply_ref' => $randomChar,
                'supply_product_name' => substr($labels[$i],-4,-1),
                'supply_unit_price_HT' => $prices[$i]*0.8,
                'stock' => $stock,
                'stock_alert' => $stock > 1 ? $stock * 0.4 : 0,
            ]);
        }
        
    }
    
}


