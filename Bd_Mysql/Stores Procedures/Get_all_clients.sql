
DROP PROCEDURE IF EXISTS get_clients_all;
create  PROCEDURE get_clients_all()
BEGIN
	select name, token, email, active from clients;

END 