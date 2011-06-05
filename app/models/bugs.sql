drop table if exists bugs;

create table bugs (
	id int not null auto_increment primary key,
	user_id int not null,
	owner_id int,
	title varchar(255) not null,
	status enum('new', 'assigned', 'fixed', 'invalid', 'wontfix', 'duplicate') not null default 'new',
	content text,
	created datetime not null,
	modified datetime not null,

	key creator (user_id),
	key assigned (owner_id),
	key created (created),
	key modified (modified)
) type = myisam;