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
        user_ID int not null,
        bork varchar(140) not null,
        createdAT datetime default current_timestamp,
        primary key (borkID),
	foreign key (user_ID) references users (userID) on delete cascade on update cascade
);
