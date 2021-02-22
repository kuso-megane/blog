drop database if exists app;
create database app;
use app;

drop table if exists category; 
create table category(
    id TINYINT UNSIGNED primary key auto_increment,
    name varchar(20) NOT NULL unique,
    num int UNSIGNED NOT NULL default 0
);

drop table if exists subCategory;
create table subCategory(
    id SMALLINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    name varchar(20) NOT NULL unique,
    c_id tinyint UNSIGNED,
    num int UNSIGNED NOT NULL default 0,

    CONSTRAINT fk_c_id_on_subCategory
        FOREIGN KEY (c_id)
        REFERENCES category(id)
        ON DELETE RESTRICT ON UPDATE CASCADE
);

drop table if exists article;
create table article(
    id int UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    c_id TINYINT UNSIGNED,
    subc_id SMALLINT UNSIGNED,
    title varchar(30) DEFAULT 'NO TITLE',
    thumbnailName varchar(30) DEFAULT 'default.jpg',
    content TEXT,
    updateDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

    CONSTRAINT fk_c_id_on_article
        FOREIGN KEY (c_id)
        REFERENCES category(id)
        ON DELETE RESTRICT ON UPDATE CASCADE,

    CONSTRAINT fk_subc_id_on_article
        FOREIGN KEY (subc_id)
        REFERENCES subCategory(id)
        ON DELETE RESTRICT ON UPDATE CASCADE
);

insert into category VALUES(0, 'プログラミング', 0);
insert into subCategory VALUES(0, 'web', 1, 0);
insert into article VALUES(0, 1, 1, 'sampleTitle1', default, '<p>sample1-content</p>', default);


