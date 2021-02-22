drop database if exists app;
create database app;
use app;

drop table if exists Category; 
create table Category(
    id TINYINT UNSIGNED primary key auto_increment,
    name varchar(20) NOT NULL unique,
    num int UNSIGNED NOT NULL default 0
);

drop table if exists SubCategory;
create table SubCategory(
    id SMALLINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    name varchar(20) NOT NULL unique,
    c_id tinyint UNSIGNED,
    num int UNSIGNED NOT NULL default 0,

    CONSTRAINT fk_c_id_on_subCategory
        FOREIGN KEY (c_id)
        REFERENCES Category(id)
        ON DELETE RESTRICT ON UPDATE CASCADE
);

drop table if exists Article;
create table Article(
    id int UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    c_id TINYINT UNSIGNED,
    subc_id SMALLINT UNSIGNED,
    title varchar(30) DEFAULT 'NO TITLE',
    thumbnailName varchar(30) DEFAULT 'default.jpg',
    content TEXT,
    updateDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

    CONSTRAINT fk_c_id_on_article
        FOREIGN KEY (c_id)
        REFERENCES Category(id)
        ON DELETE RESTRICT ON UPDATE CASCADE,

    CONSTRAINT fk_subc_id_on_article
        FOREIGN KEY (subc_id)
        REFERENCES SubCategory(id)
        ON DELETE RESTRICT ON UPDATE CASCADE
);

insert into Category VALUES(0, 'プログラミング', 0);
insert into SubCategory VALUES(0, 'web', 1, 0);
insert into Article VALUES(0, 1, 1, 'sampleTitle1', default, '<p>sample1-content</p>', default);


