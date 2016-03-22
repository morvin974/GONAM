<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Comment_model extends Model {

    public function ADejaPublierPourUnArticle($idArticle){
        $pdo =& $this->pdodb->loadPDO();
        $selectPreparee = $pdo->prepare('SELECT * FROM comment where id_user=? and id_article=?');
        $selectPreparee->execute(array($this->auth->getCurrentId(), $idArticle));
		
        if($selectPreparee->rowCount()>=1){
            return  true;
        }
        else {
            return false;
        }
    }

    public function ajouterComment($idArticle, $description, $mark){
        $pdo =& $this->pdodb->loadPDO();
        $req = $pdo->prepare('INSERT INTO notice (notice_description, notice_mark, notice_date) values (?,?, now()) ');
        $req->execute(array($description, $mark));

        $idNotice = $pdo->lastInsertId();
		
        $req2 = $pdo->prepare('INSERT INTO comment (id_notice, id_user, id_article) values (?,?,?) ');
        $req2->execute(array($idNotice, $this->auth->getCurrentId(), $idArticle));

    }

    public function getCommentArticle($idArticle){
        $pdo =& $this->pdodb->loadPDO();
        $req = $pdo->prepare('SELECT * from comment INNER JOIN notice ON comment.id_notice=notice.id_notice 
													INNER JOIN user ON user.id_user=comment.id_user
													WHERE comment.id_article=? ORDER BY notice.notice_date DESC');
        $req->execute(array($idArticle));

        if($req->rowCount()==0){
            return  false; // dans le cas où il n'y a pas de commentaire
        }
        else {
            return $req->fetchAll(PDO::FETCH_OBJ); // sinon on renvoie tous les commentaires associés à cet article
        }
    }

    public function getComment($idNotice){
        $pdo =& $this->pdodb->loadPDO();
        $req = $pdo->prepare('SELECT * from comment JOIN notice where comment.id_notice = ?');
        $req->execute(array($idNotice));
        if($req->rowCount()==0){
            return  false; // dans le cas où il n'y a pas de commentaire
        }
        else {
            return $req->fetchAll(PDO::FETCH_OBJ); // sinon on renvoie tous le commentaire
        }
    }

    public function supprimerComment($idNotice){
        $pdo =& $this->pdodb->loadPDO();
        $req = $pdo->prepare('DELETE FROM comment  where comment.id_notice=?');
        $req->execute(array($idNotice));
        $req2 = $pdo->prepare('DELETE FROM notice  where notice.id_notice=?');
        $req2->execute(array($idNotice));
    }

    public function modifierCommentaire($idNotice, $mark, $description){
        $pdo =& $this->pdodb->loadPDO();
        $req = $pdo->prepare('UPDATE notice SET notice.notice_description=? , notice.notice_mark=?  where notice.id_notice=?');
        $req->execute(array($description, $mark, $idNotice));
    }



}