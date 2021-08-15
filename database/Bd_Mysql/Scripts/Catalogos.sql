INSERT INTO catalogocab(tabla) values('Reglas tabla clients');
insert into catalogodet(Descripcion,valorstring,valorint,catalogocab_id,estado) values('SIZE_TOKEN','SIZE_TOKEN',20,(select id from catalogocab where tabla='Reglas tabla clients'),1) ;


insert into catalogocab (tabla) VALUES('PAISES');
-- select * from catalogocab c ;
INSERT INTO catalogodet(Descripcion,VALORSTRING,catalogocab_id,ESTADO) VALUES('ECUADOR','ECUADOR',(select id from catalogocab where tabla='PAISES'),1);
INSERT INTO catalogodet(Descripcion,VALORSTRING,catalogocab_id,ESTADO) VALUES('COLOMBIA','COLOMBIA',(select id from catalogocab where tabla='PAISES'),1);
INSERT INTO catalogodet(Descripcion,VALORSTRING,catalogocab_id,ESTADO) VALUES('MEXICO','MEXICO',(select id from catalogocab where tabla='PAISES'),1);
-- select * from catalogodet c 

insert into catalogocab (tabla) VALUES('CIUDADES');
insert into catalogocab (tabla) VALUES('STATES');
-- select * from catalogocab c ;






INSERT INTO catalogodet(Descripcion,VALORSTRING,catalogocab_id,ESTADO,valor_bigint) VALUES('GUAYAS','GUAYAS',(select id from catalogocab where tabla='STATES'),1,(select d.id from catalogocab c inner join catalogodet d on d.catalogocab_id =c.id where tabla='PAISES' and d.valorstring='ECUADOR'));
INSERT INTO catalogodet(Descripcion,VALORSTRING,catalogocab_id,ESTADO,valor_bigint) VALUES('PICHINCHA','PICHINCHA',(select id from catalogocab where tabla='STATES'),1,(select d.id from catalogocab c inner join catalogodet d on d.catalogocab_id =c.id where tabla='PAISES' and d.valorstring='ECUADOR'));
INSERT INTO catalogodet(Descripcion,VALORSTRING,catalogocab_id,ESTADO,valor_bigint) VALUES('COL ESTADO 1','COL ESTADO 1',(select id from catalogocab where tabla='STATES'),1,(select d.id from catalogocab c inner join catalogodet d on d.catalogocab_id =c.id where tabla='PAISES' and d.valorstring='COLOMBIA'));
INSERT INTO catalogodet(Descripcion,VALORSTRING,catalogocab_id,ESTADO,valor_bigint) VALUES('COL ESTADO 2','COL ESTADO 2',(select id from catalogocab where tabla='STATES'),1,(select d.id from catalogocab c inner join catalogodet d on d.catalogocab_id =c.id where tabla='PAISES' and d.valorstring='COLOMBIA'));
INSERT INTO catalogodet(Descripcion,VALORSTRING,catalogocab_id,ESTADO,valor_bigint) VALUES('MEX ESTADO 1','MEX ESTADO 1',(select id from catalogocab where tabla='STATES'),1,(select d.id from catalogocab c inner join catalogodet d on d.catalogocab_id =c.id where tabla='PAISES' and d.valorstring='MEXICO'));
INSERT INTO catalogodet(Descripcion,VALORSTRING,catalogocab_id,ESTADO,valor_bigint) VALUES('MEX ESTADO 2','MEX ESTADO 2',(select id from catalogocab where tabla='STATES'),1,(select d.id from catalogocab c inner join catalogodet d on d.catalogocab_id =c.id where tabla='PAISES' and d.valorstring='MEXICO'));

INSERT INTO catalogodet(Descripcion,VALORSTRING,catalogocab_id,ESTADO,valor_bigint) VALUES('GUAYAQUIL','GUAYAQUIL',(select id from catalogocab where tabla='CIUDADES'),1,(select d.id from catalogocab c inner join catalogodet d on d.catalogocab_id =c.id where tabla='STATES' and d.valorstring='GUAYAS'));
INSERT INTO catalogodet(Descripcion,VALORSTRING,catalogocab_id,ESTADO,valor_bigint) VALUES('SAMBORONDON','SAMBORONDON',(select id from catalogocab where tabla='CIUDADES'),1,(select d.id from catalogocab c inner join catalogodet d on d.catalogocab_id =c.id where tabla='STATES' and d.valorstring='GUAYAS'));
INSERT INTO catalogodet(Descripcion,VALORSTRING,catalogocab_id,ESTADO,valor_bigint) VALUES('QUITO','QUITO',(select id from catalogocab where tabla='CIUDADES'),1,(select d.id from catalogocab c inner join catalogodet d on d.catalogocab_id =c.id where tabla='STATES' and d.valorstring='PICHINCHA'));
INSERT INTO catalogodet(Descripcion,VALORSTRING,catalogocab_id,ESTADO,valor_bigint) VALUES('SANGOLQUI','SANGOLQUI',(select id from catalogocab where tabla='CIUDADES'),1,(select d.id from catalogocab c inner join catalogodet d on d.catalogocab_id =c.id where tabla='STATES' and d.valorstring='PICHINCHA'));
INSERT INTO catalogodet(Descripcion,VALORSTRING,catalogocab_id,ESTADO,valor_bigint) VALUES('BOGOTA','BOGOTA',(select id from catalogocab where tabla='CIUDADES'),1,(select d.id from catalogocab c inner join catalogodet d on d.catalogocab_id =c.id where tabla='STATES' and d.valorstring='COL ESTADO 1'));
INSERT INTO catalogodet(Descripcion,VALORSTRING,catalogocab_id,ESTADO,valor_bigint) VALUES('CALI','CALI',(select id from catalogocab where tabla='CIUDADES'),1,(select d.id from catalogocab c inner join catalogodet d on d.catalogocab_id =c.id where tabla='STATES' and d.valorstring='COL ESTADO 2'));
INSERT INTO catalogodet(Descripcion,VALORSTRING,catalogocab_id,ESTADO,valor_bigint) VALUES('GUADALAJARA','GUADALAJARA',(select id from catalogocab where tabla='CIUDADES'),1,(select d.id from catalogocab c inner join catalogodet d on d.catalogocab_id =c.id where tabla='STATES' and d.valorstring='MEX ESTADO 1'));
INSERT INTO catalogodet(Descripcion,VALORSTRING,catalogocab_id,ESTADO,valor_bigint) VALUES('ACAPULCO','ACAPULCO',(select id from catalogocab where tabla='CIUDADES'),1,(select d.id from catalogocab c inner join catalogodet d on d.catalogocab_id =c.id where tabla='STATES' and d.valorstring='MEX ESTADO 2'));



