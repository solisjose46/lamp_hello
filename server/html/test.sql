/*for testing purposes, not necessary for configuration of this app*/

/*make dummy login account follow*/
/*billy-->bobby10*/
insert into following (user1_ID, user2_ID) values (3,1);

/*for following*/
select users.userID, users.username, borks.bork from users inner join borks on users.userID=borks.userID where users.userID=(
	select user2_ID from following where user1_ID=3
);

/*for discover*/
select users.userID, users.username, borks.bork from users inner join borks on users.userID=borks.userID where users.userID!=3 and users.userID!=(
	select user2_ID from following where user1_ID=3
);

insert into following (user1_ID, user2_ID) values (1,1);
delete from following where user1_ID=user2_ID;

