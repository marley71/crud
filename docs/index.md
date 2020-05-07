---
some_url: https://github.com/marley71/crud-vue
extra:
    version: 1.0
---

# CRUD-Vue v1.0 

Libreria CRUD per la realizzazione di interfacce professionali basate su chiamate REST con 
metodi CREATE,READ,UPDATE,DELETE. Il protocollo utilizzato per la comunicazione è il json. 
La libreria utilizza il concetto di componente. La pagina è formata da componenti ed esse
sono gestite attraverso l'oggetto principale `CrudApp`. 
Il concetto di base è quello di creare una logica e una grafica delle componenti
in modo che ci sia una versione base implementata dalla libreria, ma che sia customizzabile
a piacere nella propria applicazione sia come layout grafico sia come logica.

## Component

Abbiamo creato un componente principale vue per tutte le componenti presenti nella libreria, si chiama  
<a href="c-component">`c-component`</a>. Va considerato come una classe astratta. L'oggetto c-component
crea un componente vue che è stato definito per permettere una facile simulazione
dell'ereditarietà di un normale linguaggio ad oggetti. Non andrebbe mai istanziato


## Widget
Una componente `Widget` si prende il compito di gestire il singolo dato secondo controlli standard html o plugins 
di varia complessità. Alcuni widget di utilità generale sono stati realizzati nella libreria, ma si possono creare
widgets secondo le nostre esigenze o estendendo quelli presenti o crearne di nuovi.
[Widgets](widgets.md)


## View
La componente `View` rappresenta una collezione di dati. A questi dati 
vengono associati dei componenti di tipo `Widget`. Sono state create delle view di utilizzo standard, ma anche qui
se ne possono creare di nuove per venire incontro alle nostre esigenze.
[Views](views.md)

## Template

Il componente `Template` permette di costruire un template html di contorno per l'oggetto `Widget`. 
Viene utilizzato dalle views e permette di poter customizzare i templates per alcuni widget presenti nella view.
Questo permette per esempio di enfatizzare alcuni campi la dove serve e di non creare viste sempre monotone e dare
un minimo di variabilità nella visualizzazione.
[Templates](templates.md)


## Action
Il componente `action` è nato per la gestione delle azioni vogliamo realizzare su di una vista.
[Actions](actions.md)

## Conf
Sono configurazioni iniziali per le istanze delle varie views o wigets. Questo permette di poter variare il comportamento
di un componente e specializzarlo dove serve in modo da potersi discostare dal comportamento di default.
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


## Dashboard
Le dashboards sono modi di utilizzare combinando più views che interagiscono tra loro. Una fondamentale creata
già nella libreria e che serve come esempio è la `c-manage`.
[Dashboards](dashboards.md)

