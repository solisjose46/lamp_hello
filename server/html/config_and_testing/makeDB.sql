/*This script creates database and tables for this app*/

/*
create user 'lamp_user'@'localhost' identified by 'password123';
grant all privileges on *.* to 'lamp_user'@'localhost';
flush privileges;
*/
create database lamp_hello;
use lamp_hello;
create table users(
        userID int not null auto_increment,
        username varchar(50) not null,
        password varchar(255) not null,
        createdAT datetime default current_timestamp,
        primary key (userID)
);

create table following(
        followID int not null auto_increment,
	user1_ID int not null,
	user2_ID int not null,
	primary key (followID),
	foreign key (user1_ID) references users (userID) on delete cascade on update cascade,
	foreign key (user2_ID) references users (userID) on delete cascade on update cascade
);

create table borks(
        borkID int not null auto_increment,
        userID int not null,
        bork varchar(140) not null,
        createdAT datetime default current_timestamp,
        primary key (borkID),
	foreign key (userID) references users (userID) on delete cascade on update cascade
);

alter table following add constraint followOnce unique(user1_ID, user2_ID);
