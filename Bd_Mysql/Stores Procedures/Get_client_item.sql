/*
 call Get_client_item(1)
 * 
 */
DROP PROCEDURE IF EXISTS Get_client_item;
DELIMITER //
create  PROCEDURE Get_client_item(IN item bigint)
BEGIN
	select id,name, token, email, active 
    from clients c
    WHERE c.id = item;

END;
//
DELIMITER ;