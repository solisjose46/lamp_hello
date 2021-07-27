/*insert filler content to populate the website*/

/*make dummy users*/
insert into users (username, password) values ("bobby10", "password123");
insert into users (username, password) values ("t_sc0tt", "password123");

/*get user ids of users just created*/
select userID into @user1 from users where username="bobby10";
select userID into @user2 from users where username="t_sc0tt";

/*creat borks for theses new users*/
insert into borks (userID, bork) values (@user1, "All day starin at the ceilin makin Friends with shadows on my wall");
insert into borks (userID, bork) values (@user2, "The sun don't shine, but it never did And when it rains, it fucking pours, but I think I like it");
insert into borks(userID, bork) values(@user2, "If you don't have the ace of hearts My dear, you're a lost man Falcon for you, Anna, from the left arm of the falconer Anna, Anna, Anna");
insert into borks(userID, bork) values(@user1, "Time it was, and what a time it was, it was");
insert into borks(userID, bork) values(@user2, "I cant wait to go Back and do Japan Get me lots of brand new fans Osaka, Tokyo You Harajuku girls Damn, you've got some wicked style");
