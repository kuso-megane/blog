drop database if exists test_db;
create database test_db;
use test_db;

drop table if exists test_tbl; 
create table test_tbl(
id int primary key auto_increment,
info varchar(10) 
);

insert into test_tbl(info) value('test1'); 
insert into test_tbl(info) value('test2');

