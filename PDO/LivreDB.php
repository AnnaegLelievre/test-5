<?php
require_once "Constantes.php";
require_once "metier/Livre.php";
require_once "MediathequeDB.php";

class LivreDB extends MediathequeDB
{
	private $db; // Instance de PDO
	public $lastId;
	//TODO implementer les fonctions
	public function __construct($db)
	{
		$this->db = $db;
	}
	/**
	 * 
	 * fonction d'Insertion de l'objet Livre en base de donnee
	 * @param Livre $l
	 */
	public function ajout(Livre $l)
	{
		$q = $this->db->prepare('INSERT INTO livre(titre,edition,information,auteur) values(:titre,:edition,:information,:auteur)');

		$q->bindValue(':titre', $l->getTitre());
		$q->bindValue(':edition', $l->getEdition());
		$q->bindValue(':information', $l->getInformation());
		$q->bindValue(':auteur', $l->getAuteur());

		$q->execute();
		$this->last_id = $this->db->lastInsertId();
		$q->closeCursor();
		$q = NULL;
	}
	/**
	 * 
	 * fonction d'update de l'objet Livre en base de donnee
	 * @param Livre $l
	 */
	public function update(Livre $l)
	{
		try {
			$q = $this->db->prepare('UPDATE livre set titre,edition,information,auteur) value(:titre,:edition,information,auteur)');
			$q->bindValue(':titre', $l->getTitre());
			$q->bindValue(':edition', $l->getEdition());
			$q->bindValue('information', $l->getInformation());
			$q->bindValue('auteur', $l->getAuteur());
			$q->execute();
			$q->colseCursor();
			$q = NULL;
		} catch (Exception $e) {
			throw new Exception(Constantes::EXCEPTION_DB_PERS_UP);
		}
	}
	/**
	 * 
	 * fonction de Suppression de l'objet Livre
	 * @param Livre $l
	 */
	public function suppression(Livre $l)
	{
		$q = $this->db->prepare('DELETE from livre where id=:ident');
		$q->bindValue(':ident', $l->getId());
		$res = $q->execute();

		$q->closeCursor();
		$q = NULL;
		return $res;
	}
	/**
	 * 
	 * Fonction qui retourne toutes les livres
	 * @throws Exception
	 */
	public function selectAll()
	{
		$query = 'SELECT  id,titre,edition,information,auteur FROM livre';
		$q = $this->db->prepare($query);
		$q->execute();

		$arrAll = $q->fetchAll(PDO::FETCH_ASSOC);

		//si pas de livre, on leve une exception
		if (empty($arrAll)) {
			throw new Exception(Constantes::EXCEPTION_DB_LIVRE);
		}

		$result = $arrAll;
		//Clore la requ�te pr�par�e
		$q->closeCursor();
		$q = NULL;
		//retour du resultat
		return $result;
	}

	/**
	 * 
	 * Fonction qui retourne le livre en fonction de son id
	 * @throws Exception
	 * @param $id
	 */
	public function selectLivre($id)
	{
		try {
			$query = 'SELECT id,titre,edition,information,auteur FROM livre  WHERE id= :id ';
			$q = $this->db->prepare($query);


			$q->bindValue(':id', $id);

			$q->execute();

			$arrAll = $q->fetch(PDO::FETCH_ASSOC);
		} catch (Exception $e) {
			//si pas de livre , on leve une exception
			throw new Exception(Constantes::EXCEPTION_DB_LIV_SELECT . $e);
		} finally {
			$result = $arrAll;

			$q->closeCursor();
			$q = NULL;
			//conversion du resultat de la requete en objet livre
			$res = $this->convertPdoLiv($result);
			//retour du resultat
			return $res;
		}
	}
	/**
	 * 
	 * Fonction qui convertie un PDO Livre en objet Livre
	 * @param $pdoLivr
	 * @throws Exception
	 */
	public function convertPdoLiv($pdoLivr)
	{
		if (empty($pdoLivr)) {
			throw new Exception(Constantes::EXCEPTION_DB_CONVERT_LIVR);
		}
		try {
			//conversion du pdo en objet
			$obj = (object)$pdoLivr;
			$id = (int)$obj->id;
			$titre = $obj->titre;
			$edition =  $obj->edition;
			$information = $obj->information;
			$auteur = $obj->auteur;
			//conversion de l'objet en objet adresse
			$liv = new Livre($id, $titre, $edition, $information, $auteur);

			return $liv;
		} catch (Exception $e) {
			throw new Exception(Constantes::EXCEPTION_DB_CONVERT_LIVR . $e);
		}
	}
}
