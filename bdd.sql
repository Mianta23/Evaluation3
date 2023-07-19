create database hopital;
\c hopital;

create table administrateur(
    idAdminserial serial primary key not null,
    nomAdmin varchar,
    email varchar,
    mdp varchar
);

insert into administrateur(nomAdmin,email,mdp) values ('admin','admin@gmail.com','admin');

create table utilisateur(
    idUtilisateur serial primary key not null,
    nomUtilisateur varchar,
    email varchar,
    mdp varchar
);
insert into utilisateur(nomUtilisateur,email,mdp) values ('utilisateur','utilisateur@gmail.com','utilisateur');

create table patient(
    idpatient serial primary key not null,
    nom varchar,
    dateNaissance date,
    sexe varchar,
    remboursement boolean
);
-- insert into patient(nom,dateNaissance,sexe,remboursement)values('Ravao','2002-05-05','F',true),('Rasoa','2002-05-05','F',false),('Rabe','2002-05-05','M',true),('Rakoto','2002-05-05','M',false);

create table typerecette(
    idtyperecette serial primary key not null,
    nom varchar,
    typedate varchar,
    budget decimal(15,2),
    code varchar,
    etat int default 1
);
--insert into typerecette(nom,typedate,budget,code)values('consulatation','jour',1000.00,'CON'),('operation','jour',1000,'OPE'),('medicament','jour',1000,'MED'),('analyse','jour',1000,'ANA'),('chambre','jour',1000,'CHA');

create table facture_recette(
    idfacturerecette serial primary key not null,
    idpatient int references patient(idpatient),
    datefacturerecette date,
    etat int default 1

);
-- insert into facture_recette(idpatient,datefacturerecette) values(1,'2023-07-16');

--view facture_recette
create or replace view v_facturerecette as
select fr.idfacturerecette,p.nom,fr.datefacturerecette from facture_recette fr join patient p on fr.idpatient=p.idpatient;



create table recette(
    idrecette serial primary key not null,
    idtyperecette int references typerecette(idtyperecette),
    montant decimal(10,2),
    nombre int default 1,
    idfacturerecette int references facture_recette(idfacturerecette),
    etat int default 1
);
-- insert into recette (idtyperecette,montant,nombre,idfacturerecette)values(1,20000.00,1,1);

--view recette
create or replace view v_recette as
select r.idrecette,tr.idtyperecette,tr.code,tr.nom as acte,tr.typedate,r.montant,r.nombre,p.nom as nom_patient,fr.idfacturerecette,fr.datefacturerecette,(r.montant*r.nombre)as montant_total
from recette r join typerecette tr on r.idtyperecette=tr.idtyperecette join facture_recette fr on fr.idfacturerecette=r.idfacturerecette join patient p on p.idpatient=fr.idpatient;



create table typedepense(
     idtypedepense serial primary key not null,
    nom varchar,
    typedate varchar,
    budget decimal(15,2),
    code varchar,
    etat int default 1
);
-- insert into typedepense(nom,typedate,budget,code)values('loyer','mois',1000,'LOY'),('salaire','mois',1000,'SAL');

create table depense(
    iddepense serial primary key not null,
    datedepense date,
    idtypedepense int references typedepense(idtypedepense),
    montant decimal(15,2),
    nombre int default 1,
    etat int default 1
);
-- insert into depense(datedepense,idtypedepense,montant,nombre)values('2023-07-07',1,200000.00,4);



--view depense
create or replace view v_depense as
select d.iddepense,td.idtypedepense,td.code,td.nom,td.typedate, d.montant,d.nombre,d.datedepense,(d.montant*d.nombre)as montant_total
from typedepense td join depense d
on td.idtypedepense=d.idtypedepense;



--TABLEAU DE BORD
-- view pour afficher les mois dans depense
create or replace view v_date_depense as
select
    extract(year from datedepense)as annee,
    extract(month from datedepense)as mois,
    td.idtypedepense,
    td.nom,
    round(td.budget/12,2) as budget
from depense d
cross join typedepense td
group by annee,mois,td.idtypedepense;

-- view pour afficher les mois dans recette
create or replace view v_date_recette as
select
    extract(year from datefacturerecette)as annee,
    extract(month from datefacturerecette)as mois,
    tr.idtyperecette,
    tr.nom,
    round(tr.budget/12,2) as budget
from v_recette vr
cross join typeRecette tr
group by annee,mois,tr.idtyperecette;

-- vue tableau de bord recette
create or replace view vue_bord_recette as
select
    vdr.annee,
    vdr.mois,
    vdr.idtyperecette,
    vdr.nom,
    coalesce(sum(montant_total),0) as reel,
    vdr.budget,
    coalesce(round(sum(montant_total)*100/vdr.budget,0),0) as realisation
from v_date_recette as vdr left join v_recette as vr
on vdr.idtyperecette=vr.idtyperecette
    and vdr.annee=extract(year from datefacturerecette)
    and vdr.mois=extract(month from datefacturerecette)
group by vdr.annee,vdr.mois,vdr.idtyperecette,vdr.nom,vdr.budget;



--ETO ZA IZAO
--vue tableau de bord depense
create or replace view vue_bord_depense as
select
    vdd.annee,
    vdd.mois,
    vdd.idtypedepense,
    vdd.nom,
    coalesce(sum(montant_total),0) as reel,
    vdd.budget,
    coalesce(round(sum(montant_total)*100/vdd.budget,0),0) as realisation
from v_date_depense as vdd left join v_depense as vd
on vdd.idtypedepense=vd.idtypedepense
    and vdd.annee=extract(year from datedepense)
    and vdd.mois=extract(month from datedepense)
group by vdd.annee,vdd.mois,vdd.idtypedepense,vdd.nom,vdd.budget;

-- vue tableau de bord benefice tsy mitambatra
create or replace view vue_benefice as
select
mois,
annee,
sum(reel) as recette,
(select sum(budget) from v_date_recette group by mois,annee limit 1) as budget_recette,
0 as depense,
(select sum(budget) from v_date_depense group by mois,annee limit 1) as budget_depense,
round(sum(reel)*100/sum(budget),0) as realisation_recette,
0 as realisation_depense
from vue_bord_recette
group by mois,annee
union
select
mois,
annee,
0 as recette,
(select sum(budget) from v_date_recette group by mois,annee limit 1) as budget_recette,
sum(reel) as depense,
(select sum(budget) from v_date_depense group by mois,annee limit 1) as budget_depense,
0 as realisation_recette,
round(sum(reel)*100/sum(budget),0) as realisation_depense
from vue_bord_depense
group by mois,annee;

-- vue tableau de bord benefice final
create or replace view vue_bord_benefice as
select mois,annee,sum(recette) recette,budget_recette,sum(depense) depense, budget_depense,sum(realisation_recette) realisation_recette,sum(realisation_depense) realisation_depense
from vue_benefice
group by mois,annee,budget_recette,budget_depense;


























-- -- vue tableau de bord  depense_recette
-- create or replace view v_depense_recette as
-- select extract(year from datefacturerecette)as annee,extract(month from datefacturerecette)as mois , sum(montant)as recette,0 as depense
-- from v_recette
-- group by mois,extract(year from datefacturerecette)
-- union
-- select extract(year from datedepense)as annee,extract(month from datedepense)as mois , 0 as recette,sum(montant)as depense
-- from v_depense
-- group by mois,extract(year from datedepense);

-- -- vue final tableau de bord budget par mois
-- create or replace view v_budget_mois as
-- select annee,mois,sum(recette) as recette,sum(depense) as depense,(sum(recette)-sum(depense)) as total
-- from v_depense_recette
-- group by mois, annee;

-- --essai
-- --vue tb recette
-- select acte,sum(montant)as recette_reel,(tr.budget/12)as budget,extract(year from datefacturerecette)as annee,extract(month from datefacturerecette)as mois
-- from v_recette JOIN typerecette tr on v_recette.idtyperecette=tr.idtyperecette
-- group by acte,budget,mois,extract(year from datefacturerecette);

-- --vue tb depense
-- select extract(year from datedepense)as annee,extract(month from datedepense)as mois , 0 as recette,sum(montant)as depense
-- from v_depense
-- group by mois,extract(year from datedepense);



-- --view statistique depense par mois
-- create or replace view v_statistique_depense_mois as
-- SELECT
--   EXTRACT(YEAR FROM datedepense) AS annee,
--   EXTRACT(MONTH FROM datedepense) AS mois,
--   SUM(montant) AS somme_montant
-- FROM
--   depense
-- GROUP BY
--   annee, mois
-- ORDER BY
--   annee, mois;

-- -- view ssum notant total recette/mois
-- CREATE OR REPLACE VIEW v_statistique_recette_mois AS
-- SELECT
--     DATE_TRUNC('month', fr.datefacturerecette) AS mois,
--     SUM(r.montant) AS montant_total
-- FROM
--     recette r
-- JOIN facture_recette fr ON fr.idfacturerecette = r.idfacturerecette
-- GROUP BY DATE_TRUNC('month', fr.datefacturerecette);










