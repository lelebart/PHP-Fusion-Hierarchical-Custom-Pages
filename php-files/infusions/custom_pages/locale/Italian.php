<?php
/*-------------------------------------------------------+
| PHP-Fusion Content Management System
| Copyright (C) 2002 - 2010 Nick Jones
| http://www.php-fusion.co.uk/
+--------------------------------------------------------+
| Type: Infusion
| Name: Hierarchical Custom Pages
| Version: 1.00
| Author: Valerio Vendrame (lelebart)
+--------------------------------------------------------+
| Filename: Italian.php
| Author: Valerio Vendrame (lelebart)
+--------------------------------------------------------+
| Language: Italian (IT)
| Author / Transaltor: Valerio Vendrame (lelebart)
+--------------------------------------------------------+
| This program is released as free software under the
| Affero GPL license. You can redistribute it and/or
| modify it under the terms of this license which you
| can read by viewing the included agpl.txt or online
| at www.gnu.org/licenses/agpl.html. Removal of this
| copyright header is strictly prohibited without
| written permission from the original author(s).
+--------------------------------------------------------*/

// InFusion
$locale['hcp_admin'] = "Gestione Pagine Personali";
$locale['hcp_title'] = "Pagine Personali Gerarchiche";
$locale['hcp_desc']  = "Un modo per organizzare le pagine gerarchicamente";// in rapporti di parentela

// Titles
$locale['hcp_table'] = "Struttura Pagine Personali";
$locale['hcp_tree']  = "Struttura Pagine";
$locale['hcp_side']  = "Pagine Figlie";
$locale['hcp_err']   = "Spiacente, non &egrave; stata creata nessuna Pagina.";

// admin.php
$locale['hcp_000'] = "Con il <strong>pannello <tt>custom_pages_panel</tt> abilitato</strong>, nel momento in cui nella gerarchia &egrave; presente una pagina ad accesso limitato, la visibilit&agrave; di tutte le pagine gerarchicamente inferiore ad essa collegate (le <em>pagine figlie</em>), avranno il medesimo accesso limitato (della <em>pagina madre</em>).<br /><br /> 
Ad esempio, con una struttura del tipo:\n<pre><tt>pagina 1 (Anonimo)\n- pagina 1.1 (Iscritto)\n- - pagina 1.1.1 (Anonimo)\n- - - pagina 1.1.1.1 (Anonimo)\n</tt></pre>
l'utente <em>Anonimo</em> non potr&agrave; leggere <tt>pagina 1.1.1</tt> e <tt>pagina 1.1.1.1</tt> in aggiunta a <tt>pagina 1.1</tt>.";
$locale['hcp_001'] = "Stato del pannello:";
$locale['hcp_002'] = "ATTIVO";
$locale['hcp_003'] = "NON ATTIVO";
$locale['hcp_004'] = "NON INSTALLATO";
$locale['hcp_005'] = "[chiudi/apri]";

$locale['hcp_100'] = "Cos'&egrave; il TinyMCE?";
$locale['hcp_101'] = "TninyMCE crea un ambiente di videoscrittura pensato per facilitare la creazione di pagine con formattazione avanzata.<br /> 
Disabilitare TinyMCE per inserire codice PHP o modificare direttamente la sorgente (X)HTML.";

$locale['hcp_200'] = "Titolo Pagina";
$locale['hcp_201'] = "Visibilit&agrave;";
$locale['hcp_202'] = "Ordine";
$locale['hcp_203'] = "Opzioni";
$locale['hcp_204'] = "Modifica";
$locale['hcp_205'] = "Elimina";
$locale['hcp_206'] = "Visualizza";
$locale['hcp_207'] = "Non &egrave; presente nessuna Pagina Personale.<br />\n<a href='".CP_HIER_DIR."custom_pages.php%s'>Clicca qui</a> per crearne una.";

$locale['hcp_300'] = "Vuoi davvero eliminare questa pagina?";
$locale['hcp_301'] = "Vuoi davvero eliminare queste pagine?";
$locale['hcp_302'] = "Pagina eliminata";
$locale['hcp_303'] = "Pagine eliminate";
$locale['hcp_304'] = "Alcune pagine non sono state cancellate poich&eacute; avevano delle pagine figlie";
$locale['hcp_305'] = "Impossibile eliminare questa pagina poich&eacute; ha una o pi&ugrave; pagine figlie";
$locale['hcp_306'] = "Ordine aggiornato";
$locale['hcp_307'] = "Elimina pi&ugrave; pagine";
$locale['hcp_308'] = "Uscire dall\'area amministrativa per vedere questa pagina?";

// custom_pages.php
$locale['hcp_400'] = $locale['hcp_202'].":";
$locale['hcp_401'] = "Pagina Madre:";
$locale['hcp_402'] = "--- Nessuna ---";
?>