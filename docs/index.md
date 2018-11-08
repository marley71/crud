# Cupparis4

Libreria CRUD per la realizzazione di interfacce professionali basate su chiamate rest con 
metodi CREATE,READ,UPDATE,DELETE. Il protocollo utilizzato per la comunicazione è il json. 
La libreria utilizza il concetto di componente. La pagina è formata da componenti ed esse
sono gestite attraverso l'oggetto principale `App`. 
Il concetto di base nella libreria è quello di creare una logica e una grafica delle componenti
in modo che ci sia una versione base implementata dalla libreria, ma che sia customizzabile
a piacere nella propria applicazione sia come layout grafico sia come logica.
            
##Componenti base

Oggetto astratto principale che tutte le componenti presenti nella libreria sono una sottoclasse
di `Component`.
In una visione top-down elenchiamo le principali componenti presenti nella libreria:

## - Dashboards
La componente dashboard permette la gestine di più viste che interagiscono tra di loro.
In questo modo si può creare dashboard specifiche per le nostre applicazioni
<a href="dashboards">Componenti Dashboards</a>

## - Views
La componente View rappresenta una collezione di dati che possono essere passati manualmente o 
attraverso un server, utilizzando le route che usano le convenzioni REST. A questi dati 
vengono associati dei componenti di tipo `Render`. 
<a href="views">Componenti Views</a>


## - Renders
Una componente `Render` si prende il compito di gestire il dato secondo controlli standard html o plugins 
di varia complessità e le interazioni dell'utente.

La gestione del componente `Render` è differenziata dal modo in cui esso può essere gestito. 
I modi con cui può essere gestito sono:

- VIEW : In questa modalità il componente render si preoccupa di visualizzare i dati, 
non è prevista nessuna modifica.
- EDIT : In questa modalità il componente render oltre a visualizzare i dati, deve prevederne
la modifica
- SEARCH: In questa modalità il componente deve gestire l'input dell'utente e l'operatore di 
where in quanto i dati vengono inseriti per la ricerca.

Queste modalità sono nate per favorire una migliore customizzazione dei componenti render
in base al contensto in cui vengno utilizzati.

<a href="renders">Componenti Renders</a>

## - Templates

Il componente `Template` permette di costruire un template html di contorno per l'oggetto `Render`. 
Viene utilizzato dalle views e permette di poter customizzare alcuni campi che vogliamo adornare di varie
informazioni e che non è detto che valgano per tutti gli altri Renders
<a href="templates">Componenti Templates</a>

## - Actions
Il componente `Action` rapprensenta la componente principale per ogni azione che vogliamo realizzare.
Le azioni raccolgono le interazioni dell'operatore con l'interfaccia.
<a href="actions">Componenti Actions</a>

##Confs
Sono le classi di configurazioni iniziali per le istanze delle varie views

##Routes
La componente `Route` incapsula l'interazione con il server sia per il recupero sia per la spedizione 
dei dati. In genere viene utilizzata da una view e dalle azioni.
<a href="routes">Componente Routes</a>


##Server
Classe che rappresenta un wrapper delle chiamate ajax di jquery, con alcune estensioni.
<a href="server">Componente Server</a>

##App
La componente `App` rappresenta l'oggetto per la gestione della pagina e delle sue varie componenti 
javascript.
<a href="app">Componente App</a>

