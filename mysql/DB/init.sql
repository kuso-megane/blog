drop database if exists app;
create database app;
use app;

drop table if exists category; 
create table category(
    id TINYINT primary key auto_increment,
    name varchar(20) NOT NULL unique
);

drop table if exists subCategory;
create table subCategory(
    id SMALLINT PRIMARY KEY AUTO_INCREMENT,
    name varchar(20) NOT NULL unique,
    c_id tinyint,

    CONSTRAINT fk_c_id_on_subCategory
        FOREIGN KEY (c_id)
        REFERENCES category(id)
        ON DELETE RESTRICT ON UPDATE CASCADE
);

drop table if exists article;
create table article(
    id int PRIMARY KEY AUTO_INCREMENT,
    c_id TINYINT,
    subc_id SMALLINT,
    title varchar(30) DEFAULT 'NO TITLE',
    thumbnailName varchar(30) DEFAULT 'default.jpg',
    content TEXT,
    update_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

    CONSTRAINT fk_c_id_on_article
        FOREIGN KEY (c_id)
        REFERENCES category(id)
        ON DELETE RESTRICT ON UPDATE CASCADE,

    CONSTRAINT fk_subc_id_on_article
        FOREIGN KEY (subc_id)
        REFERENCES subCategory(id)
        ON DELETE RESTRICT ON UPDATE CASCADE
);

insert into category VALUES(0, 'プログラミング');
insert into subCategory VALUES(0, 'web', 1);
insert into article VALUES(0, 1, 1, 'sampleTitle1', default, '<p>sample1-content</p>', default);


