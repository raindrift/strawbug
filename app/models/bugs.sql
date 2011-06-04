create table 'bugs' (
	id int not null auto_increment primary key,
	creator_user_id int not null,
	assigned_user_id int,
	title varchar(255) not null,
	status enum('new', 'assigned', 'fixed', 'invalid', 'wontfix', 'duplicate') not null default 'new',
	created datetime not null,
	modified datetime not null,

	key creator (creator_user_id),
	key assigned (assigned_user_id),
	key created (created),
	key modified (modified)
) type = innodb; -- necessary because updating records here will require a transaction for concurrency checking
