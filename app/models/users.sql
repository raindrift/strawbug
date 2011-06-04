drop table if exists users;

create table users (
	id int not null auto_increment primary key,
	username varchar(40) not null,
	password varchar(40) not null,
	email varchar(255) not null,
	name varchar(40) not null,
	created datetime not null,
	modified datetime not null,
	
    unique user_email_unique (username, email),
	key email (email)
) type = myisam;

-- Note: this is a default password, 'admin', but it will only work if the password salt doesn't change
insert into users (name, username, password) values ('Admin', 'admin', 'ce2bf1519ebc624253b6f845111b06660c57f233');
	
-- Note: this temporary password is 'user'.  see caveat above.
insert into users (name, username, password) values ('User Guy', 'user', '9773c961590d1af1c2f40d0085af891a818112a2');
