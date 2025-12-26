<?php

return [

    'validation' => [

        // Title
        'title_required' => 'Le titre est obligatoire.',
        'title_max'      => 'Le titre ne doit pas dépasser 255 caractères.',

        // Content
        'content_required' => 'Le contenu de l’article est obligatoire.',

        // Status
        'status_required' => 'Le statut est obligatoire.',
        'status_invalid'  => 'Le statut sélectionné est invalide.',

        // Image
        'image_invalid' => 'Le fichier doit être une image valide.',
        'image_max'     => 'L’image ne doit pas dépasser 2 Mo.',

        // Videos
        'videos_array' => 'Les vidéos doivent être envoyées sous forme de liste.',
        'videos_mimes' => 'Les vidéos doivent être au format MP4, WEBM ou OGG.',
        'videos_max'   => 'Chaque vidéo ne doit pas dépasser 500 Mo.',

        // Categories
        'categories_required' => 'Veuillez sélectionner au moins une catégorie.',
        'categories_array'    => 'Les catégories doivent être envoyées sous forme de liste.',
        'categories_exists'   => 'Une des catégories sélectionnées est invalide.',
        'video_duplicate_selection' => 'Vous avez sélectionné plusieurs fois la même vidéo.',
        'video_exists_in_article' => 'La vidéo :name existe déjà dans cet article.',
    ],


    'labels' => [
        'title'        => 'Titre',
        'slug'         => 'Slug',
        'content'      => 'Contenu',
        'image'        => 'Image de couverture',
        'videos'       => 'Vidéos',
        'categories'   => 'Catégories',
        'tags'         => 'Tags',
        'status'       => 'Statut',
        'is_featured'  => 'À la une',
        'add'          => 'Ajouter',
        'submit_create'=> 'Créer l’article',
        'submit_update'=> 'Mettre à jour l’article',
    ],

   

    'status' => [
        'draft'     => 'Brouillon',
        'published' => 'Publié',
        'archived'  => 'Archivé',
    ],

    'messages' => [
        'created' => 'L’article a été créé avec succès !',
        'updated' => 'L’article a été mis à jour avec succès !',
        'deleted' => 'L’article a été supprimé avec succès !',
    ],

];
