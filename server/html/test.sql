/*for testing purposes, not necessary for configuration of this app*/

/*for following*/
select users.userID, users.username, borks.bork from users inner join borks on users.userID=borks.userID where users.userID=(
	select user2_ID from following where user1_ID=3
);

/*for discover*/
select users.userID, users.username, borks.bork from users inner join borks on users.userID=borks.userID where users.userID!=3 and users.userID!=(
	select user2_ID from following where user1_ID=3
);

select exists(select * from following where user1_ID=3 and user2_ID=1);
