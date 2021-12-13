DROP PROCEDURE IF EXISTS get_clients_all;
DELIMITER //
create  PROCEDURE get_clients_all()
BEGIN
  select * from clients;
  /*SELECT *
  FROM fintradeacf.fina0001
  WHERE   CODCIA IN ('1','2') AND
      ( PRELIMINAR = 0 OR PRELIMINAR IS NULL) AND
      ANULADA = 0 AND
      ESTADO <> 'A';
*/

END
//
DELIMITER

/*
 call Get_client_item(1)
 *
 */
DROP PROCEDURE IF EXISTS Get_client_item;
DELIMITER //
create  PROCEDURE Get_client_item(IN item bigint)
BEGIN
  select id,name, token, email,
     case active
        when '0' then ''
        else 'checked'
      end as active
    from clients c
    WHERE c.id = item;

END;
//
DELIMITER ;

/*
 SET @msg5 = '';
 SET @error5 = '';
 CALL Insert_client('MIguel Flores','mFj1.desarrollo@gmail.com',@msg5,@error5);
 select @msg5, @error5;
 */
DROP PROCEDURE IF EXISTS Insert_client;
DELIMITER //
create  PROCEDURE Insert_client(
                                IN _name varchar(255),
                                IN _email varchar(255),
                                OUT _msg varchar(255),
                                OUT _error char(1)
                                )
sp: BEGIN
     DECLARE token2 varchar(255);
     DECLARE substring3 varchar(200);
     Declare code varchar(10);
     Declare MSG text;
     declare existe int;
     declare email2 varchar(255);
     declare size_token int;
     DECLARE exit HANDLER FOR SQLEXCEPTION
     begin
       select '1' into _error;

       Get diagnostics condition 1 code=MYSQL_ERRNO, MSG=MESSAGE_TEXT;
       select CONCAT('Inserts failed Client, error = ',code,', message = ',MSG) into _msg;
       select _error,_msg;

       end;
       select 0 into size_token;
     select 0 into existe;
     select trim(_email) into email2;
     select upper(email2) into email2;

     select count(*) into existe
         from clients where  upper(email) collate utf8mb4_unicode_ci = email2;


       if existe > 0 THEN
            select '1' into _error;
            select '' into _msg;
            select description into _msg
              from messages ges
              where ges.key_control='email_client_exist';
            if (_msg='') then
              select 'Email ya existe en la base con ese nombre' into _msg;
            end if;
            select _error, _msg;
            leave sp;
       end if;



      select 1 into existe;
      select valorint  into size_token
        from catalogodet d
        inner join catalogocab c on c.id = d.catalogocab_id
        where c.tabla ='Reglas tabla clients' AND
              d.valorstring = 'SIZE_TOKEN';
      if(size_token=0) then
         select 10 into size_token;
      end if;
    while(existe=1) do
       select  SUBSTRING(MD5(RAND()) FROM 1 FOR size_token) into substring3;
       select concat(email2,substring3,email2) into substring3;
       select count(*) into existe
         from clients where  token collate utf8mb4_unicode_ci = substring3;
    end while;

    select trim(_email) into _email;


    select  substring3 into token2 ;

      insert into clients(name,email,created_at,token,active) values(_name,_email,now(),token2,1);

    select '0' into  _error;

    select 'ok' into _msg;
    select _error,_msg;




END;
//
DELIMITER ;

/*
 call Update_client(1,'MIguel Flores','mFj1.desarrollo@gmail.com',@_msg5,@_error5)
 select @_msg5,@_error5
 */
DROP PROCEDURE IF EXISTS Update_client;
DELIMITER //
create  PROCEDURE Update_client(
                IN _id bigint,
                                IN _name varchar(255),
                                IN _email varchar(255),
                                IN _active tinyint(1),
                                OUT _msg varchar(255),
                                OUT _error char(1)
                                )
sp: BEGIN
     DECLARE token2 varchar(255);
     DECLARE substring3 varchar(200);
     Declare code varchar(5);
     Declare MSG text;
     declare existe int;
     declare email2 varchar(255);
     declare size_token int;
     DECLARE exit HANDLER FOR SQLEXCEPTION
     begin
       select '1' into _error;

       Get   diagnostics condition 1 code=RETURNED_SQLSTATE, MSG=MESSAGE_TEXT;
       select CONCAT('Update failed Client, error = ',code,', message = ',MSG) into _msg;
       select _error,_msg;

       end;
       select 0 into size_token;
     select 0 into existe;
     select trim(_email) into email2;
     select upper(email2) into email2;

     select count(*) into existe
         from clients
       where  upper(email) collate utf8mb4_unicode_ci = email2 AND
              id <> _id;


       if existe > 0 THEN
            select '1' into _error;
            select '' into _msg;
            select description into _msg
              from messages ges
              where ges.key_control='email_client_exist';
            if (_msg='') then
              select 'Email ya existe en la base con ese nombre' into _msg;
            end if;
            select _error, _msg;
            leave sp;
       end if;


      /*
      select 1 into existe;
      select valorint  into size_token
        from catalogodet d
        inner join catalogocab c on c.id = d.catalogocab_id
        where c.tabla ='Reglas tabla clients' AND
              d.valorstring = 'SIZE_TOKEN';
      if(size_token=0) then
         select 10 into size_token;
      end if;
	  while(existe=1) do
	     select  SUBSTRING(MD5(RAND()) FROM 1 FOR size_token) into substring3;
	     select concat(email2,substring3,email2) into substring3;
	     select count(*) into existe
	       from clients where  token collate utf8mb4_unicode_ci = substring3;
	  end while;
     */
	  select trim(_email) into _email;


	  /*select  substring3 into token2 ;*/


      update clients
         set email= _email,
             name = _name,
             updated_at = now(),
             active  = _active/*,
             token = token2*/
         where id = _id;

    select '0','ok' into  _error,_msg;
   select _error,_msg;


END;
//
DELIMITER ;

/*
 set @s_token='TdpbeSGsdsg3g';
 call Get_client_token(@s_token);
 */

DROP PROCEDURE IF EXISTS Get_client_token;
DELIMITER //
create  PROCEDURE Get_client_token(IN s_token varchar(200))
BEGIN
  if
    exists(
      select 1
        from clients c
        WHERE c.token = s_token AND
              c.active = 1
       )
    then
      select 0 as error,'' as msg ;
    else
      select 1 error,'Error, Token de cliente no est� asignado.' as msg;
    end if;


END;
//
DELIMITER ;
/*
 call Get_existe_user('frederik65@example.com','h5Vw5GRoyM')
 *
 */

DROP PROCEDURE IF EXISTS Get_existe_user;
DELIMITER //
create  PROCEDURE Get_existe_user(IN s_mail varchar(200),IN s_token varchar(200) )
BEGIN
  declare b_is_completed bigint;
    declare b_is_exists bigint;
    declare b_is_corporation_user bigint;

    select  0 into b_is_completed;
    select  0 into b_is_exists ;
    select  0 into b_is_corporation_user ;
  if
    exists(
      select 1
        from users c
        inner join businessinformations b on b.user_id  = c.id
        inner join clients c2 on c2.id = b.client_id
        WHERE c.email = s_mail AND
              c2.token = s_token
       )
    then
      select 1 into  b_is_exists;
    end if;

    if
    exists(
      select 1
        from users c
        inner join businessinformations b on b.user_id  = c.id
        inner join clients c2 on c2.id = b.client_id
        WHERE c.email = s_mail AND
              c2.token = s_token
       ) AND
    exists(
      select 1
        from users c
        inner join managements b on b.user_id  = c.id
        inner join clients c2 on c2.id = b.client_id
        WHERE c.email = s_mail AND
              c2.token = s_token
       ) AND
     exists(
      select 1
        from users c
        inner join financialrequests b on b.user_id  = c.id
        inner join clients c2 on c2.id = b.client_id
        WHERE c.email = s_mail AND
              c2.token = s_token
       ) AND
     exists(
      select 1
        from users c
        inner join bankinformations  b on b.user_id  = c.id
        inner join clients c2 on c2.id = b.client_id
        WHERE c.email = s_mail AND
              c2.token = s_token
       ) AND
     exists(
      select 1
        from users c
        inner join certificationauthorizations  b on b.user_id  = c.id
        inner join clients c2 on c2.id = b.client_id
        WHERE c.email = s_mail AND
              c2.token = s_token
       )
    then
      select 1 into  b_is_completed;
    end if;

    if exists(
            select 1
            from users u
            join model_has_roles mhr on u.id = mhr.model_id
            where u.email = s_mail AND
                  mhr.role_id != 3
            )
    THEN
        select 1 into b_is_corporation_user;
    end if;




    select b_is_completed as completo,
           b_is_exists as existe,
           b_is_corporation_user as usuario_corporativo;


     select m.id ,
         m.company_name,
         DATE_FORMAT(m.date_company , '%Y-%m-%d') as date_company,
         m.type_business,
         m.contact_name,
         m.zip,
         m.president_name,
         m.address,
         m.ruc_tax,
         m.website,
         m.secretary_name,
         m.dba,
           m.cell_phone,
           m.country_id,
           c.descripcion country,
           m.city_id,
           ci.descripcion city,
           m.state_id,
           s.descripcion state,
           m.phone,
           u.email,
           u.name,
           u.id user_id,
           case u.status when 1 then 'true' else 'false' end  status_user,
           case c2.active when 1 then 'true' else 'false' end status_client,
           DATE_FORMAT(m.created_at , '%Y-%m-%d %T.%f') as created_at,
         DATE_FORMAT(m.updated_at , '%Y-%m-%d %T.%f') as updated_at,
         m.is_buyer,
           m.is_seller

    from businessinformations m
    inner join users u on u.id  = m.user_id
    inner join clients c2 on c2.id  = m.client_id
    left outer join catalogodet c on c.id = m.country_id
    left outer join catalogodet s on s.id = m.state_id
    left outer join catalogodet ci on ci.id = m.city_id
    WHERE
          u.email = s_mail AND
          c2.token = s_token ;

    select id,email,name
    from users u
    where u.email = s_mail;


END;
//
DELIMITER ;

/*
 set @item = 8;
 call Get_businessinformation(@item);
 */

DROP PROCEDURE IF EXISTS Get_businessinformation;
DELIMITER //
create  PROCEDURE Get_businessinformation(IN item bigint)
BEGIN
  select m.id,
         m.company_name,
         DATE_FORMAT(m.date_company , '%Y-%m-%d %T.%f') as date_company,
         m.type_business,
         m.contact_name,
         m.zip,
         m.president_name,
         m.address,
         m.ruc_tax,
         m.website,
         m.secretary_name,
         m.dba,
           m.cell_phone,
           m.country_id,
           c.descripcion country,
           m.city_id,
           ci.descripcion city,
           m.state_id,
           s.descripcion state,
           m.user_id,
           m.client_id,
           m.phone,
           u.email,
           u.name,
           u.id user_id,
           c2.token,
         DATE_FORMAT(m.created_at , '%Y-%m-%d %T.%f') as created_at,
         DATE_FORMAT(m.updated_at , '%Y-%m-%d %T.%f') as updated_at,
         case u.status when 1 then 'true' else 'false' end  status_user,
           case c2.active when 1 then 'true' else 'false' end status_client,
           case m.is_buyer when 1 then 'true' else 'false' end  is_buyer,
           case m.is_seller when 1 then 'true' else 'false' end is_seller

    from businessinformations m
    inner join users u on u.id =m.user_id
    inner JOIN clients c2 on c2.id  = m.client_id
    left outer join catalogodet c on c.id = m.country_id
    left outer join catalogodet s on s.id = m.state_id
    left outer join catalogodet ci on ci.id = m.city_id
    WHERE m.id = item;

END;
//
DELIMITER ;


/*
SET @email = 'dare.jude@example.com';
SET @token = 'QQUGvNKrwR';
call Get_businessinformation_client_user(@email ,@token);
 */

DROP PROCEDURE IF EXISTS Get_businessinformation_client_user;
DELIMITER //
create  PROCEDURE Get_businessinformation_client_user(IN _mail varchar(255), in _token varchar(255))
BEGIN
  select m.id,
         m.company_name,
         DATE_FORMAT(m.date_company , '%Y-%m-%d %T.%f') as date_company,
         m.type_business,
         m.contact_name,
         m.zip,
         m.president_name,
         m.address,
         m.ruc_tax,
         m.website,
         m.secretary_name,
         m.dba,
           m.cell_phone,
           m.country_id,
           c.descripcion country,
           m.city_id,
           ci.descripcion city,
           m.state_id,
           s.descripcion state,
           m.phone,
           u.email,
           u.name,
           u.id user_id,
           case u.status when 1 then 'true' else 'false' end  status_user,
           case c2.active when 1 then 'true' else 'false' end status_client,
           DATE_FORMAT(m.created_at , '%Y-%m-%d %T.%f') as created_at,
         DATE_FORMAT(m.updated_at , '%Y-%m-%d %T.%f') as updated_at,
         case m.is_buyer when 1 then 'true' else 'false' end  is_buyer,
           case m.is_seller when 1 then 'true' else 'false' end is_seller

    from businessinformations m
    inner join users u on u.id  = m.user_id
    inner join clients c2 on c2.id  = m.client_id
    left outer join catalogodet c on c.id = m.country_id
    left outer join catalogodet s on s.id = m.state_id
    left outer join catalogodet ci on ci.id = m.city_id
    WHERE
          u.email = _mail AND
          c2.token = _token
          ;

END;
//
DELIMITER ;

/*
/*
SET @name = '11user nuevo';
SET @email = '452aa11nuevoa457812@aaa.com';
SET @clave = '$2y$10$YSjPChBAf6yLym4aKhveQeYTxsbCuPuNS9nHu5aGYKcsSrkDHM3sy';
SET @taxid = 'aa11a12311';
SET @datecompany = '2021-10-28';
SET @contactname = 'a';
SET @zipcode = 'a';
SET @typebusiness = 'a';
SET @phone = 'a';
SET @president = 'a';
SET @country = 'a';
SET @state = 'a';
SET @city = 'a';
SET @address = 'a';
SET @website = 'http://www.aa.com';
SET @secretary = 'a';
SET @dba = 'a';
SET @cellphone = 'a';
SET @token = 'h5Vw5GRoyM';
SET @msg = '';
SET @is_buyer = 'true';
SET @is_seller = 'false';
SET @error = '';
SET @id = 0;
CALL Insert_businessinformation(@name,@email,@clave,@taxid,@datecompany,@contactname,@zipcode,@typebusiness,@phone,@president,@country,@state,@city,@address,@website,@secretary,@dba,@cellphone,@token,@is_buyer ,@is_seller ,@msg,@error,@id);
SELECT @msg,@error,@id;
 */

DROP PROCEDURE IF EXISTS Insert_businessinformation;
DELIMITER //
create  PROCEDURE Insert_businessinformation(
                                IN _name varchar(255),
                                IN _email varchar(255),
                                IN _clave varchar(255),
                                IN _taxid varchar(255),
                                IN _datecompany varchar(255),
                                IN _contactname varchar(255),
                                IN _zipcode varchar(255),
                                IN _typebussiness varchar(255),
                                IN _phone varchar(255),
                                IN _president varchar(255),
                                IN _country varchar(255),
                                IN _state varchar(255),
                                IN _city varchar(255),
                                IN _address varchar(255),
                                IN _website varchar(255),
                                IN _secretaryname varchar(255),
                                IN _dba varchar(255),
                                IN _cellphone varchar(255),
                                IN _token varchar(255),
                                IN _is_buyer varchar(255),
                                IN _is_seller varchar(255),
                                OUT _msg varchar(255),
                                OUT _error tinyint ,
                                OUT _id bigint
                                )
sp:BEGIN
     Declare code varchar(5);
     Declare MSG text;
     declare b_client_id bigint;
     declare b_usuario_id bigint;
     declare b_country_id bigint;
     declare b_state_id bigint;
     declare b_rol_id bigint;
     declare s_modelo varchar(255);
     declare b_city_id bigint;
     declare t_is_buyer tinyint;
     declare t_is_seller tinyint;
     declare d_datecompany date;
     DECLARE exit HANDLER FOR SQLEXCEPTION

     sp1:begin
       select 1 into _error;
       select 0 into _id;
       Get   diagnostics condition 1 code=RETURNED_SQLSTATE, MSG=MESSAGE_TEXT;
       select CONCAT('Inserts failed Business Information, error = ',code,', message = ',MSG) into _msg;
       select _error,_msg,_id;
       LEAVE sp1;

       end;

      sp2:begin
        select 0 into _id;
        select 0 into b_rol_id;
        select '' into s_modelo;
        select 0 into t_is_buyer;
        select 0 into t_is_seller;
        if trim(ifnull(_is_buyer,''))='' then
            select 1 into _error;
            select 'Error, el is Buyer es obligatorio.' into _msg;
            select _error,_msg,_id;
            LEAVE sp2;
       end if;
      if trim(ifnull(_is_seller,''))='' then
            select 1 into _error;
            select 'Error, el is Seller es obligatorio.' into _msg;
            select _error,_msg,_id;
            LEAVE sp2;
      end if;
      if upper(trim(_is_seller))='true' or trim(_is_seller)='1' then
            select 1 into t_is_seller;
      end if;
      if upper(trim(_is_buyer))='true' or trim(_is_buyer)='1' then
            select 1 into t_is_buyer;
      end if;
        if STR_TO_DATE(_datecompany, '%Y-%m-%d') is  NULL then
            select 1 into _error;
            select 'Error, el formato de la fecha no es v�lido. El formato es yyyy-MM-dd Ejm: 2021-08-21.' into _msg;
            select _error,_msg,_id;
            LEAVE sp2;
        end if;

        select STR_TO_DATE(_datecompany,'%Y-%m-%d') into d_datecompany;

        if d_datecompany > now() then
            select 1 into _error;
            select 'Error, la fecha de la compa��a es mayor a la fecha actual.' into _msg;
            select _error,_msg,_id;
            LEAVE sp2;
        end if;

        if d_datecompany > now() then
            select 1 into _error;
            select 'Error, la fecha de la compa��a es mayor a la fecha actual.' into _msg;
            select _error,_msg,_id;
            LEAVE sp2;
        end if;



       if not exists(select 1 from clients c  WHERE c.token = _token) then
            select 1 into _error;
            select 'Error, Origen del Market no existe, error en Token.' into _msg;
            select _error,_msg,_id;
            LEAVE sp2;
       end if;
       /*Paises*/
       if trim(ifnull(_country,''))='' then
            select 1 into _error;
            select 'Error, el Country es obligatorio.' into _msg;
            select _error,_msg,_id;
            LEAVE sp2;
       end if;
      if trim(ifnull(_state,''))='' then
            select 1 into _error;
            select 'Error, el State es obligatorio.' into _msg;
            select _error,_msg,_id;
            LEAVE sp2;
       end if;
      if trim(ifnull(_city,''))='' then
            select 1 into _error;
            select 'Error, el City es obligatorio.' into _msg;
            select _error,_msg,_id;
            LEAVE sp2;
       end if;
       select trim(upper(_country)) into _country;
       select trim(upper(_state)) into _state;
       select trim(upper(_city)) into _city;
       if not exists(select 1 from catalogocab c inner join catalogodet c2  on c2.catalogocab_id  = c.id
                 WHERE c.tabla='PAISES' AND c2.valorstring = _country) then

            insert into catalogodet(catalogocab_id,descripcion,valorstring,estado)
              values((select id from catalogocab where tabla='PAISES'), _country,_country,1);

       end if;

      if not exists(select 1 from catalogocab c inner join catalogodet c2  on c2.catalogocab_id  = c.id
                 WHERE c.tabla='PAISES' AND c2.valorstring = _country) then
          select 1 into _error;
            select 'Error, Country no existe.' into _msg;
            select _error,_msg,_id;
            LEAVE sp2;
      end if;

       select c2.id into b_country_id
             from catalogocab c inner join catalogodet c2  on c2.catalogocab_id  = c.id
                 WHERE c.tabla='PAISES' AND c2.valorstring = _country;


       /*States*/
       if not exists(select 1 from catalogocab c inner join catalogodet c2  on c2.catalogocab_id  = c.id
                 WHERE c.tabla='STATES' AND c2.valorstring = _state AND c2.valor_bigint = b_country_id) then

            insert into catalogodet(catalogocab_id,descripcion,valorstring,estado,valor_bigint)
              values((select id from catalogocab where tabla='STATES'), _state,_state,1,b_country_id);

       end if;

      if not exists(select 1 from catalogocab c inner join catalogodet c2  on c2.catalogocab_id  = c.id
                 WHERE c.tabla='STATES' AND c2.valorstring = _state AND c2.valor_bigint = b_country_id) then
          select 1 into _error;
            select 'Error, State no existe.' into _msg;
            select _error,_msg,_id;
            LEAVE sp2;
      end if;

      select c2.id into b_state_id
             from catalogocab c inner join catalogodet c2  on c2.catalogocab_id  = c.id
             WHERE c.tabla='STATES' AND c2.valorstring = _state AND c2.valor_bigint = b_country_id;

      /*Ciudades*/
       if not exists(select 1 from catalogocab c inner join catalogodet c2  on c2.catalogocab_id  = c.id
                 WHERE c.tabla='CIUDADES' AND c2.valorstring = _city AND c2.valor_bigint = b_state_id) then

            insert into catalogodet(catalogocab_id,descripcion,valorstring,estado,valor_bigint)
              values((select id from catalogocab where tabla='CIUDADES'), _city,_city,1,b_state_id);

       end if;

      if not exists(select 1 from catalogocab c inner join catalogodet c2  on c2.catalogocab_id  = c.id
                 WHERE c.tabla='CIUDADES' AND c2.valorstring = _city AND c2.valor_bigint = b_state_id) then
          select 1 into _error;
            select 'Error, City no existe.' into _msg;
            select _error,_msg,_id;
            LEAVE sp2;
      end if;

      select c2.id into b_city_id
             from catalogocab c inner join catalogodet c2  on c2.catalogocab_id  = c.id
             WHERE c.tabla='CIUDADES' AND c2.valorstring = _city AND c2.valor_bigint = b_state_id;

       if exists(select 1 from users u  WHERE u.email = _email) then
        select 1 into _error;
              select 'Error, usuario ya existe.' into _msg;
              select _error,_msg,_id;
              LEAVE sp2;
       end if;


         insert into users(name,email,password,created_at,status) values(_name,_email,_clave,now(),1);
       select  LAST_INSERT_ID() into b_usuario_id;



      if not exists(select 1 from model_has_roles where model_id= b_usuario_id) then
           select 0 into b_rol_id;
             select '' into s_modelo;
             select valor_bigint into b_rol_id
              from catalogodet c2
              inner join catalogocab c1 on c1.id = c2.catalogocab_id
              where c1.tabla='ROL-USER-CLIENT' and
                    c2.valorstring='ROL_ID';
             select valorstring2 into s_modelo
              from catalogodet c2
              inner join catalogocab c1 on c1.id = c2.catalogocab_id
              where c1.tabla='ROL-USER-CLIENT' and
                    c2.valorstring='MODELO';
           insert into model_has_roles(role_id,model_type,model_id) values(b_rol_id,s_modelo,b_usuario_id);
      end if;

      if b_usuario_id = 0 then
          select 1 into _error;
            select 'Error, C�digo de Usuario no existe.' into _msg;
            select _error,_msg,_id;
            LEAVE sp2;
      end if;

      select c.id into b_client_id from clients c where c.token = _token;


       if exists(select 1 from businessinformations b
                 WHERE b.user_id = b_usuario_id AND
                       b.client_id = b_client_id) then
            select 1 into _error;
            select 'Error, ya tenemos registrado con esta cuenta en la Secci�n Business Information.' into _msg;
            select _error,_msg,_id;
            LEAVE sp2;
       end if;

       insert into businessinformations
                    (
                     created_at,
                     company_name,
                     date_company,
                     type_business,
                     contact_name,
                     zip,
                     phone,
                     president_name,
                     address,
                     ruc_tax,
                     website,
                     secretary_name,
                     dba,
                     cell_phone,
                     user_id,
                     client_id,
                     country_id,
                     state_id,
                     city_id,
                     is_buyer,
                     is_seller)
           values(
                   now(),
                   _name,
                   d_datecompany,
                   _typebussiness,
                   _contactname,
                   _zipcode,
                   _phone,
                   _president,
                   _address,
                   _taxid,
                   IFNULL(_website,''),
                   IFNULL(_secretaryname,''),
                   IFNULL(_dba,''),
                   _cellphone,
                   b_usuario_id,
                   b_client_id,
                   b_country_id,
                   b_state_id,
                   b_city_id,
                   t_is_buyer,
                   t_is_seller
                );

       select  LAST_INSERT_ID() into _id;


       select 0 into  _error;


       select 'ok' into _msg;
       select _error,_msg, _id;
    end;




END;
//
DELIMITER ;

/*
set @id = 1;
SET @name = 'a11';
SET @email = 'a11@aaa.com';
SET @taxid = 'a';
SET @datecompany = '1982-06-28';
SET @contactname = 'a';
SET @zipcode = 'a';
SET @typebusiness = 'a';
SET @phone = 'a';
SET @president = 'a';
SET @country = 'a';
SET @state = 'a';
SET @city = 'a';
SET @address = 'a';
SET @website = 'http://www.aa.com';
SET @secretary = 'a';
SET @dba = 'a';
SET @cellphone = 'a';
SET @msg = '';
SET @is_buyer = '';
SET @is_seller = '';
SET @error = '';
CALL Update_businessinformation(@id,@name,@email,@taxid,@datecompany,@contactname,@zipcode,@typebusiness,@phone,@president,@country,@state,@city,@address,@website,@secretary,@dba,@cellphone,@is_buyer ,@is_seller @msg,@error);
SELECT @msg,@error;
*/

DROP PROCEDURE IF EXISTS Update_businessinformation;
DELIMITER //
create  PROCEDURE Update_businessinformation(
                IN _id_bi bigint,
                                IN _name varchar(255),
                                IN _email varchar(255),
                                IN _taxid varchar(255),
                                IN _datecompany varchar(255),
                                IN _contactname varchar(255),
                                IN _zipcode varchar(255),
                                IN _typebussiness varchar(255),
                                IN _phone varchar(255),
                                IN _president varchar(255),
                                IN _country varchar(255),
                                IN _state varchar(255),
                                IN _city varchar(255),
                                IN _address varchar(255),
                                IN _website varchar(255),
                                IN _secretaryname varchar(255),
                                IN _dba varchar(255),
                                IN _cellphone varchar(255),
                                IN _is_buyer varchar(255),
                                IN _is_seller varchar(255),
                                OUT _msg varchar(255),
                                OUT _error tinyint
                                )
sp:BEGIN
     Declare code varchar(5);
     Declare MSG text;

     declare b_usuario_id bigint;
     declare b_country_id bigint;
     declare b_state_id bigint;
     declare b_city_id bigint;
     declare d_datecompany date;
     declare t_is_buyer tinyint;
     declare t_is_seller tinyint;
     DECLARE exit HANDLER FOR SQLEXCEPTION

     sp1:begin
       select 1 into _error;

       Get   diagnostics condition 1 code=RETURNED_SQLSTATE, MSG=MESSAGE_TEXT;
       select CONCAT('Updates failed Business Information, error = ',code,', message = ',MSG) into _msg;
       select _error,_msg;
       LEAVE sp1;

       end;

      sp2:begin
        select 0 into t_is_buyer;
        select 0 into t_is_seller;
        if trim(ifnull(_is_buyer,''))='' then
            select 1 into _error;
            select 'Error, el is Buyer es obligatorio.' into _msg;
            select _error,_msg,_id;
            LEAVE sp2;
       end if;
      if trim(ifnull(_is_seller,''))='' then
            select 1 into _error;
            select 'Error, el is Seller es obligatorio.' into _msg;
            select _error,_msg,_id;
            LEAVE sp2;
      end if;
      if upper(trim(_is_seller))='true' or trim(_is_seller)='1' then
            select 1 into t_is_seller;
      end if;
      if upper(trim(_is_buyer))='true' or trim(_is_buyer)='1' then
            select 1 into t_is_buyer;
      end if;
        if not exists(select 1 from businessinformations c WHERE c.id = _id_bi) then
          select 1 into _error;
            select 'Error, businessinformations no existe.' into _msg;
            select _error,_msg;
            LEAVE sp2;
      end if;
     if trim(ifnull(_email,''))='' then
            select 1 into _error;
            select 'Error, el Country es obligatorio, error en Token.' into _msg;
            select _error,_msg;
            LEAVE sp2;
      end if;
     select trim(_email) into _email;
      select c.user_id into b_usuario_id from  businessinformations c where c.id = _id_bi;
      if b_usuario_id = 0 then
          select 1 into _error;
            select 'Error, C�digo de Usuario no existe.' into _msg;
            select _error,_msg;
            LEAVE sp2;
      else
         update users set updated_at =now(),email = _email, name = _name where id = b_usuario_id;
      end if;
        if STR_TO_DATE(_datecompany, '%Y-%m-%d') is  NULL then
            select 1 into _error;
            select 'Error, el formato de la fecha no es v�lido. El formato es yyyy-MM-dd Ejm: 2021-08-21.' into _msg;
            select _error,_msg;
            LEAVE sp2;
        end if;

        select STR_TO_DATE(_datecompany,'%Y-%m-%d') into d_datecompany;

         if d_datecompany > now() is  NULL then
            select 1 into _error;
            select 'Error, la fecha de la compa��a es mayor a la fecha actual.' into _msg;
            select _error,_msg,_id;
            LEAVE sp2;
        end if;

         if d_datecompany > now() is  NULL then
            select 1 into _error;
            select 'Error, la fecha de la compa��a es mayor a la fecha actual.' into _msg;
            select _error,_msg,_id;
            LEAVE sp2;
        end if;




       /*Paises*/
      if trim(ifnull(_country,''))='' then
            select 1 into _error;
            select 'Error, el Country es obligatorio.' into _msg;
            select _error,_msg;
            LEAVE sp2;
       end if;
      if trim(ifnull(_state,''))='' then
            select 1 into _error;
            select 'Error, el State es obligatorio.' into _msg;
            select _error,_msg;
            LEAVE sp2;
       end if;
      if trim(ifnull(_city,''))='' then
            select 1 into _error;
            select 'Error, el City es obligatorio.' into _msg;
            select _error,_msg;
            LEAVE sp2;
      end if;
      select trim(upper(_country)) into _country;
      select trim(upper(_state)) into _state;
      select trim(upper(_city)) into _city;
       if not exists(select 1 from catalogocab c inner join catalogodet c2  on c2.catalogocab_id  = c.id
                 WHERE c.tabla='PAISES' AND c2.valorstring = _country) then

            insert into catalogodet(catalogocab_id,descripcion,valorstring,estado)
              values((select id from catalogocab where tabla='PAISES'), _country,_country,1);

       end if;

      if not exists(select 1 from catalogocab c inner join catalogodet c2  on c2.catalogocab_id  = c.id
                 WHERE c.tabla='PAISES' AND c2.valorstring = _country) then
          select 1 into _error;
            select 'Error, Country no existe.' into _msg;
            select _error,_msg;
            LEAVE sp2;
      end if;

       select c2.id into b_country_id
             from catalogocab c inner join catalogodet c2  on c2.catalogocab_id  = c.id
                 WHERE c.tabla='PAISES' AND c2.valorstring = _country;


       /*States*/
       if not exists(select 1 from catalogocab c inner join catalogodet c2  on c2.catalogocab_id  = c.id
                 WHERE c.tabla='STATES' AND c2.valorstring = _state AND c2.valor_bigint = b_country_id) then

            insert into catalogodet(catalogocab_id,descripcion,valorstring,estado,valor_bigint)
              values((select id from catalogocab where tabla='STATES'), _state,_state,1,b_country_id);

       end if;

      if not exists(select 1 from catalogocab c inner join catalogodet c2  on c2.catalogocab_id  = c.id
                 WHERE c.tabla='STATES' AND c2.valorstring = _state AND c2.valor_bigint = b_country_id) then
          select 1 into _error;
            select 'Error, State no existe.' into _msg;
            select _error,_msg;
            LEAVE sp2;
      end if;

      select c2.id into b_state_id
             from catalogocab c inner join catalogodet c2  on c2.catalogocab_id  = c.id
             WHERE c.tabla='STATES' AND c2.valorstring = _state AND c2.valor_bigint = b_country_id;

      /*Ciudades*/
       if not exists(select 1 from catalogocab c inner join catalogodet c2  on c2.catalogocab_id  = c.id
                 WHERE c.tabla='CIUDADES' AND c2.valorstring = _city AND c2.valor_bigint = b_state_id) then

            insert into catalogodet(catalogocab_id,descripcion,valorstring,estado,valor_bigint)
              values((select id from catalogocab where tabla='CIUDADES'), _city,_city,1,b_state_id);

       end if;

      if not exists(select 1 from catalogocab c inner join catalogodet c2  on c2.catalogocab_id  = c.id
                 WHERE c.tabla='CIUDADES' AND c2.valorstring = _city AND c2.valor_bigint = b_state_id) then
          select 1 into _error;
            select 'Error, City no existe.' into _msg;
            select _error,_msg;
            LEAVE sp2;
      end if;

      select c2.id into b_city_id
             from catalogocab c inner join catalogodet c2  on c2.catalogocab_id  = c.id
             WHERE c.tabla='CIUDADES' AND c2.valorstring = _city AND c2.valor_bigint = b_state_id;



       update businessinformations
                  set
                     updated_at  = now(),
                     company_name  = _name,
                     date_company  = d_datecompany,
                     type_business = _typebussiness,
                     contact_name  = _contactname,
                     zip           = _zipcode,
                     phone         = _phone,
                     president_name = _president,
                     address = _address,
                     ruc_tax = _taxid,
                     website = IFNULL(_website,''),
                     secretary_name = IFNULL(_secretaryname,''),
                     dba = IFNULL(_dba,''),
                     cell_phone = _cellphone,
                     country_id = b_country_id,
                     state_id = b_state_id,
                     city_id = b_city_id,
                     is_buyer = t_is_buyer,
                     is_seller = t_is_seller
      where id = _id_bi;




       select 0 into  _error;


       select 'ok' into _msg;
       select _error,_msg;
    end;




END;
//
DELIMITER ;

/*
 set @item = 12;
 call Get_managments(@item);
 */

DROP PROCEDURE IF EXISTS Get_managments;
DELIMITER //
create  PROCEDURE Get_managments(IN item bigint)
BEGIN
  select m.id,m.name, m.idno,m.percentage,m.position,DATE_FORMAT(m.birthdate, '%Y-%m-%d') as birthdate,
         DATE_FORMAT(m.created_at , '%Y-%m-%d %T.%f') as created_at,
         DATE_FORMAT(m.updated_at , '%Y-%m-%d %T.%f') as updated_at,
           u.email,
           c.token

    from managements m
    inner join users u on u.id = m.user_id
    inner join clients c on c.id = m.client_id
    WHERE m.id = item;

END;
//
DELIMITER ;


/*
SET @email = 'a4578@aaa.com';
SET @token = 'CORREO3@GMAIL.COM054751f6d5f4cfa6213bCORREO3@GMAIL.COM';
 call Get_managments_client_user(@email,@token);
 */

DROP PROCEDURE IF EXISTS Get_managments_client_user;
DELIMITER //
create  PROCEDURE Get_managments_client_user(IN _mail varchar(255), in _token varchar(255))
BEGIN
  select m.id,m.name, m.idno,m.percentage,m.position,DATE_FORMAT(m.birthdate, '%Y-%m-%d') as birthdate,
         DATE_FORMAT(m.created_at , '%Y-%m-%d %T.%f') as created_at,
         DATE_FORMAT(m.updated_at , '%Y-%m-%d %T.%f') as updated_at

    from managements m
    inner join users u on u.id  = m.user_id
    inner join clients c2 on c2.id  = m.client_id
    WHERE u.email = _mail AND
          c2.token = _token ;

END;
//
DELIMITER ;

/*
SET @name = 'a';
SET @email = 'a@aaa.com';
SET @idno = '1234';
SET @position = '2332 escala 1234';
SET @birthday = '2010-06-28';
SET @percentage = '45';
SET @token = 'h5Vw5GRoyM';
SET @msg = '';
SET @error = '';
SET @id = 0;
CALL Insert_managment(@name,@email,@idno,@position,@percentage,@birthday,@token,@msg,@error,@id);
SELECT @msg,@error,@id;
 */

DROP PROCEDURE IF EXISTS Insert_managment;
DELIMITER //
create  PROCEDURE Insert_managment(
                                IN _name varchar(255),
                                IN _email varchar(255),
                                IN _idno varchar(255),
                                IN _position varchar(255),
                                IN _percentage varchar(255),
                                IN _birthday varchar(255),
                                IN _token varchar(255),
                                OUT _msg varchar(255),
                                OUT _error tinyint ,
                                OUT _id bigint
                                )
sp:BEGIN
     Declare code varchar(5);
     Declare MSG text;
     declare b_client_id bigint;
     declare b_usuario_id bigint;
     declare d_datecompany date;
     declare d_percentage double;
     DECLARE exit HANDLER FOR SQLEXCEPTION

     sp1:begin
       select 1 into _error;
       select 0 into _id;
       Get   diagnostics condition 1 code=RETURNED_SQLSTATE, MSG=MESSAGE_TEXT;
       select CONCAT('Inserts failed Managment, error = ',code,', message = ',MSG) into _msg;
       select _error,_msg,_id;
       LEAVE sp1;

       end;

      sp2:begin
        select 0 into _id;
        select 0 into d_percentage;
        if STR_TO_DATE(_birthday, '%Y-%m-%d') is  NULL then
            select 1 into _error;
            select 'Error, el formato de la fecha no es v�lido. El formato es yyyy-MM-dd Ejm: 2021-08-21.' into _msg;
            select _error,_msg,_id;
            LEAVE sp2;
        end if;

        select STR_TO_DATE(_birthday,'%Y-%m-%d') into d_datecompany;


        if timestampdiff(YEAR,d_datecompany,now())<18 then
            select 1 into _error;
            select 'Error, el ownership debe tener la mayor�a de edad.' into _msg;
            select _error,_msg,_id;
            LEAVE sp2;
        end if;



        if timestampdiff(YEAR,d_datecompany,now())<18 then
            select 1 into _error;
            select 'Error, el ownership debe tener la mayor�a de edad.' into _msg;
            select _error,_msg,_id;
            LEAVE sp2;
        end if;




       if not exists(select 1 from clients c  WHERE c.token = _token) then
            select 1 into _error;
            select 'Error, Origen del Market no existe, error en Token.' into _msg;
            select _error,_msg,_id;
            LEAVE sp2;
       end if;


       if not exists(select 1 from users u  WHERE u.email = _email) then
         select 1 into _error;
            select 'Error, Usuario no existe con ese mail.' into _msg;
            select _error,_msg,_id;
            LEAVE sp2;
        end if;
        if exists(select count(*) from managements m
                  inner join users u on u.id = m.user_id
                  inner join clients c on c.id = m.client_id
                  WHERE u.email = _email AND
                        c.token = _token
                  group by m.user_id,m.client_id
                  HAVING count(*)=4) then
         select 1 into _error;
            select 'Error, No se pueden guardar mas de 4 items como ownership.' into _msg;
            select _error,_msg,_id;
            LEAVE sp2;
        end if;

      select u.id into b_usuario_id from users u  WHERE u.email = _email;
      select c.id into b_client_id from clients c where c.token = _token;


      select _percentage into d_percentage;

       insert into managements
                    (
                     created_at,
                     name,
                     idno ,
                     percentage ,
                     position ,
                     birthdate ,
                     user_id ,
                     client_id)
           values(
                   now(),
                   _name,
                   _idno,
                   d_percentage,
                   _position,
                   d_datecompany,
                   b_usuario_id,
                   b_client_id
                );

       select  LAST_INSERT_ID() into _id;


       select 0 into  _error;


       select 'ok' into _msg;
       select _error,_msg, _id;
    end;

END;
//
DELIMITER ;

/*
SET @id = 1;
SET @name = 'a';
SET @email = 'bbba4578@aaa.com';
SET @idno = 'aaa1234';
SET @position = 'bbbbescala 1234';
SET @birthday = '1982-06-28';
SET @percentage = '45';
SET @msg = '';
SET @error = '';
CALL Update_managment(@id,@name,@idno,@position,@percentage,@birthday,@msg,@error);
SELECT @msg,@error;
 */

DROP PROCEDURE IF EXISTS Update_managment;
DELIMITER //
create  PROCEDURE Update_managment(
                                IN _id bigint,
                IN _name varchar(255),
                                IN _idno varchar(255),
                                IN _position varchar(255),
                                IN _percentage varchar(255),
                                IN _birthday varchar(255),
                                OUT _msg varchar(255),
                                OUT _error tinyint
                                )
sp:BEGIN
     Declare code varchar(5);
     Declare MSG text;
     declare d_datecompany date;
     declare d_percentage double;
     DECLARE exit HANDLER FOR SQLEXCEPTION

     sp1:begin
       select 1 into _error;

       Get   diagnostics condition 1 code=RETURNED_SQLSTATE, MSG=MESSAGE_TEXT;
       select CONCAT('Update failed Managment, error = ',code,', message = ',MSG) into _msg;
       select _error,_msg;
       LEAVE sp1;

       end;

      sp2:begin

        select 0 into d_percentage;
        if not exists(select 1 from managements m where m.id = _id) then
            select 1 into _error;
            select 'Error, no existe el registro en la tabla managements.' into _msg;
            select _error,_msg;
            LEAVE sp2;
        end if;
        if STR_TO_DATE(_birthday, '%Y-%m-%d') is  NULL then
            select 1 into _error;
            select 'Error, el formato de la fecha no es v�lido. El formato es yyyy-MM-dd Ejm: 2021-08-21.' into _msg;
            select _error,_msg;
            LEAVE sp2;
        end if;

        select STR_TO_DATE(_birthday,'%Y-%m-%d') into d_datecompany;
        if timestampdiff(YEAR,d_datecompany,now())<18 then
            select 1 into _error;
            select 'Error, el ownership debe tener la mayoria de edad.' into _msg;
            select _error,_msg,_id;
            LEAVE sp2;
        end if;

      select _percentage into d_percentage;

       update  managements
                 set
                     updated_at = now(),
                     name = _name,
                     idno = _idno,
                     percentage = d_percentage ,
                     position = _position ,
                     birthdate = d_datecompany
        where id = _id;

       select 0 into  _error;


       select 'ok' into _msg;
       select _error,_msg;
    end;

END;
//
DELIMITER ;

/*
 set @item = 1;
 call Get_financial(@item);
 */

DROP PROCEDURE IF EXISTS Get_financial;
DELIMITER //
create  PROCEDURE Get_financial(IN item bigint)
BEGIN

   select f.id,
          f.avg_montky_sales,
          f.ams_how_clients,
          case f.has_applicant when 0 then 'false' else 'true' end has_applicant,
          case f.po_finance when 0 then 'false' else 'true' end po_finance,
          case f.in_finance when 0 then 'false' else 'true' end in_finance,
          case f.lawsuits_pending when 0 then 'false' else 'true' end lawsuits_pending,
          case f.receivable_finance when 0 then 'false' else 'true' end receivable_finance,
          case f.credit_insurance_policy when 0 then 'false' else 'true' end credit_insurance_policy,
          case f.declared_bank_ruptcy when 0 then 'false' else 'true' end declared_bank_ruptcy,
          f.estimated_montly_financing,
          f.emf_number_clients,
          f.rf_when_with_whom,
          f.cip_when_with_whom,

         DATE_FORMAT(f.created_at , '%Y-%m-%d %T.%f') as created_at,
         DATE_FORMAT(f.updated_at , '%Y-%m-%d %T.%f') as updated_at

    from financialrequests f
    WHERE f.id = item;

END;
//
DELIMITER ;


/*
SET @email = 'mflores@fintradeweb.com';
SET @token = 'h5Vw5GRoyM';
 call Get_financial_client_user(@email,@token);
 avg_montky_sales
 */

DROP PROCEDURE IF EXISTS Get_financial_client_user;
DELIMITER //
create  PROCEDURE Get_financial_client_user(IN _mail varchar(255), in _token varchar(255))
BEGIN
   declare b_is_exist tinyint;
   select 0 into b_is_exist ;
   if(exists(
         select
             1
          from financialrequests f
        inner join users u on u.id  = f.user_id
        inner join clients c2 on c2.id  = f.client_id
        WHERE u.email = _mail AND
              c2.token = _token
      )) then
      select 1 into b_is_exist ;
   end if;
   select b_is_exist existe;
   select f.id,
          f.avg_montky_sales,
          f.ams_how_clients,
          case f.has_applicant when 0 then 'false' else 'checked' end has_applicant,
          case f.po_finance when 0 then 'false' else 'checked' end po_finance,
          case f.in_finance when 0 then 'false' else 'checked' end in_finance,
          case f.lawsuits_pending when 0 then 'false' else 'checked' end lawsuits_pending,
          case f.receivable_finance when 0 then 'false' else 'checked' end receivable_finance,
          case f.credit_insurance_policy when 0 then 'false' else 'checked' end credit_insurance_policy,
          case f.declared_bank_ruptcy when 0 then 'false' else 'checked' end declared_bank_ruptcy,
          f.estimated_montly_financing,
          f.emf_number_clients,
          f.rf_when_with_whom,
          f.cip_when_with_whom,

         DATE_FORMAT(f.created_at , '%Y-%m-%d %T.%f') as created_at,
         DATE_FORMAT(f.updated_at , '%Y-%m-%d %T.%f') as updated_at

    from financialrequests f
    inner join users u on u.id  = f.user_id
    inner join clients c2 on c2.id  = f.client_id
    WHERE u.email = _mail AND
          c2.token = _token ;

END;
//
DELIMITER ;

/*
SET @email = 'mm44@gmail.com';
set @avg_montky_sales =1;
set @ams_how_clients =2;
set @has_applicant =1;
set @po_finance =1;
set @in_finance =1;
set @lawsuits_pending =1;
set @receivable_finance =1;
set @credit_insurance_policy =1;
set @declared_bank_ruptcy =3;
set @estimated_montly_financing =33;
set @emf_number_clients =3;
set @rf_when_with_whom =11;
set @cip_when_with_whom =22;
SET @token = 'KUOMQ2w60A';
SET @msg = '';
SET @error = 0;
SET @id = 0;
CALL Insert_financial(@avg_montky_sales,@ams_how_clients,@has_applicant,@po_finance,@in_finance,
       @lawsuits_pending,@receivable_finance,@credit_insurance_policy, @declared_bank_ruptcy,@estimated_montly_financing,
       @emf_number_clients, @rf_when_with_whom, @cip_when_with_whom,  @email,@token,@msg,@error,@id);
SELECT @msg,@error,@id;
 */

DROP PROCEDURE IF EXISTS Insert_financial;
DELIMITER //
/*
 (22,22,1,1,0,1,0,0,0,2,2,22,22,m11@gmai.com,KUOMQ2w60A,,0,0)
 * */

create  PROCEDURE Insert_financial(
                                IN _avg_montky_sales double,
                                IN _ams_how_clients int,
                                IN _has_applicant tinyint,
                                IN _po_finance tinyint,
                                IN _in_finance tinyint,
                                IN _lawsuits_pending tinyint,
                                IN _receivable_finance tinyint,
                                IN _credit_insurance_policy tinyint,
                                IN _declared_bank_ruptcy tinyint,
                                IN _estimated_montly_financing double,
                                IN _emf_number_clients int,
                                IN _rf_when_with_whom double,
                                IN _cip_when_with_whom int,
                                IN _email varchar(255),
                                IN _token varchar(255),
                                OUT _msg varchar(255),
                                OUT _error tinyint ,
                                OUT _id bigint
                                )
sp:BEGIN
     Declare code varchar(5);
     Declare MSG text;
     declare b_client_id bigint;
     declare b_usuario_id bigint;

     DECLARE exit HANDLER FOR SQLEXCEPTION

     sp1:begin
       select 1 into _error;
       select 0 into _id;
       Get   diagnostics condition 1 code=RETURNED_SQLSTATE, MSG=MESSAGE_TEXT;
       select CONCAT('Inserts failed Financial, error = ',code,', message = ',MSG) into _msg;
       select _error,_msg,_id;
       LEAVE sp1;

       end;

      sp2:begin
        select 0 into _id;



       if not exists(select 1 from clients c  WHERE c.token = _token) then
            select 1 into _error;
            select 'Error, Origen del Market no existe, error en Token.' into _msg;
            select _error,_msg,_id;
            LEAVE sp2;
       end if;


       if not exists(select 1 from users u  WHERE u.email = _email) then
         select 1 into _error;
            select 'Error, Usuario no existe con ese mail.' into _msg;
            select _error,_msg,_id;
            LEAVE sp2;
        end if;

      select u.id into b_usuario_id from users u  WHERE u.email = _email;
      select c.id into b_client_id from clients c where c.token = _token;

      if exists(select 1 from financialrequests u  WHERE u.client_id =b_client_id and u.user_id  = b_usuario_id ) then
         select 1 into _error;
            select 'Error, Ya se encuentra registrado un Financial.' into _msg;
            select _error,_msg,_id;
            LEAVE sp2;
        end if;


       insert into financialrequests
                    (
                    created_at,
                    avg_montky_sales ,
                        ams_how_clients ,
                        has_applicant ,
                        po_finance ,
                        in_finance ,
                        lawsuits_pending ,
                        receivable_finance ,
                        credit_insurance_policy ,
                        declared_bank_ruptcy ,
                        estimated_montly_financing ,
                        emf_number_clients ,
                        rf_when_with_whom ,
                        cip_when_with_whom ,
                    user_id ,
                    client_id)
           values(
                   now(),
                    _avg_montky_sales ,
                        _ams_how_clients ,
                        _has_applicant ,
                        _po_finance ,
                        _in_finance ,
                        _lawsuits_pending ,
                        _receivable_finance ,
                        _credit_insurance_policy ,
                        _declared_bank_ruptcy ,
                        _estimated_montly_financing ,
                        _emf_number_clients ,
                        _rf_when_with_whom ,
                        _cip_when_with_whom,
                    b_usuario_id,
                    b_client_id
                );

       select  LAST_INSERT_ID() into _id;


       select 0 into  _error;


       select 'ok' into _msg;
       select _error,_msg, _id;
    end;

END;
//
DELIMITER ;


/*
SET @id = 1;
set @avg_montky_sales =15.9;
set @ams_how_clients =2;
set @has_applicant =1;
set @po_finance =0;
set @in_finance =1;
set @lawsuits_pending =0;
set @receivable_finance =0;
set @credit_insurance_policy =1;
set @declared_bank_ruptcy =0;
set @estimated_montly_financing =250;
set @emf_number_clients =3;
set @rf_when_with_whom =12;
set @cip_when_with_whom =2;
SET @msg = '';
SET @error = '';
CALL Update_financial(@id,@avg_montky_sales,@ams_how_clients,@has_applicant,@po_finance,@in_finance,
       @lawsuits_pending,@receivable_finance,@credit_insurance_policy, @declared_bank_ruptcy,@estimated_montly_financing,
       @emf_number_clients, @rf_when_with_whom, @cip_when_with_whom,@msg,@error);
SELECT @msg,@error;
 */

DROP PROCEDURE IF EXISTS Update_financial;
DELIMITER //
create  PROCEDURE Update_financial(
                                IN _id bigint,
                IN _avg_montky_sales double,
                                IN _ams_how_clients int,
                                IN _has_applicant tinyint,
                                IN _po_finance tinyint,
                                IN _in_finance tinyint,
                                IN _lawsuits_pending tinyint,
                                IN _receivable_finance tinyint,
                                IN _credit_insurance_policy tinyint,
                                IN _declared_bank_ruptcy tinyint,
                                IN _estimated_montly_financing double,
                                IN _emf_number_clients int,
                                IN _rf_when_with_whom double,
                                IN _cip_when_with_whom int,
                                OUT _msg varchar(255),
                                OUT _error tinyint
                                )
sp:BEGIN
     Declare code varchar(5);
     Declare MSG text;

     DECLARE exit HANDLER FOR SQLEXCEPTION

     sp1:begin
       select 1 into _error;

       Get   diagnostics condition 1 code=RETURNED_SQLSTATE, MSG=MESSAGE_TEXT;
       select CONCAT('Update failed Financial, error = ',code,', message = ',MSG) into _msg;
       select _error,_msg;
       LEAVE sp1;

       end;

      sp2:begin

        if not exists(select 1 from financialrequests f  where f.id = _id) then
            select 1 into _error;
            select 'Error, no existe el registro en la tabla financial.' into _msg;
            select _error,_msg;
            LEAVE sp2;
        end if;


       update  financialrequests
                 set
                    updated_at = now(),
                    avg_montky_sales  = _avg_montky_sales,
                        ams_how_clients  = _ams_how_clients,
                        has_applicant = _has_applicant ,
                        po_finance = _po_finance ,
                        in_finance  = _in_finance,
                        lawsuits_pending  = _lawsuits_pending,
                        receivable_finance = _receivable_finance ,
                        credit_insurance_policy = _credit_insurance_policy ,
                        declared_bank_ruptcy  = _declared_bank_ruptcy,
                        estimated_montly_financing  = _estimated_montly_financing,
                        emf_number_clients  = _emf_number_clients,
                        rf_when_with_whom = _rf_when_with_whom ,
                        cip_when_with_whom  = _cip_when_with_whom
        where id = _id;

       select 0 into  _error;


       select 'ok' into _msg;
       select _error,_msg;
    end;

END;
//
DELIMITER ;


/*
 set @item = 1;
 call Get_bankinformation(@item);
 */

DROP PROCEDURE IF EXISTS Get_bankinformation;
DELIMITER //
create  PROCEDURE Get_bankinformation(IN item bigint)
BEGIN

   select f.id,
          f.bank_name,
          f.account_same_swift,
          f.account_number,
          f.aba_routing,
          f.bank_adress,
          f.adress,
          f.telephone,
          f.account_officer,


         DATE_FORMAT(f.created_at , '%Y-%m-%d %T.%f') as created_at,
         DATE_FORMAT(f.updated_at , '%Y-%m-%d %T.%f') as updated_at

    from bankinformations f
    WHERE f.id = item;

END;
//
DELIMITER ;

/*
SET @email = 'a4578@aaa.com';
SET @token = 'CORREO3@GMAIL.COM054751f6d5f4cfa6213bCORREO3@GMAIL.COM';
 call Get_bankinformation_client_user(@email,@token);
 */

DROP PROCEDURE IF EXISTS Get_bankinformation_client_user;
DELIMITER //
create  PROCEDURE Get_bankinformation_client_user(IN _mail varchar(255), in _token varchar(255))
BEGIN
    declare b_is_exist tinyint;
   select 0 into b_is_exist ;
   if(exists(
         select
             1
          from bankinformations f
        inner join users u on u.id  = f.user_id
        inner join clients c2 on c2.id  = f.client_id
        WHERE u.email = _mail AND
              c2.token = _token
      )) then
      select 1 into b_is_exist ;
   end if;
   select b_is_exist existe;

   select f.id,
          f.bank_name,
          f.account_same_swift,
          f.account_number,
          f.aba_routing,
          f.bank_adress,
          f.adress,
          f.telephone,
          f.account_officer,


         DATE_FORMAT(f.created_at , '%Y-%m-%d %T.%f') as created_at,
         DATE_FORMAT(f.updated_at , '%Y-%m-%d %T.%f') as updated_at

    from bankinformations f
    inner join users u on u.id  = f.user_id
    inner join clients c2 on c2.id  = f.client_id
    WHERE u.email = _mail AND
          c2.token = _token ;

END;
//
DELIMITER ;

/*
SET @email = 'a4578@aaa.com';
set @_bank_name ="bank 15.9";
set @account_same_swift =" name acconut2 ";
set @account_number ="154564564654";
set @aba_routing ="sddsdsd0";
set @bank_adress ="adress bank1";
set @adress ="adress bank1111";
set @telephone ="54654654650";
set @account_officer ="officer test0";
SET @token = 'CORREO3@GMAIL.COM054751f6d5f4cfa6213bCORREO3@GMAIL.COM';
SET @msg = '';
SET @error = '';
SET @id = 0;
CALL Insert_bankinformation(@email,@_bank_name, @account_same_swift,
      @account_number,@aba_routing , @bank_adress, @telephone, @account_officer,@adress,
      @token,@msg,@error,@id);
SELECT @msg,@error,@id;
 */

DROP PROCEDURE IF EXISTS Insert_bankinformation;
DELIMITER //
create  PROCEDURE Insert_bankinformation(
                                IN _email varchar(255),
                                IN _bank_name varchar(255),
                                IN _account_same_swift varchar(255),
                                IN _account_number varchar(255),
                                IN _aba_routing varchar(255),
                                IN _bank_adress varchar(255),
                                IN _telephone varchar(255),
                                IN _account_officer varchar(255),
                                IN _adress varchar(255),
                                IN _token varchar(255),
                                OUT _msg varchar(255),
                                OUT _error tinyint ,
                                OUT _id bigint
                                )
sp:BEGIN
     Declare code varchar(5);
     Declare MSG text;
     declare b_client_id bigint;
     declare b_usuario_id bigint;

     DECLARE exit HANDLER FOR SQLEXCEPTION

     sp1:begin
       select 1 into _error;
       select 0 into _id;
       Get   diagnostics condition 1 code=RETURNED_SQLSTATE, MSG=MESSAGE_TEXT;
       select CONCAT('Inserts failed Bank Information, error = ',code,', message = ',MSG) into _msg;
       select _error,_msg,_id;
       LEAVE sp1;

       end;

      sp2:begin
        select 0 into _id;



       if not exists(select 1 from clients c  WHERE c.token = _token) then
            select 1 into _error;
            select 'Error, Origen del Market no existe, error en Token.' into _msg;
            select _error,_msg,_id;
            LEAVE sp2;
       end if;


       if not exists(select 1 from users u  WHERE u.email = _email) then
         select 1 into _error;
            select 'Error, Email no existe con ese mail.' into _msg;
            select _error,_msg,_id;
            LEAVE sp2;
        end if;

      select u.id into b_usuario_id from users u  WHERE u.email = _email;
      select c.id into b_client_id from clients c where c.token = _token;

      if exists(select 1 from bankinformations u  WHERE u.client_id =b_client_id and u.user_id  = b_usuario_id ) then
         select 1 into _error;
            select 'Error, Ya se encuentra registrado un bank Information.' into _msg;
            select _error,_msg,_id;
            LEAVE sp2;
        end if;


       insert into bankinformations
                    (
                    created_at,
                    bank_name ,
                    account_same_swift,
                    account_number,
                    aba_routing,
                    bank_adress,
                    telephone,
                    account_officer,
                    adress,
                    user_id ,
                    client_id)
           values(
                   now(),
                    _bank_name ,
                    _account_same_swift,
                    _account_number,
                    _aba_routing,
                    _bank_adress,
                    _telephone,
                    _account_officer,
                    _adress,
                    b_usuario_id,
                    b_client_id
                );

       select  LAST_INSERT_ID() into _id;


       select 0 into  _error;


       select 'ok' into _msg;
       select _error,_msg, _id;
    end;

END;
//
DELIMITER ;


/*
SET @id = 1;
set @_bank_name ="cambiado bank 15.9";
set @account_same_swift =" name acconut2 ";
set @account_number ="154564564654";
set @aba_routing ="sddsdsd0";
set @bank_adress ="adress bank1";
set @adress ="323  adress bank1";
set @telephone ="54654654650";
set @account_officer ="officer test0";
SET @msg = '';
SET @error = '';
CALL Update_bankinformation(@id,@_bank_name, @account_same_swift,
      @account_number,@aba_routing , @bank_adress, @telephone, @account_officer,@adress,@msg,@error);
SELECT @msg,@error;
 */

DROP PROCEDURE IF EXISTS Update_bankinformation;
DELIMITER //
create  PROCEDURE Update_bankinformation(
                                IN _id bigint,
                IN _bank_name varchar(255),
                                IN _account_same_swift varchar(255),
                                IN _account_number varchar(255),
                                IN _aba_routing varchar(255),
                                IN _bank_adress varchar(255),
                                IN _telephone varchar(255),
                                IN _account_officer varchar(255),
                                IN _adress varchar(255),
                                OUT _msg varchar(255),
                                OUT _error tinyint
                                )
sp:BEGIN
     Declare code varchar(5);
     Declare MSG text;

     DECLARE exit HANDLER FOR SQLEXCEPTION

     sp1:begin
       select 1 into _error;

       Get   diagnostics condition 1 code=RETURNED_SQLSTATE, MSG=MESSAGE_TEXT;
       select CONCAT('Update failed Bank information, error = ',code,', message = ',MSG) into _msg;
       select _error,_msg;
       LEAVE sp1;

       end;

      sp2:begin

        if not exists(select 1 from bankinformations f  where f.id = _id) then
            select 1 into _error;
            select 'Error, no existe el registro en la tabla bank Information.' into _msg;
            select _error,_msg;
            LEAVE sp2;
        end if;


       update  bankinformations
                 set
                    updated_at = now(),
                    bank_name  = _bank_name,
                    account_same_swift = _account_same_swift,
                    account_number = _account_number,
                    aba_routing = _aba_routing,
                    bank_adress = _bank_adress,
                    adress = _adress,
                    telephone = _telephone,
                    account_officer = _account_officer
        where id = _id;

       select 0 into  _error;


       select 'ok' into _msg;
       select _error,_msg;
    end;

END;
//
DELIMITER ;



/*
 set @item = 1;
 call Get_certification(@item);
 */

DROP PROCEDURE IF EXISTS Get_certification;
DELIMITER //
create  PROCEDURE Get_certification(IN item bigint)
BEGIN

   select f.id,
          case f.approved_agreed when 1 then ' checked ' else ' ' end approved_agreed,
          f.name,
          f.title,

         DATE_FORMAT(f.created_at , '%Y-%m-%d %T.%f') as created_at,
         DATE_FORMAT(f.updated_at , '%Y-%m-%d %T.%f') as updated_at

    from certificationauthorizations f
    WHERE f.id = item;

END;
//
DELIMITER ;



/*
SET @email = 'a4578@aaa.com';
SET @token = 'CORREO3@GMAIL.COM054751f6d5f4cfa6213bCORREO3@GMAIL.COM';
 call Get_certification_client_user(@email,@token);
 */

DROP PROCEDURE IF EXISTS Get_certification_client_user;
DELIMITER //
create  PROCEDURE Get_certification_client_user(IN _mail varchar(255), in _token varchar(255))
BEGIN
   declare b_is_exist tinyint;
   if(exists(
         select
             1
          from certificationauthorizations  f
        inner join users u on u.id  = f.user_id
        inner join clients c2 on c2.id  = f.client_id
        WHERE u.email = _mail AND
              c2.token = _token
      )) then
      select 1 into b_is_exist ;
   end if;
   select b_is_exist existe;
   select f.id,
          case f.approved_agreed when 1 then ' checked' else ' ' end approved_agreed,
          f.name,
          f.title,

         DATE_FORMAT(f.created_at , '%Y-%m-%d %T.%f') as created_at,
         DATE_FORMAT(f.updated_at , '%Y-%m-%d %T.%f') as updated_at

    from certificationauthorizations f
    inner join users u on u.id  = f.user_id
    inner join clients c2 on c2.id  = f.client_id
    WHERE u.email = _mail AND
          c2.token = _token ;

END;
//
DELIMITER ;



/*
SET @email = 'a4578@aaa.com';
set @_approved_agreed =1;
set @_name =" name acconut2 ";
set @_title ="title 154564564654";
SET @token = 'CORREO3@GMAIL.COM054751f6d5f4cfa6213bCORREO3@GMAIL.COM';
SET @msg = '';
SET @error = '';
SET @id = 0;
CALL Insert_certification(@email,@_approved_agreed, @_name,@_title,@token,@msg,@error,@id);
SELECT @msg,@error,@id;
 */

DROP PROCEDURE IF EXISTS Insert_certification;
DELIMITER //
create  PROCEDURE Insert_certification(
                                IN _email varchar(255),
                                IN _approved_agreed tinyint,
                                IN _name varchar(255),
                                IN _title varchar(255),
                                IN _token varchar(255),
                                OUT _msg varchar(255),
                                OUT _error tinyint ,
                                OUT _id bigint
                                )
sp:BEGIN
     Declare code varchar(5);
     Declare MSG text;
     declare b_client_id bigint;
     declare b_usuario_id bigint;

     DECLARE exit HANDLER FOR SQLEXCEPTION

     sp1:begin
       select 1 into _error;
       select 0 into _id;
       Get   diagnostics condition 1 code=RETURNED_SQLSTATE, MSG=MESSAGE_TEXT;
       select CONCAT('Inserts failed Certifications, error = ',code,', message = ',MSG) into _msg;
       select _error,_msg,_id;
       LEAVE sp1;

       end;

      sp2:begin
        select 0 into _id;



       if not exists(select 1 from clients c  WHERE c.token = _token) then
            select 1 into _error;
            select 'Error, Origen del Market no existe, error en Token.' into _msg;
            select _error,_msg,_id;
            LEAVE sp2;
       end if;


       if not exists(select 1 from users u  WHERE u.email = _email) then
         select 1 into _error;
            select 'Error, Email no existe con ese mail.' into _msg;
            select _error,_msg,_id;
            LEAVE sp2;
        end if;

      select u.id into b_usuario_id from users u  WHERE u.email = _email;
      select c.id into b_client_id from clients c where c.token = _token;

      if exists(select 1 from certificationauthorizations u  WHERE u.client_id =b_client_id and u.user_id  = b_usuario_id ) then
         select 1 into _error;
            select 'Error, Ya se encuentra registrado en Certifications.' into _msg;
            select _error,_msg,_id;
            LEAVE sp2;
        end if;


       insert into certificationauthorizations
                    (
                    created_at,
                    name ,
                    title ,
                    approved_agreed ,
                    user_id ,
                    client_id)
           values(
                   now(),
                    _name ,
                    _title,
                    _approved_agreed,
                    b_usuario_id,
                    b_client_id
                );

       select  LAST_INSERT_ID() into _id;


       select 0 into  _error;


       select 'ok' into _msg;
       select _error,_msg, _id;
    end;

END;
//
DELIMITER ;




/*
SET @id = 1;
set @_approved_agreed =1;
set @_name =" updatr name acconut2 ";
set @_title =" upd title 154564564654";
SET @msg = '';
SET @error = '';
CALL Update_certification(@id,@_approved_agreed, @_name,@_title,@msg,@error);
SELECT @msg,@error;
 */

DROP PROCEDURE IF EXISTS Update_certification;
DELIMITER //
create  PROCEDURE Update_certification(
                                IN _id bigint,
                IN _approved_agreed tinyint,
                                IN _name varchar(255),
                                IN _title varchar(255),
                                OUT _msg varchar(255),
                                OUT _error tinyint
                                )
sp:BEGIN
     Declare code varchar(5);
     Declare MSG text;

     DECLARE exit HANDLER FOR SQLEXCEPTION

     sp1:begin
       select 1 into _error;

       Get   diagnostics condition 1 code=RETURNED_SQLSTATE, MSG=MESSAGE_TEXT;
       select CONCAT('Update failed Certification, error = ',code,', message = ',MSG) into _msg;
       select _error,_msg;
       LEAVE sp1;

       end;

      sp2:begin

        if not exists(select 1 from bankinformations f  where f.id = _id) then
            select 1 into _error;
            select 'Error, no existe el registro en la tabla Certification.' into _msg;
            select _error,_msg;
            LEAVE sp2;
        end if;


       update  certificationauthorizations
                 set
                    updated_at = now(),
                    title  = _title,
                    approved_agreed = _approved_agreed,
                    name = _name
        where id = _id;

       select 0 into  _error;


       select 'ok' into _msg;
       select _error,_msg;
    end;

END;
//
DELIMITER ;



/*
 call Get_countries;
 */

DROP PROCEDURE IF EXISTS Get_countries;
DELIMITER //
create  PROCEDURE Get_countries()
BEGIN

   select
   c3.id,
   c3.descripcion description

    from catalogocab c
    inner join catalogodet c3 on c.id = c3.catalogocab_id
    WHERE c.tabla ='PAISES'
   order by 2;

END;
//
DELIMITER ;

/*
 SET @country_id = 2;
 call Get_states(@country_id);
 */

DROP PROCEDURE IF EXISTS Get_states;
DELIMITER //
create  PROCEDURE Get_states(IN _country_id bigint)
BEGIN

   select
   c3.id,
   c3.descripcion description

    from catalogocab c
    inner join catalogodet c3 on c.id = c3.catalogocab_id
    WHERE c.tabla ='STATES' AND
          c3.valor_bigint  = _country_id
   order by 2;

END;
//
DELIMITER ;

/*
 SET @state_id = 5;
 call Get_cities(@state_id);
 */

DROP PROCEDURE IF EXISTS Get_cities;
DELIMITER //
create  PROCEDURE Get_cities(IN _state_id bigint)
BEGIN

   select
   c3.id,
   c3.descripcion description

    from catalogocab c
    inner join catalogodet c3 on c.id = c3.catalogocab_id
    WHERE c.tabla ='CIUDADES' AND
          c3.valor_bigint  = _state_id
   order by 2;

END;
//
DELIMITER ;

/*
 SET @role = 1;
 call Get_users_roles (@role,'All','','','','');
 */

DROP PROCEDURE IF EXISTS Get_users_roles;
DELIMITER //
create  PROCEDURE Get_users_roles(
                              IN _roleid bigint,
                              IN _estado varchar(255),
                              IN _fecha_inicio varchar(255),
                              IN _fecha_fin varchar(255),
                              IN _ruc varchar(255),
                              IN _orden varchar(255)
                              )


BEGIN
	declare d_start timestamp;
    declare d_end timestamp;

     if(_roleid>0) then
     begin
	   if(ifnull(_fecha_inicio,'') ='') then
	   begin
		   select u.email ,u.name ,r.name  as role_desc,r.id as role_id,
		       u.id user_id, DATE_FORMAT(u.created_at , '%Y-%m-%d') as created_at,
		       CASE
		         when  r.id = 3 and exists(select 1 from credit_approved c where c.user_id = u.id) then 'Credit Approved'
		         when  r.id = 3 and exists(select 1 from credit_denied c where c.user_id = u.id) then 'Credit Denied'
		         when  r.id = 3 and  exists(select 1 from certificationauthorizations c where c.user_id = u.id) then 'Request received'
		         when  r.id = 3 and not exists(select 1 from certificationauthorizations c where c.user_id = u.id) then 'Request incomplete'
		         else 'He is not client.'
		       END credit_status,

		       CASE
		         when  r.id = 3 and exists(select 1 from businessinformations c where c.user_id = u.id and c.is_buyer=1) then 'Buyer'
		         when  r.id = 3 and exists(select 1 from businessinformations c where c.user_id = u.id and c.is_seller =1) then 'Seller'
		         when  r.id = 3 and exists(select 1 from businessinformations c where c.user_id = u.id and c.is_seller =1 and c.is_buyer=1) then 'Buyer/Seller'
		         else 'He is not client.'
		       END type_user,
		       ifnull(x.is_buyer,0) is_buyer,
		       ifnull(x.is_seller,0) is_seller


		   FROM model_has_roles mhr
		   INNER JOIN users u ON u.id = mhr.model_id
		   inner join roles r on r.id = mhr.role_id
		   left outer join businessinformations x on x.user_id = u.id
		   where r.id = _roleid
		   order by 2;
	   end;
	   else
	   begin
	 	   select concat(_fecha_inicio,' 00:00:00') into _fecha_inicio;
	 	   select STR_TO_DATE(_fecha_inicio, '%Y-%m-%d %H:%i:%s') into d_start;
	   end;
	   end if;

	   if(ifnull(_fecha_fin,'') ='' ) then
	   begin
	       select DATE_ADD(now(), INTERVAL 10 DAY) into d_end;
	   end;
	   else
	   begin
	       select concat(_fecha_fin,' 23:59:59') into _fecha_fin;
     	   select STR_TO_DATE(_fecha_fin, '%Y-%m-%d %H:%i:%s') into d_end;
	   end;
	   end if;


	   if(_estado in('All','')) then
	   begin
	       select u.email ,u.name ,r.name  as role_desc,r.id as role_id,
	           u.id user_id, DATE_FORMAT(u.created_at , '%Y-%m-%d') as created_at,
	           CASE
	             when  r.id = 3 and exists(select 1 from credit_approved c where c.user_id = u.id) then 'Credit Approved'
	             when  r.id = 3 and exists(select 1 from credit_denied c where c.user_id = u.id) then 'Credit Denied'
	             when  r.id = 3 and  exists(select 1 from certificationauthorizations c where c.user_id = u.id) then 'Request received'
	             when  r.id = 3 and not exists(select 1 from certificationauthorizations c where c.user_id = u.id) then 'Request incomplete'
	             else 'He is not client.'
	           END credit_status,

	           CASE
	             when  r.id = 3 and exists(select 1 from businessinformations c where c.user_id = u.id and c.is_buyer=1) then 'Buyer'
	             when  r.id = 3 and exists(select 1 from businessinformations c where c.user_id = u.id and c.is_seller =1) then 'Seller'
	             when  r.id = 3 and exists(select 1 from businessinformations c where c.user_id = u.id and c.is_seller =1 and c.is_buyer=1) then 'Buyer/Seller'
	             else 'He is not client.'
	           END type_user,
	           ifnull(x.is_buyer,0) is_buyer,
	           ifnull(x.is_seller,0) is_seller,
	           ifnull(x.ruc_tax,'') ruc_tax,
	           ifnull(co.name,'Sin empresa') company_name,
	           ifnull(co.id,0) company_id

	       FROM model_has_roles mhr
	       INNER JOIN users u ON u.id = mhr.model_id
	       inner join roles r on r.id = mhr.role_id
	       left outer join businessinformations x on x.user_id = u.id
	       left outer join usercompany uc on uc.user_id = u.id
	       left outer join company co on co.id = uc.company_id
	       where r.id = _roleid AND
	             u.created_at between d_start and d_end AND
	             ifnull(x.ruc_tax,'') like CONCAT('%',_ruc,'%')
	       order by 2;
	   end;
	   else
	   begin
	   		select u.email ,u.name ,r.name  as role_desc,r.id as role_id,
	           u.id user_id, DATE_FORMAT(u.created_at , '%Y-%m-%d') as created_at,
	           CASE
	             when  r.id = 3 and exists(select 1 from credit_approved c where c.user_id = u.id) then 'Credit Approved'
	             when  r.id = 3 and exists(select 1 from credit_denied c where c.user_id = u.id) then 'Credit Denied'
	             when  r.id = 3 and  exists(select 1 from certificationauthorizations c where c.user_id = u.id) then 'Request received'
	             when  r.id = 3 and not exists(select 1 from certificationauthorizations c where c.user_id = u.id) then 'Request incomplete'
	             else 'He is not client.'
	           END credit_status,

	           CASE
	             when  r.id = 3 and exists(select 1 from businessinformations c where c.user_id = u.id and c.is_buyer=1) then 'Buyer'
	             when  r.id = 3 and exists(select 1 from businessinformations c where c.user_id = u.id and c.is_seller =1) then 'Seller'
	             when  r.id = 3 and exists(select 1 from businessinformations c where c.user_id = u.id and c.is_seller =1 and c.is_buyer=1) then 'Buyer/Seller'
	             else 'He is not client.'
	           END type_user,
	           ifnull(x.is_buyer,0) is_buyer,
	           ifnull(x.is_seller,0) is_seller,
	           ifnull(x.ruc_tax,'') ruc_tax,
	           ifnull(co.name,'Sin empresa') company_name,
	           ifnull(co.id,0) company_id

	       FROM model_has_roles mhr
	       INNER JOIN users u ON u.id = mhr.model_id
	       inner join roles r on r.id = mhr.role_id
	       left outer join usercompany uc on uc.user_id = u.id
	       left outer join company co on co.id = uc.company_id
	       left outer join businessinformations x on x.user_id = u.id
	       where r.id = _roleid AND
	             u.created_at between d_start and d_end and
	             ifnull(x.ruc_tax,'') like CONCAT('%',_ruc,'%') and
	             (CASE
		             when  r.id = 3 and exists(select 1 from credit_approved c where c.user_id = u.id) then 'Credit Approved'
		             when  r.id = 3 and exists(select 1 from credit_denied c where c.user_id = u.id) then 'Credit Denied'
		             when  r.id = 3 and  exists(select 1 from certificationauthorizations c where c.user_id = u.id) then 'Request received'
		             when  r.id = 3 and not exists(select 1 from certificationauthorizations c where c.user_id = u.id) then 'Request incomplete'
		             else 'He is not client.'
		          END)
		          = _estado
	       order by 2;
	   end;
	   end if;
     end;
     else
     begin
        select u.email ,u.name ,r.name  as role_desc,r.id as role_id,
         u.id user_id, DATE_FORMAT(u.created_at , '%Y-%m-%d') as created_at,
        CASE
             when  r.id = 3 and exists(select 1 from credit_approved c where c.user_id = u.id) then 'Credit Approved'
             when  r.id = 3 and exists(select 1 from credit_denied c where c.user_id = u.id) then 'Credit Denied'
             when  r.id = 3 and  exists(select 1 from certificationauthorizations c where c.user_id = u.id) then 'Request received'
             when  r.id = 3 and not exists(select 1 from certificationauthorizations c where c.user_id = u.id) then 'Request incomplete'
             else 'He is not client.'
           END credit_status,
         CASE
           when  r.id = 3 and exists(select 1 from businessinformations c where c.user_id = u.id and c.is_buyer=1) then 'Buyer'
           when  r.id = 3 and exists(select 1 from businessinformations c where c.user_id = u.id and c.is_seller =1) then 'Seller'
           when  r.id = 3 and exists(select 1 from businessinformations c where c.user_id = u.id and c.is_seller =1 and c.is_buyer=1) then 'Buyer/Seller'
           else 'He is not client.'
         END type_user,
         ifnull(x.is_buyer,0) is_buyer,
       ifnull(x.is_seller,0) is_seller,
       ifnull(x.ruc_tax,'') ruc_tax,
       ifnull(co.name,'Sin empresa') company_name,
       ifnull(co.id,0) company_id
       FROM model_has_roles mhr
       INNER JOIN users u ON u.id = mhr.model_id
       inner join roles r on r.id = mhr.role_id
       left outer join usercompany uc on uc.user_id = u.id
       left outer join company co on co.id = uc.company_id
       left outer join businessinformations x on x.user_id = u.id
       order by 2;
     end;
     end if;


END;
//
DELIMITER ;

/*
set @_rolid =1;
set @_name ="name 2 test ";
set @_email ="correo@a.com";
set @_clave ="2323asas";
SET @msg = '';
SET @error = '';
CALL Create_users_admin_super(@_rolid ,@_clave ,@_email,@_name ,@msg,@error);
SELECT @msg,@error;
 */

DROP PROCEDURE IF EXISTS Create_users_admin_super;
DELIMITER //
create  PROCEDURE Create_users_admin_super(
                                IN _rolid bigint,
                IN _clave varchar(255),
                IN _email varchar(255),
                                IN _name varchar(255),
                                IN _companyid bigint,
                                OUT _msg varchar(255),
                                OUT _error tinyint
                                )
sp:BEGIN
     Declare code varchar(5);
     Declare MSG text;
     declare b_usuario_id bigint;
     declare s_modelo varchar(200);



     DECLARE exit HANDLER FOR SQLEXCEPTION

     sp1:begin
       select 1 into _error;

       Get   diagnostics condition 1 code=RETURNED_SQLSTATE, MSG=MESSAGE_TEXT;
       select CONCAT('Create Users admin o super failed, error = ',code,', message = ',MSG) into _msg;
       select _error,_msg;
       LEAVE sp1;

       end;

      sp2:begin

        if exists(select 1 from users u  where u.email=_email) then
            select 1 into _error;
            select 'Error, ya existe registrado un user con ese email.' into _msg;
            select _error,_msg;
            LEAVE sp2;
        end if;

       if  _rolid = 3  then
            select 1 into _error;
            select 'Error, el rol cliente no aplica para el registro.' into _msg;
            select _error,_msg;
            LEAVE sp2;
       end if;
       if  _companyid = 0  or _companyid is NULL then
            select 1 into _error;
            select 'Error, el campo de la empresa es obligatorio.' into _msg;
            select _error,_msg;
            LEAVE sp2;
       end if;
       if not exists(select 1 from company r  where r.id = _companyid )  then
            select 1 into _error;
            select 'Error, no existe la empresa.' into _msg;
            select _error,_msg;
            LEAVE sp2;
        end if;
       if not exists(select 1 from roles r  where r.id = _rolid ) or _rolid is NULL  then
            select 1 into _error;
            select 'Error, no existe el rol.' into _msg;
            select _error,_msg;
            LEAVE sp2;
        end if;

       if ifnull(_email,'')= ''  then
            select 1 into _error;
            select 'Error, email es obligatorio.' into _msg;
            select _error,_msg;
            LEAVE sp2;
        end if;

        if ifnull(_name,'')= ''  then
            select 1 into _error;
            select 'Error, Name es obligatorio.' into _msg;
            select _error,_msg;
            LEAVE sp2;
        end if;


      insert into users(name,email,password,created_at,status) values(_name,_email,_clave,now(),1);
      select  LAST_INSERT_ID() into b_usuario_id;

      insert into usercompany(user_id,company_id,created_at) values(b_usuario_id, _companyid,now());

      select valorstring2 into s_modelo
            from catalogodet c2
            inner join catalogocab c1 on c1.id = c2.catalogocab_id
            where c1.tabla='ROL-USER-CLIENT' and
                  c2.valorstring='MODELO';
       insert into model_has_roles(role_id,model_type,model_id) values(_rolid,s_modelo,b_usuario_id);
       select 0 into  _error;


       select 'ok' into _msg;
       select _error,_msg;
    end;

END;
//
DELIMITER ;


/*
set @_rolid =1;
set @_userid =19;
set @_name ="name 3 test ";
set @_email ="mflores355@gmail.com";
set @_clave ="2323asas";
set @_active =0;
SET @msg = '';
SET @error = '';
CALL Update_users_admin_super(@_userid,@_rolid ,@_clave ,@_email,@_name ,@_active,@msg,@error);
SELECT @msg,@error;
 */

DROP PROCEDURE IF EXISTS Update_users_admin_super;
DELIMITER //
create  PROCEDURE Update_users_admin_super(
                                IN _userid bigint,
                IN _rolid bigint,
                IN _clave varchar(255),
                IN _email varchar(255),
                                IN _name varchar(255),
                                IN _active tinyint,
                                in _companyid bigint,
                                OUT _msg varchar(255),
                                OUT _error tinyint
                                )
sp:BEGIN
     Declare code varchar(5);
     Declare MSG text;



     DECLARE exit HANDLER FOR SQLEXCEPTION

     sp1:begin
       select 1 into _error;

       Get   diagnostics condition 1 code=RETURNED_SQLSTATE, MSG=MESSAGE_TEXT;
       select CONCAT('Update Users admin o super failed, error = ',code,', message = ',MSG) into _msg;
       select _error,_msg;
       LEAVE sp1;

       end;

      sp2:begin
        if _userid is null  then
            select 1 into _error;
            select 'Error, userid es obligatorio.' into _msg;
            select _error,_msg;
            LEAVE sp2;
        end if;

        if not exists(select 1 from users u where u.id=_userid) then
            select 1 into _error;
            select 'Error, no existe user con ese id.' into _msg;
            select _error,_msg;
            LEAVE sp2;
        end if;
        if  _companyid = 0  or _companyid is NULL then
            select 1 into _error;
            select 'Error, el campo de la empresa es obligatorio.' into _msg;
            select _error,_msg;
            LEAVE sp2;
       end if;
       if not exists(select 1 from company r  where r.id = _companyid )  then
            select 1 into _error;
            select 'Error, no existe la empresa.' into _msg;
            select _error,_msg;
            LEAVE sp2;
        end if;

       if  _rolid = 3  then
            select 1 into _error;
            select 'Error, el rol cliente no aplica para el registro.' into _msg;
            select _error,_msg;
            LEAVE sp2;
       end if;
       if not exists(select 1 from roles r  where r.id = _rolid ) or _rolid is NULL  then
            select 1 into _error;
            select 'Error, no existe el rol.' into _msg;
            select _error,_msg;
            LEAVE sp2;
        end if;

       if exists(select 1 from users u where u.email = _email and u.id <> _userid) or _rolid is NULL  then
            select 1 into _error;
            select 'Error, correo ya existe en otra cuenta de usuario.' into _msg;
            select _error,_msg;
            LEAVE sp2;
        end if;

       if ifnull(_email,'')= ''  then
            select 1 into _error;
            select 'Error, email es obligatorio.' into _msg;
            select _error,_msg;
            LEAVE sp2;
        end if;

        if ifnull(_name,'')= ''  then
            select 1 into _error;
            select 'Error, Name es obligatorio.' into _msg;
            select _error,_msg;
            LEAVE sp2;
        end if;

          update model_has_roles set role_id = _rolid where model_id = _userid;
          update users set email = _email, name= _name, updated_at = now(), status = _active where id = _userid;
          if not exists(select 1 from usercompany r  where r.user_id = _userid )  then
              insert into usercompany(user_id,company_id,updated_at) values(_userid, _companyid,now());
          ELSE
          	  update usercompany set company_id = _companyid, updated_at = now() where user_id = _userid;
          end if;

      select 0 into  _error;


       select 'ok' into _msg;
       select _error,_msg;
    end;

END;
//
DELIMITER ;


/*
 SET @userid = 3;
 call Get_info_credit (@userid);
 */

DROP PROCEDURE IF EXISTS Get_info_credit;
DELIMITER //
create  PROCEDURE Get_info_credit(IN _userid bigint)
BEGIN

     select m.id,
         m.company_name,
         DATE_FORMAT(m.date_company , '%Y-%m-%d %T.%f') as date_company,
         m.type_business,
         m.contact_name,
         m.zip,
         m.president_name,
         m.address,
         m.ruc_tax,
         m.website,
         m.secretary_name,
         m.dba,
           m.cell_phone,
           m.country_id,
           c.descripcion country,
           m.city_id,
           ci.descripcion city,
           m.state_id,
           s.descripcion state,
           m.phone,
           u.email,
           u.name,
           u.id user_id,
           case u.status when 1 then 'true' else 'false' end  status_user,
           case c2.active when 1 then 'true' else 'false' end status_client,
           DATE_FORMAT(m.created_at , '%Y-%m-%d %T.%f') as created_at,
         DATE_FORMAT(m.updated_at , '%Y-%m-%d %T.%f') as updated_at,
         case m.is_buyer when 1 then 'true' else 'false' end  is_buyer,
           case m.is_seller when 1 then 'true' else 'false' end is_seller,
           c2.id client_id,
           c2.name client_name

    from businessinformations m
    inner join users u on u.id  = m.user_id
    inner join clients c2 on c2.id  = m.client_id
    left outer join catalogodet c on c.id = m.country_id
    left outer join catalogodet s on s.id = m.state_id
    left outer join catalogodet ci on ci.id = m.city_id
    WHERE u.id = _userid;

   select m.id,m.name, m.idno,m.percentage,m.position,DATE_FORMAT(m.birthdate, '%Y-%m-%d') as birthdate,
         DATE_FORMAT(m.created_at , '%Y-%m-%d %T.%f') as created_at,
         DATE_FORMAT(m.updated_at , '%Y-%m-%d %T.%f') as updated_at,
         c2.id client_id,
           c2.name client_name

    from managements m
    inner join users u on u.id  = m.user_id
    inner join clients c2 on c2.id  = m.client_id
    WHERE u.id = _userid;




    select f.id,
          f.avg_montky_sales,
          f.ams_how_clients,
          case f.has_applicant when 0 then 'false' else 'checked' end has_applicant,
          case f.po_finance when 0 then 'false' else 'checked' end po_finance,
          case f.in_finance when 0 then 'false' else 'checked' end in_finance,
          case f.lawsuits_pending when 0 then 'false' else 'checked' end lawsuits_pending,
          case f.receivable_finance when 0 then 'false' else 'checked' end receivable_finance,
          case f.credit_insurance_policy when 0 then 'false' else 'checked' end credit_insurance_policy,
          case f.declared_bank_ruptcy when 0 then 'false' else 'checked' end declared_bank_ruptcy,
          f.estimated_montly_financing,
          f.emf_number_clients,
          f.rf_when_with_whom,
          f.cip_when_with_whom,

         DATE_FORMAT(f.created_at , '%Y-%m-%d %T.%f') as created_at,
         DATE_FORMAT(f.updated_at , '%Y-%m-%d %T.%f') as updated_at,
         c2.id client_id,
           c2.name client_name

    from financialrequests f
    inner join users u on u.id  = f.user_id
    inner join clients c2 on c2.id  = f.client_id
    WHERE u.id = _userid;




    select f.id,
          f.bank_name,
          f.account_same_swift,
          f.account_number,
          f.aba_routing,
          f.bank_adress,
          f.telephone,
          f.account_officer,
          f.adress,


         DATE_FORMAT(f.created_at , '%Y-%m-%d %T.%f') as created_at,
         DATE_FORMAT(f.updated_at , '%Y-%m-%d %T.%f') as updated_at,
         c2.id client_id,
           c2.name client_name

    from bankinformations f
    inner join users u on u.id  = f.user_id
    inner join clients c2 on c2.id  = f.client_id
    WHERE u.id = _userid;



    select f.id,
          case f.approved_agreed when 1 then ' checked' else ' ' end approved_agreed,
          f.name,
          f.title,

         DATE_FORMAT(f.created_at , '%Y-%m-%d %T.%f') as created_at,
         DATE_FORMAT(f.updated_at , '%Y-%m-%d %T.%f') as updated_at,
         c2.id client_id,
           c2.name client_name

    from certificationauthorizations f
    inner join users u on u.id  = f.user_id
    inner join clients c2 on c2.id  = f.client_id
    WHERE u.id = _userid;

    select
         CASE
           when  exists(select 1 from credit_approved c where c.user_id = _userid) then 'Credit Approved'
           when  exists(select 1 from credit_denied c where c.user_id = _userid) then 'Credit Denied'
           when  exists(select 1 from certificationauthorizations c where c.user_id = _userid) then 'Request received'
           else 'Request incomplete'

        END credit_status;

     select
      DATE_FORMAT(ca.created_at , '%Y-%m-%d %T.%f') as created_at,
      DATE_FORMAT(ca.updated_at , '%Y-%m-%d %T.%f') as updated_at,
      ca.credit_line ,
      ca.advance ,
      ca.maximum_amount ,
      ca.deadline ,
      ca.interest_rate ,
      ca.type_document ,
      ca.approved_by ,
      u.email email_approved,
      u.name name_approved
     from credit_approved ca
     inner join users u on u.id = ca.approved_by
     where ca.user_id = _userid;

    select
      DATE_FORMAT(ca.created_at , '%Y-%m-%d %T.%f') as created_at,
      DATE_FORMAT(ca.updated_at , '%Y-%m-%d %T.%f') as updated_at,
      ca.observation ,
      ca.denied_by ,
      u.email email_denied,
      u.name name_denied
     from credit_denied ca
     inner join users u on u.id = ca.denied_by
     where ca.user_id = _userid;


END;
//
DELIMITER ;

/*
 SET @userid = 3;
 call Get_info_notifications (@userid);
 */

DROP PROCEDURE IF EXISTS Get_info_notifications;
DELIMITER //
create  PROCEDURE Get_info_notifications(IN _userid bigint)
BEGIN
  select
  (
   select count(*)
   from notification_send ns
   where ns.send_by  = _userid
   ) as num_sent,
  (
   select count(*)
   from notification_send ns
   where ns.user_id = _userid
   ) as num_received;

 select
   m.id,
   DATE_FORMAT(m.created_at , '%Y-%m-%d %T.%f') as created_at,
   DATE_FORMAT(m.updated_at , '%Y-%m-%d %T.%f') as updated_at,
   m.description ,
   m.type_not ,
   m.user_id ,
   u.email ,
   u.name,
   m.send_by send_by_userid,
   u2.email send_by_email,
   u2.name send_by_name,
   m.is_read ,
   DATE_FORMAT(m.date_read , '%Y-%m-%d %T.%f') as date_read
 from notification_send m
 inner join users u on u.id = m.user_id
 inner join users u2 on u2.id = m.send_by
 where m.send_by = _userid;

select
   m.id,
   DATE_FORMAT(m.created_at , '%Y-%m-%d %T.%f') as created_at,
   DATE_FORMAT(m.updated_at , '%Y-%m-%d %T.%f') as updated_at,
   m.description ,
   m.type_not ,
   m.user_id ,
   u.email ,
   u.name,
   m.send_by send_by_userid,
   u2.email send_by_email,
   u2.name send_by_name,
   m.is_read ,
   DATE_FORMAT(m.date_read , '%Y-%m-%d %T.%f') as date_read
 from notification_send m
 inner join users u on u.id = m.user_id
 inner join users u2 on u2.id = m.send_by
 where m.user_id  = _userid;

END;
//
DELIMITER ;


/*
 SET @_notificacionid = 3;
 call Get_notification (@_notificacionid);
 */

DROP PROCEDURE IF EXISTS Get_notification;
DELIMITER //
create  PROCEDURE Get_notification(IN _notificacionid bigint)
BEGIN


 select
   m.id,
   DATE_FORMAT(m.created_at , '%Y-%m-%d %T.%f') as created_at,
   DATE_FORMAT(m.updated_at , '%Y-%m-%d %T.%f') as updated_at,
   m.description ,
   m.type_not ,
   m.user_id ,
   u.email ,
   u.name,
   m.send_by send_by_userid,
   u2.email send_by_email,
   u2.name send_by_name,
   m.is_read ,
   DATE_FORMAT(m.date_read , '%Y-%m-%d %T.%f') as date_read
 from notification_send m
 inner join users u on u.id = m.user_id
 inner join users u2 on u2.id = m.send_by
 where m.id = _notificacionid;

END;
//
DELIMITER ;


/*
 call Get_api_nsa ();
 */

DROP PROCEDURE IF EXISTS Get_api_nsa;
DELIMITER //
create  PROCEDURE Get_api_nsa()
BEGIN


 select
     c2.descripcion
 from catalogocab c
 inner join catalogodet c2 on c2.catalogocab_id = c.id
 where c.tabla ='URL-NSA' AND
       c2.valorstring = 'URL_NSA';

END;
//
DELIMITER ;


/*
set @_id =1;
SET @msg = '';
SET @error = '';
CALL Update_read_notification(@_id,@msg,@error);
SELECT @msg,@error;
 */

DROP PROCEDURE IF EXISTS Update_read_notification;
DELIMITER //
create  PROCEDURE Update_read_notification(
                                IN _id bigint,
                                OUT _msg varchar(255),
                                OUT _error tinyint
                                )
sp:BEGIN
     Declare code varchar(5);
     Declare MSG text;



     DECLARE exit HANDLER FOR SQLEXCEPTION

     sp1:begin
       select 1 into _error;

       Get   diagnostics condition 1 code=RETURNED_SQLSTATE, MSG=MESSAGE_TEXT;
       select CONCAT('Update read notification_send failed, error = ',code,', message = ',MSG) into _msg;
       select _error,_msg;
       LEAVE sp1;

       end;

      sp2:begin
	      if _id is null  then
	      		select 1 into _error;
		        select 'Error, notification id es obligatorio.' into _msg;
		        select _error,_msg;
		        LEAVE sp2;
	      end if;

	      if not exists(select 1 from notification_send u where u.id=_id) then
	      		select 1 into _error;
		        select 'Error, no existe notification_send con ese id.' into _msg;
		        select _error,_msg;
		        LEAVE sp2;
	      end if;

	      if exists(select 1 from notification_send u where u.id=_id and u.is_read=1) then
	      		select 1 into _error;
		        select 'Error, la notification_send esta leida.' into _msg;
		        select _error,_msg;
		        LEAVE sp2;
	      end if;


   	      update notification_send  set date_read=now(),is_read =1 where id = _id;

		  select 0 into  _error;
		   select 'ok' into _msg;
		   select _error,_msg;
		end;

END;
//
DELIMITER ;


/*
set @_id =1;
set @_credit_line = 2;
set @_advance=4;
set @_maximum_amount=5;
set @_deadline=3;
set @_interest_rate=7;
SET @msg = '';
SET @error = '';
CALL Update_approved_values(@_id,@_credit_line,@_advance,@_maximum_amount, @_deadline,@_interest_rate,@msg,@error);
SELECT @msg,@error;
 */

DROP PROCEDURE IF EXISTS Update_approved_values;
DELIMITER //
create  PROCEDURE Update_approved_values(
                                IN _id bigint,
                                IN _credit_line double,
                                IN _advance double,
                                IN _maximum_amount double,
                                IN _deadline int,
                                IN _interest_rate double,
                                OUT _msg varchar(255),
                                OUT _error tinyint
                                )
sp:BEGIN
     Declare code varchar(5);
     Declare MSG text;

     DECLARE exit HANDLER FOR SQLEXCEPTION

     sp1:begin
       select 1 into _error;

       Get   diagnostics condition 1 code=RETURNED_SQLSTATE, MSG=MESSAGE_TEXT;
       select CONCAT('Update approved_values failed, error = ',code,', message = ',MSG) into _msg;
       select _error,_msg;
       LEAVE sp1;

       end;

      sp2:begin
	      if _id is null  then
	      		select 1 into _error;
		        select 'Error, approved_values id es obligatorio.' into _msg;
		        select _error,_msg;
		        LEAVE sp2;
	      end if;

	      if not exists(select 1 from credit_approved u where u.id=_id) then
	      		select 1 into _error;
		        select 'Error, no existe credit_approved con ese id.' into _msg;
		        select _error,_msg;
		        LEAVE sp2;
	      end if;

	      update credit_approved
	         set
	           credit_line = _credit_line,
	           advance  = _advance,
	           maximum_amount  = _maximum_amount,
	           deadline = _deadline,
	           interest_rate  = _interest_rate,
	           updated_at = NOW()
	        where id = _id;

		  select 0 into  _error;
		   select 'ok' into _msg;
		   select _error,_msg;
		end;

END;
//
DELIMITER ;


/*
 call Get_request_credit_states ();
 */

DROP PROCEDURE IF EXISTS Get_request_credit_states;
DELIMITER //
create  PROCEDURE Get_request_credit_states()
BEGIN


 select 'All' as status
 union
 select 'Credit Approved' as status
 union
 select 'Credit Denied' as status
 union
 select 'Request received' as status
 union
 select 'Request incomplete' as status;
END;
//
DELIMITER ;



/*
 call Get_companies()
 *
 */
DROP PROCEDURE IF EXISTS Get_companies;
DELIMITER //
create  PROCEDURE Get_companies()
BEGIN
  select id,name, description, name,address,
     case active
        when '0' then ''
        else 'checked'
      end as active,
      DATE_FORMAT(c.created_at , '%Y-%m-%d %T') as created_at,
      DATE_FORMAT(c.updated_at , '%Y-%m-%d %T') as updated_at
    from company c;

END;
//
DELIMITER ;

/*
 call Get_company_item(1)
 *
 */
DROP PROCEDURE IF EXISTS Get_company_item;
DELIMITER //
create  PROCEDURE Get_company_item(IN item bigint)
BEGIN
   select id,name, description, name,address,
     case active
        when '0' then ''
        else 'checked'
      end as active,
      DATE_FORMAT(c.created_at , '%Y-%m-%d %T') as created_at,
      DATE_FORMAT(c.updated_at , '%Y-%m-%d %T') as updated_at
    from company c
    WHERE c.id = item;

END;
//
DELIMITER ;

/*
 SET @msg5 = '';
 SET @error5 = '';
 set @id5 = 0;
 CALL Insert_company('acf company 33','description acf_company','address 1 test',@msg5,@error5,@id5);
 select @msg5, @error5,@id5;
 */
DROP PROCEDURE IF EXISTS Insert_company;
DELIMITER //
create  PROCEDURE Insert_company(
                                IN _name varchar(255),
                                IN _description varchar(255),
                                IN _address varchar(255),
                                OUT _msg varchar(255),
                                OUT _error char(1),
                                OUT _id bigint
                                )
sp: BEGIN
     Declare code varchar(10);
     Declare MSG text;
     declare existe int;
     DECLARE exit HANDLER FOR SQLEXCEPTION
     begin
       select '1' into _error;
       select 0 into _id;

       Get diagnostics condition 1 code=MYSQL_ERRNO, MSG=MESSAGE_TEXT;
       select CONCAT('Inserts failed Company, error = ',code,', message = ',MSG) into _msg;
       select _error,_msg,_id;

       end;

     select 0 into existe;
     select 0 into _id;

     select count(*) into existe
         from company where  trim(upper(name)) collate utf8mb4_unicode_ci = trim(_name);


       if existe > 0 THEN
            select '1' into _error;
            select '' into _msg;
            select description into _msg
              from messages ges
              where ges.key_control='company_exist';
            if (_msg='') then
              select 'Company name already exists.' into _msg;
            end if;
            select _error, _msg,_id;
            leave sp;
       end if;



    insert into company(name,description,address,created_at,active) values(_name,_description,_address,now(),1);
    select  LAST_INSERT_ID() into _id;

    select '0' into  _error;

    select 'ok' into _msg;
    select _error,_msg, _id;




END;
//
DELIMITER ;

/*
 set @_msg5 = ' ';
 set @_error5 = '';
 call Update_company(2,'company MIguel Flores','test cambio','address cambio','1',@_msg5,@_error5);
 select @_msg5,@_error5;
 */
DROP PROCEDURE IF EXISTS Update_company;
DELIMITER //
create  PROCEDURE Update_company(
                IN _id bigint,
                IN _name varchar(255),
                IN _description varchar(255),
                IN _address varchar(255),
                IN _active tinyint(1),
                OUT _msg varchar(255),
                OUT _error char(1)
                )
sp: BEGIN
     Declare code varchar(5);
     Declare MSG text;
     declare existe int;
     DECLARE exit HANDLER FOR SQLEXCEPTION
     begin
       select '1' into _error;

       Get   diagnostics condition 1 code=RETURNED_SQLSTATE, MSG=MESSAGE_TEXT;
       select CONCAT('Update failed Company, error = ',code,', message = ',MSG) into _msg;
       select _error,_msg;

       end;


     select count(*) into existe
         from company
       where  upper(name) collate utf8mb4_unicode_ci = _name AND
              id <> _id;


       if existe > 0 THEN
            select '1' into _error;
            select '' into _msg;
            select description into _msg
              from messages ges
              where ges.key_control='company_exist';
            if (_msg='') then
              select 'Company name already exists.' into _msg;
            end if;
            select _error, _msg;
            leave sp;
       end if;



      update company
         set description = _description,
             name = _name,
             address = _address,
             updated_at = now(),
             active  = _active

         where id = _id;

    select '0','ok' into  _error,_msg;
   select _error,_msg;


END;
//
DELIMITER ;


/*
 call Get_document_financing ('All','','','',0);
 */

DROP PROCEDURE IF EXISTS Get_document_financing;
DELIMITER //
create  PROCEDURE Get_document_financing(
                              IN _estado varchar(255),
                              IN _fecha_inicio varchar(255),
                              IN _fecha_fin varchar(255),
                              IN _ruc varchar(255),
                              IN _userid bigint
                              )


BEGIN
  declare d_start timestamp;
    declare d_end timestamp;
    declare b_user_inicio bigint;
    declare b_user_fin bigint;
  
   SET b_user_inicio = 0;
   SET b_user_fin = 0;
   if(ifnull(_userid,0) =0) THEN
   BEGIN
       SELECT min(u.id) ,max(u.id) INTO b_user_inicio, b_user_fin
       FROM users u;
   END;
   ELSE
   BEGIN
      SET b_user_inicio =_userid;
      SET b_user_fin = _userid;
   END;
   END IF;
   if(ifnull(_fecha_inicio,'') ='') then
   begin
       select STR_TO_DATE('2000-01-01 00:00:00', '%Y-%m-%d %H:%i:%s') into d_start;
   end;
   else
   begin
     select concat(_fecha_inicio,' 00:00:00') into _fecha_inicio;
     select STR_TO_DATE(_fecha_inicio, '%Y-%m-%d %H:%i:%s') into d_start;
   end;
   end if;

   if(ifnull(_fecha_fin,'') ='' ) then
   begin
       select DATE_ADD(now(), INTERVAL 10 DAY) into d_end;
   end;
   else
   begin
     select concat(_fecha_fin,' 23:59:59') into _fecha_fin;
     select STR_TO_DATE(_fecha_fin, '%Y-%m-%d %H:%i:%s') into d_end;
   end;
  end if;
 
  


  if(_estado in('All','')) then
   begin
     
     select
         df.id,
         ifnull(df.type_doc,'') type_doc,
         DATE_FORMAT(df.created_at , '%Y-%m-%d %T') as created_at,
         DATE_FORMAT(df.updated_at , '%Y-%m-%d %T') as updated_at,
         DATE_FORMAT(df.creation_date , '%Y-%m-%d') as creation_date,
         DATE_FORMAT(df.due_date , '%Y-%m-%d') as due_date,
         df.amount,
         IFNULL(df.aditional,'') aditional,
         df.user_id ,
         u.email ,
         u.name user_name,
         df.status,
         df.url_doc,
         x.ruc_tax
         
     from document_financing df
     inner join users u on u.id  = df.user_id
     inner join businessinformations x on x.user_id = u.id
     where df.created_at between d_start and d_end AND
         x.ruc_tax like  CONCAT('%',_ruc,'%') AND
         u.id BETWEEN b_user_inicio AND b_user_fin ;
      
   end;
  else
   begin
     select
         df.id,
         ifnull(df.type_doc,'') type_doc,
         DATE_FORMAT(df.created_at , '%Y-%m-%d %T') as created_at,
         DATE_FORMAT(df.updated_at , '%Y-%m-%d %T') as updated_at,
         DATE_FORMAT(df.creation_date , '%Y-%m-%d') as creation_date,
         DATE_FORMAT(df.due_date , '%Y-%m-%d') as due_date,
         df.amount,
         IFNULL(df.aditional,'') aditional,
         df.user_id ,
         u.email ,
         u.name user_name,
         df.status,
         df.url_doc,
         x.ruc_tax
     from document_financing df
     inner join users u on u.id  = df.user_id
     inner join businessinformations x on x.user_id = u.id
     where df.created_at between d_start and d_end AND
           u.id BETWEEN b_user_inicio AND b_user_fin and
         x.ruc_tax like CONCAT('%',_ruc,'%') and
        df.status = _estado;
   end;
   end if;


end;
//
DELIMITER ;

/*
 call Get_document_financing_states()
 */

DROP PROCEDURE IF EXISTS Get_document_financing_states;
DELIMITER //
create  PROCEDURE Get_document_financing_states()
BEGIN


 select 'All' as status
 union
 select 'In Review' as status
 union
 select 'Denied' as status
 union
 select 'Approved' as status ;
END;
//
DELIMITER ;
