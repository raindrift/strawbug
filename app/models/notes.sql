drop table if exists notes;

create table notes (
	id int not null auto_increment primary key,
	bug_id int not null,
	user_id int not null,
	type enum('comment', 'status_change') not null default 'comment',
	content text,
	created datetime not null,
	modified datetime not null,

	key creator (user_id),
	key bug (bug_id),
	key created (created)
) type = myisam;
