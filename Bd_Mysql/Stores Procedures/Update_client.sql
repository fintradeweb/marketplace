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
	   
     
      update clients 
         set email= _email,
             name = _name,
             updated_at = now(),
             token = token2
         where id = _id;
	 
	  select '0','ok' into  _error,_msg;
	 select _error,_msg;
	
	  
END;
//
DELIMITER ;