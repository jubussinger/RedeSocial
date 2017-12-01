create schema redeSocial default charset 'utf8';
use redeSocial;
create table perfil(
	idPerfil INT NOT NULL primary key
    ,nome VARCHAR(40) NOT NULL
    ,sobrenome VARCHAR(100) NOT NULL
    ,sexo VARCHAR(50) NOT NULL
    ,email VARCHAR(255) NOT NULL
    ,nomeUsuario VARCHAR(50) NOT NULL
    ,senha VARCHAR (255) NOT NULL
    ,datanasc DATE NOT NULL
);
create table amigos(
	id_pessoa int not null,
    id_amigo int not null,
    primary key(id_pessoa, id_amigo)
);
select * from perfil;
