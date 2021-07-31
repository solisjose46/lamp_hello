/*for testing purposes, not necessary for configuration of this app*/

/*for following*/
select users.userID, users.username, borks.bork from users inner join borks on users.userID=borks.userID where users.userID=(
	select user2_ID from following where user1_ID=4
);

/*for discover*/
select users.userID, users.username, borks.bork from users inner join borks on users.userID=borks.userID and users.userID!=(
	select coalesce ((select user2_ID from following where user1_ID=4), 0)
);
/*other queries for testing*/
truncate table following;
insert into following (user1_ID, user2_ID) values (4, 3);
delete from following where user1_ID=4 and user2_ID=3;

alter table following add constraint followOnce unique(user1_ID, user2_ID);
