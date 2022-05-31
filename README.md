<h1> projet-fil-rouge</h1>
<h2>Contexte du projet: "Salon En Ligne"</h2>
l'application "Salon En Ligne" sert à connecter les coiffeurs avec leur clients qui peuvent faire une demmande de services sans avoir à se déplacer et attendre pendant des heurs.
Salon En Ligne à deux type d'utilisateurs :
<ol>
  <li>
           Utilisateur coiffeur : un utilisateur qui souhaitent étre contacté par de nouveaux clients et recevoir des demandes de services.
        <ul>
          <li>autant que coiffeur je peux me connecter afin de ajouter/modifer/supprimer mes offres de services.</li>
          <li>autant que coiffeur je peux me connecter afin de consulter/reffuser/accepter mes demandes de services.</li>
        </ul>
  </li>
  <li>
            Utilisateur client : un utilisateur qui souhiatent acheter un service de coiffeurie
      <ul>
        <li>autant que visiteur/client je peux me connecter afin de consulter les services de coiffeur disponible.</li>
        <li>autant que visiteur/client je peux me connecter afin de demander un services de coiffeur.</li>
        <li>autant que visiteur/client je peux me connecter afin de consulter/annuler mes demandes de services.</li>
        <li>autant que visiteur/client je peux me connecter afin de rechercher un services avec des mots clé ou nom de ville.</li>
    </ul>
  </li>
</ol>
<h2>Mise en page et briefing </h2>
l'application contiendra les pages suivantes:<br>
<ol>
  <li>
    la page d'accueille:
        <br>la page par défault de l'application qui doit contenir une description courte de l'application ainsi que deux button pour l'inscription et la connection
    </li>
  <li>
        la page de l'inscription:<br>contiendra un formulaire à remplir pour que l'utilisateur puisse créer un compte.
      <ul>
        <li>
            le formulaire doit permettre de remplir :
             <ul>
                <li>
                    le nom de l'utilisateur: entre 3 et 30 characters uniquement alphanumérique
                </li>
                <li>
                    image de l'utilisateur : un fichier jpg/png avec une taille maximale de 1 MB
                </li>
                <li>
                    le prénom de l'utilisateur: entre 3 et 30 characters uniquement alphanumérique
                </li>
                <li>mot de passe :doit comporter au moins six caractères et doit être vérifié par un deuxième mot de passe lors de l'inscription</li>
                <li>
                    l'email de l'utilisateur : un email valid
                </li>
                <li>Phone: un numéro du telephone portable valid 
                </li>
                <li>
                    Position: un champs pour sélectioner sa posiotion sur la carte 
                </li>
                <li>
                    Ville: un nom de ville valid au maroc sélectionner depuis une liste  
                </li>
                <li>
                    Quartier: entre 3 et 50 characters uniquement alphanumérique  
                </li>
                <li>
                    Type de compte : choisir d'étre un coiffeur ou un client  
                </li>
            </ul>
            <u>
                Le formulaire doit étre verifié dans le coté client pour minimiser les requests envoyé au serveur
            </u>
        </li>
    </ul>
  </li>
  <li>
        la page de connection:<br>contiendra un formulaire à remplir pour que l'utilisateur puisse créer un compte.
      <ul>
        <li>
            le formulaire doit permettre de remplir : l'email et le mot de passe
        </li>
        <li>
            un botton pour restaurer le mot de passe si il l'a oublier
        </li>
        </ul>
    </li><li>
        la page de mon profile:<br>contiendra un formulaire permettant de visualiser les informations de l'utilisateur et les mettre à jour.
  <li>
        la page mes offres(pour l'utilisateur coiffeur):<br>
        <ul>
        <li>contenant la liste des offres que l'utilisateur/coiffeur souhaite offrir lui donnant l'option d'ajouter/supprimer/modifier une offre
        </li>
        <li>
        chaque offre à ses informations:
            <ul>
                <li>le nom du service: entre 5 et 50 characters uniquement alphanumérique </li>
                <li>Image du service: un fichier image jpg/png ne dépassant pas 1 MB </li>
                <li>La description du service: entre 20 et 1000 characters</li>
                <li>le prix du service: un nombre minimum 10 en monnaie national MAD</li>
                <li>les horaires de disponibilité (les jours/heurs): un nombre minimum 10 en monnaie national MAD</li>
            </ul>
        </ul>
    </li>
  <li>
        la page mes demandes(pour l'utilisateur coiffeur):<br>contenant la liste des demandes que  les autres utilisateur on mets sur les servies de l'utilisateur actuelle
        <ul>
            <li>chaque utilisateur peut accepter ou refuser une demande de service </li>
            <li>chaque utilisateur peut également marquer une demande comme compléte afin que le client puisse laisser un avis refuser une demande </li>
            <li>les demandes doivent étre représentées par des cartes contenantes leur status</li>
        </ul>
    </li>
  <li>
        la page mes demandes(pour l'utilisateur client):<br>contenant la liste des demandes que l'utilisateur à mets
        <ul>
            <li>chaque demande a un identifiant,nom de service demandé,et le status (refusé/confirmé/annulé)</li>
            <li>chaque utilisateur peut consulter la liste des services qu'il a demandé </li>
            <li>chaque utilisateur peut laisser un avis (de 1 à cinq étoiles) sur une demande qui sera utilisé pour générer le  </li>
            <li>les demandes doivent étre représentées par des cartes</li>
        </ul>
    </li>
  <li>
        la page des offres de services(pour l'utilisateur client):<br>contenant la liste des services que l'utilisateur peut demander
        <ul>
            <li>l'utilisateur peut selectionner un service à demander ou voir ses détails</li>
            <li>l'utilisateur peut chercher un service avec des mots clé ou filtrer par ville/quartier/ distance de sa position(optionel)</li>
        </ul>
    </li>
</ol>



