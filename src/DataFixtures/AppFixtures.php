<?php

namespace App\DataFixtures;

use App\Entity\Biens;
use App\Entity\Categories;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Admin;

class AppFixtures extends Fixture
{
    
    public function load(ObjectManager $manager): void
    {
        $caterorie1 = new Categories();
        $caterorie1->setTitreCat('Terrain agricole');
        $manager->persist($caterorie1);

        $caterorie2 = new Categories();
        $caterorie2->setTitreCat('Prairie');
        $manager->persist($caterorie2);

        $caterorie3 = new Categories();
        $caterorie3->setTitreCat('Bois');
        $manager->persist($caterorie3);

        $caterorie4 = new Categories();
        $caterorie4->setTitreCat('Batiments');
        $manager->persist($caterorie4);

        $caterorie5 = new Categories();
        $caterorie5->setTitreCat('Exploitations');
        $manager->persist($caterorie5);

        $manager->flush();

        $bien = new Biens();
        $bien->setTitreBien('Vallons du Voironnais');
        $bien->setDescriptionBien('13 Ha de terrain');
        $bien->setLocalisationBien('38500');
        $bien->setSurfaceBien('13Ha');
        $bien->setPrixBien(2000);
        $bien->setCategorie($caterorie1);
        $bien->setTypeBien('Location');
        $bien->setImage('38TB22187.jpg');
        $manager->persist($bien);

        $bien = new Biens();
        $bien->setTitreBien('Situé à 15 minutes de Mende');
        $bien->setDescriptionBien('idéal pour polyculture sur 14 ha');
        $bien->setLocalisationBien('30430');
        $bien->setSurfaceBien('10Ha');
        $bien->setPrixBien(1300);
        $bien->setCategorie($caterorie1);
        $bien->setTypeBien('Location');
        $bien->setImage('48RE11201.jpg');
        $manager->persist($bien);

        $bien = new Biens();
        $bien->setTitreBien('PRET A USAGE sur 95 ha - PLAINE DES VOSGES ');
        $bien->setDescriptionBien(' A 5 min de Villeneuve-sur-Lot');
        $bien->setLocalisationBien('47300');
        $bien->setSurfaceBien('14Ha');
        $bien->setPrixBien(11000);
        $bien->setCategorie($caterorie1);
        $bien->setTypeBien('Location');
        $bien->setImage('47.06.098.jpg');
        $manager->persist($bien);

        $bien = new Biens();
        $bien->setTitreBien('Vittel Dombrot : Ouest vosgien, secteur de VITTEL');
        $bien->setDescriptionBien('Terrains d\'environ 6,5 ha');
        $bien->setLocalisationBien('88170');
        $bien->setSurfaceBien('6,5Ha');
        $bien->setPrixBien(-1);
        $bien->setCategorie($caterorie1);
        $bien->setTypeBien('Vente');
        $bien->setImage('88FB.jpg');
        $manager->persist($bien);

        $bien = new Biens();
        $bien->setTitreBien('Ancienne ferme équestre en ruine');
        $bien->setDescriptionBien('Terrains actuellement loués');
        $bien->setLocalisationBien('29510');
        $bien->setSurfaceBien('12Ha');
        $bien->setPrixBien(156000);
        $bien->setCategorie($caterorie1);
        $bien->setTypeBien('Vente');
        $bien->setImage('5667DB.jpg');
        $manager->persist($bien);

        $bien = new Biens();
        $bien->setTitreBien('Prairies orientées nord ouest');
        $bien->setDescriptionBien('Lot d\'un seul tenant');
        $bien->setLocalisationBien('56500');
        $bien->setSurfaceBien('11Ha');
        $bien->setPrixBien(113000);
        $bien->setCategorie($caterorie2);
        $bien->setTypeBien('Vente');
        $bien->setImage('765DN.jpg');
        $manager->persist($bien);

        $bien = new Biens();
        $bien->setTitreBien('Terrain proche cours d\'eau');
        $bien->setDescriptionBien('Non accessible par la route, uniquement chemin d`\'exploitation');
        $bien->setLocalisationBien('35200');
        $bien->setSurfaceBien('5,5Ha');
        $bien->setPrixBien(3000);
        $bien->setCategorie($caterorie2);
        $bien->setTypeBien('Location');
        $bien->setImage('76RZDC.jpg');
        $manager->persist($bien);

        $bien = new Biens();
        $bien->setTitreBien('Terrain avec abri');
        $bien->setDescriptionBien('Pour propriétaire équin');
        $bien->setLocalisationBien('44110');
        $bien->setSurfaceBien('1,2Ha');
        $bien->setPrixBien(1200);
        $bien->setCategorie($caterorie2);
        $bien->setTypeBien('Location');
        $bien->setImage('9875RDC.jpg');
        $manager->persist($bien);

        $bien = new Biens();
        $bien->setTitreBien('Légèrement en Pente');
        $bien->setDescriptionBien('Idéal paturage moutons');
        $bien->setLocalisationBien('22700');
        $bien->setSurfaceBien('3,4Ha');
        $bien->setPrixBien(2400);
        $bien->setCategorie($caterorie2);
        $bien->setTypeBien('Location');
        $bien->setImage('Z34.345.45.jpg');
        $manager->persist($bien);

        $bien = new Biens();
        $bien->setTitreBien('Productions végétales');
        $bien->setDescriptionBien('La parcelle se situe dans le Béarn sur la commune de LAGOR.');
        $bien->setLocalisationBien('64150');
        $bien->setSurfaceBien('2Ha');
        $bien->setPrixBien(7700);
        $bien->setCategorie($caterorie2);
        $bien->setTypeBien('Vente');
        $bien->setImage('64.02.59.jpg');
        $manager->persist($bien);

        $bien = new Biens();
        $bien->setTitreBien('Prairies sur les plateaux');
        $bien->setDescriptionBien('Parcelle de terre labourable d\'environ 2 ha');
        $bien->setLocalisationBien('81090');
        $bien->setSurfaceBien('76Ha');
        $bien->setPrixBien(400000);
        $bien->setCategorie($caterorie2);
        $bien->setTypeBien('Vente');
        $bien->setImage('7629CA.jpg');
        $manager->persist($bien);

        $bien = new Biens();
        $bien->setTitreBien('Prairies en pays glazik');
        $bien->setDescriptionBien('Usage petits animaux type caprins');
        $bien->setLocalisationBien('29510');
        $bien->setSurfaceBien('1ha22');
        $bien->setPrixBien(15000);
        $bien->setCategorie($caterorie2);
        $bien->setTypeBien('Vente');
        $bien->setImage('43LM220118.jpg');
        $manager->persist($bien);

        $bien = new Biens();
        $bien->setTitreBien('Terrain classé T4');
        $bien->setDescriptionBien('cloturé et partiellement boisé');
        $bien->setLocalisationBien('56500');
        $bien->setSurfaceBien('1,2Ha');
        $bien->setPrixBien(500);
        $bien->setCategorie($caterorie3);
        $bien->setTypeBien('Location');
        $bien->setImage('65.23.876.jpg');
        $manager->persist($bien);

        $bien = new Biens();
        $bien->setTitreBien('Sapinière');
        $bien->setDescriptionBien('Sapinière en cours de bail, cherche reprise');
        $bien->setLocalisationBien('35200');
        $bien->setSurfaceBien('1,8Ha');
        $bien->setPrixBien(800);
        $bien->setCategorie($caterorie3);
        $bien->setTypeBien('Location');
        $bien->setImage('344334UJ.jpg');
        $manager->persist($bien);

        $bien = new Biens();
        $bien->setTitreBien('Bois domainial');
        $bien->setDescriptionBien('Bois accessible avec sentiers');
        $bien->setLocalisationBien('44110');
        $bien->setSurfaceBien('32Ha');
        $bien->setPrixBien(12000);
        $bien->setCategorie($caterorie3);
        $bien->setTypeBien('Location');
        $bien->setImage('QDSGF56.jpg');
        $manager->persist($bien);

        $bien = new Biens();
        $bien->setTitreBien('Idéal société de chasse');
        $bien->setDescriptionBien('Terrain boisé classé ONF');
        $bien->setLocalisationBien('22700');
        $bien->setSurfaceBien('35Ha');
        $bien->setPrixBien(120000);
        $bien->setCategorie($caterorie3);
        $bien->setTypeBien('Vente');
        $bien->setImage('313453DR.jpg');
        $manager->persist($bien);

        $bien = new Biens();
        $bien->setTitreBien('Bois sur pied');
        $bien->setDescriptionBien('Diverses essences sur place');
        $bien->setLocalisationBien('29510');
        $bien->setSurfaceBien('6Ha');
        $bien->setPrixBien(30000);
        $bien->setCategorie($caterorie3);
        $bien->setTypeBien('Vente');
        $bien->setImage('345E7EG.jpg');
        $manager->persist($bien);

        $bien = new Biens();
        $bien->setTitreBien('Secteur du Ségala-Viaur');
        $bien->setDescriptionBien('les secteurs les plus en pente sont empiérés');
        $bien->setLocalisationBien('12200');
        $bien->setSurfaceBien('54Ha');
        $bien->setPrixBien(400000);
        $bien->setCategorie($caterorie3);
        $bien->setTypeBien('Vente');
        $bien->setImage('81EL11100.jpg');
        $manager->persist($bien);

        $bien = new Biens();
        $bien->setTitreBien('Propriété Lozère');
        $bien->setDescriptionBien('Ensemble bâti avec environ 1ha55');
        $bien->setLocalisationBien('48370');
        $bien->setSurfaceBien('1Ha55');
        $bien->setPrixBien(700);
        $bien->setCategorie($caterorie4);
        $bien->setTypeBien('Location');
        $bien->setImage('48EL11345.jpg');
        $manager->persist($bien);

        $bien = new Biens();
        $bien->setTitreBien('Propriété Creuse');
        $bien->setDescriptionBien('Dans un hameau à moins de 10 minutes d\'un bourg avec services et commerces, et d\'un village ayant un intérêt touristique sur les routes de St-Jacques-de-Compostelle.');
        $bien->setLocalisationBien('23320');
        $bien->setSurfaceBien('1Ha55');
        $bien->setPrixBien(860);
        $bien->setCategorie($caterorie4);
        $bien->setTypeBien('Location');
        $bien->setImage('23.16.104.jpg');
        $manager->persist($bien);

        $bien = new Biens();
        $bien->setTitreBien('Propriété située dans un secteur vallonné');
        $bien->setDescriptionBien('Propriété Pyrénées-Atlantiques');
        $bien->setLocalisationBien('23500');
        $bien->setSurfaceBien('6Ha');
        $bien->setPrixBien(650);
        $bien->setCategorie($caterorie4);
        $bien->setTypeBien('Location');
        $bien->setImage('64.03.60.jpg');
        $manager->persist($bien);

        $bien = new Biens();
        $bien->setTitreBien('Bâtiments avicoles à transmettre');
        $bien->setDescriptionBien('Site avicole à transmettre sur la commune de Nort-sur-Erdre, au nord de Nantes.');
        $bien->setLocalisationBien('44220');
        $bien->setSurfaceBien('2Ha');
        $bien->setPrixBien(200000);
        $bien->setCategorie($caterorie4);
        $bien->setTypeBien('Vente');
        $bien->setImage('4422AN08.jpg');
        $manager->persist($bien);

        $bien = new Biens();
        $bien->setTitreBien('Propriété viticole et sa cave');
        $bien->setDescriptionBien('Au coeur de l\'appellation Saint-Chinian');
        $bien->setLocalisationBien('34280');
        $bien->setSurfaceBien('30Ha');
        $bien->setPrixBien(1500000);
        $bien->setCategorie($caterorie4);
        $bien->setTypeBien('Vente');
        $bien->setImage('34VI6979.jpg');
        $manager->persist($bien);

        $bien = new Biens();
        $bien->setTitreBien('Tourisme rural-hébergement');
        $bien->setDescriptionBien('Au nord de l\'Hérault, proche des axes routiers et à 45 minutes de Montpellier');
        $bien->setLocalisationBien('34070');
        $bien->setSurfaceBien('1Ha90');
        $bien->setPrixBien(1490000);
        $bien->setCategorie($caterorie4);
        $bien->setTypeBien('Vente');
        $bien->setImage('34AG10897.jpg');
        $manager->persist($bien);

        $bien = new Biens();
        $bien->setTitreBien('Propriété Gard');
        $bien->setDescriptionBien('Ensemble immobilier proche d\'un plan d\'eau aménagé');
        $bien->setLocalisationBien('34290');
        $bien->setSurfaceBien('29Ha');
        $bien->setPrixBien(2000);
        $bien->setCategorie($caterorie5);
        $bien->setTypeBien('Location');
        $bien->setImage('30VI9700.jpg');
        $manager->persist($bien);

        $bien = new Biens();
        $bien->setTitreBien('FERME 100% HERBAGERE/ ELEVAGE LAITIER');
        $bien->setDescriptionBien('Située à l\'orée d\'un bourg, à 10 minutes des services et commerces.');
        $bien->setLocalisationBien('35200');
        $bien->setSurfaceBien('34Ha');
        $bien->setPrixBien(950);
        $bien->setCategorie($caterorie5);
        $bien->setTypeBien('Location');
        $bien->setImage('19.07.118.jpg');
        $manager->persist($bien);

        $bien = new Biens();
        $bien->setTitreBien('Propriété Meuse');
        $bien->setDescriptionBien('FERME DE COURUPT : Secteur Sainte-Menehould / Clermont-en-Argonne / Revigny');
        $bien->setLocalisationBien('88340');
        $bien->setSurfaceBien('59Ha');
        $bien->setPrixBien(-1);
        $bien->setCategorie($caterorie5);
        $bien->setTypeBien('Location');
        $bien->setImage('55VS.jpg');
        $manager->persist($bien);

        $bien = new Biens();
        $bien->setTitreBien('Propriété Calvados');
        $bien->setDescriptionBien('JFD : Noue de Sienne (14)');
        $bien->setLocalisationBien('14380');
        $bien->setSurfaceBien('17Ha');
        $bien->setPrixBien(173440);
        $bien->setCategorie($caterorie5);
        $bien->setTypeBien('Vente');
        $bien->setImage('MQ14170356 .jpg');
        $manager->persist($bien);

        $bien = new Biens();
        $bien->setTitreBien('Activités Equestres, Apiculture, Chasse,');
        $bien->setDescriptionBien('Propriété Charente-Maritime');
        $bien->setLocalisationBien('17200');
        $bien->setSurfaceBien('17Ha');
        $bien->setPrixBien(330000);
        $bien->setCategorie($caterorie5);
        $bien->setTypeBien('Vente');
        $bien->setImage('17.03.017.jpg');
        $manager->persist($bien);

        $bien = new Biens();
        $bien->setTitreBien('Exploitation Agricole spécialisée en polyculture élevage');
        $bien->setDescriptionBien('Exploitation située dans le Sud Est de La Sarthe, entre la commune d\'Ecommoy (72220) et Sarcé (72327)');
        $bien->setLocalisationBien('72220');
        $bien->setSurfaceBien('87Ha');
        $bien->setPrixBien(-1);
        $bien->setCategorie($caterorie5);
        $bien->setTypeBien('Vente');
        $bien->setImage('AA72220088RB.jpg');
        $manager->persist($bien);

        $admin = new Admin();
        $admin->setNomAdm('Admin');
        $admin->setPrenomAdm('Admin');
        $admin->setEmailAdm('admin@safer.fr');
        $admin->setMdpAdm('$2y$13$TsJ.EWo7HA136WrG5DE1NOW/cemJkpJvMBkPEQVOT0GrBcwHCs2re');
        $admin->setRoles('["ROLE_ADMIN"]');
        $manager->persist($admin);
        //$2y$13$BqAi9d2BLyNUih5uCPVhpeZ510ZTK3K1TD0zju91t/xtqHr2MHtDe

        /*"INSERT INTO admin (id, nom_adm, prenom_adm, email_adm, mdp_adm) \
>>   VALUES (nextval('admin_id_seq'), 'admin', 'admin','admin@safer.fr', \
>>   '\$argon2id\$v=19\$m=65536,t=4,p=1\$BQG+jovPcunctc30xG5PxQ\$TiGbx451NKdo+g9vLtfkMy4KjASKSOcnNxjij4gTX1s')"*/
        $manager->flush();
    }
}
