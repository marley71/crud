# Cupparijs4 (Versione Alpha)

require "header.md"

Libreria CRUD per la realizzazione di interfacce professionali basate su chiamate rest con 
metodi CREATE,READ,UPDATE,DELETE. Il protocollo utilizzato per la comunicazione è il json. 
La libreria utilizza il concetto di componente. La pagina è formata da componenti ed esse
sono gestite attraverso l'oggetto principale `App`. 
Il concetto di base nella libreria è quello di creare una logica e una grafica delle componenti
in modo che ci sia una versione base implementata dalla libreria, ma che sia customizzabile
a piacere nella propria applicazione sia come layout grafico sia come logica.


            
## Componenti base

L'oggetto astratto principale che tutte le componenti presenti nella libreria si chiama  <a href="components">`Component`</a>.
In una visione top-down elenchiamo le principali componenti presenti nella libreria:

## - Dashboards
La componente dashboard è stata create per la la gestione di più viste che interagiscono o no tra di loro.
In questo modo si possono creare dashboard specifiche per le nostre applicazioni.
<a href="dashboards">Dettaglio Dashboards</a>

## - Views
La componente `View` rappresenta una collezione di dati che possono essere passati manualmente o 
attraverso un server, utilizzando le route che usano le convenzioni REST. A questi dati 
vengono associati dei componenti di tipo `Render`. 
[Dettaglio Views](views.md)



## - Renders
Una componente `Render` si prende il compito di gestire le interazione utenti sul dato secondo controlli standard html o plugins 
di varia complessità.

La gestione del componente `Render` è stata differenziata dal modo in cui esso può essere gestito. 
I modi con cui può essere gestito sono:

- VIEW : In questa modalità il componente render si preoccupa di visualizzare i dati, 
non è prevista nessuna modifica.
- EDIT : In questa modalità il componente render oltre a visualizzare i dati, deve prevederne
la modifica
- SEARCH: In questa modalità il componente deve gestire l'input dell'utente e l'operatore della search normalmente
nascosto

Queste modalità sono nate per favorire una migliore customizzazione dei componenti render
in base al contesto in cui vengno utilizzati.

<a href="renders">Dettaglio Renders</a>

## - Templates

Il componente `Template` permette di costruire un template html di contorno per l'oggetto `Render`. 
Viene utilizzato dalle views e permette di poter customizzare alcuni campi che vogliamo adornare con varie
informazioni e che non è detto che valgano per tutti gli altri Render.
<a href="templates">Dettaglio Templates</a>

## - Actions
Il componente `Action` è nato per la gestione delle azioni vogliamo realizzare su di una vista.
<a href="actions">Dettaglio Actions</a>

##Confs
Sono le classi di configurazioni iniziali per le istanze delle varie views. Questo permette di avere delle 
configurazioni globali su alcuni campi delle nostre viste senza definirli ogni volta.

##Routes
La componente `Route` incapsula l'interazione con il server sia per il recupero sia per la spedizione 
dei dati. In genere viene utilizzata da una view e dalle azioni.
<a href="routes">Dettaglio Routes</a>


##Server
Classe che rappresenta un wrapper delle chiamate ajax di jquery, con alcune estensioni.
<a href="server">Dettaglio Server</a>

##App
La componente `App` rappresenta l'oggetto per la gestione della pagina e delle sue varie componenti 
javascript.
<a href="app">Dettaglio App</a>

