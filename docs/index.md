---
some_url: https://example.com
extra:
    version: 1.0
---

# Cupparijs4 (Versione Alpha)

Libreria CRUD per la realizzazione di interfacce professionali basate su chiamate REST con 
metodi CREATE,READ,UPDATE,DELETE. Il protocollo utilizzato per la comunicazione è il json. 
La libreria utilizza il concetto di componente. La pagina è formata da componenti ed esse
sono gestite attraverso l'oggetto principale `App`. 
Il concetto di base è quello di creare una logica e una grafica delle componenti
in modo che ci sia una versione base implementata dalla libreria, ma che sia customizzabile
a piacere nella propria applicazione sia come layout grafico sia come logica.


## Componenti base

Nella libreria è stata definita una classe main che permette di simulare l'erediareità degli oggetti.
Questa classe si chiama `Class`. Elenchiamo le principali componenti presenti nella libreria:

## Component

Abbiamo creato un oggetto principale per tutte le componenti presenti nella libreria si chiama  
<a href="component">`Component`</a>. Va considerato come una classe astratta. L'oggetto Component
estende un oggetto javascript chiamato Class che è stato definito per permettere una facile simulazione
dell'ereditarietà di un normale linguaggio ad oggetti. Non andrebbe mai istanziato


## Render
Una componente `Render` si prende il compito di gestire il singolo dato secondo controlli standard html o plugins 
di varia complessità.

La gestione del componente `Render` è stata differenziata dal modo in cui esso può essere gestito. 
I modi con cui può essere gestito sono:

- VIEW : In questa modalità il componente render si preoccupa di visualizzare i dati, 
non è prevista nessuna modifica.
- EDIT : In questa modalità il componente render oltre a visualizzare i dati, deve prevederne
la modifica
- SEARCH: In questa modalità il componente deve gestire l'input dell'utente e l'operatore della search che normalmente
è nascosto

Queste modalità sono nate per favorire una migliore customizzazione dei componenti render
in base al contesto in cui vengno utilizzati.
[Renders](renders.md)


## View
La componente `View` rappresenta una collezione di dati. A questi dati 
vengono associati dei componenti di tipo `Render`. 
[Views](views.md)



## Dashboard
La componente dashboard è stata create per la la gestione di più viste che interagiscono o no tra di loro.
In questo modo si possono creare dashboard specifiche per le nostre applicazioni.
[Dashboards](dashboards.md)


## Template

Il componente `Template` permette di costruire un template html di contorno per l'oggetto `Render`. 
Viene utilizzato dalle views e permette di poter customizzare i templates per alcuni renders presenti nella
 view.
[Templates](templates.md)


## Action
Il componente `Action` è nato per la gestione delle azioni vogliamo realizzare su di una vista.
[Actions](actions.md)

## Conf
Sono oggetti di configurazioni iniziali per le istanze delle varie views. Questo permette di avere delle 
configurazioni globali su alcuni campi delle nostre viste senza definirli ogni volta.
[Confs](confs.md)

## Route
La componente `Route` incapsula l'interazione con il server sia per il recupero sia per la spedizione 
dei dati. In genere viene utilizzata da una view e dalle azioni.
[Routes](routes.md)


## Server
Classe che rappresenta un wrapper delle chiamate ajax di jquery, con alcune estensioni.
[Server](server.md)

## App
La componente `App` rappresenta l'oggetto per la gestione della pagina e delle sue varie componenti 
javascript.
[App](app.md)

