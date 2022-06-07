<?php
$i18n = array ();
$i18n['starterkit'] = 'Un kit de démarrage pour la paiement en ligne par formulaire';
/*
 * Languages
 */
$i18n["fr"] = "Français";
$i18n["de"] = "Allemand";
$i18n["en"] = "Anglais";
$i18n["es"] = "Espagnol";
/*
 * Requirements
 */
$i18n['lang'] = 'Langue';
$i18n['contactus'] = 'Nous contacter';
$i18n['shopid'] = 'Votre identifiant boutique';
$i18n['requirements'] = 'Configuration nécessaire';
$i18n['in'] = 'Dans';
$i18n['certtestprod'] = 'Votre certificat (TEST ou PRODUCTION)';
$i18n['modetestprod'] = 'Mode (TEST or PRODUCTION)';
$i18n['platformurl'] = 'Url de la plateforme';
$i18n['debugdesc'] =
    'Pour être redirigé directement sur la page de paiement sans afficher cette page, veuillez passer la valeur debug à <code>false</code> dans le fichier <code>Config.php</code>';

/*
 * Order and chechout data
 */
$i18n['formexamples'] = 'Exemples de formulaires';
$i18n['checkouttitle'] = 'Vérifiez et finalisez votre commande';
$i18n['orderdetails'] = 'Récapitulatif de la commande';
$i18n['total'] = 'Total';
$i18n['item1'] = 'Article 1.';
$i18n['item2'] = 'Article 2.';
$i18n['amount1'] = 'Prix 1.';
$i18n['amount2'] = 'Prix 2.';
$i18n['payment'] = 'Paiement';
$i18n['stdpayment'] = 'Paiement par carte bancaire.';
$i18n['cbpayment'] = 'Paiement avec une carte présélectionnée.';
$i18n['x2payment'] = 'Paiement en 2 fois par carte bancaire.';
$i18n['x4payment'] = 'Paiement en 4 fois par carte bancaire.';
$i18n['ecv'] = 'Paiement par e-Chèque-Vacances.';
$i18n['redirect_message_defaut'] = 'Redirection vers la boutique dans quelques instants...';

/**
 * Example Form fields description
 */
$i18n['payzensolution'] = 'EXEMPLE D\'IMPLEMENTATION DE LA SOLUTION DE PAIEMENT PAYZEN';
$i18n['info'] = 'INFORMATIONS';
$i18n['usesform'] =
    'Le paiement s\'appuie sur l\'envoi d\'un formulaire de paiement en https vers l\'URL de la plateforme de paiement PAYZEN.';
$i18n['file'] = 'Fichier ';
$i18n['htmlformuse'] =
    '<p>Le fichier <code>html-form.php</code> envoie l\'ensemble des champs liés au paiement vers le fichier <code>form-tunnel.php</code> qui récupère l\'ensemble des ces champs pour construire la requête de paiement.</p><p>Les champs sont renseignés à titre d\'exemple, à votre charge de les valoriser en fonction de votre contexte.</p><p><b>D\'autres champs sont disponibles, le support PAYZEN vous invite à lire la documentation liée au formulaire de paiement</b> <a href="https://payzen.io">Consulter la documentation.</a></p>';
$i18n['beforefirstuse'] =
    'Avant la première utilisation vous devez impérativement renseigner les champs <code>shopID</code>, <code>certTest</code>, <code>platform</code> et <code>ctxMode</code> du fichier <code>config/Config.php</code>. Ce fichier comporte des données sensibles. <b>La sécurisation de ces données est de votre responsabilité.</b>';
$i18n['transsettings'] = 'PARAMETRES DE LA TRANSACTION';
$i18n['clientssettings'] = 'Informations personnelles du client';
$i18n['amountdesc'] =
    'Montant de la commande exprimé dans la plus petite unité de la devise. Centimes pour EURO. Ex : 1000 pour 10 euros';
$i18n['orderdesc'] =
    'Numéro de commande. Paramètre facultatif. Longueur du champ: 32 caractères maximum - Type Alphanumérique';
$i18n['custid'] = 'Numéro client. Paramètre facultatif. Longueur du champ: 32 caractères maximum - Type Alphanumérique';
$i18n['custfirstname'] =
    'Prénom du client. Paramètre facultatif. Longueur du champ: 127 caractères maximum - Type Alphanumérique';
$i18n['custlastname'] =
    'Nom du client. Paramètre facultatif. Longueur du champ: 127 caractères maximum - Type Alphanumérique';
$i18n['custaddress'] =
    'Adresse du client. Paramètre facultatif. Longueur du champ: 255 caractères maximum - Type Alphanumérique';
$i18n['custzip'] =
    'Code Postal du client. Paramètre facultatif. Longueur du champ: 32 caractères maximum - Type Alphanumérique';
$i18n['custcity'] =
    'Ville du client. Paramètre facultatif. Longueur du champ: 63 caractères maximum - Type Alphanumérique';
$i18n['custcountry'] =
    'Pays du client. Code pays du client à la norme ISO 3166. Paramètre facultatif. Longueur du champ: 2 caractères maximum - Type Alphanumérique';
$i18n['custphone'] =
    'Téléphone du client. Paramètre facultatif. Longueur du champ: 32 caractères maximum - Type Alphanumérique';
$i18n['custemail'] = 'Email du client. Paramètre facultatif.';
$i18n['urlreturndesc'] =
    'URL où sera redirigé par défaut l’acheteur après un appui sur le bouton Retourner à la boutique, si les URL vads_url_error, vads_url_refused, vads_url_success ou vads_url_cancel ne sont pas renseignées.';
$i18n['redirect'] =
    'Permet de définir un délai en secondes avant redirection automatique vers le site marchand à la fin d’un paiement accepté.';
$i18n['sendform'] = 'PAYER => envoyer les paramètres vers la plateforme de paiement';

/*
 * Payment analysis
 */
$i18n['paymentanalysis'] = 'Analyse du paiement';
$i18n['ipn'] = 'URL de notification instantanée (IPN)';
$i18n['ipndesc'] =
    'Lorsque le paiement est terminé, la plateforme de paiement renvoie des paramètres en mode POST vers l\'URL serveur qui doit analyser les résultats du paiement. Dans un premier temps il convient de vérifier la signature reçue. Si celle-ci est correcte alors vous pourrez prendre en considération les paramètres liés au paiement proprement dit.';
$i18n['returnurl'] = 'URL de retour';
$i18n['clientcomesback'] =
    'Lorsque l\'internaute revient à la boutique via l\'une des url de retour, les paramètres liés au paiement sont renvoyés en fonction de la variable vads_return_mode définie dans le fichier conf.txt. En fonction du vads_return_mode les paramètres sont renvoyés en mode POST / GET ou pas du tout.';
$i18n['formreturndesc'] =
    'Dans ce pack, c\'est le fichier form-return.php qui controle la signature et analyse les résultats du paiement. Le code est donné à titre d\'exemple. Dans un premier temps le script vérifie la signature puis analyse les principaux champs. A vous d\'adapter le code à votre contexte.';
$i18n['findhelp'] = 'Trouver de l\'aide';
$i18n['supportrecommends'] = 'Le support de PayZen recommande fortement de lire la documentation';

/**
 * Debug mode
 */
$i18n['price'] = 'Prix';
$i18n['pay'] = 'Payer';
$i18n['displayrealprice'] = 'Afficher uniquement le prix à payer';
$i18n['paymentform'] = 'Formulaire de paiement';

/**
 * form-return.php
 */
$i18n['formexampleresponse'] = 'Exemple de Réponse';
$i18n['paymentresponseanalysis'] = 'Analyse de la réponse';
$i18n['responsessettings'] = 'Paramètres de la réponse';

$i18n['paymentstatus'] = 'Statut du paiement';

$i18n['auth'] = "Résultat d'authentification";
$i18n['validsign'] = "Signature Valide";
$i18n['invalidsigndesc'] = "Signature Invalide - ne pas prendre en compte le résultat de ce paiement";

$i18n['vads_trans_status'] = 'Statut de la transaction';
$i18n['abandoned'] =
    "Le paiement a été abandonné par le client. La transaction n’a pas été crée sur la plateforme de paiement et n’est donc pas visible dans le back office marchand.";
$i18n['authorised'] = "Le paiement a été accepté et est en attente de remise en banque.";
$i18n['refused'] = "Le paiement a été refusé.";
$i18n['tovalidate'] =
    "La transaction a été acceptée mais elle est en attente de validation manuelle. C'est à la charge du marchand de valider la transaction pour demander la remise en banque depuis le back office marchand ou par requête web service. La transaction pourra être validée tant que le délai de capture n’a pas été dépassé. Si ce délai est dépassé alors le paiement bascule dans le statut Expiré. Ce statut expiré est définitif.";
$i18n['toauthorise'] =
    "La transaction est en attente d’autorisation. Lors du paiement uniquement un prise d’empreinte a été réalisée car le délai de remise en banque est strictement supérieur à 7 jours. Par défaut la demande d’autorisation pour le montant global sera réalisée à j-2 avant la date de remise en banque.";
$i18n['expired'] =
    "La transaction est expirée. Ce statut est définitif, la transaction ne pourra plus être remisée en banque. Une transaction expire dans le cas d'une transaction créée en validation manuelle ou lorsque le délai de remise en banque (capture delay) dépassé.";
$i18n['cancelled'] =
    "La transaction a été annulée au travers du back office marchand ou par une requête web service. Ce statut est définitif, la transaction ne sera jamais remise en banque.";
$i18n['tovalidate'] =
    "La transaction est en attente d’autorisation et en attente de validation manuelle. Lors du paiement uniquement un prise d’empreinte a été réalisée car le délai de remise en banque est strictement supérieur à 7 jours et le type de validation demandé est « validation manuelle ». Ce paiement ne pourra être remis en banque uniquement après une validation du marchand depuis le back office marchand ou par un requête web services.";
$i18n['captured'] = "La transaction a été remise en banque. Ce statut est définitif.";

$i18n['result'] = "Résultat du paiement";
$i18n['00'] = "Paiement réalisé avec succès.";
$i18n['02'] = "Le commerçant doit contacter la banque du porteur.";
$i18n['05'] = "Paiement refusé.";
$i18n['17'] = "Paiement annulé par le client.";
$i18n['30'] = "Erreur de format de la requête. A mettre en rapport avec la valorisation du champ vads_extra_result.";
$i18n['96'] = "Erreur technique lors du paiement.";

$i18n['vads_trans_id'] = "Identifiant de transaction";
$i18n['vads_amount'] =
    "Montant de la transaction exprimé dans la plus petite unité de la monnaie ou devise (le centime pour l'euro)";
$i18n['vads_effective_amount'] = "Montant Effectif";
$i18n['vads_effective_amount_desc'] =
    "montant du paiement dans la devise réellement utilisée pour effectuer la remise en banque.";

$i18n['vads_payment_config'] = "Type de paiement";
$i18n['standard'] = "Paiement standard.";
$i18n['multi'] = "Paiement multiple.";

$i18n['vads_sequence_number'] = "Numéro de séquence";

$i18n['vads_auth_result'] = "Autorisation retournée par la banque émettrice";
$i18n['vads_auth_result_00'] = "Transaction approuvée ou traitée avec succès.";
$i18n['vads_auth_result_02'] = "Contacter l’émetteur de carte.";
$i18n['vads_auth_result_03'] = "Accepteur_invalide.";
$i18n['vads_auth_result_04'] = "Conserver la carte.";
$i18n['vads_auth_result_05'] = "Ne pas honorer.";
$i18n['vads_auth_result_07'] = "Conserver la carte, conditions spéciales.";
$i18n['vads_auth_result_08'] = "Approuver après identification.";
$i18n['vads_auth_result_12'] = "Transaction invalide.";
$i18n['vads_auth_result_13'] = "Montant invalide.";
$i18n['vads_auth_result_14'] = "Numéro de porteur invalide.";
$i18n['vads_auth_result_30'] = "Erreur de format.";
$i18n['vads_auth_result_31'] = "Identifiant de l’organisme acquéreur inconnu.";
$i18n['vads_auth_result_33'] = "Date de validité de la carte dépassée.";
$i18n['vads_auth_result_34'] = "Suspicion de fraude.";
$i18n['vads_auth_result_41'] = "Carte perdue.";
$i18n['vads_auth_result_43'] = "Carte volée.";
$i18n['vads_auth_result_51'] = "Provision insuffisante ou crédit dépassé.";
$i18n['vads_auth_result_54'] = "Date de validité de la carte dépassée.";
$i18n['vads_auth_result_56'] = "Carte absente du fichier.";
$i18n['vads_auth_result_57'] = "Transaction non permise à ce porteur.";
$i18n['vads_auth_result_58'] = "Transaction interdite au terminal.";
$i18n['vads_auth_result_59'] = "Suspicion de fraude.";
$i18n['vads_auth_result_60'] = "L’accepteur de carte doit contacter l’acquéreur.";
$i18n['vads_auth_result_61'] = "Montant de retrait hors limite.";
$i18n['vads_auth_result_63'] = "Règles de sécurité non respectées.";
$i18n['vads_auth_result_68'] = "Réponse non parvenue ou reçue trop tard.";
$i18n['vads_auth_result_90'] = "Arrêt momentané du système.";
$i18n['vads_auth_result_91'] = "Emetteur de cartes inaccessible.";
$i18n['vads_auth_result_94'] = "Transaction dupliquée.";
$i18n['vads_auth_result_96'] = "Mauvais fonctionnement du système.";
$i18n['vads_auth_result_97'] = "Echéance de la temporisation de surveillance globale.";
$i18n['vads_auth_result_98'] = "Serveur indisponible routage réseau demandé à nouveau.";
$i18n['vads_auth_result_99'] = "Incident domaine initiateur.";

$i18n['vads_warranty_result'] = "Garantie de paiement";
$i18n['vads_warranty_result_yes'] = "Le paiement est garanti.";
$i18n['vads_warranty_result_no'] = "Le paiement n’est pas garanti.";
$i18n['vads_warranty_result_unknown'] = "Suite à une erreur technique, le paiement ne peut pas être garanti.";
$i18n['vads_warranty_result_x'] = "Garantie de paiement non applicable.";

$i18n['vads_threeds_status'] = "Statut 3DS";
$i18n['vads_threeds_status_y'] = "Authentifié 3DS.";
$i18n['vads_threeds_status_n'] = "Erreur Authentification.";
$i18n['vads_threeds_status_u'] = "Authentification impossible.";
$i18n['vads_threeds_status_a'] = "Essai d’authentification.";
$i18n['vads_threeds_status_x'] = "Non renseigné.";

$i18n['vads_capture_delay'] = "Délai avant Remise en Banque";
$i18n['days'] = "jours";

$i18n['vads_validation_mode'] = "Mode de Validation";
$i18n['vads_validation_mode_1'] = "Validation Manuelle";
$i18n['vads_validation_mode_0'] = "Validation Automatique";
$i18n['vads_validation_mode_x'] = "Configuration par défaut du back office marchand";

$i18n['allReceivedData'] = "Liste de tous des paramètres réceptionnés";