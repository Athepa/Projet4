<?php

declare(strict_types=1);

namespace  App\Service;

use App\Controller\Frontoffice\PostController;
use App\Model\CommentManager;
use App\Model\PostManager;
use App\Service\Database;
use App\View\View;

// cette classe router est un exemple très basic. Cette façon de faire n'est pas optimale
class Router
{
    private Database $database;
    private View $view;
    private array $get;

    public function __construct()
    {
        // dépendance
        $this->database = new Database();
        $this->view = new View();

        // En attendent de mettre en place la class App\Service\Http\Request
        $this->get = $_GET;
    }

    public function run(): void
    {
        // Nous avons deux routes :
        // - une pour afficher tous les posts => http://localhost:8000/?action=posts
        // - une pour afficher un post en particulier => http://localhost:8000/?action=post&id=5
        
        //On test si une action a été défini ? si oui alors on récupére l'action : sinon on mets une action par défaut (ici l'action posts)
        $action = isset($this->get['action']) ? $this->get['action'] : 'posts';

        //Déterminer sur quelle route nous sommes // Attention algorithme naïf
        if ($action === 'posts') {
            //injection des dépendances et instanciation du controller
        $commentManager = new CommentManager($this->database);
            $postManager = new PostManager($this->database);
            $controller = new PostController($postManager, $commentManager, $this->view);
    
            // route http://localhost:8000/?action=posts
            $controller->displayAllAction();
        } elseif ($action === 'post' && isset($this->get['id'])) {
            //injection des dépendances et instanciation du controller
            $commentManager = new CommentManager($this->database);
            $postManager = new PostManager($this->database);
            $controller = new PostController($postManager, $commentManager, $this->view);
            
            // route http://localhost:8000/?action=post&id=5
            $controller->displayOneAction((int)$this->get['id']);
        } else {
            echo "Error 404 - cette page n'existe pas<br><a href=http://localhost:8000/?action=posts>Aller Ici</a>";
        }
    }
}
