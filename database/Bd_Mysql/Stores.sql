
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
update clients set active='1' where id=1;
select * from clients
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
 * 
 call sp_pruebas_conexion()
 
 set profiling=1;
EXPLAIN ANALYZE call sp_pruebas_conexion();

explain  select * from login_log where id_login=203;
explain  select * from login_log where id_usuario=203;
show profiles;
 */

DROP PROCEDURE IF EXISTS sp_pruebas_conexion;
DELIMITER //
create  PROCEDURE sp_pruebas_conexion()
BEGIN
	declare i1 integer;
    set i1 = 0;
   
   
    
    
    select count(*) into i1  from dpcabtra;
    select count(*) into i1  from dpmovimi LIMIT 10000;
    select count(*) into i1  from potencial_client_history;
   select count(*) into i1  from usuarios;
   
    select count(*) into i1  from dpcabtra;
    select count(*) into i1  from dpmovimi LIMIT 10000;
    select count(*) into i1  from potencial_client_history;
   select count(*) into i1  from usuarios;
   
    select count(*) into i1  from dpcabtra;
    select count(*) into i1  from dpmovimi LIMIT 10000;
    select count(*) into i1  from potencial_client_history;
   select count(*) into i1  from usuarios;
   
    select count(*) into i1  from dpcabtra;
    select count(*) into i1  from dpmovimi LIMIT 10000;
    select count(*) into i1  from potencial_client_history;
   select count(*) into i1  from usuarios;
   
    select count(*) into i1  from dpcabtra;
    select count(*) into i1  from dpmovimi LIMIT 10000;
    select count(*) into i1  from potencial_client_history;
   select count(*) into i1  from usuarios;
   
    select count(*) into i1  from dpcabtra;
    select count(*) into i1  from dpmovimi LIMIT 10000;
    select count(*) into i1  from potencial_client_history;
   select count(*) into i1  from usuarios;
   
    select count(*) into i1  from dpcabtra;
    select count(*) into i1  from dpmovimi LIMIT 10000;
    select count(*) into i1  from potencial_client_history;
   select count(*) into i1  from usuarios;
   
    select count(*) into i1  from dpcabtra;
    select count(*) into i1  from dpmovimi LIMIT 10000;
    select count(*) into i1  from potencial_client_history;
   select count(*) into i1  from usuarios;
   
    select count(*) into i1  from dpcabtra;
    select count(*) into i1  from dpmovimi LIMIT 10000;
    select count(*) into i1  from potencial_client_history;
   select count(*) into i1  from usuarios;
   
    select count(*) into i1  from dpcabtra;
    select count(*) into i1  from dpmovimi LIMIT 10000;
    select count(*) into i1  from potencial_client_history;
   select count(*) into i1  from usuarios;
   
    select * from login_log;

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
	   Declare code varchar(5);
	   Declare MSG text; 
	   declare existe int;
	   declare email2 varchar(255);
	   declare size_token int;
	   DECLARE exit HANDLER FOR SQLEXCEPTION 
	   begin
		   select '1' into _error;
		   
		   Get STACKED  diagnostics condition 1 code=RETURNED_SQLSTATE, MSG=MESSAGE_TEXT; 
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
		   
		   Get STACKED  diagnostics condition 1 code=RETURNED_SQLSTATE, MSG=MESSAGE_TEXT; 
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




