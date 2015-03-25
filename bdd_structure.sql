create table t_service (
	id int(11) not null,
	libelle varchar(50),
	constraint pk_t_service primary key (id)
);

create table t_type (
	id int(11) not null,
	libelle varchar(50),
	extension varchar(10),
	extension2 varchar(10),
	constraint pk_t_type primary key (id)
);

create table t_serveur (
	id int(11) not null,
	nom varchar(64),
	constraint pk_t_service primary key (id)
);

create table t_hote (
	id int(11) not null,
	nom varchar(64),
	constraint pk_t_hote primary key(id)
);


create table t_user (
	id int(11) not null,
	nom varchar(64),
	parent int(11),
	droit int(11),
	code varchar(8),
	service int(11),
	constraint pk_t_user primary key (id),
	constraint fk_t_user_t_service foreign key (service) references t_service (id)
);

create table t_log (
	id int(11) not null,
	num int(11),
	date timestamp,
	idhote int(11),
	idserver int(11),
	pages int(11),
	iduser int(11),
	nom varchar(256),
	format int(11),
	constraint pk_t_log primary key (id),
	constraint fk_t_log_t_type foreign key (format) references t_type (id),
	constraint fk_t_log_t_user foreign key (iduser) references t_user (id),
	constraint fk_t_log_t_hote foreign key (idhote) references t_hote (id),
	constraint fk_t_log_t_serveur foreign key (idserver) references t_serveur (id)
);
