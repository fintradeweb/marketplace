
DROP PROCEDURE IF EXISTS get_clients_all;
DELIMITER //
create  PROCEDURE get_clients_all()
BEGIN
	select * from clients;

END 
//
DELIMITER