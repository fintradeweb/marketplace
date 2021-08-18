
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
 
 call Insert_client('MIguel Flores','mFj1.desarrollo@gmail.com',@_msg5,@_error5)
 
 select @_msg5,@_error5
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
	   
     
      update clients 
         set email= _email,
             name = _name,
             updated_at = now(),
             active  = _active,
             token = token2
         where id = _id;
	 
	  select '0','ok' into  _error,_msg;
	 select _error,_msg;
	
	  
END;
//
DELIMITER ;

DROP PROCEDURE IF EXISTS Get_client_token;
DELIMITER //
create  PROCEDURE Get_client_token(IN s_token varchar(200))
BEGIN
	if 
	  exists(
			select 1
		    from clients c
		    WHERE c.token = s_token
		   )
    then
    	select 0 as error,'' as msg ;
    else
    	select 1 error,'Error, Token de cliente no estï¿½ asignado.' as msg;
    end if;
		   

END;
//
DELIMITER ;


DROP PROCEDURE IF EXISTS Get_existe_user;
DELIMITER //
create  PROCEDURE Get_existe_user(IN s_mail varchar(200))
BEGIN
	if 
	  exists(
			select 1
		    from users c
		    WHERE c.email = s_mail
		   )
    then
    	select 1 as existe, 0 as bussinesinformation;
    else
    	select 0 as existe, 0 as bussinesinformation;
    end if;
		   

END;
//
DELIMITER ;

/*

SET @name = 'a';
SET @email = 'a4578@aaa.com';
SET @clave = '$2y$10$YSjPChBAf6yLym4aKhveQeYTxsbCuPuNS9nHu5aGYKcsSrkDHM3sy';
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
SET @token = 'CORREO3@GMAIL.COM054751f6d5f4cfa6213bCORREO3@GMAIL.COM';
SET @msg = '';
SET @error = '';
SET @id = 0;
CALL Insert_businessinformation(@name,@email,@clave,@taxid,@datecompany,@contactname,@zipcode,@typebusiness,@phone,@president,@country,@state,@city,@address,@website,@secretary,@dba,@cellphone,@token,@msg,@error,@id);
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
	   declare b_city_id bigint;
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
	      if STR_TO_DATE(_datecompany, '%Y-%m-%d') is  NULL then
	      		select 1 into _error;
		        select 'Error, el formato de la fecha no es válido. El formato es yyyy-MM-dd Ejm: 2021-08-21.' into _msg;
		        select _error,_msg,_id;
		        LEAVE sp2;
	      end if;
	     
	      select STR_TO_DATE(_datecompany,'%Y-%m-%d') into d_datecompany;
	       
	      
		   
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
		     select id into b_usuario_id from users u2 where u2.email = _email;
	         update users  set updated_at =now(),password =_clave, name = _name where id = b_usuario_id;
	       else
	          insert into users(name,email,password,created_at,status) values(_name,_email,_clave,now(),1);
		      select  LAST_INSERT_ID() into b_usuario_id;
		   end if; 
		  
		  if b_usuario_id = 0 then
		  		select 1 into _error;
		        select 'Error, Código de Usuario no existe.' into _msg;
		        select _error,_msg,_id;   
		        LEAVE sp2;
		  end if;
		 
		  select c.id into b_client_id from clients c where c.token = _token;
		   
		  
		   if exists(select 1 from businessinformations b 
		             WHERE b.user_id = b_usuario_id AND
		                   b.client_id = b_client_id) then
		      	select 1 into _error;
		        select 'Error, ya tenemos registrado con esta cuenta en la Sección Business Information.' into _msg;
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
		                 city_id)
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
		               b_city_id
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
SET @error = '';
CALL Update_businessinformation(@id,@name,@email,@taxid,@datecompany,@contactname,@zipcode,@typebusiness,@phone,@president,@country,@state,@city,@address,@website,@secretary,@dba,@cellphone,@msg,@error);
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
	   DECLARE exit HANDLER FOR SQLEXCEPTION 
	   
	   sp1:begin
		   select 1 into _error;
		   
		   Get   diagnostics condition 1 code=RETURNED_SQLSTATE, MSG=MESSAGE_TEXT; 
		   select CONCAT('Updates failed Business Information, error = ',code,', message = ',MSG) into _msg;
		   select _error,_msg;
		   LEAVE sp1;
   		  
       end;
      
      sp2:begin 
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
		 select trim(upper(_email)) into _email;
		  select c.user_id into b_usuario_id from  businessinformations c where c.id = _id_bi;
		  if b_usuario_id = 0 then
		  		select 1 into _error;
		        select 'Error, Código de Usuario no existe.' into _msg;
		        select _error,_msg;   
		        LEAVE sp2;
		  else
			   update users set updated_at =now(),email = _email, name = _name where id = b_usuario_id;
		  end if;
	      if STR_TO_DATE(_datecompany, '%Y-%m-%d') is  NULL then
	      		select 1 into _error;
		        select 'Error, el formato de la fecha no es válido. El formato es yyyy-MM-dd Ejm: 2021-08-21.' into _msg;
		        select _error,_msg;
		        LEAVE sp2;
	      end if;
	     
	      select STR_TO_DATE(_datecompany,'%Y-%m-%d') into d_datecompany;
	       
	      
		   
		  
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
		                 city_id = b_city_id
		  where id = _id_bi;
		   
		  
		       
		  
		   select 0 into  _error;
		   
		
		   select 'ok' into _msg;
		   select _error,_msg;
		end;
	    
	
 	

END;
//
DELIMITER ;

/*
 set @item = 1;
 call Get_managments(@item);
 */
 
DROP PROCEDURE IF EXISTS Get_managments;
DELIMITER //
create  PROCEDURE Get_managments(IN item bigint)
BEGIN
	select m.id,m.name, m.idno,m.percentage,m.position,DATE_FORMAT(m.birthdate, '%Y-%m-%d') as birthdate,
	       DATE_FORMAT(m.created_at , '%Y-%m-%d %T.%f') as created_at,
	       DATE_FORMAT(m.updated_at , '%Y-%m-%d %T.%f') as updated_at
	
    from managements m 
    WHERE m.id = item;

END;
//
DELIMITER ;


/*

SET @name = 'a';
SET @email = 'a4578@aaa.com';
SET @idno = '1234';
SET @position = 'escala 1234';
SET @birthday = '1982-06-28';
SET @percentage = '45';
SET @token = 'CORREO3@GMAIL.COM054751f6d5f4cfa6213bCORREO3@GMAIL.COM';
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
		        select 'Error, el formato de la fecha no es válido. El formato es yyyy-MM-dd Ejm: 2021-08-21.' into _msg;
		        select _error,_msg,_id;
		        LEAVE sp2;
	      end if;
	     
	      select STR_TO_DATE(_birthday,'%Y-%m-%d') into d_datecompany;
	       
	      
		   
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
		        select 'Error, el formato de la fecha no es válido. El formato es yyyy-MM-dd Ejm: 2021-08-21.' into _msg;
		        select _error,_msg;
		        LEAVE sp2;
	      end if;
	     
	      select STR_TO_DATE(_birthday,'%Y-%m-%d') into d_datecompany;
	       
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

SET @email = 'a4578@aaa.com';
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
SET @token = 'CORREO3@GMAIL.COM054751f6d5f4cfa6213bCORREO3@GMAIL.COM';
SET @msg = '';
SET @error = '';
SET @id = 0;
CALL Insert_financial(@avg_montky_sales,@ams_how_clients,@has_applicant,@po_finance,@in_finance,
       @lawsuits_pending,@receivable_finance,@credit_insurance_policy, @declared_bank_ruptcy,@estimated_montly_financing, 
       @emf_number_clients, @rf_when_with_whom, @cip_when_with_whom,  @email,@token,@msg,@error,@id);
SELECT @msg,@error,@id;
  
 */

DROP PROCEDURE IF EXISTS Insert_financial;
DELIMITER //
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
		   select CONCAT('Inserts failed Managment, error = ',code,', message = ',MSG) into _msg;
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
