drop table if exists notes;

create table notes (
	id int not null auto_increment primary key,
	creator_user_id int not null,
	type enum('comment', 'status_change') not null default 'comment',
	created datetime not null,
	modified datetime not null,

	key creator (creator_user_id),
	key created (created)
) type = myisam;
