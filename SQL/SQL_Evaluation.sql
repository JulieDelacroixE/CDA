/* EXERCICE 1 */ 

USE northwind;

/* 1 -Liste des contacts français: */

SELECT CompanyName AS 'Société', ContactName AS 'Contact' , ContactTitle AS 'Fonction', phone AS 'Téléphone'
FROM customers
WHERE country = 'France';

/* 2 -Produits vendus par le fournisseur «Exotic Liquids» */

SELECT ProductName AS 'Produit', unitprice AS 'Prix'
FROM products
JOIN suppliers
ON products.supplierID = suppliers.SupplierID
WHERE companyName = 'Exotic Liquids';

/* 3 -Nombre de produits vendus par les fournisseurs Français dans l’ordre décroissant */

SELECT CompanyName AS 'Société' , COUNT(*) AS 'Nbre Produits' FROM products
JOIN suppliers 
ON products.supplierID = suppliers.supplierID
WHERE country = 'France'
GROUP BY CompanyName
ORDER BY COUNT(*) DESC;

/* 4 -Liste des clients Français ayant plus de 10 commandes */

SELECT CompanyName AS 'Client', COUNT(*) AS 'nbre commandes' FROM Orders
JOIN customers
ON orders.customerID = customers.CustomerID
WHERE country = 'France' 
GROUP BY companyname HAVING COUNT(*) > 10;

/* 5 -Liste des clients ayant un chiffre d’affaires > 30.000 */

SELECT CompanyName AS 'Client', SUM(`order details`.unitprice*`order details`.quantity) AS 'CA', country AS 'Pays'
FROM customers
JOIN orders
ON orders.CustomerID = customers.customerID
JOIN `order details`
ON orders.orderID = `order details`.OrderID
GROUP BY companyname, country
HAVING SUM(`order details`.unitprice*`order details`.quantity) > 30000
ORDER BY SUM(`order details`.unitprice*`order details`.quantity) DESC;

/* 6 –Liste des pays dont les clients ont passé commande de produits fournis par «Exotic Liquids» */

SELECT distinct country AS 'Pays' FROM customers
JOIN orders
ON customers.customerID = orders.CustomerID
JOIN `order details`
ON orders.OrderID = `order details`.OrderID
WHERE orders.OrderID IN (SELECT `order details`.orderID FROM `order details`
JOIN products
ON `order details`.productID = products.productID
JOIN suppliers
ON products.supplierID = suppliers.SupplierID
WHERE suppliers.CompanyName = 'Exotic liquids');

/* 7 –Montant des ventes de 1997 */

SELECT SUM(unitprice*quantity) AS 'Montant ventes 97' FROM `order details`
JOIN orders
ON orders.orderID = `order details`.orderID
WHERE OrderDate LIKE '1997-%';

/* 8 –Montant des ventes de 1997 mois par mois */

SELECT MONTH(Orderdate) AS 'Mois 97', SUM(unitprice*quantity) AS 'montant ventes' FROM `order details`
JOIN orders
ON orders.orderID = `order details`.orderID
WHERE Orderdate LIKE '1997%'
GROUP BY MONTH(Orderdate);

/* 9 –Depuis quelle date le client «Du monde entier» n’a plus commandé */

SELECT MAX(Orderdate) AS 'Date de dernière commande' FROM orders
JOIN customers
ON orders.CustomerID = customers.customerID
WHERE customers.companyname = 'Du monde entier';

/* 10 –Quel est le délai moyen de livraison en jours */

SELECT round(avg(DATEDIFF(shippeddate, orderdate))) AS 'délai moyen de livraison en jours' FROM orders;





/* EXERCICE 2 */

DELIMITER |
CREATE PROCEDURE Der_Commande(In company VARCHAR(50))
BEGIN 
SELECT MAX(Orderdate) AS 'Date de dernière commande' FROM orders
JOIN customers
ON orders.CustomerID = customers.customerID
WHERE customers.companyname = company;
END |
DELIMITER ;


DELIMITER |
CREATE PROCEDURE Delai_liv_moyen()
BEGIN 
SELECT round(avg(DATEDIFF(shippeddate, orderdate))) AS 'délai moyen de livraison en jours' FROM orders;
END |
DELIMITER ;

/* Par fournisseur */ 

DELIMITER |
CREATE PROCEDURE Delai_liv_moyen( In fournisseur VARCHAR(50))
BEGIN 
SELECT round(avg(DATEDIFF(shippeddate, orderdate))) AS 'délai moyen de livraison en jours' FROM orders
JOIN `order details` ON orders.orderID = `order details`.orderID 
JOIN products ON `order details`.productID = products.productID
JOIN suppliers ON products.supplierID = suppliers.supplierID 
WHERE suppliers.companyname = fournisseur;
END |
DELIMITER ;




/* EXERCICE 3 

On créer une procédure qui compare les pays par produit en utilisant un curseur pour gérer plusieurs produit/fournisseurs, si un des pays est différents du pays du client, on passe un booléen à false.

Dans un trigger, on appelle la procédure, on récupère la valeur sortante (le booléen), si elle est sur false, message d'erreur, si elle est sur true, l'update/insertion se fait.

Pour l'erreur, un table erreur a été créé afin d'y mettre les messages personnalisés (qu'on met en UNIQUE), lorsqu'on veut déclencher l'erreur, on insert un message déjà existant dans la table erreur */




/* Procédure */

DELIMITER | 

/* On passe en paramètre l'id de la commande concernée, le pays du client, et en paramètre sortant, un booleen */
CREATE PROCEDURE Verif_Pays(In commande INT, IN pays VARCHAR(15), OUT same_pays TINYINT)
BEGIN 
/* Déclaration des variables*/ 
DECLARE pays_client VARCHAR(15);
DECLARE pays_fournis VARCHAR(15);
DECLARE same_country TINYINT DEFAULT 1;
DECLARE fin TINYINT DEFAULT 0;

--Création du curseur
DECLARE Curs_pays
CURSOR FOR
   SELECT country FROM suppliers
   JOIN products ON products.supplierID = suppliers.supplierID 
    JOIN `order details` ON products.productID = `order details`.productID 
    JOIN orders ON `order details`.orderID = orders.orderID
    WHERE orders.orderID = commande
    ORDER BY `order details`.productID;
-- quand plus de ligne : fin = 1
DECLARE CONTINUE HANDLER FOR NOT FOUND SET fin = 1;
--attribution valeur du paramètre pour pays client
SET pays_client = pays;
-- Ouverture du curseur
    OPEN Curs_pays;
    FETCH NEXT FROM Curs_pays INTO pays_fournis;
    IF pays_fournis != pays_client 
    THEN 
    SET same_country = 0;
    END IF;

    -- boucle pour vérifier les lignes une par une
WHILE fin=0 AND pays_fournis = pays_client DO
   FETCH NEXT FROM Curs_pays INTO pays_fournis;
   IF pays_fournis != pays_client 
    THEN 
    SET same_country = 0;
    END IF;
END WHILE;

-- Si un des pays est différent, la valeur de same_country sera passée à 1
CLOSE Curs_pays; --Fermeture du curseur
    SET same_pays = same_country; -- On donne la valeur finale du booleen à notre paramètre sortant

END |
DELIMITER ;

/* Création du trigger pour l'insertion */
DELIMITER |
CREATE TRIGGER after_insert_orders AFTER INSERT
ON orders
FOR EACH ROW
BEGIN 
SET @same_country =1;
-- On appelle la procédure, on passe en paramètre l'id de commande, et le nouveau pays client, on enregistre le paramètre sortant dans une variable utilisateur
CALL Verif_Pays(new.orderID, new.ShipCountry, @same_country);
-- si sa valeur est false
IF @same_country = 0
THEN
-- on déclenche une erreur, ce qui annule l'insertion
INSERT INTO error (error_text) VALUES ('Commande impossible, pays differents');
END IF;
END |

DELIMITER ;

/*Création du trigger pour l'update */

DELIMITER |
CREATE TRIGGER after_update_orders AFTER UPDATE 
ON orders
FOR EACH ROW
BEGIN 
SET @same_country =1;
-- On appelle la procédure, on passe en paramètre l'id de commande, et le nouveau pays client, on enregistre le paramètre sortant dans une variable utilisateur
CALL Verif_Pays(new.orderID, new.ShipCountry, @same_country);
-- si sa valeur est false
IF @same_country = 0
THEN
-- on déclenche une erreur, ce qui annule l'update
INSERT INTO error (error_text) VALUES ('Commande impossible, pays differents');
END IF;
END |

DELIMITER ;