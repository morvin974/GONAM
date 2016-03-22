<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Comment extends Controller {

    public function index() {
        $this->load->library('view') ;
        //$this->load->library('vform');
        $this->view->load("Comment_view/Comment_view.php");
    }

    public function ajouterComment(){
        $this->load->model('Comment_model');
        $this->load->library('vform');
        $this->vform->addRules('mark', 'note', 'required|notEmpty|isInt');
        $this->vform->addRules('description', 'description', 'required|notEmpty|btwLength[2,200]');

        if($this->Comment_model->ADejaPublierPourUnArticle($_GET['idarticle'])){
            echo "Vous avez deja publier un commentaire pour cet article";
        }
        else {
            if($this->vform->run()) {
                $this->Comment_model->ajouterComment($_GET['idarticle'], $_POST['description'], $_POST['mark']);

            }
			else {
			}

        }

    }

    public function supprimerComment(){
        $this->load->model('Comment_model');
        if($this->Comment_model->getComment($_GET['idnotice'])){
            echo"pas de commentaire pour pour cet id";
        }
        else {
            $this->Comment_model->supprimerComment($_GET['idnotice']);
        }
    }

    public function modifierComment(){
        $this->load->model('Comment_model');
        if($this->Comment_model->getComment($_GET['idnotice'])){
            echo"pas de commentaire pour pour cet id";
        }
        else {
            $this->Comment_model->modifierComment($_GET['idnotice'], $_POST['mark'], $_POST['description']);
        }
    }
}

