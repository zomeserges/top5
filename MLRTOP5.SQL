drop database if exists mlrtop53;

create database if not exists mlrtop53;
use mlrtop53;
# -----------------------------------------------------------------------------
#       table : sqdip
# -----------------------------------------------------------------------------

create table if not exists sqdip
 (
   idsqdip bigint(11) not null  ,
   sqdip varchar(255) null  ,
   created_at datetime null  ,
   update_at datetime null  
   , primary key (idsqdip) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       table : origine
# -----------------------------------------------------------------------------

create table if not exists origine
 (
   idorigine bigint(11) not null  ,
   origine varchar(255) null  ,
   created_at datetime null  ,
   update_at char(32) null  
   , primary key (idorigine) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       table : gid
# -----------------------------------------------------------------------------

create table if not exists gid
 (
   idgid bigint(11) not null  ,
   idorigine bigint(11) null  ,
   gid varchar(255) null  ,
   pass varchar(255) null  ,
   nom varchar(128) null  ,
   prenom varchar(128) null  ,
   email varchar(128) null  ,
   origine bigint(11) null  ,
   direction bigint(11) null  
   , primary key (idgid) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       table : loginadmin
# -----------------------------------------------------------------------------

create table if not exists loginadmin
 (
   idloginadmin bigint(11) not null  ,
   gid bigint(11) null  ,
   role varchar(255) null  
   , primary key (idloginadmin) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       table : indicateur
# -----------------------------------------------------------------------------

create table if not exists indicateur
 (
   idindicateur bigint(11) not null  ,
   iddirection bigint(11) not null  ,
   idorigine bigint(11) not null  ,
   idsqdip bigint(11) not null  ,
   indicateur varchar(255) null  ,
   responsable varchar(255) null  ,
   description text null  ,
   direction bigint(11) null  ,
   origine bigint(11) null  ,
   sqdip bigint(11) null  ,
   mini bigint(4) null  ,
   valeur decimal(15,2) not null  ,
   maxi bigint(11) null  ,
   a1 bigint(11) null  ,
   created_at datetime null  ,
   update_at datetime null  
   , primary key (idindicateur) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       table : info
# -----------------------------------------------------------------------------

create table if not exists info
 (
   idinfo bigint(11) not null  ,
   idorigine bigint(11) not null  ,
   iddirection bigint(11) not null  ,
   idgid bigint(11) not null  ,
   date_debut datetime null  ,
   date_fin datetime null  ,
   info text null  ,
   direction bigint(11) null  ,
   origine bigint(11) null  ,
   gestionnaire bigint(11) null  ,
   created_at datetime null  ,
   update_at datetime null  
   , primary key (idinfo) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       table : action
# -----------------------------------------------------------------------------

create table if not exists action
 (
   idaction bigint(11) not null  ,
   idpdca bigint(11) not null  ,
   idsqdip bigint(11) not null  ,
   idescalade bigint(11) not null  ,
   idlogin bigint(11) not null  ,
   iddirection bigint(11) not null  ,
   idgid bigint(11) not null  ,
   idorigine bigint(11) not null  ,
   etat bigint(11) null  ,
   responsable varchar(255) null  ,
   data_prevu datetime null  ,
   action text null  ,
   direction bigint(11) null  ,
   origine bigint(11) null  ,
   sqdip bigint(11) null  ,
   escalade bigint(11) null  ,
   gestionnaire bigint(11) null  ,
   created_at datetime null  ,
   update_at datetime null  
   , primary key (idaction) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       table : loginpareto
# -----------------------------------------------------------------------------

create table if not exists loginpareto
 (
   idlogin bigint(11) not null  ,
   idpareto bigint(11) not null  ,
   gid bigint(11) null  ,
   pareto bigint(11) null  
   , primary key (idlogin) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       table : direction
# -----------------------------------------------------------------------------

create table if not exists direction
 (
   iddirection bigint(11) not null  ,
   direction varchar(255) null  ,
   created_at datetime null  ,
   update_at datetime null  
   , primary key (iddirection) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       table : version
# -----------------------------------------------------------------------------

create table if not exists version
 (
   version bigint(11) not null  ,
   numversion bigint(11) not null  
   , primary key (version,numversion) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       table : causepareto
# -----------------------------------------------------------------------------

create table if not exists causepareto
 (
   idcausepareto bigint(11) not null  ,
   cause varchar(255) null  ,
   description text null  ,
   pareto bigint(11) null  
   , primary key (idcausepareto) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       table : table_erreur
# -----------------------------------------------------------------------------

create table if not exists table_erreur
 (
   f1 text not null  
   , primary key (f1) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       table : typeseuil
# -----------------------------------------------------------------------------

create table if not exists typeseuil
 (
   idtypeseuil bigint(11) not null  ,
   type varchar(255) null  
   , primary key (idtypeseuil) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       table : escalade
# -----------------------------------------------------------------------------

create table if not exists escalade
 (
   idescalade bigint(11) not null  ,
   escalade varchar(255) null  ,
   created_at datetime null  ,
   update_at datetime null  
   , primary key (idescalade) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       table : pdca
# -----------------------------------------------------------------------------

create table if not exists pdca
 (
   idpdca bigint(11) not null  ,
   etat varchar(255) null  ,
   created_at datetime null  ,
   update_at datetime null  
   , primary key (idpdca) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       table : loginindicateur
# -----------------------------------------------------------------------------

create table if not exists loginindicateur
 (
   idloginindicateur bigint(11) not null  ,
   gid bigint(11) null  ,
   indicateur bigint(11) null  
   , primary key (idloginindicateur) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       table : pareto
# -----------------------------------------------------------------------------

create table if not exists pareto
 (
   idpareto bigint(11) not null  ,
   idcausepareto bigint(11) not null  ,
   idindicateur bigint(11) null  ,
   pareto varchar(255) null  ,
   valeur decimal(15,2) null  ,
   description text null  ,
   direction bigint(11) null  ,
   origine bigint(11) null  ,
   sqdip bigint(11) null  ,
   responsable varchar(128) null  ,
   create_at datetime null  ,
   update_at datetime null  
   , primary key (idpareto) 
 ) 
 comment = "";


# -----------------------------------------------------------------------------
#       creation des references de table
# -----------------------------------------------------------------------------


alter table gid 
  add foreign key fk_gid_origine (idorigine)
      references origine (idorigine) ;


alter table indicateur 
  add foreign key fk_indicateur_direction (iddirection)
      references direction (iddirection) ;


alter table indicateur 
  add foreign key fk_indicateur_origine (idorigine)
      references origine (idorigine) ;


alter table indicateur 
  add foreign key fk_indicateur_sqdip (idsqdip)
      references sqdip (idsqdip) ;


alter table info 
  add foreign key fk_info_origine (idorigine)
      references origine (idorigine) ;


alter table info 
  add foreign key fk_info_direction (iddirection)
      references direction (iddirection) ;


alter table info 
  add foreign key fk_info_gid (idgid)
      references gid (idgid) ;


alter table action 
  add foreign key fk_action_pdca (idpdca)
      references pdca (idpdca) ;


alter table action 
  add foreign key fk_action_sqdip (idsqdip)
      references sqdip (idsqdip) ;


alter table action 
  add foreign key fk_action_escalade (idescalade)
      references escalade (idescalade) ;


alter table action 
  add foreign key fk_action_loginpareto (idlogin)
      references loginpareto (idlogin) ;


alter table action 
  add foreign key fk_action_direction (iddirection)
      references direction (iddirection) ;


alter table action 
  add foreign key fk_action_gid (idgid)
      references gid (idgid) ;


alter table action 
  add foreign key fk_action_origine (idorigine)
      references origine (idorigine) ;


alter table loginpareto 
  add foreign key fk_loginpareto_pareto (idpareto)
      references pareto (idpareto) ;


alter table pareto 
  add foreign key fk_pareto_causepareto (idcausepareto)
      references causepareto (idcausepareto) ;


alter table pareto 
  add foreign key fk_pareto_indicateur (idindicateur)
      references indicateur (idindicateur) ;

